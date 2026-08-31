<?php
/**
 * Project photo uploads.
 *
 * The only place on this site where a file arrives from outside and is written
 * to disk, so it is deliberately strict:
 *
 *   - the type is decided by reading the file, never by its name or the
 *     Content-Type the browser claims;
 *   - the image is RE-ENCODED through GD rather than moved. A polyglot file
 *     that is a valid JPEG and also a valid PHP script does not survive being
 *     decoded to a pixel buffer and written out again, and neither does any
 *     EXIF payload;
 *   - the stored name is generated here, so nothing from the upload reaches
 *     the filesystem;
 *   - uploads/ carries its own .htaccess denying execution, so even a file
 *     that somehow got through could not be run.
 */

declare(strict_types=1);

const UPLOAD_MAX_BYTES = 6 * 1024 * 1024;   // 6 MB before re-encoding
const UPLOAD_MAX_EDGE  = 1600;              // longest edge after re-encoding
const UPLOAD_QUALITY   = 82;

function upload_dir(): string
{
    return APP_ROOT . '/uploads/projects';
}

function upload_url(string $file): string
{
    return '/uploads/projects/' . rawurlencode($file);
}

/**
 * Validate, re-encode and store one uploaded image.
 * Returns the stored filename, or null with $error set.
 */
function upload_project_image(array $file, ?string &$error = null): ?string
{
    $error = null;

    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return null;                       // nothing chosen; not an error
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $error = match ((int) $file['error']) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'That image is larger than the server accepts.',
            UPLOAD_ERR_PARTIAL                        => 'The upload was interrupted. Please try again.',
            default                                   => 'The image could not be uploaded.',
        };
        return null;
    }

    /* is_uploaded_file, not file_exists: it is the only check that proves the
       path came from this request's multipart body rather than being a path
       an attacker managed to put in $_FILES. */
    if (!is_uploaded_file($file['tmp_name'])) {
        $error = 'The upload could not be verified.';
        return null;
    }

    if ($file['size'] > UPLOAD_MAX_BYTES) {
        $error = 'Images must be under ' . (UPLOAD_MAX_BYTES / 1024 / 1024) . ' MB.';
        return null;
    }

    /* getimagesize returns false for anything that is not a real image, and
       its type comes from the file's own bytes. */
    $info = @getimagesize($file['tmp_name']);
    if ($info === false) {
        $error = 'That file is not an image.';
        return null;
    }

    [$width, $height, $type] = $info;

    $readers = [
        IMAGETYPE_JPEG => 'imagecreatefromjpeg',
        IMAGETYPE_PNG  => 'imagecreatefrompng',
        IMAGETYPE_WEBP => 'imagecreatefromwebp',
    ];

    if (!isset($readers[$type])) {
        $error = 'Images must be JPEG, PNG or WebP.';
        return null;
    }

    if ($width < 400 || $height < 300) {
        $error = 'That image is too small — 800×600 or larger works best.';
        return null;
    }

    $source = @$readers[$type]($file['tmp_name']);
    if (!$source) {
        $error = 'That image could not be read.';
        return null;
    }

    /* Scale the longest edge down so a 12-megapixel phone photo does not
       become the page's largest asset. */
    $scale  = min(1, UPLOAD_MAX_EDGE / max($width, $height));
    $target = imagecreatetruecolor((int) round($width * $scale), (int) round($height * $scale));

    /* A transparent PNG or WebP would otherwise come out with a black
       background once it is written as JPEG. */
    $white = imagecolorallocate($target, 255, 255, 255);
    imagefilledrectangle($target, 0, 0, imagesx($target), imagesy($target), $white);
    imagecopyresampled(
        $target, $source,
        0, 0, 0, 0,
        imagesx($target), imagesy($target),
        $width, $height
    );
    imagedestroy($source);

    $dir = upload_dir();
    if (!is_dir($dir) && !@mkdir($dir, 0755, true) && !is_dir($dir)) {
        imagedestroy($target);
        $error = 'The upload folder could not be created.';
        return null;
    }

    $name = date('Ymd') . '-' . bin2hex(random_bytes(8)) . '.jpg';
    $ok   = imagejpeg($target, $dir . '/' . $name, UPLOAD_QUALITY);
    imagedestroy($target);

    if (!$ok) {
        $error = 'The image could not be saved.';
        return null;
    }

    @chmod($dir . '/' . $name, 0644);

    return $name;
}

/** Remove a stored project image. Only ever touches uploads/projects. */
function upload_delete_image(string $file): void
{
    /* basename strips any traversal before it can be used as a path. */
    $safe = basename($file);
    $path = upload_dir() . '/' . $safe;

    if ($safe !== '' && is_file($path)) {
        @unlink($path);
    }
}

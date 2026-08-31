<?php
/**
 * Projects: list, add, edit, delete.
 *
 * One file rather than four because the form and the list share their
 * validation and the whole thing is four fields and a photo. Every write is a
 * POST that redirects, so a refresh cannot repeat it.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';
require_once dirname(__DIR__) . '/includes/content.php';
require_once dirname(__DIR__) . '/includes/upload.php';

admin_require_login();

$action   = (string) ($_GET['action'] ?? 'list');
$editId   = (string) ($_GET['id'] ?? '');
$services = all_services();
$errors   = [];
$form     = [
    'title' => '', 'title_ar' => '', 'location' => '', 'service' => '',
    'summary' => '', 'summary_ar' => '', 'body' => '', 'body_ar' => '',
    'completed_at' => date('Y-m-d'), 'images' => [],
];

/* ------------------------------------------------------------------ POST */
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        admin_flash('error', 'Your session expired. Please try again.');
        admin_redirect('/admin/projects.php');
    }

    $op = (string) ($_POST['op'] ?? '');

    /* --------------------------------------------------------- delete */
    if ($op === 'delete') {
        $project = store_find('projects', (string) ($_POST['id'] ?? ''));
        if ($project !== null) {
            foreach (($project['images'] ?? []) as $image) {
                upload_delete_image($image);
            }
            store_delete('projects', $project['id']);
            admin_flash('success', 'Project deleted.');
        }
        admin_redirect('/admin/projects.php');
    }

    /* ------------------------------------------------- remove one photo */
    if ($op === 'remove-image') {
        $project = store_find('projects', (string) ($_POST['id'] ?? ''));
        $image   = basename((string) ($_POST['image'] ?? ''));
        if ($project !== null && in_array($image, $project['images'] ?? [], true)) {
            upload_delete_image($image);
            store_update('projects', $project['id'], [
                'images' => array_values(array_diff($project['images'], [$image])),
            ]);
            admin_flash('success', 'Photo removed.');
        }
        admin_redirect('/admin/projects.php?action=edit&id=' . urlencode((string) ($_POST['id'] ?? '')));
    }

    /* --------------------------------------------------- create / update */
    $editId = (string) ($_POST['id'] ?? '');
    $form = [
        'title'        => lead_clean($_POST['title'] ?? '', 120),
        'title_ar'     => lead_clean($_POST['title_ar'] ?? '', 120),
        'location'     => lead_clean($_POST['location'] ?? '', 80),
        'service'      => lead_clean($_POST['service'] ?? '', 60),
        'summary'      => lead_clean($_POST['summary'] ?? '', 300),
        'summary_ar'   => lead_clean($_POST['summary_ar'] ?? '', 300),
        'body'         => lead_clean($_POST['body'] ?? '', 4000),
        'body_ar'      => lead_clean($_POST['body_ar'] ?? '', 4000),
        'completed_at' => lead_clean($_POST['completed_at'] ?? '', 10),
        'images'       => [],
    ];

    if (mb_strlen($form['title']) < 4) {
        $errors[] = 'Give the project a title of at least 4 characters.';
    }
    if ($form['location'] === '') {
        $errors[] = 'Say where the job was — the area and emirate.';
    }
    if ($form['service'] !== '' && !isset($services[$form['service']])) {
        $errors[] = 'Choose a service from the list.';
    }
    if (mb_strlen($form['summary']) < 10) {
        $errors[] = 'Write a short summary — it is what shows on the projects grid.';
    }
    if ($form['completed_at'] !== '') {
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $form['completed_at']);
        if ($date === false || $date->format('Y-m-d') !== $form['completed_at']) {
            $errors[] = 'Enter the completion date as a real date.';
        }
    }

    /* Photos. A failed upload is reported but never loses the typed copy. */
    $existing = [];
    if ($editId !== '') {
        $current  = store_find('projects', $editId);
        $existing = $current['images'] ?? [];
    }

    $uploaded = [];
    foreach ($_FILES['images']['name'] ?? [] as $i => $_) {
        if (count($existing) + count($uploaded) >= 6) {
            $errors[] = 'A project can hold six photos. Remove one before adding another.';
            break;
        }
        $one = [
            'name'     => $_FILES['images']['name'][$i],
            'type'     => $_FILES['images']['type'][$i],
            'tmp_name' => $_FILES['images']['tmp_name'][$i],
            'error'    => $_FILES['images']['error'][$i],
            'size'     => $_FILES['images']['size'][$i],
        ];
        $stored = upload_project_image($one, $uploadError);
        if ($stored !== null) {
            $uploaded[] = $stored;
        } elseif ($uploadError !== null) {
            $errors[] = $uploadError;
        }
    }

    $form['images'] = array_merge($existing, $uploaded);

    if ($errors === []) {
        $record = $form + ['slug' => project_slug($form['title'], $editId)];

        if ($editId !== '' && store_find('projects', $editId) !== null) {
            /* The slug is part of a published URL; changing it silently would
               break every link to the project. It is set once, at creation. */
            unset($record['slug']);
            store_update('projects', $editId, $record);
            admin_flash('success', 'Project updated.');
        } else {
            store_insert('projects', $record);
            admin_flash('success', 'Project published.');
        }
        admin_redirect('/admin/projects.php');
    }

    /* Fall through and redraw the form with the errors and what was typed. */
    $action = $editId !== '' ? 'edit' : 'new';
    foreach ($uploaded as $orphan) {
        /* The record was not saved, so these would be unreferenced files. */
        upload_delete_image($orphan);
    }
    $form['images'] = $existing;
}

/* ------------------------------------------------------- load for editing */
if ($action === 'edit' && $editId !== '' && $errors === []) {
    $project = store_find('projects', $editId);
    if ($project === null) {
        admin_flash('error', 'That project no longer exists.');
        admin_redirect('/admin/projects.php');
    }
    $form = array_merge($form, $project);
}

$adminTitle = match ($action) { 'new' => 'Add a project', 'edit' => 'Edit project', default => 'Projects' };
require dirname(__DIR__) . '/includes/admin-layout.php';
?>

<?php if ($action === 'new' || $action === 'edit'): ?>

  <div class="admin-head">
    <h1 class="admin-h1"><?= e($adminTitle) ?></h1>
    <a class="btn btn-outline btn-sm" href="/admin/projects.php">Cancel</a>
  </div>

  <?php foreach ($errors as $error): ?>
    <div class="alert alert-error" role="alert"><?= e($error) ?></div>
  <?php endforeach; ?>

  <form method="post" enctype="multipart/form-data" class="admin-form admin-panel">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="id" value="<?= e($editId) ?>">

    <div class="form-grid">
      <div class="field field-full">
        <label for="title">Project title <span class="req">*</span></label>
        <input type="text" id="title" name="title" required maxlength="120" value="<?= e($form['title']) ?>"
               placeholder="Four-bedroom villa move, Al Barsha to Al Nahda">
      </div>

      <div class="field field-full">
        <label for="title_ar">Project title in Arabic <span class="field-hint">(optional)</span></label>
        <input type="text" id="title_ar" name="title_ar" maxlength="120" dir="rtl" value="<?= e($form['title_ar']) ?>">
        <span class="field-hint">Left empty, the Arabic page shows the English title.</span>
      </div>

      <div class="field">
        <label for="location">Location <span class="req">*</span></label>
        <input type="text" id="location" name="location" required maxlength="80"
               value="<?= e($form['location']) ?>" placeholder="Al Barsha, Dubai">
      </div>

      <div class="field">
        <label for="completed_at">Completed</label>
        <input type="date" id="completed_at" name="completed_at" value="<?= e($form['completed_at']) ?>">
      </div>

      <div class="field field-full">
        <label for="service">Service used</label>
        <select id="service" name="service">
          <option value="">Not tied to one service</option>
          <?php foreach ($services as $slug => $service): ?>
            <option value="<?= e($slug) ?>"<?= $form['service'] === $slug ? ' selected' : '' ?>>
              <?= e($service['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="field field-full">
        <label for="summary">Short summary <span class="req">*</span></label>
        <textarea id="summary" name="summary" rows="2" required maxlength="300"
                  placeholder="What the job was, in a sentence or two."><?= e($form['summary']) ?></textarea>
        <span class="field-hint">Shown on the projects grid. Keep it under about 30 words.</span>
      </div>

      <div class="field field-full">
        <label for="summary_ar">Short summary in Arabic <span class="field-hint">(optional)</span></label>
        <textarea id="summary_ar" name="summary_ar" rows="2" maxlength="300" dir="rtl"><?= e($form['summary_ar']) ?></textarea>
      </div>

      <div class="field field-full">
        <label for="body">Full description <span class="field-hint">(optional)</span></label>
        <textarea id="body" name="body" rows="6" maxlength="4000"
                  placeholder="What made the job worth writing up — the access, the contents, how it was handled."><?= e($form['body']) ?></textarea>
        <span class="field-hint">Blank lines start a new paragraph.</span>
      </div>

      <div class="field field-full">
        <label for="body_ar">Full description in Arabic <span class="field-hint">(optional)</span></label>
        <textarea id="body_ar" name="body_ar" rows="6" maxlength="4000" dir="rtl"><?= e($form['body_ar']) ?></textarea>
      </div>
    </div>

    <?php if (($form['images'] ?? []) !== []): ?>
      <h3 class="admin-sub">Photos</h3>
      <div class="admin-thumbs">
        <?php foreach ($form['images'] as $image): ?>
          <figure class="admin-thumb">
            <img src="<?= e(upload_url($image)) ?>" alt="" loading="lazy">
            <button type="submit" form="remove-<?= e($image) ?>" class="admin-thumb-x"
                    aria-label="Remove this photo">&times;</button>
          </figure>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="field">
      <label for="images">Add photos</label>
      <input type="file" id="images" name="images[]" accept="image/jpeg,image/png,image/webp" multiple>
      <span class="field-hint">
        JPEG, PNG or WebP, up to 6 MB each, six per project. Photos are resized and
        re-saved on upload, so large phone pictures are fine.
      </span>
    </div>

    <div class="admin-actions">
      <button type="submit" class="btn btn-primary btn-lg">
        <?= $action === 'edit' ? 'Save changes' : 'Publish project' ?>
      </button>
    </div>
  </form>

  <?php /* The remove buttons above post through these, so they are not forms
           nested inside the edit form — which is invalid HTML and silently
           drops one of them. */ ?>
  <?php foreach (($form['images'] ?? []) as $image): ?>
    <form id="remove-<?= e($image) ?>" method="post" hidden>
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <input type="hidden" name="op" value="remove-image">
      <input type="hidden" name="id" value="<?= e($editId) ?>">
      <input type="hidden" name="image" value="<?= e($image) ?>">
    </form>
  <?php endforeach; ?>

<?php else: ?>

  <div class="admin-head">
    <h1 class="admin-h1">Projects</h1>
    <a class="btn btn-primary" href="/admin/projects.php?action=new">Add a project</a>
  </div>

  <?php $projects = all_projects(); ?>
  <?php if ($projects === []): ?>
    <div class="admin-panel admin-empty">
      <p>No projects yet.</p>
      <p class="admin-muted">
        Everything you add here appears on <a href="/projects/" target="_blank" rel="noopener">the Projects page</a>
        in both languages.
      </p>
    </div>
  <?php else: ?>
    <div class="admin-panel admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr><th>Project</th><th>Location</th><th>Completed</th><th>Photos</th><th></th></tr>
        </thead>
        <tbody>
          <?php foreach ($projects as $project): ?>
            <tr>
              <td>
                <strong><?= e($project['title']) ?></strong><br>
                <span class="admin-muted"><?= e(excerpt($project['summary'] ?? '', 80)) ?></span>
              </td>
              <td><?= e($project['location'] ?? '') ?></td>
              <td><?= !empty($project['completed_at']) ? e(date('M Y', strtotime($project['completed_at']))) : '—' ?></td>
              <td><?= count($project['images'] ?? []) ?></td>
              <td class="admin-row-actions">
                <a class="btn btn-outline btn-sm" href="<?= e(project_url($project['slug'])) ?>" target="_blank" rel="noopener">View</a>
                <a class="btn btn-outline btn-sm" href="/admin/projects.php?action=edit&amp;id=<?= e($project['id']) ?>">Edit</a>
                <form method="post" class="admin-inline"
                      onsubmit="return confirm('Delete this project and its photos? This cannot be undone.');">
                  <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="op" value="delete">
                  <input type="hidden" name="id" value="<?= e($project['id']) ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

<?php endif; ?>

<?php require dirname(__DIR__) . '/includes/admin-foot.php';

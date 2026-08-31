<?php
/**
 * Review moderation.
 *
 * Reviews arrive from the public form as `pending` and stay invisible on the
 * site until they are approved here. That is not friction for its own sake:
 * an unmoderated review form is a spam target, and Review structured data
 * built from unchecked submissions is exactly what Google's guidelines mean by
 * misleading. Approving is one click.
 */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';
require_once dirname(__DIR__) . '/includes/content.php';

admin_require_login();

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        admin_flash('error', 'Your session expired. Please try again.');
        admin_redirect('/admin/reviews.php');
    }

    $id     = (string) ($_POST['id'] ?? '');
    $op     = (string) ($_POST['op'] ?? '');
    $review = store_find('reviews', $id);
    $back   = '/admin/reviews.php?status=' . urlencode((string) ($_POST['back'] ?? REVIEW_PENDING));

    if ($review === null) {
        admin_flash('error', 'That review no longer exists.');
        admin_redirect($back);
    }

    switch ($op) {
        case 'approve':
            store_update('reviews', $id, ['status' => REVIEW_APPROVED, 'moderated_by' => admin_username()]);
            admin_flash('success', 'Review published. It now appears on the reviews page and the homepage.');
            break;

        case 'reject':
            store_update('reviews', $id, ['status' => REVIEW_REJECTED, 'moderated_by' => admin_username()]);
            admin_flash('success', 'Review rejected. It stays here but is never shown on the site.');
            break;

        case 'unpublish':
            store_update('reviews', $id, ['status' => REVIEW_PENDING, 'moderated_by' => admin_username()]);
            admin_flash('success', 'Review taken off the site and put back in the queue.');
            break;

        case 'delete':
            store_delete('reviews', $id);
            admin_flash('success', 'Review deleted permanently.');
            break;
    }

    admin_redirect($back);
}

$status = (string) ($_GET['status'] ?? REVIEW_PENDING);
if (!in_array($status, [REVIEW_PENDING, REVIEW_APPROVED, REVIEW_REJECTED], true)) {
    $status = REVIEW_PENDING;
}

$rows = reviews_by_status($status);
usort($rows, static fn (array $a, array $b): int
    => strcmp((string) ($b['created_at'] ?? ''), (string) ($a['created_at'] ?? '')));

$counts = [
    REVIEW_PENDING  => count(reviews_by_status(REVIEW_PENDING)),
    REVIEW_APPROVED => count(reviews_by_status(REVIEW_APPROVED)),
    REVIEW_REJECTED => count(reviews_by_status(REVIEW_REJECTED)),
];

$adminTitle = 'Reviews';
require dirname(__DIR__) . '/includes/admin-layout.php';
?>

<h1 class="admin-h1">Reviews</h1>

<div class="admin-tabs" role="tablist">
  <?php foreach ([
      REVIEW_PENDING  => 'Waiting',
      REVIEW_APPROVED => 'Published',
      REVIEW_REJECTED => 'Rejected',
  ] as $key => $label): ?>
    <a class="admin-tab<?= $status === $key ? ' is-current' : '' ?>"
       href="/admin/reviews.php?status=<?= e($key) ?>">
      <?= e($label) ?> <span class="admin-tab-n"><?= (int) $counts[$key] ?></span>
    </a>
  <?php endforeach; ?>
</div>

<?php if ($rows === []): ?>
  <div class="admin-panel admin-empty">
    <?php if ($status === REVIEW_PENDING): ?>
      <p>Nothing waiting.</p>
      <p class="admin-muted">
        New reviews from <a href="/reviews/" target="_blank" rel="noopener">the reviews page</a> land here first.
      </p>
    <?php else: ?>
      <p>Nothing here yet.</p>
    <?php endif; ?>
  </div>
<?php else: ?>
  <div class="admin-reviews">
    <?php foreach ($rows as $review): ?>
      <article class="admin-review">
        <header class="admin-review-head">
          <div>
            <strong><?= e($review['name']) ?></strong>
            <?php if (!empty($review['city'])): ?>
              <span class="admin-muted">· <?= e($review['city']) ?></span>
            <?php endif; ?>
            <?php if (!empty($review['service'])): ?>
              <span class="admin-muted">· <?= e($review['service']) ?></span>
            <?php endif; ?>
          </div>
          <div class="admin-review-stars" role="img"
               aria-label="<?= (int) $review['rating'] ?> out of 5">
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <?= icon('star', 'icon icon-sm' . ($i <= (int) $review['rating'] ? '' : ' is-empty')) ?>
            <?php endfor; ?>
          </div>
        </header>

        <blockquote><?= nl2br(e($review['quote'])) ?></blockquote>

        <footer class="admin-review-foot">
          <span class="admin-muted">
            <?= e(date('j M Y, H:i', strtotime((string) $review['created_at']))) ?>
            <?php if (!empty($review['email'])): ?>
              · <?= e($review['email']) ?>
            <?php endif; ?>
            <?php if (!empty($review['phone'])): ?>
              · <?= e($review['phone']) ?>
            <?php endif; ?>
          </span>

          <span class="admin-review-actions">
            <?php foreach (array_filter([
                $status !== REVIEW_APPROVED ? ['approve',   'Publish',    'btn-primary'] : null,
                $status === REVIEW_APPROVED ? ['unpublish', 'Unpublish',  'btn-outline'] : null,
                $status !== REVIEW_REJECTED ? ['reject',    'Reject',     'btn-outline'] : null,
                                              ['delete',    'Delete',     'btn-danger'],
            ]) as [$op, $label, $class]): ?>
              <form method="post" class="admin-inline"
                    <?= $op === 'delete' ? 'onsubmit="return confirm(\'Delete this review permanently?\');"' : '' ?>>
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <input type="hidden" name="op" value="<?= e($op) ?>">
                <input type="hidden" name="id" value="<?= e($review['id']) ?>">
                <input type="hidden" name="back" value="<?= e($status) ?>">
                <button type="submit" class="btn <?= e($class) ?> btn-sm"><?= e($label) ?></button>
              </form>
            <?php endforeach; ?>
          </span>
        </footer>
      </article>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php require dirname(__DIR__) . '/includes/admin-foot.php';

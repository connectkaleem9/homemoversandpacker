<?php
/** Dashboard: what needs attention, and the way in to everything else. */

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once dirname(__DIR__) . '/includes/admin.php';
require_once dirname(__DIR__) . '/includes/content.php';

admin_require_login();

$projects  = all_projects();
$pending   = reviews_by_status(REVIEW_PENDING);
$approved  = approved_reviews();
$rejected  = reviews_by_status(REVIEW_REJECTED);
$average   = reviews_average();

$adminTitle = 'Dashboard';
require dirname(__DIR__) . '/includes/admin-layout.php';
?>

<h1 class="admin-h1">Dashboard</h1>

<div class="admin-stats">
  <a class="admin-stat" href="/admin/projects.php">
    <span class="admin-stat-n"><?= count($projects) ?></span>
    <span class="admin-stat-l">Projects published</span>
  </a>
  <a class="admin-stat<?= $pending ? ' is-attention' : '' ?>" href="/admin/reviews.php?status=pending">
    <span class="admin-stat-n"><?= count($pending) ?></span>
    <span class="admin-stat-l">Reviews waiting</span>
  </a>
  <a class="admin-stat" href="/admin/reviews.php?status=approved">
    <span class="admin-stat-n"><?= count($approved) ?></span>
    <span class="admin-stat-l">Reviews published</span>
  </a>
  <div class="admin-stat">
    <span class="admin-stat-n"><?= $average !== null ? e(number_format($average, 1)) : '—' ?></span>
    <span class="admin-stat-l">Average rating</span>
  </div>
</div>

<?php if ($pending !== []): ?>
  <section class="admin-panel">
    <h2>Waiting for you</h2>
    <p class="admin-muted">
      Nothing a customer submits appears on the site until you approve it here.
    </p>
    <ul class="admin-list">
      <?php foreach (array_slice($pending, 0, 5) as $review): ?>
        <li>
          <strong><?= e($review['name']) ?></strong>
          <?= $review['city'] ? '· ' . e($review['city']) : '' ?>
          <span class="admin-muted">— <?= e(excerpt($review['quote'], 90)) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
    <a class="btn btn-primary" href="/admin/reviews.php?status=pending">Review them</a>
  </section>
<?php endif; ?>

<section class="admin-panel">
  <h2>Recent projects</h2>
  <?php if ($projects === []): ?>
    <p class="admin-muted">No projects yet. Add the first one and it appears on the Projects page.</p>
    <a class="btn btn-primary" href="/admin/projects.php?action=new">Add a project</a>
  <?php else: ?>
    <ul class="admin-list">
      <?php foreach (array_slice($projects, 0, 5) as $project): ?>
        <li>
          <strong><?= e($project['title']) ?></strong>
          <span class="admin-muted">
            <?= e($project['location'] ?? '') ?>
            <?= !empty($project['completed_at']) ? '· ' . e(date('M Y', strtotime($project['completed_at']))) : '' ?>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
    <a class="btn btn-outline" href="/admin/projects.php">Manage projects</a>
  <?php endif; ?>
</section>

<?php require dirname(__DIR__) . '/includes/admin-foot.php';

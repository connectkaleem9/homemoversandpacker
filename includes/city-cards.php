<?php
/**
 * The three emirate cards. Optionally set before including:
 *
 *   $cityExclude      — slug to leave out (a location page does not link to itself)
 *   $cityExtra        — true to append an "all services" card, keeping the row at three
 *   $cityAlt          — alt-text prefix, when the context is a specific service
 */

declare(strict_types=1);

$cityExclude = $cityExclude ?? '';
$cityExtra   = $cityExtra   ?? false;
$cityAlt     = $cityAlt     ?? '';
?>
<div class="city-cards">
  <?php foreach (all_locations() as $ccSlug => $ccCity): ?>
    <?php if ($ccSlug === $cityExclude) { continue; } ?>
    <a class="city-card" href="<?= e(location_url($ccSlug)) ?>">
      <span class="city-card-media">
        <?= img('locations/' . $ccSlug . '.webp',
                ($cityAlt !== '' ? $cityAlt : SITE_NAME) . ' — ' . $ccCity['name'] . ', UAE',
                ['width' => 900, 'height' => 600, 'icon' => 'building']) ?>
      </span>
      <span class="city-card-body">
        <h3><?= e(t('nav.movers_in', ['city' => $ccCity['name']])) ?></h3>
        <p><?= e($ccCity['short']) ?></p>
        <span class="card-link"><?= e(t('cta.learn_more')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
      </span>
    </a>
  <?php endforeach; ?>

  <?php if ($cityExtra): ?>
    <a class="city-card" href="<?= e(lang_url('/services/')) ?>">
      <span class="city-card-media">
        <?= img('why-choose-us.jpg', e(t('sec.services')), ['width' => 900, 'height' => 600, 'icon' => 'box']) ?>
      </span>
      <span class="city-card-body">
        <h3><?= e(t('city.all_title')) ?></h3>
        <p><?= e(t('city.all_text')) ?></p>
        <span class="card-link"><?= e(t('cta.view_services')) ?> <?= icon('arrow', 'icon icon-sm') ?></span>
      </span>
    </a>
  <?php endif; ?>
</div>
<?php unset($cityExclude, $cityExtra, $cityAlt);

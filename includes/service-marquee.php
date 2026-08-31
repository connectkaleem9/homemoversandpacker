<?php
/**
 * Continuously sliding strip of service tiles.
 *
 * Set $marqueeServices to a list of service slugs before including. A final
 * "and more" tile linking to the services index is appended automatically.
 *
 * The tile set is rendered TWICE. The animation travels exactly one group's
 * width and then repeats, so the second copy is what fills the gap the first
 * one leaves behind — without it the strip would visibly jump back. The copy
 * is aria-hidden and its links are removed from the tab order, so a screen
 * reader and a keyboard user each meet every service exactly once.
 */

declare(strict_types=1);

$mqServices = all_services();
$mqSlugs    = array_values(array_filter(
    $marqueeServices ?? [],
    static fn (string $slug): bool => isset($mqServices[$slug])
));

if ($mqSlugs === []) {
    return;
}
?>
<div class="service-marquee" data-marquee>
  <div class="service-marquee-track">
    <?php foreach ([false, true] as $mqClone): ?>
      <div class="service-marquee-group"<?= $mqClone ? ' aria-hidden="true"' : '' ?>>
        <?php foreach ($mqSlugs as $mqSlug): $mqService = $mqServices[$mqSlug]; ?>
          <a class="service-tile" href="<?= e(service_url($mqSlug)) ?>"<?= $mqClone ? ' tabindex="-1"' : '' ?>>
            <span class="service-tile-icon"><?= service_icon($mqService['icon']) ?></span>
            <h3><?= e($mqService['name']) ?></h3>
            <p><?= e($mqService['tile']) ?></p>
          </a>
        <?php endforeach; ?>

        <a class="service-tile" href="<?= e(lang_url('/services/')) ?>"<?= $mqClone ? ' tabindex="-1"' : '' ?>>
          <span class="service-tile-icon"><?= service_icon('truck') ?></span>
          <h3><?= e(t('sec.and_more')) ?></h3>
          <p><?= e(t('sec.and_more_text')) ?></p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php unset($marqueeServices, $mqServices, $mqSlugs, $mqClone, $mqSlug, $mqService);

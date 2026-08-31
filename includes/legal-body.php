<?php
/**
 * Renders one document from includes/data/legal.php.
 *
 * Set $legalDoc to 'privacy' or 'terms' before including.
 *
 * The prose lives in the data file as typed blocks so the English and Arabic
 * versions stay structurally identical. Tokens in {braces} are substituted
 * here, which is also where the phone, email and privacy-policy links are
 * built — the data file holds no markup at all.
 */

declare(strict_types=1);

/** @var string $legalDoc */
$legalDocument = lang_data('legal')[$legalDoc] ?? null;

if ($legalDocument === null) {
    return;
}

$legalTokens = [
    '{brand}'   => e(BUSINESS_NAME),
    '{domain}'  => e(SITE_DOMAIN),
    '{address}' => e(business_address()),
    '{areas}'   => e(areas_sentence()),
    '{phone}'   => '<a href="' . PHONE_LINK . '">' . e(PHONE_DISPLAY) . '</a>',
    '{email}'   => '<a href="mailto:' . e(EMAIL_ADDRESS) . '">' . e(EMAIL_ADDRESS) . '</a>',
    '{privacy}' => '<a href="' . e(lang_url('/privacy-policy/')) . '">' . e(t('foot.privacy')) . '</a>',
];

/** Escape the text, then swap the tokens in for their (already safe) markup. */
$legalText = static fn (string $text): string
    => strtr(e($text), $legalTokens);
?>
<section class="section">
  <div class="container container-narrow prose">
    <h1><?= e($legalDocument['h1']) ?></h1>
    <p><strong><?= e(t('legal.updated')) ?></strong> <?= e(format_date(new DateTimeImmutable())) ?></p>

    <?php foreach ($legalDocument['blocks'] as [$legalType, $legalContent]): ?>
      <?php switch ($legalType):
          case 'h2': ?>
            <h2><?= e($legalContent) ?></h2>
          <?php break;

          case 'h3': ?>
            <h3><?= e($legalContent) ?></h3>
          <?php break;

          case 'p': ?>
            <p><?= $legalText($legalContent) ?></p>
          <?php break;

          case 'ul': ?>
            <ul>
              <?php foreach ($legalContent as $legalItem): ?>
                <li><?= $legalText($legalItem) ?></li>
              <?php endforeach; ?>
            </ul>
          <?php break;

          case 'note': ?>
            <div class="panel panel-accent" style="margin-bottom: var(--sp-6);">
              <p style="margin:0; font-size: var(--fs-sm);"><?= $legalText($legalContent) ?></p>
            </div>
          <?php break;

          /* A clause the business has still to decide on and have reviewed. */
          case 'placeholder': ?>
            <p><em>[<?= $legalText($legalContent) ?>]</em></p>
          <?php break;
      endswitch; ?>
    <?php endforeach; ?>
  </div>
</section>
<?php unset($legalDoc, $legalDocument, $legalTokens, $legalText);

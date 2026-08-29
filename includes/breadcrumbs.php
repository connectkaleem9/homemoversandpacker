<?php
/**
 * Visible breadcrumb trail. The same array feeds BreadcrumbList schema,
 * so the markup and the structured data can never drift apart.
 */

declare(strict_types=1);

function breadcrumbs_render(?array $trail = null): string
{
    $trail = $trail ?? (array) seo_get('breadcrumbs', []);
    if (count($trail) < 2) {
        return '';
    }

    $html  = '<nav class="breadcrumbs" aria-label="Breadcrumb"><div class="container">';
    $html .= '<ol class="breadcrumb-list">';

    $last = count($trail) - 1;
    foreach (array_values($trail) as $i => $crumb) {
        $html .= '<li class="breadcrumb-item">';
        if ($i === $last || empty($crumb['url'])) {
            $html .= '<span aria-current="page">' . e($crumb['label']) . '</span>';
        } else {
            $html .= '<a href="' . e(url($crumb['url'])) . '">' . e($crumb['label']) . '</a>';
            $html .= '<span class="breadcrumb-sep" aria-hidden="true">/</span>';
        }
        $html .= '</li>';
    }

    $html .= '</ol></div></nav>';
    return $html;
}

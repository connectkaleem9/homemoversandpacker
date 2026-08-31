<?php
/**
 * Structured data (JSON-LD).
 *
 * Everything emitted here is factual and matches visible page content.
 * Deliberately absent: aggregateRating, review, openingHours, priceRange,
 * geo coordinates, awards and certifications — none of that data has been
 * supplied by the business, and inventing it would breach Google's guidelines.
 */

declare(strict_types=1);

/** The organisation node, referenced by @id from every other node. */
function schema_organisation(): array
{
    return [
        '@type'       => 'MovingCompany',
        '@id'         => CANONICAL_BASE . '/#organization',
        'name'        => BUSINESS_NAME,
        'url'         => CANONICAL_BASE . '/',
        'telephone'   => PHONE_E164,
        'email'       => EMAIL_ADDRESS,
        'address'     => [
            '@type'           => 'PostalAddress',
            'addressLocality' => BUSINESS_CITY,
            'addressRegion'   => BUSINESS_REGION,
            'addressCountry'  => BUSINESS_COUNTRY,
        ],
        'areaServed'  => array_map(
            static fn (string $city): array => ['@type' => 'City', 'name' => $city],
            areas_list()
        ),
        /*
         * One business, one @id, in both languages — the organisation is the
         * same entity whichever page references it. Only the human-readable
         * fields follow the page's language.
         */
        'description' => t('foot.about', [
            'address' => business_address(),
            'areas'   => areas_sentence(),
        ]),
    ];
}

/** The website node. */
function schema_website(): array
{
    return [
        '@type'     => 'WebSite',
        '@id'       => CANONICAL_BASE . '/#website',
        'url'       => CANONICAL_BASE . '/',
        'name'      => SITE_NAME,
        'publisher' => ['@id' => CANONICAL_BASE . '/#organization'],
        'inLanguage'=> lang_locale(),
    ];
}

/** The current page node. */
function schema_webpage(): array
{
    $node = [
        '@type'      => 'WebPage',
        '@id'        => seo_canonical() . '#webpage',
        'url'        => seo_canonical(),
        'name'       => seo_title(),
        'isPartOf'   => ['@id' => CANONICAL_BASE . '/#website'],
        'about'      => ['@id' => CANONICAL_BASE . '/#organization'],
        'inLanguage' => lang_locale(),
    ];
    if (seo_description() !== '') {
        $node['description'] = seo_description();
    }
    return $node;
}

/** BreadcrumbList built from the trail the page defined. */
function schema_breadcrumbs(array $trail): ?array
{
    if (count($trail) < 2) {
        return null;
    }
    $items = [];
    foreach (array_values($trail) as $i => $crumb) {
        $item = [
            '@type'    => 'ListItem',
            'position' => $i + 1,
            'name'     => $crumb['label'],
        ];
        if (!empty($crumb['url'])) {
            $item['item'] = canonical($crumb['url']);   // language-aware
        }
        $items[] = $item;
    }
    return [
        '@type'           => 'BreadcrumbList',
        '@id'             => seo_canonical() . '#breadcrumb',
        'itemListElement' => $items,
    ];
}

/**
 * FAQPage node. Only ever called with the exact question/answer pairs that
 * are rendered visibly on the same page.
 */
function schema_faq(array $faqs): ?array
{
    if ($faqs === []) {
        return null;
    }
    $entities = [];
    foreach ($faqs as $faq) {
        $entities[] = [
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ],
        ];
    }
    return [
        '@type'      => 'FAQPage',
        '@id'        => seo_canonical() . '#faq',
        'mainEntity' => $entities,
    ];
}

/** Service node for a service page. */
function schema_service(array $service): array
{
    return [
        '@type'           => 'Service',
        '@id'             => seo_canonical() . '#service',
        'name'            => $service['name'],
        'description'     => $service['short'],
        'serviceType'     => $service['name'],
        'provider'        => ['@id' => CANONICAL_BASE . '/#organization'],
        'areaServed'      => array_map(
            static fn (string $city): array => ['@type' => 'City', 'name' => $city],
            areas_list()
        ),
        'url'             => seo_canonical(),
    ];
}

/**
 * Review and AggregateRating nodes.
 *
 * Only ever called with reviews an admin has approved, and only when there is
 * at least one — an aggregateRating with no reviews behind it is exactly the
 * kind of claim Google's structured data guidelines prohibit, and it is the
 * reason this site shipped without any rating markup at all until now.
 */
function schema_reviews(array $reviews, float $average): array
{
    $nodes = [];
    foreach ($reviews as $review) {
        $nodes[] = [
            '@type'         => 'Review',
            'author'        => ['@type' => 'Person', 'name' => $review['name']],
            'datePublished' => substr((string) $review['created_at'], 0, 10),
            'reviewBody'    => $review['quote'],
            'reviewRating'  => [
                '@type'       => 'Rating',
                'ratingValue' => (int) $review['rating'],
                'bestRating'  => 5,
                'worstRating' => 1,
            ],
        ];
    }

    return [
        '@type'           => 'MovingCompany',
        '@id'             => CANONICAL_BASE . '/#organization',
        'name'            => BUSINESS_NAME,
        'aggregateRating' => [
            '@type'       => 'AggregateRating',
            'ratingValue' => $average,
            'reviewCount' => count($reviews),
            'bestRating'  => 5,
            'worstRating' => 1,
        ],
        'review'          => $nodes,
    ];
}

/** BlogPosting node for an article. */
function schema_article(array $post): array
{
    return [
        '@type'            => 'BlogPosting',
        '@id'              => seo_canonical() . '#article',
        'headline'         => $post['title_h1'] ?? $post['title'],
        'description'      => $post['description'],
        'datePublished'    => $post['published'],
        'dateModified'     => $post['modified'] ?? $post['published'],
        'author'           => ['@id' => CANONICAL_BASE . '/#organization'],
        'publisher'        => ['@id' => CANONICAL_BASE . '/#organization'],
        'mainEntityOfPage' => ['@id' => seo_canonical() . '#webpage'],
        'inLanguage'       => lang_locale(),
    ];
}

/**
 * Assemble and render the full @graph for the current page.
 * Page-specific nodes are passed through seo_set(['schema' => [...]]).
 */
function schema_render(): string
{
    $graph = [
        schema_organisation(),
        schema_website(),
        schema_webpage(),
    ];

    $breadcrumbs = schema_breadcrumbs((array) seo_get('breadcrumbs', []));
    if ($breadcrumbs !== null) {
        $graph[] = $breadcrumbs;
    }

    foreach ((array) seo_get('schema', []) as $node) {
        if (is_array($node) && $node !== []) {
            $graph[] = $node;
        }
    }

    return '<script type="application/ld+json">'
        . json_ld(['@context' => 'https://schema.org', '@graph' => $graph])
        . '</script>';
}

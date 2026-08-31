<?php
/**
 * English UI strings. The reference file — every key must exist here, since
 * t() falls back to English when a translation is missing.
 *
 * Page content lives in includes/data/, not here. This is only chrome:
 * navigation, buttons, form labels, section headings shared across pages.
 */

declare(strict_types=1);

return [
    /* Navigation */
    'nav.home'            => 'Home',
    'nav.services'        => 'Services',
    'nav.locations'       => 'Locations',
    'nav.about'           => 'About Us',
    'nav.blog'            => 'Blog',
    'nav.contact'         => 'Contact Us',
    'nav.open_menu'       => 'Open menu',
    'nav.close_menu'      => 'Close menu',
    'nav.view_all'        => 'View all services',
    'nav.movers_in'       => 'Movers in {city}',
    'nav.skip'            => 'Skip to main content',
    'nav.switch_language' => 'العربية',
    'nav.switch_aria'     => 'Switch to Arabic',

    /* Calls to action */
    'cta.call'            => 'Call {phone}',
    'cta.call_now'        => 'Call Now',
    'cta.whatsapp'        => 'WhatsApp Us',
    'cta.quote'           => 'Get a Free Quote',
    'cta.quote_long'      => 'Get a Free Moving Quote',
    'cta.learn_more'      => 'Learn more',
    'cta.read_guide'      => 'Read the guide',
    'cta.read_more'       => 'Read More',
    'cta.view_services'   => 'View All Services',
    'cta.more_about'      => 'More about us',
    'cta.home'            => 'Go to the homepage',

    /* Topbar and header */
    'top.trusted'         => 'Your trusted movers & packers in {areas}',
    'top.call_label'      => 'Call us now',

    /* Shared section headings */
    'sec.services'        => 'Our Moving Services',
    'sec.process'         => 'Our Moving Process',
    'sec.why'             => 'Why Choose Us',
    'sec.serve'           => 'We Serve',
    'sec.reviews'         => 'What Our Customers Say',
    'sec.faq'             => 'Frequently asked questions',
    'sec.where'           => 'Where We Work',
    'sec.related'         => 'Related Services',
    'sec.and_more'        => 'And More Services',
    'sec.and_more_text'   => 'Loading, assembly, local moving and car transport.',
    'sec.choose_emirate'  => 'Choose Your Emirate',
    'sec.blog'            => 'Latest From Our Blog',
    'sec.more_guides'     => 'More Moving Guides',

    /* Gold CTA band */
    'band.title'          => 'Planning a Move? Get Your Free Quote Today!',
    'band.sub'            => 'Quick, easy and obligation-free.',

    /* Quote form */
    'form.quote_title'    => 'Get a Free Moving Quote',
    'form.quote_intro'    => 'Tell us about your move and we will come back with a clear, specific quotation — no obligation.',
    'form.mini_title'     => 'Need a Moving Quote?',
    'form.mini_intro'     => 'Fill out the form and our team will get back to you shortly.',
    'form.name'           => 'Your name',
    'form.phone'          => 'Phone number',
    'form.email'          => 'Email',
    'form.email_opt'      => '(optional)',
    'form.from'           => 'Moving from',
    'form.to'             => 'Moving to',
    'form.area_ph'        => 'Area, emirate',
    'form.property'       => 'Property type',
    'form.property_ph'    => 'Select property type',
    'form.date'           => 'Preferred moving date',
    'form.service'        => 'Service required',
    'form.service_ph'     => 'Select a service',
    'form.not_sure'       => 'Not sure — please advise',
    'form.details'        => 'Additional details',
    'form.details_hint'   => '(items, floors, lift access, packing needed)',
    'form.details_ph'     => 'e.g. 2 bedroom apartment, 5th floor with lift, need packing for the kitchen',
    'form.submit'         => 'Get My Free Quote',
    'form.submit_short'   => 'Get a Free Quote',
    'form.legal'          => 'We use your details only to prepare and discuss your moving quote. See our',
    'form.privacy'        => 'Privacy Policy',
    'form.prefer_talk'    => 'Prefer to talk?',
    'form.required'       => 'Required fields are marked.',

    /* Message form */
    'msg.title'           => 'Send Us a Message',
    'msg.intro'           => 'Not ready for a quote? Ask a question and we will get back to you.',
    'msg.subject'         => 'Subject',
    'msg.message'         => 'Your message',
    'msg.contact_hint'    => 'Give us a phone number or an email so we can reply.',
    'msg.submit'          => 'Send Message',

    /* Form feedback */
    'flash.success_title' => 'Thank you — your request has been received.',
    'flash.error_title'   => 'We could not send your request.',
    'flash.msg_received'  => 'Message received.',
    'flash.msg_error'     => 'We could not send your message.',

    /* Footer */
    'foot.services'       => 'Services',
    'foot.locations'      => 'Locations',
    'foot.company'        => 'Company',
    'foot.contact'        => 'Contact',
    'foot.and_more'       => 'And more services',
    'foot.about'          => 'Movers and packers based in {address}, providing home, villa, apartment, office and commercial moving with packing, storage and furniture services across {areas}.',
    'foot.note'           => 'Serving {areas}. Contact us for a free, no-obligation moving quote.',
    'foot.rights'         => 'All rights reserved.',
    'foot.privacy'        => 'Privacy Policy',
    'foot.terms'          => 'Terms & Conditions',
    'foot.sitemap'        => 'Sitemap',
    'foot.whatsapp_us'    => 'WhatsApp us',

    /* Mobile bar */
    'bar.call'            => 'Call Now',
    'bar.whatsapp'        => 'WhatsApp',
    'bar.quote'           => 'Get Quote',
    'bar.aria'            => 'Contact actions',

    /* Breadcrumbs */
    'crumb.home'          => 'Home',
    'crumb.services'      => 'Services',
    'crumb.locations'     => 'Locations',
    'crumb.blog'          => 'Blog',
    'crumb.aria'          => 'Breadcrumb',

    /* 404 */
    '404.title'           => 'We Could Not Find That Page',
    '404.text'            => 'The page may have moved or the link may be incomplete. Everything below is still where it should be — or call us and we will point you in the right direction.',

    /* WhatsApp prefilled messages */
    'wa.default'          => 'Hello, I need a moving quote.',
    'wa.city'             => 'Hello, I need a moving quote in {city}.',
    'wa.service'          => 'Hello, I need {service} in Dubai, Sharjah or Ajman.',
    'wa.question'         => 'Hello, I have a question about moving.',

    /* Property types — the option VALUE posted to the server stays English */
    'prop.studio'         => 'Studio',
    'prop.1br'            => '1 Bedroom Apartment',
    'prop.2br'            => '2 Bedroom Apartment',
    'prop.3br'            => '3+ Bedroom Apartment',
    'prop.townhouse'      => 'Townhouse',
    'prop.villa'          => 'Villa',
    'prop.office'         => 'Office',
    'prop.retail'         => 'Shop / Retail',
    'prop.storage'        => 'Storage only',
    'prop.other'          => 'Other',

    /* Field validation */
    'err.name'            => 'Please enter your name.',
    'err.phone_missing'   => 'Please enter a phone number so we can reach you.',
    'err.phone_invalid'   => 'Enter a valid UAE mobile number, e.g. 055 658 1781.',
    'err.email'           => 'Enter a valid email address, or leave the field empty.',
    'err.from'            => 'Tell us where you are moving from.',
    'err.to'              => 'Tell us where you are moving to.',
    'err.date'            => 'Please choose a valid date.',
    'err.message'         => 'Please tell us a little more so we can help.',
    'err.reach'           => 'Give us either a phone number or an email address so we can reply.',
    'err.check_form'      => 'Please check the highlighted fields and send the form again.',
    'err.check_message'   => 'Please check the highlighted fields and send the message again.',

    /* Submission outcomes */
    'lead.soon'           => 'We will get back to you shortly.',
    'lead.expired'        => 'Your session expired before the form was sent. Please try again, or call us on {phone}.',
    'lead.rate'           => 'Too many requests from this connection. Please wait a few minutes, or call us on {phone}.',
    'lead.store_failed'   => 'Something went wrong on our side. Please call or WhatsApp us on {phone} and we will take your details directly.',
    'lead.quote_ok'       => 'We have your details and will come back to you with a quotation. If your move is urgent, call or WhatsApp us on {phone}.',
    'lead.message_ok'     => 'Thanks for your message — we will reply shortly. For anything urgent, call or WhatsApp {phone}.',

    'msg.legal'           => 'We use your details only to reply to your enquiry. See our',

    /* Placeholder review cards — local preview only, never served in production */
    'example.name'        => 'Example Customer',
    'example.source'      => 'Example',
    'example.quote1'      => 'Example text so the card layout can be checked. Replace with a real customer review before going live.',
    'example.quote2'      => 'Placeholder two. Copy your genuine Google reviews into includes/data/testimonials.php.',
    'example.quote3'      => 'Placeholder three, here only to show the card design. It never appears on the live site.',

    /* Projects and reviews */
    'nav.projects'        => 'Projects',
    'nav.reviews'         => 'Reviews',
    'cta.view_project'    => 'See the job',
    'cta.write_review'    => 'Write a review',

    'form.rating'         => 'Your rating',
    'form.rating_of'      => '{n} out of 5',
    'form.city'           => 'Your area',
    'form.service_used'   => 'Which service did we do for you?',
    'form.review'         => 'Your review',
    'form.review_ph'      => 'What did we move, and how did the day go? The specifics are what help the next customer.',
    'form.review_submit'  => 'Submit my review',
    'form.review_legal'   => 'We publish your first name, your area and your review. Your email and phone stay private and are only used to check the review is genuine. See our',
    'form.review_contact_hint' => 'Give us an email or a phone number so we can confirm the review is genuine. Neither is ever published.',

    'err.rating'          => 'Choose a rating from 1 to 5 stars.',
    'err.review_short'    => 'Please write a little more — at least a sentence or two.',
    'err.review_contact'  => 'Give us either an email or a phone number so we can verify the review.',
    'err.check_review'    => 'Please check the highlighted fields and send the review again.',

    'flash.review_thanks' => 'Thank you for writing this.',
    'lead.review_ok'      => 'Your review has been received. We check every review is genuine before it goes on the site, so it will appear shortly.',

    /* Misc */
    'misc.list_sep'       => ', ',
    'misc.list_and'       => ' and ',
    'misc.address'        => 'Sharjah, UAE',
    'misc.published'      => 'Published',
    'misc.updated'        => 'Updated',
    'misc.areas_served'   => 'Areas we serve',
    'misc.based_in'       => 'Based in {address}',
    'misc.free_quote'     => 'Free quotation, no obligation',
    'misc.careful'        => 'Careful handling throughout',
];

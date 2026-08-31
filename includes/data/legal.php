<?php
/**
 * Privacy Policy and Terms & Conditions, as structured documents.
 *
 * Written as data rather than markup so the Arabic version is a straight
 * mirror (includes/data/legal.ar.php) and the two can never drift apart in
 * structure. includes/legal-body.php renders it.
 *
 * Block types: h2, h3, p, ul, note, placeholder.
 * A "placeholder" block is a clause the business still has to decide on and
 * have reviewed legally; it renders in italics so it is impossible to miss.
 *
 * Tokens filled in at render time: {brand} {domain} {address} {areas}
 * {phone} {email} {privacy}
 */

declare(strict_types=1);

return [

/* ====================================================== Privacy Policy === */
'privacy' => [
    'h1'     => 'Privacy Policy',
    'blocks' => [
        ['p',  'This policy explains what information {brand} collects through {domain}, why we collect it, and what we do with it. If anything here is unclear, call us on {phone} and ask.'],

        ['h2', 'Who we are'],
        ['p',  '{brand} is a moving company based in {address}, providing moving, packing and storage services across {areas}.'],
        ['p',  'Contact: {phone} · {email}'],

        ['h2', 'What we collect'],
        ['p',  'We only collect what we need in order to quote for and carry out a move.'],
        ['h3', 'Information you give us'],
        ['ul', [
            'Your name',
            'Your phone number',
            'Your email address, if you provide one',
            'The addresses or areas you are moving from and to',
            'Property type, preferred moving date and the service you need',
            'Any additional details you choose to include in the form or in a message',
        ]],
        ['h3', 'Information collected automatically'],
        ['ul', [
            'Your IP address and browser user-agent string, recorded with form submissions to help prevent spam and abuse',
            'Standard web server logs',
            'Usage data collected by Google Analytics — the pages you view, roughly where in the world you are, the type of device and browser you use, and how you arrived at the site',
        ]],

        ['h2', 'Why we use it'],
        ['ul', [
            'To prepare and send you a moving quotation',
            'To contact you about your enquiry and arrange your move',
            'To carry out the service you booked',
            'To protect the website and our forms from spam and automated abuse',
            'To meet any legal or accounting obligations that apply to us',
        ]],
        ['p',  'We do not sell your personal information, and we do not share it with third parties for their own marketing.'],

        ['h2', 'Cookies and analytics'],
        ['p',  'This website uses a session cookie, which is required for the security of our forms (specifically to protect against cross-site request forgery). It contains no personal information and expires when you close your browser.'],
        ['h3', 'Google Analytics'],
        ['p',  'This site uses Google Analytics 4 to understand how people find and use it — which pages are read, which are ignored, and whether the English or the Arabic side is working. Google Analytics sets its own cookies and processes that data under Google\'s privacy terms.'],
        ['p',  'We also record when someone taps a call, WhatsApp or quote button, and when a form is submitted. That tells us which parts of the site actually lead to an enquiry. These records are counts and page paths — they do not include your name, your phone number or anything you typed into a form.'],
        ['p',  'We do not use Google Analytics to identify you, we have not enabled Google Signals or advertising personalisation on the property, and we do not sell or share the data with anyone.'],
        ['p',  'You can control cookies through your browser settings, or install Google\'s official opt-out add-on, and the site works normally either way.'],

        ['h2', 'How long we keep it'],
        ['p',  'Enquiry and booking records are kept for as long as we need them to provide the service, to answer follow-up questions and to meet our record-keeping obligations, after which they are deleted.'],
        ['placeholder', 'The business should confirm a specific retention period here.'],

        ['h2', 'How we protect it'],
        ['p',  'Form submissions are transmitted over an encrypted connection, database access uses prepared statements, and access to enquiry records is limited to the people who need it in order to handle your move. No system is perfectly secure, but we do not collect information we do not need, which is the most effective protection available.'],

        ['h2', 'Your choices'],
        ['ul', [
            'You can ask us what information we hold about you',
            'You can ask us to correct anything that is wrong',
            'You can ask us to delete your enquiry record, where we are not required to keep it',
            'You can ask us to stop contacting you at any time',
        ]],
        ['p',  'To make any of these requests, call {phone} or email {email}.'],

        ['h2', 'Third-party links'],
        ['p',  'This site links to WhatsApp for messaging. Once you leave our website, the destination service\'s own privacy terms apply. We are not responsible for the content or privacy practices of external services.'],

        ['h2', 'Changes to this policy'],
        ['p',  'If we change how we handle personal information, we will update this page and the date at the top of it.'],

        ['h2', 'Contact'],
        ['p',  'Questions about this policy: {phone} · {email} · {address}'],
    ],
],

/* ================================================= Terms & Conditions === */
'terms' => [
    'h1'     => 'Terms & Conditions',
    'blocks' => [
        ['p',    'These terms apply to the use of {domain} and to quotations and bookings made with {brand}, {address}. By requesting a quotation or booking a move, you agree to them.'],
        ['note', 'Note for the business: the clauses marked in square brackets below require commercial decisions — cancellation windows, payment terms, liability limits and insurance arrangements. They should be completed and reviewed by a qualified legal adviser before this page goes live.'],

        ['h2', '1. Quotations'],
        ['p',  'Quotations are provided free of charge and without obligation. A quotation is based on the information you give us — property size, inventory, addresses, floor and lift access, dates and services required — or on what we observe during a site survey.'],
        ['p',  'Where the actual job differs materially from what was described or surveyed (for example significantly more items, restricted access we were not told about, or additional services requested on the day), the price may change. We will tell you before carrying out additional work, not afterwards.'],

        ['h2', '2. Bookings'],
        ['p',  'A booking is confirmed once we have agreed the date, scope and price with you. Please make sure the property is accessible, that any building moving permit, NOC or service lift booking required by your building management is arranged, and that parking or loading access is available for our vehicle.'],

        ['h2', '3. Your responsibilities'],
        ['ul', [
            'Tell us about anything unusually heavy, fragile, valuable or hazardous before the move',
            'Obtain any building permits, NOCs or lift bookings your building requires',
            'Remove personal documents, jewellery, cash and medication and carry them yourself',
            'Ensure someone is present, or authorised, at both addresses during the move',
            'Check that nothing is left behind before we leave the collection address',
        ]],

        ['h2', '4. Items we do not move'],
        ['p',  'We do not transport hazardous, flammable, explosive, perishable or illegal goods, or live animals. If you are unsure whether something can be moved, ask before the day.'],

        ['h2', '5. Payment'],
        ['placeholder', 'Payment terms — accepted methods, deposit requirements and when the balance is due — to be confirmed by the business.'],

        ['h2', '6. Cancellation and rescheduling'],
        ['placeholder', 'Cancellation and rescheduling terms, including any notice period and charges, to be confirmed by the business.'],
        ['p',  'Where circumstances beyond either party\'s reasonable control prevent a move going ahead — severe weather, road closures, building access being withdrawn — we will work with you to reschedule.'],

        ['h2', '7. Liability'],
        ['placeholder', 'Liability terms and any insurance arrangements to be confirmed by the business and reviewed legally. This section should state what cover applies, any limits, and the procedure and time limit for reporting a claim.'],
        ['p',  'We handle your belongings with care and protect them before moving them. Pre-existing damage, items packed by the customer, and inherent defects in an item are treated differently from damage caused during handling; the confirmed liability terms above will set this out.'],

        ['h2', '8. Reporting a problem'],
        ['p',  'If something is damaged or missing, tell us as soon as you notice it — ideally before our crew leaves the delivery address. Call {phone} or email {email}.'],

        ['h2', '9. Storage'],
        ['p',  'Where you use our storage service, items are inventoried at collection and stored for the agreed period. Storage charges, notice periods for redelivery and terms for extending the period are set out in your storage quotation.'],

        ['h2', '10. Website use'],
        ['p',  'The content of this website is provided for information. We aim to keep it accurate and current, but service descriptions are general and the specifics of your move are governed by your quotation. You may not copy or reproduce the content of this site for commercial use without permission.'],

        ['h2', '11. Privacy'],
        ['p',  'Personal information you provide is handled as described in our {privacy}.'],

        ['h2', '12. Governing law'],
        ['p',  'These terms are governed by the laws of the United Arab Emirates, and any dispute is subject to the jurisdiction of the UAE courts.'],

        ['h2', '13. Contact'],
        ['p',  '{brand} · {address} · {phone} · {email}'],
    ],
],

];

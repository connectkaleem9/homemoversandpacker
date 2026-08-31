<?php
/**
 * English page copy — the headings, paragraphs and list items that belong to a
 * specific page rather than to the site chrome.
 *
 * Kept apart from lang/en.php so that file stays a short, scannable list of
 * buttons and labels. t() merges the two; keys here are namespaced page.* and
 * tpl.* so there is no chance of a collision.
 *
 * Placeholders in {braces} are filled by t()'s second argument.
 */

declare(strict_types=1);

return [

    /* ==================================================================
     | Shared across several pages
     | ================================================================== */
    'misc.based_sharjah'   => 'Based in Sharjah',
    'misc.free_quotation'  => 'Free quotation',
    'misc.careful_handling'=> 'Careful handling',
    'misc.three_emirates'  => 'Three emirates',
    'misc.cross_emirate'   => 'Cross-emirate moves',

    'city.all_title'       => 'All moving services',
    'city.all_text'        => 'Browse the full range of residential, commercial and specialist services.',

    'band.404_title'       => 'Looking for a Moving Quote?',
    'band.404_sub'         => 'Call or WhatsApp us and we will help you directly.',
    'band.contact_title'   => 'Prefer to Just Call?',
    'band.contact_sub'     => 'We would rather talk through your move than exchange messages about it.',
    'band.between_title'   => 'Moving Between Emirates?',
    'band.between_sub'     => 'Most household moves between Dubai, Sharjah and Ajman are done in a single day.',
    'band.city_title'      => 'Moving in {city}?',
    'band.city_sub'        => 'Call or WhatsApp us with your dates and addresses — we will confirm what is available.',
    'band.service_title'   => 'Need {service}?',
    'band.service_sub'     => 'Call or WhatsApp us and we will tell you honestly what is available and what it will involve.',

    'wa.services'          => 'Hello, I would like to ask about your moving services.',
    'wa.about'             => 'Hello, I would like to know more about your moving services.',

    /* ==================================================================
     | Homepage
     | ================================================================== */
    'page.home.title'      => 'Movers and Packers in Dubai, Sharjah & Ajman',
    'page.home.desc'       => 'Movers and packers based in Sharjah, serving Dubai, Sharjah and Ajman. Home, villa, apartment and office moving with packing and storage. Call 055 658 1781.',
    'page.home.eyebrow'    => 'Safe, reliable, affordable',
    'page.home.h1'         => 'Professional Movers & Packers in Dubai, Sharjah & Ajman',
    'page.home.sub'        => 'We make your move simple, safe and stress-free — with expert packing, careful furniture handling and on-time delivery.',
    'page.home.trust1'     => 'Trained professionals',
    'page.home.trust2'     => 'Safe & secure handling',
    'page.home.trust3'     => 'On-time delivery',

    'page.home.why_eyebrow'=> 'Why choose us',
    'page.home.why_h2'     => 'We Make Moving Easy For You',
    'page.home.why_p'      => 'With trained crews, proper packing materials and a plan made before the day starts, your belongings are in safe hands — and you know what the move will cost before anyone lifts anything.',
    'page.home.why1'       => 'Trained, experienced moving crews',
    'page.home.why2'       => 'On-time arrival and delivery',
    'page.home.why3'       => 'Careful, fully protected handling',
    'page.home.why4'       => 'Furniture dismantling and reassembly',
    'page.home.why5'       => 'Transparent pricing, quoted in advance',
    'page.home.why6'       => '{areas} coverage',

    'page.home.step1_t'    => 'Contact Us',
    'page.home.step1_p'    => 'Reach out by call, WhatsApp or the form on this page.',
    'page.home.step2_t'    => 'Get a Free Quote',
    'page.home.step2_p'    => 'Share your move details and we quote against what is actually there.',
    'page.home.step3_t'    => 'Plan Your Move',
    'page.home.step3_p'    => 'We confirm crew, vehicle, access and timing, then pack and protect.',
    'page.home.step4_t'    => 'We Move Safely',
    'page.home.step4_p'    => 'Loaded in a planned order, strapped, and driven straight to the new address.',
    'page.home.step5_t'    => 'Settle In',
    'page.home.step5_p'    => 'Furniture reassembled, cartons in their rooms, and a final check with you.',

    'page.home.serve_p'    => 'Wherever you are moving within Dubai, Sharjah or Ajman — or between them — we treat all three emirates as one service area, so a cross-emirate move is a single-day job rather than a handover between companies.',
    'page.home.help_label' => 'Need help? Call us anytime',
    'page.home.reviews_lead'=> 'Rated by our customers for careful handling, clear pricing and turning up on time.',
    'page.home.out_of'     => 'out of 5',
    'page.home.review_one' => 'review',
    'page.home.review_many'=> 'reviews',
    'page.home.rating_aria'=> 'Average rating {score} out of 5 from {count} reviews',
    'page.home.stars_aria' => '{n} out of 5 stars',
    'page.home.pages_aria' => 'Review pages',
    'page.home.page_aria'  => 'Show reviews page {n}',
    'page.home.dev_note_t' => 'Local preview only.',
    'page.home.dev_note'   => 'These cards are placeholders so you can see the design. Add your real reviews to includes/data/testimonials.php — on the live site this section stays hidden until you do.',

    /* ==================================================================
     | Services index
     | ================================================================== */
    'page.services.title'  => 'Moving Services in Dubai, Sharjah & Ajman',
    'page.services.desc'   => 'Home, villa, apartment, office, retail, packing, storage, furniture assembly, loading and car transport across Dubai, Sharjah and Ajman. Call 055 658 1781.',
    'page.services.eyebrow'=> 'Our services',
    'page.services.h1'     => 'Moving Services in Dubai, Sharjah & Ajman',
    'page.services.sub'    => 'Twelve services covering residential and commercial moves end to end. Book the full move, or only the part you want help with.',
    'page.services.trust1' => '12 services',
    'page.services.trust2' => 'All three emirates',

    'page.services.all_h2' => 'All Our Moving Services',
    'page.services.g1_t'   => 'Residential Moving',
    'page.services.g1_p'   => 'Homes, villas and apartments — from a single room to a full five-bedroom relocation.',
    'page.services.g2_t'   => 'Business Moving',
    'page.services.g2_p'   => 'Offices, shops and showrooms, scheduled around your working and trading hours.',
    'page.services.g3_t'   => 'Furniture, Packing & Specialist',
    'page.services.g3_p'   => 'The individual services that make up a move, available on their own if that is all you need.',

    'page.services.faq_h'  => 'Questions about our services',
    'page.services.faq1_q' => 'Can I book more than one service together?',
    'page.services.faq1_a' => 'Yes, and most customers do. A typical booking combines home moving with packing, and often furniture assembly or storage. Booking them together means one crew, one schedule and one quotation rather than several providers coordinating between themselves.',
    'page.services.faq2_q' => 'Can I book only part of a move?',
    'page.services.faq2_a' => 'Yes. Loading and unloading is available as labour only if you have your own vehicle, packing can be booked without transport, and furniture assembly can be booked on its own. Tell us which part you want and we will price that.',
    'page.services.faq3_q' => 'Are all services available in Dubai, Sharjah and Ajman?',
    'page.services.faq3_a' => 'Yes. Every service listed here is available across all three emirates, including moves between them.',
    'page.services.faq4_q' => 'How do I know which service I need?',
    'page.services.faq4_a' => 'If you are not sure, call or WhatsApp us with a short description of what you are moving. It is usually obvious to us within a minute, and we would rather quote for the right service than sell you a larger one.',

    'page.services.q_head' => 'Not sure which service you need?',
    'page.services.q_intro'=> 'Describe your move and we will tell you which service fits — and quote for it.',

    /* ==================================================================
     | Locations index
     | ================================================================== */
    'page.locations.title' => 'Movers in Dubai, Sharjah & Ajman | Service Areas',
    'page.locations.desc'  => 'Movers and packers serving Dubai, Sharjah and Ajman from our Sharjah base. Local and cross-emirate household and commercial moves. Call 055 658 1781.',
    'page.locations.eyebrow'=> 'Service areas',
    'page.locations.h1'    => 'Movers & Packers Serving Dubai, Sharjah & Ajman',
    'page.locations.sub'   => 'We are based in {address} and work across all three emirates daily — which is why cross-emirate moves are ordinary work for us.',
    'page.locations.trust2'=> 'Single-day moves',

    'page.locations.choose_lead' => 'Each page covers the moving scenarios, property types and practical considerations specific to that emirate.',

    'page.locations.why_eyebrow' => 'Why it matters',
    'page.locations.why_h2'=> 'One Service Area, Three Emirates',
    'page.locations.why_p1'=> 'Dubai, Sharjah and Ajman sit close enough together that people move between them constantly. Treating the three as a single service area is what makes those moves straightforward: one crew, one vehicle, one day, rather than a handover between companies at an emirate border.',
    'page.locations.why_p2'=> 'Being based in Sharjah puts us in the middle of that area. Sharjah jobs get the shortest response times, Ajman is a short run north, and Dubai is close enough that we work there every day.',
    'page.locations.why1'  => 'Sharjah to Dubai — our most frequent route',
    'page.locations.why2'  => 'Dubai to Sharjah — same-day for most homes',
    'page.locations.why3'  => 'Ajman to Sharjah — a short run',
    'page.locations.why4'  => 'Ajman to Dubai — a single-day move',
    'page.locations.why5'  => 'Dubai to Ajman — planned around access',
    'page.locations.why6'  => 'Within any one emirate',

    'page.locations.avail_h2' => 'Available Across All Three',

    'page.locations.faq_h' => 'Questions about our service areas',
    'page.locations.faq1_q'=> 'Which emirates do you serve?',
    'page.locations.faq1_a'=> 'Dubai, Sharjah and Ajman. We are based in Sharjah, UAE, and moves between all three emirates are part of our normal service rather than a special arrangement.',
    'page.locations.faq2_q'=> 'Do you move between emirates in one day?',
    'page.locations.faq2_a'=> 'For most households, yes. Dubai, Sharjah and Ajman are close enough that a full household move along any of those routes is usually completed in a single day, subject to the volume of contents and the building access at both ends.',
    'page.locations.faq3_q'=> 'Do you charge more for a cross-emirate move?',
    'page.locations.faq3_a'=> 'The distance is only one factor and, over these routes, a small one. The bigger cost drivers are the volume of belongings, the packing required and the access at each address. Tell us both addresses and we will quote the actual job.',
    'page.locations.faq4_q'=> 'Do you cover areas outside these three emirates?',
    'page.locations.faq4_a'=> 'Dubai, Sharjah and Ajman are our service area, which is what lets us keep response times short and schedules reliable. If your move involves an address just outside it, call us and we will tell you honestly whether we can help.',

    'page.locations.q_head'=> 'Get a Free Moving Quote',
    'page.locations.q_intro'=> 'Tell us both addresses and we will confirm access, timing and price for that specific route.',

    /* ==================================================================
     | About Us
     | ================================================================== */
    'page.about.title'     => 'About Us | Movers & Packers in Sharjah, UAE',
    'page.about.desc'      => 'About Home Movers & Packers — a moving company in Sharjah, UAE serving Dubai, Sharjah and Ajman with moving, packing and storage services.',
    'page.about.eyebrow'   => 'About us',
    'page.about.h1'        => 'A Moving Company Based in Sharjah, Serving All Three Emirates',
    'page.about.sub'       => 'We move homes, villas, apartments, offices and shops — and we tell you what the day will actually involve before you book it.',
    'page.about.trust2'    => 'Our own crews',
    'page.about.trust3'    => 'Quoted in advance',

    'page.about.who_eyebrow' => 'Who we are',
    'page.about.who_h2'    => 'Movers & Packers in {address}',
    'page.about.who_p1'    => '{brand} provides residential and commercial relocation across {areas}. We handle full household moves, single-item furniture jobs, office and retail relocations, packing, furniture assembly, loading and unloading, storage and vehicle transport.',
    'page.about.who_p2'    => 'We are not a broker. When you book a move with us, our own crew arrives, packs, protects, loads, transports, unloads and reassembles. That single line of responsibility is the most practical guarantee we can offer — there is nobody to point at when something goes wrong, because the same people are there from start to finish.',
    'page.about.who1'      => 'Based in {address}',
    'page.about.who2'      => 'Serving {areas}',
    'page.about.who3'      => '12 residential and commercial services',
    'page.about.who4'      => 'Own crews — no subcontracted handovers',
    'page.about.who5'      => 'Free quotation before any booking',
    'page.about.who6'      => 'Cross-emirate moves as standard work',

    'page.about.stand_h2'  => 'What We Stand Behind',
    'page.about.v1_t'      => 'Protect first',
    'page.about.v1_p'      => 'Wrapping and padding go on before the lift. Protection applied afterwards is just cleanup.',
    'page.about.v2_t'      => 'Quote honestly',
    'page.about.v2_p'      => 'A quotation based on your actual property, with the scope stated so nothing is ambiguous later.',
    'page.about.v3_t'      => 'Plan the constraints',
    'page.about.v3_p'      => 'Lifts, service entrances, permitted hours and access routes are settled before the crew arrives.',
    'page.about.v4_t'      => 'Finish the job',
    'page.about.v4_p'      => 'Furniture reassembled, cartons in the right rooms, material cleared, and a final walkthrough with you.',

    'page.about.how_h2'    => 'How We Work',
    'page.about.s1_t'      => 'We assess first',
    'page.about.s1_p'      => 'A short video walkthrough for apartments, an on-site survey for villas and commercial premises.',
    'page.about.s2_t'      => 'We quote to that',
    'page.about.s2_p'      => 'Crew size, vehicle, materials and a realistic window — not a number that changes on the day.',
    'page.about.s3_t'      => 'We protect before lifting',
    'page.about.s3_p'      => 'Upholstery filmed, hard furniture blanketed, glass and mirrors given rigid protection.',
    'page.about.s4_t'      => 'We move it ourselves',
    'page.about.s4_p'      => 'The crew that packed your home is the crew that loads, drives and unloads it.',
    'page.about.s5_t'      => 'We put it back together',
    'page.about.s5_p'      => 'Whatever we dismantled is reassembled and placed before we leave.',

    'page.about.not_eyebrow' => 'Being straight with you',
    'page.about.not_h2'    => 'What we will not do',
    'page.about.not_p1'    => 'We do not quote without asking about your property, because a number produced that way is a guess that gets corrected on the day — usually upward, at the point where you have no alternative.',
    'page.about.not_p2'    => 'We do not claim capabilities we do not have, and where a job needs something we cannot provide, we say so rather than improvising on site.',
    'page.about.not_p3'    => 'We also do not publish invented credentials. You will not find fabricated review counts, star ratings, years-in-business figures or fleet numbers anywhere on this site. If you want to know something specific about how we work, call and ask — a direct answer is more useful than a badge.',
    'page.about.panel_h3'  => 'Talk to us directly',
    'page.about.panel_p'   => 'Tell us about the property and we will come back with a clear quotation. Free, and with no obligation.',

    'page.about.faq_h'     => 'About our company — common questions',
    'page.about.faq1_q'    => 'Where is your business based?',
    'page.about.faq1_a'    => 'Sharjah, UAE. We serve Dubai, Sharjah and Ajman from there, and we do not claim offices in emirates where we do not have them.',
    'page.about.faq2_q'    => 'What kind of moves do you handle?',
    'page.about.faq2_a'    => 'Residential moves of every size — studios through to five-bedroom villas — and commercial moves including offices, shops and showrooms. We also provide the individual services separately: packing, furniture moving, assembly, loading, storage and car transport.',
    'page.about.faq3_q'    => 'Do you use your own crews?',
    'page.about.faq3_a'    => 'Yes. The team that packs your home is the team that loads, transports and unpacks it. Nothing is handed over mid-move to a separate contractor, which is where responsibility usually gets lost.',
    'page.about.faq4_q'    => 'How do I get a quotation?',
    'page.about.faq4_a'    => 'Call or WhatsApp 055 658 1781, or use the quote form on this site. For apartments, a short video walkthrough is usually enough. For villas, we recommend an on-site survey so the quotation reflects the actual property.',

    /* ==================================================================
     | Contact Us
     | ================================================================== */
    'page.contact.title'   => 'Contact Us | Get a Free Moving Quote',
    'page.contact.desc'    => 'Contact Home Movers & Packers for a free moving quote. Call 055 658 1781 or WhatsApp us. Based in Sharjah, UAE, serving Dubai, Sharjah and Ajman.',
    'page.contact.eyebrow' => 'Contact us',
    'page.contact.h1'      => 'Get a Free Moving Quote',
    'page.contact.sub'     => 'Call, WhatsApp or send us your move details. We will confirm what is involved and come back with a clear, specific quotation — no obligation.',
    'page.contact.trust2'  => 'Quick response',

    'page.contact.reach_h2'=> 'How to Reach Us',
    'page.contact.m1_t'    => 'Call us',
    'page.contact.m1_p'    => 'Fastest for anything urgent or complicated.',
    'page.contact.m2_t'    => 'WhatsApp',
    'page.contact.m2_p'    => 'Send a short video of the property for the quickest quote.',
    'page.contact.m3_t'    => 'Email',
    'page.contact.m3_p'    => 'Good for detailed enquiries and office relocations.',
    'page.contact.m4_t'    => 'Where we are',
    'page.contact.m4_p'    => 'Serving {areas}.',

    'page.contact.req_h2'  => 'Request Your Free Quote',
    'page.contact.q_head'  => 'Tell us about your move',
    'page.contact.q_intro' => 'Fill in what you know — we will follow up for anything else. Required fields are marked.',

    'page.contact.speed_h3'=> 'Speed up your quote',
    'page.contact.speed_p' => 'The fastest way to an accurate figure is a short video walkthrough sent over WhatsApp, along with:',
    'page.contact.sp1'     => 'Both addresses',
    'page.contact.sp2'     => 'Floor number and lift availability at each',
    'page.contact.sp3'     => 'Your preferred moving date',
    'page.contact.sp4'     => 'Whether you want packing included',
    'page.contact.sp5'     => 'Anything unusually large, heavy or fragile',
    'page.contact.areas_note' => 'Including moves between all three emirates, usually completed in a single day.',

    'page.contact.ask_eyebrow' => 'Not a quote request?',
    'page.contact.ask_h2'  => 'Ask us anything about your move',
    'page.contact.ask_p1'  => 'Not everyone who gets in touch is ready to book. If you are still working out whether you need packing, how far ahead to book, or what a villa move actually involves, send the question over and we will answer it.',
    'page.contact.ask_p2'  => 'We would rather tell you honestly that your move is smaller than you think than sell you a service you do not need.',

    'page.contact.faq_h'   => 'Contacting us — common questions',
    'page.contact.faq1_q'  => 'What is the fastest way to get a quote?',
    'page.contact.faq1_a'  => 'WhatsApp. Send a short video walkthrough of the property along with your two addresses and preferred date, and we can usually respond with a specific quotation quickly. Calling works equally well if you would rather talk it through.',
    'page.contact.faq2_q'  => 'Do you charge for a survey or quotation?',
    'page.contact.faq2_a'  => 'No. Quotations are free and carry no obligation, including on-site surveys for villas and commercial premises.',
    'page.contact.faq3_q'  => 'What information should I have ready?',
    'page.contact.faq3_a'  => 'The current and new addresses, the property type, the floor and lift situation at both ends, your preferred date, and whether you want packing included. That is usually enough for an accurate quotation.',
    'page.contact.faq4_q'  => 'Do you serve Dubai, Sharjah and Ajman?',
    'page.contact.faq4_a'  => 'Yes, all three, including moves between them. We are based in Sharjah, UAE.',

    /* ==================================================================
     | Blog index
     | ================================================================== */
    'page.blog.title'      => 'Moving Guides & Tips for Dubai, Sharjah & Ajman',
    'page.blog.desc'       => 'Practical moving guides for UAE residents — checklists, packing advice, what moves actually cost and what to expect when moving between Dubai, Sharjah and Ajman.',
    'page.blog.eyebrow'    => 'Moving guides',
    'page.blog.h1'         => 'Practical Moving Advice for Dubai, Sharjah & Ajman',
    'page.blog.sub'        => 'Guides written from actual moving days — what goes wrong, why it goes wrong, and the order to do things in so it does not.',
    'page.blog.trust1'     => 'Checklists',
    'page.blog.trust2'     => 'Packing advice',
    'page.blog.trust3'     => 'Real costs',
    'page.blog.covered_h2' => 'Services Covered in These Guides',
    'page.blog.q_head'     => 'Rather Have Us Handle It?',
    'page.blog.q_intro'    => 'Send us your move details and we will come back with a clear quotation — free, no obligation.',

    /* ==================================================================
     | 404
     | ================================================================== */
    'page.404.title'       => 'Page Not Found',
    'page.404.desc'        => 'The page you were looking for could not be found. Browse our moving services or contact us on 055 658 1781.',
    'page.404.areas_h2'    => 'Areas We Cover',

    /* ==================================================================
     | Legal pages
     | ================================================================== */
    'page.privacy.title'   => 'Privacy Policy',
    'page.privacy.desc'    => 'How Home Movers & Packers collects, uses and protects the personal information you provide through this website.',
    'page.privacy.sub'     => 'How we collect, use and protect the information you give us. Short, and in plain language.',
    'page.privacy.trust1'  => 'Plain language',
    'page.privacy.trust2'  => 'No data selling',
    'page.privacy.trust3'  => 'Sharjah, UAE',

    'page.terms.title'     => 'Terms & Conditions',
    'page.terms.desc'      => 'The terms that apply to quotations, bookings and moving services provided by Home Movers & Packers in Dubai, Sharjah and Ajman.',
    'page.terms.sub'       => 'The terms that apply to quotations, bookings and use of this website.',
    'page.terms.trust1'    => 'Quotations',
    'page.terms.trust2'    => 'Bookings',
    'page.terms.trust3'    => 'Your rights',

    'legal.eyebrow'        => 'Legal',
    'legal.updated'        => 'Last updated:',

    /* ==================================================================
     | Projects
     | ================================================================== */
    'page.projects.title'   => 'Our Recent Moving Projects',
    'page.projects.desc'    => 'Moves we have completed across Dubai, Sharjah and Ajman — villas, apartments, offices and shops, with what each job actually involved.',
    'page.projects.eyebrow' => 'Our work',
    'page.projects.h1'      => 'Moves We Have Completed',
    'page.projects.sub'     => 'Real jobs across Dubai, Sharjah and Ajman — what was moved, where it went, and what made each one worth writing up.',
    'page.projects.grid_h2' => 'Recent Projects',
    'page.projects.more_h2' => 'Other Projects',
    'page.projects.empty'   => 'We are putting this page together. In the meantime, call or WhatsApp us and we will talk you through jobs like yours.',
    'page.projects.faq_h'   => 'About our work',
    'page.projects.faq1_q'  => 'Are these real jobs?',
    'page.projects.faq1_a'  => 'Yes. Every project on this page is a move we carried out, added by us after the job was finished. We do not publish stock photography as our own work.',
    'page.projects.faq2_q'  => 'Can you do a job like one of these for me?',
    'page.projects.faq2_a'  => 'Almost certainly. These are a sample rather than a limit — the same crews handle everything from a single room to a five-bedroom villa. Tell us what you are moving and we will quote for it.',
    'page.projects.faq3_q'  => 'Do you publish customer details?',
    'page.projects.faq3_a'  => 'No. We describe the property type and the area, never the customer name or the exact address. If a project shows a photograph, it is one we took with permission.',

    /* ==================================================================
     | Reviews
     | ================================================================== */
    'page.reviews.title'    => 'Customer Reviews',
    'page.reviews.desc'     => 'What our customers say about moving with us in Dubai, Sharjah and Ajman — and a form to leave your own review.',
    'page.reviews.eyebrow'  => 'Customer reviews',
    'page.reviews.h1'       => 'What Our Customers Say',
    'page.reviews.sub'      => 'Reviews written by people we have actually moved. If we moved you, we would like to hear how it went — good or bad.',
    'page.reviews.empty'    => 'No reviews have been published yet. If we have moved you, yours would be the first — the form below takes a minute.',
    'page.reviews.form_title' => 'Leave a review',
    'page.reviews.form_intro' => 'Tell us how your move went. We read every review before it goes on the site, so it will appear within a day or so.',
    'page.reviews.faq_h'    => 'About these reviews',
    'page.reviews.faq1_q'   => 'Are these reviews real?',
    'page.reviews.faq1_a'   => 'Yes. Every review here was submitted through the form on this page by someone we moved, and we check each one against our records before publishing it. We do not write reviews ourselves and we do not buy them.',
    'page.reviews.faq2_q'   => 'Why has my review not appeared yet?',
    'page.reviews.faq2_a'   => 'Every review is read before it is published, which usually takes less than a day. That is what stops this page filling with spam, and it is why the reviews here are worth reading.',
    'page.reviews.faq3_q'   => 'Do you remove negative reviews?',
    'page.reviews.faq3_a'   => 'No. A review is only rejected if it is spam, abusive, or from someone we have no record of moving. If something went wrong on your move we would rather know — call us on 055 658 1781 and we will try to put it right.',

    /* ==================================================================
     | Service page template
     | ================================================================== */
    'tpl.service.covers'   => 'What this covers',
    'tpl.service.how_h2'   => 'How It Works',
    'tpl.service.why_h2'   => 'Why It Matters',
    'tpl.service.across'   => '{service} Across All Three Emirates',
    'tpl.service.faq_h'    => '{service} — frequently asked questions',
    'tpl.service.q_head'   => 'Get a Free Quote for {service}',
    'tpl.service.q_intro'  => 'Tell us about your move and we will come back with a clear, specific quotation for {service}. No obligation.',

    /* ==================================================================
     | Location page template
     | ================================================================== */
    'tpl.location.eyebrow' => 'Movers & Packers · {city}, UAE',
    'tpl.location.moving_in'=> 'Moving in {city}',
    'tpl.location.book_h3' => 'Book a move in {city}',
    'tpl.location.book_p'  => 'Send us the two addresses, the property type and your preferred date. We confirm access, crew and vehicle, then quote.',
    'tpl.location.svc_h2'  => 'Our Services in {city}',
    'tpl.location.every_h3'=> 'Every service we offer covers {city}',
    'tpl.location.faq_h'   => 'Movers in {city} — frequently asked questions',
    'tpl.location.q_head'  => 'Get a Free Moving Quote in {city}',
    'tpl.location.q_intro' => 'Tell us about your move in {city} and we will come back with a specific quotation. No obligation.',
    'tpl.location.other_h2'=> 'Also Moving To or From Another Emirate?',

    /* ==================================================================
     | Blog article template
     | ================================================================== */
    'tpl.post.toc_h2'      => 'What this article covers',
    'tpl.post.toc_aria'    => 'Article contents',
    'tpl.post.note_label'  => 'Worth knowing:',
    'tpl.post.cta_h2'      => 'Planning a move in {areas}?',
    'tpl.post.cta_p'       => 'Send us your property details and we will come back with a specific quotation — free, and with no obligation.',
    'tpl.post.services_h3' => 'Services in this guide',
    'tpl.post.talk_h3'     => 'Talk to us',
];

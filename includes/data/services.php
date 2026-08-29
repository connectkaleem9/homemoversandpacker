<?php
/**
 * Service catalogue — the single source of truth for every service page,
 * navigation entry, footer link, card grid, sitemap entry and Service schema.
 *
 * Each entry is written with unique copy: shared layout, never shared text.
 * Add a new service here and it appears across the whole site automatically.
 */

declare(strict_types=1);

return [

    /* ============================================================ 1 */
    'home-movers' => [
        'name'        => 'Home Movers',
        'short'       => 'Full house and apartment moves handled end to end — packing, loading, transport, unloading and reassembly.',
        'tile'        => 'Safe, reliable moving solutions for your home.',
        'icon'        => 'home',
        'title'       => 'Home Movers in Dubai, Sharjah & Ajman | House Movers',
        'description' => 'Professional home movers for apartments and villas across Dubai, Sharjah and Ajman. Packing, loading, transport and unpacking. Call 055 658 1781.',
        'h1'          => 'Home Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'A complete house moving service — we pack your home, protect your furniture, move it safely and set everything back up at your new address.',
        'intro'       => [
            'Moving out of a home is rarely just about furniture. It is a kitchen full of glassware, a wardrobe that has to come apart to clear the doorway, a television that needs its own box, and a family that would rather not spend the weekend carrying cartons down a stairwell.',
            'Our home moving service covers all of it. We arrive with packing materials, tools and a trained crew, dismantle what needs dismantling, wrap what needs protecting, load carefully, transport your belongings and put everything back together at the new property.',
        ],
        'what_it_is'  => [
            'heading' => 'What our home moving service covers',
            'body'    => [
                'A home move starts with a walkthrough — either in person or over WhatsApp with a few photos and a short description of the property. That tells us the crew size, the vehicle size and how much packing material to bring, which is what keeps the day predictable.',
                'On moving day the crew packs room by room so nothing gets separated from the space it belongs to. Boxes are labelled by room and content, furniture is dismantled where the access requires it, and everything is padded and wrapped before it goes near the truck.',
                'At the new property we work in reverse: large furniture is placed and reassembled first, cartons go to their labelled rooms, and beds, wardrobes and dining sets are put back together before we leave.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Families moving house', 'text' => 'Full households with bedrooms, a kitchen, a living room and years of accumulated belongings that need proper packing rather than a rushed load.'],
                ['title' => 'Apartment residents', 'text' => 'Flats in towers where lift booking, building access rules and narrow corridors have to be planned around rather than discovered on the day.'],
                ['title' => 'Tenants at the end of a lease', 'text' => 'Moves tied to a handover date, where the property has to be cleared on schedule and left tidy.'],
                ['title' => 'Anyone moving between emirates', 'text' => 'Dubai to Sharjah, Sharjah to Ajman or any combination across our service area, handled as a single job on the same day where possible.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Pre-move survey and a written quotation before any work begins',
                'Packing materials — cartons, bubble wrap, stretch film, tape and protective covers',
                'Room-by-room packing with labelled boxes',
                'Dismantling of beds, wardrobes, dining tables and modular units',
                'Padding and wrapping for sofas, mattresses, mirrors and appliances',
                'Careful loading, secure transport and unloading',
                'Reassembly of the furniture we dismantled',
                'Placement of cartons and furniture in the rooms you choose',
                'Removal of used packing material on request',
            ],
        ],
        'process'     => [
            ['title' => 'Share your move details', 'text' => 'Call or WhatsApp us with the property type, current and new address, and your preferred date. Photos or a short video of the rooms help us quote accurately.'],
            ['title' => 'Receive a clear quotation', 'text' => 'We confirm crew size, vehicle, materials and the time window, then send a quotation with no vague extras attached.'],
            ['title' => 'Packing day', 'text' => 'The crew packs and protects everything, dismantling furniture where access requires it and labelling cartons as they go.'],
            ['title' => 'Loading and transport', 'text' => 'Items are loaded in a planned order so weight is balanced and fragile pieces travel protected, then driven directly to the new address.'],
            ['title' => 'Unloading and setup', 'text' => 'Furniture is reassembled and positioned, cartons go to their rooms, and we check everything with you before finishing.'],
        ],
        'benefits'    => [
            ['title' => 'One crew, one responsibility', 'text' => 'The same team packs, loads, transports and unpacks, so nothing is lost in a handover between contractors.'],
            ['title' => 'Furniture handled properly', 'text' => 'Dismantling and reassembly are part of the job, not an extra you have to arrange separately.'],
            ['title' => 'Planned around building rules', 'text' => 'Lift bookings, service entrances, NOC requirements and time restrictions are factored into the schedule.'],
            ['title' => 'Quoted before we start', 'text' => 'You know the scope and the price before moving day, based on what is actually in the property.'],
        ],
        'suits'       => [
            'heading' => 'Property types we move',
            'items'   => ['Studio apartments', '1, 2 and 3 bedroom apartments', 'Townhouses', 'Villas', 'Shared and staff accommodation', 'Furnished and unfurnished rentals'],
        ],
        'faqs'        => [
            ['q' => 'How much does a home move cost?', 'a' => 'There is no single fixed price, because a studio and a four-bedroom villa are very different jobs. The cost depends on the size of the property, how many items you have, the distance between addresses, whether you want packing included, and the access at both ends — a ground floor with a loading bay is quicker than a fifth floor with one small lift. Send us the details and we will give you a specific quotation.'],
            ['q' => 'Do you provide the packing materials?', 'a' => 'Yes. Cartons, bubble wrap, stretch film, tape and protective covers are brought by the crew. If you prefer to pack some items yourself, tell us in advance and we will adjust the quotation.'],
            ['q' => 'Can you dismantle and reassemble my furniture?', 'a' => 'Yes. Beds, wardrobes, dining tables, desks and modular units are dismantled where needed and reassembled at the new property. Fixings are bagged and kept with the piece they belong to.'],
            ['q' => 'How far in advance should I book?', 'a' => 'Earlier is better, particularly at month end and around the start and end of tenancy contracts, when demand is highest. If your move is urgent, call us and we will tell you honestly what is possible.'],
            ['q' => 'Can you move me on a weekend or in the evening?', 'a' => 'In most cases yes. Some buildings restrict moving hours, so we confirm the permitted window with you and plan the crew around it.'],
            ['q' => 'Do you move homes between Dubai, Sharjah and Ajman?', 'a' => 'Yes. Moves between all three emirates are part of our normal service area and are usually completed the same day.'],
        ],
        'related'     => ['furniture-movers', 'packing-unpacking', 'villa-movers', 'studio-apartment-movers'],
    ],

    /* ============================================================ 2 */
    'furniture-movers' => [
        'name'        => 'Furniture Movers',
        'short'       => 'Single pieces or a full set — wrapped, dismantled where needed, moved without scratches and rebuilt on arrival.',
        'tile'        => 'Careful handling and secure transport of furniture.',
        'icon'        => 'sofa',
        'title'       => 'Furniture Movers in Dubai, Sharjah & Ajman',
        'description' => 'Furniture movers for sofas, wardrobes, beds and single items across Dubai, Sharjah and Ajman. Wrapping and reassembly included. Call 055 658 1781.',
        'h1'          => 'Furniture Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'From one wardrobe to a full apartment of furniture — wrapped properly, carried carefully and reassembled where it needs to be.',
        'intro'       => [
            'Furniture is where most moving damage happens. A sofa arm catches a door frame, a glass table top travels flat instead of upright, or a wardrobe is forced through a corridor it was never going to clear in one piece.',
            'This service exists for exactly that. Whether you are moving a single item you bought second-hand or the entire contents of a living room, the furniture is protected before it moves, dismantled if the route demands it, and put back together at the other end.',
        ],
        'what_it_is'  => [
            'heading' => 'What furniture moving involves',
            'body'    => [
                'Every piece is assessed before it is touched. Solid wood, veneer, glass, marble, leather and fabric all need different handling, and the wrapping is chosen accordingly — stretch film for upholstery, blankets and corner protection for hard edges, rigid protection for glass and mirrors.',
                'Where a piece will not travel the access route intact, it is dismantled rather than forced. Fittings, bolts and shelf pins are bagged and taped to the piece they belong to, which is the difference between a wardrobe that goes back together in fifteen minutes and one that never quite does again.',
                'Inside the vehicle, pieces are loaded so nothing rests on a surface that cannot take the weight, and everything is strapped so it does not shift in transit.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Single-item moves', 'text' => 'A bed, sofa, fridge or wardrobe bought online or second-hand that needs collecting and delivering into the room where it will live.'],
                ['title' => 'Partial moves', 'text' => 'You are handling the boxes yourself but want the heavy and awkward furniture moved by a crew with the right equipment.'],
                ['title' => 'Rearranging within a property', 'text' => 'Moving heavy furniture between floors or rooms, including taking pieces apart to clear a doorway.'],
                ['title' => 'Furnished handovers', 'text' => 'Landlords and tenants moving furniture in or out at the start or end of a tenancy.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Assessment of each piece and the access route before lifting',
                'Blanket, bubble wrap and stretch film protection',
                'Corner and edge protection for hard furniture',
                'Rigid protection for glass tops, mirrors and marble',
                'Dismantling where the route or the piece requires it',
                'Bagged and labelled fittings kept with each item',
                'Strapped, secured loading',
                'Reassembly and placement at the destination',
            ],
        ],
        'process'     => [
            ['title' => 'Tell us what needs moving', 'text' => 'A list or a few photos of the pieces, plus the floor and lift situation at both addresses.'],
            ['title' => 'Quotation and scheduling', 'text' => 'We confirm crew size, vehicle and time slot, and quote before the job is booked.'],
            ['title' => 'Protect and dismantle', 'text' => 'Each piece is wrapped, and anything that will not clear the route intact is taken apart properly.'],
            ['title' => 'Move and secure', 'text' => 'Items are carried on the planned route, loaded in order and strapped for transport.'],
            ['title' => 'Rebuild and place', 'text' => 'Furniture is reassembled, positioned where you want it and checked before we leave.'],
        ],
        'benefits'    => [
            ['title' => 'Damage prevention, not damage repair', 'text' => 'Protection goes on before the lift, which is the only point at which it helps.'],
            ['title' => 'Right crew for the weight', 'text' => 'Heavy and awkward pieces get enough people and correct lifting technique instead of two people improvising.'],
            ['title' => 'Nothing left in pieces', 'text' => 'Anything we dismantle, we reassemble — that is part of the price, not an add-on.'],
            ['title' => 'Small jobs welcome', 'text' => 'A single item is a legitimate booking, not something we treat as an inconvenience.'],
        ],
        'suits'       => [
            'heading' => 'Furniture we handle',
            'items'   => ['Sofas and sofa beds', 'Wardrobes and closets', 'Beds and mattresses', 'Dining tables and chairs', 'Glass and marble tops', 'Appliances', 'Office desks', 'Display units and shelving'],
        ],
        'faqs'        => [
            ['q' => 'Can you move just one item of furniture?', 'a' => 'Yes. Single-item moves are a normal booking — a bed, a sofa, a fridge or a wardrobe collected from one address and delivered into the room you want it in at the other.'],
            ['q' => 'Will my furniture be wrapped?', 'a' => 'Yes. Upholstery is stretch-wrapped, hard furniture gets blankets and corner protection, and glass, mirrors and marble get rigid protection before they are moved.'],
            ['q' => 'Do you take furniture apart?', 'a' => 'When the piece or the access route requires it. Beds, wardrobes, dining tables and modular units are dismantled, the fittings are bagged and taped to the item, and it is reassembled at the destination.'],
            ['q' => 'What if the furniture will not fit through the door?', 'a' => 'We check the access route before lifting. If a piece will not clear the doorway, lift or stairwell intact, we dismantle it. We will always tell you honestly if something is not going to fit rather than forcing it.'],
            ['q' => 'Do you move furniture between floors in the same building?', 'a' => 'Yes. Internal moves between floors or rooms are a common job, including taking pieces apart to get them through.'],
            ['q' => 'How is the cost of furniture moving calculated?', 'a' => 'By the number and size of the pieces, the access at both addresses, the distance, and whether dismantling and reassembly are needed. Send a list or photos and we will quote on that.'],
        ],
        'related'     => ['home-movers', 'furniture-assembly', 'loading-unloading', 'packing-unpacking'],
    ],

    /* ============================================================ 3 */
    'office-commercial-movers' => [
        'name'        => 'Office & Commercial Movers',
        'short'       => 'Office relocations planned around your working hours — workstations, IT equipment, files and furniture with minimal downtime.',
        'tile'        => 'Hassle-free office and commercial relocation.',
        'icon'        => 'building',
        'title'       => 'Office & Commercial Movers in Dubai, Sharjah & Ajman',
        'description' => 'Office and commercial movers for workstations, IT equipment and files in Dubai, Sharjah and Ajman. Minimal downtime. Call 055 658 1781.',
        'h1'          => 'Office & Commercial Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Planned office relocations that keep downtime short — workstations dismantled, equipment protected, everything set up and ready at the new premises.',
        'intro'       => [
            'An office move is judged by one thing: how quickly your team can sit down and work again. Everything else — the packing, the labelling, the sequencing of the load — exists to serve that.',
            'We plan commercial moves around your operating hours, usually working evenings, weekends or across a closure window so the business does not stop. Workstations, meeting rooms, IT equipment, filing and storage are handled as a coordinated project rather than a truckload of unlabelled furniture.',
        ],
        'what_it_is'  => [
            'heading' => 'How we handle a commercial relocation',
            'body'    => [
                'The move starts with a site visit to both premises. We record the workstation count, the furniture types, IT equipment, storage and files, then map the new floor plan so every item has a destination before it leaves the old office.',
                'Everything is labelled against that plan. A desk is not simply "desk" — it is the desk that belongs at position 14 in the new layout, with its pedestal, chair and monitor arm labelled to match. That labelling is what turns an unloading session into a setup.',
                'IT and electronics are disconnected, cables bagged and labelled per workstation, and screens and hardware packed with dedicated protection. Files and confidential documents stay in sealed, tracked crates.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Offices changing premises', 'text' => 'Small teams through to multi-floor offices relocating within or between Dubai, Sharjah and Ajman.'],
                ['title' => 'Businesses restructuring a floor', 'text' => 'Internal relocations where departments move between floors or the layout is being rebuilt.'],
                ['title' => 'Companies downsizing or expanding', 'text' => 'Moves where part of the furniture goes to the new office and part goes into storage.'],
                ['title' => 'Coworking and serviced office moves', 'text' => 'Businesses moving in or out of shared premises with strict building access windows.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Site survey of both the current and the new premises',
                'A move plan with sequencing and a labelling scheme',
                'Workstation and partition dismantling',
                'Disconnection, bagging and labelling of cables per workstation',
                'Protective packing for monitors, computers and office equipment',
                'Sealed crates for files and confidential documents',
                'Careful handling of safes, cabinets and heavy items',
                'Transport and unloading at the new premises',
                'Reassembly and placement against the new floor plan',
                'Removal of packing material after setup',
            ],
        ],
        'process'     => [
            ['title' => 'Site survey', 'text' => 'We visit both premises, take an inventory and identify access constraints, lift bookings and permitted working hours.'],
            ['title' => 'Move plan and quotation', 'text' => 'You receive a plan covering sequence, crew, vehicles, timing and the labelling scheme, with a quotation against it.'],
            ['title' => 'Pre-move preparation', 'text' => 'Crates are delivered in advance, staff pack personal items, and we label furniture and equipment to the new layout.'],
            ['title' => 'The move window', 'text' => 'Dismantling, packing, loading and transport happen inside your agreed window — typically outside working hours.'],
            ['title' => 'Setup and handover', 'text' => 'Workstations are rebuilt to the floor plan, equipment is placed at the right desks, and we walk the floor with you before signing off.'],
        ],
        'benefits'    => [
            ['title' => 'Downtime treated as the priority', 'text' => 'The plan is built around when your business can afford to be offline, not around when it suits us.'],
            ['title' => 'Labelled to the new floor plan', 'text' => 'Items arrive knowing where they belong, so setup is fast and staff find their equipment.'],
            ['title' => 'IT handled with care', 'text' => 'Cables bagged per workstation and hardware packed properly, so reconnection is straightforward.'],
            ['title' => 'Document security respected', 'text' => 'Files and confidential paperwork move in sealed crates, not open boxes.'],
        ],
        'suits'       => [
            'heading' => 'Premises we relocate',
            'items'   => ['Offices and business centres', 'Coworking spaces', 'Clinics and consultancies', 'Showrooms with office areas', 'Warehouse offices', 'Multi-floor corporate premises'],
        ],
        'faqs'        => [
            ['q' => 'Can you move our office outside working hours?', 'a' => 'Yes, and it is usually what we recommend. Evening, overnight and weekend moves keep the business running, and most buildings prefer moving activity outside peak hours anyway.'],
            ['q' => 'Do you handle IT equipment and cabling?', 'a' => 'We disconnect, bag and label cables per workstation and pack monitors, computers and peripherals with protective materials. Reconnection at the new office is coordinated with your IT team so responsibility for the network side stays clear.'],
            ['q' => 'How do you keep track of what belongs where?', 'a' => 'Every item is labelled against the new floor plan before it is loaded. A desk, its pedestal, its chair and its equipment carry the same position reference, so unloading is a setup rather than a sorting exercise.'],
            ['q' => 'Can you move office furniture into storage?', 'a' => 'Yes. Where you are downsizing or the new premises is not ready, part of the move can go into storage and be delivered later. See our warehousing and storage service.'],
            ['q' => 'How long does an office move take?', 'a' => 'It depends on the workstation count, the volume of files and equipment, and the access at both buildings. After the site survey we give you a realistic window rather than an optimistic one.'],
            ['q' => 'Do you move safes and heavy cabinets?', 'a' => 'Yes, provided the access route and the building will take the weight. We assess this during the survey and bring the right equipment and crew size.'],
        ],
        'related'     => ['commercial-retail-movers', 'warehousing-storage', 'loading-unloading', 'packing-unpacking'],
    ],

    /* ============================================================ 4 */
    'studio-apartment-movers' => [
        'name'        => 'Studio Apartment Movers',
        'short'       => 'Small moves done properly — a right-sized crew and vehicle for studios and one-bedroom flats, usually finished in a few hours.',
        'tile'        => 'Right-sized moves for studios and small flats.',
        'icon'        => 'apartment',
        'title'       => 'Studio Apartment Movers in Dubai, Sharjah & Ajman',
        'description' => 'Studio and small apartment movers in Dubai, Sharjah and Ajman. Right-sized crew and vehicle, most moves done in hours. Call 055 658 1781.',
        'h1'          => 'Studio & Small Apartment Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'A move sized for the property you actually have — no oversized truck, no padded hours, usually finished the same morning.',
        'intro'       => [
            'A studio move is not a small version of a villa move. It has its own problems: a single lift shared with the whole building, a corridor with a tight turn, a bed that only came into the flat because it was assembled inside it, and a budget that should reflect the amount of work involved.',
            'This service is built for that. A crew and vehicle sized to the property, packing if you want it, and a realistic time estimate — most studio and one-bedroom moves are completed within a few hours.',
        ],
        'what_it_is'  => [
            'heading' => 'What a studio move looks like',
            'body'    => [
                'We confirm the inventory in advance, usually over WhatsApp with a short video of the flat. That tells us whether a single vehicle and a compact crew is enough, and whether the bed or wardrobe will have to come apart to leave the room.',
                'On the day the crew packs kitchenware, clothes, electronics and personal items into labelled cartons, protects the furniture, dismantles what needs dismantling and clears the flat.',
                'At the new address the same crew reassembles the furniture, places the cartons and takes the used material away if you want it gone.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Studio and one-bedroom tenants', 'text' => 'Single occupants and couples moving between apartments in the same building, the same area or a different emirate.'],
                ['title' => 'Shared and staff accommodation', 'text' => 'Room moves in shared flats where only your own belongings are being relocated.'],
                ['title' => 'Furnished-to-furnished moves', 'text' => 'Where the furniture stays and only personal belongings, kitchenware and electronics move.'],
                ['title' => 'Short-notice moves', 'text' => 'Lease-end dates that shifted, or a flat that has to be cleared quickly.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Inventory confirmed in advance so the vehicle and crew are right-sized',
                'Cartons and packing material for kitchen, clothing and personal items',
                'Protection for the television, computer and other electronics',
                'Dismantling of the bed, wardrobe or desk where required',
                'Careful handling in shared lifts and narrow corridors',
                'Loading, transport and unloading',
                'Reassembly and carton placement at the new flat',
                'Used packing material taken away on request',
            ],
        ],
        'process'     => [
            ['title' => 'Send a quick video or list', 'text' => 'A walkthrough clip of the flat over WhatsApp is usually enough for us to quote accurately.'],
            ['title' => 'Fixed slot, clear quote', 'text' => 'We confirm the crew, vehicle, time slot and price before booking.'],
            ['title' => 'Pack and protect', 'text' => 'Belongings are packed into labelled cartons and furniture is wrapped and dismantled as needed.'],
            ['title' => 'Move', 'text' => 'The flat is cleared, loaded and driven to the new address.'],
            ['title' => 'Set up', 'text' => 'Furniture is rebuilt, cartons are placed by room and the flat is left ready to use.'],
        ],
        'benefits'    => [
            ['title' => 'Priced for a small move', 'text' => 'You are not paying for a crew and a truck sized for a villa.'],
            ['title' => 'Usually a same-morning job', 'text' => 'Most studio moves are finished within a few hours, so you get your day back.'],
            ['title' => 'Built for tower buildings', 'text' => 'Lift booking, service entrances and access windows are planned in advance.'],
            ['title' => 'Flexible scope', 'text' => 'Take packing, or pack yourself and let us handle the furniture and transport.'],
        ],
        'suits'       => [
            'heading' => 'Properties we move',
            'items'   => ['Studio apartments', 'One-bedroom flats', 'Rooms in shared accommodation', 'Serviced apartments', 'Staff accommodation', 'Furnished rentals'],
        ],
        'faqs'        => [
            ['q' => 'How long does a studio move take?', 'a' => 'Most studio and one-bedroom moves are completed within a few hours, assuming reasonable lift access at both addresses. Packing adds time, and a fifth-floor flat with one shared lift takes longer than a ground-floor unit.'],
            ['q' => 'Is a small move cheaper?', 'a' => 'Yes — the crew and vehicle are sized to the property, so a studio does not cost what a villa costs. The final price still depends on volume, access, distance and whether you want packing included.'],
            ['q' => 'Can I pack my own things and just book the transport?', 'a' => 'Absolutely. Many studio customers pack their own clothes and kitchenware and book us for the furniture, loading and transport. Tell us at quotation stage and we will price it that way.'],
            ['q' => 'Do you move single rooms in shared apartments?', 'a' => 'Yes. We move only your belongings from the room, working around the other occupants.'],
            ['q' => 'What if my bed will not come out of the room?', 'a' => 'It is dismantled. Beds are frequently assembled inside the room they live in, so this is routine, and it is rebuilt at the new flat.'],
            ['q' => 'Can you move a studio at short notice?', 'a' => 'Often yes, because small moves need less scheduling than large ones. Call us with your date and we will tell you what is realistically available.'],
        ],
        'related'     => ['home-movers', 'packing-unpacking', 'furniture-movers', 'local-moving'],
    ],

    /* ============================================================ 5 */
    'villa-movers' => [
        'name'        => 'Villa Movers',
        'short'       => 'Large-home moves with the crew, vehicles and planning that multiple floors, gardens and heavy furniture actually require.',
        'tile'        => 'Large villa relocations handled with extra care.',
        'icon'        => 'villa',
        'title'       => 'Villa Movers in Dubai, Sharjah & Ajman | Villa Moving',
        'description' => 'Villa movers for large homes across Dubai, Sharjah and Ajman. Multiple floors, heavy furniture and fragile items handled. Call 055 658 1781.',
        'h1'          => 'Villa Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Villa relocations planned properly — multiple floors, heavy furniture, delicate pieces and outdoor areas, moved by a crew sized for the job.',
        'intro'       => [
            'A villa move is a different scale of work. There are stairs instead of a lift, furniture that was assembled in the room it stands in, a majlis of heavy seating, a garden with outdoor furniture, and a store room nobody has fully opened in three years.',
            'Underestimating that is the single most common reason villa moves run into the night. We survey the property first, size the crew and vehicles to what is actually there, and sequence the work so the house empties in a controlled order rather than all at once.',
        ],
        'what_it_is'  => [
            'heading' => 'How a villa relocation is handled',
            'body'    => [
                'The survey covers every floor, the majlis, kitchen, store rooms, maid\'s room, garage and outdoor areas. From that we know the vehicle count, the crew size and how many days of packing the property needs before moving day.',
                'Packing usually begins ahead of the move itself. Kitchens, wardrobes and store rooms are packed first, room by room, with cartons labelled by room and content. Chandeliers, mirrors, artwork, marble and glass get individual protection.',
                'On moving day, heavy furniture is dismantled and brought down in a planned order, loaded across the vehicles so weight is balanced, and delivered to the new villa where the process runs in reverse — large furniture placed and rebuilt first, then cartons to their rooms.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Families relocating a villa', 'text' => 'Three, four and five bedroom homes with a full contents list across several floors.'],
                ['title' => 'Townhouse and compound residents', 'text' => 'Properties with stair access, shared compound rules and restricted vehicle entry.'],
                ['title' => 'Moves with high-value contents', 'text' => 'Homes with chandeliers, artwork, marble tops or antique furniture needing dedicated protection.'],
                ['title' => 'Villa-to-villa moves across emirates', 'text' => 'Sharjah to Dubai, Dubai to Ajman and any combination within our service area.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Full property survey covering every floor and outdoor area',
                'A written moving plan with crew, vehicles and timing',
                'Multi-day packing where the property needs it',
                'Room-by-room labelling for every carton',
                'Individual protection for chandeliers, mirrors, artwork and glass',
                'Dismantling of beds, wardrobes, dining sets and majlis seating',
                'Handling of outdoor and garden furniture',
                'Appliance disconnection assistance and protective wrapping',
                'Multiple vehicles where the volume requires it',
                'Reassembly, placement and post-move material removal',
            ],
        ],
        'process'     => [
            ['title' => 'On-site survey', 'text' => 'We walk the whole villa, including store rooms and outdoor areas, and build an accurate inventory.'],
            ['title' => 'Moving plan and quotation', 'text' => 'You receive crew size, vehicle count, a packing schedule and a timeline, with the quotation built on the survey.'],
            ['title' => 'Pre-move packing', 'text' => 'Packing starts before moving day for larger villas, working room by room so the house stays liveable.'],
            ['title' => 'Moving day', 'text' => 'Furniture is dismantled and brought down in sequence, loaded across vehicles and transported.'],
            ['title' => 'Setup at the new villa', 'text' => 'Large furniture is placed and rebuilt first, cartons go to their labelled rooms, and we walk the property with you at the end.'],
        ],
        'benefits'    => [
            ['title' => 'Surveyed, not guessed', 'text' => 'Villa quotes based on a phone call are how moves overrun. We look at the property first.'],
            ['title' => 'Crew sized to the house', 'text' => 'Enough people and enough vehicles that the job finishes in the planned window.'],
            ['title' => 'Fragile items taken seriously', 'text' => 'Chandeliers, mirrors, marble and artwork are protected individually, not bundled in with the rest.'],
            ['title' => 'Sequenced to stay controlled', 'text' => 'Rooms are cleared in order so nothing gets mixed and nothing gets left behind.'],
        ],
        'suits'       => [
            'heading' => 'Homes we relocate',
            'items'   => ['3, 4 and 5 bedroom villas', 'Townhouses', 'Compound villas', 'Duplex and multi-floor homes', 'Villas with maid\'s rooms and store rooms', 'Homes with gardens and outdoor furniture'],
        ],
        'faqs'        => [
            ['q' => 'How long does a villa move take?', 'a' => 'Larger villas are usually packed over one or more days before moving day, with the move itself taking a full day. The exact timeline comes from the survey — the number of rooms, the amount of furniture and the access at both properties all change it.'],
            ['q' => 'Do you visit the villa before quoting?', 'a' => 'For villas, yes, we strongly recommend it. A survey is the only way to size the crew and vehicles correctly, and it protects you from a quote that changes on the day.'],
            ['q' => 'Can you move chandeliers, mirrors and artwork?', 'a' => 'Yes. These are packed individually with rigid protection and transported separately from heavy items. Tell us during the survey so we bring the right materials.'],
            ['q' => 'Do you handle outdoor and garden furniture?', 'a' => 'Yes. Outdoor seating, tables, umbrellas and garden items are part of the inventory and are wrapped and loaded like any other furniture.'],
            ['q' => 'Can you move a villa over more than one day?', 'a' => 'Yes. Large villas are often packed across several days with the move itself on a set day. Where a phased move suits you better, we plan for it.'],
            ['q' => 'What does a villa move cost?', 'a' => 'It depends on the number of rooms, the volume of contents, packing requirements, the number of vehicles and crew needed, the distance between properties and the access at both. After the survey you get a specific figure rather than an estimate that moves.'],
        ],
        'related'     => ['home-movers', 'packing-unpacking', 'furniture-movers', 'warehousing-storage'],
    ],

    /* ============================================================ 6 */
    'warehousing-storage' => [
        'name'        => 'Warehousing & Storage',
        'short'       => 'Somewhere for your belongings to wait when the dates do not line up — inventoried in, stored, delivered out when you are ready.',
        'tile'        => 'Secure storage for short or long-term needs.',
        'icon'        => 'storage',
        'title'       => 'Warehousing & Storage in Dubai, Sharjah & Ajman',
        'description' => 'Furniture and household storage for moves in Dubai, Sharjah and Ajman. Inventoried collection, storage and redelivery. Call 055 658 1781.',
        'h1'          => 'Warehousing & Storage Services in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'When your move-out and move-in dates do not match, your belongings need somewhere to wait — collected, inventoried, stored and returned on your schedule.',
        'intro'       => [
            'Very few moves line up perfectly. A tenancy ends before the new one begins, a handover is delayed, an office is not ready, or you are leaving the country for a few months and the furniture should not be sold in a hurry.',
            'Our storage service bridges that gap. We collect and pack your belongings, record them against an inventory, store them, and deliver them back when your new property is ready — as one arrangement rather than two separate bookings you have to coordinate yourself.',
        ],
        'what_it_is'  => [
            'heading' => 'How storage works alongside a move',
            'body'    => [
                'Items are packed and wrapped for storage rather than only for transit, because something sitting for three months needs different protection than something travelling for three hours. Upholstery is covered, hard furniture is padded and mattresses are bagged.',
                'Everything going into storage is recorded on an inventory list with a reference, so you know exactly what is held and can ask for specific items rather than describing them from memory.',
                'When you are ready, we schedule the delivery, bring the items back, and place and reassemble them at the new property in the same way as a standard move.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Moves with a date gap', 'text' => 'Your lease ends before the new property is available and the furniture needs somewhere to go in between.'],
                ['title' => 'Renovation and fit-out periods', 'text' => 'Homes or offices being renovated where furniture has to be cleared out and brought back afterwards.'],
                ['title' => 'Travelling or relocating temporarily', 'text' => 'Leaving the UAE for a period and wanting belongings kept rather than disposed of.'],
                ['title' => 'Businesses downsizing', 'text' => 'Office furniture and equipment that is not needed in the new premises but should not be discarded yet.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Collection from your property',
                'Packing and wrapping specifically for storage conditions',
                'An itemised inventory of everything stored',
                'Dismantling of large furniture so it stores safely',
                'Storage for the period you need',
                'Scheduled redelivery when you are ready',
                'Reassembly and placement at the destination',
                'Partial collection or delivery where only some items are involved',
            ],
        ],
        'process'     => [
            ['title' => 'Tell us what and how long', 'text' => 'A list of items and a rough idea of the storage period lets us quote both the handling and the storage.'],
            ['title' => 'Collection and inventory', 'text' => 'We pack, wrap and record every item against a reference list before it leaves your property.'],
            ['title' => 'Storage', 'text' => 'Your belongings are held for the agreed period, with the inventory available to you.'],
            ['title' => 'Redelivery on your date', 'text' => 'Give us notice and we schedule the return delivery to your new address.'],
            ['title' => 'Placement and reassembly', 'text' => 'Items are brought in, unwrapped, reassembled and placed where you want them.'],
        ],
        'benefits'    => [
            ['title' => 'One provider for the whole gap', 'text' => 'Collection, storage and redelivery arranged together rather than as three separate bookings.'],
            ['title' => 'Packed for storage, not just transit', 'text' => 'Protection appropriate to items that will sit for weeks or months.'],
            ['title' => 'You know what is held', 'text' => 'An itemised inventory means no guessing about what went in.'],
            ['title' => 'Flexible periods', 'text' => 'Short gaps between tenancies or longer stretches while you are away.'],
        ],
        'suits'       => [
            'heading' => 'What we store',
            'items'   => ['Household furniture', 'Appliances', 'Boxed personal belongings', 'Office furniture and equipment', 'Retail fixtures and stock', 'Seasonal and surplus items'],
        ],
        'faqs'        => [
            ['q' => 'How long can I store my belongings?', 'a' => 'From a few days between tenancies to longer periods while you are out of the country. Tell us the expected duration when you enquire and we will quote for it; if your plans change, let us know and we will extend.'],
            ['q' => 'How is storage priced?', 'a' => 'It depends on the volume of items and the length of the storage period, plus the collection and redelivery. Send us a list of what needs storing and we will quote the whole arrangement together.'],
            ['q' => 'Will I know what is in storage?', 'a' => 'Yes. Everything is recorded on an itemised inventory at collection, so you have a written record rather than relying on memory.'],
            ['q' => 'Can I collect some items before the rest?', 'a' => 'Partial deliveries can be arranged. Because everything is inventoried, we can identify specific items rather than searching by description.'],
            ['q' => 'Do you collect and deliver, or do I arrange transport?', 'a' => 'We handle both. Collection from your property and redelivery to your new address are part of the service, including packing and reassembly.'],
            ['q' => 'Is my furniture protected while stored?', 'a' => 'Items are wrapped and padded for storage before they leave your property — upholstery covered, hard furniture protected and mattresses bagged. Large pieces are dismantled where that makes them safer to store.'],
        ],
        'related'     => ['home-movers', 'office-commercial-movers', 'packing-unpacking', 'villa-movers'],
    ],

    /* ============================================================ 7 */
    'packing-unpacking' => [
        'name'        => 'Packing & Unpacking',
        'short'       => 'Professional packing with proper materials — and unpacking at the other end so you are not living out of boxes for a month.',
        'tile'        => 'Professional packing for damage-free moving.',
        'icon'        => 'box',
        'title'       => 'Packing & Unpacking in Dubai, Sharjah & Ajman',
        'description' => 'Professional packing and unpacking in Dubai, Sharjah and Ajman. Proper materials, fragile item protection, labelled boxes. Call 055 658 1781.',
        'h1'          => 'Packing & Unpacking Services in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Packed properly with the right materials, labelled by room, and unpacked at the other end so your new home is usable on day one.',
        'intro'       => [
            'Most damage in a move happens before the truck arrives. Plates stacked flat instead of on edge, a carton of books so heavy the base gives out, glassware wrapped in a tea towel — these are packing failures, not transport failures.',
            'Our packing service uses proper materials and proper method: the right carton for the weight, fragile items individually wrapped, and every box labelled with its room and contents. Unpacking is available as well, so the cartons do not simply become someone else\'s weekend.',
        ],
        'what_it_is'  => [
            'heading' => 'What professional packing involves',
            'body'    => [
                'Different contents need different treatment. Books go in small cartons because a large one becomes impossible to carry safely. Plates travel on edge with padding between them. Glasses are individually wrapped. Wardrobes go into hanging boxes so clothes arrive on their hangers rather than creased in a bag.',
                'Electronics are wrapped and boxed with padding on every side, and where the original packaging is available we use it. Televisions and monitors get rigid protection across the screen.',
                'Everything is labelled with the room it came from and a short content description. That label is what makes unpacking orderly, and what stops a kitchen carton ending up in a bedroom.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Anyone short on time', 'text' => 'Moves where packing an entire home around a working week is not realistic.'],
                ['title' => 'Homes with fragile contents', 'text' => 'Glassware, crockery, mirrors, artwork and decorative items that need individual protection.'],
                ['title' => 'People who want unpacking too', 'text' => 'Households that want the new home functional immediately rather than surrounded by cartons.'],
                ['title' => 'Partial packing needs', 'text' => 'You will handle clothes and books but want the kitchen and fragile items packed professionally.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'All packing materials — cartons in multiple sizes, bubble wrap, tissue, stretch film and tape',
                'Hanging wardrobe boxes for clothing',
                'Individual wrapping for glassware, crockery and fragile décor',
                'Rigid protection for mirrors, artwork and screens',
                'Padded packing for electronics and appliances',
                'Room-and-contents labelling on every carton',
                'Furniture wrapping and protection',
                'Unpacking at the destination where requested',
                'Placement of unpacked items into cupboards and rooms',
                'Removal of used cartons and material after unpacking',
            ],
        ],
        'process'     => [
            ['title' => 'Assess the contents', 'text' => 'We establish the volume and the amount of fragile material so we bring enough of the right cartons.'],
            ['title' => 'Pack room by room', 'text' => 'Each room is completed before the next begins, which keeps contents together and labelling accurate.'],
            ['title' => 'Protect the fragile items', 'text' => 'Glass, crockery, mirrors, artwork and electronics get individual attention and rigid protection.'],
            ['title' => 'Label everything', 'text' => 'Room and content description on every carton, so unloading goes straight to the right place.'],
            ['title' => 'Unpack and clear away', 'text' => 'At the new property we unpack, place items and take the used material away.'],
        ],
        'benefits'    => [
            ['title' => 'Damage prevented at source', 'text' => 'Correct materials and correct method, applied before anything is lifted.'],
            ['title' => 'Labelled for a fast unload', 'text' => 'Cartons arrive in the right room, which shortens the whole moving day.'],
            ['title' => 'Fragile items handled individually', 'text' => 'Glassware and décor are wrapped piece by piece, not layered into a carton and hoped for.'],
            ['title' => 'Unpacking included if you want it', 'text' => 'Your new home is usable the same day instead of a month of cardboard.'],
        ],
        'suits'       => [
            'heading' => 'What we pack',
            'items'   => ['Kitchens and crockery', 'Wardrobes and clothing', 'Books and documents', 'Electronics and screens', 'Artwork, mirrors and décor', 'Children\'s rooms and toys'],
        ],
        'faqs'        => [
            ['q' => 'Can I book packing without booking the move?', 'a' => 'Yes. Packing can be booked on its own if you have other arrangements for the transport, though most customers find it simpler to have the same crew pack and move.'],
            ['q' => 'Do you supply the boxes and materials?', 'a' => 'Yes. Cartons in several sizes, bubble wrap, tissue paper, stretch film, tape and hanging wardrobe boxes are all brought by the crew and included in the quotation.'],
            ['q' => 'How are fragile items packed?', 'a' => 'Individually. Glasses are wrapped one at a time, plates travel on edge with padding between them, and mirrors, artwork and screens get rigid protection. Fragile cartons are marked and loaded accordingly.'],
            ['q' => 'Can you pack only part of my home?', 'a' => 'Yes — many customers pack their own clothes and books and ask us to handle the kitchen, glassware and electronics. Tell us the split at quotation stage.'],
            ['q' => 'Do you unpack as well?', 'a' => 'Yes, where you request it. We unpack, place items into cupboards and rooms, and remove the used cartons and packing material.'],
            ['q' => 'How long does packing a home take?', 'a' => 'A studio can be packed in a few hours. A large villa is usually packed across more than one day. The volume of kitchen and fragile items affects it more than the number of bedrooms.'],
        ],
        'related'     => ['home-movers', 'villa-movers', 'furniture-movers', 'studio-apartment-movers'],
    ],

    /* ============================================================ 8 */
    'commercial-retail-movers' => [
        'name'        => 'Commercial & Retail Movers',
        'short'       => 'Shop and showroom relocations — fixtures, display units, stock and signage moved around your trading hours.',
        'tile'        => 'Shop and showroom moves around trading hours.',
        'icon'        => 'shop',
        'title'       => 'Commercial & Retail Movers in Dubai, Sharjah & Ajman',
        'description' => 'Retail and commercial movers for shops and showrooms in Dubai, Sharjah and Ajman. Fixtures, displays and stock. Call 055 658 1781.',
        'h1'          => 'Commercial & Retail Movers in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Shop, showroom and outlet relocations planned around trading hours — fixtures, displays, stock and signage moved as one coordinated job.',
        'intro'       => [
            'A retail move carries a cost that an office move does not: every hour the shutter is down is revenue that does not happen. That makes timing the central constraint, not an afterthought.',
            'We plan retail relocations around trading hours and mall access windows, usually working overnight or during closure periods. Fixtures, display units, shelving, counters, stock and signage are inventoried, dismantled, protected and rebuilt at the new location.',
        ],
        'what_it_is'  => [
            'heading' => 'How a retail relocation is handled',
            'body'    => [
                'We survey both units and record the fixtures, shelving, counters, display cases and stock volume. Mall and building management usually impose access windows, loading bay bookings and permitted working hours, and those constraints shape the plan from the start.',
                'Stock is packed and recorded so it can be reconciled at the other end rather than counted from scratch. Display cases, glass shelving and mirrored fixtures are protected individually.',
                'Fixtures are dismantled with fixings kept and labelled per unit, then rebuilt at the new outlet against the layout you provide, so merchandising can begin as soon as the crew is finished.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Shops and outlets relocating', 'text' => 'Retail units moving within a mall, between malls or to a different emirate.'],
                ['title' => 'Showrooms and display spaces', 'text' => 'Furniture, electronics and lifestyle showrooms with heavy display fixtures and delicate stock.'],
                ['title' => 'Restaurants and cafés', 'text' => 'Seating, counters and non-fixed equipment moved to new premises.'],
                ['title' => 'Pop-ups and temporary retail', 'text' => 'Short-term installations that need setting up and clearing on tight schedules.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Survey of both retail units and their access constraints',
                'Coordination with mall or building management windows',
                'Inventory of fixtures, displays and stock',
                'Dismantling of shelving, counters and display units',
                'Protection for glass shelving, display cases and mirrors',
                'Packing and recording of stock',
                'Careful handling of signage and branding elements',
                'Overnight and out-of-hours working',
                'Rebuild of fixtures at the new unit against your layout',
                'Clearance of packing material after setup',
            ],
        ],
        'process'     => [
            ['title' => 'Survey both units', 'text' => 'We record fixtures, stock volume, access routes and the permitted working windows at each location.'],
            ['title' => 'Plan around trading hours', 'text' => 'A schedule is built around closure periods and loading bay availability, then quoted.'],
            ['title' => 'Pack stock and dismantle fixtures', 'text' => 'Stock is packed and recorded; shelving, counters and display units come apart with fixings labelled.'],
            ['title' => 'Transport and unload', 'text' => 'Everything moves within the agreed window, protected and loaded in the order needed for the rebuild.'],
            ['title' => 'Rebuild ready for merchandising', 'text' => 'Fixtures are reassembled to your layout so stocking the shop can start immediately.'],
        ],
        'benefits'    => [
            ['title' => 'Closure time kept short', 'text' => 'The schedule is designed around when you trade, not around standard working hours.'],
            ['title' => 'Stock accounted for', 'text' => 'Packed and recorded, so what left the old unit can be reconciled at the new one.'],
            ['title' => 'Displays protected', 'text' => 'Glass shelving, cases and mirrored fixtures get individual protection rather than shared padding.'],
            ['title' => 'Rebuilt to your layout', 'text' => 'Fixtures go back together in the configuration you specify, ready for merchandising.'],
        ],
        'suits'       => [
            'heading' => 'Businesses we relocate',
            'items'   => ['Mall retail units', 'Street-front shops', 'Showrooms', 'Cafés and restaurants', 'Pharmacies and clinics', 'Pop-up and seasonal stores'],
        ],
        'faqs'        => [
            ['q' => 'Can you move our shop overnight?', 'a' => 'Yes, and for most retail units that is the right approach. Overnight and out-of-hours moves keep the closure window short and usually fit mall management access rules better than daytime work.'],
            ['q' => 'Do you handle stock as well as fixtures?', 'a' => 'Yes. Stock is packed and recorded so it can be reconciled at the new unit, and fixtures, shelving and display units are dismantled, protected and rebuilt.'],
            ['q' => 'Can you rebuild the fixtures at the new shop?', 'a' => 'Yes. Fixings are kept and labelled per unit during dismantling, and everything is reassembled to the layout you give us so merchandising can start straight away.'],
            ['q' => 'Do you coordinate with mall management?', 'a' => 'We work within the access windows, loading bay bookings and working-hour rules that the building sets. Share the requirements with us during the survey and we plan around them.'],
            ['q' => 'How is a retail move priced?', 'a' => 'By the volume of fixtures and stock, the complexity of dismantling and rebuilding, the access at both units and the working window required. Out-of-hours work is factored in at quotation stage rather than added later.'],
            ['q' => 'Can you move display cases and glass shelving?', 'a' => 'Yes. These are protected individually with rigid materials and transported separately from heavy fixtures.'],
        ],
        'related'     => ['office-commercial-movers', 'warehousing-storage', 'loading-unloading', 'furniture-assembly'],
    ],

    /* ============================================================ 9 */
    'furniture-assembly' => [
        'name'        => 'Furniture Assembly',
        'short'       => 'Flat-pack assembly, dismantling and reassembly — beds, wardrobes, desks and modular units built properly and level.',
        'tile'        => 'Assembly, dismantling and reassembly done right.',
        'icon'        => 'tools',
        'title'       => 'Furniture Assembly in Dubai, Sharjah & Ajman',
        'description' => 'Furniture assembly and dismantling in Dubai, Sharjah and Ajman. Beds, wardrobes, desks and flat-pack units built right. Call 055 658 1781.',
        'h1'          => 'Furniture Assembly Services in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Beds, wardrobes, desks and flat-pack units assembled properly — square, level and stable, with the packaging cleared away.',
        'intro'       => [
            'Flat-pack furniture is only as good as its assembly. A wardrobe built slightly out of square has doors that never sit flush, and a bed frame with under-tightened fittings develops a creak within a month.',
            'Our assembly service covers new flat-pack builds, dismantling for a move, and reassembly at the other end. The crew works from the manufacturer instructions with the right tools, checks that everything is level and square, and takes the packaging away when they are done.',
        ],
        'what_it_is'  => [
            'heading' => 'What the assembly service covers',
            'body'    => [
                'For new furniture, we unbox, check the parts against the manifest before starting, assemble according to the manufacturer instructions and position the finished piece where you want it. Missing or damaged parts are identified at the start rather than discovered halfway through.',
                'For a move, dismantling is done carefully so the piece survives being taken apart. Fixings, cam locks and shelf pins are bagged and taped to the unit, and panels are protected before they are carried.',
                'Wall-fixing is handled where it applies — tall wardrobes, bookcases and units designed to be anchored are secured to the wall as the manufacturer specifies.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'New furniture deliveries', 'text' => 'Flat-pack items delivered to your home that need building and positioning.'],
                ['title' => 'Moving in or out', 'text' => 'Furniture that must be dismantled to leave a property and rebuilt at the new one.'],
                ['title' => 'Offices setting up', 'text' => 'Workstations, desks, pedestals and storage units assembled across a new office floor.'],
                ['title' => 'Rearranging a room', 'text' => 'Pieces that need taking apart to be moved between rooms or floors.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Unboxing and a parts check before assembly begins',
                'Assembly to the manufacturer instructions',
                'Correct tools for the fittings involved',
                'Checks for square, level and stability',
                'Wall anchoring where the design requires it',
                'Dismantling with fixings bagged and labelled',
                'Reassembly after a move',
                'Positioning of the finished piece',
                'Packaging and waste removed',
            ],
        ],
        'process'     => [
            ['title' => 'Tell us the items', 'text' => 'Model names, a photo of the box or a link to the product is enough for us to estimate the time and quote.'],
            ['title' => 'Book a slot', 'text' => 'We confirm a time window and the number of fitters based on the item count.'],
            ['title' => 'Check parts first', 'text' => 'Contents are verified against the manifest before assembly starts, so missing parts surface immediately.'],
            ['title' => 'Assemble and check', 'text' => 'The piece is built to instruction, then checked for square, level and stability.'],
            ['title' => 'Position and clear up', 'text' => 'Furniture is placed where you want it and all packaging is removed.'],
        ],
        'benefits'    => [
            ['title' => 'Built to last the tenancy', 'text' => 'Correct tightening and squaring, so doors align and frames do not loosen.'],
            ['title' => 'Nothing lost in the dismantle', 'text' => 'Fixings are bagged and stay with the piece they came from.'],
            ['title' => 'Anchored where it matters', 'text' => 'Tall units are secured to the wall as the manufacturer intends.'],
            ['title' => 'Packaging gone', 'text' => 'You are not left with a room full of cardboard and polystyrene.'],
        ],
        'suits'       => [
            'heading' => 'Items we assemble',
            'items'   => ['Beds and bed frames', 'Wardrobes and closets', 'Desks and office chairs', 'Bookcases and shelving', 'TV units and sideboards', 'Dining tables', 'Workstations and partitions'],
        ],
        'faqs'        => [
            ['q' => 'Do you assemble flat-pack furniture from any brand?', 'a' => 'Yes, as long as the manufacturer instructions and fittings are with the item. Send the model name or a photo of the box and we will estimate the time involved.'],
            ['q' => 'Can you dismantle furniture as well as assemble it?', 'a' => 'Yes. Dismantling for a move is a common booking. Fixings are bagged and taped to the piece so reassembly at the new property is straightforward.'],
            ['q' => 'What if a part is missing or damaged?', 'a' => 'We check the contents against the manifest before starting, so you find out at the beginning rather than at the point of no return. You can then raise it with the supplier while we continue with the other items.'],
            ['q' => 'Will you fix the wardrobe to the wall?', 'a' => 'Where the manufacturer specifies wall anchoring, yes — tall wardrobes and bookcases are secured as designed, subject to the wall being suitable.'],
            ['q' => 'How is assembly priced?', 'a' => 'By the number of items and their complexity. A bed frame and a six-door wardrobe are very different jobs, so send us the list and we will quote against it.'],
            ['q' => 'Do you take the packaging away?', 'a' => 'Yes. Cardboard, polystyrene and wrapping are removed as part of the job.'],
        ],
        'related'     => ['furniture-movers', 'home-movers', 'office-commercial-movers', 'loading-unloading'],
    ],

    /* ============================================================ 10 */
    'loading-unloading' => [
        'name'        => 'Loading & Unloading',
        'short'       => 'Labour only — a trained crew to load or unload your vehicle or container when you already have the transport.',
        'tile'        => 'Trained crew for your own truck or container.',
        'icon'        => 'truck',
        'title'       => 'Loading & Unloading in Dubai, Sharjah & Ajman',
        'description' => 'Loading and unloading crews in Dubai, Sharjah and Ajman. Labour-only help for your own truck or container. Call 055 658 1781.',
        'h1'          => 'Loading & Unloading Services in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'You have the vehicle — we bring the crew. Trained loading and unloading with proper lifting technique and a load that is secured before it moves.',
        'intro'       => [
            'Sometimes the transport is already arranged. You have hired a truck, a container is arriving, or a delivery has been left at the kerb and there is nobody to carry it up four floors.',
            'This is a labour-only service for exactly those situations. A crew arrives with the equipment, protects the items, loads or unloads in a planned order, and secures the load so it travels without shifting.',
        ],
        'what_it_is'  => [
            'heading' => 'What loading and unloading covers',
            'body'    => [
                'Loading is more than filling a space. Weight has to sit low and be distributed across the floor, heavy items go in first with lighter and fragile ones above, and everything has to be strapped so it does not move at the first roundabout.',
                'The crew brings straps, blankets, trolleys and protective material, and protects the access route as well as the items — door frames, walls and lift interiors are where damage claims usually come from.',
                'Unloading works the same way in reverse: items are carried on a planned route and placed in the rooms you specify rather than stacked in the entrance.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Self-managed moves', 'text' => 'You have hired a vehicle and need a crew for the heavy work at one or both ends.'],
                ['title' => 'Container loading', 'text' => 'Shipping containers that need to be packed properly and secured for transit.'],
                ['title' => 'Deliveries left at the kerb', 'text' => 'Furniture or appliances delivered to the building entrance that need carrying up and positioning.'],
                ['title' => 'Businesses receiving stock', 'text' => 'One-off or scheduled unloading of goods, fixtures or equipment.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'A crew sized to the volume and the access',
                'Trolleys, straps, blankets and lifting equipment',
                'Protection of items before they are carried',
                'Protection of the access route, lift and doorways',
                'Planned load order with weight distributed correctly',
                'Securing and strapping of the load',
                'Unloading and placement into the rooms you specify',
                'Stair and multi-floor carrying where there is no lift',
            ],
        ],
        'process'     => [
            ['title' => 'Tell us the volume and access', 'text' => 'What is being moved, the vehicle size, and the floor and lift situation at the address.'],
            ['title' => 'Crew and time slot confirmed', 'text' => 'We size the crew to the work and quote the labour before booking.'],
            ['title' => 'Protect and prepare', 'text' => 'Items are wrapped where needed and the access route is protected.'],
            ['title' => 'Load or unload in order', 'text' => 'Work follows a planned sequence, with weight distribution and fragile items considered.'],
            ['title' => 'Secure or place', 'text' => 'The load is strapped for transit, or items are placed in the rooms you have specified.'],
        ],
        'benefits'    => [
            ['title' => 'Pay for labour only', 'text' => 'When you already have the vehicle, you should not have to buy transport twice.'],
            ['title' => 'Loads that arrive intact', 'text' => 'Correct order and proper strapping prevent the damage that happens in transit.'],
            ['title' => 'Property protected too', 'text' => 'Walls, door frames and lift interiors are covered before the carrying starts.'],
            ['title' => 'Stairs are not a problem', 'text' => 'Crews are sized for buildings without lift access.'],
        ],
        'suits'       => [
            'heading' => 'Where we help',
            'items'   => ['Hired moving trucks', 'Shipping containers', 'Pickup vehicles', 'Apartment deliveries', 'Villa deliveries', 'Business stock and equipment'],
        ],
        'faqs'        => [
            ['q' => 'Can I book only the crew without a truck?', 'a' => 'Yes — that is exactly what this service is for. You supply the vehicle or container, we supply the crew and equipment for loading, unloading or both.'],
            ['q' => 'Do you bring trolleys and straps?', 'a' => 'Yes. Trolleys, straps, moving blankets and protective material come with the crew as standard.'],
            ['q' => 'Can you load a shipping container?', 'a' => 'Yes. Container loading needs correct weight distribution and proper securing, and the crew works to that rather than simply filling the space.'],
            ['q' => 'What if there is no lift in the building?', 'a' => 'We size the crew accordingly. Stair carrying is slower and heavier work, so tell us the floor number when you enquire and we will plan and price it correctly.'],
            ['q' => 'How is loading and unloading priced?', 'a' => 'By the crew size and the hours involved, which depend on the volume, the access and the number of floors. Give us those details and we will quote the labour specifically.'],
            ['q' => 'Will you carry items into specific rooms?', 'a' => 'Yes. Unloading includes placing items in the rooms you specify rather than leaving everything at the entrance.'],
        ],
        'related'     => ['furniture-movers', 'home-movers', 'commercial-retail-movers', 'local-moving'],
    ],

    /* ============================================================ 11 */
    'local-moving' => [
        'name'        => 'Local Moving',
        'short'       => 'Short-distance moves within and between Dubai, Sharjah and Ajman — usually completed in a single day.',
        'tile'        => 'Short-distance moves, usually done in a day.',
        'icon'        => 'route',
        'title'       => 'Local Moving Services in Dubai, Sharjah & Ajman',
        'description' => 'Local moving services within and between Dubai, Sharjah and Ajman. Short-distance moves usually completed the same day. Call 055 658 1781 for a free quote.',
        'h1'          => 'Local Moving Services in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Short-distance moves handled in a single day — within your building, across your area, or between Dubai, Sharjah and Ajman.',
        'intro'       => [
            'Most moves in this part of the UAE are local ones: a different building in the same community, a bigger flat two streets away, or a shift from Sharjah to Dubai for a shorter commute.',
            'Short distance does not mean less care. The packing, protection and reassembly are the same — what changes is the logistics, because a local move can often be done in one continuous run and finished the same day.',
        ],
        'what_it_is'  => [
            'heading' => 'What a local move looks like',
            'body'    => [
                'Because the distance is short, the crew works in one continuous flow: pack, load, drive, unload, rebuild. There is no overnight staging and no long transit, which is why most local moves finish inside a day.',
                'The main variables are access rather than distance. Two towers ten minutes apart can produce very different timelines depending on lift availability, service entrance rules and the time windows each building permits.',
                'We confirm those access details for both addresses in advance, because that is what actually determines when your local move finishes.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Same-area moves', 'text' => 'Changing apartment or villa within the same community or a neighbouring one.'],
                ['title' => 'Cross-emirate commutes', 'text' => 'Sharjah to Dubai, Dubai to Sharjah, or moves involving Ajman, done as one trip.'],
                ['title' => 'Same-building moves', 'text' => 'Moving between floors or units in the same tower.'],
                ['title' => 'Quick turnarounds', 'text' => 'Lease-end moves where the old flat has to be cleared and the new one occupied on the same day.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Access check at both addresses before the day',
                'Packing materials and packing where requested',
                'Furniture protection and wrapping',
                'Dismantling and reassembly of large items',
                'Loading, short-distance transport and unloading',
                'Placement of cartons and furniture by room',
                'Same-day completion for most local moves',
                'Multiple trips where a single load is not practical',
            ],
        ],
        'process'     => [
            ['title' => 'Confirm both addresses', 'text' => 'We check floors, lifts, service entrances and permitted moving hours for each building.'],
            ['title' => 'Quote and schedule', 'text' => 'A single-day slot with crew and vehicle sized to the property.'],
            ['title' => 'Clear the old property', 'text' => 'Pack where requested, protect the furniture, dismantle what needs it and load.'],
            ['title' => 'Short transit', 'text' => 'The load travels directly to the new address, usually in one run.'],
            ['title' => 'Set up the new property', 'text' => 'Furniture rebuilt and placed, cartons distributed by room, and a final check with you.'],
        ],
        'benefits'    => [
            ['title' => 'Usually done in a day', 'text' => 'One continuous run rather than a move spread across two days.'],
            ['title' => 'Access planned in advance', 'text' => 'Lift bookings and building rules confirmed before the crew arrives.'],
            ['title' => 'Same standard of care', 'text' => 'Short distance does not mean less wrapping or a rushed load.'],
            ['title' => 'All three emirates as one service area', 'text' => 'Dubai, Sharjah and Ajman moves are routine, not special arrangements.'],
        ],
        'suits'       => [
            'heading' => 'Moves we cover',
            'items'   => ['Apartments', 'Villas and townhouses', 'Studios', 'Shared accommodation', 'Small offices', 'Single-room moves'],
        ],
        'faqs'        => [
            ['q' => 'What counts as a local move?', 'a' => 'Any move within or between Dubai, Sharjah and Ajman — including within the same building. These are short-distance jobs that can normally be completed in one day.'],
            ['q' => 'Can you move me from Sharjah to Dubai in one day?', 'a' => 'Yes. Moves between Sharjah, Dubai and Ajman are part of our normal service area and are usually completed the same day, subject to the volume and building access at both ends.'],
            ['q' => 'Is a local move cheaper than a long-distance one?', 'a' => 'Generally yes, because the transit is shorter and the job is usually completed in one visit. The bigger cost drivers are the volume of contents, packing requirements and access at both addresses.'],
            ['q' => 'Can you move me within the same building?', 'a' => 'Yes. Moves between floors or units in the same tower are common and are typically quicker, though lift availability still sets the pace.'],
            ['q' => 'Do you do same-day moves?', 'a' => 'Where our schedule allows it, yes. Call us with the date and details and we will tell you honestly what is available rather than promising a slot we cannot hold.'],
            ['q' => 'Do you still pack and wrap for a short move?', 'a' => 'Yes. Damage happens during handling, not during the drive, so the protection is exactly the same regardless of distance.'],
        ],
        'related'     => ['home-movers', 'studio-apartment-movers', 'furniture-movers', 'loading-unloading'],
    ],

    /* ============================================================ 12 */
    'car-transportation' => [
        'name'        => 'Car Transportation',
        'short'       => 'Vehicle transport arranged alongside your move — collected from one address and delivered to the other.',
        'tile'        => 'Vehicle transport arranged alongside your move.',
        'icon'        => 'car',
        'title'       => 'Car Transportation in Dubai, Sharjah & Ajman',
        'description' => 'Car and vehicle transportation between Dubai, Sharjah and Ajman, arranged alongside your move. Collection and delivery coordinated for you. Call 055 658 1781.',
        'h1'          => 'Car Transportation in Dubai, Sharjah & Ajman',
        'hero_sub'    => 'Vehicle transport coordinated with your move — collected from your current address and delivered to the new one.',
        'intro'       => [
            'Moving between emirates with more than one vehicle creates an awkward problem: somebody has to drive each car, and that somebody is usually needed at the property while the move is happening.',
            'Our car transportation service handles that. The vehicle is collected from your current address and delivered to your new one, coordinated with the household move so both arrive when you need them.',
        ],
        'what_it_is'  => [
            'heading' => 'How vehicle transport is arranged',
            'body'    => [
                'We take the vehicle details, the collection and delivery addresses and your preferred timing, then coordinate the transport alongside your move so the schedules line up.',
                'The vehicle is inspected and its condition recorded before collection, with the record confirmed again at delivery. Personal belongings should be removed from the car beforehand, as the transport covers the vehicle itself.',
                'Where vehicle transport is booked with a household move, we align the two so you are not left waiting at a new property without a car, or driving back across the emirate to collect one.',
            ],
        ],
        'who_for'     => [
            'heading' => 'Who this service is for',
            'items'   => [
                ['title' => 'Households with more than one car', 'text' => 'Families relocating with multiple vehicles and not enough drivers on moving day.'],
                ['title' => 'Cross-emirate relocations', 'text' => 'Moves between Dubai, Sharjah and Ajman where the vehicle needs to arrive with the household.'],
                ['title' => 'Vehicles that are not being driven', 'text' => 'A second car, a vehicle awaiting registration work, or one that is simply not in daily use.'],
                ['title' => 'Anyone short on time', 'text' => 'Where making a separate trip to move each vehicle is not practical around the move itself.'],
            ],
        ],
        'includes'    => [
            'heading' => 'What is included',
            'items'   => [
                'Collection from your current address',
                'Condition recorded before collection',
                'Transport coordinated with your household move date',
                'Delivery to your new address',
                'Condition confirmed with you at delivery',
                'Timing coordinated so the car and household arrive together',
            ],
        ],
        'process'     => [
            ['title' => 'Share the vehicle details', 'text' => 'Make, model, collection and delivery addresses, and whether the vehicle is currently driveable.'],
            ['title' => 'Confirm timing and quote', 'text' => 'We align the transport with your move date and confirm the price before booking.'],
            ['title' => 'Collection and condition check', 'text' => 'The vehicle is inspected and its condition recorded before it is collected.'],
            ['title' => 'Transport', 'text' => 'The vehicle travels to the delivery address on the agreed schedule.'],
            ['title' => 'Delivery and confirmation', 'text' => 'The vehicle is handed over and its condition confirmed with you at the new address.'],
        ],
        'benefits'    => [
            ['title' => 'One point of coordination', 'text' => 'Household move and vehicle transport arranged together instead of separately.'],
            ['title' => 'Frees up your moving day', 'text' => 'You do not need a driver for every car while the move is in progress.'],
            ['title' => 'Condition recorded both ends', 'text' => 'A clear record before collection and again at delivery.'],
            ['title' => 'Timed to arrive with you', 'text' => 'The vehicle is at the new address when you need it, not days later.'],
        ],
        'suits'       => [
            'heading' => 'Vehicles we move',
            'items'   => ['Family cars', 'Second vehicles', 'Non-running vehicles by arrangement', 'Vehicles moving between emirates', 'Vehicles moving with a household relocation'],
        ],
        'faqs'        => [
            ['q' => 'Do you transport cars between Dubai, Sharjah and Ajman?', 'a' => 'Yes. Vehicle transport within our service area is arranged alongside household moves, with collection from your current address and delivery to the new one.'],
            ['q' => 'Can I leave belongings in the car?', 'a' => 'Please remove personal belongings before collection. The service covers the vehicle itself, and items left inside are not part of what is transported.'],
            ['q' => 'Is the vehicle checked before transport?', 'a' => 'Yes. The condition is recorded before collection and confirmed with you again at delivery, so there is a clear record at both ends.'],
            ['q' => 'Can you move a car that does not start?', 'a' => 'Tell us in advance — a non-running vehicle needs different handling and equipment, and we will confirm whether we can arrange it for your specific case before you book.'],
            ['q' => 'Can the car arrive on the same day as my furniture?', 'a' => 'That is usually the point of booking both together. We coordinate the schedules so the vehicle arrives when you need it rather than days after the household move.'],
            ['q' => 'How is car transportation priced?', 'a' => 'By the vehicle, the collection and delivery addresses and the timing required. Share the details and we will quote for your specific move.'],
        ],
        'related'     => ['home-movers', 'villa-movers', 'local-moving', 'office-commercial-movers'],
    ],
];

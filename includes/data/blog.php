<?php
/**
 * Blog articles.
 *
 * Four substantial, genuinely useful guides rather than a dozen thin ones —
 * thin posts do nothing for rankings and less for the reader. Each section is
 * a heading plus typed blocks, rendered by includes/templates/blog-post.php.
 *
 * Block types: 'p' (string), 'h3' (string), 'ul' / 'ol' (array), 'note' (string).
 */

declare(strict_types=1);

return [

    /* ============================================================ */
    'moving-checklist-dubai-sharjah-ajman' => [
        'title'       => 'Moving Checklist for Dubai, Sharjah & Ajman',
        'title_h1'    => 'A Practical Moving Checklist for Dubai, Sharjah and Ajman',
        'description' => 'A week-by-week moving checklist for UAE residents — building permits, lift bookings, utilities, packing order and what to do on moving day.',
        'excerpt'     => 'Most moving-day problems are scheduling problems that started four weeks earlier. Here is the order to do things in.',
        'published'   => '2026-07-14',
        'modified'    => '2026-08-12',
        'read_time'   => '9 min read',
        'category'    => 'Moving guides',
        'intro'       => [
            'Almost every moving day that goes badly went wrong earlier — a lift that was never booked, a building permit nobody mentioned, a utility disconnection scheduled for the wrong date. The physical work is rarely the problem.',
            'This checklist is ordered by when things actually need to happen, not by how important they feel. Work backwards from your moving date and most of the usual failures disappear.',
        ],
        'sections'    => [
            [
                'heading' => 'Four weeks before: decisions and paperwork',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'This is the stage where you create room to manoeuvre. Everything here is administrative, and every item on it takes longer than you expect because it depends on somebody else responding.'],
                    ['type' => 'ul', 'content' => [
                        'Confirm your handover date at the old property and your access date at the new one — and note whether they overlap. If they do not, you need storage, and it is much cheaper to arrange now than in the final week.',
                        'Check your tenancy notice requirements and give notice in writing.',
                        'Ask both building managements what they require for a move. In many UAE towers this means a moving permit or NOC, a booked service lift slot, and sometimes a security deposit or proof of insurance from the moving company.',
                        'Get quotations. For an apartment, a video walkthrough over WhatsApp is usually enough. For a villa, insist on a site survey — a villa quoted over the phone is a villa quoted wrong.',
                        'Start a "do not move" list: documents, passports, jewellery, medication, laptops. These travel with you, not in the truck.',
                    ]],
                    ['type' => 'note', 'content' => 'The single most common scheduling failure in UAE moves is the service lift. Buildings often issue slots in two-hour blocks, and popular slots at month end are taken weeks in advance.'],
                ],
            ],
            [
                'heading' => 'Three weeks before: reduce the volume',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Moving cost is driven by volume more than by distance. Every item you dispose of now is an item you do not pay to pack, carry, transport and unpack.'],
                    ['type' => 'ul', 'content' => [
                        'Go room by room and separate what you are keeping, selling, donating and discarding.',
                        'List sale items early — collection takes longer than listing does.',
                        'Empty the store room and the top of every wardrobe. This is where forgotten volume hides.',
                        'Check what will actually fit in the new property. Villa furniture rarely fits into an apartment, and finding that out on moving day is expensive.',
                        'Decide what needs specialist handling: chandeliers, large mirrors, artwork, marble tops, pianos, aquariums, safes.',
                    ]],
                ],
            ],
            [
                'heading' => 'Two weeks before: confirm the logistics',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Confirm the booking with your movers in writing — date, arrival time, crew size, vehicle, scope of packing and the agreed price.',
                        'Submit the moving permit or NOC application to both buildings and get the approval in writing.',
                        'Book the service lift at both addresses. Note the exact time window and whether it can be extended.',
                        'Arrange your utilities. Schedule the final reading and disconnection at the old property for the day after the move, not the day of it — you will want lights and air conditioning while you are clearing the place.',
                        'Set up the utility connection at the new property to be live before you arrive.',
                        'Arrange internet installation at the new property. This has the longest lead time of anything on this list.',
                        'Update your address with your bank, telecoms provider, insurers, employer, schools and any delivery services you use.',
                    ]],
                ],
            ],
            [
                'heading' => 'One week before: pack in the right order',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'If your movers are packing for you, this week is mostly preparation. If you are packing yourself, the order matters more than the speed.'],
                    ['type' => 'h3', 'content' => 'Pack in this sequence'],
                    ['type' => 'ol', 'content' => [
                        'Store rooms, spare rooms and anything seasonal — nothing here is needed before the move.',
                        'Books, decorative items and wall-mounted pieces.',
                        'Out-of-season clothing and spare bedding.',
                        'Kitchen items you are not using this week — serving dishes, appliances, surplus crockery.',
                        'Everyday items, packed last and unpacked first.',
                    ]],
                    ['type' => 'h3', 'content' => 'Rules that save you on the other side'],
                    ['type' => 'ul', 'content' => [
                        'Label every carton with the room it is going to and what is inside. "Kitchen — glasses, fragile" beats "Kitchen 4".',
                        'Heavy items go in small cartons. A large carton full of books cannot be carried safely and will fail at the base.',
                        'Plates travel on edge, not stacked flat, with padding between them.',
                        'Bag and tape screws, bolts and shelf pins to the furniture they came from.',
                        'Photograph the back of your television and any complex cable setup before disconnecting anything.',
                        'Pack a separate "first night" box: bedding, towels, toiletries, phone chargers, basic tools, a change of clothes and anything the children or pets need. It travels in your car.',
                    ]],
                ],
            ],
            [
                'heading' => 'The day before',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Defrost and dry the fridge and freezer. A fridge moved wet arrives smelling of it.',
                        'Charge your phone and a power bank.',
                        'Confirm the crew arrival time and re-check the lift booking window.',
                        'Set aside the "do not move" items and the first-night box somewhere the crew will not load them.',
                        'Draw a simple floor plan of the new property and mark which room each item goes to. Give a copy to the crew leader — it saves an hour of questions.',
                        'Withdraw any cash you need and keep your documents on you.',
                    ]],
                ],
            ],
            [
                'heading' => 'Moving day',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Walk the crew through the property before they start. Point out anything fragile, valuable or awkward.',
                        'Confirm which items are not being moved.',
                        'Stay reachable but out of the working route — a crew that has to walk around you moves slower.',
                        'Before the truck leaves, check every room, wardrobe, cupboard, balcony and the store room. Then check them again.',
                        'At the new property, direct large furniture first. It is far easier to place a wardrobe before the room fills with cartons.',
                        'Check that everything we dismantled has been reassembled before the crew leaves.',
                        'Do a final walkthrough with the crew leader and raise anything you are unhappy with while they are still there.',
                    ]],
                    ['type' => 'note', 'content' => 'Raise damage on the day, in front of the crew. It is far easier to resolve at the property than three days later over the phone.'],
                ],
            ],
            [
                'heading' => 'The first week in the new property',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Unpack the kitchen and bedrooms first. A functioning kitchen and a made bed make everything else feel manageable.',
                        'Test every appliance, socket, tap and air conditioning unit and report faults to the landlord immediately — early reports are treated as pre-existing, late ones are not.',
                        'Photograph the property\'s condition on the day you move in and keep the images.',
                        'Arrange collection of the empty cartons and packing material.',
                        'Update your address anywhere you missed.',
                    ]],
                ],
            ],
        ],
        'related_services'  => ['home-movers', 'packing-unpacking', 'villa-movers', 'warehousing-storage'],
        'related_locations' => ['dubai', 'sharjah', 'ajman'],
    ],

    /* ============================================================ */
    'how-much-does-moving-cost-dubai' => [
        'title'       => 'How Much Does Moving Cost in Dubai & Sharjah?',
        'title_h1'    => 'What Actually Determines the Cost of a Move in the UAE',
        'description' => 'What really drives moving costs in Dubai, Sharjah and Ajman — property size, access, packing, distance and the extras — plus how to compare quotes fairly.',
        'excerpt'     => 'Anyone who quotes a moving price before asking about your property is guessing. Here is what the number is actually made of.',
        'published'   => '2026-07-28',
        'modified'    => '2026-08-20',
        'read_time'   => '8 min read',
        'category'    => 'Costs & planning',
        'intro'       => [
            'The honest answer to "how much does moving cost" is that it depends — but that answer is only useful if someone explains what it depends on. This article does that, so you can judge a quotation instead of just comparing numbers.',
            'We are not going to publish a price list. A studio with a lift and a five-bedroom villa with stairs are different jobs by an order of magnitude, and a fixed figure would be wrong for almost everybody who read it.',
        ],
        'sections'    => [
            [
                'heading' => 'The five things that actually drive the price',
                'blocks'  => [
                    ['type' => 'h3', 'content' => '1. Volume of belongings'],
                    ['type' => 'p', 'content' => 'This is the largest factor, and it is not the same as the number of bedrooms. Two identical three-bedroom apartments can differ by half a truckload depending on how long the occupants have lived there. Volume determines the vehicle size, the crew size and the number of hours, which together are most of the cost.'],
                    ['type' => 'h3', 'content' => '2. Access at both addresses'],
                    ['type' => 'p', 'content' => 'Access is the factor people most often forget to mention, and the one that most often changes a quote on the day. What matters is the floor number, whether there is a service lift, whether that lift can be booked, how far the carry is from the loading bay to the door, and whether the vehicle can park near the entrance.'],
                    ['type' => 'p', 'content' => 'A fourth-floor flat with no lift does not just take longer — it needs more people, because carrying loads down stairs safely requires a larger crew. That is a real cost difference, not an upsell.'],
                    ['type' => 'h3', 'content' => '3. Packing'],
                    ['type' => 'p', 'content' => 'Packing is labour plus materials. A full pack of a family home is a substantial part of the total cost, because a kitchen alone can take a crew several hours to pack properly. Many customers reduce cost by packing their own clothes and books and having the crew handle the kitchen, glassware and electronics — the items where poor packing actually causes damage.'],
                    ['type' => 'h3', 'content' => '4. Distance and route'],
                    ['type' => 'p', 'content' => 'Within and between Dubai, Sharjah and Ajman, distance is a smaller factor than most people assume. What matters more is whether the job fits in one continuous run or needs multiple trips, and how the timing interacts with traffic. A cross-emirate move at the right time of day can be quicker than a cross-city one at the wrong time.'],
                    ['type' => 'h3', 'content' => '5. Additional services'],
                    ['type' => 'ul', 'content' => [
                        'Furniture dismantling and reassembly',
                        'Storage between move-out and move-in dates',
                        'Furniture assembly for newly purchased items',
                        'Car transportation',
                        'Removal of used packing material after unpacking',
                        'Handling of specialist items — chandeliers, safes, pianos, large aquariums',
                    ]],
                ],
            ],
            [
                'heading' => 'Why a phone quote without questions should worry you',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'If a company gives you a firm price without asking about your floor, your lift, your inventory or your access, one of two things is happening. Either the number is high enough to cover the worst case — in which case you are overpaying if your move is straightforward — or it is low enough to win the booking and will be revised upward once the crew is standing in your living room.'],
                    ['type' => 'p', 'content' => 'The second is more common, and it is effective precisely because it happens at the point where you have no alternative. Your furniture is half-wrapped and the building lift is booked for the next two hours.'],
                    ['type' => 'note', 'content' => 'A quote that comes after questions is not a company being difficult. It is a company trying to give you a number that will still be true on moving day.'],
                ],
            ],
            [
                'heading' => 'How to compare quotations fairly',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Comparing moving quotes on price alone is how people end up with the most expensive move. Compare scope first, then price.'],
                    ['type' => 'ul', 'content' => [
                        'Is packing included, and is it full packing or partial? Which rooms?',
                        'Are packing materials included, or charged separately by the carton?',
                        'Is furniture dismantling included? Is reassembly included, or only dismantling?',
                        'How many crew members and what vehicle size does the quote assume?',
                        'What time window is quoted, and what happens if the job runs beyond it?',
                        'Are stairs, long carries or a second trip priced in, or treated as extras?',
                        'Is removal of used packing material included?',
                        'What are the payment terms and the cancellation terms?',
                    ]],
                    ['type' => 'p', 'content' => 'Once you have those answers, the quotes are actually comparable. Often the cheapest headline number turns out to be the most expensive complete job.'],
                ],
            ],
            [
                'heading' => 'Practical ways to reduce your moving cost',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Reduce volume before you get quoted. Sell, donate or discard first — you pay to move everything you keep.',
                        'Pack your own clothes, books and non-fragile items, and let the crew handle the kitchen, glassware and electronics.',
                        'Avoid month-end and the last days of the tenancy cycle if you can. Demand peaks there and availability is tighter.',
                        'Book early. Short-notice moves limit which crew and vehicle combination is available.',
                        'Be accurate about your inventory and access. An accurate quote is almost always cheaper than an inaccurate one plus the corrections.',
                        'Do the utilities and building paperwork yourself rather than paying someone to coordinate it.',
                        'If your dates do not line up, price a single provider handling the move and the storage together instead of two separate arrangements.',
                    ]],
                ],
            ],
            [
                'heading' => 'What we need in order to quote you accurately',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'You can get a specific figure from us quickly if you send these details:'],
                    ['type' => 'ul', 'content' => [
                        'Both addresses, or at least both areas and emirates',
                        'The property type and number of bedrooms',
                        'Floor number and lift availability at each address',
                        'Your preferred moving date and any flexibility around it',
                        'Whether you want packing, and if so full or partial',
                        'Anything unusually large, heavy, fragile or valuable',
                    ]],
                    ['type' => 'p', 'content' => 'A short video walkthrough of the property over WhatsApp covers most of that in about ninety seconds and is the fastest route to an accurate number.'],
                ],
            ],
        ],
        'related_services'  => ['home-movers', 'packing-unpacking', 'villa-movers', 'local-moving'],
        'related_locations' => ['dubai', 'sharjah', 'ajman'],
    ],

    /* ============================================================ */
    'how-to-pack-furniture-safely' => [
        'title'       => 'How to Pack Furniture Safely for a Move',
        'title_h1'    => 'How to Pack and Protect Furniture So It Arrives Intact',
        'description' => 'How to protect sofas, wardrobes, glass, mirrors and mattresses for a move — the right materials, the right order, and the mistakes to avoid.',
        'excerpt'     => 'Nearly all moving damage is decided before anything is lifted. Here is how furniture is protected properly.',
        'published'   => '2026-08-05',
        'modified'    => '2026-08-22',
        'read_time'   => '10 min read',
        'category'    => 'Packing & handling',
        'intro'       => [
            'When furniture is damaged during a move, the cause is almost never the drive. It is a corner that met a door frame, a glass top that travelled flat, or a wardrobe that was pushed through a gap it did not fit through.',
            'All three are preventable, and all three are prevented before anything is lifted. This is how furniture is protected properly, and where the common mistakes are.',
        ],
        'sections'    => [
            [
                'heading' => 'Materials, and what each is actually for',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Moving blankets — the primary protection for hard furniture. They absorb impact, which bubble wrap does not.',
                        'Stretch film — holds blankets in place and protects upholstery from dirt. It is not impact protection on its own.',
                        'Bubble wrap — for fragile and delicate surfaces, not as a substitute for blankets on heavy furniture.',
                        'Corner protectors — cardboard or foam on every exposed corner and edge. Corners take almost every impact.',
                        'Cardboard sheets — rigid protection across glass, mirrors and screens.',
                        'Mattress bags — keep mattresses clean and dry; a wrapped mattress does not become a floor mat.',
                        'Masking tape — for taping across glass and for attaching fixing bags. Never put tape directly on a polished or veneered surface.',
                        'Sealable bags — for screws, bolts, cam locks and shelf pins.',
                    ]],
                    ['type' => 'note', 'content' => 'Never apply packing tape directly to wood, veneer, leather or a painted surface. It lifts finish when removed. Tape goes onto the blanket or the film, never onto the furniture.'],
                ],
            ],
            [
                'heading' => 'Sofas and upholstered furniture',
                'blocks'  => [
                    ['type' => 'ol', 'content' => [
                        'Remove the cushions and pack them separately — they are bulky, light, and useful for filling gaps in the vehicle.',
                        'Remove the legs if they unscrew. Legs are what catch on door frames and snap.',
                        'Wrap the whole frame in stretch film to keep the fabric clean.',
                        'Add moving blankets over the arms and back, where impacts land.',
                        'Protect the corners specifically, then film over the blankets to hold them.',
                    ]],
                    ['type' => 'p', 'content' => 'For leather, put a soft cover or blanket against the leather itself before filming. Stretch film in direct contact with leather over several hours in UAE heat can mark the surface.'],
                ],
            ],
            [
                'heading' => 'Wardrobes, cabinets and large case furniture',
                'blocks'  => [
                    ['type' => 'ol', 'content' => [
                        'Empty it completely. Moving a loaded wardrobe damages the wardrobe and the people carrying it.',
                        'Remove drawers and shelves and pack them separately.',
                        'Tape doors closed over the blanket, never directly onto the finish.',
                        'Decide honestly whether it will clear the doorway, corridor and lift. Measure if you are unsure.',
                        'If it will not clear the route, dismantle it. Bag the fixings and tape the bag to the inside of the carcass.',
                        'Blanket the whole unit with dedicated corner protection, then film over the blankets.',
                    ]],
                    ['type' => 'p', 'content' => 'Flat-pack wardrobes and cabinets are far more fragile in transit than solid wood ones. Particle board holds well under compression and fails under twisting, which is exactly what happens when a heavy unit is carried at an angle down a stairwell. Dismantle these rather than carrying them whole whenever the route is tight.'],
                ],
            ],
            [
                'heading' => 'Glass, mirrors and marble',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'These items are the reason experienced crews slow down. They are also the items most often broken by people moving themselves.'],
                    ['type' => 'ul', 'content' => [
                        'Remove glass tops from tables and pack them separately from the base. Never move a glass-topped table in one piece.',
                        'Tape an X across large panes of glass. It does not prevent breakage, but it holds the pane together if it does break, which is a safety measure.',
                        'Wrap in bubble wrap, then sandwich between rigid cardboard sheets.',
                        'Mark the package clearly as glass on both faces.',
                        'Transport glass, mirrors and marble upright and on edge, never flat. Flat is how they crack — a supported edge is enormously stronger than an unsupported face.',
                        'Marble is heavier than it looks and cracks along its veining. Two people minimum, always on edge, always supported along the full length.',
                    ]],
                ],
            ],
            [
                'heading' => 'Beds and mattresses',
                'blocks'  => [
                    ['type' => 'ol', 'content' => [
                        'Photograph the frame assembly before you take it apart. You will not remember it.',
                        'Dismantle the frame; bag the fixings and tape the bag to the headboard.',
                        'Put the mattress in a mattress bag — this is not optional if it will be stored or if the vehicle floor is not spotless.',
                        'Carry the mattress on edge, with two people. A single person folding a mattress to get it through a door damages the internal structure.',
                        'Protect the headboard with blankets, especially if it is upholstered or has a decorative finish.',
                    ]],
                    ['type' => 'note', 'content' => 'Slatted bases and bed slats get lost more often than any other component. Bundle and label them together, and count them before and after.'],
                ],
            ],
            [
                'heading' => 'Appliances',
                'blocks'  => [
                    ['type' => 'ul', 'content' => [
                        'Defrost and dry the fridge at least 24 hours before the move, and leave the door slightly ajar overnight.',
                        'Tape doors closed for transit, over the blanket rather than onto the appliance.',
                        'Secure the washing machine drum if the manufacturer supplied transit bolts — an unsecured drum is the most common cause of transit damage to a washing machine.',
                        'Coil and tape power cables to the back of the unit so nobody trips over them mid-carry.',
                        'Transport fridges upright. Where an appliance has to be laid down, follow the manufacturer guidance on standing time before switching it back on.',
                        'Keep the original packaging for smaller appliances if you have it — nothing you improvise will fit as well.',
                    ]],
                ],
            ],
            [
                'heading' => 'Loading: the part that gets skipped',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Protection applied carefully and then loaded badly achieves nothing. The load order is part of the protection.'],
                    ['type' => 'ul', 'content' => [
                        'Heaviest items first, positioned low and against the front wall of the vehicle.',
                        'Distribute weight across the floor rather than concentrating it on one side.',
                        'Stand mattresses, glass and mirrors upright against a wall of the vehicle, secured.',
                        'Fill gaps with cushions, soft bags and blankets so nothing can shift.',
                        'Strap the load. Every layer. This is the single most skipped step and the most common cause of transit damage.',
                        'Fragile cartons go on top, never underneath anything.',
                        'Protect the property too — door frames, wall corners and lift interiors. Damage claims from buildings are as expensive as damage to your own furniture.',
                    ]],
                ],
            ],
            [
                'heading' => 'The five mistakes that cause most damage',
                'blocks'  => [
                    ['type' => 'ol', 'content' => [
                        'Moving glass tops flat instead of on edge.',
                        'Forcing furniture through a gap instead of dismantling it — this damages the furniture and the doorway.',
                        'Not strapping the load, so everything shifts on the first roundabout.',
                        'Putting tape directly on finished surfaces.',
                        'Loose fixings in a general bag rather than attached to the piece they belong to. The item survives the move and never goes back together properly.',
                    ]],
                ],
            ],
        ],
        'related_services'  => ['packing-unpacking', 'furniture-movers', 'furniture-assembly', 'loading-unloading'],
        'related_locations' => ['dubai', 'sharjah', 'ajman'],
    ],

    /* ============================================================ */
    'moving-between-dubai-sharjah-ajman' => [
        'title'       => 'Moving Between Dubai, Sharjah and Ajman',
        'title_h1'    => 'Moving Between Dubai, Sharjah and Ajman',
        'description' => 'What a cross-emirate move between Dubai, Sharjah and Ajman actually involves — timing, building access, utilities, costs and how to plan a single-day move.',
        'excerpt'     => 'Cross-emirate moves in the northern UAE are short runs. What makes them long is everything except the driving.',
        'published'   => '2026-08-18',
        'modified'    => '2026-08-25',
        'read_time'   => '7 min read',
        'category'    => 'Moving guides',
        'intro'       => [
            'Moving between Dubai, Sharjah and Ajman is one of the most common relocations in the northern UAE — usually driven by commute, rent or space. It is also one of the most misunderstood, because people assume the emirate boundary makes it a long-distance move.',
            'It does not. These are short runs. What extends a cross-emirate moving day is almost never the drive — it is the buildings at each end, the timing, and the paperwork.',
        ],
        'sections'    => [
            [
                'heading' => 'It is a single-day move for most households',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Sharjah to Dubai, Dubai to Sharjah, Ajman to Sharjah, Ajman to Dubai — for a typical apartment or a moderately sized villa, all of these are comfortably completed within one day, including packing at one end and reassembly at the other.'],
                    ['type' => 'p', 'content' => 'What pushes a cross-emirate move into two days is volume, not distance. A large villa with several days of packing is a two-day job whether it moves across the street or across the emirate.'],
                ],
            ],
            [
                'heading' => 'Timing is the real variable',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'The corridors between these three emirates carry heavy commuter traffic at predictable times. A run that takes forty minutes mid-morning can take considerably longer in the evening peak, and a crew stuck in traffic is a crew not unloading.'],
                    ['type' => 'ul', 'content' => [
                        'Start early. An early start gets the loaded vehicle onto the road before the worst of the traffic.',
                        'Avoid arriving at the new building during the evening peak, when the lift is busiest with residents.',
                        'Check whether either building restricts moving hours. Many do, and the permitted window is often narrower than you expect.',
                        'Where both buildings have lift restrictions, the two windows have to overlap sensibly. This is worth checking a week ahead, not on the day.',
                    ]],
                ],
            ],
            [
                'heading' => 'Building access differs between the emirates',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'The practical differences between these three emirates are mostly about buildings rather than geography.'],
                    ['type' => 'h3', 'content' => 'Dubai'],
                    ['type' => 'p', 'content' => 'High-rise buildings and managed communities are common, and so are formal requirements: a moving permit or NOC from building management, a booked service lift slot, security registration for the crew, and restricted working hours. None of this is difficult, but all of it takes time to arrange and cannot be done on the morning of the move.'],
                    ['type' => 'h3', 'content' => 'Sharjah'],
                    ['type' => 'p', 'content' => 'A broader mix of building ages. Newer towers work much like Dubai\'s; older blocks frequently have no service lift, and sometimes no lift at all. That single factor changes the crew size more than anything else, so it needs to be established before quoting rather than discovered on arrival.'],
                    ['type' => 'h3', 'content' => 'Ajman'],
                    ['type' => 'p', 'content' => 'Predominantly mid-rise residential buildings with highly variable lift access — some have a service lift available on request, some have one shared passenger lift, and older buildings may have none. Street access for the vehicle can also be tighter than the property size suggests, so the carry route is worth planning in advance.'],
                ],
            ],
            [
                'heading' => 'Utilities and address changes',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Each emirate has its own utility provider, so a cross-emirate move means closing one account and opening another rather than transferring a single one. Start this two weeks ahead.'],
                    ['type' => 'ul', 'content' => [
                        'Arrange the final meter reading and account closure at the old property — for the day after the move, not the day of it.',
                        'Set up the new connection so it is live before you arrive. Moving into a property with no air conditioning is a mistake you make once.',
                        'Book internet installation early; it has the longest lead time of anything in a move.',
                        'Update your address with your bank, employer, telecoms provider, insurers, schools and delivery services.',
                        'If your tenancy contract or residency documents reference the address, check what needs updating and when.',
                    ]],
                ],
            ],
            [
                'heading' => 'Does crossing an emirate cost more?',
                'blocks'  => [
                    ['type' => 'p', 'content' => 'Marginally, and much less than most people expect. Over these distances the transit is a small part of the job. The cost is dominated by the same factors as any other move: the volume of belongings, whether you want packing, and the access at both addresses.'],
                    ['type' => 'p', 'content' => 'A ground-floor two-bedroom in Ajman moving to a ground-floor two-bedroom in Dubai will often cost less than a fourth-floor apartment moving to another fourth-floor apartment within the same city, where neither building has a lift. Stairs cost more than kilometres.'],
                ],
            ],
            [
                'heading' => 'A short checklist for a cross-emirate move',
                'blocks'  => [
                    ['type' => 'ol', 'content' => [
                        'Confirm handover and access dates at both properties, and identify any gap between them — that gap means storage.',
                        'Get a quotation based on your actual inventory and access, not a phone estimate.',
                        'Apply for moving permits or NOCs at both buildings and get written approval.',
                        'Book the service lift at both ends, with windows that overlap sensibly.',
                        'Schedule utility closure and connection with the right providers for each emirate.',
                        'Book internet installation at the new property.',
                        'Plan an early start to stay ahead of the traffic peak.',
                        'Pack a first-night box and keep documents and valuables with you.',
                    ]],
                    ['type' => 'note', 'content' => 'If you are moving out of one property and into another on the same day, tell your movers explicitly. It changes the sequencing of the whole day, and it is much better planned than improvised.'],
                ],
            ],
        ],
        'related_services'  => ['local-moving', 'home-movers', 'packing-unpacking', 'warehousing-storage'],
        'related_locations' => ['dubai', 'sharjah', 'ajman'],
    ],
];

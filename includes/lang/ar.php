<?php
/**
 * Arabic UI strings — Modern Standard Arabic, which is what UAE businesses
 * use for written material. Keys mirror includes/lang/en.php exactly; a
 * missing key falls back to English rather than showing the key.
 *
 * Numerals stay Western (055 658 1781) — that is how phone numbers are
 * written on UAE signage and in Arabic-language UAE advertising, and it keeps
 * the tel: link and the printed number identical.
 */

declare(strict_types=1);

return [
    /* Navigation */
    'nav.home'            => 'الرئيسية',
    'nav.services'        => 'خدماتنا',
    'nav.locations'       => 'المناطق',
    'nav.about'           => 'من نحن',
    'nav.blog'            => 'المدونة',
    'nav.contact'         => 'اتصل بنا',
    'nav.open_menu'       => 'فتح القائمة',
    'nav.close_menu'      => 'إغلاق القائمة',
    'nav.view_all'        => 'عرض جميع الخدمات',
    'nav.movers_in'       => 'نقل أثاث في {city}',
    'nav.skip'            => 'تخطَّ إلى المحتوى الرئيسي',
    'nav.switch_language' => 'English',
    'nav.switch_aria'     => 'التبديل إلى الإنجليزية',

    /* Calls to action */
    'cta.call'            => 'اتصل بنا {phone}',
    'cta.call_now'        => 'اتصل الآن',
    'cta.whatsapp'        => 'واتساب',
    'cta.quote'           => 'احصل على عرض سعر مجاني',
    'cta.quote_long'      => 'احصل على عرض سعر مجاني للنقل',
    'cta.learn_more'      => 'اعرف المزيد',
    'cta.read_guide'      => 'اقرأ الدليل',
    'cta.read_more'       => 'اقرأ المزيد',
    'cta.view_services'   => 'عرض جميع الخدمات',
    'cta.more_about'      => 'المزيد عنا',
    'cta.home'            => 'العودة إلى الصفحة الرئيسية',

    /* Topbar and header */
    'top.trusted'         => 'شركة نقل وتغليف أثاث موثوقة في {areas}',
    'top.call_label'      => 'اتصل بنا الآن',

    /* Shared section headings */
    'sec.services'        => 'خدمات النقل لدينا',
    'sec.process'         => 'كيف نعمل',
    'sec.why'             => 'لماذا تختارنا',
    'sec.serve'           => 'نخدم مناطق',
    'sec.reviews'         => 'آراء عملائنا',
    'sec.faq'             => 'الأسئلة الشائعة',
    'sec.where'           => 'أين نعمل',
    'sec.related'         => 'خدمات ذات صلة',
    'sec.and_more'        => 'وخدمات أخرى',
    'sec.and_more_text'   => 'التحميل والتنزيل، تركيب الأثاث، النقل المحلي ونقل السيارات.',
    'sec.choose_emirate'  => 'اختر إمارتك',
    'sec.blog'            => 'أحدث المقالات',
    'sec.more_guides'     => 'أدلة نقل أخرى',

    /* Gold CTA band */
    'band.title'          => 'تخطط للانتقال؟ احصل على عرض سعر مجاني اليوم',
    'band.sub'            => 'سريع وسهل وبدون أي التزام.',

    /* Quote form */
    'form.quote_title'    => 'احصل على عرض سعر مجاني للنقل',
    'form.quote_intro'    => 'أخبرنا بتفاصيل النقل وسنوافيك بعرض سعر واضح ومحدد — دون أي التزام.',
    'form.mini_title'     => 'تحتاج عرض سعر للنقل؟',
    'form.mini_intro'     => 'املأ النموذج وسيتواصل معك فريقنا قريباً.',
    'form.name'           => 'الاسم',
    'form.phone'          => 'رقم الهاتف',
    'form.email'          => 'البريد الإلكتروني',
    'form.email_opt'      => '(اختياري)',
    'form.from'           => 'الانتقال من',
    'form.to'             => 'الانتقال إلى',
    'form.area_ph'        => 'المنطقة، الإمارة',
    'form.property'       => 'نوع العقار',
    'form.property_ph'    => 'اختر نوع العقار',
    'form.date'           => 'التاريخ المفضل للنقل',
    'form.service'        => 'الخدمة المطلوبة',
    'form.service_ph'     => 'اختر الخدمة',
    'form.not_sure'       => 'غير متأكد — أرجو المشورة',
    'form.details'        => 'تفاصيل إضافية',
    'form.details_hint'   => '(المحتويات، الطابق، توفر المصعد، الحاجة إلى التغليف)',
    'form.details_ph'     => 'مثال: شقة بغرفتي نوم، الطابق الخامس مع مصعد، أحتاج تغليف المطبخ',
    'form.submit'         => 'أرسل طلب عرض السعر',
    'form.submit_short'   => 'احصل على عرض سعر',
    'form.legal'          => 'نستخدم بياناتك فقط لإعداد عرض السعر ومناقشته معك. راجع',
    'form.privacy'        => 'سياسة الخصوصية',
    'form.prefer_talk'    => 'تفضل التحدث مباشرة؟',
    'form.required'       => 'الحقول المطلوبة مُعلَّمة.',

    /* Message form */
    'msg.title'           => 'أرسل لنا رسالة',
    'msg.intro'           => 'لست مستعداً لطلب عرض سعر بعد؟ اطرح سؤالك وسنرد عليك.',
    'msg.subject'         => 'الموضوع',
    'msg.message'         => 'رسالتك',
    'msg.contact_hint'    => 'زوّدنا برقم هاتف أو بريد إلكتروني حتى نتمكن من الرد.',
    'msg.submit'          => 'إرسال الرسالة',

    /* Form feedback */
    'flash.success_title' => 'شكراً لك — تم استلام طلبك.',
    'flash.error_title'   => 'تعذّر إرسال طلبك.',
    'flash.msg_received'  => 'تم استلام رسالتك.',
    'flash.msg_error'     => 'تعذّر إرسال رسالتك.',

    /* Footer */
    'foot.services'       => 'الخدمات',
    'foot.locations'      => 'المناطق',
    'foot.company'        => 'الشركة',
    'foot.contact'        => 'تواصل معنا',
    'foot.and_more'       => 'وخدمات أخرى',
    'foot.about'          => 'شركة نقل وتغليف أثاث مقرها {address}، نقدم خدمات نقل المنازل والفلل والشقق والمكاتب والمنشآت التجارية، مع التغليف والتخزين وخدمات الأثاث في {areas}.',
    'foot.note'           => 'نخدم {areas}. تواصل معنا للحصول على عرض سعر مجاني وبدون التزام.',
    'foot.rights'         => 'جميع الحقوق محفوظة.',
    'foot.privacy'        => 'سياسة الخصوصية',
    'foot.terms'          => 'الشروط والأحكام',
    'foot.sitemap'        => 'خريطة الموقع',
    'foot.whatsapp_us'    => 'راسلنا على واتساب',

    /* Mobile bar */
    'bar.call'            => 'اتصل',
    'bar.whatsapp'        => 'واتساب',
    'bar.quote'           => 'عرض سعر',
    'bar.aria'            => 'وسائل التواصل',

    /* Breadcrumbs */
    'crumb.home'          => 'الرئيسية',
    'crumb.services'      => 'الخدمات',
    'crumb.locations'     => 'المناطق',
    'crumb.blog'          => 'المدونة',
    'crumb.aria'          => 'مسار التنقل',

    /* 404 */
    '404.title'           => 'لم نتمكن من العثور على هذه الصفحة',
    '404.text'            => 'ربما تم نقل الصفحة أو أن الرابط غير مكتمل. كل ما تحتاجه موجود أدناه — أو اتصل بنا وسنرشدك إلى الوجهة الصحيحة.',

    /* WhatsApp prefilled messages */
    'wa.default'          => 'مرحباً، أحتاج عرض سعر لخدمة نقل.',
    'wa.city'             => 'مرحباً، أحتاج عرض سعر لخدمة نقل في {city}.',
    'wa.service'          => 'مرحباً، أحتاج خدمة {service} في دبي أو الشارقة أو عجمان.',
    'wa.question'         => 'مرحباً، لدي سؤال بخصوص النقل.',

    /* Property types — the option VALUE posted to the server stays English */
    'prop.studio'         => 'استوديو',
    'prop.1br'            => 'شقة بغرفة نوم واحدة',
    'prop.2br'            => 'شقة بغرفتي نوم',
    'prop.3br'            => 'شقة بثلاث غرف نوم أو أكثر',
    'prop.townhouse'      => 'تاون هاوس',
    'prop.villa'          => 'فيلا',
    'prop.office'         => 'مكتب',
    'prop.retail'         => 'محل أو معرض',
    'prop.storage'        => 'تخزين فقط',
    'prop.other'          => 'أخرى',

    /* Field validation */
    'err.name'            => 'يرجى إدخال اسمك.',
    'err.phone_missing'   => 'يرجى إدخال رقم هاتف حتى نتمكن من التواصل معك.',
    'err.phone_invalid'   => 'أدخل رقم هاتف إماراتي صحيح، مثل 055 658 1781.',
    'err.email'           => 'أدخل بريداً إلكترونياً صحيحاً، أو اترك الحقل فارغاً.',
    'err.from'            => 'أخبرنا من أين ستنتقل.',
    'err.to'              => 'أخبرنا إلى أين ستنتقل.',
    'err.date'            => 'يرجى اختيار تاريخ صحيح.',
    'err.message'         => 'يرجى إضافة المزيد من التفاصيل حتى نتمكن من مساعدتك.',
    'err.reach'           => 'زوّدنا برقم هاتف أو بريد إلكتروني حتى نتمكن من الرد.',
    'err.check_form'      => 'يرجى مراجعة الحقول المُعلَّمة وإرسال النموذج مرة أخرى.',
    'err.check_message'   => 'يرجى مراجعة الحقول المُعلَّمة وإرسال الرسالة مرة أخرى.',

    /* Submission outcomes */
    'lead.soon'           => 'سنتواصل معك قريباً.',
    'lead.expired'        => 'انتهت صلاحية الجلسة قبل إرسال النموذج. يرجى المحاولة مرة أخرى، أو الاتصال بنا على {phone}.',
    'lead.rate'           => 'عدد كبير من الطلبات من هذا الاتصال. يرجى الانتظار بضع دقائق، أو الاتصال بنا على {phone}.',
    'lead.store_failed'   => 'حدث خطأ لدينا. يرجى الاتصال بنا أو مراسلتنا على واتساب {phone} وسنأخذ بياناتك مباشرة.',
    'lead.quote_ok'       => 'استلمنا بياناتك وسنوافيك بعرض السعر. إذا كان النقل عاجلاً، اتصل بنا أو راسلنا على واتساب {phone}.',
    'lead.message_ok'     => 'شكراً لرسالتك — سنرد عليك قريباً. لأي أمر عاجل، اتصل بنا أو راسلنا على واتساب {phone}.',

    'msg.legal'           => 'نستخدم بياناتك فقط للرد على استفسارك. راجع',

    /* Placeholder review cards — local preview only, never served in production */
    'example.name'        => 'عميل نموذجي',
    'example.source'      => 'نموذج',
    'example.quote1'      => 'نص نموذجي للتحقق من تصميم البطاقة. استبدله بتقييم حقيقي من عميل قبل النشر.',
    'example.quote2'      => 'نموذج ثانٍ. انسخ تقييمات جوجل الحقيقية إلى includes/data/testimonials.php.',
    'example.quote3'      => 'نموذج ثالث، موجود هنا فقط لعرض تصميم البطاقة. ولا يظهر أبداً على الموقع المباشر.',

    /* Misc */
    'misc.list_sep'       => '، ',
    'misc.list_and'       => ' و',
    'misc.address'        => 'الشارقة، الإمارات',
    'misc.published'      => 'نُشر في',
    'misc.updated'        => 'حُدّث في',
    'misc.areas_served'   => 'المناطق التي نخدمها',
    'misc.based_in'       => 'مقرنا في {address}',
    'misc.free_quote'     => 'عرض سعر مجاني بدون التزام',
    'misc.careful'        => 'عناية فائقة في التعامل',
];

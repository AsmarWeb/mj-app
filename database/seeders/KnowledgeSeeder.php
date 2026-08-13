<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('knowledge')->insert([

    /*
    |--------------------------------------------------------------------------
    | GENERAL مُروَّج.كم
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'what is murwaj.com marketplace',
        'question_ar' => 'ما هو سوق مُروَّج.كم؟',
        'answer' => 'murwaj.com is an online marketplace where users can discover products, create shops, sell products, follow sellers, and connect with buyers.',
        'answer_ar' => 'مُروَّج.كم هو سوق إلكتروني يتيح للمستخدمين اكتشاف المنتجات وإنشاء المتاجر وبيع المنتجات ومتابعة البائعين والتواصل مع المشترين.',
        'category' => 'general',
        'is_active' => true,
    ],

    [
        'question' => 'how does murwaj.com work',
        'question_ar' => 'كيف يعمل مُروَّج.كم؟',
        'answer' => 'You can browse products, search for shops, follow sellers, contact sellers, and purchase products. Sellers can create shops and publish their products on murwaj.com.',
        'answer_ar' => 'يمكنك تصفح المنتجات والبحث عن المتاجر ومتابعة البائعين والتواصل معهم وشراء المنتجات. ويمكن للبائعين إنشاء متاجر وإضافة منتجاتهم على مُروَّج.كم.',
        'category' => 'general',
        'is_active' => true,
    ],

    [
        'question' => 'is murwaj.com free',
        'question_ar' => 'هل مُروَّج.كم مجاني؟',
        'answer' => 'Creating an account and browsing the marketplace is free. Some seller services, promotions, or advertising features may have fees.',
        'answer_ar' => 'إنشاء الحساب وتصفح السوق مجانيان. وقد تكون بعض خدمات البائعين أو العروض الترويجية أو الإعلانات مدفوعة.',
        'category' => 'general',
        'is_active' => true,
    ],

    [
        'question' => 'what can i do on murwaj.com',
        'question_ar' => 'ماذا يمكنني أن أفعل في مُروَّج.كم؟',
        'answer' => 'You can buy products, sell products, create a shop, follow shops, save products, contact sellers, and manage your marketplace activity.',
        'answer_ar' => 'يمكنك شراء المنتجات وبيعها وإنشاء متجر ومتابعة المتاجر وحفظ المنتجات والتواصل مع البائعين وإدارة نشاطك في السوق.',
        'category' => 'general',
        'is_active' => true,
    ],

    [
        'question' => 'how do i search for products on murwaj.com',
        'question_ar' => 'كيف أبحث عن المنتجات في مُروَّج.كم؟',
        'answer' => 'Use the search bar and available filters to search by product name, category, price, location, or shop.',
        'answer_ar' => 'استخدم شريط البحث والفلاتر المتاحة للبحث حسب اسم المنتج أو التصنيف أو السعر أو الموقع أو المتجر.',
        'category' => 'general',
        'is_active' => true,
    ],

    [
        'question' => 'how do i find a shop on murwaj.com',
        'question_ar' => 'كيف أجد متجراً في مُروَّج.كم؟',
        'answer' => 'Search for the shop name or open a product and select the shop profile to see its products and information.',
        'answer_ar' => 'ابحث عن اسم المتجر أو افتح أحد المنتجات واضغط على ملف المتجر للاطلاع على منتجاته ومعلوماته.',
        'category' => 'general',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | ACCOUNT
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to register on murwaj.com',
        'question_ar' => 'كيف أسجل في مُروَّج.كم؟',
        'answer' => 'Click Sign Up, enter your required information, verify your account if requested, and start using murwaj.com.',
        'answer_ar' => 'اضغط على إنشاء حساب، وأدخل البيانات المطلوبة، ثم قم بتأكيد حسابك إذا طُلب منك ذلك وابدأ باستخدام مُروَّج.كم.',
        'category' => 'account',
        'is_active' => true,
    ],

    [
        'question' => 'how to login to murwaj.com',
        'question_ar' => 'كيف أسجل الدخول إلى مُروَّج.كم؟',
        'answer' => 'Click Login and enter the email or login information associated with your murwaj.com account.',
        'answer_ar' => 'اضغط على تسجيل الدخول وأدخل البريد الإلكتروني أو بيانات الدخول المرتبطة بحسابك في مُروَّج.كم.',
        'category' => 'account',
        'is_active' => true,
    ],

    [
        'question' => 'i forgot my password on murwaj.com',
        'question_ar' => 'نسيت كلمة المرور في مُروَّج.كم، ماذا أفعل؟',
        'answer' => 'Use the Forgot Password option on the login page and follow the instructions to reset your password.',
        'answer_ar' => 'استخدم خيار نسيت كلمة المرور في صفحة تسجيل الدخول واتبع التعليمات لإعادة تعيين كلمة المرور.',
        'category' => 'account',
        'is_active' => true,
    ],

    [
        'question' => 'how to change my email on murwaj.com',
        'question_ar' => 'كيف أغير البريد الإلكتروني في مُروَّج.كم؟',
        'answer' => 'Open your account or profile settings and update your email address if the option is available.',
        'answer_ar' => 'افتح إعدادات الحساب أو الملف الشخصي وقم بتحديث البريد الإلكتروني إذا كان الخيار متاحاً.',
        'category' => 'account',
        'is_active' => true,
    ],

    [
        'question' => 'how to change phone number on murwaj.com',
        'question_ar' => 'كيف أغير رقم الهاتف في مُروَّج.كم؟',
        'answer' => 'Open your profile settings and update your phone number. You may be asked to verify the new number.',
        'answer_ar' => 'افتح إعدادات الملف الشخصي وقم بتحديث رقم الهاتف. قد يُطلب منك تأكيد الرقم الجديد.',
        'category' => 'account',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | BUYING
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to buy a product on murwaj.com',
        'question_ar' => 'كيف أشتري منتجاً من مُروَّج.كم؟',
        'answer' => 'Open the product page, review the product and seller information, then choose the available purchase or contact-seller option and complete the required steps.',
        'answer_ar' => 'افتح صفحة المنتج وراجع معلومات المنتج والبائع، ثم اختر خيار الشراء أو التواصل مع البائع المتاح وأكمل الخطوات المطلوبة.',
        'category' => 'buying',
        'is_active' => true,
    ],

    [
        'question' => 'how can i contact seller on murwaj.com',
        'question_ar' => 'كيف أتواصل مع البائع في مُروَّج.كم؟',
        'answer' => 'Open the product or shop page and use the available contact or messaging option to communicate with the seller.',
        'answer_ar' => 'افتح صفحة المنتج أو المتجر واستخدم خيار التواصل أو المراسلة المتاح للتواصل مع البائع.',
        'category' => 'buying',
        'is_active' => true,
    ],

    [
        'question' => 'how to save a product on murwaj.com',
        'question_ar' => 'كيف أحفظ منتجاً في مُروَّج.كم؟',
        'answer' => 'Use the Save or Bookmark button on the product page to keep the product for later.',
        'answer_ar' => 'استخدم زر الحفظ أو الإضافة إلى المفضلة في صفحة المنتج للاحتفاظ به والعودة إليه لاحقاً.',
        'category' => 'buying',
        'is_active' => true,
    ],

    [
        'question' => 'how to follow a shop on murwaj.com',
        'question_ar' => 'كيف أتابع متجراً في مُروَّج.كم؟',
        'answer' => 'Open the shop profile and click Follow Shop. You can then receive available shop updates.',
        'answer_ar' => 'افتح صفحة المتجر واضغط على متابعة المتجر، ويمكنك بعد ذلك الحصول على التحديثات المتاحة من المتجر.',
        'category' => 'buying',
        'is_active' => true,
    ],

    [
        'question' => 'how do i know if a seller is trusted on murwaj.com',
        'question_ar' => 'كيف أعرف أن البائع موثوق في مُروَّج.كم؟',
        'answer' => 'Check the shop verification status, ratings, reviews, products, seller information, and activity before making a purchase.',
        'answer_ar' => 'تحقق من حالة توثيق المتجر والتقييمات والمراجعات والمنتجات ومعلومات البائع ونشاطه قبل الشراء.',
        'category' => 'buying',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | SELLING
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to start selling on murwaj.com',
        'question_ar' => 'كيف أبدأ البيع في مُروَّج.كم؟',
        'answer' => 'Create an account, open the seller area, create your shop, complete the required information, and add your products.',
        'answer_ar' => 'أنشئ حساباً، وانتقل إلى قسم البائع، وأنشئ متجرك، وأكمل المعلومات المطلوبة، ثم أضف منتجاتك.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to create a shop on murwaj.com',
        'question_ar' => 'كيف أنشئ متجراً في مُروَّج.كم؟',
        'answer' => 'Open the seller dashboard, choose Create Shop, then add your shop name, description, logo, location, and other required information.',
        'answer_ar' => 'افتح لوحة تحكم البائع واختر إنشاء متجر، ثم أضف اسم المتجر والوصف والشعار والموقع وباقي المعلومات المطلوبة.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to add product on murwaj.com',
        'question_ar' => 'كيف أضيف منتجاً في مُروَّج.كم؟',
        'answer' => 'Open your seller dashboard, choose Add Product, upload product images or supported media, add the title, description, price, category, and other required information, then publish.',
        'answer_ar' => 'افتح لوحة تحكم البائع واختر إضافة منتج، ثم أضف الصور أو الوسائط المدعومة والعنوان والوصف والسعر والتصنيف وباقي المعلومات المطلوبة ثم انشر المنتج.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to edit product on murwaj.com',
        'question_ar' => 'كيف أعدل المنتج في مُروَّج.كم؟',
        'answer' => 'Open your seller dashboard, select the product, choose Edit, update the information, and save your changes.',
        'answer_ar' => 'افتح لوحة تحكم البائع واختر المنتج ثم اضغط تعديل، وقم بتحديث المعلومات واحفظ التغييرات.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to delete product on murwaj.com',
        'question_ar' => 'كيف أحذف منتجاً من مُروَّج.كم؟',
        'answer' => 'Open your products dashboard, select the product, and use the Delete option.',
        'answer_ar' => 'افتح لوحة المنتجات واختر المنتج ثم استخدم خيار حذف المنتج.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to upload product video on murwaj.com',
        'question_ar' => 'كيف أضيف فيديو للمنتج في مُروَّج.كم؟',
        'answer' => 'When creating or editing a product, upload a supported video file if video listings are enabled for your account.',
        'answer_ar' => 'عند إنشاء أو تعديل المنتج، يمكنك رفع ملف فيديو مدعوم إذا كانت ميزة فيديو المنتجات متاحة لحسابك.',
        'category' => 'selling',
        'is_active' => true,
    ],

    [
        'question' => 'how to promote my product on murwaj.com',
        'question_ar' => 'كيف أروّج لمنتجي في مُروَّج.كم؟',
        'answer' => 'Use murwaj.com promotional or featured-listing options when available to increase your product visibility.',
        'answer_ar' => 'استخدم خيارات الترويج أو المنتجات المميزة في مُروَّج.كم عندما تكون متاحة لزيادة ظهور منتجك.',
        'category' => 'selling',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | SHOP
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to edit my shop on murwaj.com',
        'question_ar' => 'كيف أعدل متجري في مُروَّج.كم؟',
        'answer' => 'Open your shop dashboard and update your shop name, logo, description, location, and available settings.',
        'answer_ar' => 'افتح لوحة تحكم متجرك وقم بتحديث اسم المتجر والشعار والوصف والموقع والإعدادات المتاحة.',
        'category' => 'shop',
        'is_active' => true,
    ],

    [
        'question' => 'how to add shop logo on murwaj.com',
        'question_ar' => 'كيف أضيف شعار المتجر في مُروَّج.كم؟',
        'answer' => 'Open your shop settings and upload your logo image using the available logo field.',
        'answer_ar' => 'افتح إعدادات المتجر وقم برفع صورة الشعار من خلال الحقل المخصص للشعار.',
        'category' => 'shop',
        'is_active' => true,
    ],

    [
        'question' => 'how to close my shop on murwaj.com',
        'question_ar' => 'كيف أغلق متجري في مُروَّج.كم؟',
        'answer' => 'Check your shop settings for a closure option. If it is not available, contact murwaj.com support.',
        'answer_ar' => 'تحقق من إعدادات المتجر لمعرفة ما إذا كان خيار إغلاق المتجر متاحاً. وإذا لم يكن متاحاً، تواصل مع دعم مُروَّج.كم.',
        'category' => 'shop',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | ORDERS
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'where is my order on murwaj.com',
        'question_ar' => 'أين طلبي في مُروَّج.كم؟',
        'answer' => 'Open your orders page to view the current order status and any available tracking information.',
        'answer_ar' => 'افتح صفحة طلباتك للاطلاع على حالة الطلب الحالية وأي معلومات تتبع متاحة.',
        'category' => 'orders',
        'is_active' => true,
    ],

    [
        'question' => 'how to track order on murwaj.com',
        'question_ar' => 'كيف أتتبع طلبي في مُروَّج.كم؟',
        'answer' => 'Open the order details page and check the available tracking or delivery information.',
        'answer_ar' => 'افتح تفاصيل الطلب وتحقق من معلومات التتبع أو التوصيل المتاحة.',
        'category' => 'orders',
        'is_active' => true,
    ],

    [
        'question' => 'how to cancel order on murwaj.com',
        'question_ar' => 'كيف ألغي الطلب في مُروَّج.كم؟',
        'answer' => 'Cancellation availability depends on the order status and seller processing stage. Open the order details or contact the seller as soon as possible.',
        'answer_ar' => 'يعتمد إلغاء الطلب على حالته ومرحلة معالجة البائع له. افتح تفاصيل الطلب أو تواصل مع البائع في أقرب وقت ممكن.',
        'category' => 'orders',
        'is_active' => true,
    ],

    [
        'question' => 'what if my order does not arrive on murwaj.com',
        'question_ar' => 'ماذا أفعل إذا لم يصل طلبي في مُروَّج.كم؟',
        'answer' => 'Check the delivery status first. If the order is delayed or missing, contact the seller or murwaj.com support with your order details.',
        'answer_ar' => 'تحقق أولاً من حالة التوصيل. إذا كان الطلب متأخراً أو مفقوداً، تواصل مع البائع أو دعم مُروَّج.كم وأرسل تفاصيل الطلب.',
        'category' => 'orders',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | PAYMENTS
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how can i pay on murwaj.com',
        'question_ar' => 'كيف يمكنني الدفع في مُروَّج.كم؟',
        'answer' => 'Available payment methods are shown during checkout and depend on the product, seller, and murwaj.com payment options.',
        'answer_ar' => 'تظهر طرق الدفع المتاحة أثناء إتمام الطلب، وتختلف حسب المنتج والبائع وخيارات الدفع المتوفرة في مُروَّج.كم.',
        'category' => 'payments',
        'is_active' => true,
    ],

    [
        'question' => 'is payment secure on murwaj.com',
        'question_ar' => 'هل الدفع آمن في مُروَّج.كم؟',
        'answer' => 'Use the payment methods provided through murwaj.com and never send card details, passwords, OTPs, or PINs to sellers through chat.',
        'answer_ar' => 'استخدم طرق الدفع المتوفرة عبر مُروَّج.كم، ولا ترسل بيانات البطاقة أو كلمات المرور أو رموز OTP أو الرقم السري للبطاقة إلى البائعين عبر المحادثة.',
        'category' => 'payments',
        'is_active' => true,
    ],

    [
        'question' => 'can i get refund on murwaj.com',
        'question_ar' => 'هل يمكنني استرداد المبلغ في مُروَّج.كم؟',
        'answer' => 'Refund eligibility depends on the product, seller policy, order status, and applicable marketplace rules. Check the order or contact murwaj.com support.',
        'answer_ar' => 'تعتمد أهلية استرداد المبلغ على المنتج وسياسة البائع وحالة الطلب والقواعد المعمول بها في السوق. راجع الطلب أو تواصل مع دعم مُروَّج.كم.',
        'category' => 'payments',
        'is_active' => true,
    ],

    [
        'question' => 'how to request refund on murwaj.com',
        'question_ar' => 'كيف أطلب استرداد المبلغ في مُروَّج.كم؟',
        'answer' => 'Open your order details and follow the available refund process, or contact the seller or murwaj.com support with your order information.',
        'answer_ar' => 'افتح تفاصيل الطلب واتبع خطوات طلب الاسترداد المتاحة، أو تواصل مع البائع أو دعم مُروَّج.كم مع معلومات الطلب.',
        'category' => 'payments',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | UAE - CURRENCY / VAT
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'what currency is used on murwaj.com in uae',
        'question_ar' => 'ما هي العملة المستخدمة في مُروَّج.كم في الإمارات؟',
        'answer' => 'Prices for UAE marketplace listings can be displayed in UAE Dirhams (AED) when the seller or shop uses AED.',
        'answer_ar' => 'يمكن عرض أسعار المنتجات في سوق الإمارات بالدرهم الإماراتي (AED) عندما يستخدم البائع أو المتجر عملة الدرهم.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'what is AED',
        'question_ar' => 'ما هو AED؟',
        'answer' => 'AED is the currency code for the United Arab Emirates Dirham.',
        'answer_ar' => 'AED هو رمز عملة الدرهم الإماراتي.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'what is vat in uae',
        'question_ar' => 'ما هي ضريبة القيمة المضافة في الإمارات؟',
        'answer' => 'The UAE generally applies a 5% Value Added Tax (VAT) to taxable goods and services. Whether VAT applies to a specific transaction on murwaj.com depends on the seller and applicable tax rules.',
        'answer_ar' => 'تطبق دولة الإمارات بشكل عام ضريبة قيمة مضافة بنسبة 5% على السلع والخدمات الخاضعة للضريبة. ويعتمد تطبيق الضريبة على معاملة معينة في مُروَّج.كم على البائع والقواعد الضريبية المعمول بها.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'does murwaj.com include vat in the price',
        'question_ar' => 'هل السعر في مُروَّج.كم يشمل ضريبة القيمة المضافة؟',
        'answer' => 'Check the product price and checkout information for the applicable tax details. VAT treatment can depend on the seller and transaction.',
        'answer_ar' => 'تحقق من سعر المنتج ومعلومات إتمام الطلب لمعرفة تفاصيل الضريبة المطبقة. وقد تختلف المعاملة الضريبية حسب البائع والمعاملة.',
        'category' => 'uae',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | UAE - SELLER / BUSINESS
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'can i sell products in uae on murwaj.com',
        'question_ar' => 'هل يمكنني بيع المنتجات في الإمارات عبر مُروَّج.كم؟',
        'answer' => 'You may sell through murwaj.com if you meet platform requirements and comply with applicable UAE laws, licences, approvals, and marketplace policies.',
        'answer_ar' => 'يمكنك البيع عبر مُروَّج.كم إذا استوفيت متطلبات المنصة والتزمت بالقوانين والتراخيص والموافقات المعمول بها في دولة الإمارات وسياسات السوق.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'do i need a licence to sell online in uae on murwaj.com',
        'question_ar' => 'هل أحتاج إلى ترخيص للبيع عبر الإنترنت في الإمارات على مُروَّج.كم؟',
        'answer' => 'UAE e-commerce businesses generally need the appropriate licence and approvals for their activities. Check the requirements of the relevant UAE licensing authority before starting a business.',
        'answer_ar' => 'تحتاج أنشطة التجارة الإلكترونية في الإمارات بشكل عام إلى الترخيص والموافقات المناسبة حسب النشاط. تحقق من متطلبات جهة الترخيص المختصة قبل بدء النشاط التجاري.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'can i sell from dubai on murwaj.com',
        'question_ar' => 'هل يمكنني البيع من دبي على مُروَّج.كم؟',
        'answer' => 'UAE-based sellers may use murwaj.com subject to platform requirements, seller requirements, and applicable UAE regulations.',
        'answer_ar' => 'يمكن للبائعين الموجودين في دولة الإمارات استخدام مُروَّج.كم وفقاً لمتطلبات المنصة ومتطلبات البائع والأنظمة المعمول بها في الدولة.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'can i sell from abu dhabi on murwaj.com',
        'question_ar' => 'هل يمكنني البيع من أبوظبي على مُروَّج.كم؟',
        'answer' => 'Yes, UAE-based sellers may use murwaj.com subject to platform requirements and applicable licensing and regulatory requirements.',
        'answer_ar' => 'نعم، يمكن للبائعين الموجودين في الإمارات استخدام مُروَّج.كم وفقاً لمتطلبات المنصة ومتطلبات الترخيص والأنظمة المعمول بها.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'can i sell from sharjah on murwaj.com',
        'question_ar' => 'هل يمكنني البيع من الشارقة على مُروَّج.كم؟',
        'answer' => 'UAE-based sellers can use murwaj.com subject to platform requirements and the applicable requirements for their business activity.',
        'answer_ar' => 'يمكن للبائعين الموجودين في دولة الإمارات استخدام مُروَّج.كم وفقاً لمتطلبات المنصة والمتطلبات الخاصة بنشاطهم التجاري.',
        'category' => 'uae',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | UAE - DELIVERY
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'does murwaj.com deliver in uae',
        'question_ar' => 'هل يوفر مُروَّج.كم التوصيل داخل الإمارات؟',
        'answer' => 'Delivery availability depends on the seller, product, delivery service, and destination. Check the product or checkout page for available delivery options.',
        'answer_ar' => 'يعتمد توفر التوصيل على البائع والمنتج وخدمة التوصيل والوجهة. تحقق من صفحة المنتج أو إتمام الطلب لمعرفة خيارات التوصيل المتاحة.',
        'category' => 'delivery',
        'is_active' => true,
    ],

    [
        'question' => 'how much is delivery in uae on murwaj.com',
        'question_ar' => 'كم تكلفة التوصيل داخل الإمارات في مُروَّج.كم؟',
        'answer' => 'Delivery fees depend on the seller, product size, destination, delivery company, and selected delivery method. The applicable fee should be shown when available.',
        'answer_ar' => 'تعتمد رسوم التوصيل على البائع وحجم المنتج والوجهة وشركة التوصيل وطريقة التوصيل المختارة. وتظهر الرسوم المطبقة عند توفرها.',
        'category' => 'delivery',
        'is_active' => true,
    ],

    [
        'question' => 'do you deliver to dubai on murwaj.com',
        'question_ar' => 'هل يوجد توصيل إلى دبي عبر مُروَّج.كم؟',
        'answer' => 'Delivery to Dubai depends on the seller and product. Check the product delivery information or contact the seller.',
        'answer_ar' => 'يعتمد التوصيل إلى دبي على البائع والمنتج. تحقق من معلومات التوصيل في صفحة المنتج أو تواصل مع البائع.',
        'category' => 'delivery',
        'is_active' => true,
    ],

    [
        'question' => 'do you deliver to abu dhabi on murwaj.com',
        'question_ar' => 'هل يوجد توصيل إلى أبوظبي عبر مُروَّج.كم؟',
        'answer' => 'Delivery to Abu Dhabi depends on the seller and product. Check the delivery information or contact the seller before ordering.',
        'answer_ar' => 'يعتمد التوصيل إلى أبوظبي على البائع والمنتج. تحقق من معلومات التوصيل أو تواصل مع البائع قبل الطلب.',
        'category' => 'delivery',
        'is_active' => true,
    ],

    [
        'question' => 'do you deliver to sharjah on murwaj.com',
        'question_ar' => 'هل يوجد توصيل إلى الشارقة عبر مُروَّج.كم؟',
        'answer' => 'Delivery to Sharjah depends on the seller and product. Check the delivery information provided on the listing.',
        'answer_ar' => 'يعتمد التوصيل إلى الشارقة على البائع والمنتج. تحقق من معلومات التوصيل الموجودة في الإعلان.',
        'category' => 'delivery',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | UAE - SAFETY / SCAMS
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to avoid scams in uae on murwaj.com',
        'question_ar' => 'كيف أتجنب عمليات الاحتيال في الإمارات على مُروَّج.كم؟',
        'answer' => 'Check the seller and shop information, review ratings and product details, avoid suspicious offers, never share passwords or verification codes, and use trusted payment methods.',
        'answer_ar' => 'تحقق من معلومات البائع والمتجر والتقييمات وتفاصيل المنتج، وتجنب العروض المشبوهة، ولا تشارك كلمات المرور أو رموز التحقق، واستخدم طرق دفع موثوقة.',
        'category' => 'safety',
        'is_active' => true,
    ],

    [
        'question' => 'seller is asking me to pay outside murwaj.com',
        'question_ar' => 'البائع يطلب مني الدفع خارج مُروَّج.كم، ماذا أفعل؟',
        'answer' => 'Be careful with requests to move payment outside murwaj.com. Do not share passwords, OTPs, card PINs, or sensitive banking information. Use the official payment options available on the platform.',
        'answer_ar' => 'كن حذراً من طلبات نقل الدفع خارج مُروَّج.كم. لا تشارك كلمة المرور أو رمز OTP أو الرقم السري للبطاقة أو المعلومات البنكية الحساسة. استخدم خيارات الدفع الرسمية المتاحة على المنصة.',
        'category' => 'safety',
        'is_active' => true,
    ],

    [
        'question' => 'seller asks for otp on murwaj.com',
        'question_ar' => 'البائع يطلب رمز OTP في مُروَّج.كم، ماذا أفعل؟',
        'answer' => 'Never share your OTP or verification code with a seller or another person. OTP codes should always be kept private.',
        'answer_ar' => 'لا تشارك رمز OTP أو رمز التحقق مع البائع أو أي شخص آخر. يجب الحفاظ على رموز التحقق بشكل سري.',
        'category' => 'safety',
        'is_active' => true,
    ],

    [
        'question' => 'how to report a product on murwaj.com',
        'question_ar' => 'كيف أبلغ عن منتج في مُروَّج.كم؟',
        'answer' => 'Open the product page and use the Report option if available. Include accurate details about the issue.',
        'answer_ar' => 'افتح صفحة المنتج واستخدم خيار الإبلاغ إذا كان متاحاً، وأضف تفاصيل دقيقة عن المشكلة.',
        'category' => 'safety',
        'is_active' => true,
    ],

    [
        'question' => 'how to report a seller on murwaj.com',
        'question_ar' => 'كيف أبلغ عن بائع في مُروَّج.كم؟',
        'answer' => 'Open the seller or shop profile and use the available report option. Provide relevant details and evidence when possible.',
        'answer_ar' => 'افتح ملف البائع أو المتجر واستخدم خيار الإبلاغ المتاح، وأضف التفاصيل والأدلة ذات الصلة إن أمكن.',
        'category' => 'safety',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | UAE - CONSUMER INFORMATION
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'what are my consumer rights in uae on murwaj.com',
        'question_ar' => 'ما هي حقوق المستهلك في الإمارات عند استخدام مُروَّج.كم؟',
        'answer' => 'UAE consumer-protection rules provide rights relating to product and service information, safety, declared prices, privacy, and fair treatment. For a specific legal complaint, consult the relevant UAE consumer-protection authority.',
        'answer_ar' => 'توفر قوانين حماية المستهلك في الإمارات حقوقاً تتعلق بمعلومات المنتجات والخدمات والسلامة والأسعار المعلنة والخصوصية والمعاملة العادلة. وبالنسبة للشكوى القانونية المحددة، يُنصح بالتواصل مع جهة حماية المستهلك المختصة في الإمارات.',
        'category' => 'uae',
        'is_active' => true,
    ],

    [
        'question' => 'does the seller need to provide product information on murwaj.com',
        'question_ar' => 'هل يجب على البائع تقديم معلومات عن المنتج في مُروَّج.كم؟',
        'answer' => 'Sellers should provide accurate and clear product or service information and comply with applicable UAE e-commerce and consumer-protection requirements.',
        'answer_ar' => 'يجب على البائع تقديم معلومات واضحة ودقيقة عن المنتج أو الخدمة والالتزام بمتطلبات التجارة الإلكترونية وحماية المستهلك المعمول بها في الإمارات.',
        'category' => 'uae',
        'is_active' => true,
    ],


    /*
    |--------------------------------------------------------------------------
    | SUPPORT
    |--------------------------------------------------------------------------
    */

    [
        'question' => 'how to contact murwaj.com support',
        'question_ar' => 'كيف أتواصل مع دعم مُروَّج.كم؟',
        'answer' => 'Visit the murwaj.com support or contact page and provide your account or order information together with a clear description of the issue.',
        'answer_ar' => 'انتقل إلى صفحة الدعم أو التواصل في مُروَّج.كم وأرسل معلومات الحساب أو الطلب مع وصف واضح للمشكلة.',
        'category' => 'support',
        'is_active' => true,
    ],

    [
        'question' => 'i have a problem with my order on murwaj.com',
        'question_ar' => 'لدي مشكلة في طلبي في مُروَّج.كم',
        'answer' => 'Open your order details first. If you cannot resolve the issue, contact the seller or murwaj.com support and provide the order number and relevant details.',
        'answer_ar' => 'افتح تفاصيل الطلب أولاً. وإذا لم تتمكن من حل المشكلة، تواصل مع البائع أو دعم مُروَّج.كم وأرسل رقم الطلب والتفاصيل ذات الصلة.',
        'category' => 'support',
        'is_active' => true,
    ],

    [
        'question' => 'how can i contact murwaj.com',
        'question_ar' => 'كيف أتواصل مع مُروَّج.كم؟',
        'answer' => 'Use the official murwaj.com contact or support channels available on the website.',
        'answer_ar' => 'استخدم قنوات التواصل أو الدعم الرسمية المتاحة في موقع مُروَّج.كم.',
        'category' => 'support',
        'is_active' => true,
    ],

]);
    }
}

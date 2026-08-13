<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BotController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | AI PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $title = 'murwaj.com';

        $description =
            'murwaj.com is an online marketplace for buying, selling, shops, products and services.';

        $keywords =
            'murwaj.com, marketplace, UAE, buy, sell, shops, products, sellers';

        return view('bot.ai', compact(
            'title',
            'description',
            'keywords'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
            'language' => 'nullable|in:ar,en',
        ]);


        $message = trim($request->input('message'));

        $language = $request->input('language', 'en');

        $input = $this->normalizeText($message);


        /*
        |--------------------------------------------------------------------------
        | SEARCH KNOWLEDGE DATABASE
        |--------------------------------------------------------------------------
        */

        $items = Knowledge::where('is_active', true)->get();

        $best = null;
        $bestScore = 0;


        foreach ($items as $item) {

            /*
            |--------------------------------------------------------------------------
            | Compare English question
            |--------------------------------------------------------------------------
            */

            $english = $this->normalizeText(
                $item->question ?? ''
            );

            if ($english !== '') {

                $score = $this->calculateScore(
                    $input,
                    $english
                );

                if ($score > $bestScore) {

                    $bestScore = $score;

                    $best = $item;
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Compare Arabic question
            |--------------------------------------------------------------------------
            */

            $arabic = $this->normalizeText(
                $item->question_ar ?? ''
            );

            if ($arabic !== '') {

                $score = $this->calculateScore(
                    $input,
                    $arabic
                );

                if ($score > $bestScore) {

                    $bestScore = $score;

                    $best = $item;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DATABASE ANSWER
        |--------------------------------------------------------------------------
        */

        if ($best && $bestScore >= 45) {

            $answer = $language === 'ar'
                ? ($best->answer_ar ?: $best->answer)
                : ($best->answer ?: $best->answer_ar);


            if ($answer) {

                return response()->json([
                    'reply' => $answer,
                    'source' => 'knowledge',
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | LOCAL SMART FALLBACK
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'reply' => $this->generateLocalAnswer(
                $message,
                $language
            ),

            'source' => 'local',
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | CALCULATE SIMILARITY
    |--------------------------------------------------------------------------
    */

    private function calculateScore(
        string $input,
        string $question
    ): float {

        if (!$input || !$question) {
            return 0;
        }


        /*
        |--------------------------------------------------------------------------
        | Direct match
        |--------------------------------------------------------------------------
        */

        if ($input === $question) {
            return 100;
        }


        /*
        |--------------------------------------------------------------------------
        | Similar text
        |--------------------------------------------------------------------------
        */

        similar_text(
            $input,
            $question,
            $percent
        );


        $score = $percent;


        /*
        |--------------------------------------------------------------------------
        | Word matching
        |--------------------------------------------------------------------------
        */

        $inputWords = preg_split(
            '/\s+/u',
            $input,
            -1,
            PREG_SPLIT_NO_EMPTY
        );

        $questionWords = preg_split(
            '/\s+/u',
            $question,
            -1,
            PREG_SPLIT_NO_EMPTY
        );


        if ($inputWords && $questionWords) {

            $matches = count(
                array_intersect(
                    $inputWords,
                    $questionWords
                )
            );


            $wordScore =
                ($matches / count($inputWords)) * 100;


            /*
            |--------------------------------------------------------------------------
            | Combine scores
            |--------------------------------------------------------------------------
            */

            $score = max(
                $score,
                $wordScore
            );
        }


        return $score;
    }


    /*
    |--------------------------------------------------------------------------
    | LOCAL ANSWER GENERATOR
    |--------------------------------------------------------------------------
    */

    private function generateLocalAnswer(
        string $message,
        string $language
    ): string {

        $text = $this->normalizeText($message);


        /*
        |--------------------------------------------------------------------------
        | ARABIC
        |--------------------------------------------------------------------------
        */

        if ($language === 'ar') {

            /*
            | Greetings
            */

            if ($this->containsAny($text, [
                'مرحبا',
                'اهلا',
                'السلام عليكم',
                'هلا',
                'صباح الخير',
                'مساء الخير',
            ])) {

                return 'مرحباً بك في مُروَّج.كم 👋 كيف يمكنني مساعدتك؟';
            }


            /*
            | Shop
            */

            if ($this->containsAny($text, [
                'متجر',
                'انشاء متجر',
                'فتح متجر',
                'عمل متجر',
            ])) {

                return 'لإنشاء متجر على مُروَّج.كم، انتقل إلى قسم البيع أو لوحة البائع، ثم اختر إنشاء متجر وأدخل معلومات المتجر المطلوبة.';
            }


            /*
            | Selling
            */

            if ($this->containsAny($text, [
                'بيع',
                'ابيع',
                'بائع',
                'بيع المنتجات',
            ])) {

                return 'يمكنك البدء بالبيع على مُروَّج.كم من خلال إنشاء حساب، وإنشاء متجر، ثم إضافة المنتجات مع الصور والوصف والسعر والمعلومات المطلوبة.';
            }


            /*
            | Buying
            */

            if ($this->containsAny($text, [
                'شراء',
                'اشتري',
                'مشتري',
                'شراء منتج',
            ])) {

                return 'لشراء منتج، ابحث عن المنتج في مُروَّج.كم، راجع تفاصيله ومعلومات البائع، ثم استخدم خيار الشراء أو تواصل مع البائع إذا كان ذلك متاحاً.';
            }


            /*
            | Delivery
            */

            if ($this->containsAny($text, [
                'توصيل',
                'شحن',
                'التوصيل',
                'الشحن',
            ])) {

                return 'تختلف خدمة التوصيل حسب المنتج والبائع والموقع. تحقق من معلومات التوصيل في صفحة المنتج أو تواصل مع البائع لمعرفة التفاصيل.';
            }


            /*
            | Payment
            */

            if ($this->containsAny($text, [
                'دفع',
                'ادفع',
                'الدفع',
                'بطاقة',
                'فلوس',
                'مال',
            ])) {

                return 'طرق الدفع المتاحة تعتمد على المنتج والبائع وخيارات الدفع الموجودة في مُروَّج.كم. استخدم طرق الدفع الرسمية المتاحة أثناء إتمام الطلب.';
            }


            /*
            | Order
            */

            if ($this->containsAny($text, [
                'طلب',
                'طلبي',
                'الطلب',
                'اين طلبي',
                'وصل طلبي',
            ])) {

                return 'يمكنك مراجعة حالة طلبك من صفحة الطلبات في حسابك. إذا كان الطلب متأخراً، يمكنك التواصل مع البائع أو دعم مُروَّج.كم.';
            }


            /*
            | Seller
            */

            if ($this->containsAny($text, [
                'بائع',
                'البائع',
                'اتواصل مع البائع',
                'التواصل مع البائع',
            ])) {

                return 'يمكنك التواصل مع البائع من صفحة المنتج أو المتجر باستخدام خيار التواصل أو المراسلة المتاح.';
            }


            /*
            | UAE
            */

            if ($this->containsAny($text, [
                'الامارات',
                'الإمارات',
                'دبي',
                'ابوظبي',
                'أبوظبي',
                'الشارقة',
                'عجمان',
            ])) {

                return 'مُروَّج.كم موجه للمستخدمين والبائعين في السوق الإماراتي، وتختلف خدمات البيع والتوصيل والدفع حسب المنتج والبائع والمتطلبات المعمول بها.';
            }


            /*
            | Scam / OTP
            */

            if ($this->containsAny($text, [
                'احتيال',
                'نصب',
                'otp',
                'رمز التحقق',
                'كود التحقق',
            ])) {

                return 'للحفاظ على أمانك، لا تشارك كلمة المرور أو رمز OTP أو الرقم السري للبطاقة مع أي شخص. استخدم طرق الدفع الرسمية ولا تحول الدفع خارج مُروَّج.كم إذا لم يكن ذلك مدعوماً.';
            }


            /*
            | Help
            */

            if ($this->containsAny($text, [
                'مساعدة',
                'ساعدني',
                'ماذا يمكنني',
                'كيف استخدم',
            ])) {

                return 'يمكنني مساعدتك في الأسئلة المتعلقة بالمتاجر والمنتجات والبيع والشراء والبائعين والطلبات والدفع والتوصيل على مُروَّج.كم.';
            }


            /*
            |--------------------------------------------------------------------------
            | Generic Arabic fallback
            |--------------------------------------------------------------------------
            */

            return 'يمكنني مساعدتك في مُروَّج.كم بخصوص المتاجر والمنتجات والبيع والشراء والطلبات والدفع والتوصيل. حاول طرح سؤالك بطريقة أخرى وسأحاول مساعدتك.';
        }


        /*
        |--------------------------------------------------------------------------
        | ENGLISH
        |--------------------------------------------------------------------------
        */


        /*
        | Greetings
        */

        if ($this->containsAny($text, [
            'hello',
            'hi',
            'hey',
            'good morning',
            'good evening',
        ])) {

            return 'Hello 👋 Welcome to murwaj.com. How can I help you today?';
        }


        /*
        | Shop
        */

        if ($this->containsAny($text, [
            'shop',
            'store',
            'create shop',
            'open shop',
            'make shop',
        ])) {

            return 'To create a shop on murwaj.com, open the seller area, choose the shop creation option, and enter the required shop information.';
        }


        /*
        | Selling
        */

        if ($this->containsAny($text, [
            'sell',
            'selling',
            'seller',
            'sell products',
        ])) {

            return 'To start selling on murwaj.com, create an account, create your shop, and add your products with images, descriptions, prices, and the required information.';
        }


        /*
        | Buying
        */

        if ($this->containsAny($text, [
            'buy',
            'buying',
            'purchase',
            'buyer',
            'buy product',
        ])) {

            return 'To buy a product, search for the product on murwaj.com, review the product and seller information, then use the available purchase option or contact the seller.';
        }


        /*
        | Delivery
        */

        if ($this->containsAny($text, [
            'delivery',
            'shipping',
            'deliver',
            'ship',
        ])) {

            return 'Delivery depends on the product, seller, destination, and available delivery service. Check the product page or contact the seller for delivery details.';
        }


        /*
        | Payment
        */

        if ($this->containsAny($text, [
            'payment',
            'pay',
            'credit card',
            'debit card',
            'money',
        ])) {

            return 'Available payment methods depend on the product, seller, and payment options provided on murwaj.com. Use the official payment options available during checkout.';
        }


        /*
        | Order
        */

        if ($this->containsAny($text, [
            'order',
            'my order',
            'where is my order',
            'track order',
            'order status',
        ])) {

            return 'You can check your order status from your orders page. If your order is delayed, contact the seller or murwaj.com support.';
        }


        /*
        | Seller
        */

        if ($this->containsAny($text, [
            'contact seller',
            'message seller',
            'talk to seller',
            'seller contact',
        ])) {

            return 'Open the product or shop page and use the available contact or messaging option to communicate with the seller.';
        }


        /*
        | UAE
        */

        if ($this->containsAny($text, [
            'uae',
            'dubai',
            'abu dhabi',
            'sharjah',
            'ajman',
            'united arab emirates',
        ])) {

            return 'murwaj.com supports marketplace use in the UAE, while selling, delivery, payment, and business requirements can depend on the product, seller, location, and applicable rules.';
        }


        /*
        | Scam
        */

        if ($this->containsAny($text, [
            'scam',
            'fraud',
            'otp',
            'verification code',
            'password',
        ])) {

            return 'For your safety, never share your password, OTP, verification code, card PIN, or sensitive banking information. Use official payment options and be careful with requests to pay outside murwaj.com.';
        }


        /*
        | Help
        */

        if ($this->containsAny($text, [
            'help',
            'what can you do',
            'how can you help',
        ])) {

            return 'I can help with murwaj.com shops, products, selling, buying, sellers, orders, payments, delivery, and marketplace questions.';
        }


        /*
        |--------------------------------------------------------------------------
        | Generic English fallback
        |--------------------------------------------------------------------------
        */

        return 'I can help with murwaj.com shops, products, selling, buying, sellers, orders, payments, and delivery. Please try asking your question another way.';
    }


    /*
    |--------------------------------------------------------------------------
    | CHECK KEYWORDS
    |--------------------------------------------------------------------------
    */

    private function containsAny(
        string $text,
        array $keywords
    ): bool {

        foreach ($keywords as $keyword) {

            $keyword = $this->normalizeText($keyword);

            if ($keyword === '') {
                continue;
            }


            if (Str::contains($text, $keyword)) {

                return true;
            }
        }


        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE TEXT
    |--------------------------------------------------------------------------
    */

    private function normalizeText(
        ?string $text
    ): string {

        if (!$text) {
            return '';
        }


        $text = Str::lower($text);


        /*
        |--------------------------------------------------------------------------
        | Arabic normalization
        |--------------------------------------------------------------------------
        */

        $text = str_replace(
            ['أ', 'إ', 'آ', 'ٱ'],
            'ا',
            $text
        );


        $text = str_replace(
            ['ة'],
            'ه',
            $text
        );


        $text = str_replace(
            ['ى'],
            'ي',
            $text
        );


        /*
        |--------------------------------------------------------------------------
        | Remove Arabic diacritics
        |--------------------------------------------------------------------------
        */

        $text = preg_replace(
            '/[\x{064B}-\x{065F}\x{0670}]/u',
            '',
            $text
        );


        /*
        |--------------------------------------------------------------------------
        | Remove punctuation
        |--------------------------------------------------------------------------
        */

        $text = preg_replace(
            '/[^\p{L}\p{N}\s]/u',
            ' ',
            $text
        );


        /*
        |--------------------------------------------------------------------------
        | Remove duplicate spaces
        |--------------------------------------------------------------------------
        */

        $text = preg_replace(
            '/\s+/u',
            ' ',
            $text
        );


        return trim($text);
    }
}
<?php

namespace App\Livewire\Seller;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Section;
use App\Models\SubCategory;
use App\Notifications\ListingCreatedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateListing extends Component
{
    use WithFileUploads;

    // =========================================================
    // BASIC
    // =========================================================

    public $title = '';
    public $title_ar = '';
    public $description = '';
    public $price;
    public $currency = 'AED';
    public $quantity = 1;

    // =========================================================
    // CATEGORY
    // =========================================================

    public $section_id = null;
    public $category_id = null;
    public $subcategory_id = null;

    // =========================================================
    // BRAND
    // =========================================================

    /*
     * existing  = database brand
     * local     = seller's own brand
     * unbranded = no brand
     */
    public $brand_type = 'unbranded';

    /*
     * IMPORTANT:
     * This property may ONLY contain:
     *
     * integer brand ID
     * OR
     * null
     *
     * Never "local"
     * Never "unbranded"
     */
    public $brand_id = null;

    public $local_brand_name = '';
    public $local_brand_name_ar = '';

    // =========================================================
    // PRODUCT
    // =========================================================

    public $condition = 'new';
    public $price_condition = 'fixed';

    public $keywords = [];
    public $keyword = '';

    public $features = [];
    public $feature = '';

    // =========================================================
    // SHIPPING
    // =========================================================

    public $shipping_method = '';
    public $delivery_days;

    // =========================================================
    // MEDIA
    // =========================================================

    public $image;
    public $video;
    public $images = [];

    // =========================================================
    // SUBSCRIPTION
    // =========================================================

    public $subscription;
    public $plan;
    public $usedListings = 0;
    public $canCreate = true;

    // =========================================================
    // MOUNT
    // =========================================================

    public function mount(): void
    {
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $shop = $user->shop;

        if (! $shop) {
            abort(403, 'Please create a shop first.');
        }

        /*
     * IMPORTANT:
     * Product currency always comes from the seller's shop.
     *
     * Do NOT use:
     * $this->shop
     *
     * because this component does not have a $shop property.
     */
        $this->currency = $shop->currency ?: 'AED';

        $this->subscription = $shop->subscriptions()
            ->entitled()
            ->orderByRaw("CASE WHEN payment_provider = 'stripe' THEN 0 ELSE 1 END")
            ->with('plan')
            ->latest()
            ->first();

        if (! $this->subscription || ! $this->subscription->plan) {
            $this->canCreate = false;
            return;
        }

        $this->plan = $this->subscription->plan;

        $this->refreshListingLimit();
    }

    // =========================================================
    // VALIDATION
    // =========================================================

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'title_ar' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:1',
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1',
            ],

            'section_id' => [
                'required',
                'integer',
                'exists:sections,id',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'required',
                'integer',
                'exists:subcategories,id',
            ],

            'brand_type' => [
                'required',
                'in:existing,local,unbranded',
            ],

            /*
             * NEVER receives "local" or "unbranded".
             */
            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id',
            ],

            'local_brand_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'local_brand_name_ar' => [
                'nullable',
                'string',
                'max:255',
            ],

            'condition' => [
                'required',
                'string',
                'max:50',
            ],

            'price_condition' => [
                'required',
                'string',
                'max:50',
            ],

            'shipping_method' => \App\Services\Checkout\ShippingMethod::rules(Auth::user()?->shop),

            'delivery_days' => [
                'required',
                'integer',
                'min:1',
            ],

            'image' => [
                'required',
                'image',
                'max:2048',
            ],

            'video' => [
                \Illuminate\Validation\Rule::prohibitedIf(Auth::user()?->shop?->activeSubscription?->plan?->is_free === true),
                'nullable',
                'file',
                'mimes:mp4,mov,webm',
                'max:51200',
            ],

            'images.*' => [
                'image',
                'max:2048',
            ],

            'keywords.*' => [
                'nullable',
                'string',
                'max:100',
            ],

            'features.*' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    // =========================================================
    // CATEGORY
    // =========================================================

    public function selectSection($sectionId): void
    {
        $this->section_id = (int) $sectionId;

        $this->category_id = null;
        $this->subcategory_id = null;

        $this->resetBrandSelection();
    }

    public function selectCategory($categoryId): void
    {
        $this->category_id = (int) $categoryId;

        $this->subcategory_id = null;

        $this->resetBrandSelection();
    }

    public function selectSubcategory($subcategoryId): void
    {
        $this->subcategory_id = (int) $subcategoryId;

        $this->resetBrandSelection();
    }

    // =========================================================
    // BRAND
    // =========================================================

    public function selectBrand($brandId): void
    {
        $brandId = (int) $brandId;

        if ($brandId <= 0) {
            $this->addError(
                'brand_id',
                'Invalid brand selected.'
            );

            return;
        }

        $brandExists = Brand::where('id', $brandId)
            ->where('subcategory_id', $this->subcategory_id)
            ->exists();

        if (! $brandExists) {
            $this->addError(
                'brand_id',
                'The selected brand is invalid for this subcategory.'
            );

            return;
        }

        $this->brand_type = 'existing';

        /*
         * ONLY INTEGER HERE
         */
        $this->brand_id = $brandId;

        $this->clearLocalBrand();

        $this->resetValidation([
            'brand_id',
            'local_brand_name',
            'local_brand_name_ar',
        ]);
    }

    public function useLocalBrand(): void
    {
        $this->brand_type = 'local';

        /*
         * IMPORTANT:
         * Local brand has no database brand ID.
         */
        $this->brand_id = null;

        $this->resetValidation([
            'brand_id',
            'local_brand_name',
            'local_brand_name_ar',
        ]);
    }

    public function selectUnbranded(): void
    {
        $this->brand_type = 'unbranded';

        /*
         * Unbranded also has no database brand ID.
         */
        $this->brand_id = null;

        $this->clearLocalBrand();

        $this->resetValidation([
            'brand_id',
            'local_brand_name',
            'local_brand_name_ar',
        ]);
    }

    private function resetBrandSelection(): void
    {
        $this->brand_type = 'unbranded';
        $this->brand_id = null;

        $this->clearLocalBrand();
    }

    private function clearLocalBrand(): void
    {
        $this->local_brand_name = '';
        $this->local_brand_name_ar = '';
    }

    // =========================================================
    // FEATURES
    // =========================================================

    public function addFeature(): void
    {
        $value = trim((string) $this->feature);

        if ($value === '') {
            return;
        }

        if (! in_array($value, $this->features, true)) {
            $this->features[] = $value;
        }

        $this->feature = '';
    }

    public function removeFeature($index): void
    {
        if (isset($this->features[$index])) {
            unset($this->features[$index]);
        }

        $this->features = array_values($this->features);
    }

    // =========================================================
    // KEYWORDS
    // =========================================================

    public function addKeyword(): void
    {
        $value = trim((string) $this->keyword);

        if ($value === '') {
            return;
        }

        if (! in_array($value, $this->keywords, true)) {
            $this->keywords[] = $value;
        }

        $this->keyword = '';
    }

    public function removeKeyword($index): void
    {
        if (isset($this->keywords[$index])) {
            unset($this->keywords[$index]);
        }

        $this->keywords = array_values($this->keywords);
    }

    // =========================================================
    // LISTING LIMIT
    // =========================================================

    private function refreshListingLimit(): void
    {
        $shop = Auth::user()?->shop;

        if (! $shop || ! $this->plan) {
            $this->usedListings = 0;
            $this->canCreate = false;

            return;
        }

        $this->usedListings = $shop->listings()
            ->where('status', 'published')
            ->where(function ($query) {
                $query
                    ->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->count();

        $this->canCreate =
            $this->usedListings < (int) $this->plan->listing_limit;
    }

    // =========================================================
    // STORAGE
    // =========================================================

    private function checkStorageLimit($user): bool
    {
        $shop = $user->shop;

        if (! $shop) {
            session()->flash(
                'error',
                'Please create a shop first.'
            );

            return false;
        }

        $subscription = $shop->subscriptions()
            ->entitled()
            ->orderByRaw("CASE WHEN payment_provider = 'stripe' THEN 0 ELSE 1 END")
            ->with('plan')
            ->latest()
            ->first();

        if (! $subscription || ! $subscription->plan) {
            session()->flash(
                'error',
                'Please subscribe first.'
            );

            return false;
        }

        $plan = $subscription->plan;

        $usedStorage = $user->storageUsed();

        $newStorage = 0;

        if ($this->image) {
            $newStorage += $this->image->getSize();
        }

        if ($this->video) {
            $newStorage += $this->video->getSize();
        }

        foreach ($this->images as $image) {
            if ($image) {
                $newStorage += $image->getSize();
            }
        }

        $usedStorageMb = $usedStorage / 1024 / 1024;
        $newStorageMb = $newStorage / 1024 / 1024;

        if (
            ($usedStorageMb + $newStorageMb)
            > (float) $plan->storage_limit
        ) {
            session()->flash(
                'error',
                'Storage limit reached. You are using ' .
                    round($usedStorageMb, 2) .
                    ' MB out of ' .
                    $plan->storage_limit .
                    ' MB.'
            );

            return false;
        }

        return true;
    }

    // =========================================================
    // SAVE
    // =========================================================

    public function save($status = 'published')
    {
        if (! in_array($status, ['published', 'draft'], true)) {
            abort(400, 'Invalid listing status.');
        }

        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $shop = $user->shop;

        if (! $shop) {
            session()->flash(
                'error',
                'Please create a shop first.'
            );

            return;
        }

        /*
     * =====================================================
     * CURRENCY
     * =====================================================
     *
     * Product currency ALWAYS follows shop currency.
     */
        $this->currency = $shop->currency ?: 'AED';

        $subscription = $shop->subscriptions()
            ->entitled()
            ->orderByRaw("CASE WHEN payment_provider = 'stripe' THEN 0 ELSE 1 END")
            ->with('plan')
            ->latest()
            ->first();

        if (! $subscription || ! $subscription->plan) {
            session()->flash(
                'error',
                'Please subscribe first.'
            );

            return;
        }

        $plan = $subscription->plan;

        if ($status === 'published') {
            $this->refreshListingLimit();

            if (! $this->canCreate) {
                session()->flash(
                    'error',
                    'You have reached your plan limit. Please upgrade your subscription.'
                );

                return;
            }
        }

        /*
         * IMPORTANT:
         * Normalize brand_id BEFORE validation.
         *
         * This prevents accidental values such as:
         * "local"
         * "unbranded"
         */
        if ($this->brand_type !== 'existing') {
            $this->brand_id = null;
        } else {
            if (
                $this->brand_id === null ||
                $this->brand_id === ''
            ) {
                $this->brand_id = null;
            } else {
                $this->brand_id = (int) $this->brand_id;
            }
        }

        $this->validate();

        // -----------------------------------------------------
        // BRAND VALIDATION
        // -----------------------------------------------------

        $localBrandName = null;
        $localBrandNameAr = null;

        if ($this->brand_type === 'existing') {

            if (! $this->brand_id) {
                $this->addError(
                    'brand_id',
                    'Please select a brand.'
                );

                return;
            }

            $brandExists = Brand::where('id', $this->brand_id)
                ->where('subcategory_id', $this->subcategory_id)
                ->exists();

            if (! $brandExists) {
                $this->addError(
                    'brand_id',
                    'The selected brand is invalid for this subcategory.'
                );

                return;
            }
        } elseif ($this->brand_type === 'local') {

            if (! filled($this->local_brand_name)) {
                $this->addError(
                    'local_brand_name',
                    'English local brand name is required.'
                );

                return;
            }

            if (! filled($this->local_brand_name_ar)) {
                $this->addError(
                    'local_brand_name_ar',
                    'Arabic local brand name is required.'
                );

                return;
            }

            $this->brand_id = null;

            $localBrandName = trim($this->local_brand_name);
            $localBrandNameAr = trim($this->local_brand_name_ar);
        } else {

            $this->brand_id = null;
        }

        // -----------------------------------------------------
        // STORAGE
        // -----------------------------------------------------

        if (! $this->checkStorageLimit($user)) {
            return;
        }

        // -----------------------------------------------------
        // FINAL LISTING LIMIT
        // -----------------------------------------------------

        if ($status === 'published') {

            $currentListings = $shop->listings()
                ->where('status', 'published')
                ->where(function ($query) {
                    $query
                        ->whereNull('expires_at')
                        ->orWhere('expires_at', '>', now());
                })
                ->count();

            if ($currentListings >= (int) $plan->listing_limit) {
                session()->flash(
                    'error',
                    'Listing limit reached.'
                );

                return;
            }
        }

        // =====================================================
        // CREATE
        // =====================================================

        $listing = new Listing();

        $listing->sku =
            now()->format('YmdHis') .
            '-' .
            uniqid();

        $listing->title = trim($this->title);
        $listing->title_ar = trim($this->title_ar);
        $listing->description = trim($this->description);

        $listing->price = $this->price;
        $listing->currency = $this->currency;
        $listing->quantity = $this->quantity;

        $listing->section_id = (int) $this->section_id;
        $listing->category_id = (int) $this->category_id;
        $listing->subcategory_id = (int) $this->subcategory_id;

        // =====================================================
        // BRAND
        // =====================================================

        /*
         * This is now ALWAYS:
         *
         * integer
         * OR null
         */
        $listing->brand_id = $this->brand_id
            ? (int) $this->brand_id
            : null;

        $listing->local_brand_name = $localBrandName;
        $listing->local_brand_name_ar = $localBrandNameAr;

        // =====================================================
        // PRODUCT
        // =====================================================

        $listing->condition = $this->condition;
        $listing->price_condition = $this->price_condition;

        $listing->keywords = array_values(
            array_filter(
                $this->keywords,
                fn($value) =>
                is_string($value) && trim($value) !== ''
            )
        );

        $listing->features = array_values(
            array_filter(
                $this->features,
                fn($value) =>
                is_string($value) && trim($value) !== ''
            )
        );

        // =====================================================
        // SHOP
        // =====================================================

        $listing->shop_id = $shop->id;
        $listing->user_id = $user->id;
        $listing->active = true;

        // =====================================================
        // SHIPPING
        // =====================================================

        $listing->shipping_method = $this->shipping_method;
        $listing->delivery_days = $this->delivery_days;
        $listing->status = $status;

        // =====================================================
        // PUBLISHED
        // =====================================================

        if ($status === 'published') {

            $listing->published_at = now();

            $listing->expires_at = $plan->listing_duration
                ? now()->addDays(
                    (int) $plan->listing_duration
                )
                : null;
        } else {

            $listing->published_at = null;
            $listing->expires_at = null;
        }

        // =====================================================
        // MAIN IMAGE
        // =====================================================

        if ($this->image) {

            $imageName =
                Carbon::now()->format('YmdHis') .
                '_main_' .
                uniqid() .
                '.' .
                $this->image->extension();

            $this->image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $listing->image = $imageName;
        }

        // =====================================================
        // VIDEO
        // =====================================================

        if ($this->video) {

            $videoName =
                Carbon::now()->format('YmdHis') .
                '_video_' .
                uniqid() .
                '.' .
                $this->video->extension();

            $this->video->storeAs(
                'products/videos',
                $videoName,
                'public'
            );

            $listing->video = $videoName;
        }

        // =====================================================
        // GALLERY
        // =====================================================

        $gallery = [];

        foreach ($this->images as $key => $image) {

            if (! $image) {
                continue;
            }

            $imageName =
                Carbon::now()->format('YmdHis') .
                '_gallery_' .
                $key .
                '_' .
                uniqid() .
                '.' .
                $image->extension();

            $image->storeAs(
                'products',
                $imageName,
                'public'
            );

            $gallery[] = $imageName;
        }

        $listing->images = ! empty($gallery)
            ? $gallery
            : null;

        // =====================================================
        // DATABASE
        // =====================================================

        DB::transaction(function () use ($listing) {
            $listing->save();
        });

        // =====================================================
        // NOTIFICATION
        // =====================================================

        if ($listing->status === 'published') {
            $user->notify(
                new ListingCreatedNotification($listing)
            );
        }

        // =====================================================
        // SUCCESS
        // =====================================================

        session()->flash(
            'success',
            $status === 'published'
                ? 'Product published successfully.'
                : 'Product saved successfully.'
        );

        return redirect()->route('profile');
    }

    // =========================================================
    // RENDER
    // =========================================================

    public function render()
    {
        $locale = app()->getLocale();

        return view(
            'livewire.seller.create-listing',
            [
                'sections' => Section::query()
                    ->orderBy(
                        $locale === 'ar'
                            ? 'name_ar'
                            : 'name'
                    )
                    ->get(),

                'categories' => Category::query()
                    ->orderBy(
                        $locale === 'ar'
                            ? 'category_name_ar'
                            : 'category_name'
                    )
                    ->get(),

                'subcategories' => SubCategory::query()
                    ->orderBy(
                        $locale === 'ar'
                            ? 'subcategory_name_ar'
                            : 'subcategory_name'
                    )
                    ->get(),

                'brands' => Brand::query()
                    ->orderBy(
                        $locale === 'ar'
                            ? 'brand_name_ar'
                            : 'brand_name'
                    )
                    ->get(),
            ]
        );
    }

    // =========================================================
    // LIVE PREVIEW
    // =========================================================

    public function updated($property): void
    {
        $imageUrl = null;

        if ($this->image) {
            try {
                $imageUrl = $this->image->temporaryUrl();
            } catch (\Throwable $e) {
                $imageUrl = null;
            }
        }

        $this->dispatch(
            'previewUpdated',
            title: $this->title,
            title_ar: $this->title_ar,
            description: $this->description,
            price: $this->price,
            quantity: $this->quantity,
            condition: $this->condition,
            price_condition: $this->price_condition,
            features: $this->features,
            keywords: $this->keywords,
            image: $imageUrl,
            local_brand_name: $this->local_brand_name,
            local_brand_name_ar: $this->local_brand_name_ar,
            brand_id: $this->brand_id,
            brand_type: $this->brand_type,
            section_id: $this->section_id,
            category_id: $this->category_id,
            subcategory_id: $this->subcategory_id
        );
    }
}

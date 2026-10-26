# Public web catalog visibility

The active web browsing routes now use the same existing scopes as the public catalog API: `Listing::active()` and `Shop::publicCatalog()`. No global scope was added: seller/admin dashboards can still access their own drafts through existing protected tools.

A public store must be active, completed, published at or before now and not deleted. A listing must be active, published, have a non-null publication date at or before now, not be expired/deleted and belong to a public store. This does not automatically publish or repair existing rows. Records with missing dates/completion flags remain hidden until deliberately published through the appropriate workflow.

## Guest access

- Guests may read the existing `/shop/{slug}`, `/creators` and canonical product detail routes.
- Store creation/editing, cart, checkout, following, wishlists, reviews and Raslo account tools retain their existing authentication boundaries.
- Optional category/section/subcategory relations retain the existing canonical placeholder URL segments. Wrong store/category/brand segments return 404.
- Hidden records return 404 to authenticated visitors too; public pages are not owner-preview routes. Use protected seller editing tools for drafts.

## Covered surfaces

Explore listing grids, featured/trending/section collections, section/category/UAE pages, store products/categories, creator search/counts, homepage shop cards, Livewire search/shop lists, country shop previews/counts, post-feed recommendations and product/shop sitemaps use the shared visibility rules. DigitalProduct is a separate model with its own published-status rules and is not silently included in the physical-listing API.

Search now accepts `q` from the existing homepage/header forms, while retaining the legacy `search` parameter. Private owner email is no longer a creator-search input. The public product page respects `allow_phone` and displays approved product reviews only.

The sitemap index points at the actual `sitemap-products.xml` endpoint. Product sitemap URLs use the model's complete canonical URL, rather than an incomplete route call. Other sitemap modules (for example developer profiles) are outside this patch.

## Applying and validating

No database migration, publication backfill, environment/key change or dependency install is required. The guarded installer only applies source/test/docs files and creates a local commit. It does not push or deploy. Existing route caches must be rebuilt as part of an explicitly authorized application update before guest-access changes take effect; the installer does not clear runtime caches itself.

Regression tests render actual guest pages in Arabic and English, compare web/API visibility, check hidden states, protect write operations, verify search, contact privacy, review approval and sitemap output. These are server-rendering tests; they do not replace visual mobile-browser or device acceptance testing.

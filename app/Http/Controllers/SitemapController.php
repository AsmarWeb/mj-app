<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Developer;
use App\Models\Listing;
use App\Models\Shop;

class SitemapController extends Controller
{
    public function index()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '<sitemapindex 
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $maps = [

            'sitemap-pages.xml',

            'sitemap-products.xml',

            'sitemap-shops.xml',

            'sitemap-categories.xml',

            'sitemap-developers.xml',

        ];

        foreach ($maps as $map) {

            $content .= '

            <sitemap>

            <loc>'.
            url($map)
            .'</loc>

            </sitemap>';

        }

        $content .= '</sitemapindex>';

        return response(
            $content,
            200
        )
            ->header(
                'Content-Type',
                'application/xml'
            );

    }

    public function pages()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $pages = [

            '/',

            '/about',

            '/contact',

            '/pricing',

            '/developers',

        ];

        foreach ($pages as $page) {

            $content .= '

<url>

<loc>'.url($page).'</loc>

<priority>0.8</priority>

</url>';

        }

        $content .= '</urlset>';

        return response($content)
            ->header(
                'Content-Type',
                'application/xml'
            );

    }

    public function products()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        Listing::active()->with(['shop', 'section', 'category', 'subcategory', 'brand'])
            ->chunk(1000, function ($listings) use (&$content) {

                foreach ($listings as $listing) {

                    $content .= '

<url>

<loc>'.
                    htmlspecialchars($listing->url, ENT_XML1, 'UTF-8')
                    .'</loc>

<changefreq>weekly</changefreq>

<priority>0.9</priority>

</url>';

                }

            });

        $content .= '</urlset>';

        return response($content)
            ->header(
                'Content-Type',
                'application/xml'
            );

    }

    public function shops()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        Shop::publicCatalog()
            ->chunk(1000, function ($shops) use (&$content) {

                foreach ($shops as $shop) {

                    $content .= '

<url>

<loc>'.
                    route(
                        'shop',
                        $shop->slug
                    )
                    .'</loc>

<priority>0.8</priority>

</url>';

                }

            });

        $content .= '</urlset>';

        return response($content)
            ->header(
                'Content-Type',
                'application/xml'
            );

    }

    public function developers()
    {

        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        Developer::where('approved', true)
            ->each(function ($developer) use (&$content) {

                $content .= '

<url>

<loc>'.
                route(
                    'developers.show',
                    $developer->id
                )
                .'</loc>

</url>';

            });

        $content .= '</urlset>';

        return response($content)
            ->header(
                'Content-Type',
                'application/xml'
            );

    }

    public function categories()
    {
        $content = '<?xml version="1.0" encoding="UTF-8"?>';

        $content .= '
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';

        Category::where('status', 'active')
            ->chunk(1000, function ($categories) use (&$content) {

                foreach ($categories as $category) {

                    $lastModified = $category->updated_at
                        ? $category->updated_at->toAtomString()
                        : now()->toAtomString();

                    $content .= '

                <url>

                    <loc>'
                            .htmlspecialchars(
                                route(
                                    'discover.category',
                                    $category->slug
                                ),
                                ENT_XML1,
                                'UTF-8'
                            )
                        .'</loc>

                    <lastmod>'
                            .$lastModified.
                        '</lastmod>

                    <changefreq>weekly</changefreq>

                    <priority>0.8</priority>

                </url>';

                }

            });

        $content .= '</urlset>';

        return response($content)
            ->header(
                'Content-Type',
                'application/xml'
            );
    }

    public function page()
    {
        return view('sitemap.index', [
            'categories' => Category::where('status', 'active')->take(20)->get(),
            'shops' => Shop::publicCatalog()->latest()->take(20)->get(),
            'products' => Listing::active()->with(['shop', 'section', 'category', 'subcategory', 'brand'])->latest()->take(20)->get(),
            'countries' => Country::withCount(['shops' => fn ($q) => $q->publicCatalog()])
                ->orderBy('name')
                ->get(),
        ]);
    }
}

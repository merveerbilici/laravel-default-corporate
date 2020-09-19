<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reference;
use App\Models\Service;

use Setting;

class ShareFrontend
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $settings = Setting::all();
        View::share( 'settings', $settings );

        $header_blogs = Blog::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_blogs', $header_blogs);
        $header_blog_categories = BlogCategory::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_blog_categories', $header_blog_categories);
        $header_pages = Page::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_pages', $header_pages);
        $header_products = Product::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_products', $header_products);
        $header_product_categories = ProductCategory::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_product_categories', $header_product_categories);
        $header_references = Reference::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_references', $header_references);
        $header_services = Service::active()->showHeader()->orderBy('order', 'DESC')->get();
        View::share( 'header_services', $header_services);

        $footer_blogs = Blog::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_blogs', $footer_blogs);
        $footer_blog_categories = BlogCategory::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_blog_categories', $footer_blog_categories);
        $footer_pages = Page::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_pages', $footer_pages);
        $footer_products = Product::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_products', $footer_products);
        $footer_product_categories = ProductCategory::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_product_categories', $footer_product_categories);
        $footer_references = Reference::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_references', $footer_references);
        $footer_services = Service::active()->showFooter()->orderBy('order', 'DESC')->get();
        View::share( 'footer_services', $footer_services);

        return $next($request);
    }

}
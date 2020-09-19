<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SliderImage;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Reference;
use App\Models\Service;

use Carbon\Carbon;
use Setting;
use Sentinel;
use Validator;
use Mail;
use SEO;


class SiteController extends Controller
{
	public function getIndex()
    {
        SEO::setTitle("Anasayfa");

        $products = Product::active()->showIndex()->orderBy('order', 'DESC')->take(6)->get();
        $references = Reference::active()->showIndex()->orderBy('order', 'DESC')->take(3)->get();
        $services = Service::active()->showIndex()->orderBy('order', 'DESC')->get();
        $sliderimages = SliderImage::active()->orderBy('order', 'DESC')->get();

    	return view("frontend.index", compact('products', 'references', 'services', 'sliderimages'));
    }
    public function getAbout()
    {
        SEO::setTitle("Hakkımızda");

        $page = Page::find(1);
        $references = Reference::where('status', 1)->orderBy('order')->get();

        return view("frontend.about", compact('page', 'references'));
    }
    public function getContact()
    {
        SEO::setTitle("İletişim");

    	return view("frontend.contact");
    }    
    public function postContact(Request $request)
    {
        $rules = [
            'name'      => 'required',
            'email'     => 'required',
            'message'   => 'required',
        ];
        $messages = [
            'required' => 'Zorunlu alanları doldurunuz',
        ];
        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->with(['errors' => $validation->errors()->all()]);
        } else {
            $data = array (
                'name' => $request->name,
                'email' => $request->email,
                'messagedata' => $request->message
            );
            Mail::send ( 'emailtemplate.contactform', $data, function ($message) {
            
                $message->from ( 'info@sitename.com', env('APP_NAME'));
                
                $message->to('merveerbilici@gmail.com')/*->bcc('merveerbilici@gmail.com')*/->subject ( 'İletişim Formu' );
            });

            return redirect()->route('site.contact')->with(['success' => 'Mesajınız başarıyla iletilmiştir.']);
        }
    }
    public function getPage(Request $request)
    {
        $page = Page::where('slug', $request->slug)->first();

        if ($page == TRUE) {
            if ($page->seo_title == true) {
                SEO::setTitle($page->seo_title);
            } else {
                SEO::setTitle($page->name);
            }        
            if ($page->seo_desc == true) {
                SEO::setDescription($page->seo_desc);
            } else {
                SEO::setDescription($page->name);
            }

            return view("frontend.page", compact('page'));
        } else {
            return redirect()->back();
        }
    }

    public function getServices(Request $request)
    {
        SEO::setTitle("Hizmetler");

        $services = Service::active()->orderBy('order', 'DESC')->get();

        return view("frontend.service.all", compact('services'));
    }
    public function getServiceDetail(Request $request)
    {
        $service = Service::where('slug', $request->slug)->first();

        if ($service == TRUE) {
            SEO::setTitle($service->name);
            SEO::setDescription($service->name);

            $services = Service::active()->orderBy('order', 'DESC')->get();

            return view("frontend.service.detail", compact('service', 'services'));
        } else {
            return redirect()->back();
        }
    }
    public function getProducts(Request $request)
    {
        SEO::setTitle("Ürünler");

        $productcategories = ProductCategory::active()->orderBy('order', 'DESC')->get();
        $products = Product::active()->orderBy('order', 'DESC')->paginate(20);

        return view("frontend.product.all", compact('products', 'productcategories', 'request'));
    }
    public function getProductDetail(Request $request)
    {
        $product = Product::active()->where('slug', $request->slug)->first();

        if ($product == TRUE) {
            SEO::setTitle($product->name);
            SEO::setDescription($product->name);

            $productcategories = ProductCategory::active()->orderBy('order', 'DESC')->get();

            return view("frontend.product.detail", compact('product', 'productcategories'));
        } else {
            return redirect()->back();
        }
    }
    public function getReferenceDetail(Request $request)
    {
        $reference = Reference::active()->where('slug', $request->slug)->first();

        if ($reference == TRUE) {
            SEO::setTitle($reference->name);
            SEO::setDescription($reference->name);

            $references = Reference::active()->orderBy('order', 'DESC')->get();

            return view("frontend.reference.detail", compact('reference', 'references'));
        } else {
            return redirect()->back();
        }
    }
}
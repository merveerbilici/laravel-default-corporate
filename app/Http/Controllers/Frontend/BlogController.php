<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;

use Validator;
use SEO;

class BlogController extends Controller
{
	public function getBlog(Request $request)
	{
		SEO::setTitle("Blog");

		$blog_data = Blog::active()->orderby('order','DESC');
		if ($request->search == TRUE) {
			$blog_data = $blog_data->orWhere('title', '%' . $request->search . '%')->orWhere('blog_content', '%' . $request->search . '%');
		}
		if ($request->blog_slug == TRUE) {
			$blog_data = $blog_data->where('slug', '%' . $request->blog_slug . '%');
		}
		if ($request->blog_category_slug == TRUE) {
			$gelen_category = BlogCategory::where('slug', '%' . $request->blog_category_slug . '%')->first();

			$blog_data = $blog_data->where('category_id', $gelen_category->id);
		}
		$posts = $blog_data->paginate(20);

		$blogcategories = BlogCategory::active()->orderby('order', 'DESC')->get();
		$recentposts = Blog::active()->orderBy('order', 'DESC')->take(3)->get();

		return view("frontend.blog.all", compact('posts', 'blogcategories', 'recentposts', 'request'));
	}

	public function getBlogDetail(Request $request)
	{
		$post = Blog::where('slug', $request->blog_slug)->first();

		if ($post == TRUE) {
			if ($post->seo_title == true) {
	            SEO::setTitle($post->seo_title);
	        } else {
	            SEO::setTitle($post->title);
	        }        
	        if ($post->seo_desc == true) {
	            SEO::setDescription($post->seo_desc);
	        } else {
	            SEO::setDescription($post->title);
	        }

			$blogcategories = BlogCategory::active()->orderby('order', 'DESC')->get();
			$recentposts = Blog::active()->orderBy('order', 'DESC')->where('id', '!=', $post->id)->take(3)->get();

			return view("frontend.blog.detail", compact('post', 'blogcategories', 'recentposts'));
		} else {
			return redirect()->back();
		}
	}
}
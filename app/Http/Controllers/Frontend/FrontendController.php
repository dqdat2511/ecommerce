<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
   public function index()
   {
      $feature_products = Product::where('trending' ,'1')->take(15)->get();
      $trending_category = Category::where('popular' ,'1')->take(15)->get();
    return view('frontend.index', compact('feature_products','trending_category'));
   }
   public function category()
   {
        $category = Category::where('status','0')->get();
        return view('frontend.category',compact('category'));
   }

   public function viewcategory($slug)
   {
        if(Category::where('slug',$slug)->exists())
        {
           $category = Category::where('slug',$slug)->first();
           $products = Product::where('cate_id',$category->id)->where('status','0')->get();
           return view('frontend.products.index',compact('category','products'));
        }
        else
        {
            return redirect('/')->with('status',"Slug không tồn tại");
        }

   }

   public function productview($cate_slug,$prod_slug)
   {
        if(Category::where('slug', $cate_slug)->exists())
        {
            if(Product::where('slug',$prod_slug)->exists())
            {
                    $products = Product::where('slug',$prod_slug)->first();
                    $ratings = Rating::where('prod_id',$products->id)->get();
                    $ratings_sum = Rating::where('prod_id',$products->id)->sum('stars_rated');
                    $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();
                    $reviews = Review::where('prod_id', $products->id)->get();
                    if($ratings->count()>0){
                        $ratings_value = $ratings_sum/$ratings->count();
                    }else{
                        $ratings_value = 0;
                    }

                    return view('frontend.products.view',compact('products','ratings','ratings_value','user_rating','reviews'));
            }
            else
            {
                return redirect('/')->with('status',"link hỏng rồi hehe");
            }
        }else{
            return redirect('/')->with('status',"Không có danh mục trên");
        }
   }
}
<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist', compact('wishlist'));
    }
    public function add(Request $request)
    {
       if(Auth::check())
       {
            $prod_id = $request->input('product_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id', Auth::id())->exists())
            {
                return response()->json(['status' => "Đã có trong giỏ hàng"]);
            }
            else if(Product::find($prod_id)){
                $wishlist = new Wishlist();
                $wishlist->prod_id = $prod_id;
                $wishlist->user_id = Auth::id();
                $wishlist->save();
                return response()->json(['status' => "Đã thêm vào yêu thích"]);
            }

            else
            {
                return response()->json(['status' => " Sản phẩm không tồn tại"]);

            }
       }
       else
       {
        return response()->json(['status' => "Login to Continue"]);
       }
    }

    public function deleteitem(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists())
            {
                $wish = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "Xóa thành công"]);
            }
        }
        else
        {
         return response()->json(['status' => "Login to Continue"]);
        }
    }

    public function wishlistcount()
    {
       $wishlistcount = Wishlist::where('user_id', Auth::id())->count();
       return response()->json(['count'=>$wishlistcount]);
    }
}
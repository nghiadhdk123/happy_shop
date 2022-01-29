<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;

class ProductController extends Controller
{
    public function show($slug)
    {
        // $product = Product::find($slug);
        $product = Product::where('slug',$slug)->first();

        $comment_post = Comment::where('product_id',$product->id)
                                ->where('parent_id',0)
                                ->orderBy('created_at','DESC')
                                ->get();
        // dd($product);
        return view('client.products.detail',[
            'product' => $product,
            'comment_post' => $comment_post,
        ]);
    }

    public function ProductByCategory(Request $request,$slug)
    {
        $product_by_category = Category::where('slug',$slug)->first();

        // if(isset($request->key))
        // {
        //     $product_by_category = 
        // }

        return view('client.products.products-by-category',[
            'product_by_category' => $product_by_category,
        ]);
    }
}

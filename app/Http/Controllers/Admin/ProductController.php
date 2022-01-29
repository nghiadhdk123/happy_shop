<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $product = Product::all();
        if(isset($request->keyword))
        {
            $product = Product::where('name','LIKE','%'.$request->keyword.'%')->get();
        }

        return view('admin.product.index',[
            'product' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoty = Category::where('parent_id',0)->get();
        $parent = Category::where('parent_id','!=',0)->get();
        return view('admin.product.create',[
            'category' => $categoty,
            'parent' => $parent,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->except('_token');

        if ($request->has('key') || $request->has('val')) {
            $key = $request->get('key');
            $val = $request->get('val');
            $list = [];
            $merge = [];
            for ($i = 0; $i < count($key); $i++) {
                $list = [$key[$i] => $val[$i]];
                $merge = array_merge($merge, $list);
            }
            $data['content_more'] = json_encode($merge, JSON_UNESCAPED_UNICODE);
        }

        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');
        $data['origin_price'] = $request->get('origin_price');
        $data['sale_price'] = $request->get('sale_price');
        $data['quantity'] = $request->get('quantity');
        $data['inventory'] = $request->get('quantity');
        $data['category_id'] = $request->get('category_id');
        $data['status'] = $request->get('status');
        $data['slug'] = Str::slug($request->get('name'));
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        $product = Product::create($data);

        if ($request->hasFile('image')) {
            $files = $request->file('image');

            foreach ($files as $file) {

                $name = $file->getClientOriginalName();
                $path = Storage::disk('public')    //->Lưu vào trong thư mục public
                    ->putFileAs('images', $file, $name); 

                $image = new Image();
                $image->name = $path;
                $image->path = 'pulic';
                $image->product_id = $product->id;
                $image->save();
            }
        }

        return redirect()->route('product.index')->with('success','Tạo mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $id = $request->get('id');
        $product = Product::find($id);
        $product->NameProduct = $product->name;
        $product->UserCreateProduct = $product->user->name;
        if ( $product->category_id != 0){
            $product->CategoryProduct = $product->category->name;
        }else{
            $product->CategoryProduct = 'Không có danh mục';
        }
        $product->StatusProduct = $product->status_text;
        $product->QuantityProduct = $product->quantity;
        $product->SellProduct = $product->sell_number;
        $product->InventoryProduct = $product->inventory;
        $product->DesProduct = $product->description;
        $product->OriginProduct = number_format($product->origin_price). 'VNĐ';
        $product->SaleProduct = number_format($product->sale_price). 'VNĐ';
        $product->CreatedProduct = $product->created_at->toDateString();
        
        echo json_encode($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::where('parent_id',0)->get();
        $parent = Category::where('parent_id','!=',0)->get();

        return view('admin.product.edit',[
            'product' => $product,
            'category' => $category,
            'parent' => $parent,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $data = $request->except('_token');

        if ($request->has('key')) {
            $key = $request->get('key');
            $val = $request->get('val');
            $list = [];
            $merge = [];
            for ($i = 0; $i < count($key); $i++) {
                $list = [$key[$i] => $val[$i]];
                $merge = array_merge($merge, $list);
            }
            $data['content_more'] = json_encode($merge, JSON_UNESCAPED_UNICODE);
        } else {
            $data['content_more'] = null;
        }

        $data['name'] = $request->get('name');
        $data['description'] = $request->get('description');
        $data['origin_price'] = $request->get('origin_price');
        $data['sale_price'] = $request->get('sale_price');
        $data['quantity'] = $request->get('quantity');
        $data['inventory'] = $request->get('quantity');
        $data['category_id'] = $request->get('category_id');
        $data['status'] = $request->get('status');
        $data['slug'] = Str::slug($request->get('name'));
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();

        $product->update($data);

        if ($request->hasFile('image')) {
            $files = $request->file('image');

            foreach ($files as $file) {

                $name = $file->getClientOriginalName();
                $path = Storage::disk('public')    //->Lưu vào trong thư mục public
                    ->putFileAs('images', $file, $name); 

                $image = new Image();
                $image->name = $path;
                $image->path = 'pulic';
                $image->product_id = $product->id;
                $image->save();
            }
        }

        $deleteImg = $request->delete_img;
        if (!empty($deleteImg)) {
            foreach ($deleteImg as $dete) {
                $imgDelete = Image::find($dete);
                Storage::disk('public')->delete($imgDelete->name);
                $imgDelete->delete();
            }
        }
         
        return redirect()->route('product.list',Auth::user()->id)->with('success','Cập nhật thành công');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $image = Image::where('product_id',$id)->get();

        $product->delete();

        foreach($image as $images)
        {
            Storage::disk('public')->delete($images->name);
            $images->delete();
        }

        return redirect()->route('product.list',Auth::user()->id)->with('success','Xóa thành công');
    }

    public function product_of_user(Request $request,$id)
    {
        if($id == Auth::user()->id)
        {
            $products = Product::where('user_id',$id)->get();
            $category = Category::where('parent_id',0)->get();
            $parent = Category::where('parent_id','!=',0)->get();
            if(isset($request->keyword))
            {  
                $products = Product::where('name','LIKE','%'.$request->keyword.'%')
                                    ->where('user_id',$id)
                                    ->get();
            }
            return view('admin.product.list',[
                'products' => $products,
                'category' => $category,
                'parent' => $parent,
            ]);
        }else{
            return view('admin.403.403');
        }
    }
}
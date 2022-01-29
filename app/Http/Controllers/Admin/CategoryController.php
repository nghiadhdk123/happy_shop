<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\CategoryRequest;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::all();

        if(isset($request->keyword))
        {
            $category = Category::where('name','LIKE','%'. $request->keyword .'%')->get();
        }

        return view('admin.category.index',[
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_id = Category::where('parent_id',0)->get();
        return view('admin.category.create',[
            'parent' => $parent_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category;

        $category->name = $request->get('name');
        $category->user_id = Auth::user()->id;
        $category->slug = Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->save();

        return redirect()->route('category.index')->with('success','Tạo mới danh mục sản phẩm thành công');
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
        $category = Category::find($id);
        $category->NameCategory = $category->name;
        $category->UserCreateCategory = $category->user->name;
        if ( $category->parent_id != 0){
            $category->ParentCategory = $category->parent->name;
        }else{
            $category->ParentCategory = 'Không có danh mục cha';
        }
        echo json_encode($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $parent = Category::where('parent_id',0)->where('id','!=',$id)->get();

        return view('admin.category.edit',[
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
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::find($id);

        $category->name = $request->get('name');
        $category->slug = Str::slug($request->get('name'));
        $category->parent_id = $request->get('parent_id');

        $category->save();
        return redirect()->route('category.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $parent_id = Category::where('parent_id',$id)->get();
        $product = Product::where('category_id',$id)->get();
        foreach($parent_id as $value)
        {
            $value->parent_id = 0;
            $value->save();
        }

        foreach($product as $value)
        {
            $value->category_id = 0;
            $value->save();
        }

        $category->delete();
        return redirect()->route('category.index')->with('success','Xóa thành công');
    }
}

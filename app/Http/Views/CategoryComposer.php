<?php


namespace App\Http\Views;


use App\Models\Category;
use App\Models\Tag;
use Illuminate\View\View;

class CategoryComposer
{
    public function compose(View $view)
    {
        // $listTrademarks = Cache::remember('listTrademarks', 60, function() {
        //     return Trademark::all();
        // });

	$categories = Category::where('parent_id',0)->get();
    $tags = Tag::where('status',1)->get();
        $view->with([
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}
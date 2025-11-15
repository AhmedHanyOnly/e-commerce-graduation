<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Image;
use App\Traits\JodaResource;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ArticlesController extends Controller
{
    use JodaResource;
    public $model = 'App\Models\Article';
    public $route = "admin.articles";
    public $view = "admin.articles";
    public $rules = [
        'title' => 'required',
//        'images' => 'nullable',
        'active' => 'required',
        'content' => 'required',
        'article_category_id' => 'nullable'
    ];

    public function query($query)
    {
        return $query->latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validateStoreRequest();

        // dd($data);
        if ($photo = $request->file('image')) {
            $data['image'] = store_file($photo, 'articles');
        }

       $article = Article::create($data);

        return redirect()->route('admin.all_articles')->with('success', "تم الاضافة بنجاح");
    }

    public function update(Request $request, Article $Article)
    {
        $data = $this->validateUpdateRequest();

        if ($photo = $request->file('image')) {
            delete_file($Article->image);
            $data['image'] = store_file($photo, 'articles');
        }
        $Article->update($data);
//        if ($request->hasfile('images')){
//            foreach ($request->file('images') as $img){
//                $Article->images()->create(['image' => store_file($img,'articles')]);
//            }
//        }


        return redirect()->route('admin.all_articles')->with('success', 'تم التعديل بنجاح');
    }


    protected function beforeDestroy($Article)
    {
        if ($Article->image) {
            delete_file($Article->image);
        }
    }

//    public function delete_image($id)
//    {
//        if (auth()->user()->type !== 'admin'){
//            abort(403);
//        }
//        Image::findOrFail($id)->delete();
//        return back()->with('success',__('Deleted successfully'));
//    }

}

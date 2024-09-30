<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // List all the categories in the Manage Categories View
    public function index()
    {
        return view('items.categoryList', ['title' => 'Categories List', 'categories' => Category::all()]);
    }

    public function categoriesList(){
        $cats = DB::table('categories')
            ->select('categories.*')
            ->get();
        return array('data' => $cats);
    }

    public function newCategory(){
        return view('items.categoryForm', ['pageTitle' => 'New Category', 'category'=> new Category()]);
    }

    public function changeCategory($cid){
        return view('items.categoryForm', ['pageTitle' => 'Change Category', 'category'=> Category::find($cid)]);
    }

    public function saveCategory(Request $request){
        $responce = array('result'=>-1, 'msg'=>'-');
        try {
            if(!empty($request->post('categoryID'))){
                $category = Category::find($request->post('categoryID'));
                $category->name = $request->post('categoryName');
                $category->description = $request->post('categoryDescription');
                $category->code = $request->post('categoryCode');
            } else {
                $category = new Category([
                    'id'            => $request->post('categoryID'),
                    'name'          => $request->post('categoryName'), 
                    'description'   => $request->post('categoryDescription'), 
                    'code'          => $request->post('categoryCode')
                ]);
            }
            $responce['result'] = $category->save();
            $responce['msg'] = ($responce['result']==1) ? __('Success in saving category info') : __('Error in saving category info');
        }
        catch(\Exception $exception){
            $responce['result'] = 0;
            $responce['msg'] = __('Error in saving category info') . ' - ' . $exception->getMessage();
        }
        echo(json_encode($responce));
    }

    public function deleteCategory(Request $request){
        try{
            $recs = Category::where('id', $request->post('catID'))->delete(); 
            echo(json_encode(array('result'=>$recs, 'msg'=> ($recs>0) ? 'Success in deleting category' : 'No Categories deleted'))) ;
        }
        catch(\Exception $exception){
            $responce['result'] = 0;
            $responce['msg'] = __('Error in deleting category') . ' - ' . $exception->getMessage();
            echo(json_encode($responce));
        }
        
    }
}
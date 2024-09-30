<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    //
    public function index()
    {
        $items = Item::all(); //fetch all items from DB
        return view('items.itemsList', ['title' => 'Items List', 'items' => $items]);
    }

    public function itemsList(){
        $items = DB::table('items')
            ->join('categories', 'items.category', '=', 'categories.id')
            ->select('items.*', 'categories.name as category_name')
            ->get();
        //$items->create_dt->format('d-m-Y H:i');
        return array('data' => $items);
    }

    public function newItem(){
        return view('items.itemForm', 
            ['pageTitle' => 'New Item', 
             'item'=> new Item(), 
             'categories'=>Category::all() ,
            ]);
    }

    public function changeItem($item){
        return view('items.itemForm', ['pageTitle' => 'Change Item', 'item'=> Item::find($item), 'categories'=>Category::all()]);
    }

    public function saveItem(Request $request){
        $responce = array('result'=>-1, 'msg'=>'-');
        $path = (!empty($request->file('itemImage'))) ? $request->file('itemImage')->getRealPath() : '' ; 
        $type = (!empty($request->file('itemImage'))) ? $request->file('itemImage')->getClientMimeType() : ''; 
        $image = (!empty($path)) ? base64_encode(file_get_contents($path)) : '';
        try {
            if(!empty($request->post('itemID'))){
                $item = Item::find($request->post('itemID'));
                $item->name = $request->post('itemName');
                $item->category = $request->post('itemCat');
                if(!empty($path)) {
                    $item->picture = $image;
                    $item->picType = $type;
                }
            } else {
                $item = new Item([
                    'name'      => $request->post('itemName'), 
                    'category'  => $request->post('itemCat'), 
                    'picture'   => $image, 
                    'picType'   => $type
                ]);
            }
            $responce['result'] = $item->save();
            $responce['msg'] = ($responce['result']) ? __('Success in saving item info') : __('Error in saving item info');
        }
        catch(\Exception $exception){
            $responce['result'] = 0;
            $responce['msg'] = __('Error in saving item info') . ' - ' . $exception->getMessage();
        }
        echo(json_encode($responce));
    }

    public function deleteItem(Request $request){
        $recs = Item::where('id', $request->post('itemID'))->delete(); 
        return array('result'=>$recs, 'msg'=> ($recs>0) ? 'Success in deleting item' : 'Error in deleting item');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    public function list(Request $request,Item $item):View{
        // dd($request->brand);
        $categories=Category::all();
        // $items=Item::all();
        if (is_null($request->keyword) && is_null($request->keyword)){
            // dd($request->all());
            // $items=Item::all();
            $items=Item::Paginate(7);
        }
        if (is_null($request->keyword) && !empty($request->brand)){
            // dd($request->all());
            $items=Item::where('category_id',$request->brand)->paginate(7);
        }
        if (!empty($request->keyword) && !empty($request->brand)){
            // dd($request->all());
            $items=Item::where('product',"$request->keyword")
            ->where('category_id',$request->brand)->gpaginate(7);
        }
        if (!empty($request->keyword) && empty($request->brand) ){
            // dd($request->all());
                $items=Item::where('product',"$request->keyword")->paginate(7);
        }
        
        return view('list',['items'=>$items,'categories'=>$categories]);
    }

    public function entry():View{
        $categories=Category::all();
        return view('post.entry',['categories'=>$categories]);
    }
    public function store(Request $request){
        // dd($request->all());
 
        $request->validate([
            'product'=>'required',
            'brand_id'=>'required',
            'price'=>'required',
            'stock'=>'required'
        ],[
            'product.required'=>'商品名は必須です',
            'brand_id.required'=>'メーカー名は必須です',
            'price.required'=>'価格は必須です',
            'stock.required'=>'在庫は必須です'
        ]);
        // dd($request->all());
        $post=new Item();
        $post->product=$request->product;
        $post->category_id=$request->brand_id;
        $post->price=$request->price;
        $post->stock=$request->stock;

        if (isset($request->image_path)){
            $file_name=$request->image_path->getClientOriginalName();
            $post->image_path=$request->file('image_path')->storeAs('storage/storage/images',$file_name);
        }
        if (isset($request->comment)){
            $post->comment=$request->comment;
        }else{
            $post->comment="コメントはありません";
        }
        $post->save();

        return redirect()->route('post.list');
    }
    public function more(Item $item):View{
        return view('post.more')->with(['item'=>$item]);
    }
    public function edit(Item $item):View{
        $categories=Category::all();
        return view('post.edit')->with(['item'=>$item,'categories'=>$categories]);
    }
    public function update(Request $request, Item $item){
        // dd($request->all());
        $item->product=$request->product;
        $item->category_id=$request->brand_id;
        $item->price=$request->price;
        $item->stock=$request->stock;
        if (isset($request->image_path)){
            $file_name=$request->image_path->getClientOriginalName();
            $item->image_path=$request->file('image_path')->storeAs('storage/storage/images',$file_name);
        }
        $item->comment=$request->comment;
        $item->save();

        return redirect()->route('post.more',$item);
    }
    public function destroy(Item $item){
        $item->delete();
        return redirect()->route('post.list');
    }
}

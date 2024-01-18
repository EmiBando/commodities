<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\Company;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    public function list(Request $request,Product $product):View{
        // dd($request->company);
        $companies=Company::all();
        // $products=product::all();
        if (is_null($request->keyword) && is_null($request->keyword)){
            // dd($request->all());
            // $products=product::all();
            $products=Product::Paginate(7);
        }
        if (is_null($request->keyword) && !empty($request->company)){
            // dd($request->all());
            $products=Product::where('company_id',$request->company)->paginate(7);
        }
        if (!empty($request->keyword) && !empty($request->company)){
            // dd($request->all());
            $products=Product::where('product', 'LIKE', "%{$request->keyword}%")
            ->where('company_id',$request->company)->gpaginate(7);
        }
        if (!empty($request->keyword) && empty($request->company) ){
            // dd($request->all());
                $products=Product::where('product', 'LIKE', "%{$request->keyword}%")->paginate(7);
        }
        
        return view('list',['products'=>$products,'companies'=>$companies]);
    }

    public function entry():View{
        $companies=Company::all();
        return view('entry',['companies'=>$companies]);
    }
    public function store(Request $request){
        // dd($request->all());
        $request->validate([
            'product_name'=>'required',
            'company_id'=>'required',
            'price'=>'required',
            'stock'=>'required'
        ],[
            'product_name.required'=>'商品名は必須です',
            'company_id.required'=>'メーカー名は必須です',
            'price.required'=>'価格は必須です',
            'stock.required'=>'在庫は必須です'
        ]);
        try{
            DB::beginTransaction();

            $post=new Product();
            $post->product_name=$request->product_name;
            $post->company_id=$request->company_id;
            $post->price=$request->price;
            $post->stock=$request->stock;
           
            if (isset($request->img_path)){
                $file_name=$request->img_path->getClientOriginalName();
                $post->img_path=$request->file('img_path')->storeAs('storage/storage/images',$file_name);
            }
            if (isset($request->comment)){
                $post->comment=$request->comment;
            }else{
                $post->comment="コメントはありません";
            }
            $post->save();

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }

        return redirect()->route('list');
    }
    public function more(Product $product):View{
        return view('more')->with(['product'=>$product]);
    }
    public function edit(Product $product):View{
        $companies=Company::all();
        return view('edit')->with(['product'=>$product,'companies'=>$companies]);
    }
    public function update(Request $request, Product $product){
        // dd($request->all());

        try{
            DB::beginTransaction();

            $product->product_name=$request->product_name;
            $product->company_id=$request->company_id;
            $product->price=$request->price;
            $product->stock=$request->stock;
            if (isset($request->img_path)){
                $file_name=$request->img_path->getClientOriginalName();
                $product->img_path=$request->file('img_path')->storeAs('storage/storage/imgs',$file_name);
            }
            $product->comment=$request->comment;
            $product->save();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }
        

        return redirect()->route('more',$product);
    }
    public function destroy(Product $product){
        try{
            DB::beginTransaction();
            $product->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            return back();
        }
        return redirect()->route('list');
    }
}

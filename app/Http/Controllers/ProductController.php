<?php

namespace App\Http\Controllers;

ini_set('display_errors',1);

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
        $query = Product::query();
       

    $products = $query->sortable()->paginate(7);

    return view('list', ['products' => $products,'companies'=>$companies]);
    }
    // public function search(Request $request,Product $product){
    //     $companies=Company::all();
    //     $query = Product::query();
    //     echo "aaaaa";

        
    //     $keyword = $request->input('keyword');
    //     $company = $request->input('company');
    //     $minPrice = $request->input('minPrice');
    //     $maxPrice = $request->input('maxPrice');
    //     $minStock = $request->input('minStock');
    //     $maxStock = $request->input('maxStock');
        
    //     // dd($query);
        
    //     if($keyword != null){
    //         echo "bbb";
    //         $query->where('product_name', 'LIKE', "%{$keyword}%");
           
    //     }
    //     if ($company != null){
    //         $query->where('company_id',$request->company);
    //     }
    
    //     if($minPrice != null){
    //         $query->where('price', '>=', $minPrice);
    //     }
    
    //     if($maxPrice != null){
    //         $query->where('price', '<=', $maxPrice);
    //     }
    
    //     if($minStock != null){
    //         $query->where('stock', '>=', $minStock);
    //     }
    
    //     if($maxStock != null){
    //         $query->where('stock', '<=', $maxStock);
    //     }
        
    //     $products = $query->sortable()->paginate(7);
    //     var_dump($products);
    //     dd($products);
    //     // return view('list', ['products' => $products,'companies'=>$companies]);
    //     return response()->json(['products' => $products,'companies'=>$companies]);
    // }
    public function search(Request $request, Product $product) {
        $query = Product::query();
        
        $companies = Company::all();
        
        $keyword = $request->input('keyword');
        $company = $request->input('company');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $minStock = $request->input('minStock');
        $maxStock = $request->input('maxStock');
        
        if ($keyword != null) {
            // echo "bbb";
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        }
        
        if ($company != null) {
            
            $query->where('company_id', $company);
        }
        
        if ($minPrice != null) {
            $query->where('price', '>=', $minPrice);
        }
        
        if ($maxPrice != null) {
            $query->where('price', '<=', $maxPrice);
        }
        
        if ($minStock != null) {
            $query->where('stock', '>=', $minStock);
        }
        
        if ($maxStock != null) {
            $query->where('stock', '<=', $maxStock);
        }
        
        
        $products = $query->sortable()->paginate(7);
        return response()->json(['products' => $products]);
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
    public function destroy(Request $request){
   
        try{

            $product_id = $request->input('product_id');
    
            $product = Product::findOrFail($product_id); 
            // dd($product);
            DB::beginTransaction();
    
            $product->delete(); 
    
            DB::commit();
    
            return response()->json(['success' => true]);
        } catch(\Exception $e){
            // dd($e);
            DB::rollback();
            return response()->json(['success' => false, 'message' => '削除に失敗しました']);
        }
    }
}

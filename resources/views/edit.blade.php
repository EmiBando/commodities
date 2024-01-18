<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Commodity</title>
    <link rel="stylesheet" href="/commoditys/public/css/style.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="new-contents">
            <h1>商品情報詳細</h1>
            <div class="form_frame">
            <form method="post" action="{{route('update',$product)}}" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
                <ul>
                    <li>
                        <div>
                            <label for="id">ID</label>
                            {{$product->id}}
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="product">商品名<span>*</span></label>
                            <input type="text" name="product_name" value="{{old('product_name',$product->product_name)}}">

                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="company">メーカー名<span>*</span></label>
                              <!-- <div class="section"> -->
                                <select name="company_id">
                                  @foreach ($companies as $company)
                                    <option 
                                      value="{{$company->id}}"
                                      @selected(
                                          $company->id==old('company_id',$product->company_id)
                                      )>
                                      {{$company->company_name}}
                                    </option>
                                  @endforeach  
                                </select>
                              <!-- </div> -->
                            
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="price">価格<span>*</span></label>
                            <input type="text" name="price" value="{{old('price',$product->price)}}">
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="stock">在庫<span>*</span></label>
                            <input type="text" name="stock" value="{{old('stock',$product->stock)}}">
                        </div>
                    </li>
                    
                    
                    <li>
                        <div>
                            <label for="pic">商品画像</label>
                            <img src="{{asset($product->img_path)}}">
                            <input type="file" name="img_path">
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="comment">コメント</label>
                            <input type="text" name="comment" value="{{old('comment',$product->comment)}}">
                        </div>
                    </li>
                </ul>
                <div class="btn-section">
                    <button class="update-btn">更新</button>
                
                    <button type="button" onclick="history.back()" class="return-btn">戻る</button>
                </div>
            </form>
            </div>
            
        </div>
    </div>
</body>
</html> 

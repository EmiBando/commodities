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
            <form method="post" action="{{route('post.update',$item)}}" enctype="multipart/form-data">
              @method('PATCH')
              @csrf
                <ul>
                    <li>
                        <div>
                            <label for="product">商品名<span>*</span></label>
                            <input type="text" name="product" value="{{old('product',$item->product)}}">

                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="brand">メーカー名<span>*</span></label>
                              <!-- <div class="section"> -->
                                <select name="brand_id">
                                  @foreach ($categories as $category)
                                    <option 
                                      value="{{$category->id}}"
                                      @selected(
                                          $category->id==old('category_id',$item->category_id)
                                      )>
                                      {{$category->brand}}
                                    </option>
                                  @endforeach  
                                </select>
                              <!-- </div> -->
                            
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="price">価格<span>*</span></label>
                            <input type="text" name="price" value="{{old('price',$item->price)}}">
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="stock">在庫<span>*</span></label>
                            <input type="text" name="stock" value="{{old('stock',$item->stock)}}">
                        </div>
                    </li>
                    
                    
                    <li>
                        <div>
                            <label for="pic">商品画像</label>
                            <img src="{{asset($item->image_path)}}">
                            <input type="file" name="image_path">
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="comment">コメント</label>
                            <input type="text" name="comment" value="{{old('comment',$item->comment)}}">
                        </div>
                    </li>
                </ul>
                <div class="btn-section">
                    <button class="update-btn">編集</button>
                
                    <button type="button" onclick="history.back()" class="return-btn">戻る</button>
                </div>
            </form>
            </div>
            
        </div>
    </div>
</body>
</html> 

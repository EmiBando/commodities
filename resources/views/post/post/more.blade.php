<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Commodity</title>
    <link rel="stylesheet" href="../../../public/css/style.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="new-contents">
            <h1>商品情報詳細</h1>
            <div class="form_frame">
                @csrf
                <ul>
                    <li>
                        <div>
                            <label for="product">商品名</label>
                            <div class="section">
                                {{$item->product}}
                            </div> 
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="brand">メーカー名</label>
                            <div class="section">
                                {{$item->category->brand}}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="price">価格<span>*</span></label>
                            <div class="section">
                                {{$item->price}}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="stock">在庫<span>*</span></label>
                            <div class="section">
                                {{$item->stock}}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="pic">商品画像</label>
                            <img src="{{asset($item->image_path)}}">
                        </div>
                    </li>
                    <li>
                        <div>
                            <label for="comment">コメント</label>
                            <div class="section">
                                {{$item->comment}}
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="btn-section">
                    <button class="update-btn" onclick="location.href='{{route('post.edit',$item)}}'">編集</button>
                
                    <button type="button" onclick="location.href='{{route('post.list',$item)}}'" class="return-btn">戻る</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 

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
            <h1>商品新規登録画面</h1>
            <div class="form_frame">
                <form method="post" id="newForm" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                    <ul>
                        <li>
                            <div>
                            <label for="product">商品名<span>*</span></label>
                            <input type="text" id="product" name="product_name" value="{{old('product_name')}}">
                            @error('product')
                                <div class="error">{{$message}}</div>
                            @enderror
                            </div>
                        </li>
                        <li>
                            <div>
                                <label for="companySelect">メーカー名<span>*</span></label>
                                <select id="companySelect" name="company_id">
                                    <option velue="" selected disabled >メーカー名</option>
                                    @foreach ($companies as $company)
                                        <option value="{{$company->id}}">{{$company->company_name}}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <div class="error">{{$message}}</div>
                                @enderror
                               <!-- <div id="selectErrorMessage"></div> -->
                            </div>
                        </li>
                        <li>
                            <div>
                            <label for="price">価格<span>*</span></label>
                            <input type="number" id="price" name="price" value="{{old('price')}}">
                            @error('price')
                                <div class="error">{{$message}}</div>
                            @enderror
                            </div>
                        </li>
                        <li>
                            <div>
                            <label for="stock">在庫<span>*</span></label>
                            <input type="number" id="stock" name="stock" value="{{old('stock')}}">
                            @error('stock')
                                <div class="error">{{$message}}</div>
                            @enderror
                            </div>
                        </li>
                        
                        <li>
                            <div>
                            <label for="pic">商品画像</label>
                            <input type="file" id="pic" name="img_path" value="{{old('img_path')}}">
                            </div>
                        </li>
                        <li>
                            <div>
                            <label for="comment">コメント</label>
                            <textarea id="comment" name="comment" value="{{old('comment')}}"></textarea>
                        
                            </div>
                        </li>
                    </ul>
                    <div class="btn-section">
                        <button type="submit" class="entry-btn" >新規登録</button>
                    
                        <button type="button" onclick="location.href='{{route('post.list')}}'" class="return-btn">戻る</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
    <!-- <script src="{{'../../../resources/js/main.js'}}"></script>  -->
</body>
</html> 


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Commodity</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ asset('js/asynchronous.js') }}" defer></script>
    
    
 </head>
<body>
<div id="homeUrl" data-url="{{ url('/') }}"></div>                
    <div class="container">
        <div class="contents">
            <div class="contents_header">
                <h1 class="list_h1">商品一覧画面</h1>
                <div class="header_btn">
                    <button class="logout_btn" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">ログアウト</button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
              
            </div>
            <!-- <form method="get" action="{{route('list')}}" >
                @csrf -->
                <div id="myCompany" data-company="{{$companies}}"></div>
                <div class="search">
                    <input type="text" name="keyword" id="keyword" placeholder="検索キーワード">
                    <select id="company" name="company">
                        <option velue="" selected disabled>メーカー名</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}" >{{$company->company_name}}</option>
                        @endforeach
                    </select>
                    <div>
                    <input type="number" name="min_price" id="minPrice" data-id="minmax" placeholder="最低価格" value="{{ request('min_price') }}">
                    <input type="number" name="max_price" id="maxPrice" data-id="minmax" placeholder="最高価格" value="{{ request('max_price') }}">
                  
                    <input type="number" name="min_stock" id="minStock" data-id="minmax" placeholder="最低在庫数">
                    <input type="number" name="max_stock" id="maxStock" data-id="minmax" placeholder="最高在庫数">
                    </div>
                    
                    <button class="search-btn">検索</button>
                    <button class="reset-btn">リセット</button>
                
                </div>
            <!-- </form> -->
            
            <div class="lists" id="lists">
                <table>
                    <thead>
                        <tr>
                            <th>id @sortablelink('id','▼')</th>
                            <th>商品画像</th>
                            <th>商品名@sortablelink('product_name','▼')</th>
                            <th>価格@sortablelink('price','▼')</th>
                            <th>在庫数@sortablelink('stock','▼')</th>
                            <th>メーカー名@sortablelink('company_id','▼')</th>
                            <th>
                                <button class="entry-btn" onclick="location.href='{{route('entry')}}'">新規登録</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="search-result">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{asset($product->img_path)}}"></td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}円</td>
                                <td>{{$product->stock}}</td>
                                <td>{{$product->company->company_name}}</td>
                                <td>
                                    <button class="more-btn"  onclick="location.href='{{route('more',$product)}}'">詳細</button>
                                    
                                    <button class="delete-btn" data-product_id="{{$product->id}}">削除</button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$products->appends(request()->query())->links('pagination::bootstrap-4')}}
    <script src="{{'../resources/js/main.js'}}"></script> 
</body>
</html> 


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Commodity</title>
    <link rel="stylesheet" href="css/style.css">
 </head>
<body>
                    
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
            <form method="get" action="{{route('list')}}" >
                @csrf
                <div class="sarch">
                    <input type="text" name="keyword" " placeholder="検索キーワード">
                    <select id="company" name="company">
                        <option velue="" selected disabled>メーカー名</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                    <button class="sarch-btn">検索</button>
                </div>
            </form>
            
            <div class="lists">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>商品画像</th>
                            <th>商品名</th>
                            <th>価格</th>
                            <th>在庫数</th>
                            <th>メーカー名</th>
                            <th>
                                <button class="entry-btn" onclick="location.href='{{route('entry')}}'">新規登録</button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td><img src="{{asset($product->img_path)}}"></td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}円</td>
                                <td>{{$product->stock}}</td>
                                <td>{{$product->company->company_name}}</td>
                                <td>
                                    <button class="more-btn" onclick="location.href='{{route('more',$product)}}'">詳細</button>
                                    <form method="post" action="{{route('destroy',$product)}}" class="delete_post" >
                                        @method('DELETE')
                                        @csrf
                                        <button class="delete-btn" >削除</button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{$products->links('pagination::bootstrap-4')}}
    <script src="{{'../resources/js/main.js'}}"></script> 
</body>
</html> 


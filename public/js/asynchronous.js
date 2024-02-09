
let name_store;
let company_store;
let minPrice_store;
let maxPrice_store;
let minStock_store;
let maxStock_store;

$(function() {
    
    $('.reset-btn').click(function() {
        console.log('reset-btn');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'reset'         
            })
            .done(function() {
                console.log('リセット通信成功');
                location.reload();
            })
            .fail(function() {
                console.log('リセット通信後失敗');
                
            });
    });

   function deleteEvent() {
   
        console.log('deleteEvent');
        $('.delete-btn').click(function() {
            console.log('delete-btn');
            let deleteConfirm = confirm('削除してよろしいでしょうか？');
            if(deleteConfirm == true) {
                console.log('削除非同期開始');
              
                let clickEle = $(this);
                let product_id = clickEle.attr('data-product_id');
                console.log(product_id);
                let deleteTarget = clickEle.closest('tr');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'destroy',
                    dataType: 'json',
                    data: {product_id: product_id}
                          
                })//通信が成功した時の処理
                .done(function() {
                    console.log('削除通信成功');
                   
                    deleteTarget.remove();
                  
                })
                .fail(function() {
                    console.log('通信後失敗');
                    
                });
            };
        });
    };
    
    deleteEvent();

    $('.search-btn').click(function(event) {

        let product_name = $('#keyword').val();
        let company = $('#company').val();
        let minPrice = $('#minPrice').val();
        let maxPrice = $('#maxPrice').val();
        let minStock = $('#minStock').val();
        let maxStock = $('#maxStock').val();

        name_store=$('#keyword').val();
        company_store=company;
        minPrice_store=minPrice;
        maxPrice_store=maxPrice;
        minStock_store=minStock;
        maxStock_store=maxStock;
        console.log(company_store);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'search',
            type: 'GET',
            dataType: 'json',
            data: {
                keyword: product_name,
                company: company,
                minPrice: minPrice,
                maxPrice: maxPrice,
                minStock: minStock,
                maxStock: maxStock
            }
        }).done(function(data){
            /* 通信成功時 */
            console.log('成功');
            console.log(data.products.data); 
            let $result = $('#search-result');
            $result.empty(); //結果を一度クリア
            
           

            $.each(data.products.data, function(index, product) {
                let homeUrl = document.getElementById('homeUrl').getAttribute('data-url');
                let imageUrl = homeUrl + product.img_path;
                // console.log(homeUrl);
                let moreUrl = homeUrl + '/' + product.id + '/' + 'more';
                let companies_data=$('#myCompany').data('company');
                // console.log(companies_data);
                let company_id=product.company_id - 1;
                // console.log(company_id);
                let company=companies_data[company_id];
                // console.log(company); 
                let company_name=company['company_name'];
                // console.log(company_name);
                
                let html = `
                    <tr>
                        <td>${product.id}</td>
                        <td><img src="${imageUrl}"></td>
                        <td>${product.product_name}</td>
                        <td>${product.price}円</td>
                        <td>${product.stock}</td>
                        <td>${company_name}</td>
                        <td>
                            <button class="more-btn" onclick="location.href='${moreUrl}'">詳細</button>
                            <button class="delete-btn" data-product_id="${product.id}">削除</button>
                        </td>
                    </tr>
                `;
                $result.append(html);
               
   
            });
            deleteEvent();
        }).fail(function(data){
            /* 通信失敗時 */
            console.log('失敗');
            console.log(data);
        });
    });
});
// console.log(name_store);
// $(document).on('click', 'th a', function(e) {
//     console.log("ソート");
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: 'search',
//         type: 'GET',
//         dataType: 'json',
//         data: {
//             name_store: product_name,
//             company_store: company,
//             minPrice_store: minPrice,
//             maxPrice_store: maxPrice,
//             minStock_store: minStock,
//             maxStock_store: maxStock
//         }
              
//     })//通信が成功した時の処理
//     .done(function(data) {
//         console.log('ソート成功');
//         console.log(data);
//         $result.empty(); //結果を一度クリア

//         $.each(data.products.data, function(index, product) {
//             let homeUrl = document.getElementById('homeUrl').getAttribute('data-url');
//             let imageUrl = homeUrl + product.img_path;
//             // console.log(homeUrl);
//             let moreUrl = homeUrl + '/' + product.id + '/' + 'more';
//             let companies_data=$('#myCompany').data('company');
//             // console.log(companies_data);
//             let company_id=product.company_id - 1;
//             // console.log(company_id);
//             let company=companies_data[company_id];
//             // console.log(company); 
//             let company_name=company['company_name'];
//             // console.log(company_name);
            
//             let html = `
//                 <tr>
//                     <td>${product.id}</td>
//                     <td><img src="${imageUrl}"></td>
//                     <td>${product.product_name}</td>
//                     <td>${product.price}円</td>
//                     <td>${product.stock}</td>
//                     <td>${company_name}</td>
//                     <td>
//                         <button class="more-btn" onclick="location.href='${moreUrl}'">詳細</button>
//                         <button class="delete-btn" data-product_id="${product.id}">削除</button>
//                     </td>
//                 </tr>
//             `;
//             $result.append(html);
//         })
//     }).fail(function(data) {
//         console.log('ソート失敗');
//         console.log(data);
//     });    
// });

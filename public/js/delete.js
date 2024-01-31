// $(function() {
//   $('.delete-btn').click(function(event) {
//     var deleteConfirm = confirm('削除してよろしいでしょうか？');
//     if(deleteConfirm == true) {
//         console.log('削除非同期開始');
//         var clickEle = $(this);
//         var product = clickEle.attr('data-product_id');
//     }
//       $.ajax({
//           headers: {
//               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//           },
//           url: 'destroy',
//           type: 'GET',
//           dataType: 'json',
//           data: {'product': product}

//       }).done(function(data){
//           /* 通信成功時 */
//           console.log('成功');
//           console.log(data.products); 
 
          
//       }).fail(function(data){
//           /* 通信失敗時 */
//           console.log('失敗');
//           console.log(data);
//       })
//   });
  
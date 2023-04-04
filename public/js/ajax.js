// $(function() {
//   alert("jQueryが正常に動作しています！");
// });


window.onload = function () {
  $('button').on('click',function(){
    
    const searchWord = $('#search').val(); //検索ワードを取得
    const searchUpper = $('#upper').val();
    const searchLower = $('#lower').val();
    const stockUpper = $('#stockUpper').val();
    const stockLower = $('#stockLower').val();
    
    $.ajax({
      type: 'GET',
      url: '/testapp/public/search' , //送りたいURL。ここのアクションが呼び出される
        data: {
          'search': searchWord, 
          'upper': searchUpper, 
          'lower': searchLower, 
          'stockUpper': stockUpper, 
          'stockLower': stockLower, 
        },
      dataType: 'json', //json形式で受け取る
      timeout: 3000,
      
      
    }).done(function (data) { //ajaxが成功したときの処理
      // console.log(data);  
      
            if (data.length === 0){//もし何もなければ
              // $('#index').after('<p class="text-center mt-5 search-null">検索結果はありません</p>');
              alert("検索しましたがヒットしませんでした。");
            }else{

              $('#index').empty(); 
              
              let html = '';
              $.each(data,function(index,value){
                let id = value.id;
                let product_name = value.product_name;
                let price = value.price;
                let stock = value.stock;
                html = `
                <tr class="product-list">
                <td class="col-xs-3">${id}</td>
                <td class="col-xs-3"><a href="product/${id}">${product_name}</a></td> 
                <td class="col-xs-3">¥${price}</td>
                <td class="col-xs-3">${stock}個</td>
                </tr>
                `;
                $('#index').append(html);
              });
            }
      

      
    }).fail(function(jqXHR,textStatus,errorThrown){
      alert('ファイルの取得に失敗しました。');
      console.log("ajax通信に失敗しました")
      console.log(jqXHR.status);
      console.log(textStatus);
      console.log(errorThrown);
    })
  })



//＝＝＝＝＝ソート機能のクリックイベント＝＝＝＝＝＝

//＝＝＝idのソート機能＝＝＝
$(function(){
  let count = 0;
  $('#id').on('click',function(){  //クリック数をカウント
    count++;

      if ((count) % 2 == 0){  //もしクリック数が偶数回ならば
        // console.log("偶数回");
        var $arr = $('#index tr').sort(function(a, b){
          return ($(a).text() > $(b).text() ? 1 : -1);  //ソート条件
        });
        //ソートした結果をコンソールに出力する
        $arr.each(function(){
          $('#index').append($arr);
        });
        
      }else{ //クリック数が奇数回ならば
        // console.log("奇数回");
        var $arr = $('#index tr').sort(function(a, b){
          return ($(a).text() < $(b).text() ? 1 : -1);  //ソート条件
        })
        //ソートした結果をコンソールに出力する
        $arr.each(function(){
          $('#index').append($arr);
        })
      }

  })
});
//＝＝＝idのソート機能＝＝＝

//＝＝＝商品名のソート機能＝＝＝
$(function(){
  let count = 0;
  $('#product_name').on('click',function(){  //クリック数をカウント
    count++;

      if ((count) % 2 == 0){  //もしクリック数が偶数回ならば
        // console.log("偶数回");
        var $arr = $('#index tr').sort(function(a, b){
          return ($(a).text() > $(b).text() ? 1 : -1);  //ソート条件
        });
        //ソートした結果をコンソールに出力する
        $arr.each(function(){
          $('#index').append($arr);
        });
        
      }else{ //クリック数が奇数回ならば
        // console.log("奇数回");
        var $arr = $('#index tr').sort(function(a, b){
          return ($(a).text() < $(b).text() ? 1 : -1);  //ソート条件
        })
        //ソートした結果をコンソールに出力する
        $arr.each(function(){
          $('#index').append($arr);
        })
      }

  })
});
//＝＝＝idのソート機能＝＝＝
  
  
};


// ===ボタンを分けてソートする場合===
  // $('#id-down').on('click',function(){
  // var $arr = $('#index tr').sort(function(a, b){
  //     return ($(a).text() < $(b).text() ? 1 : -1);  //id-downをクリックした場合
  //   });
    
  //   //ソートした結果をコンソールに出力する
  //   $arr.each(function(){
  //     $('#index').append($arr);
  //     // console.log($arr);
  //   });
  // })

  // //ソート機能のクリックイベント
  // $('#id-up').on('click',function(){
  // var $arr = $('#index tr').sort(function(a, b){
  //     return ($(a).text() > $(b).text() ? 1 : -1);  //id-upをクリックした場合
  //   });
    
  //   //ソートした結果をコンソールに出力する
  //   $arr.each(function(){
  //     $('#index').append($arr);
  //     // console.log($arr);
  //   });
  // })
// ===============



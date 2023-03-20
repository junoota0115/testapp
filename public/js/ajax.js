// $(function() {
//   alert("jQueryが正常に動作しています！");
// });


window.onload = function () {
  $('button').on('click',function(){
    
    let searchWord = $('#search').val(); //検索ワードを取得
    console.log(searchWord);
    if (!searchWord) {
      return false;
    } //検索ワードが空の時、ここで処理を止める
    
    $.ajax({
      type: 'GET',
      url: '/testapp/public/search' , //ここのURLの意味がわからない
        data: {
          'search': searchWord, //この書き方でsearchWordが送られているのか？
        },
      dataType: 'json', //json形式で受け取る
      timeout: 3000,
      
      
    }).done(function (data) { //ajaxが成功したときの処理
      console.log(data);
      $('#index').empty(); 

      let html = '';
      $.each(data,function(index,value){
        let id = value.id;
        let product_name = value.product_name;
        let price = value.price;
        html = `
        <tr class="product-list">
        <td class="col-xs-3">${id}</td>
        <td class="col-xs-3">${product_name}</a></td>
        <td class="col-xs-3">${price}</td>
        </tr>
        `;
        $('#index').append(html);
      });

      if (data.length === 0){//もし何もなければ
        $('#index').after('<p class="text-center mt-5 search-null">検索結果はありません</p>');
      }
      

      
    }).fail(function(jqXHR,textStatus,errorThrown){
      alert('ファイルの取得に失敗しました。');
      console.log("ajax通信に失敗しました")
      // console.log(jqXHR.status);
      // console.log(textStatus);
      // console.log(errorThrown);
    })
  })
  }
  


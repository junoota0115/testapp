
window.onload = function () {
  $('.btn .button').on('click',function(){
    
    $('#index').empty(); 
    // $('.table tbody').empty(); //もともとある要素を空にする $('').empty();
    // $('.search-null').remove(); //検索結果が0のときのテキストを消す$('').remove();
    
    let searchWord = $('#search').val(); //検索ワードを取得
    
    
    if (!searchWord) {
      return false;
    } //検索ワードが空の時、ここで処理を止めて何もビューに出さない
    
    $.ajax({
      type: 'GET',
      url: '/' , //web.phpのURLと同じ
      data: {
        'search': searchWord, //ここはサーバーに贈りたい検索ファームのバリュー。
      },
      dataType: 'json', //json形式で受け取る
      timeout: 3000,
      
      beforeSend: function () {
        $('.loading').removeClass('display-none');
      } //通信中の処理をここで記載。
      
    }).done(function (data) { //ajaxが成功したときの処理
      console.log(data);
      $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
      
      let html = '';
      $.each(data, function (index, value) { //dataの中身からvalueを取り出す
        let id = value.id;
        let product_name = value.product_name;
        let price = value.price;
        
        html = `
        <tr class="product-list">
        <td class="col-xs-3">${product_name}</td>
        <td class="col-xs-2">${price}</td>
        <td class="col-xs-5"><a class="btn btn-info" href="/product/${id}">詳細</a></td>
        </tr>
        `
      })
      $('.table tbody').append(html); //できあがったテンプレートをビューに追加
      // 検索結果がなかったときの処理
      if (data.length === 0) {
        $('.index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
      }
      
    }).fail(function(jqXHR,textStatus,errorThrown){
      alert('ファイルの取得に失敗しました。');
      console.log("ajax通信に失敗しました")
      console.log(jqXHR.status);
      console.log(textStatus);
      console.log(errorThrown);
    })
  })
  }


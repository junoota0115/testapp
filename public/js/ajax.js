window.onload = function () {
  const searchBtn = document.getElementById('submit');
  searchBtn.addEventListener('click',function(){

    // $('.table tbody').empty(); //もともとある要素を空にする $('').empty();
    // $('.search-null').remove(); //検索結果が0のときのテキストを消す$('').remove();
    
    const searchWord = $('#search[name=search]').val(); //検索ワードを取得
    console.log(searchWord);
    
    if (!searchWord) {
      return false;
    } //ガード節で検索ワードが空の時、ここで処理を止めて何もビューに出さない
    
    console.log("成功");
    $.ajax({
      type: 'GET',
      url: '/product/index/' , //後述するweb.phpのURLと同じ形にする
      data: {
        'search': searchWord, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
      },
      dataType: 'json', //json形式で受け取る
      timeout: 3000,
      
      beforeSend: function () {
        $('.loading').removeClass('display-none');
      } //通信中の処理をここで記載。今回はぐるぐるさせるためにcssでスタイルを消す。
      
    }).done(function (data) { //ajaxが成功したときの処理
      $('.loading').addClass('display-none'); //通信中のぐるぐるを消す
      
      let html = '';
      $.each(data, function (index, value) { //dataの中身からvalueを取り出す
        //ここの記述はリファクタ可能
        let id = value.id;
        let product_name = value.product_name;
        let price = value.price;
        // １ユーザー情報のビューテンプレートを作成
        html = `
        <tr class="product-list">
        <td class="col-xs-3">${product_name}</td>
        <td class="col-xs-2">${price}</td>
        <td class="col-xs-5"><a class="btn btn-info" href="/product/${id}">詳細</a></td>
        </tr>
        `
      })
      $('.user-table tbody').append(html); //できあがったテンプレートをビューに追加
      // 検索結果がなかったときの処理
      if (data.length === 0) {
        $('.user-index-wrapper').after('<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>');
      }
      
    }).fail(function () {
      //ajax通信がエラーのときの処理
      alert('通信エラー！');
    })
  })
}
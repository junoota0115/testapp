//=====削除機能=====
$(function(){
  $('.btn-danger').on('click',function(){
    // console.log("押しました");

    var deleteConfirm = confirm('本当に削除しますか??');
    if(deleteConfirm == true){
      var clickDel = $(this)
      var productID = clickDel.attr('product_id');
      // console.log(productID);
    
    $.ajax({
      url:'/testapp/product/delete/'+productID,
      type:'POST',
      data:{'id':productID,
      '_method':'DELETE'}
    })

.done(function(){
  clickDel.parents('tr').remove();
})

.fail(function(){
  alert('エラーです');
});

    }else{
(function(e){
  e.preventDefault()
});
    };
  });
});
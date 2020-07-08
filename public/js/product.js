$(document).ready(function(){

    $(".editProductBtn").on("click" , function(e){
        e.preventDefault();

        var top = $(this).offset().top;

        $.ajax({
           type:'POST',
           url:'/showProduct',
           data:{id: $(this).attr('id') } ,

           success:function(data){
              $("#idProd").val(data.product.id);
              $("#idProd_D").val(data.product.id);
              $("#E_Name_P").val(data.product.name);
              $("#E_Price_P").val(data.product.price);
              $("#E_Quan_P").val(data.product.quantity);
              $("#E_cate_P").val(data.category.name);

              var options = '';
              for(var i in data.categories){
                options+= '<option>'+data.categories[i]['name']+'</option>';
              }
              $("#categories_P").html(options);

              $('.EditProdForm').css({"top" : top/2 });
              $('.EditProdForm').fadeIn("slow");
           }
        });

    });


    $('.EditProdForm .CloseFormBtn').on('click' , function(){
        $(".EditProdForm").fadeOut("slow");
    });

});

// function to confirm if user want to delete the product.
function confirmDel(){
    var q = confirm("Are you sure you want to delete ?");
    if (q) {

        $.ajax({
            type:'POST',
            url:'/REMproduct',
            data:{idProd: $("#idProd").val() } ,

            success:function(data){
               window.location.reload();
            }
         });
    }
}

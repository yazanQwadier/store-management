$(document).ready(function(){

    $(".editProductBtn").on("click" , function(e){
        e.preventDefault();

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

              $('.EditProdForm').show("slow");
           }
        });

    });


    $('.EditProdForm .CloseFormBtn').on('click' , function(){
        $(this).parent().hide("slow");
    });

});

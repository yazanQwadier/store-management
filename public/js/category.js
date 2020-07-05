$(document).ready(function(){

    $(".editCategoryBtn").on("click" , function(e){
        e.preventDefault();

        $.ajax({
           type:'POST',
           url:'/showCategory',
           data:{id: $(this).attr('id') } ,

           success:function(data){
              $("#E_Name_C").val(data.cate_info['name']);
              $("#E_Desc_C").val(data.cate_info['description']);
              $("#idCate").val(data.cate_info['id']);
              $('.CloseFormBtn').parent().show("slow");
              $("#countP").html(data.count);
           }
        });

    });


    $('.CloseFormBtn').on('click' , function(){
        $(this).parent().hide("slow");
    });

});

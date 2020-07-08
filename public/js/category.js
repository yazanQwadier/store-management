$(document).ready(function(){

    $(".editCategoryBtn").on("click" , function(e){
        e.preventDefault();

        var top = $(this).offset().top;
        $.ajax({
           type:'POST',
           url:'/showCategory',
           data:{id: $(this).attr('id') } ,

           success:function(data){
              $("#idCate").val(data.cate_info['id']);
              $("#E_Name_C").val(data.cate_info['name']);
              $("#E_Desc_C").val(data.cate_info['description']);
              $("#countP").html(data.count);

              $('.EditCateForm').css({"top" : top/2 });
              $('.EditCateForm').fadeIn("slow");
           }
        });

    });


    $('.CloseFormBtn').on('click' , function(){
        $(".EditCateForm").fadeOut("slow");
    });

});

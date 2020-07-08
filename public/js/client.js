$(document).ready(function(){

    $(".editClientBtn").on("click" , function(e){
        e.preventDefault();

        var top = $(this).offset().top;

        $.ajax({
           type:'POST',
           url:'/showClient',
           data:{id: $(this).attr('id') } ,

           success:function(data){
              $("#idClient").val(data.client.id);
              $("#E_Name_C").val(data.client.name);
              $("#E_Phone_C").val(data.client.phone);
              $("#E_Section_C").val(data.client.section);

              $('.EditClientForm').css({"top" : top/2 });
              $('.EditClientForm').fadeIn("slow");
           }
        });

    });


    $('.CloseFormBtn').on('click' , function(){
        $('.EditClientForm').fadeOut('slow');
    });

});


// function to confirm if user want to delete the product.
function confirmDel(){
    var q = confirm("Are you sure you want to delete ?");
    if (q) {

        $.ajax({
            type:'POST',
            url:'/REMclient',
            data:{idClient: $("#idClient").val() } ,

            success:function(data){
               window.location.reload();
            }
         });
    }
}

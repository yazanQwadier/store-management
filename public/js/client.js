$(document).ready(function(){

    $(".editClientBtn").on("click" , function(e){
        e.preventDefault();

        $.ajax({
           type:'POST',
           url:'/showClient',
           data:{id: $(this).attr('id') } ,

           success:function(data){
              $("#idClient").val(data.client.id);
              $("#E_Name_C").val(data.client.name);
              $("#E_Phone_C").val(data.client.phone);
              $("#E_Section_C").val(data.client.section);
              $('.EditClientForm').show("slow");
           }
        });

    });


    $('.CloseFormBtn').on('click' , function(){
        $('.EditClientForm').hide('slow');
    });

});

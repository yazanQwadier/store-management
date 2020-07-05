$(document).ready(function(){

    // just for setup ajax operations
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#toggleForm").on("click" , function(){
        var c = parseInt( $(this).attr("data-forms") ) + 1;

        if(c > 3){
            $(this).attr("disabled" , true);
            alert("you can\'t add more than three items ! ");
        }
        else if(c < 1){
            alert("you can\'t adding nothing !");
        }
        else{
            $(this).attr("data-forms" , c);
            $(this).attr("disabled" , false);
            showForm( c );
        }
    });


    $("body").on("click" , "#closeForm" , function(){
        var c = parseInt( $("#toggleForm").attr("data-forms") );
        if( c == 1 ){
            alert("you can't close all forms !");
        }
        else {
            $(".formP"+c).slideUp("slow");
            $("#toggleForm").attr("data-forms" , c - 1);
            $("#toggleForm").attr("disabled" , false);
            $("#countForms").val( parseInt($("#countForms").val()) - 1 );
        }
    });

});


function showForm( n ){
    $( ".formP"+n ).slideDown("slow");
    $("#countForms").val( parseInt( $("#countForms").val() ) + 1 );
}


function goTo(target){
    window.location.href = window.location.href.replace("home" , target);
}

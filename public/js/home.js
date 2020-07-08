$(document).ready(function(){

    // just for setup ajax operations
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // when click on (+) button for add new form
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

    // when click on (X) button to close specific form
    $("body").on("click" , "#closeForm" , function(){
        var c = parseInt( $("#toggleForm").attr("data-forms") );
        if( c == 1 ){
            alert("you can't close all forms !");
        }
        else {
            $( ".formP"+(c-1) ).animate({width:'100%' ,opacity:'1' ,marginLeft:'0%'} , "slow");
            $('.wrapperP').addClass('d-none');  // hide the wrapper

            $(".formP"+c).slideUp("slow");
            $("#toggleForm").attr("data-forms" , c - 1);
            $("#toggleForm").attr("disabled" , false);
            $("#countForms").val( parseInt($("#countForms").val()) - 1 );
        }
    });

});

// function to show specific form
function showForm( n ){
    // create wrapper layout (contain name of product)
    var x = '<div class="wrapperP"> Product '+ (n - 1) + '</div>';
    $( ".formP"+(n-1) ).append(x);

    // show the wrapper
    $( ".formP"+(n-1) ).animate({width:'50%' , opacity:'0.5' , marginLeft:'25%'} , "slow");

    $( ".formP"+n ).slideDown("slow");
    $("#countForms").val( parseInt( $("#countForms").val() ) + 1 );
}

// function to go to specific page
function goTo(target){
    window.location.href = window.location.href.replace("home" , target);
}

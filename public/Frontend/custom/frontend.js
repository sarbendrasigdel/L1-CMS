$('document').ready(function (){

$('.mil-main-menu a').on('click',function(e){
    e.preventDefault();
    $('.mil-has-children').removeClass('mil-active');
    $(this).parent().addClass('mil-active');
});



});
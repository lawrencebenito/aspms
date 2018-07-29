$(document).ready(function(){
    $(".show-add-form").click(function(){
        $(".source").fadeOut(500);
        $(".add-form").show(2000);
    });
    $(".show-add-form-wc").click(function(){
        $(".add-form").show(2000);
    });

    $(".close-add-form").click(function(){
        $(".add-form").slideUp(500);
        $(".source").slideDown(1500);
    });
});
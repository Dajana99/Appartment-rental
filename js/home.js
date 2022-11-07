$(".link").click(function(){
    $(".link").removeClass("active");
    $(event.target).addClass("active");
    if(event.target.id == 1){
        $(".house").parent().fadeOut();
        $(".appartment").parent().fadeIn();
    }
    if(event.target.id == 0){
        $(".house").parent().fadeIn();
        $(".appartment").parent().fadeOut();
    }
})
$("#search_btn").click(function(){
    $("#search_form").submit();
})
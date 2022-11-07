

$(".filter-option").click(function(){
    $(".filter-option").removeClass("active");
    let element = $(event.target).parent();
    let element_id = $(element).attr('id')
    console.log(element_id)
    if($(element).hasClass('active')){
        $(element).removeClass('active')
        hide = 0;
    }
    else{
        $(element).addClass('active')
        hide = 1
    }
    let offers = $(".home-offer")
    $(".home-offer").show();
    for(let i = 0; i < offers.length; i++){
        if($(offers[i]).css("display") != 'none'){
            if(element_id == "smoking" && hide){
                $(".smoking").parent().hide();
            }
            if(element_id == "internet" && hide){
                $(".internet").parent().hide();
            }
            if(element_id == "parking" && hide){
                $(".parking").parent().hide();
            }
        }
    }
})
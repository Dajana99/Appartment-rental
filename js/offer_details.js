let imgIndex = 0;
let images = [];
$(document).ready(function(){
    images = $(".gallery-image");
    $(images[imgIndex]).fadeIn();
})
$("#gallery-prev").click(function(){
    let temp = imgIndex;
    imgIndex--;
    if(imgIndex < 0){
        imgIndex = images.length-1;
    }
    $(images[temp]).hide();
    $(images[imgIndex]).show();
})
$("#gallery-next").click(function(){
    let temp = imgIndex;
    imgIndex++;
    if(imgIndex == images.length){
        imgIndex = 0;
    }
    $(images[temp]).hide();
    $(images[imgIndex]).show();
})
$("#start-date").change(function(){
    $("#date-error1").hide();
    $("#modal-btn").show();
    let start_date = new Date($("#start-date").val());
    if(start_date < Date.now()){
        $("#date-error1").show();
        $("#modal-btn").hide();

    }
})
$("#end-date").change(function(){
   
    $("#modal-btn").show();
    $("#reservation-error").hide();
    console.log($("#start-date").val());
    console.log($("#end-date").val());
    let start_date = new Date($("#start-date").val());
    let end_date = new Date($("#end-date").val());
    $("#date-error2").hide();
    if(start_date > end_date){
        $("#date-error2").show();
        $("#modal-btn").hide();
    }
    let time_diff = end_date.getTime() - start_date.getTime();
    let day_diff =  time_diff / (1000 * 3600 * 24);
    let offer_id = $("#offer_id").val(); 
    console.log(day_diff);
    let offer_price =$("#offer-price").text()
    console.log(offer_price);
    $(".payment-method").fadeIn();
    let data = {
        'offer_id' : offer_id,
        'get_dates' : 1
    };
    console.log(data)
    $.ajax({
        method:'post',
        url:'index.php',
        data:data,
        success:function(response){
            let response_data = JSON.parse(response)
            console.log(response_data)
            for(let i = 0; i < response_data.length; i++){
                let start_date_db = new Date(response_data[i].start_date);
                let end_date_db = new Date(response_data[i].end_date);
                if((start_date <= end_date_db) && (start_date_db <= end_date)) {
                    $("#reservation-error").show();
                    $("#modal-btn").hide();
                    break;
                }
            }
        }
    })
    $("#price-modal").text("Cena: " + day_diff * offer_price + ".00 rsd ( " + day_diff + " dana * " + offer_price + ".00 rsd)")
})
$("#cash").click(function(){
    $(".card-info").fadeOut();
})
$("#card").click(function(){
    $(".card-info").fadeIn();
})

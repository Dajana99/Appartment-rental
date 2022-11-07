$(".image-upload").change(function(){
    let element = $(event.target);
    let label = $("label[for = " + $(element).attr("id") + "]");
    let filename = $(element)[0].files.length ? $(element)[0].files[0].name : ""
    $(label).text(filename)
    $(element).css("background-color",'#FE881C')
})
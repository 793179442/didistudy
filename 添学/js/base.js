function leftcolumn()
{
    $(".left-hide-column-bg").toggle();
    $(".left-hide-column").animate({left:'0px'},50);
}

$(".left-hide-column-bg").on("click",function(){
    $(".left-hide-column-bg").toggle();
    $(".left-hide-column").animate({left:'-250px'},0);
});

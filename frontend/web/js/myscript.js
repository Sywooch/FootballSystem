
var $rezTable = $( ".score");
var $infoTable = $( ".scoreTable" );

$('.scoreTableInfo').hide();
$('.info').hide();



$(document).ready(

    $rezTable.click(function(){ $(this).children('.info').toggle();} ),

    $infoTable.click(function() {$(this).children('.scoreTableInfo').toggle();}),

    $('.slider').slick({dots: true, autoplay: false, arrows: true})


);

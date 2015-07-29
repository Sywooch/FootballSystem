var chartData = [];
var totalValue = 0;
var currentRow = -1;
var currentCell = 0;


$('#chartData').find('td').each( function() {
    currentCell++;
    if ( currentCell % 2 != 0 ) {
        currentRow++;
        chartData[currentRow] = [];
        chartData[currentRow]['label'] = $(this).text();
    } else {
        var value = parseFloat($(this).text());
        totalValue += value;
        chartData[currentRow]['value'] = value;
    }
});
var currentPos = 0;
for(var i = 0; i < chartData.length; i++) {
    chartData[i]['startAngle'] = 2 * Math.PI * currentPos;
    chartData[i]['endAngle'] = 2 * Math.PI * ( currentPos + ( chartData[i]['value'] / totalValue ) );
    currentPos += chartData[i]['value'] / totalValue;
}

var colors = ["#191919", "#2D2D2D", "#191919", "#2D2D2D","#191919", "#2D2D2D"];

var startAngle = 0;
var spinTimeout = null;
var spinTime = 0;
var spinTimeTotal = 0;
var chartSizePercent = 55;
var chartStartAngle = -.5 * Math.PI;

var ctx;
var arc;

function draw() {
    drawRouletteWheel();
}

function drawRouletteWheel() {
    var canvas = document.getElementById("wheelcanvas");
    if (canvas.getContext) {
        var outsideRadius = 150;
        var textRadius = 80;
        var insideRadius = 21;
        var canvasWidth = canvas.width;
        var canvasHeight = canvas.height;
        var centreX = canvasWidth / 2;
        var centreY = canvasHeight / 2;
        var chartRadius = Math.min( canvasWidth, canvasHeight ) / 2 * ( chartSizePercent / 100 );

        ctx = canvas.getContext("2d");
        ctx.clearRect(0,0,canvasWidth,canvasHeight);

        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.font = 'bold 12px sans-serif';
        var angle;
        var end;



        for(var i = 0; i < chartData.length; i++) {
            angle = chartData[i]['startAngle'] + startAngle + chartStartAngle;
            end = chartData[i]['endAngle'] + startAngle + chartStartAngle;
            arc = end - angle;
            ctx.fillStyle = colors[i];

            ctx.beginPath();
            ctx.moveTo( centreX, centreY );
            ctx.arc(centreX, centreY, chartRadius, angle, end, false);
            ctx.arc(centreX, centreY, insideRadius, end, angle, true);
            //ctx.lineTo( centreX, centreY );
            ctx.lineWidth = 2;
            ctx.strokeStyle = "orange";
            ctx.stroke();
            ctx.fill();
            ctx.save();

             ctx.fillStyle = "white";
             ctx.translate(centreX + Math.cos(angle + arc / 2) * textRadius, centreY + Math.sin(angle + arc / 2) * textRadius);
             ctx.rotate(angle + arc / 2);
             var text = chartData[i]['label'];
             ctx.fillText(text, -ctx.measureText(text).width / 2, 4);
             ctx.restore();

        }
        //Arrow
        ctx.fillStyle = "red";
        ctx.beginPath();
        ctx.moveTo(centreX - 4, centreY - (outsideRadius + 5));
        ctx.lineTo(centreX + 4, centreY - (outsideRadius + 5));
        ctx.lineTo(centreX + 4, centreY - (outsideRadius - 5));
        ctx.lineTo(centreX + 9, centreY - (outsideRadius - 5));
        ctx.lineTo(centreX,     centreY - (outsideRadius - 13));
        ctx.lineTo(centreX - 9, centreY - (outsideRadius - 5));
        ctx.lineTo(centreX - 4, centreY - (outsideRadius - 5));
        ctx.lineTo(centreX - 4, centreY - (outsideRadius + 5));
        ctx.fill();

        /*var img = document.getElementById("photo");
        ctx.drawImage(img, centreX - 30, centreY - 30);*/

    }
}

function spin() {
    spinAngleStart = Math.random() * 10 + 10;
    spinTime = 0;
    // spinTimeTotal = Math.random() * 3 + 4 * 1000;
    spinTimeTotal = 10 * 1000;
    rotateWheel();
}

function rotateWheel() {
    spinTime += 30;
    if(spinTime >= spinTimeTotal) {
        stopRotateWheel();
        return;
    }
    var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
    startAngle += (spinAngle * Math.PI / 180);
    drawRouletteWheel();
    spinTimeout = setTimeout('rotateWheel()', 20);
}
var degrees;
var text;
var starto;
var ended;
function stopRotateWheel() {
 clearTimeout(spinTimeout);
    degrees = 360 - (startAngle * 180 / Math.PI) % 360;
    for(var i = 0; i < chartData.length; i++) {
        starto = chartData[i]['startAngle'] / Math.PI * 180;
        ended = chartData[i]['endAngle'] / Math.PI * 180;
        if((starto < degrees) && (degrees < ended))
        {
            text = chartData[i]['label'];break;
        }
    }
 ctx.save();
 ctx.font = 'bold 30px sans-serif';
 ctx.fillText(text, 450 - ctx.measureText(text).width / 2, 300 + 10);
 ctx.restore();
 }

function easeOut(t, b, c, d) {
    var ts = (t/=d)*t;
    var tc = ts*t;
    return b+c*(tc + -3*ts + 3*t);
}

draw();
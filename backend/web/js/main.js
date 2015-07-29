
$('.add_contact').hide();
////////////////////////////////////
var goals = $('.hrowGoals');
var midFuncBtnGoal = $('.midFuncBtnGoal');
var midFuncBtnGoalRemove = $('.midFuncBtnGoalRemove');
midFuncBtnGoalRemove.hide();
var ggoals = $('.growGoals');


var hrowYellowCard = $('.hrowYellowCard');
var midFuncBtnYellow = $('.midFuncBtnYellow');
var midFuncBtnYellowRemove = $('.midFuncBtnYellowRemove');
midFuncBtnYellowRemove.hide();
var growYellowCard = $('.growYellowCard');

var hrowRedCard = $('.hrowRedCard');
var midFuncBtnRed = $('.midFuncBtnRed');
var midFuncBtnRedRemove = $('.midFuncBtnRedRemove');
midFuncBtnRedRemove.hide();
var growRedCard = $('.growRedCard');

var pubButtonA = $('#publicA').hide();
var pubButtonR = $('#publicR').hide();
var addButton = $('.add_button').hide();


////////////////////////////////////////////////////
function delField(i)
{
    $(".rcard" + i).remove();
}
$(document).ready(

    $('.add_field_contact').click(function()
    {
        $('.add_contact').toggle();
    }),

    $(".deleteButton,.deleteInfoButton,.delete_field_contact").click(function()
    {
        return confirm('Підтверджуєте видалення?') ? true : false;
    }),
    $(".crez").click(function()
    {
        return confirm('Підтверджуєте відміну результату?') ? true : false;
    }),
    $(".w_btn").click(function()
    {
        return confirm('Оновлення всіх турнірів передбачає:\r\n- Видалення всіх матчів та їх результатів\r\n- Анулювання всієї статистики як команд так і гравців\r\nПідтверджуєте?') ? true : false;
    }),


    /* старт Динамічні форми запису результату*/

    midFuncBtnGoal.click(function()
    {
        if(goals.val().match(/^\d+$/) && ggoals.val().match(/^\d+$/))
        {
            var s = parseInt(goals.val());
            var g = parseInt(ggoals.val());
            var i = 0;
            if(s == 0)
            {
                goals.attr('disabled', true);
            }
            else
            {
                var hteam = $("#hteam").val();
                var hgoals = $(".hgoals");
                hgoals.append('<p>Автор(и)</p>');
                for (i; i<s; i++)
                {
                    var klas = "goalsAuthor" + i +"";
                    hgoals.append('<div class="'+ klas +'"></div>');
                    $('.'+ klas +'').load('listplayer?team=' + hteam + '&num=' + i +'&type=g');
                }
            }
            if(g == 0)
            {
                ggoals.attr('disabled', true);
            }
            else
            {
                var gteam = $("#gteam").val();
                var gogoals = $(".ggoals");
                gogoals.append('<p>Автор(и)</p>');
                var q = g + i;
                for (i; i<q; i++)
                {
                    var klas1 = "goalsAuthor" + i +"";
                    gogoals.append('<div class="'+ klas1 +'"></div>');
                    $('.'+ klas1 +'').load('listplayer?team=' + gteam + '&num=' + i +'&type=g');
                }
            }
           // goals.attr('disabled', true);
           // ggoals.attr('disabled', true);
            $(this).hide();
            midFuncBtnGoalRemove.show();

        }
        else alert('Введені недопустимі значення');
    }),
    midFuncBtnGoalRemove.click(function()
    {
        goals.attr('disabled', false);
        ggoals.attr('disabled', false);
        midFuncBtnGoal.show();
        midFuncBtnGoalRemove.hide();
        $('.hgoals > div:not(.scores), p:not(.writeScore)').remove();
        $('.ggoals > div:not(.scores), p:not(.writeScore)').remove();
    }),



    midFuncBtnYellow.click(function()
    {
        if(hrowYellowCard.val().match(/^\d+$/) && growYellowCard.val().match(/^\d+$/))
        {
            var s = parseInt(hrowYellowCard.val());
            var g = parseInt(growYellowCard.val());
            var i = 0;
            if(s == 0)
            {
                hrowYellowCard.attr('disabled', true);
            }
            else
            {
                var hteam = $("#hteam").val();
                var hyellows = $(".hyellows");
                hyellows.append('<p>Автор(и)</p>');
                for (i; i<s; i++)
                {
                    var klas2 = "yellowsAuthor" + i +"";
                    hyellows.append('<div class="'+ klas2 +'"></div>');
                    $('.'+ klas2 +'').load('listplayer?team=' + hteam + '&num=' + i +'&type=y');
                }
            }
            if(g == 0)
            {
                growYellowCard.attr('disabled', true);
            }
            else
            {
                var gteam = $("#gteam").val();
                var gyellows = $(".gyellows");
                gyellows.append('<p>Автор(и)</p>');
                var q = g + i;
                for (i; i<q; i++)
                {
                    var klas3 = "yellowAuthor" + i +"";
                    gyellows.append('<div class="'+ klas3 +'"></div>');
                    $('.'+ klas3 +'').load('listplayer?team=' + gteam + '&num=' + i +'&type=y');
                }
            }
            hrowYellowCard.attr('disabled', true);
            growYellowCard.attr('disabled', true);
            $(this).hide();
            midFuncBtnYellowRemove.show();

        }
        else alert('Введені недопустимі значення');
    }),
    midFuncBtnYellowRemove.click(function()
    {
        hrowYellowCard.attr('disabled', false);
        growYellowCard.attr('disabled', false);
        midFuncBtnYellow.show();
        midFuncBtnYellowRemove.hide();
        $('.hyellows > div:not(.scores), p:not(.writeScore)').remove();
        $('.gyellows > div:not(.scores), p:not(.writeScore)').remove();
    }),





midFuncBtnRed.click(function()
{
    if(hrowRedCard.val().match(/^\d+$/) && growRedCard.val().match(/^\d+$/))
    {
        var s = parseInt(hrowRedCard.val());
        var g = parseInt(growRedCard.val());
        var i = 0;
        if(s == 0)
        {
            hrowRedCard.attr('disabled', true);
        }
        else
        {
            var hteam = $("#hteam").val();
            var hreds = $(".hreds");
            hreds.append('<p>Автор(и)</p>');
            for (i; i<s; i++)
            {
                var klas4 = "redsAuthor" + i +"";
                hreds.append('<div class="'+ klas4 +'"></div>');
                $('.'+ klas4 +'').load('listplayer?team=' + hteam + '&num=' + i +'&type=r');
            }
        }
        if(g == 0)
        {
            growRedCard.attr('disabled', true);
        }
        else
        {
            var gteam = $("#gteam").val();
            var greds = $(".greds");
            greds.append('<p>Автор(и)</p>');
            var q = g + i;
            for (i; i<q; i++)
            {
                var klas5 = "redsAuthor" + i +"";
                greds.append('<div class="'+ klas5 +'"></div>');
                $('.'+ klas5 +'').load('listplayer?team=' + gteam + '&num=' + i +'&type=r');
            }
        }
        hrowRedCard.attr('disabled', true);
        growRedCard.attr('disabled', true);
        $(this).hide();
        midFuncBtnRedRemove.show();
        addButton.show();

    }
    else alert('Введені недопустимі значення');
}),
    midFuncBtnRedRemove.click(function()
    {
        hrowRedCard.attr('disabled', false);
        growRedCard.attr('disabled', false);
        midFuncBtnRed.show();
        midFuncBtnRedRemove.hide();
        addButton.hide();
        $('.hreds > div:not(.scores), p:not(.writeScore)').remove();
        $('.greds > div:not(.scores), p:not(.writeScore)').remove();
    }),





/*кінець Динамічні форми запису результату*/
/*початок анонс результату*/
    $('#publicanons').click(function()
    {
        var tour = $('#al').val();
        var cupV = $('#cupV').val();
        if(tour == 0) alert('Виберіть тур');
        else $('.ans').load('preview?tour=' + tour + '&cup=' + cupV, function(){pubButtonA.show()});
    }),

    pubButtonA.click(function()
    {
        var tour = $('#al').val();
        var cupV = $('#cupV').val();
        $('.ans').load('preview?tour=' + tour + '&check=1&cup=' + cupV);
        if(cupV == '1') window.location.replace("http://backend.ffobuhov.hol.es/cup");
        else window.location.replace("http://backend.ffobuhov.hol.es/games");
    }),

    $('#anonsRezult').click(function()
    {
        var tourVal = $('#tourVal').val();
        var anostitle = $('#anostitle').val();
        $('.loadAnons').load('score?tour=' + tourVal + '&anostitle=' + anostitle, function(){pubButtonR.show()});
    }),

    pubButtonR.click(function()
    {
        var tourVal = $('#tourVal').val();
        var anostitle = $('#anostitle').val();
        var controller = $('#controller').val();
        $('.loadAnons').load('score?tour=' + tourVal + '&check=1&anostitle='+ anostitle);
        window.location.replace("http://backend.ffobuhov.hol.es/" + controller);
    }),
    allcancel.click(function()
    {
        $.ajax({
            url: "main/allcancel"
        })
    })
    /*кінець анонс результату*/

);

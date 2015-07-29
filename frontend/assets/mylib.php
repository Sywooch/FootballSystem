<?php

namespace frontend\assets;

use yii\base\Component;
use yii\helpers\ArrayHelper;

class mylib extends Component
{
    public static  function uadate($format, $timestamp = 0, $nominative_month = false)
    {
        if(!$timestamp) $timestamp = time();
        elseif(!preg_match("/^[0-9]+$/", $timestamp)) $timestamp = strtotime($timestamp);
        $F = $nominative_month ? array(1=>"Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень",
            "Липень", "Серпень", "Вересень", "Жовтень", "Листопад", "Грудень") : array(1=>"Січня", "Лютого", "Березня", "Квітня", "Травня", "Червня", "Липня", "Серпня", "Вересня", "Жовтня", "Листопада", "Грудня");
        $l = array("Неділя", "Понеділок", "Вівторок", "Середа", "Четвер", "Пятница", "Субота");
        $format = str_replace("F", $F[date("n", $timestamp)], $format);
        $format = str_replace("l", $l[date("w", $timestamp)], $format);
        return date($format, $timestamp);
    }


    public static  function day($s)
    {
        $d = ".".date('Y');
        return self::uadate('l - d.m',strtotime(str_replace('.','-',$s.$d)));
    }

    public static  function dayForTeamGame($s)
    {
        $d = ".".date('Y');
        return self::uadate('j F',strtotime(str_replace('.','-',$s.$d)));
    }

    public static  function position()
    {
        return $position = ['воротар' => 'воротар','захисник'=>'захисник','півзахисник'=>'півзахисник','нападаючий'=>'нападаючий'];
    }

    public static  function namePlayers($model)
    {
        return $name_player = ArrayHelper::map($model, 'name', 'name');
    }

    public static  function livingPlayers($model)
    {
        return $living = ArrayHelper::map($model, 'living', 'living');
    }
}
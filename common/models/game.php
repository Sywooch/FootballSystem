<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "game".
 *
 * @property integer $id_match
 * @property string $tour
 * @property string $date
 * @property string $homeTeam
 * @property string $guestTeam
 * @property string $startTime
 * @property string $stadium
 * @property string $referi
 * @property string $rezultato
 */
class game extends ActiveRecord
{
    public static function tableName()
    {
        return 'game';
    }

    public function rules()
    {
        return [
            [['tour', 'date', 'homeTeam', 'guestTeam', 'startTime','stadium', 'referi'], 'required'],
            [['referi'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 5],
            [['homeTeam', 'guestTeam'], 'string', 'max' => 30],
            [['startTime'], 'string', 'max' => 5],
            [['stadium'], 'string', 'max' => 40],
            [['tour'], 'string', 'max' => 5]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_match' => 'Id',
            'tour' => 'Тур',
            'date' => 'Дата',
            'homeTeam' => 'Господарі',
            'guestTeam' => 'Гості',
            'startTime' => 'Початок',
            'stadium' => 'Стадіон',
            'referi' => 'Арбітр',
            'rezultato'=>'Результат'
        ];
    }

    public static function allMatch()
    {
        $match = Yii::$app->db->createCommand("SELECT homeTeam,guestTeam,tour,rezultato
                                                FROM game
                                                WHERE NOT tour IN ('1/8','1/4','1/2','Фінал')
                                                ORDER BY tour DESC ")->queryAll();
        return $match;
    }
    public static function allMatchCup()
    {
        $query = game::find()->where(['in','tour',['1/8','1/4','1/2','Фінал']])->orderBy(['tour' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

    public static function allMatchTeam($team)
    {
        $match = self::find()->select(['homeTeam', 'guestTeam', 'tour', 'date', 'rezultato'])
        ->where(['guestTeam'=>$team])->orWhere(['homeTeam'=>$team])
        ->orderBy(['date' => SORT_DESC])->asArray()->all();
        return $match;
    }

    public static function tourGame()
    {
        return $tour = ArrayHelper::map(game::find()->select(['tour'])->where(['not in','tour',['1/8','1/4','1/2','Фінал']])->orderBy(['tour' => SORT_DESC])->asArray()->all(), 'tour', 'tour');
    }

    public static function stadGame()
    {
        return $tour = ArrayHelper::map(game::find()->select(['tour'])->where(['in','tour',['1/8','1/4','1/2','Фінал']])->orderBy(['tour' => SORT_DESC])->asArray()->all(), 'tour', 'tour');
    }

    public static function match($tour)
    {
        return $match = game::find()->where(['tour'=>$tour])->orderBy(['date'=> SORT_ASC,'startTime'=> SORT_ASC])->asArray()->all();
    }

    public static function cancelScore($id)
    {
        $score = game::findOne(['id_match'=>$id]);
        $score->rezultato = "-";
        $score->save(false);
    }

    public static function addScore($id,$home,$guest)
    {
        $games = game::findOne($id);
        $games->rezultato = $home.':'.$guest;
        $games->save(false);
    }

    public static function bracket($stad)
    {
        return $stad = self::find()->select(['homeTeam','guestTeam','tour','rezultato'])->where(['tour'=>$stad])->asArray()->all();
    }
}

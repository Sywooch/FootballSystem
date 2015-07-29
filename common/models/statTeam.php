<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "statTeam".
 *
 * @property integer $id_statTeam
 * @property string $nameTeam
 * @property integer $game
 * @property integer $win
 * @property integer $draw
 * @property integer $lose
 * @property integer $goalPlus
 * @property integer $goalMinus
 * @property integer $score
 */
class statTeam extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statTeam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nameTeam', 'game', 'win', 'draw', 'lose', 'goalPlus', 'goalMinus', 'score'], 'required'],
            [['game', 'win', 'draw', 'lose', 'goalPlus', 'goalMinus', 'score'], 'integer'],
            [['nameTeam'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_statTeam' => 'Id',
            'nameTeam' => 'Назва',
            'game' => 'Матчі',
            'win' => 'Виграш',
            'draw' => 'Нічія',
            'lose' => 'Програш',
            'goalPlus' => 'Goal(+)',
            'goalMinus' => 'Goal(-)',
            'score' => 'Очки',
        ];
    }

    public static function TournamentTable()
    {
        $stat = self::find()->select(['nameTeam','game','score'])->orderBy(['score' => SORT_DESC])->asArray()->all();
        return $stat;
    }

    public static function cancelScoreWinHome($homeTeam,$guestTeam)
    {
        $lose = self::findOne(['nameTeam'=>$guestTeam]);
        $lose->game = $lose->game - 1;
        $lose->lose = $lose->lose - 1;
        $lose->goalPlus = $lose->goalPlus - $guest;
        $lose->goalMinus = $lose->goalMinus - $home;
        $lose->save(false);

        $win = self::findOne(['nameTeam'=>$homeTeam]);
        $win->game = $win->game - 1;
        $win->win = $win->win - 1;
        $win->goalPlus = $win->goalPlus - $home;
        $win->goalMinus = $win->goalMinus - $guest;
        $win->score = $win->score - 3;
        $win->save(false);
    }

    public static function cancelScoreWinGuest($homeTeam,$guestTeam)
    {
        $lose = self::findOne(['nameTeam'=>$homeTeam]);
        $lose->game = $lose->game - 1;
        $lose->lose = $lose->lose - 1;
        $lose->goalPlus = $lose->goalPlus - $home;
        $lose->goalMinus = $lose->goalMinus - $guest;
        $lose->save(false);

        $win = self::findOne(['nameTeam'=>$guestTeam]);
        $win->game = $win->game - 1;
        $win->win = $win->win - 1;
        $win->goalPlus = $win->goalPlus - $guest;
        $win->goalMinus = $win->goalMinus - $home;
        $win->score = $win->score - 3;
        $win->save(false);
    }

    public static function cancelScoreDraw($homeTeam,$guestTeam)
    {
        $draw1 = self::findOne(['nameTeam'=>$homeTeam]);
        $draw1->game = $draw1->game - 1;
        $draw1->draw = $draw1->draw - 1;
        $draw1->goalPlus = $draw1->goalPlus - $home;
        $draw1->goalMinus = $draw1->goalMinus - $guest;
        $draw1->score = $draw1->score - 1;
        $draw1->save(false);

        $draw2 = self::findOne(['nameTeam'=>$guestTeam]);
        $draw2->game = $draw2->game - 1;
        $draw2->draw = $draw2->draw - 1;
        $draw2->goalPlus = $draw2->goalPlus - $guest;
        $draw2->goalMinus = $draw2->goalMinus - $home;
        $draw2->score = $draw2->score - 1;
        $draw2->save(false);
    }

    public static function addScoreWinHome($homeTeam,$guestTeam)
    {
        $lose = self::findOne(['nameTeam'=>$guestTeam]);
        $lose->game = $lose->game + 1;
        $lose->lose = $lose->lose + 1;
        $lose->goalPlus = $lose->goalPlus + $guest;
        $lose->goalMinus = $lose->goalMinus + $home;
        $lose->save(false);

        $win = self::findOne(['nameTeam'=>$homeTeam]);
        $win->game = $win->game + 1;
        $win->win = $win->win + 1;
        $win->goalPlus = $win->goalPlus + $home;
        $win->goalMinus = $win->goalMinus + $guest;
        $win->score = $win->score + 3;
        $win->save(false);
    }

    public static function addScoreWinGuest($homeTeam,$guestTeam)
    {
        $lose = self::findOne(['nameTeam'=>$homeTeam]);
        $lose->game = $lose->game + 1;
        $lose->lose = $lose->lose + 1;
        $lose->goalPlus = $lose->goalPlus + $home;
        $lose->goalMinus = $lose->goalMinus + $guest;
        $lose->save(false);

        $win = self::findOne(['nameTeam'=>$guestTeam]);
        $win->game = $win->game + 1;
        $win->win = $win->win + 1;
        $win->goalPlus = $win->goalPlus + $guest;
        $win->goalMinus = $win->goalMinus + $home;
        $win->score = $win->score + 3;
        $win->save(false);
    }

    public static function addScoreDraw($homeTeam,$guestTeam)
    {
        $draw1 = self::findOne(['nameTeam'=>$homeTeam]);
        $draw1->game = $draw1->game + 1;
        $draw1->draw = $draw1->draw + 1;
        $draw1->goalPlus = $draw1->goalPlus + $home;
        $draw1->goalMinus = $draw1->goalMinus + $guest;
        $draw1->score = $draw1->score + 1;
        $draw1->save(false);

        $draw2 = self::findOne(['nameTeam'=>$guestTeam]);
        $draw2->game = $draw2->game + 1;
        $draw2->draw = $draw2->draw + 1;
        $draw2->goalPlus = $draw2->goalPlus + $guest;
        $draw2->goalMinus = $draw2->goalMinus + $home;
        $draw2->score = $draw2->score + 1;
        $draw2->save(false);
    }
}

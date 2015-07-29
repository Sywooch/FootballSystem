<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "statPlayers".
 *
 * @property integer $id_statPlayer
 * @property integer $goal
 * @property integer $yellow_card
 * @property integer $red_card
 * @property integer $active_red_card
 * @property integer $enable_tour_red_card
 * @property integer $id_player
 *
 * @property Players $idPlayer
 */
class statPlayers extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statPlayers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goal', 'yellow_card', 'red_card', 'active_red_card', 'enable_tour_red_card', 'id_player'], 'integer'],
            [['id_player'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_statPlayer' => 'Id',
            'goal' => 'Голи',
            'yellow_card' => 'Жовті картки',
            'red_card' => 'Червоні картки',
            'enable_tour_red_card' => 'Дія дискваліфікації до:(тур)',
            'id_player' => 'Id Player',
        ];
    }

    public static function redCard($tour,$cup = 0)
    {
        if($cup == 1)
        {
            $statRC = statPlayersCup::find()->select('id_player')->where(['enable_tour_red_card'=>$tour])->asArray()->all();
        }
        else
        {
            $statRC = statPlayers::find()->select('id_player')->where(['enable_tour_red_card'=>$tour])->asArray()->all();
        }

        if($statRC != NULL)
        {
            $keyR = array_column($statRC,'id_player');
            $ids = join(',',$keyR);
            $redName = Yii::$app->db->createCommand("SELECT players.name playerName, team.name teamName
                                                     FROM players, team
                                                     WHERE team.name = players.team_name
                                                     AND players.id_player in ($ids)")->queryAll();
            return $redName;
        }
        else return $redName = NULL;
    }

    public static function yellowCard($cup = 0)
    {
        if($cup == 1)
        {
            $statYC = statPlayersCup::find()->select('id_player')->where(['yellow_card'=>'3'])->asArray()->all();
        }
        else
        {
            $statYC = statPlayers::find()->select('id_player')->where(['yellow_card'=>'3'])->asArray()->all();
        }
        if($statYC != NULL)
        {
            $keyY = array_column($statYC,'id_player');
            $ids = join(',',$keyY);
            $yellowName = Yii::$app->db->createCommand("SELECT players.name playerName, team.name teamName
                                                        FROM players, team
                                                        WHERE team.name = players.team_name
                                                        AND players.id_player in ($ids)")->queryAll();
            return $yellowName;
        }
        else return $yellowName = NULL;
    }

    public static function AllStatistic($param)
    {
        $goal = Yii::$app->db->createCommand("SELECT players.name player, team.name team, $param
                                                FROM players, team, statPlayers
                                                WHERE statPlayers.id_player = players.id_player
                                                AND players.team_name = team.name AND $param > 0
                                                ORDER BY $param DESC
                                                LIMIT 0 , 10")->queryAll();
        return $goal;
    }

    public static function TeamStatistic($param,$team)
    {
        $goal = Yii::$app->db->createCommand("SELECT players.name player, $param
                                                FROM players, statPlayers, team
                                                WHERE statPlayers.id_player = players.id_player
                                                AND players.team_name = team.name
                                                AND team.name =:team
                                                AND $param > 0
                                                ORDER BY $param DESC
                                                LIMIT 0 , 5")->bindValue(':team',$team)->queryAll();
        return $goal;
    }
}

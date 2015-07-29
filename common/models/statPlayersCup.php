<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "statPlayersCup".
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
class statPlayersCup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statPlayersCup';
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
            'active_red_card' => 'Діюча красна картка',
            'enable_tour_red_card' => 'Дія дискваліфікації до:(стадія)',
            'id_player' => 'Id Player',
        ];
    }



    public static function AllStatCup($param)
    {
        $goal = Yii::$app->db->createCommand("SELECT players.name player, team.name team, $param
                                                FROM players, team, statPlayersCup
                                                WHERE statPlayersCup.id_player = players.id_player
                                                AND players.team_name = team.name AND $param > 0
                                                ORDER BY $param DESC
                                                LIMIT 0 , 6")->queryAll();
        return $goal;
    }
}

<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "players".
 *
 * @property integer $id_player
 * @property string $name
 * @property string $old
 * @property string $position
 * @property integer $number
 * @property string $living
 * @property integer $team_name
 */
class players extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'old', 'position', 'number', 'living', 'team_name'], 'required'],
            [['position'], 'string'],
            [['number'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['old'], 'string', 'max' => 15],
            [['living','team_name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_player' => 'Id Player',
            'name' => 'Повне ім’я',
            'old' => 'Дата народження',
            'position' => 'Позиція',
            'number' => '№',
            'living' => 'Місце проживання',
            'team_name' => 'Команда',
        ];
    }

    public static function TeamPlayers($team)
    {
        $goal = Yii::$app->db->createCommand("SELECT players.name player, players.old, players.position,players.living,players.number
                                                FROM players, team
                                                WHERE players.team_name = team.name
                                                AND team.name =:team
                                                ORDER BY players.position")->bindValue(':team',$team)->queryAll();
        return $goal;
    }

    public static function GroupPlayers()
    {
       $players = Yii::$app->db->createCommand("SELECT count(id_player),team_name FROM players group by team_name")->queryAll();
       return $players;
    }

    public static function currentPlayers($team)
    {
        $players = players::find()->where(['team_name'=>$team])->asArray()->all();
        return $players;
    }

    public static function listPlayer($team)
    {
        $list = ArrayHelper::map(players::find()->select(['name'])->where(['team_name'=>$team])->asArray()->all(), 'name', 'name');
        return $list = array_merge([' '],$list);
    }
}

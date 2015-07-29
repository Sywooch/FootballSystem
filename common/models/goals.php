<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Model;

/**
 * This is the model class for table "goals".
 *
 * @property integer $id_goals
 * @property integer $id_match
 * @property string $author_goals
 */
class goals extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_goals'], 'required'],
            [['id_match'], 'string'],
            [['author_goals'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_goals' => 'Id Goals',
            'id_match' => 'Id Match',
            'author_goals' => 'Author Goals',
        ];
    }
    public function getAuthorGoals()
    {
        return $this->hasOne(players::className(), ['name' => 'author_goals']);
    }

    public static function cancelScoreGoals($id)
    {
        $goals = self::find()->select(['author_goals'])->where(['id_match'=>$id])->all();
        if(!empty($goals))
        {
            foreach ($goals as $goal)
            {
                $id_y = players::findOne(['name'=>$goal['author_goals']]);
                $stat_p = statPlayers::findOne(['id_player'=>$id_y->id_player]);
                $stat_p->goal = $stat_p->goal - 1;
                $stat_p->save(false);
            }
            goals::deleteAll(['id_match'=>$id]);
        }
    }

}

<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "yellowCards".
 *
 * @property integer $id_yellow_card
 * @property integer $id_match
 * @property string $author_yellow_card
 *
 */
class yellowCards extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yellowCards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_yellow_card'], 'required'],
            [['id_match'], 'integer'],
            [['author_yellow_card'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_yellow_card' => 'Id Yellow Card',
            'id_match' => 'Id Match',
            'author_yellow_card' => 'Author Yellow Card',
        ];
    }

    public function getAuthorYellowCard()
    {
        return $this->hasOne(players::className(), ['name' => 'author_yellow_card']);
    }

    public static function cancelScoreYellowCards($id)
    {
        $yellows = yellowCards::find()->select(['author_yellow_card'])->where(['id_match'=>$id])->all();
        if(!empty($yellows))
        {
            foreach ($yellows as $yellow)
            {
                $id_y = players::findOne(['name'=>$yellow['author_yellow_card']]);
                $stat_y = statPlayers::findOne(['id_player'=>$id_y->id_player]);
                $stat_y->yellow_card = $stat_y->yellow_card - 1;
                if($stat_y->yellow_card % 4 == 3)
                {
                    $stat_y->red_card = $stat_y->red_card - 1;
                    $stat_y->enable_tour_red_card = 0;
                }
                $stat_y->save(false);
            }
            yellowCards::deleteAll(['id_match'=>$id]);
        }
    }
}

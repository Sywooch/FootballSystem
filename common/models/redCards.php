<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "redCards".
 *
 * @property integer $id_red_card
 * @property integer $id_match
 * @property string $author_red_card
 *
 * @property Players $authorRedCard
 * @property Game $idMatch
 */
class redCards extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redCards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author_red_card'], 'required'],
            [['id_match'], 'integer'],
            [['author_red_card'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_red_card' => 'Id Red Card',
            'id_match' => 'Id Match',
            'author_red_card' => 'Author Red Card',
        ];
    }

    public function getAuthorRedCard()
    {
        return $this->hasOne(players::className(), ['name' => 'author_red_card']);
    }

    public static function cancelScoreRedCards($id)
    {
        $reds = redCards::find()->select(['author_red_card'])->where(['id_match'=>$id])->all();
        if(!empty($reds))
        {
            foreach ($reds as $red)
            {
                $id_y = players::findOne(['name'=>$red['author_red_card']]);
                $stat_r = statPlayers::findOne(['id_player'=>$id_y->id_player]);
                $stat_r->red_card = $stat_r->red_card - 1;
                $stat_r->enable_tour_red_card = 0;
                $stat_r->save(false);
            }
            redCards::deleteAll(['id_match'=>$id]);
        }
    }
}

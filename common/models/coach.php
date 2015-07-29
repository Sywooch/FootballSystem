<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "coach".
 *
 * @property integer $id_coach
 * @property string $name_coach
 * @property integer $phone
 * @property string $email
 * @property string $id_team
 *
 */
class coach extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coach';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_coach', 'phone', 'email'], 'required'],
            [['name_coach', 'phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_coach' => 'Id Coach',
            'name_coach' => 'Name Coach',
            'phone' => 'Phone',
            'email' => 'Email',
            'team_name' => 'Team Name',
        ];
    }

    public  static function coach($id_team)
    {
        $coach = self::find()->select(['name_coach','phone','email'])->where(['id_team'=>$id_team])->asArray()->all();
        return $coach;
    }

}

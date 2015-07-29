<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property integer $id_message
 * @property string $title
 * @property string $text
 * @property integer $edit
 * @property string $time
 */
class message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['time'], 'safe'],
            [['title', 'text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_message' => 'Id Message',
            'title' => 'Заголовок',
            'text' => 'Text',
            'time' => 'Time',
        ];
    }

    public static function lastNews($lim)
    {
        $news = message::find()->select(['title','text','time'])->orderBy(['time'=> SORT_DESC])->limit($lim)->asArray()->all();
        return $news;
    }

    public static function AllNews()
    {
        $news = message::find()->select(['title','text','time'])->orderBy(['time'=> SORT_DESC])->asArray()->all();
        return $news;
    }

    public static function CupNews()
    {
        $news = message::find()->select(['title','text','time'])->where(['like', 'title', 'стадії'])->orWhere(['like', 'title', 'фіналу'])->orderBy(['time'=> SORT_DESC])->asArray()->all();
        return $news;
    }

    public static function newsView($id_message)
    {
        $view = self::findOne(['id_message'=>$id_message]);
        return $view;
    }
}

<?php

namespace common\models;

use Yii;
use common\extensions\file\behaviors\UploadBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "team".
 *
 * @property integer $id_team
 * @property string $name
 * @property string $from
 * @property string $stadium
 * @property string $imgEmblem
 * @property string $imgEmblemBig
 *
 * @property Coach[] $coaches
 * @property Game[] $games
 * @property Players[] $players
 * @property StatTeam[] $statTeams
 */
class team extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'imgEmblemBig' => [
                        'path' => Yii::getAlias('@frontend/web/uploads/teamEmblem'),
                        'tempPath' => Yii::getAlias('@frontend/web/uploads'),
                        'url' => 'frontend/uploads'
                    ],
                    'imgEmblem' => [
                        'path' => Yii::getAlias('@frontend/web/uploads/teamEmblem'),
                        'tempPath' => Yii::getAlias('@frontend/web/uploads'),
                        'url' => 'frontend/uploads'
                    ]
                ]
            ]
        ];

    }

    public function getId()
    {
        return $this->id;
    }

    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'from', 'stadium'], 'required'],
            [['name', 'from', 'stadium'], 'string', 'max' => 30],
            [['imgEmblemBig','imgEmblem'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_team' => 'Id',
            'name' => 'Назва',
            'from' => 'Місце знаходження',
            'stadium' => 'Стадіон',
            'imgEmblem' => 'Img Emblem',
            'imgEmblemBig' => 'Img Emblem Big',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoaches()
    {
        return $this->hasMany(Coach::className(), ['id_team' => 'id_team']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGames()
    {
        return $this->hasMany(Game::className(), ['guestTeam' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlayers()
    {
        return $this->hasMany(Players::className(), ['id_team' => 'id_team']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatTeams()
    {
        return $this->hasMany(StatTeam::className(), ['nameTeam' => 'name']);
    }

    public static function allTeam()
    {
        $team = team::find()->select(['id_team','name','imgEmblem'])->orderBy('name')->asArray()->all();
        return $team;
    }

    public static function teamInfo($id)
    {
        $info = Yii::$app->db->createCommand("SELECT team.name, team.from, team.stadium, team.imgEmblemBig, coach.name_coach, coach.phone, coach.email
                                                FROM coach, team
                                                WHERE team.id_team = coach.id_team
                                                AND team.id_team =:id")->bindValue(':id',$id)->queryAll();
        return $info;
    }

    public static function adminTeamInfo()
    {
        $team = Yii::$app->db->createCommand("SELECT team.name, team.from, team.stadium FROM team")->queryAll();

        return $team;
    }

    public static function teamView($id_team)
    {
        $view = self::find()->where(['id_team'=>$id_team])->asArray()->all();
        return $view;
    }


    public static function teamLogoUrl($logo,$admin = 0)
    {
        $backendUrl = "http://ffobuhov.hol.es/";
        $url = 'uploads/teamEmblem/';
        if($admin == 1 && $logo !== null)
        {
           $url = $backendUrl.$url.$logo;
        }
        else
        {
            $url.=$logo;
        }
        return $url;
    }

    public static  function teamArray()
    {
        return $team = ArrayHelper::map(team::find()->select('name')->asArray()->all(), 'name', 'name');
    }
}

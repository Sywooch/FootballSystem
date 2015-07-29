<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class gameSearch extends Model
{

    public $tour;

    public function rules()
    {
        return [
            // Безопасные атрибуты
            [['tour'], 'string']
        ];
    }

    public function search($params)
    {
        $query = game::find()->where(['not in','tour',['1/8','1/4','1/2','Фінал']])->orderBy(['tour' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'tour', true);
        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '') {
            return;
        }
        if ($partialMatch) {
            $query->andWhere(['like', $attribute, $value]);
        } else {
            $query->andWhere([$attribute => $value]);
        }
    }
}
<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\message;

/**
 * Модели поиска по [[User]] записям.
 *
 * @property string $name Имя
 * @property string $from Фамилия
 * @property string $stadium Логин
 */
class messageSearch extends Model
{

    public $title;
    public $text;

    public function rules()
    {
        return [
            // Безопасные атрибуты
            [['title','text'], 'string']
        ];
    }

    public function search($params)
    {
        $query = message::find()->orderBy(['time' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'title', true);
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
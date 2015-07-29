<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 *
 * @property string $name Имя
 * @property string $living
 * @property string $stadium Логин
 */
class playersSearch extends Model
{

    public $name;

    public $living;

    public $team_name;

    public function rules()
    {
        return [
                 [['name','living','team_name'], 'string']
               ];
    }

    public function search($params,$team)
    {
        $query = players::find()->where(['team_name'=>$team]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>false,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $this->addCondition($query, 'name', true);
        $this->addCondition($query, 'living', true);
        $this->addCondition($query, 'team_name', true);
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
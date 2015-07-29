<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\team;

/**
 * Модели поиска по [[User]] записям.
 *
 * @property string $name Имя
 * @property string $from Фамилия
 * @property string $stadium Логин
 */
class teamSearch extends Model
{

    public $name;

	public function rules()
	{
		return [
		    // Безопасные атрибуты
		    [['name'], 'string']
		];
	}

	public function search($params)
	{
		$query = team::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
            'pagination'=>false,
		]);
		
		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

        $this->addCondition($query, 'name', true);
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
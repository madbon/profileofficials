<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tblofficials;

/**
 * TblofficialsSearch represents the model behind the search form about `backend\models\Tblofficials`.
 */
class TblofficialsSearch extends Tblofficials
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['OFFICIAL_ID', 'FIRSTNAME', 'LEVELPLACE_ID', 'LEVELPOSIT_ID', 'POSIT_ID', 'PARTY_ID', 'REGION_C', 'PROVINCE_C', 'CITYMUN_C'], 'integer'],
            [['MIDDLENAME', 'LASTNAME', 'BIRTHDATE', 'AGE', 'DATECREATED'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tblofficials::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'OFFICIAL_ID' => $this->OFFICIAL_ID,
            'FIRSTNAME' => $this->FIRSTNAME,
            'LEVELPLACE_ID' => $this->LEVELPLACE_ID,
            'LEVELPOSIT_ID' => $this->LEVELPOSIT_ID,
            'POSIT_ID' => $this->POSIT_ID,
            'PARTY_ID' => $this->PARTY_ID,
            'REGION_C' => $this->REGION_C,
            'PROVINCE_C' => $this->PROVINCE_C,
            'CITYMUN_C' => $this->CITYMUN_C,
            'DATECREATED' => $this->DATECREATED,
        ]);

        $query->andFilterWhere(['like', 'MIDDLENAME', $this->MIDDLENAME])
            ->andFilterWhere(['like', 'LASTNAME', $this->LASTNAME])
            ->andFilterWhere(['like', 'BIRTHDATE', $this->BIRTHDATE])
            ->andFilterWhere(['like', 'AGE', $this->AGE]);

        return $dataProvider;
    }
}

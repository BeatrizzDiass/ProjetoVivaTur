<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Avaliacoes;

/**
 * AvaliacoesSearch represents the model behind the search form of `backend\models\Avaliacoes`.
 */
class AvaliacoesSearch extends Avaliacoes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'experiencia_id'], 'integer'],
            [['estrela'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Avaliacoes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'experiencia_id' => $this->experiencia_id,
        ]);

        $query->andFilterWhere(['like', 'estrela', $this->estrela]);

        return $dataProvider;
    }
}

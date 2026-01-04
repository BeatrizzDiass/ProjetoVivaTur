<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Reservas;

/**
 * ReservasSearch represents the model behind the search form of `backend\models\Reservas`.
 */
class ReservasSearch extends Reservas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'numPessoas', 'experiencia_id', 'user_id', 'metodoPagamento_id'], 'integer'],
            [['dataReserva', 'disponivel'], 'safe'],
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
        $query = Reservas::find();

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
            'numPessoas' => $this->numPessoas,
            'experiencia_id' => $this->experiencia_id,
            'user_id' => $this->user_id,
            'metodoPagamento_id' => $this->metodoPagamento_id,
        ]);

        $query->andFilterWhere(['like', 'dataReserva', $this->dataReserva])
            ->andFilterWhere(['like', 'disponivel', $this->disponivel]);

        return $dataProvider;
    }
}

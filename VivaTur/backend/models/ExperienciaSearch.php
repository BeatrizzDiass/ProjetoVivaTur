<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Experiencia;

/**
 * ExperienciaSearch represents the model behind the search form of `app\models\Experiencia`.
 */
class ExperienciaSearch extends Experiencia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'categoria_id', 'gestor_id', 'pais_id'], 'integer'],
            [['nome', 'horaInicio', 'horaFim', 'duracao', 'local', 'dataDisponivel', 'precoPessoa', 'imagem', 'numMaxParticipante', 'numMinParticipante'], 'safe'],
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
        $query = Experiencia::find();

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
            'categoria_id' => $this->categoria_id,
            'gestor_id' => $this->gestor_id,
            'pais_id' => $this->pais_id,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'horaInicio', $this->horaInicio])
            ->andFilterWhere(['like', 'horaFim', $this->horaFim])
            ->andFilterWhere(['like', 'duracao', $this->duracao])
            ->andFilterWhere(['like', 'local', $this->local])
            ->andFilterWhere(['like', 'dataDisponivel', $this->dataDisponivel])
            ->andFilterWhere(['like', 'precoPessoa', $this->precoPessoa])
            ->andFilterWhere(['like', 'imagem', $this->imagem])
            ->andFilterWhere(['like', 'numMaxParticipante', $this->numMaxParticipante])
            ->andFilterWhere(['like', 'numMinParticipante', $this->numMinParticipante]);

        return $dataProvider;
    }
}

<?php

namespace frontend\models;

use yii\data\ActiveDataProvider;

/**
 * FavoritoSearch represents the model behind the search form of `frontend\models\Favorito`.
 */
class FavoritoSearch extends Favorito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'experiencia_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return parent::scenarios();
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
        // Apenas mostra os favoritos do utilizador logado
        $query = Favorito::find()->where(['user_id' => \Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'experiencia_id' => $this->experiencia_id,
        ]);

        return $dataProvider;
    }
}

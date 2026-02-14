<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Experiencias;
use frontend\models\Comentarios;
use frontend\models\Avaliacoes;
use frontend\models\Turistas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ExperienciasController extends Controller
{
    /**
     * Exibe os detalhes de uma experiência
     */
    public function actionDetalhes($id)
    {
        $experiencia = Experiencias::findOne($id);

        if ($experiencia === null) {
            throw new NotFoundHttpException('Experiência não encontrada.');
        }

        // Inicializar modelos para os formulários
        $novoComentario = new Comentarios();
        $novaAvaliacao = new Avaliacoes();
        $turista = null;

        // Verificar se o utilizador está logado e é turista
        if (!Yii::$app->user->isGuest) {
            $turista = Turistas::findOne(['user_id' => Yii::$app->user->id]);
        }

        return $this->render('detalhes', [
            'experiencia' => $experiencia,
            'novoComentario' => $novoComentario,
            'novaAvaliacao' => $novaAvaliacao,
            'turista' => $turista,
        ]);
    }
}
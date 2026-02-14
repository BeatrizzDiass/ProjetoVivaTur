<?php

namespace console\controllers;

use backend\models\Avaliacoes;
use backend\models\Categorias;
use backend\models\Comentarios;
use backend\models\Experiencias;
use backend\models\Favoritos;
use backend\models\Gestores;
use backend\models\Metodopagamentos;
use backend\models\Paises;
use backend\models\Reservas;
use backend\models\Turistas;
use common\models\Linguas;
use common\models\User;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class VivaturController extends Controller
{
    /**
     * Cria/atualiza/apaga registos de teste (experiências, comentários, favoritos, avaliações, reservas)
     * para disparar notificações MQTT.
     *
     * Como usar:
     *  Terminal 1: php yii mqtt/subscribe "vivaTur/#"
     *  Terminal 2: php yii vivatur/mqtt-test
     */
    public function actionMqttTest(): int
    {
        $categoria = Categorias::find()->where(['nome' => 'Teste MQTT'])->one();
        if ($categoria === null) {
            $categoria = new Categorias(['nome' => 'Teste MQTT']);
            $categoria->save(false);
        }

        $pais = Paises::find()->where(['nome' => 'Portugal'])->one();
        if ($pais === null) {
            $pais = new Paises(['nome' => 'Portugal']);
            $pais->save(false);
        }

        $user = User::find()->where(['username' => 'mqtt_tester'])->one();
        if ($user === null) {
            $user = new User();
            $user->username = 'mqtt_tester';
            $user->email = 'mqtt_tester@example.com';
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword('12345678');
            $user->generateAuthKey();
            $user->save(false);
        }

        $gestor = Gestores::find()->where(['user_id' => $user->id])->one();
        if ($gestor === null) {
            $gestor = new Gestores(['user_id' => $user->id]);
            $gestor->save(false);
        }

        // ========== EXPERIENCIAS ==========
        $this->stdout("=== Testando Experiências ===\n", Console::FG_CYAN);

        // INSERT (publica vivaTur/experiencias/insert)
        $exp = new Experiencias();
        $exp->nome = 'Experiência MQTT ' . date('His');
        $exp->descricao = 'Experiência criada para testar notificações MQTT.';
        $exp->horaInicio = '10:00';
        $exp->horaFim = '12:00';
        $exp->duracao = '2h';
        $exp->local = 'Leiria';
        $exp->dataDisponivel = date('Y-m-d');
        $exp->precoPessoa = '10';
        $exp->imagem = '';
        $exp->numMaxParticipante = 10;
        $exp->numMinParticipante = 1;
        $exp->categoria_id = $categoria->id;
        $exp->gestor_id = $gestor->id;
        $exp->pais_id = $pais->id;
        $exp->save(false);

        $this->stdout("Criada experiência ID={$exp->id}\n", Console::FG_GREEN);

        // UPDATE (publica vivaTur/experiencias/update)
        $exp->precoPessoa = (string) ((int) $exp->precoPessoa + 1);
        $exp->save(false);
        $this->stdout("Atualizada experiência ID={$exp->id}\n", Console::FG_YELLOW);

        // DELETE (publica vivaTur/experiencias/delete)
        $expId = $exp->id;
        $exp->delete();
        $this->stdout("Apagada experiência ID={$expId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== COMENTARIOS ==========
        $this->stdout("=== Testando Comentários ===\n", Console::FG_CYAN);

        // Criar experiência auxiliar para testar comentários
        $expAux = new Experiencias();
        $expAux->nome = 'Exp Auxiliar (comentários)';
        $expAux->descricao = 'Experiência auxiliar para teste de comentários.';
        $expAux->horaInicio = '14:00';
        $expAux->horaFim = '16:00';
        $expAux->duracao = '2h';
        $expAux->local = 'Coimbra';
        $expAux->dataDisponivel = date('Y-m-d');
        $expAux->precoPessoa = '15';
        $expAux->imagem = '';
        $expAux->numMaxParticipante = 5;
        $expAux->numMinParticipante = 1;
        $expAux->categoria_id = $categoria->id;
        $expAux->gestor_id = $gestor->id;
        $expAux->pais_id = $pais->id;
        $expAux->save(false);

        $turista = Turistas::find()->where(['user_id' => $user->id])->one();
        if ($turista === null) {
            $turista = new Turistas(['user_id' => $user->id]);
            $turista->save(false);
        }

        // INSERT comentário
        $coment = new Comentarios();
        $coment->descricao = 'Comentário de teste MQTT ' . date('His');
        $coment->dataCriacao = date('Y-m-d H:i:s');
        $coment->experiencia_id = $expAux->id;
        $coment->user_id = $user->id;  // ← ADICIONA ESTA LINHA
        $coment->turista_id = $turista->id;
        $coment->save(false);
        $this->stdout("Criado comentário ID={$coment->id}\n", Console::FG_GREEN);

        // UPDATE comentário
        $coment->resposta = 'Resposta do gestor MQTT';
        $coment->dataResposta = date('Y-m-d H:i:s');
        $coment->save(false);
        $this->stdout("Atualizado comentário ID={$coment->id}\n", Console::FG_YELLOW);

        // DELETE comentário
        $comentId = $coment->id;
        $coment->delete();
        $this->stdout("Apagado comentário ID={$comentId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== FAVORITOS ==========
        $this->stdout("=== Testando Favoritos ===\n", Console::FG_CYAN);

        // INSERT favorito
        $fav = new Favoritos();
        $fav->experiencia_id = $expAux->id;
        $fav->user_id = $user->id;
        $fav->turista_id = $turista->id;
        $fav->save(false);
        $this->stdout("Criado favorito ID={$fav->id}\n", Console::FG_GREEN);

        // DELETE favorito (favoritos normalmente não têm update relevante)
        $favId = $fav->id;
        $fav->delete();
        $this->stdout("Apagado favorito ID={$favId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== AVALIACOES ==========
        $this->stdout("=== Testando Avaliações ===\n", Console::FG_CYAN);

        // INSERT avaliação
        $aval = new Avaliacoes();
        $aval->estrela = 4;
        $aval->experiencia_id = $expAux->id;
        $aval->user_id = $user->id;
        $aval->turista_id = $turista->id;
        $aval->save(false);
        $this->stdout("Criada avaliação ID={$aval->id}\n", Console::FG_GREEN);

        // UPDATE avaliação
        $aval->estrela = 5;
        $aval->save(false);
        $this->stdout("Atualizada avaliação ID={$aval->id}\n", Console::FG_YELLOW);

        // DELETE avaliação
        $avalId = $aval->id;
        $aval->delete();
        $this->stdout("Apagada avaliação ID={$avalId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== RESERVAS ==========
        $this->stdout("=== Testando Reservas ===\n", Console::FG_CYAN);

        $metodoPag = Metodopagamentos::find()->where(['nome' => 'Teste MQTT'])->one();
        if ($metodoPag === null) {
            $metodoPag = new Metodopagamentos(['nome' => 'Teste MQTT']);
            $metodoPag->save(false);
        }

        // INSERT reserva
        $reserva = new Reservas();
        $reserva->dataReserva = date('Y-m-d');
        $reserva->numPessoas = 2;
        $reserva->disponivel = 3;
        $reserva->experiencia_id = $expAux->id;
        $reserva->user_id = $user->id;  // ← ADICIONA ESTA LINHA
        $reserva->turista_id = $turista->id;
        $reserva->metodoPagamento_id = $metodoPag->id;
        $reserva->save(false);
        $this->stdout("Criada reserva ID={$reserva->id}\n", Console::FG_GREEN);

        // UPDATE reserva
        $reserva->numPessoas = 3;
        $reserva->save(false);
        $this->stdout("Atualizada reserva ID={$reserva->id}\n", Console::FG_YELLOW);

        // DELETE reserva
        $reservaId = $reserva->id;
        $reserva->delete();
        $this->stdout("Apagada reserva ID={$reservaId}\n", Console::FG_RED);

        // Limpar experiência auxiliar
        $expAux->delete();

        $this->stdout("\n");

        // ========== USERS ==========
        $this->stdout("=== Testando Users ===\n", Console::FG_CYAN);

        // INSERT user
        $userMqtt = new User();
        $userMqtt->username = 'mqtt_user_' . date('His');
        $userMqtt->email = 'mqtt_user_' . date('His') . '@example.com';
        $userMqtt->status = User::STATUS_ACTIVE;
        $userMqtt->setPassword('12345678');
        $userMqtt->generateAuthKey();
        $userMqtt->save(false);
        $this->stdout("Criado user ID={$userMqtt->id}\n", Console::FG_GREEN);

        // UPDATE user
        $userMqtt->email = 'updated_' . $userMqtt->email;
        $userMqtt->save(false);
        $this->stdout("Atualizado user ID={$userMqtt->id}\n", Console::FG_YELLOW);

        // DELETE user
        $userMqttId = $userMqtt->id;
        $userMqtt->delete();
        $this->stdout("Apagado user ID={$userMqttId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== LINGUAS ==========
        $this->stdout("=== Testando Línguas ===\n", Console::FG_CYAN);

        // INSERT língua
        $lingua = new Linguas(['nome' => 'Língua MQTT ' . date('His')]);
        $lingua->save(false);
        $this->stdout("Criada língua ID={$lingua->id}\n", Console::FG_GREEN);

        // UPDATE língua
        $lingua->nome = 'Língua Atualizada ' . date('His');
        $lingua->save(false);
        $this->stdout("Atualizada língua ID={$lingua->id}\n", Console::FG_YELLOW);

        // DELETE língua
        $linguaId = $lingua->id;
        $lingua->delete();
        $this->stdout("Apagada língua ID={$linguaId}\n", Console::FG_RED);

        $this->stdout("\n");

        // ========== PAISES ==========
        $this->stdout("=== Testando Países ===\n", Console::FG_CYAN);

        // INSERT país
        $paisMqtt = new Paises(['nome' => 'País MQTT ' . date('His')]);
        $paisMqtt->save(false);
        $this->stdout("Criado país ID={$paisMqtt->id}\n", Console::FG_GREEN);

        // UPDATE país
        $paisMqtt->nome = 'País Atualizado ' . date('His');
        $paisMqtt->save(false);
        $this->stdout("Atualizado país ID={$paisMqtt->id}\n", Console::FG_YELLOW);

        // DELETE país
        $paisMqttId = $paisMqtt->id;
        $paisMqtt->delete();
        $this->stdout("Apagado país ID={$paisMqttId}\n", Console::FG_RED);

        $this->stdout("\n=== CONCLUÍDO ===\n", Console::FG_CYAN);
        $this->stdout("Se tinhas um subscribe em vivaTur/#, deves ter visto:\n");
        $this->stdout("  - 3 mensagens de experiencias (insert/update/delete)\n");
        $this->stdout("  - 3 mensagens de comentarios (insert/update/delete)\n");
        $this->stdout("  - 2 mensagens de favoritos (insert/delete)\n");
        $this->stdout("  - 3 mensagens de avaliacoes (insert/update/delete)\n");
        $this->stdout("  - 3 mensagens de reservas (insert/update/delete)\n");
        $this->stdout("  - 3 mensagens de users (insert/update/delete)\n");
        $this->stdout("  - 3 mensagens de linguas (insert/update/delete)\n");
        $this->stdout("  - 3 mensagens de paises (insert/update/delete)\n");
        $this->stdout("Total: 23 notificações MQTT!\n", Console::FG_GREEN);

        return ExitCode::OK;
    }
}
<?php

use yii\db\Migration;

/**
 * Cria as tabelas de domínio do VivaTur (experiências, categorias, países, etc.).
 *
 * Nota: alguns models no projeto têm inconsistências (ex.: favoritos com user_id vs turista_id).
 * Este schema cobre os campos usados no frontend/backend, permitindo evolução posterior.
 */
class m260106_000001_create_vivatur_domain_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        // Tabelas base
        $this->createTable('categorias', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
        ], $tableOptions);

        $this->createTable('paises', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
        ], $tableOptions);

        $this->createTable('linguas', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
        ], $tableOptions);

        $this->createTable('metodopagamentos', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
        ], $tableOptions);

        // Perfis
        $this->createTable('gestores', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx_gestores_user_id', 'gestores', 'user_id', true);
        $this->addForeignKey('fk_gestores_user', 'gestores', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('turistas', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx_turistas_user_id', 'turistas', 'user_id', true);
        $this->addForeignKey('fk_turistas_user', 'turistas', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // Experiências
        $this->createTable('experiencias', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(45)->notNull(),
            'descricao' => $this->string(255)->notNull(),
            'horaInicio' => $this->string(45)->notNull(),
            'horaFim' => $this->string(45)->notNull(),
            'duracao' => $this->string(45)->notNull(),
            'local' => $this->string(45)->notNull(),
            'dataDisponivel' => $this->date()->notNull(),
            'precoPessoa' => $this->string(45)->notNull(),
            'imagem' => $this->string(255)->null(),
            'numMaxParticipante' => $this->integer()->notNull(),
            'numMinParticipante' => $this->integer()->notNull(),
            'categoria_id' => $this->integer()->notNull(),
            'gestor_id' => $this->integer()->notNull(),
            'pais_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_experiencias_categoria_id', 'experiencias', 'categoria_id');
        $this->createIndex('idx_experiencias_gestor_id', 'experiencias', 'gestor_id');
        $this->createIndex('idx_experiencias_pais_id', 'experiencias', 'pais_id');

        $this->addForeignKey('fk_experiencias_categoria', 'experiencias', 'categoria_id', 'categorias', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_experiencias_gestor', 'experiencias', 'gestor_id', 'gestores', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('fk_experiencias_pais', 'experiencias', 'pais_id', 'paises', 'id', 'RESTRICT', 'CASCADE');

        // Comentários
        $this->createTable('comentarios', [
            'id' => $this->primaryKey(),
            'descricao' => $this->string(500)->notNull(),
            'dataCriacao' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'experiencia_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'resposta' => $this->string(500)->null(),
            'dataResposta' => $this->dateTime()->null(),
        ], $tableOptions);
        $this->createIndex('idx_comentarios_experiencia_id', 'comentarios', 'experiencia_id');
        $this->createIndex('idx_comentarios_user_id', 'comentarios', 'user_id');
        $this->addForeignKey('fk_comentarios_experiencia', 'comentarios', 'experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comentarios_user', 'comentarios', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // Avaliações
        $this->createTable('avaliacoes', [
            'id' => $this->primaryKey(),
            'estrela' => $this->tinyInteger()->notNull(),
            'experiencia_id' => $this->integer()->notNull(),
            'turista_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->null(),
        ], $tableOptions);
        $this->createIndex('idx_avaliacoes_experiencia_id', 'avaliacoes', 'experiencia_id');
        $this->createIndex('idx_avaliacoes_turista_id', 'avaliacoes', 'turista_id');
        $this->createIndex('idx_avaliacoes_user_id', 'avaliacoes', 'user_id');
        $this->createIndex('uidx_avaliacoes_experiencia_turista', 'avaliacoes', ['experiencia_id', 'turista_id'], true);
        $this->addForeignKey('fk_avaliacoes_experiencia', 'avaliacoes', 'experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_avaliacoes_turista', 'avaliacoes', 'turista_id', 'turistas', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_avaliacoes_user', 'avaliacoes', 'user_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

        // Favoritos
        $this->createTable('favoritos', [
            'id' => $this->primaryKey(),
            'experiencia_id' => $this->integer()->notNull(),
            'turista_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->null(),
        ], $tableOptions);
        $this->createIndex('idx_favoritos_experiencia_id', 'favoritos', 'experiencia_id');
        $this->createIndex('idx_favoritos_turista_id', 'favoritos', 'turista_id');
        $this->createIndex('idx_favoritos_user_id', 'favoritos', 'user_id');
        $this->createIndex('uidx_favoritos_experiencia_turista', 'favoritos', ['experiencia_id', 'turista_id'], true);
        $this->addForeignKey('fk_favoritos_experiencia', 'favoritos', 'experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_favoritos_turista', 'favoritos', 'turista_id', 'turistas', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_favoritos_user', 'favoritos', 'user_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');

        // Reservas
        $this->createTable('reservas', [
            'id' => $this->primaryKey(),
            'dataReserva' => $this->date()->null(),
            'disponivel' => $this->integer()->null(),
            'numPessoas' => $this->integer()->notNull(),
            'experiencia_id' => $this->integer()->notNull(),
            'turista_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->null(),
            'metodoPagamento_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx_reservas_experiencia_id', 'reservas', 'experiencia_id');
        $this->createIndex('idx_reservas_turista_id', 'reservas', 'turista_id');
        $this->createIndex('idx_reservas_user_id', 'reservas', 'user_id');
        $this->createIndex('idx_reservas_metodoPagamento_id', 'reservas', 'metodoPagamento_id');
        $this->addForeignKey('fk_reservas_experiencia', 'reservas', 'experiencia_id', 'experiencias', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_reservas_turista', 'reservas', 'turista_id', 'turistas', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_reservas_user', 'reservas', 'user_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_reservas_metodoPagamento', 'reservas', 'metodoPagamento_id', 'metodopagamentos', 'id', 'RESTRICT', 'CASCADE');
    }

    public function safeDown()
    {
        // Ordem inversa por causa das FKs
        $this->dropTable('reservas');
        $this->dropTable('favoritos');
        $this->dropTable('avaliacoes');
        $this->dropTable('comentarios');
        $this->dropTable('experiencias');
        $this->dropTable('turistas');
        $this->dropTable('gestores');
        $this->dropTable('metodopagamentos');
        $this->dropTable('linguas');
        $this->dropTable('paises');
        $this->dropTable('categorias');
    }
}



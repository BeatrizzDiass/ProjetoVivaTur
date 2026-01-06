<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class ComentarioTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    
    // Teste que mostra comentários da experiência 1
    public function testComentariosExperiencia1()
    {
        // Contar quantos comentários tem a experiência 1
        $totalComentarios = $this->tester->grabNumRecords('comentarios', ['experiencia_id' => 1]);
        
        echo "\n=== COMENTÁRIOS DA EXPERIÊNCIA 1 ===\n";
        echo "Total de Comentários: " . $totalComentarios . "\n\n";
        
        if ($totalComentarios > 0) {
            // Buscar dados dos comentários
            $descricoes = $this->tester->grabColumnFromDatabase('comentarios', 'descricao', ['experiencia_id' => 1]);
            $datas = $this->tester->grabColumnFromDatabase('comentarios', 'dataCriacao', ['experiencia_id' => 1]);
            $usuarios = $this->tester->grabColumnFromDatabase('comentarios', 'user_id', ['experiencia_id' => 1]);
            
            // Mostrar cada comentário
            for ($i = 0; $i < count($descricoes); $i++) {
                echo "Comentário " . ($i + 1) . ":\n";
                echo " Descrição: " . $descricoes[$i] . "\n";
                echo " Data: " . $datas[$i] . "\n";
                echo " User ID: " . $usuarios[$i] . "\n\n";
            }
        } else {
            echo "Nenhum comentário encontrado.\n";
        }
        
        echo "====================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalComentarios);
    }
    
    // Teste que mostra todos os comentários (de todas as experiências)
    public function testTodosComentarios()
    {
        $total = $this->tester->grabNumRecords('comentarios');
        
        echo "\n=== TODOS OS COMENTÁRIOS ===\n";
        echo "Total Geral: " . $total . "\n\n";
        
        if ($total > 0) {
            $experiencias = $this->tester->grabColumnFromDatabase('comentarios', 'experiencia_id');
            $descricoes = $this->tester->grabColumnFromDatabase('comentarios', 'descricao');
            
            for ($i = 0; $i < count($experiencias); $i++) {
                echo "Experiência ID " . $experiencias[$i] . ": " . $descricoes[$i] . "\n";
            }
        }
        
        echo "============================\n";
        
        $this->assertGreaterThan(0, $total);
    }
    
    // Teste que verifica se existe comentário para experiência 1
    public function testComentarioExiste()
    {
        $this->tester->seeInDatabase('comentarios', [
            'experiencia_id' => 1
        ]);
        
        echo "\n Existe pelo menos 1 comentário para experiência 1!\n";
    }
    
    // Teste que mostra detalhes completos de um comentário
    public function testDetalhesComentario()
    {
        $id = $this->tester->grabFromDatabase('comentarios', 'id', ['experiencia_id' => 1]);
        $descricao = $this->tester->grabFromDatabase('comentarios', 'descricao', ['experiencia_id' => 1]);
        $dataCriacao = $this->tester->grabFromDatabase('comentarios', 'dataCriacao', ['experiencia_id' => 1]);
        $userId = $this->tester->grabFromDatabase('comentarios', 'user_id', ['experiencia_id' => 1]);
        $turistaId = $this->tester->grabFromDatabase('comentarios', 'turista_id', ['experiencia_id' => 1]);
        $resposta = $this->tester->grabFromDatabase('comentarios', 'resposta', ['experiencia_id' => 1]);
        $dataResposta = $this->tester->grabFromDatabase('comentarios', 'dataResposta', ['experiencia_id' => 1]);
        
        echo "\n=== DETALHES DO COMENTÁRIO ===\n";
        echo "ID: " . $id . "\n";
        echo "Experiência ID: 1\n";
        echo "Descrição: " . $descricao . "\n";
        echo "Data Criação: " . $dataCriacao . "\n";
        echo "User ID: " . $userId . "\n";
        echo "Turista ID: " . $turistaId . "\n";
        
        if ($resposta) {
            echo "\n RESPOSTA:\n";
            echo "Resposta: " . $resposta . "\n";
            echo "Data Resposta: " . $dataResposta . "\n";
        } else {
            echo "\n Sem resposta ainda.\n";
        }
        
        echo "==============================\n";
        
        $this->assertNotEmpty($descricao);
    }
    
    // Teste que mostra comentários COM resposta
    public function testComentariosComResposta()
    {
        // Buscar todos os comentários e filtrar os que têm resposta
        $total = $this->tester->grabNumRecords('comentarios');
        $respostas = $this->tester->grabColumnFromDatabase('comentarios', 'resposta');
        
        $totalComResposta = 0;
        foreach ($respostas as $resposta) {
            if ($resposta !== null && $resposta !== '') {
                $totalComResposta++;
            }
        }
        
        echo "\n=== COMENTÁRIOS COM RESPOSTA ===\n";
        echo "Total: " . $totalComResposta . "\n\n";
        
        if ($totalComResposta > 0) {
            echo " Comentários respondidos encontrados!\n";
        } else {
            echo " Nenhum comentário foi respondido ainda.\n";
        }
        
        echo "================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalComResposta);
    }
    
    // Teste que mostra comentários SEM resposta
    public function testComentariosSemResposta()
    {
        // Buscar todos os comentários e filtrar os que NÃO têm resposta
        $descricoes = $this->tester->grabColumnFromDatabase('comentarios', 'descricao');
        $respostas = $this->tester->grabColumnFromDatabase('comentarios', 'resposta');
        
        $semResposta = [];
        for ($i = 0; $i < count($respostas); $i++) {
            if ($respostas[$i] === null || $respostas[$i] === '') {
                $semResposta[] = $descricoes[$i];
            }
        }
        
        $totalSemResposta = count($semResposta);
        
        echo "\n=== COMENTÁRIOS SEM RESPOSTA ===\n";
        echo "Total pendente: " . $totalSemResposta . "\n";
        
        if ($totalSemResposta > 0) {
            echo "\nComentários aguardando resposta:\n";
            for ($i = 0; $i < count($semResposta); $i++) {
                echo ($i + 1) . ". " . $semResposta[$i] . "\n";
            }
        } else {
            echo " Todos os comentários foram respondidos!\n";
        }
        
        echo "================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalSemResposta);
    }
}
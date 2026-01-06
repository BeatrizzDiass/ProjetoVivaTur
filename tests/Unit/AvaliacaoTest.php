<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class AvaliacaoTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    
    // Teste que mostra avaliações da experiência 1
    public function testAvaliacoesExperiencia1()
    {
        // Contar quantas avaliações tem a experiência 1
        $totalAvaliacoes = $this->tester->grabNumRecords('avaliacoes', ['experiencia_id' => 1]);
        
        echo "\n=== AVALIAÇÕES DA EXPERIÊNCIA 1 ===\n";
        echo "Total de Avaliações: " . $totalAvaliacoes . "\n\n";
        
        if ($totalAvaliacoes > 0) {
            // Buscar dados das avaliações
            $estrelas = $this->tester->grabColumnFromDatabase('avaliacoes', 'estrela', ['experiencia_id' => 1]);
            $usuarios = $this->tester->grabColumnFromDatabase('avaliacoes', 'user_id', ['experiencia_id' => 1]);
            
            // Mostrar cada avaliação
            for ($i = 0; $i < count($estrelas); $i++) {
                echo "Avaliação " . ($i + 1) . ":\n";
                echo "  ⭐ Estrelas: " . $estrelas[$i] . "\n";
                echo "  👤 User ID: " . $usuarios[$i] . "\n\n";
            }
            
            // Calcular média
            $media = array_sum($estrelas) / count($estrelas);
            echo "📊 Média de Avaliação: " . number_format($media, 2) . " estrelas\n";
        } else {
            echo "❌ Nenhuma avaliação encontrada.\n";
        }
        
        echo "====================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalAvaliacoes);
    }
    
    // Teste que mostra todas as avaliações (de todas as experiências)
    public function testTodasAvaliacoes()
    {
        $total = $this->tester->grabNumRecords('avaliacoes');
        
        echo "\n=== TODAS AS AVALIAÇÕES ===\n";
        echo "Total Geral: " . $total . "\n\n";
        
        if ($total > 0) {
            $experiencias = $this->tester->grabColumnFromDatabase('avaliacoes', 'experiencia_id');
            $estrelas = $this->tester->grabColumnFromDatabase('avaliacoes', 'estrela');
            
            for ($i = 0; $i < count($experiencias); $i++) {
                echo "Experiência ID " . $experiencias[$i] . " - " . $estrelas[$i] . " ⭐\n";
            }
        }
        
        echo "===========================\n";
        
        $this->assertGreaterThan(0, $total);
    }
    
    // Teste que verifica se existe avaliação específica
    public function testAvaliacaoExiste()
    {
        $this->tester->seeInDatabase('avaliacoes', [
            'experiencia_id' => 1
        ]);
        
        echo "\n✅ Existe pelo menos 1 avaliação para experiência 1!\n";
    }
    
    // Teste que mostra detalhes completos de uma avaliação
    public function testDetalhesAvaliacao()
    {
        $id = $this->tester->grabFromDatabase('avaliacoes', 'id', ['experiencia_id' => 1]);
        $estrela = $this->tester->grabFromDatabase('avaliacoes', 'estrela', ['experiencia_id' => 1]);
        $userId = $this->tester->grabFromDatabase('avaliacoes', 'user_id', ['experiencia_id' => 1]);
        $turistaId = $this->tester->grabFromDatabase('avaliacoes', 'turista_id', ['experiencia_id' => 1]);
        
        echo "\n=== DETALHES DA AVALIAÇÃO ===\n";
        echo "ID: " . $id . "\n";
        echo "Experiência ID: 1\n";
        echo "Estrelas: " . $estrela . " ⭐\n";
        echo "User ID: " . $userId . "\n";
        echo "Turista ID: " . $turistaId . "\n";
        echo "=============================\n";
        
        $this->assertNotEmpty($estrela);
    }
    
    // Teste que calcula média de avaliações de todas as experiências
    public function testMediaGeralAvaliacoes()
    {
        $total = $this->tester->grabNumRecords('avaliacoes');
        
        if ($total > 0) {
            $estrelas = $this->tester->grabColumnFromDatabase('avaliacoes', 'estrela');
            $media = array_sum($estrelas) / count($estrelas);
            
            echo "\n=== ESTATÍSTICAS GERAIS ===\n";
            echo "Total de Avaliações: " . $total . "\n";
            echo "Média Geral: " . number_format($media, 2) . " ⭐\n";
            echo "Maior Nota: " . max($estrelas) . " ⭐\n";
            echo "Menor Nota: " . min($estrelas) . " ⭐\n";
            echo "===========================\n";
            
            $this->assertGreaterThan(0, $media);
        }
    }
}
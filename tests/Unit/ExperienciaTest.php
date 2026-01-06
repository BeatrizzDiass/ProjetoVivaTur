<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class ExperienciaTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    
    // Teste que busca e mostra UMA experiência da BD
    public function testMostrarExperienciaDoBanco()
    {
        // Buscar experiência com ID 1
        $nome = $this->tester->grabFromDatabase('experiencias', 'nome', ['id' => 1]);
        $descricao = $this->tester->grabFromDatabase('experiencias', 'descricao', ['id' => 1]);
        $preco = $this->tester->grabFromDatabase('experiencias', 'precoPessoa', ['id' => 1]);
        $local = $this->tester->grabFromDatabase('experiencias', 'local', ['id' => 1]);
        $duracao = $this->tester->grabFromDatabase('experiencias', 'duracao', ['id' => 1]);
        
        echo "\n=== EXPERIÊNCIA DO BANCO ===\n";
        echo "Nome: " . $nome . "\n";
        echo "Descrição: " . $descricao . "\n";
        echo "Local: " . $local . "\n";
        echo "Duração: " . $duracao . "\n";
        echo "Preço por Pessoa: €" . $preco . "\n";
        echo "===========================\n";
        
        $this->assertNotEmpty($nome);
    }
    
    // Teste que mostra TODAS as experiências
    public function testMostrarTodasExperiencias()
    {
        // Contar quantas experiências existem
        $total = $this->tester->grabNumRecords('experiencias');
        
        echo "\n=== TOTAL DE EXPERIÊNCIAS: $total ===\n\n";
        
        // Buscar todas
        $nomes = $this->tester->grabColumnFromDatabase('experiencias', 'nome');
        $precos = $this->tester->grabColumnFromDatabase('experiencias', 'precoPessoa');
        
        for ($i = 0; $i < count($nomes); $i++) {
            echo ($i + 1) . ". " . $nomes[$i] . " - €" . $precos[$i] . "\n";
        }
        echo "\n==============================\n";
        
        $this->assertGreaterThan(0, $total);
    }
    
    // Teste que verifica se experiência existe
    public function testExperienciaExiste()
    {
        $this->tester->seeInDatabase('experiencias', ['id' => 1]);
        echo "\n✓ Experiência com ID 1 existe!\n";
    }
    
    // Teste que mostra detalhes completos
    public function testDetalhesCompletos()
    {
        $id = $this->tester->grabFromDatabase('experiencias', 'id', ['id' => 1]);
        $nome = $this->tester->grabFromDatabase('experiencias', 'nome', ['id' => 1]);
        $descricao = $this->tester->grabFromDatabase('experiencias', 'descricao', ['id' => 1]);
        $horaInicio = $this->tester->grabFromDatabase('experiencias', 'horaInicio', ['id' => 1]);
        $horaFim = $this->tester->grabFromDatabase('experiencias', 'horaFim', ['id' => 1]);
        $duracao = $this->tester->grabFromDatabase('experiencias', 'duracao', ['id' => 1]);
        $local = $this->tester->grabFromDatabase('experiencias', 'local', ['id' => 1]);
        $dataDisponivel = $this->tester->grabFromDatabase('experiencias', 'dataDisponivel', ['id' => 1]);
        $preco = $this->tester->grabFromDatabase('experiencias', 'precoPessoa', ['id' => 1]);
        $numMax = $this->tester->grabFromDatabase('experiencias', 'numMaxParticipante', ['id' => 1]);
        $numMin = $this->tester->grabFromDatabase('experiencias', 'numMinParticipante', ['id' => 1]);
        
        echo "\n=== DETALHES COMPLETOS ===\n";
        echo "ID: " . $id . "\n";
        echo "Nome: " . $nome . "\n";
        echo "Descrição: " . $descricao . "\n";
        echo "Hora Início: " . $horaInicio . "\n";
        echo "Hora Fim: " . $horaFim . "\n";
        echo "Duração: " . $duracao . "\n";
        echo "Local: " . $local . "\n";
        echo "Data Disponível: " . $dataDisponivel . "\n";
        echo "Preço/Pessoa: €" . $preco . "\n";
        echo "Nº Máx Participantes: " . $numMax . "\n";
        echo "Nº Min Participantes: " . $numMin . "\n";
        echo "==========================\n";
        
        $this->assertNotEmpty($nome);
    }
}
<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class ReservaTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    
    // Teste que mostra reservas da experiência 1
    public function testReservasExperiencia1()
    {
        // Contar quantas reservas tem a experiência 1
        $totalReservas = $this->tester->grabNumRecords('reservas', ['experiencia_id' => 1]);
        
        echo "\n=== RESERVAS DA EXPERIÊNCIA 1 ===\n";
        echo "Total de Reservas: " . $totalReservas . "\n\n";
        
        if ($totalReservas > 0) {
            // Buscar dados das reservas
            $datas = $this->tester->grabColumnFromDatabase('reservas', 'dataReserva', ['experiencia_id' => 1]);
            $numPessoas = $this->tester->grabColumnFromDatabase('reservas', 'numPessoas', ['experiencia_id' => 1]);
            $disponiveis = $this->tester->grabColumnFromDatabase('reservas', 'disponivel', ['experiencia_id' => 1]);
            
            // Mostrar cada reserva
            for ($i = 0; $i < count($datas); $i++) {
                echo "Reserva " . ($i + 1) . ":\n";
                echo "   Data: " . $datas[$i] . "\n";
                echo "   Nº Pessoas: " . $numPessoas[$i] . "\n";
                echo "   Disponível: " . $disponiveis[$i] . "\n\n";
            }
            
            // Calcular total de pessoas
            $totalPessoas = array_sum($numPessoas);
            echo " Total de Pessoas: " . $totalPessoas . "\n";
        } else {
            echo " Nenhuma reserva encontrada.\n";
        }
        
        echo "==================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalReservas);
    }
    
    // Teste que mostra todas as reservas
    public function testTodasReservas()
    {
        $total = $this->tester->grabNumRecords('reservas');
        
        echo "\n=== TODAS AS RESERVAS ===\n";
        echo "Total Geral: " . $total . "\n\n";
        
        if ($total > 0) {
            $experiencias = $this->tester->grabColumnFromDatabase('reservas', 'experiencia_id');
            $datas = $this->tester->grabColumnFromDatabase('reservas', 'dataReserva');
            $numPessoas = $this->tester->grabColumnFromDatabase('reservas', 'numPessoas');
            
            for ($i = 0; $i < count($experiencias); $i++) {
                echo "Exp ID " . $experiencias[$i] . " - " . $datas[$i] . " - " . $numPessoas[$i] . " pessoas\n";
            }
        }
        
        echo "=========================\n";
        
        $this->assertGreaterThan(0, $total);
    }
    
    // Teste que verifica se existe reserva para experiência 1
    public function testReservaExiste()
    {
        $this->tester->seeInDatabase('reservas', [
            'experiencia_id' => 1
        ]);
        
        echo "\n Existe pelo menos 1 reserva para experiência 1!\n";
    }
    
    // Teste que mostra detalhes completos de uma reserva
    public function testDetalhesReserva()
    {
        $id = $this->tester->grabFromDatabase('reservas', 'id', ['experiencia_id' => 1]);
        $dataReserva = $this->tester->grabFromDatabase('reservas', 'dataReserva', ['experiencia_id' => 1]);
        $disponivel = $this->tester->grabFromDatabase('reservas', 'disponivel', ['experiencia_id' => 1]);
        $numPessoas = $this->tester->grabFromDatabase('reservas', 'numPessoas', ['experiencia_id' => 1]);
        $userId = $this->tester->grabFromDatabase('reservas', 'user_id', ['experiencia_id' => 1]);
        $metodoPagamentoId = $this->tester->grabFromDatabase('reservas', 'metodoPagamento_id', ['experiencia_id' => 1]);
        $turistaId = $this->tester->grabFromDatabase('reservas', 'turista_id', ['experiencia_id' => 1]);
        
        echo "\n=== DETALHES DA RESERVA ===\n";
        echo "ID: " . $id . "\n";
        echo "Experiência ID: 1\n";
        echo "Data Reserva: " . $dataReserva . "\n";
        echo "Disponível: " . $disponivel . "\n";
        echo "Nº Pessoas: " . $numPessoas . "\n";
        echo "User ID: " . $userId . "\n";
        echo "Método Pagamento ID: " . $metodoPagamentoId . "\n";
        echo "Turista ID: " . $turistaId . "\n";
        echo "===========================\n";
        
        $this->assertNotEmpty($dataReserva);
    }
    
    // Teste que mostra reservas disponíveis
    public function testReservasDisponiveis()
    {
        // Buscar todas as reservas disponíveis
        $datas = $this->tester->grabColumnFromDatabase('reservas', 'dataReserva');
        $disponiveis = $this->tester->grabColumnFromDatabase('reservas', 'disponivel');
        $experiencias = $this->tester->grabColumnFromDatabase('reservas', 'experiencia_id');
        
        $reservasDisponiveis = [];
        for ($i = 0; $i < count($disponiveis); $i++) {
            if ($disponiveis[$i] === 'sim' || $disponiveis[$i] === '1' || $disponiveis[$i] === 1) {
                $reservasDisponiveis[] = [
                    'exp_id' => $experiencias[$i],
                    'data' => $datas[$i]
                ];
            }
        }
        
        $totalDisponiveis = count($reservasDisponiveis);
        
        echo "\n=== RESERVAS DISPONÍVEIS ===\n";
        echo "Total: " . $totalDisponiveis . "\n\n";
        
        if ($totalDisponiveis > 0) {
            foreach ($reservasDisponiveis as $index => $reserva) {
                echo ($index + 1) . ". Experiência " . $reserva['exp_id'] . " - " . $reserva['data'] . "\n";
            }
        } else {
            echo " Nenhuma reserva disponível no momento.\n";
        }
        
        echo "============================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalDisponiveis);
    }
    
    // Teste que calcula estatísticas de reservas
    public function testEstatisticasReservas()
    {
        $total = $this->tester->grabNumRecords('reservas');
        
        if ($total > 0) {
            $numPessoas = $this->tester->grabColumnFromDatabase('reservas', 'numPessoas');
            
            // Remover valores null
            $numPessoas = array_filter($numPessoas, function($val) {
                return $val !== null;
            });
            
            if (count($numPessoas) > 0) {
                $totalPessoas = array_sum($numPessoas);
                $mediaPessoas = $totalPessoas / count($numPessoas);
                $maxPessoas = max($numPessoas);
                $minPessoas = min($numPessoas);
                
                echo "\n=== ESTATÍSTICAS DE RESERVAS ===\n";
                echo "Total de Reservas: " . $total . "\n";
                echo "Total de Pessoas: " . $totalPessoas . "\n";
                echo "Média de Pessoas/Reserva: " . number_format($mediaPessoas, 2) . "\n";
                echo "Maior Grupo: " . $maxPessoas . " pessoas\n";
                echo "Menor Grupo: " . $minPessoas . " pessoas\n";
                echo "================================\n";
                
                $this->assertGreaterThan(0, $totalPessoas);
            }
        }
    }
}
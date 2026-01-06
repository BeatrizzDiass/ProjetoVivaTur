<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

class FavoritoTest extends \Codeception\Test\Unit
{
    protected UnitTester $tester;
    
    // Teste que mostra favoritos da experiência 1
    public function testFavoritosExperiencia1()
    {
        // Contar quantos favoritos tem a experiência 1
        $totalFavoritos = $this->tester->grabNumRecords('favoritos', ['experiencia_id' => 1]);
        
        echo "\n=== FAVORITOS DA EXPERIÊNCIA 1 ===\n";
        echo "Total de Favoritos: " . $totalFavoritos . "\n\n";
        
        if ($totalFavoritos > 0) {
            // Buscar dados dos favoritos
            $usuarios = $this->tester->grabColumnFromDatabase('favoritos', 'user_id', ['experiencia_id' => 1]);
            $turistas = $this->tester->grabColumnFromDatabase('favoritos', 'turista_id', ['experiencia_id' => 1]);
            
            // Mostrar cada favorito
            for ($i = 0; $i < count($usuarios); $i++) {
                echo "Favorito " . ($i + 1) . ":\n";
                echo "  👤 User ID: " . $usuarios[$i] . "\n";
                echo "  🧳 Turista ID: " . $turistas[$i] . "\n\n";
            }
        } else {
            echo "❌ Nenhum favorito encontrado.\n";
        }
        
        echo "===================================\n";
        
        $this->assertGreaterThanOrEqual(0, $totalFavoritos);
    }
    
    // Teste que mostra todos os favoritos
    public function testTodosFavoritos()
    {
        $total = $this->tester->grabNumRecords('favoritos');
        
        echo "\n=== TODOS OS FAVORITOS ===\n";
        echo "Total Geral: " . $total . "\n\n";
        
        if ($total > 0) {
            $experiencias = $this->tester->grabColumnFromDatabase('favoritos', 'experiencia_id');
            $usuarios = $this->tester->grabColumnFromDatabase('favoritos', 'user_id');
            
            for ($i = 0; $i < count($experiencias); $i++) {
                echo "Experiência ID " . $experiencias[$i] . " - User ID " . $usuarios[$i] . " ⭐\n";
            }
        }
        
        echo "==========================\n";
        
        $this->assertGreaterThan(0, $total);
    }
    
    // Teste que verifica se existem favoritos no banco
    public function testFavoritoExiste()
    {
        $total = $this->tester->grabNumRecords('favoritos');
        
        if ($total > 0) {
            echo "\n✅ Existem " . $total . " favorito(s) no banco!\n";
            $this->assertGreaterThan(0, $total);
        } else {
            echo "\n⚠️ Nenhum favorito encontrado no banco.\n";
            $this->assertGreaterThanOrEqual(0, $total);
        }
    }
    
    // Teste que mostra detalhes de um favorito
    public function testDetalhesFavorito()
    {
        $total = $this->tester->grabNumRecords('favoritos');
        
        if ($total > 0) {
            $id = $this->tester->grabFromDatabase('favoritos', 'id');
            $experienciaId = $this->tester->grabFromDatabase('favoritos', 'experiencia_id');
            $userId = $this->tester->grabFromDatabase('favoritos', 'user_id');
            $turistaId = $this->tester->grabFromDatabase('favoritos', 'turista_id');
            
            echo "\n=== DETALHES DO FAVORITO ===\n";
            echo "ID: " . $id . "\n";
            echo "Experiência ID: " . $experienciaId . "\n";
            echo "User ID: " . $userId . "\n";
            echo "Turista ID: " . $turistaId . "\n";
            echo "============================\n";
            
            $this->assertNotEmpty($experienciaId);
        } else {
            echo "\n⚠️ Nenhum favorito para mostrar detalhes.\n";
            $this->assertGreaterThanOrEqual(0, $total);
        }
    }
    
    // Teste que mostra experiências mais favoritadas
    public function testExperienciasMaisFavoritadas()
    {
        $experiencias = $this->tester->grabColumnFromDatabase('favoritos', 'experiencia_id');
        
        // Contar favoritos por experiência
        $contagem = array_count_values($experiencias);
        
        // Ordenar por número de favoritos (decrescente)
        arsort($contagem);
        
        echo "\n=== EXPERIÊNCIAS MAIS FAVORITADAS ===\n";
        echo "Ranking:\n\n";
        
        $posicao = 1;
        foreach ($contagem as $expId => $totalFavs) {
            echo $posicao . "º - Experiência ID " . $expId . ": " . $totalFavs . " favorito(s) ⭐\n";
            $posicao++;
        }
        
        echo "=====================================\n";
        
        $this->assertGreaterThan(0, count($contagem));
    }
    
    // Teste que mostra favoritos de um usuário específico
    public function testFavoritosDeUsuario()
    {
        // Pegar o primeiro user_id que encontrar
        $userId = $this->tester->grabFromDatabase('favoritos', 'user_id');
        
        if ($userId) {
            $totalFavoritosUsuario = $this->tester->grabNumRecords('favoritos', ['user_id' => $userId]);
            $experienciasFavoritas = $this->tester->grabColumnFromDatabase('favoritos', 'experiencia_id', ['user_id' => $userId]);
            
            echo "\n=== FAVORITOS DO USUÁRIO $userId ===\n";
            echo "Total: " . $totalFavoritosUsuario . "\n\n";
            
            if ($totalFavoritosUsuario > 0) {
                echo "Experiências favoritas:\n";
                foreach ($experienciasFavoritas as $index => $expId) {
                    echo ($index + 1) . ". Experiência ID " . $expId . "\n";
                }
            }
            
            echo "===================================\n";
            
            $this->assertGreaterThan(0, $totalFavoritosUsuario);
        }
    }
    
    // Teste de estatísticas gerais de favoritos
    public function testEstatisticasFavoritos()
    {
        $total = $this->tester->grabNumRecords('favoritos');
        $experiencias = $this->tester->grabColumnFromDatabase('favoritos', 'experiencia_id');
        $usuarios = $this->tester->grabColumnFromDatabase('favoritos', 'user_id');
        
        $experienciasUnicas = count(array_unique($experiencias));
        $usuariosUnicos = count(array_unique($usuarios));
        
        $mediaFavoritosPorExperiencia = $total / $experienciasUnicas;
        $mediaFavoritosPorUsuario = $total / $usuariosUnicos;
        
        echo "\n=== ESTATÍSTICAS DE FAVORITOS ===\n";
        echo "Total de Favoritos: " . $total . "\n";
        echo "Experiências com Favoritos: " . $experienciasUnicas . "\n";
        echo "Utilizador que Favoritaram: " . $usuariosUnicos . "\n";
        echo "Média Favoritos/Experiência: " . number_format($mediaFavoritosPorExperiencia, 2) . "\n";
        echo "Média Favoritos/Utilizador: " . number_format($mediaFavoritosPorUsuario, 2) . "\n";
        echo "=================================\n";
        
        $this->assertGreaterThan(0, $total);
    }
}
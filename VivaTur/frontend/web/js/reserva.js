$(document).ready(function() {
    var $quantidade = $('#quantidade');
    var max = parseInt($quantidade.attr('max'));
    var min = parseInt($quantidade.attr('min'));
    var precoPorPessoa = parseFloat($quantidade.data('preco'));

    // Função para atualizar o preço total
    function atualizarPrecoTotal() {
        var quantidade = parseInt($quantidade.val()) || min;
        var total = (quantidade * precoPorPessoa).toFixed(2);
        $('#preco-total').text(total + '€');
        atualizarBotoes(quantidade);
    }

    // Função para atualizar estado dos botões
    function atualizarBotoes(quantidade) {
        $('#menos').prop('disabled', quantidade <= min);
        $('#mais').prop('disabled', quantidade >= max);
    }

    // Botão mais
    $('#mais').click(function() {
        var atual = parseInt($quantidade.val()) || min;
        if (atual < max) {
            $quantidade.val(atual + 1);
            atualizarPrecoTotal();
        }
    });

    // Botão menos
    $('#menos').click(function() {
        var atual = parseInt($quantidade.val()) || min;
        if (atual > min) {
            $quantidade.val(atual - 1);
            atualizarPrecoTotal();
        }
    });

    // Validação quando digitar diretamente
    $quantidade.on('input change', function() {
        var valor = parseInt($(this).val());

        if (isNaN(valor) || valor < min) {
            $(this).val(min);
        } else if (valor > max) {
            $(this).val(max);
        }

        atualizarPrecoTotal();
    });

    // Inicializar
    atualizarPrecoTotal();
});
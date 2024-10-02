$(document).ready(function (){
    $("#insert").click(function() {
        $("#Fazer").append("<tr> <td></td> <td><b><input type='text' class='descricao' style='background-color: #118bee15'></b></td> <td><input readonly type='datetime-local' id='data' name='data'></td> <td><a onclick='SalvarNovo(this)'>Salvar</a></td></tr>");
    });

    $('.descricao').blur(function (){
        SalvarNovo(this);
    });

});

function SalvarNovo(elemento){
    var teste =  elemento;
}

function AlterarStatus(Id) {

    let dados = {
        function: "AlterarStatus",
        id: Id

    };

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'app/ajax/funcoes.php',
        async: true,
        data: dados,
        success: function (data) {
            // Verifique a resposta do servidor, supondo que ele retorna a nova linha a ser inserida
            if (data.success) {
                $('#Feitas').append(data.html);
            } else {
                console.log('Erro ao alterar status:', data.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro na requisição AJAX:", error);
        }
    });

    $("#" + Id).remove();



}

function Editar(Id) {
    // Seleciona a tabela
    var linha = document.getElementById(Id);

    // Obtém o primeiro input do tipo text na tabela
    linha.querySelector('input[type="text"]').removeAttribute('readonly');
    linha.querySelector('#acoes').innerHTML = "<a onclick='SalvarAlteracoes(" + Id + ")'>Salvar</a>";



}

function SalvarAlteracoes(Id) {
    var linha = $("#" + Id);
    var descricao = linha.querySelector('input[type="text"]').value;
    let dados = {
        function: "SalvarAlteracoes",
        id: Id,
        descricao: descricao

    };

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'app/ajax/funcoes.php',
        async: true,
        data: dados,
        success: function (response) {
            var teste = response.objeto;
            console.log(teste.descricao);

        }
    });

    linha.querySelector('input[type="text"]').setAttribute('readonly', '');
    linha.querySelector('#acoes').innerHTML = "<a onclick='Editar(" + Id + ")'>Editar</a> <a onclick='return confirmarExclusao()'>Apagar</a> ";
}

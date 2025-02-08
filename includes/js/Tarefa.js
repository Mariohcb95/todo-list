$(document).ready(function (){
    $("#insert").click(function() {
            $("#Fazer").append("<tr class='novo'> <td><input type='checkbox'></td> <td><b><input type='text' class='novo' style='background-color: #118bee15'></b></td> <td><input readonly type='datetime-local' id='data' name='data'></td> <td></td></tr>");
            $(".novo").focus();
    });
    $("#Fazer").on('blur', 'input', function (){
        if ($(this).attr("readonly") === undefined){
            
            if ($(this).attr("class") == 'novo'){
                if ($(this).val() != ''){
                    SalvarNovo(this);
                } 
                else {
                    var tr = $(this).closest('tr');
                    tr.remove();
                    
                }

            } 
            else{
                var tr = $(this).closest('tr');
                var id = tr.attr("id");
                if ($(this).val() != ''){
                    SalvarAlteracoes(id);
                } 
                else {
                    $(this).focus();
                    $(this).attr("placeholder", "Campo obrigatório!");
                }
                

            }
        }
    });
});

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
                if (data.concluido){
                    $('#Feitas').append("<tr id='" + data.id + "'> <td><input onclick='AlterarStatus(" + data.id + ");' type='checkbox' checked></td> <td>" + data.descricao + "</td> <td>" + data.dt_criacao + "</td>  <td>" + data.dt_finalizacao + "</td></tr>");

                }
                    
                else {
                    $('#Fazer').append("'<tr id=" + data.id + "> <td><input onclick='AlterarStatus(" + data.id + ");' type='checkbox'></td> <td><b><input type='text' class='CmpDescricao' value='" + data.descricao + "' readonly style='background-color: #118bee15'></b></td> <td class='dt_criacao'><input readonly type='datetime-local' id='data' name='data' value='" + data.dt_criacao + "'></td> <td id='acoes'><a onclick='Editar(" + data.id + ")'>Editar</a> <a onclick='ConfirmarExclusao(" + data.id + ");'>Apagar</a></td> </tr>';");

                }
                    
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
    let inputText = linha.querySelector('input[type="text"]');
    inputText.removeAttribute('readonly');
    linha.querySelector('#acoes').innerHTML = "";

    inputText.focus();


}

function SalvarAlteracoes(Id) {
    var linha = document.getElementById(Id);
    var descricao = linha.querySelector('td input[type="text"]').value;
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

function SalvarNovo(obj){
    
    
    
    // var campo = obj.querySelector('td input');
    
    var valorCampo = obj.value;
    // var  = input.value;

    let dados = {
        function: "SalvarNovo",
        descricao: valorCampo

    };
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'app/ajax/funcoes.php',
        async: true,
        data: dados,
        success: function (data) {
            // var td = obj.closest('td');
            // var tr = td.closest('tr');
            $(".novo").remove();
            $('#Fazer').append("'<tr id=" + data.id + "> <td><input onclick='AlterarStatus(" + data.id + ");' type='checkbox'></td> <td><b><input type='text' class='CmpDescricao' value='" + data.descricao + "' readonly style='background-color: #118bee15'></b></td> <td class='dt_criacao'><input readonly type='datetime-local' id='data' name='data' value='" + data.dt_criacao + "'></td> <td id='acoes'><a onclick='Editar(" + data.id + ")'>Editar</a> <a onclick='ConfirmarExclusao(" + data.id + ");'>Apagar</a></td> </tr>';");
        },
        error: function (xhr, status, error) {
            console.error("Erro na requisição AJAX:", error);
        }
    });
}

function ConfirmarExclusao(id){
    //Excluindo tarefa
    if (confirm("Tem certeza que deseja apagar essa Tarefa?")){
        var dados = {
            function: "Apagar",
            id: id

        }
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'app/ajax/funcoes.php',
            async: true,
            data: dados,
            success: function (data) {
                alert("Tarefa apagada com sucesso!");
                $("#" + id).remove();
            },
            error: function (xhr, status, error) {
                console.error("Erro na requisição AJAX:", error);
            }
        });
    }

}
<?php
class TarefaView
{

    // Página inicial de Empresas (listagem)
    public function listTarefas($tarefas) {

        echo "<script src='https://code.jquery.com/jquery-1.12.4.js'></script> 
              <script src='includes/js/Tarefa.js'></script>
              <style>
                
                .Feitas tr td {
                    text-decoration: line-through;
                }
                .Feitas tr td:first-child {
                    text-decoration: none;
                }
              </style>";
        echo "<div style='place-items: center; display: grid;' >";
        echo "<button type='submit' id='insert'>Inserir Tarefa</button>";
        echo "<h3>Tarefas a Fazer</h3>";
        echo "<table id='Fazer' class='Fazer' border='1'>";
        echo "<tr><th></th><th>Descricao</th><th>Data Criação</th><th>Ações</th></tr>";
        foreach ($tarefas as $tarefa) {
            if ($tarefa->getConcluido() == false){
                echo "<tr id='{$tarefa->getId()}'>";
                echo "<td><input onclick='AlterarStatus({$tarefa->getId()});' type='checkbox' {$tarefa->getConcluido()}></td>";
                echo "<td><b><input type='text' class='CmpDescricao' value='{$tarefa->getDescricao()}' readonly style='background-color: #118bee15'></b></td>";
                echo "<td id='dt_criacao'><input readonly type='datetime-local' id='data' name='data' value='{$tarefa->getDt_criacao()}'></td>";
                echo "<td id='acoes'><a onclick='Editar({$tarefa->getId()})'>Editar</a> <a onclick='return confirmarExclusao()'>Apagar</a></td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</div>";

        echo "<div style='place-items: center; display: grid;' >";
        echo "<h4>Tarefas Feitas</h4>";
        echo "<table id='Feitas' class='Feitas' border='1'>";
        echo "<tr><th></th><th>Descricao</th><th>Data Criação</th><th>Data Conclusao</th></tr>";
        foreach ($tarefas as $tarefa) {
            if ($tarefa->getConcluido() == true){
                echo "<tr id='{$tarefa->getId()}'>";
                echo "<td><input onclick='AlterarStatus({$tarefa->getId()});' type='checkbox' {$tarefa->getConcluido()}></td>";
                echo "<td>{$tarefa->getDescricao()}</td>";
                echo "<td>{$tarefa->getDt_criacao()}</td>";
                echo "<td>{$tarefa->getDt_finalizacao()}</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        echo "</div>";

    }
}

<?php
class TarefaView
{

    // Página inicial de Empresas (listagem)
    public function listTarefas($tarefas) {

        echo "<div style='place-items: center; display: grid;' >";
        echo "<button type='submit' onclick=\"window.location.href='?route=tarefa&action=create'\">Inserir Tarefa</button>";
        echo "<h3>Lista de Tarefas</h3>";
        echo "<table border='1'>";
        echo "<tr><th></th><th>Descricao</th><th>Data Criação</th><th>Data Conclusao</th><th>Ações</th></tr>";
        foreach ($tarefas as $tarefa) {
            echo "<tr>";
            echo "<td><input type='checkbox' {$tarefa->getConcluido()}></td>";
            echo "<td>{$tarefa->getDescricao()}</td>";
            echo "<td>{$tarefa->getDt_criacao()}</td>";
            echo "<td>{$tarefa->getDt_finalizacao()}</td>";
            echo "<td><a href='?route=tarefa&action=update&id={$tarefa->getId()}'>Editar</a> <a href='?route=tarefa&action=delete&id={$tarefa->getId()}' onclick='return confirmarExclusao()'>Apagar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

    }
}

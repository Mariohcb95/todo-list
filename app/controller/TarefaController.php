<?php

include_once 'app/model/Tarefa.php';
include_once 'app/view/TarefaView.php';

class TarefaController {

    public function handleRequest($action,$params){


        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($action) ) {

            switch ($action) {

                case 'create':
                    
                    break;

                case 'update':

                    break;

            }


        }

        else {
            switch ($action) {

                // Listar as Tarefas
                case 'list':
                    
                    $tarefas = Tarefa::getAll();
                    $view = new TarefaView();
                    $view->listTarefas($tarefas);       
            }


        }

    }
}




?>
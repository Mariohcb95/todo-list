<?php
require_once __DIR__ . '/../Model/Tarefa.php';
header('Content-Type: application/json');

switch ($_POST['function']) {
    case 'AlterarStatus': {
        $id = $_POST['id'];
        $resposta = Tarefa::alterStatus($id);
        $tarefa = Tarefa::getById($id);
        // if ($resposta) {
            $response = [
                'success' => true,  // Indica que a operação foi bem-sucedida
                'html' => '<tr id='. $tarefa->getId() .'>
                    <td>'. $tarefa->getDescricao() .'</td>
                    <td>'. $tarefa->getDt_criacao() .'</td>
                    <td>'. $tarefa->getDt_finalizacao() .'</td
                </tr>'                
            ];
            echo json_encode($response);
        // }
        break;  
    }

    case 'SalvarAlteracoes': {
        $tarefa = new Tarefa($_POST['id'], $_POST['descricao'], null, null, null);

        if($tarefa->update()){
            $resposta = Tarefa::getById($id);
        }

        $response = array("success" => true, "objeto" => json_encode($tarefa));
        echo json_encode($response);
        break;
    }
}



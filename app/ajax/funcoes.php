<?php
require_once __DIR__ . '/../Model/Tarefa.php';
header('Content-Type: application/json');

switch ($_POST['function']) {
    case 'AlterarStatus': {
        $id = $_POST['id'];
        $resposta = Tarefa::alterStatus($id);
        $tarefa = Tarefa::getById($id);

        $response = [
            'success' => true,  // Indica que a operação foi bem-sucedida
            'id'=> $tarefa->getId(),
            'concluido' =>  $tarefa->getConcluidoBool(),
            'descricao' =>  $tarefa->getDescricao(),
            'dt_criacao' => $tarefa->getDt_criacao(),
            'dt_finalizacao' => $tarefa->getDt_finalizacao()
        ];
                    
        echo json_encode($response);

        break;
    }

    case 'SalvarAlteracoes': {
        $tarefa = new Tarefa($_POST['id'], $_POST['descricao'], null, null, null);

        if ($tarefa->update()) {
            $resposta = Tarefa::getById($id);
        }

        $response = [
            'success' => true,  // Indica que a operação foi bem-sucedida
            'json' => json_encode('{  
                        id:' . $resposta->getId() . ',
                        descricao:' . $resposta->getDescricao() . ',
                        dt_criacao:' . $resposta->getDt_criacao() . '
                     }')
        ];
        echo json_encode($response);
        break;
    }

    case 'SalvarNovo': {
        $tarefa = new Tarefa(null, $_POST['descricao'], null, null, null);

        if ($tarefa->create()) {
            $resposta = Tarefa::getById($id);
        }

        $response = [
            'success' => true,  // Indica que a operação foi bem-sucedida
            'json' => "{  
                        id:" . $resposta->getId() . ",
                        descricao:" . $resposta->getDescricao() . ",
                        dt_criacao:" . $resposta->getDt_criacao() . "
                     }"
        ];
        echo json_encode($response);
        break;
    }
}



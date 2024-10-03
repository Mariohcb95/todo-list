<?php
session_start();

include_once 'includes/header.php';

function loadController($controllerName)
{
    $file = 'app/controller/' . $controllerName . '.php';
    
    if (file_exists($file)) {
        include_once $file;
    } else {
        echo "Arquivo do controlador não encontrado";
        exit;
    }
}

$route = $_GET['route'] ?? 'index';
$action = $_GET['action'] ?? 'list';


$controllerName = ucfirst($route) . 'Controller';


loadController($controllerName);

//Controladores restritos
$restrictedControllers = ['TarefaController', 'UsuarioController'];

if (in_array($controllerName, $restrictedControllers)) {

    if (!isset($_SESSION['user_id'])) {

        //Redireciona para página de login
        header('Location: ?route=login');
        exit();
    }
}
if (class_exists($controllerName)) {

    // Instância o controlador
    $controller = new $controllerName();

    $params = array_merge($_POST, $_GET);

    // Lida com a requisicao
    $controller->handleRequest($action, $params);

}
else {
    echo "Página não encontrada";
}


include_once 'includes/footer.php';

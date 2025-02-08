<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App ToDo List</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    

</head>

<body>
    <header style="height: 100px;">
        <div style="text-align: left;">
            <nav style="display:inline-flex;">
                <img src="includes\img\logo.png" alt="Logo da Aplicação" width="100px" height="100px" >
                <ul>
                    <li><a href="/ToDo_list">Início</a></li>
                    <?php

                    if (!isset($_SESSION['user_id'])): ?>

                        <li><a href="?route=login">Login</a></li>

                    <?php endif; ?>


                    <?php

                    if (isset($_SESSION['user_id'])): ?>

                        <li><a href="?route=tarefa">Tarefas</a></li>
                        <li><a href="?route=login&action=logout">Logout</a></li>

                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main>
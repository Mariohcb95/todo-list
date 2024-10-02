<?php

include_once 'Database.php';
class Tarefa
{

    private $id;
    private $descricao;
    private $dt_criacao;
    private $dt_finalizacao;
    private $concluido;


    function __construct($id, $descricao, $dt_criacao, $dt_finalizacao, $concluido)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->dt_criacao = $dt_criacao;
        $this->dt_finalizacao = $dt_finalizacao;
        $this->concluido = $concluido;
    }
    //Getter e Setter

    function getId()
    {
        return $this->id;
    }
    function getDescricao()
    {
        return $this->descricao;
    }
    function getDt_criacao()
    {
        return $this->dt_criacao;
    }
    function getDt_finalizacao()
    {
        return $this->dt_finalizacao;
    }
    function getConcluido()
    {
        if ($this->concluido == 1){
            return 'checked';
        }
        return null;
    }

    function setId($id)
    {
        $this->id  = $id;
    }
    function setDescricao($descricao)
    {
        $this->descricao  = $descricao;
    }
    function setDt_criacao($dt_criacao)
    {
        $this->dt_criacao  = $dt_criacao;
    }
    function setDt_finalizacao($dt_finalizacao)
    {
        $this->dt_finalizacao  = $dt_finalizacao;
    }
    function setConcluido($concluido)
    {
        $this->concluido  = $concluido;
    }

   
    // Método para incluir Tarefa no BD
    function create()
    {

        // Obtém a conexão com o BD
        $db = Database::getInstance();
        $conn = $db->connect();

        // Preparar a consulta SQL
        $stmt = $conn->prepare("INSERT INTO tarefa (descricao, dt_criacao) VALUES (?,NOW())");
        $stmt->bind_param("ss", $this->descricao);

        // Executa consulta

        if ($stmt->execute()) {
            $stmt->close();
            $db->closeConnection();
            return true;
        } else {
            $stmt->close();
            $db->closeConnection();
            return false;
        }
    }

    // Método para atualizar Tarefa no BD
    function update()
    {
        // Obtém a conexão com o BD
        $db = Database::getInstance();
        $conn = $db->connect();

        // Preparar a consulta SQL
        $stmt = $conn->prepare("UPDATE tarefa set descricao = ? WHERE id = ?");
        $stmt->bind_param("si", $this->descricao, $this->id);

        // Executa consulta
        if ($stmt->execute()) {
            $stmt->close();
            $db->closeConnection();
            return true;
        } else {
            $stmt->close();
            $db->closeConnection();
            return false;
        }
    }

    // Método para apagar Tarefa no BD
    function delete()
    {
        // Obtém a conexão com o BD
        $db = Database::getInstance();
        $conn = $db->connect();

        // Preparar a consulta SQL
        $stmt = $conn->prepare("DELETE FROM tarefa WHERE id = ?");
        $stmt->bind_param("i", $this->id);

        // Executa consulta

        if ($stmt->execute()) {
            $stmt->close();
            $db->closeConnection();
            return true;
        } else {
            $stmt->close();
            $db->closeConnection();
            return false;
        }
    }


    static function getById($id)
    {
        $db = Database::getInstance();
        $conn = $db->connect();

        $stmt = $conn->prepare("SELECT * FROM tarefa WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $conn->close();
            return new Tarefa($row['id'], $row['descricao'], $row['dt_criacao'], $row['dt_finalizacao'], $row['concluido']);
        }
        $conn->close();
        return null;
    }

    static function getAll()
    {
        $db = Database::getInstance();
        $conn = $db->connect();

        $query = "SELECT * FROM tarefa";
        $result = $conn->query($query);

        $tarefas = [];

        while ($row = $result->fetch_assoc()){
            $tarefas[] = new Tarefa($row['id'], $row['descricao'], $row['dt_criacao'], $row['dt_finalizacao'], $row['concluido']);
        }

        $conn->close();
        return $tarefas;
    }

    static function alterStatus($id){
        // Obtém a conexão com o BD
        $db = Database::getInstance();
        $conn = $db->connect();

        // Preparar a consulta SQL
        $stmt = $conn->prepare("UPDATE tarefa set concluido = !concluido, dt_finalizacao = NOW() WHERE id = ?");
        $stmt->bind_param("i", $id);

        // Executa consulta
        if ($stmt->execute()) {
            $stmt->close();
            $db->closeConnection();
            return true;
        } else {
            $stmt->close();
            $db->closeConnection();
            return false;
        }
    }
}



<?php

class Pessoa
{

    private $pdo;

    public function __construct($dbname, $host, $user, $password)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $password);                
        } catch (PDOException $e) {
            echo "Erro na base de dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();            
        }
    }

    public function buscarDados()
    {
        $array = array();
        $cmd = $this->pdo->query("SELECT * FROM Pessoa ORDER BY nome");
        $array = $cmd->fetchAll(PDO::FETCH_ASSOC);
        
        return $array;
    }

    public function cadastrarPessoa($nome, $telefone, $email)
    {
        $cmd = $this->pdo->prepare("SELECT id FROM Pessoa WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();

        if($cmd->rowCount() > 0)
        {
            return false;
        } else {
            $cmd = $this->pdo->prepare("INSERT INTO Pessoa (nome, telefone, email)
            VALUES (:n, :t, :e)");

            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":t", $telefone);
            $cmd->bindValue(":e", $email);
            $cmd->execute();
        
            return true;
        }
    }

    public function excluirPessoa($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM Pessoa WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }
}
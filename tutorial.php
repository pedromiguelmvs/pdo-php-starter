<?php

// database connection
try {
    // db type, dbname, host, user, password
    $pdo = new PDO('mysql:dbname=CRUDPDO;host=localhost', 'root', '');
    if ($pdo) {
        echo "Banco de dados conectado!";
    }
} catch(PDOException $e) {
    echo "Erro com o banco de dados: ".$e->getMessage();
} catch(Exception $e) {
    echo "Um erro ocorreu: ".$e->getMessage();
}

// INSERT

// $res = $pdo->prepare("INSERT INTO Pessoa(nome, telefone, email)
//                     VALUES (:n,:t,:e) ");

// $res->bindValue(":n", "Miguel");
// $res->bindValue(":t", "1234567890");
// $res->bindValue(":e", "teste@gmail.com");
// $res->execute();

// $pdo->query("INSERT INTO Pessoa(nome, telefone, email)    
//             VALUES('Pedro', '0000000000', 'teste@gmail.com')")

// DELETE E UPDATE

// $cmd = $pdo->prepare("DELETE FROM Pessoa WHERE id = :id");
// $id = 4;
// $cmd->bindValue(":id", $id);
// $cmd->execute();

// OU

// $cmd = $pdo->query("DELETE FROM Pessoa WHERE id = '.$id.'");

// =================

// $cmd = $pdo->prepare("UPDATE Pessoa SET email = :e WHERE id = :id");
// $cmd->bindValue(":e", "mig@gmail.com");
// $cmd->bindValue(":id", 1);
// $cmd->execute();

// OU 

// $email = 'mig2@gmail.com';
// $id = 1;

// $cmd = $pdo->query("UPDATE Pessoa SET email = '$email' WHERE id = '$id'");

// SELECT

$cmd = $pdo->prepare('SELECT * FROM Pessoa WHERE id = :id');
$cmd->bindValue(":id", 1);
$cmd->execute();
$array = $cmd->fetch(PDO::FETCH_ASSOC);
// $cmd->fetchAll();

foreach ($array as $key => $value) {
    echo $key.": ".$value."</br>";
}

?>
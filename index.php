<?php

require_once './classes/Pessoa.php';
$p = new Pessoa('CRUDPDO', 'localhost', 'root', '');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro</title>
</head>
<body>
    <?php 
    if(isset($_POST['nome']))
    {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        if (!empty($nome) && !empty($telefone) && !empty($email))
        {
            if(!$p->cadastrarPessoa($nome, $telefone, $email))
            {
                echo "Email já está cadastrado!";                
            }
        } else {
            echo "<div style='color: red'>Preencha todos os campos!</div>";
        }
    }
    
    ?>
    <section id="esquerda">
        <form class="form-container" method="POST">
            <h2>Cadastro</h2>

            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome">

            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone">
            
            <label for="email">Email</label>
            <input type="text" name="email" id="email">

            <input type="submit" value="cadastrar">
            
        </form>
    </section>    
    <section id="direita">
        <table>
            <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td colspan="2">Email</td>                
            </tr>
        <?php
            $dados = $p->buscarDados();            
            
            if(count($dados) > 0)
            {
                for ($i=0; $i < count($dados); $i++)
                { 
                    echo "<tr>";
                    foreach ($dados[$i] as $key => $value)
                    {
                        if($key != "id")
                        {
                            echo "<td>".$value."</td>";
                        }
                    }
                    ?> <td>
                        <a href="">Editar</a>
                        <a href="index.php?id=<?php echo $dados[$i]['id']; ?>">Excluir</a>
                    </td> <?php
                    echo "</tr>";
                }                
            } 
            
            else {
                echo "Ainda não há pessoas cadastradas";
            }

            ?>
        </table>
    </section>
</body>
</html>

<?php

    if(isset($_GET['id']))
    {
        $id_pessoa = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa);
        header("location: index.php");
    }

?>
<?php session_start(); ?>
<html>
    <head>
        <title>Gerenciador de Tarefas</title>
    </head>
    <body>
        <h1>Gerenciador de Tarefas</h1>
        <form>
            <fieldset>
                <legend>Nova Tarefa</legend>
                <label>
                    Nome:
                    <input type="text" name="nome" />
                </label>
                <input type="submit" value="Cadastrar" />
                <label>
                    Telefone:
                    <input type="text" name="telefone" />
                </label>
                <input type="submit" value="Cadastrar" />
                <label>
                    e-mail
                    <input type="text" name="email" />
                </label>
                <input type="submit" value="Cadastrar" />
                <label>
                    Descrição (Opcional):
                    <textarea name="descricao"></textarea>
                </label>
                <label>
                    Data de nascimento:
                    <input type="checkbox" name="Data de nascimento"/> Favorito
                </label>
            </fieldset>
        </form>
        <?php
            $lista_nome = [];
            if (array_key_exists('nome', $_GET)) {
                $_SESSION['lista_nome'][] = $_GET['nome'];
            }

            $lista_telefone = [];
            if (array_key_exists('telefone' , $_GET)) {
                $_SESSION['lista_telefone'][] = $_GET['telefone'];
            }

            $lista_email = [];
            if (array_key_exists('email' , $_GET)) {
                $_SESSION['lista_email'][] = $_GET['email'];
            }
            
            $lista_nome = [];
            $lista_telefone = [];
            $lista_email = [];

            if(array_key_exists('lista_nome', $_SESSION)) {
                $lista_nome = $_SESSION['lista_nome'];
            }
            if(array_key_exists('lista_telefone', $_SESSION)) {
                $lista_telefone = $_SESSION['lista_telefone'];
            }
            if(array_key_exists('lista_email', $_SESSION)) {
                $lista_email = $_SESSION['lista_email'];
            }
        ?>
        <table>
            <tr>
                <th>nome</th>
                <th>Telefone</th>
                <th>Email</th>
            </tr>

            <?php foreach ($lista_nome as $nome) : ?> 
                <tr>
                    <td><?php echo $nome; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($lista_telefone as $telefone) : ?> 
                <tr>
                    <td><?php echo $telefone; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($lista_email as $email) : ?> 
                <tr>
                    <td><?php echo $email; ?></td>
                </tr>
            <?php endforeach; ?>

            </table>
    </body>
</html>
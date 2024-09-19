<html>
    <head>
        <meta charset="utf-8" />
        <title>Gerenciador de Tarefas</title>
        <link rel="stylesheet" href="assets/tarefas.css"
              type="text/css"/>
    </head>
    <body>
        <div class="bloco_principal"> 
            <h1>Tarefa? <?php echo htmlentities($tarefa->getNome()); ?></h1>
            <p>
                <a href="index.php?rota=tarefas">
                    Voltar para a lista de tarefas
                </a>
            </p>  

            <p>
                <strong>Concluída:</strong>
                <?php echo
                    traduz_concluida($tarefa->getConcluida()); ?>
            </p>
            <p>
                <strong>Descrição:</strong>
                <?php echo nl2br($tarefa->getDescricao()); ?>
            </p>
            <p>
                <strong>Prazo:</strong>
                <?php echo
                    traduz_data_para_exibir($tarefa->getPrazo()); ?>
            </php>
            <p>
                <strong>Prioridade:</strong>
                <?php echo
                    traduz_prioridade($tarefa->gePrioridade()); ?>
            </php>

            <!-- lista de anexos -->

            <?php foreach ($tarefa->getAnexos() as $anexo): ?>
                <tr>
                    <td><?php echo htmlentities($anexo->getNome()); ?></td>
                    <td>
                        <a href="anexos/<?php echo $anexo->getArquivo(); ?>">
                            Download
                        </a>
                        <a href="index.php?rota=remover_anexo&id=<?php
                            echo $anexo->getId() 
                        ?>">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>

            <!-- formulário para um novo anexo -->
            <form action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Novo anexo</legend>

                    <input type="hidden"
                        name="tarefa_id"
                        value="<?php echo $tarefa->getId(); ?>" />
                    <label>
                        <?php if (
                            $tem_erros
                            &&
                            arra_key_exists('anexo', $erros_validacao)
                        ):?>
                            <span class="erro">
                                <?php echo $erros_validacao['anexo']; ?>
                            </span>
                        <?php endif; ?>

                        <input type="file" name="anexo" />
                    </label>
                    <input type="submit" value="Cadastrar" />
                </fieldset>
            </form>
        </div>     
    </body>
</html>
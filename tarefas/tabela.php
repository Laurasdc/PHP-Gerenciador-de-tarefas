<table>
        <tr>
            <th>Tarefa</th>
            <th>Descricao</th>
            <th>Prazo</th>
            <th>Prioridade</th>
            <th>Concluída</th>
            <th>Opções</th> <!-- A nova coluna Opções -->
        </tr>
        <?php foreach ($lista_tarefas as $tarefa) : ?>
            <tr>
                <td>
                    <?php echo $tarefa['nome']; ?>
                </td>
                <td>
                    <?php echo $tarefa['descricao']; ?>
                </td>
                <td>
                    <?php echo traduz_data_para_exibir($tarefa['prazo']) ?>
                </td>
                <td>
                    <?php echo traduz_prioridade($tarefa['prioridade']); ?>
                </td>
                <td>
                    <?php echo traduz_concluida($tarefa['concluida']); ?>
                </td>
                <td>
                    <!-- A célula com os para editar e remover tarefas -->
                     <a href="editar.php?id=<?php echo $tarefa['id']; ?>">
                        Editar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<form>
        <fieldset>
            <legend>Nova tarefa</legend>
            <label>
                Tarefa:
                <input type="text" name="nome"/>
            </label>
            <input type="submit" value="Cadastrar"/>
        </fieldset>
        <label>
            Descrição(Opcional):
            <textarea name="descricao"></textarea>
        </label>
        <label>
            Prazo(Opcional):
            <input type="text" name="prazo" />
        </label>
        <fieldset>
            <legend>Prioridade:</legend>
            <label>
                <input type="radio" name="prioridade" value="1" 
                    <?php echo ($tarefa['prioridade'] == 1) 
                        ? 'checked' 
                        : '';
                    ?> /> Baixa

                <input type="radio" name="prioridade" value="2"
                    <?php echo ($tarefa['prioridade'] == 2)
                        ? 'checked'
                        : '';
                    ?> /> Média
                <input type="radio" name="prioridade" value="3"
                    <?php echo ($tarefa['prioridade'] == 3)
                        ? 'checked'
                        : '';
                    ?> /> Alta
                
                <input type="checkbox" name="concluida" "value"1"
                    <?php echo ($tarefa['concluida'] == 1)
                        ? 'checked'
                        : '';
                    ?> /> 

            </label>
        </fieldset>
        <label>
            Tarefa concluída:
            <input type="checkbox" name="concluida" value="1"/>
        </label>
        <input type="submit" value="Cadastrar" />
        <form>
            <input type="hidden" name = "id"
            value="<?php echo $tarefa['id']; ?>"/>

        <fieldset>
        <input type="text" name="nome"
            value="<?php echo $tarefa['nome']; ?>" />

        <textarea name="descricao">
            <?php echo $tarefa['descricao']; ?>
        </textarea>

        <input type="text" name="prazo"
            value="<?php
                echo traduz_data_para_exibir($tarefa['prazo']);
            ?>"
        />



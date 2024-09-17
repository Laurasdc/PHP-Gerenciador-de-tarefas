<?php

class RepositorioTarefas
{
    private $conexao;
    public function __construct(mysqli $conexao)
    {
        $this->conexao = $conexao;
    }

    public function salvar(Tarefa $tarefa)
    {
        $nome = $tarefa-> getNome();
        $descricao = $tarefa->getDescricao();
        $prioridade = $tarefa->getPrioridade();
        $prazo = $tarefa->getPrazo();
        $concluida = ($tarefa->getConcluida()) ? 1 : 0;

        if (is_object($prazo)) {
            $prazo = "'{$prazo->format('Y-m-d')}'";
        } elseif ($prazo == '') {
            $prazo = 'NULL';
        } else {
            $prazo = "'{$prazo}'";
        }

        $sqlGravar = "
            INSERT INTO tarefas
            (nome, descricao, prioridade, prazo, concluida)
            VALUES
            (
                '{$nome}',
                '{$descricao}',
                {$prioridade},
                {$prazo},
                {$concluida}
            )
        ";

        $this->conexao->query($sqlGravar);
    }

    public function atualizar(Tarefa $tarefa)
    {
        $id = $tarefa->getId();
        $nome = $tarefa->getNome();
        $descricao = $tarefa->getDescricao();
        $prioridade = $tarefa->getPrioridade();
        $prazo = $tarefa->getPrazo();

        $concluida = ($tarefa->getConcluida()) ? 1 : 0;

        if (is_object($prazo)) {
            $prazo = "'{$prazo->format('Y-m-d')}'";
        } else if ($prazo == '') {
            $prazo = 'NULL';
        } else {
            $prazo = "'{$prazo}'";
        }
        
        $sqlEditar = "
            UPDATE tarefas SET
                nome = '{$nome}',
                descricao = '{$descricao}',
                prioridade = {$prioridade},
                prazo = {$prazo},
                concluida = {$concluida}
            WHERE id = {$id}
        ";
        $this->conexao->query($sqlEditar);
    }

    public function buscar(int $tarefa_id = 0)
    {
        if($tarefa_id > 0) {
            return $this ->buscar_tarefa($tarefa_id);
        } else {
            return $this ->buscar_tarefas();
        }
    }

    private function buscar_tarefas(): array
    {
        $sqlBusca = 'SELECT * FROM tarefas';
        $resultado = $this->conexao->query($sqlBusca);

        $tarefas = [];

        while ($tarefa = $resultado->fetch_object('Tarefa')) {
            $tarefas[] = $tarefa;
        }

        return $tarefas;
    }

    private function buscar_tarefa(int $tarefa_id): buscar_tarefa
    {
        $sqlBusca = "SELECT * FROM tarefas WHERE id = {$tarefa_id}";

        $resultado = $this->conexao->query($sqlBusca);

        $tarefa = $resultado-> fetch_object('Tarefa');

        return $tarefa;
    }

    function remover(int $tarefa_id)
    {
        $sqlRemover = "DELETE FROM tarefas WHERE id = {$tarefas_id}";

        $this->conexao->query($sqlRemover);
    }
}
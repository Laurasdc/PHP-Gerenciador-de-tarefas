<?php

namespace Tarefas\Models;

class RepositorioTarefas
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function salvar(Tarefa $tarefa)
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sqlGravar = "
            INSERT INTO tarefas
            (nome, descricao, prioridade, prazo, concluida)
            VALUES
            (:nome, :descricao, :prioridade, :prazo, :concluida)
        ";
        $query = $this->pdo->prepare($sqlGravar);
        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(),
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
        ]);
    }

    public function atualizar(Tarefa $tarefa)
    {
        $prazo = $tarefa->getPrazo();

        if (is_object($prazo)) {
            $prazo = $prazo->format('Y-m-d');
        }

        $sqlEditar = "
            UPDATE tarefas SET
                nome = :nome,
                descricao = :descricao,
                prioridade = :prioridade,
                prazo = :prazo,
                concluida = :concluida
            WHERE id = :id
        ";

        $query = $this->pdo->prepare($sqlEditar);

        $query->execute([
            'nome' => strip_tags($tarefa->getNome()),
            'descricao' => strip_tags($tarefa->getDescricao()),
            'prioridade' => $tarefa->getPrioridade(),
            'prazo' => $prazo,
            'concluida' => ($tarefa->getConcluida()) ? 1 : 0,
            'id' => $tarefa->getId(),
        ]);
    }

    public function buscar($tarefa_id = 0)
    {
        if ($tarefa_id > 0) {
            return $this->buscar_tarefa($tarefa_id);
        } else {
            return $this->buscar_tarefas();
        }
    }

    private function buscar_tarefas(): array
    {
        $sqlBusca = 'SELECT * FROM tarefas';
        $resultado = $this->pdo->query(
            $sqlBusca,
            \PDO::FETCH_CLASS,
            'Tarefas\Models\Tarefa'
        );

        $tarefas = [];

        foreach ($resultado as $tarefa) {
            $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));
            $tarefas[] = $tarefa;
        }

        return $tarefas;
    }

    private function buscar_tarefa(int $id): Tarefa
    {
        $sqlBusca = "SELECT * FROM tarefas WHERE id = :id";
        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
            'id' => $id,
        ]);

        $tarefa = $query->fetchObject('Tarefas\Models\Tarefa');

        if (! is_object($tarefa)) {
            throw new Exception("A tarefa com o id {$id} não existe");
        }

        $tarefa->setAnexos($this->buscar_anexos($tarefa->getId()));

        return $tarefa;
    }

    public function salvar_anexo(Anexo $anexo)
    {
        $sqlGravar = "INSERT INTO anexos
            (tarefa_id, nome, arquivo)
            VALUES
            (:tarefa_id, :nome, :arquivo)
            ";
        $query = $this->pdo->prepare($sqlGravar);
        $query->execute([
            'tarefa_id' => $anexo->getTarefaId(),
            'nome' => $anexo->getNome(),
            'arquivo' => $anexo->getArquivo(),
        ]);
    }

    public function buscar_anexos(int $tarefa_id): array
    {
        $sqlBusca = "SELECT * FROM anexos WHERE tarefa_id = :tarefa_id";
        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
            "tarefa_id" => $tarefa_id,
        ]);

        $anexos = array();

        while ($anexo = $query->fetchObject('Tarefas\Models\Anexo')) {
            $anexos[] = $anexo;
        }

        return $anexos;
    }

    public function buscar_anexo(int $anexo_id): Anexo
    {
        $sqlBusca = "SELECT * FROM anexos WHERE id = :id";
        $query = $this->pdo->prepare($sqlBusca);
        $query->execute([
            'id' => $anexo_id,
        ]);

        $anexo = $query->fetchObject('Tarefas\Models\Anexo');

        if (! is_object($anexo)) {
            throw new Exception("O anexo com o id {$id} não existe");
        }

        return $anexo;
    }

    public function remover($id)
    {
        $sqlRemover = "DELETE FROM tarefas WHERE id = :id";

        $query = $this->pdo->prepare($sqlRemover);

        $query->execute([
            'id' => $id,
        ]);
    }

    public function remover_anexo($id)
    {
        $sqlRemover = "DELETE FROM anexos WHERE id = :id";
        $query = $this->pdo->prepare($sqlRemover);
        $query->execute([
            'id' => $id,
        ]);
    }
}
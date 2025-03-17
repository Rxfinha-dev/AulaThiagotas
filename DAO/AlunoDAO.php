<?php
    namespace AulaThiagotas\DAO;

    use AulaThiagotas\Model\Aluno;

    final class AlunoDAO extends DAO
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function save(Aluno $model) : Aluno
        {
            return ($model->Id == null)g ? $this->insert($model) : 
            $this->update($model);
        }

        public function insert(Aluno $model) : Aluno
        {
            $sql = "INSERT INTO aluno(nome, ra,curso) VALUES (?,?,?)";

            $stmt = parent::$conexao->prepare($sql);

            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model-RA);
            $stmt->bindValue(3, $model->Curso);
            $stmt->execute();
            $model->Id = parent::$conexao->lastInserId();

            return $model;
        }

        public function update(Aluno $model) : Aluno
        {
            &sql = "UPDATE aluno SET nome=?, ra=?, curso=? WHERE id=?";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model-RA);
            $stmt->bindValue(3, $model->Curso);
            $stmt->bindValue(4, $model->Id);
            $stmt->execute();

            return $model;
        }

        public function selectById(int $id) : ?Aluno
        {
            $sql = "SELECT * FROM aluno WHERE id=?";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Nome);
            $stmt->bindValue(2, $model-RA);
            $stmt->bindValue(3, $model->Curso);
            $stmt->bindValue(4, $model->Id);
            $stmt->execute();

        }
    }
?>
<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Editora;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class EditoraDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM editora WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$editora = new Editora();
				$editora->setId($obj->id);
				$editora->setNome($obj->nome);
				$editora->setCnpj($obj->cnpj);
				return $editora;
			} else {
				throw new PDOException('Não foi encontrado a EDITORA com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM editora ORDER BY `id`');
			$stm->execute();
			$editoras = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$editora = new Editora();
				$editora->setId($obj->id);
				$editora->setNome($obj->nome);
				$editora->setCnpj($obj->cnpj);
				$editoras[] = $editora;
			}
			return $editoras;
		}
		
		public function save(Editora $editora) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE editora SET nome = ?, cnpj = ? WHERE id = ?');
				$stm->bindValue(1, $editora->getNome());
				$stm->bindValue(2, $editora->getCnpj());
				$stm->bindValue(3, $editora->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO editora (nome, cnpj) VALUES (?, ?) LIMIT 1');
				$stm->bindValue(1, $editora->getNome());
				$stm->bindValue(2, $editora->getCnpj());
				$stm->execute();
				
				$editora->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Editora $editora) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('DELETE FROM editora WHERE id = ?');
				$stm->bindValue(1, $editora->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
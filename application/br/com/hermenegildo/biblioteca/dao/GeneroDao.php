<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Genero;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class GeneroDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM genero WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$genero = new Genero();
				$genero->setId($obj->id);
				$genero->setNome($obj->nome);
				return $genero;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM genero ORDER BY `id`');
			$stm->execute();
			$generos = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$genero = new Genero();
				$genero->setId($obj->id);
				$genero->setNome($obj->nome);
				$generos[] = $genero;
			}
			return $generos;
		}
		
		public function save(Genero $genero) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE genero SET nome = ? WHERE id = ?');
				$stm->bindValue(1, $genero->getNome());
				$stm->bindValue(2, $genero->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO genero (nome) VALUES (?) LIMIT 1');
				$stm->bindValue(1, $genero->getNome());
				$stm->execute();
				
				$genero->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Genero $genero) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('DELETE FROM genero WHERE id = ?');
				$stm->bindValue(1, $genero->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
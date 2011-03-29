<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class AutorDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM autor WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$autor = new Autor();
				$autor->setId($obj->id);
				$autor->setNome($obj->nome);
				return $usuario;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM autor ORDER BY `id`';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			$autores = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$autor = new Autor();
				$autor->setId($obj->id);
				$autor->setNome($obj->nome);
				$autores[] = $autor;
			}
			return $autores;
		}
		
		public function save(Autor $autor) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE autor SET nome = ? WHERE id = ?');
				$stm->bindValue(1, $autor->getNome());
				$stm->bindValue(2, $autor->getId());
				$stm->execute(array($autor->getNome(), $autor->getId()));
			} else {
				$stm = $pdo->prepare('INSERT INTO autor (nome) VALUES (?) LIMIT 1');
				$stm->bindValue(1, $autor->getNome());
				$stm->execute(array($autor->getNome()));
				
				$autor->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Autor $autor) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('DELETE FROM autor WHERE id = ?');
				$stm->bindValue(1, $autor->getId());
				$stm->execute(array($autor->getId()));
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
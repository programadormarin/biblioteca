<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Bibliotecario;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class AutorDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM bibliotecario WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$bibliotecario = new Bibliotecario();
				$bibliotecario->setId($obj->id);
				$bibliotecario->setNome($obj->nome);
				$bibliotecario->setLogin($obj->login);
				return $bibliotecario;
			} else {
				throw new PDOException('Não foi encontrado bibliotecario com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM bibliotecario ORDER BY `id`');
			$stm->execute();
			$bibliotecarios = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$bibliotecario = new Bibliotecario();
				$bibliotecario->setId($obj->id);
				$bibliotecario->setNome($obj->nome);
				$bibliotecario->setLogin($obj->login);
				$bibliotecarios[] = $bibliotecario;
			}
			return $bibliotecarios;
		}
		
		public function save(Bibliotecario $bibliotecario) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE bibliotecario SET nome = ?, login = ? WHERE id = ?');
				$stm->bindValue(1, $bibliotecario->getNome());
				$stm->bindValue(2, $bibliotecario->getLogin());
				$stm->bindValue(3, $bibliotecario->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO bibliotecario (nome) VALUES (?) LIMIT 1');
				$stm->bindValue(1, $autor->getNome());
				$stm->execute();
				
				$autor->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Bibliotecario $bibliotecario) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($bibliotecario->getId()) {
				$stm = $pdo->prepare('DELETE FROM bibliotecario WHERE id = ?');
				$stm->bindValue(1, $bibliotecario->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
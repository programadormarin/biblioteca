<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Prateleira;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class AutorDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM prateleira WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$prateleira = new Prateleira();
				$prateleira->setId($obj->id);
				$prateleira->setPosicao($obj->posicao);
				return $prateleira;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM prateleira ORDER BY `id`');
			$stm->execute();
			$prateleiras = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$prateleira = new Prateleira();
				$prateleira->setId($obj->id);
				$prateleira->setPosicao($obj->posicao);
				$prateleiras[] = $prateleira;
			}
			return $prateleiras;
		}
		
		public function save(Prateleira $prateleira) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($prateleira->getId()) {
				$stm = $pdo->prepare('UPDATE prateleira SET posicao = ? WHERE id = ?');
				$stm->bindValue(1, $prateleira->getPosicao());
				$stm->bindValue(2, $prateleira->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO prateleira (posicao) VALUES (?) LIMIT 1');
				$stm->bindValue(1, $prateleira->getPosicao());
				$stm->execute();
				
				$prateleira->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Prateleira $prateleira) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($prateleira->getId()) {
				$stm = $pdo->prepare('DELETE FROM prateleira WHERE id = ?');
				$stm->bindValue(1, $prateleira->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
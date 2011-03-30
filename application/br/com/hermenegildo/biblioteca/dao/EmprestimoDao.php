<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Emprestimo;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class EmprestimoDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM emprestimo WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$emprestimo = new Emprestimo();
				$emprestimo->setId($obj->id);
				$emprestimo->setData(new DateTime($obj->data));
				$emprestimo->setDataDevolucao(new DateTime($obj->dataDevolucao));
				$emprestimo->setDataProgramada(new DateTime($obj->dataProgramada));
				$emprestimo->setMulta($obj->multa);
				return $emprestimo;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM emprestimo ORDER BY `id`');
			$stm->execute();
			$emprestimos = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$emprestimo = new Emprestimo();
				$emprestimo->setId($obj->id);
				$emprestimo->setData(new DateTime($obj->data));
				$emprestimo->setDataDevolucao(new DateTime($obj->dataDevolucao));
				$emprestimo->setDataProgramada(new DateTime($obj->dataProgramada));
				$emprestimo->setMulta($obj->multa);
				$emprestimos[] = $emprestimo;
			}
			return $emprestimos;
		}
		
		public function save(Emprestimo $emprestimo) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE emprestimo SET nome = ?, data = ?, data_devolucao = ?, data_programada = ?, multa = ?   WHERE id = ?');
				$stm->bindValue(1, $emprestimo->getData()->format('Y-m-d H:i:s'));
				$stm->bindValue(2, $emprestimo->getDataDevolucao()->format('Y-m-d H:i:s'));
				$stm->bindValue(3, $emprestimo->getDataProgramada()->format('Y-m-d H:i:s'));
				$stm->bindValue(4, $emprestimo->getMulta());
				$stm->bindValue(5, $emprestimo->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO emprestimo (data, data_devolucao, data_programada, multa) VALUES (?, ?, ?, ?) LIMIT 1');
				$stm->bindValue(1, $emprestimo->getData()->format('Y-m-d H:i:s'));
				$stm->bindValue(2, $emprestimo->getDataDevolucao()->format('Y-m-d H:i:s'));
				$stm->bindValue(3, $emprestimo->getDataProgramada()->format('Y-m-d H:i:s'));
				$stm->bindValue(4, $emprestimo->getMulta());
				$stm->execute();
				
				$emprestimo->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Emprestimo $emprestimo) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($emprestimo->getId()) {
				$stm = $pdo->prepare('DELETE FROM emprestimo WHERE id = ?');
				$stm->bindValue(1, $emprestimo->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
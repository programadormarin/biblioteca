<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\entities\Biblioteca;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class BibliotecaDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM biblioteca WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$biblioteca = new Biblioteca();
				$biblioteca->setId($obj->id);
				$biblioteca->setNome($obj->nome);
				$biblioteca->setCnpj($obj->cnpj);
				$biblioteca->setValorMulta($obj->valor_multa);
				return $biblioteca;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM biblioteca ORDER BY id');
			$stm->execute();
			$bibliotecas = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$biblioteca = new Biblioteca();
				$biblioteca->setId($obj->id);
				$biblioteca->setNome($obj->nome);
				$biblioteca->setCnpj($obj->cnpj);
				$biblioteca->setValorMulta($obj->valor_multa);
				$bibliotecas[] = $biblioteca;
			}
			return $bibliotecas;
		}
		
		public function save(Biblioteca $biblioteca) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('UPDATE biblioteca SET nome = ?, cnpj = ?, valor_multa = ? WHERE id = ?');
				$stm->bindValue(1, $biblioteca->getNome());
				$stm->bindValue(2, $biblioteca->getCnpj());
				$stm->bindValue(3, $biblioteca->getValorMulta());
				$stm->bindValue(4, $biblioteca->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO biblioteca (nome, cnpj, valor_multa) VALUES (?, ?, ?) LIMIT 1');
				$stm->bindValue(1, $biblioteca->getNome());
				$stm->bindValue(2, $biblioteca->getCnpj());
				$stm->bindValue(3, $biblioteca->getValorMulta());
				$stm->execute();
				
				$biblioteca->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Biblioteca $biblioteca) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('DELETE FROM biblioteca WHERE id = ?');
				$stm->bindValue(1, $biblioteca->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
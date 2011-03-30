<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;
	use br\com\hermenegildo\biblioteca\entities\Usuario;
	class UsuarioDao {
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM usuario WHERE id = ?');
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$usuario = new Usuario();
				$usuario->setId($obj->id);
				$usuario->setCpf($obj->cpf);
				$usuario->setNome($obj->nome);
				return $usuario;
			} else {
				throw new PDOException('Não foi encontrado usuário');
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM usuario ORDER BY id');
			$stm->execute();
			$usuarios = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$usuario = new Usuario();
				$usuario->setId($obj->id);
				$usuario->setCpf($obj->cpf);
				$usuario->setNome($obj->nome);
				$usuarios[] = $usuario;
			}
			return $usuarios;
		}
		
		public function save(Usuario $usuario) {
			$pdo = ConexaoMysql::getInstance();
			if ($usuario->getId()) {
				$smt = $pdo->prepare('UPDATE FROM usuario set cpf = ?, nome = ? WHERE id = ? LIMIT 1');
				$smt->bindValue(1, $usuario->getCpf());
				$smt->bindValue(2, $usuario->getNome());
				$smt->bindValue(3, $usuario->getId());
				$smt->execute();
			} else {
				$smt = $pdo->prepare('INSERT INTO usuario (nome, cpf) VALUES(?, ?)');
				$smt->bindValue(1, $usuario->getCpf());
				$smt->bindValue(2, $usuario->getNome());
				$smt->execute();
				
				$usuario->setId($pdo->lastInsertId());
			}
		}
		
		public function remove (Usuario $usuario) {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('DELETE FROM usuario WHERE id = ?');
			$stm->bindValue(1, $usuario->getId());
			$stm->execute();
		}
	}
}
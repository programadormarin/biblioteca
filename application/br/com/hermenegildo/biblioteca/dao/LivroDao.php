<?php
namespace br\com\hermenegildo\biblioteca\dao {
	use br\com\hermengildo\biblioteca\entities\Livro;

	use br\com\hermenegildo\biblioteca\util\ConexaoMysql;

	class AutorDao {
	
		public function getById($id) {
			$pdo = ConexaoMysql::getInstance();
			$sql = 'SELECT * FROM livro WHERE id = ?';
			$stm = $pdo->prepare($sql);
			$stm->execute(array($id));
			if ($obj = $stm->fetchObject()) {
				$livro = new Livro();
				$livro->setId($obj->id);
				$livro->setAno($obj->ano);
				$livro->setEdicao($obj->edicao);
				$livro->setPaginas($obj->paginas);
				$livro->setQuantidade($obj->quantidade);
				$livro->setTitulo($obj->titulo);
				return $livro;
			} else {
				throw new PDOException('Não foi encontrado autor com a id ' . $id);
			}
		}
		
		public function listAll() {
			$pdo = ConexaoMysql::getInstance();
			$stm = $pdo->prepare('SELECT * FROM autor ORDER BY `id`');
			$stm->execute();
			$livros = new SplFixedArray($stm->rowCount());
			while ($obj = $stm->fetchObject()) {
				$livro = new Livro();
				$livro->setId($obj->id);
				$livro->setAno($obj->ano);
				$livro->setEdicao($obj->edicao);
				$livro->setPaginas($obj->paginas);
				$livro->setQuantidade($obj->quantidade);
				$livro->setTitulo($obj->titulo);
				$livros[] =  $livro;
			}
			return $livros;
		}
		
		public function save(Livro $livros) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($livros->getId()) {
				$stm = $pdo->prepare('UPDATE autor SET ano = ?, edicao = ?, paginas = ?, quantidade = ?, titulo = ? WHERE id = ?');
				$stm->bindValue(1, $livros->getAno());
				$stm->bindValue(2, $livros->getEdicao());
				$stm->bindValue(3, $livros->getPaginas());
				$stm->bindValue(4, $livros->getQuantidade());
				$stm->bindValue(5, $livros->getTitulo());
				$stm->bindValue(6, $livros->getId());
				$stm->execute();
			} else {
				$stm = $pdo->prepare('INSERT INTO autor (ano, edicao, paginas, quantidade, titulo) VALUES (?, ?, ?, ?, ?) LIMIT 1');
				$stm->bindValue(1, $livros->getAno());
				$stm->bindValue(2, $livros->getEdicao());
				$stm->bindValue(3, $livros->getPaginas());
				$stm->bindValue(4, $livros->getQuantidade());
				$stm->bindValue(5, $livros->getTitulo());
				$stm->execute();
				
				$livros->setId($pdo->lastInsertId());				
			}
		}
		
		public function remove (Autor $autor) {
			$pdo = ConexaoMysql::getInstance();
			
			if ($autor->getId()) {
				$stm = $pdo->prepare('DELETE FROM autor WHERE id = ?');
				$stm->bindValue(1, $autor->getId());
				$stm->execute();
			} else {
				throw new PDOException('Parâmetro id é obrigatório.');		
			}
		}
	}
}
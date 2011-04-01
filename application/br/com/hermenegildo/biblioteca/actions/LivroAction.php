<?php
namespace br\com\hermenegildo\biblioteca\actions {
	use br\com\hermenegildo\biblioteca\view\LivroForm;

	use br\com\hermengildo\biblioteca\entities\Livro;
	use br\com\hermenegildo\biblioteca\dao\LivroDao;
	use br\com\hermenegildo\biblioteca\view\AutorForm;
	use br\com\hermenegildo\biblioteca\util\AbstractAction;

	class LivroAction extends AbstractAction {
		public function render() {
			if ($_POST) {
				$livro = new Livro();
				$livro->setAno($_POST['ano']);
				$livro->setEdicao($_POST['edicao']);
				$livro->setPaginas($_POST['paginas']);
				$livro->setQuantidade($_POST['quantidade']);
				$livro->setTitulo($_POST['titulo']);
				try {
					$daoLivro = new LivroDao();
					$daoLivro->save($livro);
					echo "Livro salvo com sucesso!!!";
				} catch (\PDOException $e) {
					echo $e->getMessage();
				} catch (\Exception $e) {
					echo $e->getMessage();
				}
			} else {
				echo new LivroForm();
				
			}
		}
	}
}
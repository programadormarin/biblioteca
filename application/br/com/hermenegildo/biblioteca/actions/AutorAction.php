<?php
namespace br\com\hermenegildo\biblioteca\actions {
	use br\com\hermenegildo\biblioteca\view\AutorForm;

	use br\com\hermenegildo\biblioteca\dao\AutorDao;

	use br\com\hermenegildo\biblioteca\entities\Autor;

	use br\com\hermenegildo\biblioteca\util\AbstractAction;

	class AutorAction extends AbstractAction {
		public function render() {
			if ($_POST) {
				$autor = new Autor();
				$autor->setNome($_POST['nome']);
				try {
					$daoAutor = new AutorDao();
					$daoAutor->save($autor);
					echo "Autor salvo com sucesso!!!";
				} catch (\PDOException $e) {
					echo $e->getMessage();
				} catch (\Exception $e) {
					echo $e->getMessage();
				}
			} else {
				echo new AutorForm();
				
			}
		}
	}
}
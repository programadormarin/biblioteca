<?php
use br\com\hermenegildo\biblioteca\dao\AutorDao;
set_include_path(
	get_include_path()
	. PATH_SEPARATOR . __DIR__ . '/../'
	. PATH_SEPARATOR . __DIR__ . '/../../utils/'
	. PATH_SEPARATOR . __DIR__ . '/../../display-objects/'
);

require_once 'application/br/com/lcobucci/utils/autoloader/NamespaceAutoloader.php';
br\com\lcobucci\utils\autoloader\NamespaceAutoloader::register();
use br\com\hermenegildo\biblioteca\entities\Autor;
use br\com\hermenegildo\biblioteca\view\AutorForm;

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
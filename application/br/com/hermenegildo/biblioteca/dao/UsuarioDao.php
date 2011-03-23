<?php
use br\com\hermenegildo\biblioteca\entities\Emprestimo;
use br\com\hermenegildo\biblioteca\entities\Usuario;
class UsuarioDao extends \OutletDaoSupport
{
	public function save(\br\com\hermenegildo\biblioteca\entities\Usuario $usuario)
	{
		$this->getOutlet()->save($usuario);
	}
	
	public function getById($id)
	{
		$emprestimo = new Emprestimo();
		$emprestimo->getData()->format('Y-m-d H:i:s');
		
		return $this->getOutlet()->load('Usuario', $id);
	}
}
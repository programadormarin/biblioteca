<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Editora extends Pessoa {
		private $cnpj;
		
		public function setId($cnpj) {
			$this->cnpj = $cnpj;
		}
		
		public function getCnpj() {
			return $this->cnpj;
		}
	}
}
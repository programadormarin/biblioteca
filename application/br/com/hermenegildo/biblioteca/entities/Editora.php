<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Editora extends Pessoa {
		private $cnpj;
		
		public function setCnpj($cnpj) {
			$this->cnpj = $cnpj;
		}
		
		public function getCnpj() {
			return $this->cnpj;
		}
	}
}
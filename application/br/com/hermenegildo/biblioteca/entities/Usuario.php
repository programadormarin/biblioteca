<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Usuario extends Pessoa {
		private $cpf;
		
		public function setCpf($cpf) {
			$this->cpf = $cpf;
		}
		
		public function getCpf() {
			return $this->cpf;
		}
	}
}
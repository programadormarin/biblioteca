<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Bibliotecario extends Pessoa {
		private $login;
		private $senha;
		
		public function setLogin($login) {
			$this->login = $login;
		}
		
		public function setNome($senha) {
			$this->senha = $senha;
		}
		
		public function getLogin() {
			return $this->login;
		}
		
		public function getSenha() {
			return $this->senha;
		}
	}
}
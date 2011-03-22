<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Prateleira {
		private $id;
		private $posicao;
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function setPosicao($posicao) {
			$this->posicao = $posicao;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getPosicao() {
			return $this->posicao;
		}
	}
}
<?php
namespace br\com\hermenegildo\biblioteca\entities {
	class Emprestimo {
		private $id;
		private $data;
		private $dataDevolucao;
		private $dataProgramada;
		private $multa;
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function setData($data) {
			$this->data = $data;
		}
		
		public function setDataProgramada($dataProgramada) {
			$this->dataDevolucao = $dataDevolucao;
		}
		
		public function setDataDevolucao($dataDevolucao) {
			$this->dataDevolucao = $dataDevolucao;
		}
		
		public function setMulta($multa) {
			$this->multa = $multa;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getData() {
			return $this->data;
		}
		
		public function getDataProgramada() {
			return $this->dataProgramada;
		}
		
		public function getDataDevolucao() {
			return $this->dataDevolucao;
		}
		
		public function getMulta() {
			return $this->multa;
		}
		
	}
}
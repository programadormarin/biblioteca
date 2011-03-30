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
		
		public function setData(DateTime $data) {
			$this->data = $data;
		}
		
		public function setDataProgramada(DateTime $dataProgramada) {
			$this->dataDevolucao = $dataDevolucao;
		}
		
		public function setDataDevolucao(DateTime $dataDevolucao) {
			$this->dataDevolucao = $dataDevolucao;
		}
		
		public function setMulta($multa) {
			$this->multa = $multa;
		}
		
		public function getId() {
			return $this->id;
		}
		
		/**
		 * @return \DateTime
		 */
		public function getData() {
			return $this->data;
		}
		
		/**
		 * @return \DateTime
		 */
		public function getDataProgramada() {
			return $this->dataProgramada;
		}
		
		/**
		 * @return \DateTime
		 */
		public function getDataDevolucao() {
			return $this->dataDevolucao;
		}
		
		public function getMulta() {
			return $this->multa;
		}
		
	}
}
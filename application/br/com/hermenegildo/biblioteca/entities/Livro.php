<?php
namespace br\com\hermengildo\biblioteca\entities {
	class Livro extends Pessoa {
		private $id;
		private $titulo;
		private $ano;
		private $edicao;
		private $paginas;
		private $quantidade;
		
		public function setId($id) {
			$this->id = $id;
		}
		
		public function setTitulo($titulo) {
			$this->titulo = $titulo;
		}
		
		public function setAno($ano) {
			$this->ano = $ano;
		}
		
		public function setEdicao($edicao) {
			$this->edicao = $edicao;
		}
		
		public function setPaginas($paginas) {
			$this->paginas = $paginas;
		}
		
		public function setQuantidade($quantidade) {
			$this->quantidade = $quantidade;
		}
		
		public function getId() {
			return $this->id;
		}
		
		public function getTitulo() {
			return $this->titulo;
		}
		
		public function getAno() {
			return $this->ano;
		}
		
		public function getEdicao() {
			return $this->edicao;
		}
		
		public function getPaginas() {
			return $this->paginas;
		}
		
		public function getQuantidade() {
			return $this->quantidade;
		}
		
	}
}
<?php
	include('Pessoa.php');
	class Produto extends Pessoa{
		private $setor;
		private $preco;
		private $estoque;

		function getSetor(){
			return $this->setor;
		}
		function setSetor($setor){
			$this->setor = $setor;	
		}

		function getPreco(){
			return $this->preco;
		}
		function setPreco($preco){
			$this->preco = $preco;
		}

		function getEstoque(){
			return $this->estoque;
		}
		function setEstoque($estoque){
			$this->estoque = $estoque;
		}
	}
?>
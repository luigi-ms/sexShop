<?php
	include('Pessoa.php');
	class Vendedor extends Pessoa{
		private $nome;
		private $codigo;
		private $setor;

		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}

		function getCodigo(){
			return $this->codigo;
		}
		function setCodigo($codigo){
			$this->codigo = $codigo;	
		}

		function getSetor(){
			return $this->setor;
		}
		function setSetor($setor){
			$this->setor = $setor;
		}
	}
?>
<?php
	abstract class Pessoa{
		private $nome;
		private $cpf;
		private $codigo;

		function getNome(){
			return $this->nome;
		}
		function setNome($nome){
			$this->nome = $nome;
		}

		function getCpf(){
			return $this->cpf;
		}
		function setCpf($cpf){
			$this->cpf = $cpf;	
		}

		function getCodigo(){
			return $this->codigo;
		}
		function setCodigo($codigo){
			$this->codigo = $codigo;
		}
	}
?>
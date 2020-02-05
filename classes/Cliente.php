<?php
	include('Pessoa.php');
	class Cliente extends Pessoa{
		private $nome;
		private $cpf;
		private $codigo;
		private $senha;

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

		function getSenha(){
			return $this->senha;
		}
		function setSenha($senha){
			$this->senha = $senha;
		}
	}
?>
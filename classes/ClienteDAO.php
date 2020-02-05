<?php
	include('Cliente.php');
	include('IPessoa.php');

	class ClienteDAO extends Cliente implements IPessoa{
		/*1. Todos os dados passados são herdados da classe Cliente.
		2. O comando sql WHERE usado em quase todos os métodos irá executar o comado pedido apenas onde o código passado
		coincida com um código existente no DB.*/
		function conexaoDB(){
			try{
				$con = new PDO('mysql:host=localhost; dbname=sexshop', "u0_a715", "");
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}

			return $con;
		}

		function cadastrar(){
			/*Executará um comando SQL para inserir um cliente no DB. Por questões de erro com chave estrangeira, será
			inserido primeiro na tabela pessoa e depois na tabela cliente.*/
			$queryPessoa = "INSERT INTO pessoa(nome, cpf, codigo) VALUES(:nome, :cpf, :cod)";
			$query = "INSERT INTO cliente(nome, cpf, codigo, senha) VALUES(:nomeCli, :cpfCli, :codCli, :senha)";

			$stmt1 = self::conexaoDB()->prepare($queryPessoa);
			$stmt2 = self::conexaoDB()->prepare($query);

			$stmt1->execute(array(
				':nome' => $this->getNome(),
				':cpf' => $this->getCpf(),
				':cod' => $this->getCodigo()
			));

			$stmt2->execute(array(
				':nomeCli' => $this->getNome(),
				':cpfCli' => $this->getCpf(),
				':codCli' => $this->getCodigo(),
				':senha' => $this->getSenha()
			));
		}

		function remover(){
			/*Por causa do erro citado na linha 18, será aplicada uma logica invertida neste método: irá executar o comando
			SQL primeiro na tabela filha, e depois na tabela pai.*/
			$delCli = self::conexaoDB()->prepare("DELETE FROM cliente WHERE codigo = :codigo");
			$delCli->execute(array(':codigo' => $this->getCodigo()));

			$delPess = self::conexaoDB()->prepare("DELETE FROM pessoa WHERE codigo = :codigo");
			$delPess->execute(array(':codigo' => $this->getCodigo()));
		}

		function alterar(){
			/*Cada if deste método irá verificar se algum dos dados NÃO seja nulo, afim de prever o caso em que o usuário queira apenas alterar um ou dois dados apenas, ao invés de todos de uma vez.*/
			if(!($this->getNome()==NULL)){
				$altPess = self::conexaoDB()->prepare("UPDATE pessoa SET nome = :nome WHERE codigo = :codigo");
				$altElei = self::conexaoDB()->prepare("UPDATE cliente SET nome = :nome WHERE codigo = :codigo");

				$altPess->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()));
				$altElei->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()));

			} if(!($this->getCpf()==NULL)){
				$altPess = self::conexaoDB()->prepare("UPDATE pessoa SET cpf = :cpf WHERE codigo = :codigo");
				$altElei = self::conexaoDB()->prepare("UPDATE cliente SET cpf = :cpf WHERE codigo = :codigo");

				$altPess->execute(array(
					':cpf' => $this->getCpf(),
					':codigo' => $this->getCodigo()));
				$altElei->execute(array(
					':cpf' => $this->getCpf(),
					':codigo' => $this->getCodigo()));

			} if(!($this->getSenha()==NULL)){
				$altElei = self::conexaoDB()->prepare("UPDATE cliente SET senha = :senha WHERE codigo = :codigo");

				$altElei->execute(array(
					':senha' => $this->getSenha(),
					':codigo' => $this->getCodigo()));
			}
			
		}

		function listar(){
			/*Este método retornará um array de dados de TODOS os clientes cadastrados.*/
			$stmt = self::conexaoDB()->prepare("SELECT * FROM cliente");
			$stmt->execute();

			return $stmt->fetchAll();
		}
	}
?>
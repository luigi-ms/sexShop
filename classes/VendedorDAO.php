<?php
	include('Vendedor.php');
	include('IPessoa.php');

	class VendedorDAO extends Vendedor implements IPessoa{
		/*Para compreender todo o código, entenda a lógica explicada nas linhas 6, 21, 44, 54 e 88 da classe ClienteDAO.php*/
		function conexaoDB(){
			try{
				$con = new PDO('mysql:host=localhost; dbname=sexshop', "u0_a715", "");
				
			}catch(PDOException $e){
				echo $e->getMessage();
			}

			return $con;
		}
		function cadastrar(){
			$ifExists = "SELECT codigo FROM pessoa WHERE codigo= :codigo";
			$stmt = self::conexaoDB()->prepare($ifExists);
			$verify = $stmt->execute(array(':codigo' => $this->getCodigo()));

			if($verify){
				$queryPessoa = "INSERT INTO pessoa(nome, codigo) VALUES(:nome, :codigo)";
				$query = "INSERT INTO vendedor(nome, codigo, setor) VALUES(:nomeVend, :codigoVend, :setorVend)";

				$stmt1 = self::conexaoDB()->prepare($queryPessoa);
				$stmt2 = self::conexaoDB()->prepare($query);

				$stmt1->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()
				));

				$stmt2->execute(array(
					':nomeVend' => $this->getNome(),
					':codigoVend' => $this->getCodigo(),
					':setorVend' => $this->getSetor()
				));
			} else {
				echo "Se fosdeu";
			}
			
		}
		function remover(){	
			$delVend = self::conexaoDB()->prepare("DELETE FROM vendedor WHERE codigo = :codigo");
			$delVend->execute(array(':codigo' => $this->getCodigo()));

			$delPess = self::conexaoDB()->prepare("DELETE FROM pessoa WHERE codigo = :codigo");
			$delPess->execute(array(':codigo' => $this->getCodigo()));
		}

		function alterar(){
			if(!($this->getNome()==NULL)){	//Se o campo 'nome' NAO estiver vazio
				$altPess = self::conexaoDB()->prepare("UPDATE pessoa SET nome = :nome WHERE codigo = :codigo");
				$altVend = self::conexaoDB()->prepare("UPDATE vendedor SET nome = :nome WHERE codigo = :codigo");

				$altPess->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()));
				$altVend->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()));

			} if(!($this->getSetor()==NULL)){ //Se o campo 'cpf' NAO estiver vazio
				$altPess = self::conexaoDB()->prepare("UPDATE pessoa SET setor = :setor WHERE codigo = :codigo");
				$altVend = self::conexaoDB()->prepare("UPDATE vendedor SET setor  = :setor WHERE codigo = :codigo");

				$altPess->execute(array(
					': setor' => $this->getSetor(),
					':codigo' => $this->getCodigo()));
				$altVend->execute(array(
					':setor' => $this->getSetor(),
					':codigo' => $this->getCodigo()));

			}
		}
		function listar(){
			$stmt = self::conexaoDB()->prepare("SELECT * FROM vendedor");
			$stmt->execute();

			return $stmt->fetchAll();
		}
	}
?>
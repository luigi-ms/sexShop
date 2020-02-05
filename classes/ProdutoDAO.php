<?php
	include('Produto.php');
	include('IPessoa.php');
	class ProdutoDAO extends Produto implements IPessoa{
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
			$ifExists = "SELECT codigo FROM produtos WHERE codigo= :codigo";
			$stmt = self::conexaoDB()->prepare($ifExists);
			$verify = $stmt->execute(array(':codigo' => $this->getCodigo()));

			if($verify){
				$query = "INSERT INTO produtos(nome, codigo, preco, setor, estoque) VALUES(:nome, :codigo, :preco, :setor, :estoque)";

				$stmt = self::conexaoDB()->prepare($query);

				$stmt->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo(),
					':preco' => $this->getPreco(),
					':setor' => $this->getSetor(),
					':estoque' => $this->getEstoque()
				));
			} else {
				echo "Se fosdeu";
			}
		}

		function remover(){	
			$stmt = self::conexaoDB()->prepare("DELETE FROM produtos WHERE codigo = :codigo");
			$stmt->execute(array(':codigo' => $this->getCodigo()));
		}

		function alterar(){
			if(!($this->getNome()==NULL)){	//Se o campo 'nome' NAO estiver vazio
				$stmt = self::conexaoDB()->prepare("UPDATE produtos SET nome = :nome WHERE codigo = :codigo");
				$stmt->execute(array(
					':nome' => $this->getNome(),
					':codigo' => $this->getCodigo()));

			} if(!($this->getPreco()==NULL)){ //Se o campo 'preço' NAO estiver vazio
				$stmt = self::conexaoDB()->prepare("UPDATE produtos SET preco  = :preco WHERE codigo = :codigo");
				$stmt->execute(array(
					':preco' => $this->getPreco(),
					':codigo' => $this->getCodigo()));
			}

			if(!($this->getSetor()==NULL)){	//Se o campo 'setor' NAO estiver vazio
				$stmt = self::conexaoDB()->prepare("UPDATE produtos SET setor = :setor WHERE codigo = :codigo");
				$stmt->execute(array(
					':nome' => $this->getSetor(),
					':codigo' => $this->getCodigo()));

			} if(!($this->getEstoque()==NULL)){	//Se o campo 'estoque' NAO estiver vazio
				$stmt = self::conexaoDB()->prepare("UPDATE produtos SET estoque = :estoque WHERE codigo = :codigo");
				$stmt->execute(array(
					':estoque' => $this->getEstoque(),
					':codigo' => $this->getCodigo()));

			}
		}

		public static function listar(){
			$stmt = self::conexaoDB()->prepare("SELECT nome FROM produtos");
			$stmt->execute();

			return $stmt->fetchAll()[0];
		}
	}
?>
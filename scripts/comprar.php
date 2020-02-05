<?php
	/*O script para efetuar uma compra executará fa seguinte maneira: caso os codigos passados pertençam a um cliente e
	um produto cadastrados no DB, um comando SQL irá atualizar o estoque deste produto, subtraindo um(decrementando) da coluna da tabela homônima. As consequencias para caso o produto ou o cliente não existam no DB são autoexplicativas.*/
	function conexaoDB(){
		try{
			$con = new PDO('mysql:host=localhost; dbname=sexshop', "u0_a715", "");			
		}catch(PDOException $e){
			echo $e->getMessage();
		}

		return $con;
	}

	$codProd = $_POST['codProd'];
	$codCli = $_POST['codCli'];

	//As próximas duas linhas e os próximos dois if-else se valem da mesma lógica explicada na linha 8 do arquivo alterar-produto.php
	$verifProd = conexaoDB()->prepare("SELECT codigo FROM produtos WHERE codigo= :codigo");
	$verifCli = conexaoDB()->prepare("SELECT codigo FROM cliente WHERE codigo= :codCli");

	$verifProd->execute(array(':codigo' => $codProd));
	$verifCli->execute(array(':codCli' => $codCli));

	if($verifProd->rowCount()>0){
		if($verifCli->rowCount()>0){
			$compra =  conexaoDB()->prepare("UPDATE produtos SET estoque = estoque-1 WHERE codigo= :codigo");
			$compra->execute(array(':codigo' => $codProd));
			header("Location:../produto.php");
		} else {
			header("Location:../cadastro.html");
		}
	} else {
		header("Location:../internals/cadastro-produto.html");
	}
?>
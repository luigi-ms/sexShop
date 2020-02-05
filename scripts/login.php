<?php
	/*Este é o script usado para logar um cliente. Será criado um objeto PDO para conectar ao DB. Os dados passados via POST
	serão usados no comando SQL para verificar se as informações batem com o que está cadastrado. Caso sim, será redirecionado 
	para a página de alterar cliente, onde também poderá visualizar seus dados. Caso contrário, a página de login parecerá ter
	deletado os dados do campo de formulário.*/
	try{
		$con = new PDO('mysql:host=localhost; dbname=sexshop', "u0_a715", "");			
	}catch(PDOException $e){
		echo $e->getMessage();
	}

	/*Eis a lógica: caso o nome E a senha passados pertençam a alguém cadastrado, o script redirecionará para a página já citada
	para este caso. A consequencia para o caso contrário também já fora dita. Vale a pena lembrar que isto também ocorrerá caso
	os dados existam no DB mas não pertençam à mesma pessoa.*/
	$stmt = $con->prepare("SELECT * FROM cliente WHERE nome= :nome AND senha = :senha");
	$stmt->execute(array(
				':nome' => $_POST['nome'],
				':senha' => $_POST['senha']
			));	

	if($stmt->rowCount()>0){
		header("Location:../internals/alterar-cliente.php");
	} else {
		header("Location:../internals/login.html");
	}
?>
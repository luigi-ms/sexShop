<?php 
 include("../classes/ProdutoDAO.php");
	$produto = new ProdutoDAO();

 $verificarVendedor = $_POST['codigoVend'];
 $verficarProduto = $_POST['codigo'];
 $novoNome = $_POST['nome'];
 $novoPreco = $_POST['preco'];
 $novoEstoque = $_POST['estoque'];
 $novoSetor = addslashes($_POST['setor']);
 
	$selectVendedor = $produto->conexaoDB()->prepare("SELECT codigo FROM vendedor WHERE codigo= :codigo");
	$selectVendedor->execute(array(':codigo' => $verificarVendedor));

	if($selectVendedor->rowCount() > 0){
		$produto->setNome($novoNome);
		$produto->setPreco($novoPreco);
		$produto->setCodigo($verificarProduto);
		$produto->setEstoque($novoEstoque);

		switch($novoSetor){
			case '1':
				$novoSetor = 'Brinquedos';
				break;
			case '2':
				$novoSetor = 'Fantasias';
				break;
			case '3':
				$novoSetor = 'Genéricos';
				break;
		}
		$produto->setSetor($novoSetor);
		
		$produto->alterar();
		header("Location:../produto.html");
	} else {
		header("Location:../internals/cadastro-vendedor.html");
	}	
?>
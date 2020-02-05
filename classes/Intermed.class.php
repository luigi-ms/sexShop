<?php
    include('ProdutoDAO.php');
    class Intermed extends ProdutoDAO{
						public static function listagem(){
								//$prod = new ProdutoDAO();

								return parent::listar();
						}
				}
?>
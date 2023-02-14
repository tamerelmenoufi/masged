<?php
	date_default_timezone_set('America/Manaus');
	session_start();
	include("lib/fn.php");

	if($_POST['acao']){
		getPost('cadastro',$_POST['acao']);
		// file_put_contents('logs/play.txt',$_POST['acao']);
		exit();
	}

	if($_POST['data'] and $_POST['data'] != 'hoje'){
		$_SESSION['data'] = $_POST['data'];
		$_SESSION['ano'] = substr($_POST['data'], 0, 4);
		exit();
	}

	if(!$_SESSION['data'] or $_POST['data'] == 'hoje') {
		$_SESSION['data'] = date("Y-m-d");
		$_SESSION['ano'] = date("Y");
	}
	// $_SESSION['data'] = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include("lib/header.php"); ?>
	<title>MESQUITA</title>
	<style>
		body{
			width:100%;
			height:100%;
			background-image:url("img/fundo.jpg");
			background-size:100% auto;
		}
	</style>
</head>
<body>
	<div class="masged"></div>

	<script>
		$(function(){


			Dados = ()=>{

					$.ajax({
						url:"telas/azan.php",
						success:function(dados){
							$(".masged").html(dados);
						},
						error:function(){
							$.ajax({
								url:"telas/azan.php",
								success:function(dados){
									$(".masged").html(dados);
								}
							});
							console.log('Erro')
						}
					});

			}

			Dados();


		})
	</script>

	<?php include("lib/footer.php"); ?>
</body>
</html>
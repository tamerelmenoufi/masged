<?php
	date_default_timezone_set('America/Manaus');
	session_start();
	include("../lib/fn.php");
	$hoje = date("d-m-Y");
	$dados = file_get_contents("http://api.aladhan.com/v1/gToH?date=".$hoje);
	$dados = json_decode($dados);

	// var_dump($dados);
	// echo "<hr>";
	// print_r($dados->data->hijri);

	$hijri = $dados->data->hijri;

?>

<style>
	.titulo{
		font-size:50px;
		color:#fff;
		font-weight:bold;
	}
</style>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-between">
				<div class="titulo">
					<p><?=$hijri->weekday->en?>, <?=$hijri->day?> <?=$hijri->month->en?> <?=$hijri->year?></p>
					<p><?=$hijri->weekday->ar?> <?=$hijri->day?> <?=$hijri->month->ar?> <?=$hijri->year?></p>
				</div>
				<div class="titulo">
					<?php
					setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
					date_default_timezone_set('America/Sao_Paulo');
					echo strftime('%A, %d de %B de %Y', strtotime('today'));
					?>
				</div>
			</div>

		</div>
	</div>
</div>
	<script>
		$(function(){


			$("#hoje").click(function(){
				data = 'hoje';
				$.ajax({
					url:"tela/horario_dia.php",
					type:"POST",
					data:{
						data
					},
					success:function(dados){
						// window.location.href='./';
					}
				});
			});

			$("#data").change(function(){
				data = $(this).val();
				$.ajax({
					url:"tela/horario_dia.php",
					type:"POST",
					data:{
						data
					},
					success:function(dados){
						// window.location.href='./';
					}
				});
			});

			$("button[acao]").click(function(){
				acao = $(this).attr("acao");
				$.ajax({
					url:"tela/horario_dia.php",
					type:"POST",
					data:{
						acao
					},
					success:function(dados){
						//
					}
				});
			});

		})
	</script>
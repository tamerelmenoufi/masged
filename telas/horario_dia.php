<?php
	date_default_timezone_set('America/Manaus');
	session_start();
	include("../lib/fn.php");

	$dados = file_get_contents("http://api.aladhan.com/v1/gToH?date=10-02-2023");
	$dados = json_decode($dados);

	var_dump($dados);
	echo "<hr>";
	print_r($dados->data->hijri);

	$hijri = $dados->data->hijri;

?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="d-flex justify-content-between">
				<span class="titulo"><?=$hijri->weekday->en?>, <?=$hijri->day?> <?=$hijri->month->en?> <?=$hijri->year?></span>
				<span class="titulo"><?=$hijri->weekday->ar?>, <?=$hijri->day?> <?=$hijri->month->ar?> <?=$hijri->year?></span>
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
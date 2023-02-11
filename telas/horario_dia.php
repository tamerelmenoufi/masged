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
		color:#fff;
		width:45%;
	}
	.titulo p, .titulo i{
		font-size:20px;
		font-weight:bold;
	}
	.rotulo span{
		font-size:12px;
	}
	.horarios{
		width:100%;
		font-size:25px;
		font-weight:bold;
		color:#333333;
		padding-top:30px;
		padding-bottom:30px;
		border:solid 10px green;
		border-radius:25px;
		background:#fff;
	}
	.hora{
		font-size:75px;
	}
</style>
<div style="position:fixed; top:0; right:0; bottom:0; left:0; padding:30px; border:solid 5px red;">

	<div class="row mt-3">
		<div class="col-12">
			<div class="d-flex justify-content-between">
				<div class="titulo">
					<button class="btn btn-success w-100">
						<div class="d-flex justify-content-between rotulo">
							<span>Rijri</span>
							<i class="fa-solid fa-calendar-day"></i>
							<span>الهجرية</span>
						</div>
						<p><?=$hijri->weekday->ar?> <?=$hijri->day?> <?=$hijri->month->ar?> <?=$hijri->year?></p>
						<p><?=$hijri->weekday->en?>, <?=$hijri->day?> <?=$hijri->month->en?> <?=$hijri->year?></p>
					</button>
				</div>
				<div class="titulo">
					<button class="btn btn-success w-100">
						<div class="d-flex justify-content-between rotulo">
							<span>Nascimento</span>
							<i class="fa-solid fa-calendar-day"></i>
							<span>الميلادي</span>
						</div>
						<p><?=dataArabe();?></p>
						<p><?=dataPort();?></p>
					</button>


				</div>
			</div>
		</div>
	</div>


	<div class="row mt-3">
		<div class="col-12 mt-3">

		<?php

			$hoje = date("Y-m-d");

			$dados = file_get_contents("../dados/horas-salah.json");

			$Json = json_decode($dados);

			foreach($Json as $mes => $dias){

				foreach($dias as $dia => $s){
					$dt = $_SESSION['ano'].'-'.c($mes).'-'.c($dia);

					if($dt == $hoje){

				foreach($s as $c => $h){
				?>
				<div>
				<button type="button" class="horarios">
					<div class="d-flex justify-content-between">
						<div class="col">
							<i class="fa-solid fa-person-praying"></i>
							<?=portugues($c)?>
						</div>
						<div class="col hora">
							<!-- <i class="fa-regular fa-clock"></i> -->
							<?=c($h->h)?>:<?=c($h->m)?>
						</div>
						<div class="col">
							<?=arabe($c)?>
							<i class="fa-solid fa-person-praying" style="transform: rotateY(180deg);"></i>
						</div>
					</div>
				</button>
				</div>
				<?php
				}
			}
			}
			}
		?>




					<div class="row" style="margin-bottom:30px;">
						<div class="col-12">
							<div class="titulo w-100">
								<button class="btn btn-success w-100" style="padding:0;">
									<div class="row">
										<div class="col-12 text-center">
											<span><i class="fa-regular fa-clock" style="font-size:125px; margin-right:70px;"></i></span>
											<span style="font-size:150px;"><?=date("H:i")?></span>
										</div>
									</div>
								</button>
							</div>
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
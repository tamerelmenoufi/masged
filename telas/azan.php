<?php
	date_default_timezone_set('America/Manaus');
	session_start();
	include("../lib/fn.php");

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

	function c($c){
		return str_pad($c , 2 , '0' , STR_PAD_LEFT);
	}

?>
<div class="container">
		<div class="row">

			<div class="col-md-2">
				<div class="p-3">
					<button class="btn btn-primary btn-lg" id="hoje">
						<i class="fa-solid fa-calendar-days"></i>
						Today
					</button>
				</div>
			</div>
			<div class="col-md-10">
				<div class="p-3">
					<input type="date" id="data" value="<?=$_SESSION['data']?>" class="form-control form-control-lg" />
				</div>
			</div>


			<div class="p-3">
				<?php

					$hoje = $_SESSION['data'];

					$dados = file_get_contents("../dados/horas-salah.json");

					$Json = json_decode($dados);

					$cron = false;


					foreach($Json as $mes => $dias){

						foreach($dias as $dia => $s){
							$dt = $_SESSION['ano'].'-'.c($mes).'-'.c($dia);
							if($dt == $hoje){
				?>

					<div class="card">
					<div class="card-body">
						<h5 class="card-title">
							<i class="fa-solid fa-calendar-days"></i>
							<?=c($dia)?>/<?=c($mes)?>/<?=$_SESSION['ano']?>
						</h5>
					</div>
					<ul class="list-group list-group-flush">
						<?php
						foreach($s as $c => $h){
						?>
						<li class="list-group-item d-flex justify-content-between align-items-start">
							<div class="ms-2 me-auto">
								<i class="fa-solid fa-person-praying"></i>
								<?=strtoupper($c)?>
							</div>
							<span class="badge text-dark rounded-pill">
								<i class="fa-regular fa-clock"></i>
								<?=c($h->h)?>:<?=c($h->m)?>
							</span>
						</li>
						<?php
						}
						?>
					</ul>
					</div>

					<?php
							}
						}
					}
					?>


				<div class="col-md-12">
					<div class="p-3 d-flex justify-content-between">
						<button class="btn btn-success" acao="PLAY">
							<i class="fa-solid fa-play"></i>
							Play
						</button>
						<button class="btn btn-danger" acao="STOP">
							<i class="fa-solid fa-stop"></i>
							Stop
						</button>
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
					url:"tela/azan.php",
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
					url:"tela/azan.php",
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
					url:"tela/azan.php",
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
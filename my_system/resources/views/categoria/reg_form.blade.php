
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('head2')
	<script src="javascript/template-controller.js"></script>

	<script defer>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load-categoria-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
    });
    </script>
<body class="antialiased">
<header class="header-section">

<!--<i class="fa-solid fa-bars" style="color: #f7f7f8;"></i>-->
<div id="logo">
	<img src="{{ asset('cead.jpg') }}">
    <label id="titulo">Sistema Gestão de Contratos do CEAD</label>
</div>

<!-- <button id="bt-quit">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></button>-->
<p id="header-right"><a id="quit-link" width="fit-content" href="{{url('logout')}}" class="rounded bg-red-600 text-white px-2 py-1">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></a></p>
</header>


<main class="main-section">
        @include('side')
    <div class="content-section">
        <div id="content-header">
			<label id="cont-title">Home</label>
		</div>
		<div id="info">

			<h3>Registar Categoria de deisciplina</h3>
			<form id="categoria-reg" action="" method="post" novalidate>
				<div id="feedback"></div>
				<!--<div class="row">-->
					<div class="form-group">
						<label>Designação</label>
						<input required="true" type="text" class="form-control" 1id="floatingInput" name="designacao_categoria" placeholder="Designação">
						<!--<small class="form-text text-muted" for="floatingInput">Designação</small>-->
					</div>
				<!--</div>-->
				
				<div class="row" id="div-button">
					<button class="rounded bg-green-600 text-white px-2 py-1" width="fit-content" onclick="reg_categoria()">Registar categoria</button>
				</div>
				
			</form>
		</div>
	</div>
</main>
@include('../footer')
</body>
<header class="header-section">

<!--<i class="fa-solid fa-bars" style="color: #f7f7f8;"></i>-->
<div id="logo">
    <!--<i id="menu-icon" class="fa-solid fa-bars"style="color: #e6ebf5;"></i>-->
    <img id="img-logo" src="cead.png">
    <label id="titulo">Sistema Gestão de Contratos do CEAD</label>
    <label style="color:white;padding: 10px;"><a href="/user/my_profile">user: {{auth()->user()->name}}</a></label>
</div>



<!-- <button id="bt-quit">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></button>-->
<p id="header-right"><a id="quit-link" width="fit-content" href="{{url('logout')}}" class="btn btn-danger">sair<i id="quit" class="fa-solid fa-power-off" style="color: #f4f0f0;"></i></a></p>
</header>
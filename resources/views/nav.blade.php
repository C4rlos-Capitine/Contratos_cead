 <!-- Top navigation-->
  <style>
    .bi{
        cursor: pointer;
        color: #4CAF50;
    }
    nav.navbar.navbar-expand-lg.navbar-light.bg-light.border-bottom {
    background-color: #FFF59D !important;
}
  </style>
 <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-arrow-bar-left"  id="sidebarToggle" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
    </svg>
    
        <h1>Sistema de Gestão de Contratos de Tutoria</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active"><a class="nav-link" href="/user/my_profile"><i class="fas fa-user-circle"></i></a></li>
                <li class="nav-item active"><a class="btn-danger nav-link" href="{{url('logout')}}"><i id="quit" class="fa-solid fa-power-off" style="color:rgb(244, 13, 13);">Sair</i></a></li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/user/my_profile">Perfil</a>
                        <a class="dropdown-item" href="{{url('logout')}}"><i id="quit" class="fa-solid fa-power-off" style="color:rgb(244, 13, 13);"></i>Sair</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Alterar senha</a>
                    </div>
                </li>-->
            </ul>
        </div>
    </div>
</nav>
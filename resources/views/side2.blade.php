<style>
    .list-group-item{
        cursor: pointer;
        background: #A5D6A7
    }
    #img-logo{
        margin-left:2px;
        width: 7rem;
        height: 3rem;
    }
    #sidebar-wrapper .sidebar-heading{
        color: #A5D6A7 !important;
        padding-left: 3rem;
    }
    #sidebar-wrapper{
        background: #A5D6A7 !important;
    }
</style>
<div class="d-flex" id="wrapper">

<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light"><img id="img-logo" src="{{asset('cead.png')}}"></div>
    <div class="list-group list-group-flush">
        @if(auth()->user()->tipo_user == 1)
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/" onclick="loadPage(this)"><i class="fa-solid fa-house" style="color: #004D40;margin-right: 5px;"></i>Início</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/user/reg" onclick="loadPage(this)"><i class="bi bi-people-fill" style="color: #004D40;margin-right: 5px;"></i>Utilizadores</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/faculdade/reg" onclick="loadPage(this)"><i class="fas fa-school" style="color: #004D40;margin-right: 5px;"></i>Faculdades</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/representante/reg" onclick="loadPage(this)"><i class="fas fa-school" style="color: #004D40;margin-right: 5px;"></i>Representante da UP</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/curso/reg_form" onclick="loadPage(this)"><i class="fas fa-object-ungroup" style="color: #004D40;margin-right: 5px;"></i>Áreas Científicas</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/disciplina/reg" onclick="loadPage(this)"><i class="fas fa-object-ungroup" style="color: #004D40;margin-right: 5px;"></i>Disciplinas</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/vizualisar" onclick="loadPage(this)"><i class="fas fa-chalkboard-teacher" style="color: #004D40;margin-right: 5px;"></i>Tutores</a>
            <!--<div class="dropdown pb-1">
                <a class="list-group-item list-group-item-action list-group-item-light p-3 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Docentes</a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" data-value="/docente/reg" onclick="loadPage(this)">Registar</a></li>
                    <li><a class="dropdown-item" data-value="/docente/vizualisar" onclick="loadPage(this)">Visualizar</a></li>
                </ul>
            </div>-->
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/tec/reg" onclick="loadPage(this)"><i class="fa-solid fa-flask-vial" style="color: #004D40;margin-right: 5px;"></i>Técnico de Laboratório</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/alocar" onclick="loadPage(this)"><i class="fas fa-object-ungroup" style="color: #004D40;margin-right: 5px;"></i>Alocar Disciplinas</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/curso/ver" onclick="loadPage(this)"><i class="bi bi-mortarboard-fill" style="color: #004D40;margin-right: 5px;"></i>Cursos</a>
            <div class="list-group-item list-group-item-action list-group-item-light p-3 dropdown pb-1 nav-content" id="load-contrato-view">
                    <a href="#" class="list-group-item list-group-item-action list-group-item-light p-3 dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1"><i class="fa-solid fa-file-contract" style="color: #004D40;margin-right: 5px;"></i>Contratos</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <div id="load-contrato-view" data-value="/clausulas/ver" class="nav-content clickable"><label class="menu-label">Cláusulas</label></div>
                        <div id="load-contrato-view" data-value="/contrato/ver" class="nav-content clickable"><label class="menu-label">Contratos de Tutoria</label></div>
                        <div id="load-contrato-view" data-value="/contrato_ta/contrato_trib_admnistrativo/" class="nav-content clickable"><label class="menu-label">Contratos no TA</label></div>
                        <div id="load-contrato-view-lab" data-value="/contrato/ver_lab" class="nav-content clickable"><label class="menu-label">Contratos de técnico de laboratório</label></div>
                        <div id="load-contrato-gerar" data-value="/contrato/gerar" class="nav-content clickable"><label class="menu-label">Gerar Contrato</label></div>
                    </ul>
                </div><!-- /clausulas/ver -->
        @elseif(auth()->user()->tipo_user == 2)
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/" onclick="loadPage(this)"><i class="fa-solid fa-house" style="color: #004D40;margin-right: 5px;"></i>Início</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/faculdade/list" onclick="loadPage(this)"><i class="fas fa-school" style="color: #004D40;margin-right: 5px;"></i>Faculdades</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/curso/ver" onclick="loadPage(this)"><i class="bi bi-mortarboard-fill" style="color: #004D40;margin-right: 5px;"></i>Cursos</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/vizualisar" onclick="loadPage(this)"><i class="fas fa-chalkboard-teacher" style="color: #004D40;margin-right: 5px;"></i>Tutores</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/alocar" onclick="loadPage(this)"><i class="fas fa-object-ungroup" style="color: #004D40;margin-right: 5px;"></i>Alocar Disciplinas</a>
        @elseif(auth()->user()->tipo_user == 3)
            <input id="user-email" class="user-email" value="{{auth()->user()->email}}" type="hidden">
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/dados/{{auth()->user()->id}}" onclick="loadPage(this)"><i class="fa-solid fa-house" style="color: #004D40;margin-right: 5px;"></i>Início</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="/docente/contrato" onclick="loadPage(this)"><i class="fa-solid fa-file-contract" style="color: #004D40;margin-right: 5px;"></i>Contratos</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" data-value="#" onclick="loadPage(this)"><i class="fa-solid fa-file-arrow-up" style="color: #004D40;margin-right: 5px;"></i>Submeter Contrato</a>
        @endif
    </div>
</div>

<script>
    function loadPage(element) {
        const url = element.getAttribute('data-value');
        // Aqui você pode adicionar a lógica para carregar a página
        window.location.href = url; // Exemplo simples
    }
</script>
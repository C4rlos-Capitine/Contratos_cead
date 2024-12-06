<script ></script>
<aside class="side-section">
        
<div class="nav-bar">
            @if(auth()->user()->tipo_user == 1)
            <div id="home1" class="nav-content clickable" data-value="/"><i class="fa-solid fa-house" style="color: #e6ebf5;"></i><label class="menu-label">Início</label></div>
                
                <!--<div id="home" class="nav-content clickable" data-value="/cead_template2/curso/estatistica"><i class="fa-solid fa-chart-simple" style="color: #ebeef4;"></i><label class="menu-label">Estatisticas</label></div>-->
                <div id="load-faculdade-form" data-value="/faculdade/reg" class="nav-content clickable"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Faculdade</label></div>
                <div id="load-representante-form" class="nav-content clickable" data-value="/representante/reg"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Representante</label></div>
                <div id="load-curso-form" data-value="/curso/reg" class="nav-content clickable"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar curso</label></div>
                <!--<div id="load-cat-disciplina-form" data-value="/cead_template2/categoria/reg" class="nav-content clickable" ><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Categoria de disciplina</label></div>-->
                <div id="load-disciplina-form" data-value="/disciplina/reg" class="nav-content clickable" ><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Disciplina</label></div>
                <div id="load-docente-form" data-value="/docente/reg" class="nav-content clickable"><i class="fa-solid fa-pen-to-square" style="color: #eff1f6;"></i><label class="menu-label">Registar Docente</label></div>
                <!--
                <div id="load-curso-disciplina-form" data-value="/cead_template2/disciplina/associar" class="nav-content clickable"><i class="fa-solid fa-files" style="color: #e4e5ec;"></i><label class="menu-label">Associar disciplina a curso</label></div>
                --->
                <div id="load-faculdade-view" data-value="/faculdade/vizualisar" class="nav-content clickable"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Faculdades</label></div>
                
                <div id="load-discilplina-alocar-form" data-value="/docente/alocar" class="nav-content clickable"><i class="fa-solid fa-chalkboard-user" style="color: #f0f2f5;"></i><label class="menu-label">Alocar disciplinas</label></div>
                <div id="load-curso-view" data-value="/curso/ver" class="nav-content clickable"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Cursos</label></div>
                <div id="load-docente-view"  data-value="/docente/vizualisar" class="nav-content clickable"><i class="fa-solid fa-table-list" style="color: #eff0f0;"></i><label class="menu-label">Visualizar Docentes</label></div>
                <div id="load-contrato-view" data-value="/contrato/ver" class="nav-content clickable"><i class="fa-solid fa-file-contract" style="color: #e9eaed;"></i><label class="menu-label">Contratos de Tutoria</label></div>
                <div id="load-contrato-view-lab" data-value="/contrato/ver_lab" class="nav-content clickable"><i class="fa-solid fa-file-contract" style="color: #e9eaed;"></i><label class="menu-label">Contratos de técnico de laboratório</label></div>
                <div id="load-contrato-form" class="nav-content clickable"><i class="fa-solid fa-file-pen" style="color: #eceff3;"></i><label class="menu-label">Gerar Contrato</label></div>
            @else
                <input id="user-email" class="user-email" value="{{auth()->user()->email}}" type="hidden">
                <!-- onclick="load_data_docente()" -->
                <div id="load-docente-data" data-value="/docente/find?email={{auth()->user()->email}}" class="nav-content clickable" ><i class="fa-solid fa-user" style="color: #f8f9fc;"></i><label class="menu-label">Meus dados</label></div>
                <div id="load-docente-contrato" data-value="/contrato/ver_disciplina_by_email?email={{auth()->user()->email}}" class="nav-content clickable"><i class="fa-solid fa-file-pen" style="color: #eceff3;"></i><label class="menu-label">Contratos</label></div>
                <div id="load-docente-contrato" data-value="#" class="nav-content clickable"><i class="fa-solid fa-file-pen" style="color: #eceff3;"></i><label class="menu-label">Submeter contrato</label></div>
                
            @endif
        </div>
    </aside>
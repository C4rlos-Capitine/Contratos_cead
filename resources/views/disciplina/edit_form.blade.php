<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('head2')
<style>
    #div-button { width: fit-content; height: auto; }
    @media (max-width:500px) { #div-button { width: fit-content; height: auto; } }
    .row { margin-top: 5px; padding: 5px; text-align: left; }
</style>
<body class="antialiased">
@include('side2')
<div id="page-content-wrapper">
    @include('nav')
    <div class="container-fluid">
        <div id="info">
            <h1 class="mt-4">Editar Disciplina/Módulo</h1>
            <div id="feedback"></div>
            <form id="disciplina-edit" class="needs-validation" method="POST" action="{{ route('disciplina.update', $disciplina->codigo_disciplina) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <label class="input-label">Nome da Disciplina<span style="color:red">*</span></label>
                        <input required type="text" class="form-control" name="nome_disciplina" value="{{ $disciplina->nome_disciplina }}">
                    </div>
                    <div class="col">
                        <label class="input-label">Código da disciplina<span style="color:red">*</span></label>
                        <input required type="text" class="form-control" name="codigo_disciplina" value="{{ $disciplina->codigo_disciplina }}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="input-label">Sigla<span style="color:red">*</span></label>
                        <input required type="text" class="form-control" name="sigla" value="{{ $disciplina->sigla_disciplina }}">
                    </div>
                    <div class="col">
                        <label>Categoria</label>
                        <select class="form-select" name="id_categoria" required>
                            <option value="">Selecione...</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id_cat_disciplina }}" {{ $disciplina->id_cat_disciplina == $categoria->id_cat_disciplina ? 'selected' : '' }}>
                                    {{ $categoria->designacao_categoria }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Curso</label>
                        <select class="form-select" name="id_curso" required>
                            <option value="">Selecione...</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id_curso }}" {{ $disciplina->id_curso_in_disciplina == $curso->id_curso ? 'selected' : '' }}>
                                    {{ $curso->designacao_curso }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Ano</label>
                        <select class="form-select" name="ano_curso" required>
                            <option value="">Selecione...</option>
                            @for($i=1; $i<=4; $i++)
                                <option value="{{ $i }}" {{ $disciplina->ano == $i ? 'selected' : '' }}>{{ $i }}º ano</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col">
                        <label>Semestre</label>
                        <select class="form-select" name="semestre_curso" required>
                            <option value="">Selecione...</option>
                            <option value="1" {{ $disciplina->semestre == 1 ? 'selected' : '' }}>I semestre</option>
                            <option value="2" {{ $disciplina->semestre == 2 ? 'selected' : '' }}>II semestre</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Horas de contacto</label>
                        <select class="form-select" name="horas_c" required>
                            <option value="">Selecione...</option>
                            @foreach([6,18,25,31,38,44,50] as $hora)
                                <option value="{{ $hora }}" {{ $disciplina->horas_contacto == $hora ? 'selected' : '' }}>{{ $hora }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Área científica</label>
                        <select class="form-select" name="cod_area" required>
                            <option value="">Selecione...</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->cod_area }}" {{ $disciplina->cod_area_in_disciplina == $area->cod_area ? 'selected' : '' }}>
                                    {{ $area->designacao_area }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row" id="div-button">
                    <button class="rounded bg-green-600 text-white px-2 py-1" type="submit">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
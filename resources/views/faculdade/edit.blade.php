
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="javascript/template-controller.js"></script>
@include('head2')
<style>
    #div-button {
        width: fit-content;
        height: auto;
    }

    @media (max-width: 500px) {
        #div-button {
            width: fit-content;
            height: auto;
        }
    }

    .row {
        margin-top: 5px;
        padding: 5px;
        text-align: left;
    }
</style>

<body class="antialiased">
    <script defer>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('load-faculdade-form').style.backgroundColor = "rgba(9, 32, 76, 0.882)";
        });
    </script>
    @include('side2')

    <div id="page-content-wrapper">
        @include('nav')
        <!-- Page content-->
        <div class="container-fluid">
              @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Erros de Validação -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="info">
                <h1 class="mt-4">Editar dados da Faculdade</h1>
                <div id="feedback"></div>
                <form id="faculdade-reg">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label class="input-label">Designação:<span style="color:red">*</span></label>
                            <input type="text" name="nome_faculdade" class="form-control" placeholder="Designação"
                                value="{{ $faculdade->nome_faculdade }}">
                        </div>
                        <div class="col">
                            <label class="input-label">Sigla:<span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="sigla_faculdade" placeholder="Sigla"
                                value="{{ $faculdade->sigla_faculdade }}">
                        </div>
                        <input type="hidden" id="id_faculdade" name="id_faculdade" value="{{ $faculdade->id_faculdade }}">
                    </div>
                </form>

                <div class="row">
                    <div style="padding:20px" class="row" id="div-button">
                        <button class="rounded bg-green-600 text-white px-2 py-1" id="submit" width="fit-content"
                            onclick="edit_faculdade()">Gravar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('../footer')

    <script>
        function edit_faculdade() {
            event.preventDefault(); // Evita o envio padrão do formulário

            // Obtém os dados do formulário
            const formData = new FormData(document.getElementById('faculdade-reg'));

            // Envia a requisição AJAX
            fetch('/faculdade/update/'+$('#id_faculdade').val(), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('feedback').innerHTML = '<div class="alert alert-success">Atualizado com sucesso!</div>';
                } else {
                    document.getElementById('feedback').innerHTML = '<div class="alert alert-danger">Erro ao atualizar.</div>';
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                document.getElementById('feedback').innerHTML = '<div class="alert alert-danger">Erro ao atualizar.</div>';
            });
        }
    </script>
</body>
</html>
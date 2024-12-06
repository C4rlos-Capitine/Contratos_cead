<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Garamond;
            font-size: 12px;
            line-height: 1.5;
        }
        main{
            padding: 20px;
            text-align: center;
        }
        header{
            text-align: center;
        }
        footer{
            text-align: center;
        }
        .doc-title{
            width: 100%;
            text-align: center;
        }
        p {
            text-align: justify;
            line-height: 1.2;
        }
        .table{
            width: 100%;
            text-align: center;
            
        }
        table {
            border-collapse: collapse;
            border-style: solid;
        }
        th, td {
            border: 1px solid #000; /* Set border to 1px solid black */
            padding: 1px;
            
            text-align: center;
            text-align: justify;
        }
        .alineas{
            margin-left: 50px;
            line-height: 1.0;
        }
        .alineas p{
            line-height: 1.0;
        }

        .modulos-col{
            width: 300px;
        }
        .outros-col{
            text-align: center; 
            padding: 5px;
        }

        .footer-section{
            margin: 80px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            text-align:center;

            /*background-color: #f0f0f0;*/
            padding: 20px;
        }

       
        .footer-child{
            display: inline-block;
            width: 45%; /* Adjust the width as needed */
            vertical-align: top; /* Align elements from the top */
        }
        #data{
            width: 100%;
            text-align:center;
        }
       
    </style>
</head>
<body>
    <header>
    <!--<img src="{{ public_path('header.png') }}" width="90%" height="70px">-->
    @php
    $imagePath = public_path('header.png'); // Path to your image file
    $imageData = base64_encode(file_get_contents($imagePath)); // Encode image data as Base64
    $imageSrc = 'data:image/png;base64,' . $imageData; // Construct the image source
    @endphp

    <img src="{{ $imageSrc }}" width="90%" height="70px" alt="Image">


    </header>
    <main>
    <div class="doc-title"><h2>TERMO DO CONTRATO</h2></div>
        <p>Entre a Universidade Pedagógica de Maputo, representada pela Profª. Doutora Marisa Guião de Mendonça, 
            no âmbito da Delegação de competências conforme a alínea i), do nº 1, do Despacho nº 03/GR-023.6/UP/2019, de 01 de Abril, doravante designada por "Contratante" e 
            o <b>{{$contrato->nome_docente}}</b><b>{{$contrato->apelido_docente}}</b>, titular do BI nº. <b>{{$contrato->bi}}</b>, NUIT nº. <b>{{$contrato->nuit}}</b>, de nacionalidade <b>{{$contrato->nacionalidade}}</b>, doravante designado(a) por "Contratado(a)", 
            é celebrado o presente Contrato, nos termos do Decreto nº 89/99 de 28 de Dezembro que se regerá pelas seguintes cláusulas:
        </p>
        {{$contrato->designacao_curso}}
    </main>
</body>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h3>Total de registros: {{ count($linhas) }}</h3>

<table>
    <thead>
    <tr>
        <th>Aplicação</th>
        <th>Código Solicitação</th>
        <th>Unidade</th>
        <th>Conta</th>
        <th>Agência</th>
        <th>Telefone</th>
        <th>Data Emissão</th>
        <th>Valor Total</th>
        <th>Matrícula Criação</th>
        <th>Data Criação</th>
        <th>Matrícula Alteração</th>
        <th>Data Alteração</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($linhas as $linha)
        <tr>
            <td>{{ $linha['no_aplicacao'] ?? '' }}</td>
            <td>{{ $linha['cd_solicitacao'] ?? '' }}</td>
            <td>{{ $linha['no_unidade'] ?? '' }}</td>
            <td>{{ $linha['nr_conta'] ?? '' }}</td>
            <td>{{ $linha['nr_agencia'] ?? '' }}</td>
            <td>{{ $linha['nr_telefone'] ?? '' }}</td>
            <td>{{ !empty($linha['dt_emissao']) ? \Carbon\Carbon::parse($linha['dt_emissao'])->format('d/m/Y') : '' }} </td>
            <td>{{ isset($linha['vlr_total'])? number_format($linha['vlr_total'], 2, ',', '.'): '' }}</td>
            <td>{{ $linha['nr_matricula_create'] ?? '' }}</td>

            <td>{{ !empty($linha['dt_create'])? \Carbon\Carbon::parse($linha['dt_create'])->format('d/m/Y') : '' }}</td>
            <td>{{ $linha['nr_matricula_update'] ?? '' }}</td>
            <td>{{ !empty($linha['dt_update'])? \Carbon\Carbon::parse($linha['dt_update'])->format('d/m/Y') : '' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
    <h3>Total de registros: {{ count($linhas) }}</h3>

    <!-- Exibe os dados -->
    <pre>@php print_r($linhas) @endphp</pre>

    <table class="table table-bordered table-hover" style="font-size: 12px;">
        <thead>
        <tr>
            <th>Aplicação</th>
            <th>Código Solicitação</th>
            <th>Dependência</th>
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
                        <td>{{ $linha['no_dependencia'] ?? '' }}</td>
                        <td>{{ $linha['no_unidade'] ?? '' }}</td>
                        <td>{{ $linha['nr_conta'] ?? '' }}</td>
                        <td>{{ $linha['nr_agencia'] ?? '' }}</td>
                        <td>{{ $linha['nr_telefone'] ?? '' }}</td>
                        <td>{{ $linha['dt_emissao'] ?? '' }}</td>
                        <td>
                            {{ isset($linha['vl_total'])
                                ? number_format($linha['vl_total'], 2, ',', '.')
                                : '' }}
                        </td>
                        <td>{{ $linha['nr_matricula_create'] ?? '' }}</td>
                        <td>{{ $linha['dt_criacao'] ?? '' }}</td>
                        <td>{{ $linha['nr_matricula_update'] ?? '' }}</td>
                        <td>{{ $linha['dt_update'] ?? '' }}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>











</body>
</html>

<div class="kt-section__content">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Nome Completo:</th>
            <td>{{ $user->name }}</td>
            <th>Email:</th>
            <td>{{ $user->email }}</td>
            <th>Status:</th>
            <td>{{ $user->getStatusLabel() }}</td>
        </tr>
        <tr>
            <th>Cpf:</th>
            <td>{{ $user->cpf }}</td>
            <th>Data Nascimento:</th>
            <td>{{ optional($user->data_nascimento)->format('d/m/Y') }}</td>
            <th>Sexo:</th>
            <td>{{ ($user->sexo ?? '') === 'FE' ? 'Feminino' : 'Masculino' }} </td>
        </tr>
        </tbody>
    </table>
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
    <h5>Contatos</h5>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>Contato</th>
            <th>Principal</th>
        </tr>
        </thead>
        <tbody>
        @php
            $contatos = is_string($user->contato) ? json_decode($user->contato, true) : $user->contato;
        @endphp

        @if(is_array($contatos) && count($contatos) > 0)
            @foreach($contatos as $contato)
                <tr>
                    <td>{{ $contato['tipo'] ?? '-' }}</td>
                    <td>{{ $contato['descricao'] ?? '-' }}</td>
                    <td>{{ ($contato['flg_principal'] ?? '') === 'T' ? 'SIM' : 'NÃO' }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="3" class="text-center">Sem contatos</td></tr>
        @endif

        </tbody>
    </table>
</div>

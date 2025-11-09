<div class="kt-section__content">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Nome da Permissão (Role):</th>
            <td>{{ $permissao->name }}</td>
            <th>Status:</th>
            <td>{{ $permissao->status }}</td>
            <th>Descrição:</th>
            <td>{{ $permissao->description }}</td>
        </tr>
        </tbody>
    </table>

    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
    <h5>Abilities por Módulo</h5>

    <table class="table table-striped table-bordered table-hover table-checkable responsive no-wrap">
        <thead>
        <tr>
            <th style="width: 30%">Módulo</th>
            <th>Abilities Ativas</th>
        </tr>
        </thead>
        <tbody>
        @php
            $grouped = $permissao->abilities->groupBy(fn($a) => optional($a->module)->id ?? 'sem_modulo');
        @endphp

        @forelse ($grouped as $moduleId => $abilities)
            @php $module = $abilities->first()->module; @endphp
            <tr>
                <td>
                    {{ $module->display_name ?? 'Sem módulo ativo' }}
                    <br>
                    <small class="text-muted">{{ $module->name ?? '-' }}</small>
                </td>
                <td>
                    @foreach ($abilities as $a)
                        <span class="kt-badge kt-badge--dark kt-badge--inline kt-badge--pill kt-badge--rounded">
                    <strong>{{ $a->display_name ?? $a->name }}</strong>
                </span>
                    @endforeach
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center text-muted">Nenhuma ability encontrada.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>

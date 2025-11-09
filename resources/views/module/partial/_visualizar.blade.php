<div class="kt-section__content">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Nome interno (slug):</th>
            <td>{{ $module->name }}</td>
            <th>Nome exibido:</th>
            <td>{{ $module->display_name }}</td>
        </tr>
        </tbody>
    </table>
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
    <h5>Abilites</h5>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Nome (slug)</th>
            <th>Nome exibido</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($module) && $module->abilities->count())
            @foreach($module->abilities as $i => $ability)
                <tr>
                    <td>{{ $ability['name'] ?? '-' }}</td>
                    <td>{{ $ability['display_name'] ?? '-' }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="3" class="text-center">Sem abilities</td></tr>
        @endif

        </tbody>
    </table>
</div>

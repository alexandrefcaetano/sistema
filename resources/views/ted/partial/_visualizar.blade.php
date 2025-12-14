<div class="kt-section__content">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th>Cod Dependencia:</th>
            <td>{{ $teds->cd_dependencia ?? ''}}</td>
            <th>Nome Dependencia:</th>
            <td>{{ $teds->no_unidade ?? ''}}</td>
        </tr>
        <tr>
            <th>Conta:</th>
            <td>{{ $teds->nr_conta ?? '' }}</td>
            <th>Agencia:</th>
            <td>{{ $teds->nr_agencia ?? '' }}</td>
        </tr>
        <tr>
            <th>Telefone:</th>
            <td>{{ $teds->nr_telefone ?? '' }}</td>
            <th>Data Emissão:</th>
            <td>{{ $teds->dt_emissao->format('d/m/Y') ?? '' }}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                <!-- texto -->
                <span id="status-text">
            {{ $teds->status->no_status ?? '' }}
        </span>

                <!-- select escondido -->
                <select id="status-select" class="form-control d-none">
                    @foreach($status as $stat)
                        <option value="{{ $stat->cd_status }}"
                            {{ $stat->cd_status == $teds->cd_status ? 'selected' : '' }}>
                            {{ $stat->no_status }}
                        </option>
                    @endforeach
                </select>
            </td>

            <th>Valor total:</th>
            <td>{{ $teds->vlr_total }}</td>
        </tr>

        </tbody>
    </table>
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
    <h5>Valores:</h5>
    <table class="table table-bordered table-hover">
        <tbody>
        @if(isset($teds->valores) && $teds->valores->count())
            @foreach($teds->valores as $i => $valor)
                <tr>
                    <td>Valor:</td>
                    <td>{{ $valor->vlr_ted }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="3" class="text-center">Sem Valores</td></tr>
        @endif

        </tbody>
    </table>
    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
    <h5>Observação</h5>

    <table class="table table-bordered table-hover">
        <tbody>
            @if($teds->exists)
                @foreach($teds->solicitacao->complementos as $complemento)
                    <tr>
                         <td>
                             <label class="text-capitalize">
                                {{ $complemento->usuario->no_usuario }}
                                ({{ $complemento->nr_matricula }}) -
                                {{ $complemento->status->no_status }} -
                                {{ $complemento->dt_complemento->format('d/m/Y H:i') }}
                            </label>
                         </td>
                         <td>
                             {{$complemento->ds_obs}}
                         </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan="3" class="text-center">Obs...</td></tr>
            @endif
        </tbody>
    </table>
    <div class="form-group d-none" id="obs-container">
        <label>Nova observação</label>
        <textarea class="form-control" id="ds_obs" rows="4"></textarea>
    </div>

    <input type="hidden" id="cd_ted" value="{{ $teds->cd_ted }}">
</div>

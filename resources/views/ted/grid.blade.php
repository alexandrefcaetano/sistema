@extends('layout.main')

@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Lista Teds</span>
            </li>
        </ul>
    </div>
    <h3 class="page-title"> Teds</h3>
    <!-- END PAGE BAR -->
    @php
        $hasFilters = request()->except(['page', 'per_page']) !== [];
    @endphp
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN BORDERED TABLE PORTLET-->
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-body">
                    <div class="table-toolbar" style="margin-top: 30px">
                        <div class="panel-group accordion" id="accordion3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2"> <span aria-hidden="true" class="icon-magnifier"></span> Pesquisa </a>
                                    </h4>
                                </div>
                                <div id="collapse_3_2" class="panel-collapse collapse">
                                    <div class="panel-body">

                                        <form method="GET" action="{{ route('ted.index') }}">
                                            <div class="row">
                                                <div class="form-group ">
                                                <div class="col-lg-2">
                                                    <label class="control-label">Solicitação:</label>
                                                    <input type="text" name="cd_solicitacao"
                                                           id="cd_solicitacao" class="form-control"
                                                           placeholder="Numero da Solicitação"
                                                           value="{{ request('cd_solicitacao') }} ">
                                                    <span class="form-text text-muted">Numero da Solicitação.</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="control-label">Cod Dependencia:</label>
                                                    <input type="text" name="cd_dependencia"
                                                           id="cd_dependencia" class="form-control"
                                                           placeholder="Numero Dependencia"
                                                           value="{{ request('cd_dependencia') }}">
                                                    <span class="form-text text-muted">Numero da Dependencia.</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="control-label">Conta:</label>
                                                    <input type="text" name="nr_conta" id="nr_conta"
                                                           class="form-control" placeholder="Conta"
                                                           value="{{ request('nr_conta')}}">
                                                    <span class="form-text text-muted">Informe a Conta.</span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="control-label">Data Emissão:</label>
                                                    <input type="text" name="dt_emissao"
                                                           class="form-control" id="kt_datepicker_1"
                                                           value="{{ request('dt_emissao') }}" readonly
                                                           placeholder="Select date"/>
                                                    <span class="form-text text-muted">Data Emissão.</span>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="control-label">Status:</label>
                                                    <div class="form-group">
                                                        <select class="form-control" id="status"
                                                                name="cd_status">
                                                            <option value="">Selecione...</option>
                                                            @foreach($status as $st)
                                                                <option value="{{ $st->cd_status }}"
                                                                    {{ request('cd_status') == $st->cd_status ? 'selected' : '' }}>
                                                                    {{ $st->no_status }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span class="form-text text-muted">Status.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                <div class="col-lg-2">
                                                    <label class="control-label">Valor Total Inicial:</label>
                                                    <input type="text" name="vlr_inicio" id="vlr_inicio"
                                                           class="form-control"
                                                           placeholder="Numero da Solicitação"
                                                           value="{{ request('vlr_inicio') }}">
                                                    <span class="form-text text-muted">Valor Inicio.</span>
                                                </div>
                                                <div class="col-lg-2">
                                                    <label class="control-label">Valor Total Final:</label>
                                                    <input type="text" name="vlr_fim" id="vlr_fim"
                                                           class="form-control"
                                                           placeholder="Numero da Solicitação"
                                                           value="{{ request('vlr_fim') }}">
                                                    <span class="form-text text-muted">Valor Fim.</span>
                                                </div>
                                            </div>
                                            </div>
                                            <hr>

                                            <div class="form-actions left">
                                                <a href="{{ route('ted.index') }}" class="btn btn-warning ml-2"> Limpar </a>
                                                <button type="submit" class="btn btn-success ml-4" id="btn-pesquisar">Pesquisar </button>

                                                <div class="btn-group">
                                                    <a  class="btn purple dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Export
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li class="">
                                                            <a
                                                                href="{{ route('ted.relatorio.pdf', array_merge(request()->query(), ['mode' => 'print'])) }}"
                                                                target="_blank"
                                                                class="kt-nav__link"
                                                            >
                                                                <i class="kt-nav__link-icon la la-print"></i>
                                                                <span class="kt-nav__link-text">Print</span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a
                                                                href="{{ route('ted.export', array_merge(request()->all(), ['format' => 'xlsx'])) }}"
                                                                class="kt-nav__link"
                                                            >
                                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                <span class="kt-nav__link-text">Excel</span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a
                                                                href="{{ route('ted.export', array_merge(request()->all(), ['format' => 'csv'])) }}"
                                                                class="kt-nav__link"
                                                            >
                                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                <span class="kt-nav__link-text">CSV</span>
                                                            </a>

                                                        </li>
                                                        <li class="">
                                                            <a
                                                                href="{{ route('ted.relatorio.pdf', array_merge(request()->query(), ['mode' => 'download'])) }}"
                                                                class="kt-nav__link"
                                                                target="_blank"
                                                            >
                                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                <span class="kt-nav__link-text">PDF</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>
                    <div class="btn-group pull-right">
                        <a href="{{ route('ted.create') }}" id="sample_editable_1_new" class="btn sbold green">   <i class="fa fa-plus"></i> Novo Ted </a>
                    </div>
                    <form method="GET" class="mb-3">
                        <div class="form-inline">
                            <label for="per_page" class="mr-2">Registros por página:</label>
                            <select name="per_page" id="per_page" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                @foreach ([10, 20, 50, 100] as $size)
                                    <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <div class="table-scrollable">
                        <table class="table table-bordered table-hover  table-advance">
                            <thead>
                            <tr>
                                <th>Solicitação</th>
                                <th>Total Vlr.</th>
                                <th>Dependencia</th>
                                <th>Telefone</th>
                                <th>Data Emissão</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($teds as $ted)
                                <tr>
                                    <td>{{ $ted->cd_solicitacao }}</td>
                                    <td>{{ format_number($ted->vlr_total) }}</td>
                                    <td>{{ $ted->no_unidade }}</td>
                                    <td>{{ $ted->nr_telefone }}</td>
                                    <td>{{ $ted->dt_emissao}}</td>
                                    <td>{{ $ted->status->no_status }}</td>

                                    <td>
                                        @can('Module.update')
                                            <a href="{{ route('ted.edit', $ted->cd_ted) }}" class="btn yellow btn-outline tooltips" data-original-title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endcan
                                        @can('Module.list')
                                            <a href="{{ route('ted.show', $ted->cd_ted) }}"
                                               class="btn blue btn-outline visualizar-modulo tooltips" data-original-title="Visualizar">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        @endcan
                                        @can('Module.delete')
{{--                                            <form action="{{ route('ted.destroy', $ted->cd_ted) }}"--}}
{{--                                                  method="POST" class="d-inline">--}}
{{--                                                @csrf--}}
{{--                                                @method('DELETE')--}}

                                                <button class="btn red btn-outline btn-excluir tooltips" data-original-title="Exluir Logicamente">
                                                    <i class="fa fa-trash-o"></i></button>

{{--                                            </form>--}}
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex justify-content-left">
                        {{ $teds->appends(['per_page' => $perPage])->links() }}
                    </div>
                </div>
            </div>
            <!-- END BORDERED TABLE PORTLET-->
        </div>
    </div>


    <div id="visualizar" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" style="width: 1400px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Confirmation</h4>
                </div>
                <div class="modal-body" id="visualizar-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

                    <button type="button" class="btn btn-warning" id="btn-editar">
                        Editar
                    </button>

                    <button type="button" class="btn btn-success d-none" id="btn-atualizar">
                        Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '#btn-editar', function () {

            // troca status
            $('#status-text').addClass('d-none');
            $('#status-select').removeClass('d-none');

            // mostra textarea
            $('#obs-container').removeClass('d-none');

            // troca botões
            $('#btn-editar').addClass('d-none');
            $('#btn-atualizar').removeClass('d-none');
        });

        $(document).on('click', '#btn-atualizar', function () {

            const cdTed = $('#cd_ted').val();
            const cdStatus = $('#status-select').val();
            const dsObs = $('#ds_obs').val();

            $.ajax({
                url: '/ted/atualizar/' + cdTed,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cd_status: cdStatus,
                    ds_obs: dsObs
                },
                success: function (response) {
                    console.log(response);
                    $('#visualizar').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    console.error(xhr.status);
                    console.error(xhr.responseText);
                    alert('Erro ao atualizar');
                }
            });
        });

        $(document).on('click', '.visualizar-modulo', function (e) {
            e.preventDefault();

            const url = $(this).attr('href');
            const modal = $('#visualizar');
            const modalBody = $('#visualizar-body');

            // Mostra o modal e indica que está carregando
            modal.modal('show');
            modalBody.html('<div class="text-center p-3">Carregando...</div>');
            $.ajax({
                url: url,
                type: 'GET',
                success: function (html) {
                    modalBody.html(html);
                },
                error: function () {
                    modalBody.html('<div class="text-danger p-3">Erro ao carregar os dados.</div>');
                }
            });
        });

        // Confirmação de exclusão
        document.querySelectorAll('.btn-excluir').forEach((btn) => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                const form = this.closest('form');

                Swal.fire({
                    title: "Deseja excluir o Module?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Excluir!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });


        @if(session('success'))
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3500
        });
        @endif
        @if(session('error'))
        Swal.fire({
            position: "top-end",
            title: '{{ session('error') }}',
            timer: 2500,
            timerProgressBar: true,
            showConfirmButton: false
        });
        @endif
    </script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}"  type="text/javascript"></script>
@endsection


@extends('layout/main')

@section('content')

    <style>
        .accordion > .card {
            overflow: visible;
        }
    </style>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"> Dashboard </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link"> Teds </a>
                </div>
            </div>
        </div>

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="kt-font-brand flaticon2-line-chart"></i>
                        </span>
                            <h3 class="kt-portlet__head-title">
                                Lista de Teds
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
{{--                                    @can('Module.create')--}}
                                    <a href="{{ route('ted.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                        <i class="la la-plus"></i>
                                        Novo Teds
                                    </a>
{{--                                    @endcan--}}
                                </div>

                            </div>
                        </div>
                    </div>
                    @php
                        $hasFilters = request()->except(['page', 'per_page']) !== [];
                    @endphp
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <div class="kt-portlet ">
                                <div class="kt-portlet__body">
                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title " data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                                                    <i class="fab fa-sistrix"></i> Pesquisa
                                                </div>
                                            </div>
                                            <div id="collapseOne6" class="collapse {{ $hasFilters ? 'show' : '' }}" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                                                <div class="card-body">

                                                    <form method="GET" action="{{ route('ted.index') }}">
                                                        <div class="form-group row">
                                                            <div class="col-lg-2">
                                                                <label>Solicitação:</label>
                                                                <input type="text" name="cd_solicitacao" id="cd_solicitacao" class="form-control" placeholder="Numero da Solicitação"  value="{{ request('cd_solicitacao') }} " >
                                                                <span class="form-text text-muted">Numero da Solicitação.</span>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Cod Dependencia:</label>
                                                                <input type="text" name="cd_dependencia" id="cd_dependencia" class="form-control" placeholder="Numero Dependencia"  value="{{ request('cd_dependencia') }}" >
                                                                <span class="form-text text-muted">Numero da Dependencia.</span>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Conta:</label>
                                                                <input type="text" name="nr_conta" id="nr_conta" class="form-control"  placeholder="Conta"  value="{{ request('nr_conta')}}" >
                                                                <span class="form-text text-muted">Informe a Conta.</span>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label class="">Data Emissão:</label>
                                                                <input type="text" name="dt_emissao" class="form-control" id="kt_datepicker_1" value="{{ request('dt_emissao') }}"  readonly placeholder="Select date" />
                                                                <span class="form-text text-muted">Data Emissão.</span>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label>Status:</label>
                                                                <div class="form-group">
                                                                    <select class="form-control" id="status" name="cd_status">
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
                                                        <div class="form-group row">
                                                            <div class="col-lg-2">
                                                                <label>Valor Total Inicial:</label>
                                                                <input type="text" name="vlr_inicio" id="vlr_inicio" class="form-control" placeholder="Numero da Solicitação"  value="{{ request('vlr_inicio') }}" >
                                                                <span class="form-text text-muted">Valor Inicio.</span>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Valor Total Final:</label>
                                                                <input type="text" name="vlr_fim" id="vlr_fim" class="form-control" placeholder="Numero da Solicitação"  value="{{ request('vlr_fim') }}" >
                                                                <span class="form-text text-muted">Valor Fim.</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <a href="{{ route('ted.index') }}" class="btn btn-warning ml-2">
                                                                Limpar
                                                            </a>

                                                            <button type="submit" class="btn btn-success ml-4" id="btn-pesquisar">
                                                                Pesquisar
                                                            </button>

                                                            <div class="dropdown dropdown-inline ml-4">
                                                                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="la la-download"></i> Export
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <ul class="kt-nav">
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon la la-print"></i>
                                                                                <span class="kt-nav__link-text">Print</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a href="#" class="kt-nav__link">
                                                                                <i class="kt-nav__link-icon la la-copy"></i>
                                                                                <span class="kt-nav__link-text">Copy</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a
                                                                                href="{{ route('ted.export', array_merge(request()->all(), ['format' => 'xlsx'])) }}"
                                                                                class="kt-nav__link"
                                                                            >
                                                                                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                                                <span class="kt-nav__link-text">Excel</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a
                                                                                href="{{ route('ted.export', array_merge(request()->all(), ['format' => 'csv'])) }}"
                                                                                class="kt-nav__link"
                                                                            >
                                                                                <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                                                <span class="kt-nav__link-text">CSV</span>
                                                                            </a>

                                                                        </li>
                                                                        <li class="kt-nav__item">
                                                                            <a
                                                                                href="{{ route('ted.relatorio.pdf', request()->query()) }}"
                                                                                class="kt-nav__link"
                                                                            >
                                                                                <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                                                <span class="kt-nav__link-text">PDF</span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Accordion-->
                                </div>
                            </div>
                            <div class="kt-section__content">
                                <form method="GET" class="mb-3">
                                    <div class="form-inline">
                                        <label for="per_page" class="mr-2">Registros por página:</label>
                                        <select name="per_page" id="per_page" class="form-control form-control-sm" onchange="this.form.submit()">
                                            @foreach ([10, 20, 50, 100] as $size)
                                                <option value="{{ $size }}" {{ $perPage == $size ? 'selected' : '' }}>{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                    <tr>
                                        <th>Solicitação</th>
                                        <th>Total Vlr. </th>
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
                                                <a href="{{ route('ted.edit', $ted->cd_ted) }}" class="btn btn-outline-warning btn-sm btn-icon btn-icon-md">
                                                    <i class="flaticon-edit"></i>
                                                </a>
                                                @endcan
                                                @can('Module.list')
                                                <a href="{{ route('ted.show', $ted->cd_ted) }}"
                                                   class="btn btn-outline-brand btn-sm btn-icon btn-icon-md visualizar-modulo">
                                                    <i class="flaticon2-search-1"></i>
                                                </a>
                                                @endcan
                                                @can('Module.delete')
                                                    <form action="{{ route('ted.destroy', $ted->cd_ted) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger btn-sm btn-icon btn-icon-md btn-excluir" >
                                                            <i class="flaticon2-trash"></i>
                                                        </button>
                                                    </form>
                                                @endcan

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-left">
                                    {{ $teds->appends(['per_page' => $perPage])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="visualizar" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Module</h5>
                        <button type="button" class="close" data-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="visualizar-body">
                        <!-- Conteúdo será carregado aqui -->
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

                const cdTed    = $('#cd_ted').val();
                const cdStatus = $('#status-select').val();
                const dsObs    = $('#ds_obs').val();

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
                title:  '{{ session('error') }}',
                timer: 2500,
                timerProgressBar: true,
                showConfirmButton: false
            });
            @endif
        </script>
        <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    @endsection


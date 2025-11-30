@extends('layout/main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"> Empty Page </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link"> Aplicacões </a>
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
                                Lista de Aplicaceos
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-wrapper">
                                <div class="kt-portlet__head-actions">
{{--                                    @can('Module.create')--}}
                                    <a href="{{ route('aplicacoes.create') }}" class="btn btn-brand btn-elevate btn-icon-sm">
                                        <i class="la la-plus"></i>
                                        Nova Aplicaçao
                                    </a>
{{--                                    @endcan--}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                    <tr>
                                        <th>Aplicação</th>
                                        <th>Codigo </th>
                                        <th>Tipo</th>
                                        <th>Telefone</th>
                                        <th></th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($aplicaceos as $aplicaceo)
                                        <tr>
                                            <td>{{ $aplicaceo->no_aplicacao }}</td>
                                            <td>{{ $aplicaceo->cd_aplicacao }}</td>
                                            <td>{{ $aplicaceo->no_tipo }}</td>
                                            <td>{{$aplicaceo->nr_telefone_gestor}}</td>
                                            <td>{{ $aplicaceo->st_aplicacao }}</td>

                                            <td>
                                                @can('Module.update')
                                                <a href="{{ route('aplicaceao.edit', $aplicaceo->cd_aplicacao) }}" class="btn btn-outline-warning btn-sm btn-icon btn-icon-md">
                                                    <i class="flaticon-edit"></i>
                                                </a>
                                                @endcan
                                                @can('Module.list')
                                                <a href="{{ route('aplicaceao.show', $aplicaceo->cd_aplicacao) }}"
                                                   class="btn btn-outline-brand btn-sm btn-icon btn-icon-md visualizar-modulo">
                                                    <i class="flaticon2-search-1"></i>
                                                </a>
                                                @endcan
                                                @can('Module.delete')
                                                    <form action="{{ route('aplicaceao.destroy', $aplicaceo->cd_aplicacao) }}" method="POST" class="d-inline">
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

                </div>
            </div>

        </div>
    </div>





@endsection
@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>


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
@endsection


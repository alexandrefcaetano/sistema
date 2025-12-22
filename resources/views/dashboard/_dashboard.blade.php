@

@extends('layout._main')

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
                    <a href="" class="kt-subheader__breadcrumbs-link"> General </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link"> Empty Page </a>
                </div>
            </div>
        </div>

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
                <div class="alert alert-light alert-elevate" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                    <div class="alert-text">
                        The Metronic Datatable component supports initialization from HTML table. It also defines the
                        schema model of the data source. In addition to the visualization, the Datatable
                        provides built-in support for operations over data such
                        as sorting, filtering and paging performed in user browser(frontend).
                    </div>
                </div>
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
                                    <a href="{{ route('aplicacoas.create') }}"
                                       class="btn btn-brand btn-elevate btn-icon-sm">
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
                                <table
                                    class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                                    <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Aplicação</th>
                                        <th>Codigo</th>
                                        <th>Tipo</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($aplicaceos as $aplicacao)
                                        <tr>
                                            <td>{{ $aplicacao->cd_aplicacao }}</td>
                                            <td>
                                                @if ($aplicacao->no_rota && Route::has($aplicacao->no_rota))
                                                    <a href="{{ route($aplicacao->no_rota) }}">{{ $aplicacao->no_aplicacao }}</a>
                                                @else
                                                    {{ $aplicacao->no_aplicacao }}
                                                @endif
                                            </td>

                                            <td>{{ $aplicacao->no_aplicacao }}</td>
                                            <td>{!! $aplicacao->status_badge !!}</td>

                                            <td>
                                                @can('Module.update')
                                                    <a href="{{ route('aplicacoas.edit', $aplicacao->cd_aplicacao) }}"
                                                       class="btn btn-outline-warning btn-sm btn-icon btn-icon-md">
                                                        <i class="flaticon-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('Module.list')
                                                    {{--                                                <a href="{{ route('aplicacoas.show', $aplicacao->cd_aplicacao) }}"--}}
                                                    {{--                                                   class="btn btn-outline-brand btn-sm btn-icon btn-icon-md visualizar-modulo">--}}
                                                    {{--                                                    <i class="flaticon2-search-1"></i>--}}
                                                    {{--                                                </a>--}}
                                                @endcan
                                                @can('Module.delete')
                                                    <form
                                                        action="{{ route('aplicacoas.delete', $aplicacao->cd_aplicacao) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            class="btn btn-outline-danger btn-sm btn-icon btn-icon-md btn-excluir">
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
@endsection

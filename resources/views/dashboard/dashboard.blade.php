@

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
                    The Metronic Datatable component supports initialization from HTML table. It also defines the schema model of the data source. In addition to the visualization, the Datatable
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
                            Lista de Usuário
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-wrapper">
                            <div class="kt-portlet__head-actions">
                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i> Expotar
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="kt-nav">
                                            <li class="kt-nav__section kt-nav__section--first">
                                                <span class="kt-nav__section-text">Choose an option</span>
                                            </li>
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
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                                    <span class="kt-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-text-o"></i>
                                                    <span class="kt-nav__link-text">CSV</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a href="#" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-file-pdf-o"></i>
                                                    <span class="kt-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                &nbsp;
                                <a href="#" class="btn btn-brand btn-elevate btn-icon-sm">
                                    <i class="la la-plus"></i>
                                    Novo Usuário
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Status:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_status">
                                                    <option value="">All</option>
                                                    <option value="1">Pending</option>
                                                    <option value="2">Delivered</option>
                                                    <option value="3">Canceled</option>
                                                    <option value="4">Success</option>
                                                    <option value="5">Info</option>
                                                    <option value="6">Danger</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-form__group kt-form__group--inline">
                                            <div class="kt-form__label">
                                                <label>Type:</label>
                                            </div>
                                            <div class="kt-form__control">
                                                <select class="form-control bootstrap-select" id="kt_form_type">
                                                    <option value="">All</option>
                                                    <option value="1">Online</option>
                                                    <option value="2">Retail</option>
                                                    <option value="3">Direct</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                                <a href="#" class="btn btn-default kt-hidden">
                                    <i class="la la-cart-plus"></i> New Order
                                </a>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-section">
                        <div class="kt-section__content">

                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                    <th>Data Cadastro</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->getStatusLabel() }}</td>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Visualizar</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente excluir?')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhum usuário encontrado.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="d-flex justify-content-center">
                                        <ul class="pagination">
                                            <!-- First -->
                                            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $users->url(1) }}&per_page={{ $perPage }}">Primeira</a>
                                            </li>

                                            <!-- Previous -->
                                            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $users->previousPageUrl() }}&per_page={{ $perPage }}">Anterior</a>
                                            </li>

                                            <!-- Links das páginas -->
                                            @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                                <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $url }}&per_page={{ $perPage }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next -->
                                            <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $users->nextPageUrl() }}&per_page={{ $perPage }}">Próxima</a>
                                            </li>

                                            <!-- Last -->
                                            <li class="page-item {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $users->url($users->lastPage()) }}&per_page={{ $perPage }}">Última</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <form method="GET" class="form-inline mb-3">
                                        <label for="per_page" class="mr-2">Registros por página:</label>
                                        <select name="per_page" id="per_page" class="form-control mr-2" onchange="this.form.submit()">
                                            <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                                            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                            <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                            <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                        </select>
                                        <noscript><button type="submit" class="btn btn-primary btn-sm">Aplicar</button></noscript>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

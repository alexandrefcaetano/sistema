@extends('layout._main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ isset($perm) ? 'Editar Permissões' : 'Cadastro de Permissões' }}
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home">
                        <i class="flaticon2-shelter"></i>
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('permissao.index') }}" class="kt-subheader__breadcrumbs-link">Lista</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        {{ isset($perm) ? 'Editar Permissão' : 'Formulário de Permissão' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Portlet -->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ isset($perm) ? 'Editar Permissão' : 'Cadastrar Permissão' }}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form
                    action="{{ isset($perm) ? route('permissao.update', ['id' => $perm->id]) : route('permissao.store') }}"
                    method="POST" class="kt-form kt-form--label-right form">
                @csrf
                @if(isset($perm))
                    @method('PUT')
                @endif

                {{-- Exibição de erros --}}
                @if ($errors->any())
                    <div class="alert alert-danger m-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="kt-portlet__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">

                            {{-- Campo: Nome da Role --}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nome da Permissão (Role):</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="Nome da Permissão"
                                           value="{{ old('name', $perm->name ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe o nome da permissão.</span>
                                </div>
                            </div>

                            {{-- Campo: Status --}}
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status:</label>
                                <div class="col-lg-6">
                                    <select name="status" class="form-control" required>
                                        <option value="AT" {{ old('status', $perm->status ?? '') == 'AT' ? 'selected' : '' }}>
                                            Ativo
                                        </option>
                                        <option value="IN" {{ old('status', $perm->status ?? '') == 'IN' ? 'selected' : '' }}>
                                            Inativo
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-text-input" class="col-3 col-form-label">Descricao:</label>
                                <div class="col-6">
                                    <textarea class="form-control" rows="3"
                                              name="description">{{ old('name', $perm->description ?? '') }}</textarea>
                                    <span class="form-text text-muted">We'll never share your email with anyone else</span>
                                </div>
                            </div>


                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                            <h3 class="kt-section__title mt-4">Permissões (Abilities):</h3>
                            <table class="table table-striped- table-bordered table-hover table-checkable responsive no-wrap">
                                @foreach ($modules as $module)
                                    <tr>
                                        <td>
                                            <strong>{{ $module->display_name }}</strong><br>
                                            <small class="text-muted">{{ $module->name }}</small>
                                        </td>
                                        <td>
                                            <div class="kt-checkbox-inline">
                                                @foreach ($module->abilities as $ability)
                                                    <label class="kt-checkbox    {{ isset($perm) && $perm->abilities->contains($ability->id) ? 'kt-checkbox--success' : 'kt-checkbox--brand' }} ">
                                                        <input type="checkbox"
                                                               name="abilities[]"
                                                               value="{{ $ability->id }}"
                                                                {{ isset($perm) && $perm->abilities->contains($ability->id) ? 'checked' : '' }}>
                                                        {{ ucfirst($ability->display_name ?? $ability->name) }}
                                                        <span></span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Rodapé -->
                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($perm) ? 'Atualizar' : 'Salvar' }}
                                </button>
                                <a href="{{ route('permissao.index') }}" class="btn btn-danger">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection

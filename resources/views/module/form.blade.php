@extends('layout._main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ isset($mdle) ? 'Editar Módulo' : 'Cadastro Módulo' }}
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
                        {{ isset($module) ? 'Editar Módulo' : 'Formulário de Módulo' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Portlet -->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ isset($module) ? 'Editar Módulo' : 'Cadastrar Módulo' }}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form
                    action="{{ isset($module) ? route('module.update', ['id' => $module->id]) : route('module.store') }}"
                    method="POST" class="kt-form kt-form--label-right form">
                @csrf
                @if(isset($module))
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
                                <label class="col-lg-3 col-form-label">Nome interno (slug):</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                           name="name"
                                           class="form-control"
                                           placeholder="Nome interno"
                                           value="{{ old('name', $module->name ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe o Nome interno (slug).</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Nome exibido:</label>
                                <div class="col-lg-6">
                                    <input type="text"
                                           name="display_name"
                                           class="form-control"
                                           placeholder="Nome da exibido"
                                           value="{{ old('display_name', $module->name ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe o Nome.</span>
                                </div>
                            </div>


                            {{-- Abilities --}}
                            <h3 class="kt-section__title mt-4">Ability:</h3>
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" id="abilities-table">
                                        <thead>
                                        <tr>
                                            <th>Nome (slug)</th>
                                            <th>Nome exibido</th>
                                            <th style="width: 50px;">
                                                <button type="button" class="btn btn-icon btn-success" id="add-ability">
                                                    <i class="fa fa-plus"></i></button>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($module) && $module->abilities->count())
                                            @foreach($module->abilities as $i => $ability)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="abilities[{{ $i }}][name]"
                                                               class="form-control"
                                                               value="{{ old("abilities.$i.name", $ability->name) }}"
                                                               required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="abilities[{{ $i }}][display_name]"
                                                               class="form-control"
                                                               value="{{ old("abilities.$i.display_name", $ability->display_name) }}">
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                                class="btn btn-icon btn-danger remove-ability">
                                                            <i class="la la-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td><input type="text" name="abilities[0][name]" class="form-control"
                                                           required></td>
                                                <td><input type="text" name="abilities[0][display_name]"
                                                           class="form-control"></td>
                                                <td>
                                                    <button type="button"
                                                            class="btn btn-icon btn-danger remove-ability"><i
                                                                class="la la-trash"></i></button>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
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
                                    {{ isset($module) ? 'Atualizar' : 'Salvar' }}
                                </button>
                                <a href="{{ route('module.index') }}" class="btn btn-danger">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Pega o número de linhas já existentes na tabela
            let index = document.querySelectorAll('#abilities-table tbody tr').length;

            document.getElementById('add-ability').addEventListener('click', function () {
                const tableBody = document.querySelector('#abilities-table tbody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>
                    <input type="text" name="abilities[${index}][name]" class="form-control" required>
                </td>
                <td>
                    <input type="text" name="abilities[${index}][display_name]" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-danger remove-ability">
                        <i class="la la-trash"></i>
                    </button>
                </td>
            `;
                tableBody.appendChild(newRow);
                index++; // incrementa o contador para a próxima adição
            });

            // Remover linha
            document.querySelector('#abilities-table').addEventListener('click', function (e) {
                if (e.target.closest('.remove-ability')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection


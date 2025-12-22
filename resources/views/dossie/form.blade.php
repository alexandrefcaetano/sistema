@extends('layout._main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $dossie->exists ? 'Editar Dossie' : 'Cadastro Dossie' }}
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home">
                        <i class="flaticon2-shelter"></i>
                    </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('ted.index') }}" class="kt-subheader__breadcrumbs-link">Lista</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link">
                        {{ $dossie->exists ? 'Editar Dossie' : 'Formulário de Dossie' }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Portlet -->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ $dossie->exists ? 'Editar Dossie' : 'Cadastrar Dossie' }}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form
                action="{{ $dossie->exists ? route('dossie.update', ['sq_dossie' => $dossie->sq_dossie]) : route('dossie.store') }}"
                method="POST" class="kt-form kt-form--label-right form">
                @csrf
                @if($dossie->exists)
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
                            <div class="form-group row">
                                <div class="col-lg-4">
                                    <label>Destino:</label>
                                    <div class="form-group">
                                        <select class="form-control" id="destino" name="cd_dossie_destino">
                                            <option value="">Selecione</option>
                                            @foreach ($destinos as $id => $descricao)
                                                <option
                                                    value="{{ $id }}" {{ old('cd_dossie_destino', $dossie->cd_dossie_destino ?? '') == $id? 'selected' : '' }}>{{ $descricao }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Selecione o Destino</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Tipo de Documento:</label>
                                    <div class="form-group">
                                        <select class="form-control" id="cd_tipo_documento_dossie"
                                                name="cd_tipo_documento_dossie">
                                            <option value="">Selecione</option>
                                            @foreach ($tipoDocumentos as $id => $descricao)
                                                <option
                                                    value="{{ $id }}" {{ old('cd_tipo_documento_dossie', $dossie->cd_tipo_documento_dossie ?? '') == $id? 'selected' : '' }}>{{ $descricao }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Selecione o Tipo de Documento</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label>Cod Dependencia:</label>
                                    <input type="text" name="cd_dependencia" id="cd_dependencia" class="form-control"
                                           placeholder="Numero Dependencia"
                                           value="{{ old('cd_dependencia', $dossie->cd_dependencia ?? '') }}" required>
                                    <span class="form-text text-muted">Numero da Dependencia.</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Nome Dependencia:</label>
                                    <input type="text" name="no_unidade" id="no_unidade" class="form-control"
                                           placeholder="Unidade"
                                           value="{{ old('no_unidade', $dossie->no_unidade ?? '') }}" required>
                                    <span class="form-text text-muted">Nome Unidade.</span>
                                </div>
                                <div class="col-lg-3">
                                    <label>Telefone:</label>
                                    <input type="text" name="nr_telefone" class="form-control mask_celular"
                                           placeholder="Telefone"
                                           value="{{ old('nr_telefone', $dossie->nr_telefone ?? '') }}">
                                    <span class="form-text text-muted">Entre com o Telefone</span>
                                </div>
                                <div class="col-lg-3">
                                    <label class="">Data Emissão:</label>
                                    <input type="text" name="dt_emissao" class="form-control" id="kt_datepicker_1"
                                           value="{{ old('dt_emissao', $dossie->dt_emissao ? $dossie->dt_emissao->format('d/m/Y') : '') }}"
                                           readonly placeholder="Select date"/>
                                </div>
                            </div>
                            <div class="form-group row" id="cecad">
                                <div class="col-lg-3">
                                    <label>Conta:</label>
                                    <input type="text" name="nr_conta" id="nr_conta" class="form-control"
                                           placeholder="Conta" value="{{ old('nr_conta', $dossie->nr_conta ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe a Conta.</span>
                                </div>
                                <div class="col-lg-4">
                                    <label>Produto:</label>
                                    <div class="form-group">
                                        <select class="form-control" id="cd_produto_conta" name="cd_produto_conta">
                                            @foreach ($tipoDocumentos as $id => $descricao)
                                                <option value="{{ $id }}">{{ $descricao }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Selecione o Tipo de Documento</span>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Ordem:</label>
                                    <div class="form-group">
                                        <select class="form-control" id="cd_especie_conta" name="cd_especie_conta">
                                            @foreach ($tipoDocumentos as $id => $descricao)
                                                <option value="{{ $id }}">{{ $descricao }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-muted">Selecione o Tipo de Documento</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="agencia">
                                <div class="col-lg-3">
                                    <label>CPF/CNPJ:</label>
                                    <input type="text" name="dn_cpf_cnpj" id="dn_cpf_cnpj" class="form-control"
                                           placeholder="Conta"
                                           value="{{ old('dn_cpf_cnpj', $dossie->dn_cpf_cnpj ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe a Conta.</span>
                                </div>
                                <div class="col-lg-3">
                                    <label>Conta:</label>
                                    <input type="text" name="nr_conta" id="nr_conta" class="form-control"
                                           placeholder="Conta" value="{{ old('nr_conta', $dossie->nr_conta ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe a Conta.</span>
                                </div>
                                <div class="col-lg-3">
                                    <label>Chave Negócio:</label>
                                    <input type="text" name="ds_chave_negocio" id="ds_chave_negocio"
                                           class="form-control" placeholder="Conta"
                                           value="{{ old('ds_chave_negocio', $dossie->ds_chave_negocio ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe a Conta.</span>
                                </div>
                            </div>

                            <h3 class="kt-section__title">Anexos:</h3>
                            <hr>

                            <div id="anexos-wrapper">


                                <div class="form-group">
                                    <label>File Browser</label>
                                    <div></div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>


                                <div class="form-group row" id="anexo-item">
                                    <div class="col-lg-5">
                                        <label>Anexos</label>
                                        <div></div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="anexo[]" id="customFile">
                                            <label class="custom-file-label" for="customFile"></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <label class="">Descrição Documento:</label>
                                        <textarea class="form-control" name="descricao_anexo[]" rows="1"></textarea>
                                    </div>
                                    <div class="col-lg-2 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger remove-anexo">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-11 kt-align-right">
                                <button type="button" class="btn btn-icon btn-success ali" id="add-anexo"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            <hr>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="">Observação:</label>
                                    <textarea class="form-control" name="ds_obs" rows="3"></textarea>
                                    @if($dossie->exists)
                                        @foreach($dossie->solicitacao->complementos as $complemento)
                                            <label class="">{{$complemento->no_usuario}} ({{$complemento->nr_matricula}}
                                                ) - {{$complemento->no_status_solicitacao}}
                                                - {{$complemento->dt_complemento}}</label>
                                            <textarea class="form-control" disabled
                                                      rows="3">{{$complemento->ds_obs}}</textarea>
                                        @endforeach
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div>


                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ $dossie->exists ? 'Atualizar' : 'Salvar' }}
                                </button>
                                <a href="{{ route('dossie.index') }}" class="btn btn-danger">Voltar</a>
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
        $(document).ready(function () {

            $('#add-anexo').on('click', function () {
                let novoAnexo = `
                    <div class="form-group row anexo-item">
                         <div class="col-lg-5">
                            <label>Anexos</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="anexo[]" id="customFile">
                                <label class="custom-file-label" for="customFile"></label>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <label class="">Descrição Documento:</label>
                            <textarea class="form-control" name="descricao_anexo[]" rows="1"></textarea>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <button type="button" class="btn btn-icon btn-danger remove-anexo ali">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;

                $('#anexos-wrapper').append(novoAnexo);
            });

            $(document).on('click', '.remove-anexo', function () {
                $(this).closest('.anexo-item').remove();
            });

        });
    </script>


    <script>
        $(document).ready(function () {

            function controlarDestino() {
                let destino = $('#destino').val();

                $('#cecad').hide();
                $('#agencia').hide();

                if (destino == '1') {
                    $('#cecad').slideDown();
                } else if (destino == '2') {
                    $('#agencia').slideDown();
                }
            }

            $('#destino').on('change', controlarDestino);

            // chama no load (EDIÇÃO)
            controlarDestino();
        });

        <script>
            $(document).ready(function () {

            $("#teds").validate({

                // ignora campos ocultos
                ignore: ":hidden:not(select)",

                rules: {
                    cd_dependencia: {
                        required: true,
                        digits: true
                    },
                    no_unidade: {
                        maxlength: 255
                    },
                    nr_conta: {
                        required: true,
                        digits: true
                    },
                    dt_emissao: {
                        required: true,
                        date: true
                    }
                },

                messages: {
                    cd_dependencia: {
                        required: "Informe o código da dependência",
                        digits: "Somente números"
                    },
                    nr_conta: {
                        required: "Informe a conta",
                        digits: "Somente números"
                    },
                    dt_emissao: {
                        required: "Informe a data de emissão"
                    }
                },

                errorElement: "span",
                errorClass: "invalid-feedback",

                highlight: function (element) {
                    $(element).addClass("is-invalid");
                },

                unhighlight: function (element) {
                    $(element).removeClass("is-invalid");
                },

                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },

                submitHandler: function (form) {
                    form.submit();
                }
            });

        });
    </script>

    </script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/select2.js') }}"
            type="text/javascript"></script>


    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/input-mask.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/components/extended/sweetalert2.js') }}"
            type="text/javascript"></script>
@endsection





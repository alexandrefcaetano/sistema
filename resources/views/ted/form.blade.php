@extends('layout.main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $teds->exists ? 'Editar Teds' : 'Cadastro Teds' }}
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
                        {{ $teds->exists ? 'Editar TEDs' : 'Formulário de TEDs' }}
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
            <div class="row">
                <div class="col-lg-12">

                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    {{ $teds->exists ? 'Editar' : 'Cadastro' }}
                                </h3>
                            </div>
                        </div>


                        <!--begin::Form-->
                        <form
                            action="{{ $teds->exists ? route('ted.update', ['cd_ted' => $teds->cd_ted]) : route('ted.store') }}" method="POST" class="kt-form kt-form--label-right form" id="teds">
                            @csrf
                            @if($teds->exists)
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
                                            <div class="col-lg-2">
                                                <label>Cod Dependencia:</label>
                                                <input type="text" name="cd_dependencia" id="cd_dependencia" class="form-control" placeholder="Numero Dependencia"  value="{{ old('cd_dependencia', $teds->cd_dependencia ?? '') }}" required>
                                                <span class="form-text text-muted">Numero da Dependencia.</span>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Nome Dependencia:</label>
                                                <input type="text" name="no_unidade" id="no_unidade" class="form-control"  placeholder="Unidade"  value="{{ old('display_name', $teds->no_unidade ?? '') }}">
                                                <span class="form-text text-muted">Nome Unidade.</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Conta:</label>
                                                <input type="text" name="nr_conta" id="nr_conta" class="form-control"  placeholder="Conta"  value="{{ old('nr_conta', $teds->nr_conta ?? '') }}" required>
                                                <span class="form-text text-muted">Informe a Conta.</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Agencia:</label>
                                                <input type="text" name="nr_agencia" id="nr_agencia" class="form-control"  placeholder="Agencia"  value="{{ old('nr_agencia', $teds->nr_agencia ?? '') }}" required>
                                                <span class="form-text text-muted">Informe a Agemcoa.</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <label>Telefone:</label>
                                                <input type="text" name="nr_telefone" id="nr_telefone" class="form-control mask_celular" placeholder="Telefone" value="{{ old('nr_telefone', $teds->nr_telefone ?? '') }}">
                                                <span class="form-text text-muted">Entre com o Telefone</span>
                                            </div>


                                            <div class="col-lg-3">
                                                <label class="">Data Emissão:</label>
                                                <input type="text" name="dt_emissao" class="form-control" id="kt_datepicker_1" value="{{ old('dt_emissao', $teds->dt_emissao ? $teds->dt_emissao->format('d/m/Y') : '') }}"
                                                       required readonly placeholder="Select date" />
                                            </div>


                                            <div class="col-lg-4">
                                                <label>Status:</label>
                                                <div class="form-group">
                                                    {{-- Se for novo registro --}}
                                                    @if(!$teds->exists)
                                                        <input type="text" class="form-control" disabled value="Nova Solicitação">
                                                        {{-- Se estiver editando --}}
                                                    @else
                                                        <select class="form-control" id="status" name="cd_status">
                                                            <option value="">Selecione...</option>

                                                            @foreach($status as $st)
                                                                <option value="{{ $st->cd_status }}"
                                                                    {{ old('cd_status', $teds->cd_status ?? '') == $st->cd_status ? 'selected' : '' }}>
                                                                    {{ $st->no_status }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <span class="form-text text-muted">Selecione o Status</span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-md-4">
                                                <table class="table table-bordered" id="abilities-table">
                                                    <thead>
                                                    <tr>
                                                        <th>Valor</th>
                                                        <th style="width: 50px;">
                                                            <button type="button" class="btn btn-icon btn-success" id="add-valores"><i class="fa fa-plus"></i></button>
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tbody>

                                                    @if(isset($teds->valores) && $teds->valores->count())
                                                        @foreach($teds->valores as $i => $valor)
                                                            <tr class="data-row">
                                                                <td>
                                                                    <input type="text"
                                                                           name="vlr_ted[{{ $i }}][vlr]"
                                                                           class="form-control valor-ted {{ $i === 0 ? 'valor-obrigatorio' : '' }}"
                                                                           value="{{ old("vlr_ted.$i.vlr", $valor->vlr_ted) }}">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-icon btn-danger remove-ability">
                                                                        <i class="la la-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                        <tr class="total-row">
                                                            <td>Valor total:</td>
                                                            <td class="valor-total" style="font-size: 16px; font-weight: bold">0,00</td>
                                                        </tr>

                                                    @else

                                                        <tr class="data-row">
                                                            <td><input type="text" name="vlr_ted[0][vlr]" class="form-control valor-ted valor-obrigatorio" required></td>
                                                            <td><button type="button" class="btn btn-icon btn-danger remove-vlr"><i class="la la-trash"></i></button></td>
                                                        </tr>

                                                        <tr class="total-row">
                                                            <td style="font-size: 16px; font-weight: bold">Valor total:</td>
                                                            <td class="valor-total"  style="font-size: 16px; font-weight: bold">0,00</td>
                                                        </tr>

                                                    @endif

                                                    </tbody>

                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="col-lg-6">
                                                <label class="">Observação:</label>
                                                <textarea class="form-control" name="ds_obs" rows="3"></textarea>

                                                @if($teds->exists)
                                                    @foreach($teds->solicitacao->complementos as $complemento)
                                                        <hr>
                                                        <label class="text-capitalize">
                                                            {{ $complemento->usuario->no_usuario }}
                                                            ({{ $complemento->nr_matricula }}) -
                                                            {{ $complemento->status->no_status }} -
                                                            {{ $complemento->dt_complemento->format('d/m/Y H:i') }}
                                                        </label>
                                                        <textarea class="form-control" disabled rows="3">{{$complemento->ds_obs}}</textarea>
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
                                                {{ $teds->exists ? 'Atualizar' : 'Salvar' }}
                                            </button>
                                            <a href="{{ route('ted.index') }}" class="btn btn-danger">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" class="valor-total-im" name="vlr_total" value="{{ old('vlr_total', $teds->vlr_total ?? '') }}">
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            // ➕ adicionar nova linha
            $("#add-valores").on("click", function () {

                let table = $("#abilities-table tbody");

                // conta quantas linhas existem
                let rowCount = table.find("tr.data-row").length;

                let newRow = `
                    <tr class="data-row">
                        <td>
                            <input type="text" name="vlr_ted[${rowCount}][vlr]"
                                   class="form-control valor-ted">
                        </td>
                        <td>
                            <button type="button" class="btn btn-icon btn-danger remove-vlr">
                                <i class="la la-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;

                // insere antes do total
                table.find("tr.total-row").before(newRow);

                calcularTotal();
            });

            // 🗑 remover linha
            $(document).on("click", ".remove-vlr", function () {
                $(this).closest("tr").remove();
                renumerarLinhas();
                calcularTotal();
            });

            // recalcular ao editar campo
            $(document).on("keyup change", ".valor-ted", function () {
                calcularTotal();
            });

            // renumera índices do array para enviar certinho ao backend
            function renumerarLinhas() {
                $("#abilities-table tbody tr.data-row").each(function (i, row) {
                    $(row).find("input").attr("name", `vlr_ted[${i}][vlr]`);
                });
            }


            // 🎯 SOMAR TODOS OS VALORES
            function calcularTotal() {
                let total = 0;

                $(".valor-ted").each(function () {

                    let val = $(this).val().trim();
                    if (!val) return;

                    // 👉 Se tiver vírgula, é pt-BR
                    if (val.includes(',')) {
                        val = val.replace(/\./g, '').replace(',', '.');
                    }

                    val = parseFloat(val);

                    if (!isNaN(val)) {
                        total += val;
                    }
                });

                // formata para BR
                let formatado = total.toLocaleString("pt-BR", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                $(".valor-total").text(formatado);
                $(".valor-total-im").val(formatado);
            }


            // calcula uma vez ao carregar a página
            calcularTotal();
        });
        $(document).ready(function () {


            $("#teds").validate({
                ignore: [],

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
                    nr_agencia: {
                        required: true,
                        digits: true
                    },
                    dt_emissao: {
                        required: true,
                        date: true
                    },
                    cd_status: {
                        required: function () {
                            return $("#status").length > 0;
                        }
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
                    nr_agencia: {
                        required: "Informe a agência",
                        digits: "Somente números"
                    },
                    dt_emissao: {
                        required: "Informe a data de emissão"
                    },
                    cd_status: {
                        required: "Selecione o status"
                    },

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

                    let valido = true;

                    if (!valido) return false;

                    form.submit();
                }
            });

            // Revalidar inputs dinâmicos
            $(document).on("keyup blur", ".valor-ted", function () {
                $(this).valid();
            });

        });


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/validation/form-controls.js') }}" type="text/javascript"></script>

    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/input-mask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/components/extended/sweetalert2.js') }}" type="text/javascript"></script>
@endsection





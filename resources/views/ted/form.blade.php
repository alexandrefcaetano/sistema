@extends('layout.main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- Subheader -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $teds->exists ? 'Editar Módulo' : 'Cadastro Módulo' }}
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

        <!-- Portlet -->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{ $teds->exists ? 'Editar TEDs' : 'Cadastrar TEDs' }}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->
            <form
                action="{{ $teds->exists ? route('ted.update', ['cd_ted' => $teds->cd_ted]) : route('ted.store') }}" method="POST" class="kt-form kt-form--label-right form" >
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
                                <div class="col-lg-3">
                                    <label>Cod Dependencia:</label>
                                    <input type="text" name="cd_dependencia" id="cd_dependencia" class="form-control" placeholder="Numero Dependencia"  value="{{ old('cd_dependencia', $teds->solicitacao->cd_dependencia ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Numero da Dependencia.</span>
                                </div>
                                <div class="col-lg-5">
                                    <label>Nome Dependencia:</label>
                                    <input type="text" name="no_unidade" id="no_unidade" class="form-control"  placeholder="Unidade"  value="{{ old('display_name', $teds->no_unidade ?? '') }}" required>
                                    <span class="form-text text-muted">Nome Unidade.</span>
                                </div>
                                <div class="col-lg-3">
                                    <label>Conta:</label>
                                    <input type="text" name="nr_conta" id="nr_conta" class="form-control"  placeholder="Conta"  value="{{ old('nr_conta', $teds->nr_conta ?? '') }}"
                                           required>
                                    <span class="form-text text-muted">Informe a Conta.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3">
                                    <label>Telefone:</label>
                                    <input type="text" name="nr_telefone" class="form-control mask_celular" placeholder="Telefone" value="{{ old('nr_telefone', $teds->solicitacao->nr_telefone ?? '') }}"
                                    >
                                    <span class="form-text text-muted">Entre com o Telefone</span>
                                </div>


                                <div class="col-lg-3">
                                    <label class="">Data Emissão:</label>
                                    <input type="text" name="dt_emissao" class="form-control" id="kt_datepicker_1" value="{{ old('dt_emissao', $teds->dt_emissao ?? '') }}" readonly placeholder="Select date" />
                                </div>


                                <div class="col-lg-4">
                                    <label>status:</label>
                                    <div class="form-group">
                                        @if(!$teds->exists)
                                            <input type="text"  class="form-control" disabled  value="Nova Solicitação">
                                        @else
                                            <select class="form-control" id="status" name="status" {{ $teds->exists ? '' : 'disabled' }}>
                                                <option value="AT" {{ old('cd_status_solicitacao', $teds->solicitacao->cd_status_solicitacao ?? '') == 'AT' ? 'selected' : '' }}>Ativo</option>
                                                <option value="IN" {{ old('cd_status_solicitacao', $teds->solicitacao->cd_status_solicitacao ?? '') == 'IN' ? 'selected' : '' }}>Inativo</option>
                                                <option value="BL" {{ old('cd_status_solicitacao', $teds->solicitacao->cd_status_solicitacao ?? '') == 'BL' ? 'selected' : '' }}>Bloqueado</option>
                                                <option value="CA" {{ old('cd_status_solicitacao', $teds->solicitacao->cd_status_solicitacao ?? '') == 'CA' ? 'selected' : '' }}>Cancelado</option>
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
                                                        <input type="text" name="vl_ted[{{ $i }}][name]"
                                                               class="form-control valor-ted"
                                                               value="{{ old("vl_ted.$i.name", $valor->vl_ted) }}" required>
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
                                                <td id="valor-total" style="font-size: 16px; font-weight: bold">0,00</td>
                                            </tr>

                                        @else

                                            <tr class="data-row">
                                                <td><input type="text" name="vl_ted[0][name]" class="form-control valor-ted" required></td>
                                                <td><button type="button" class="btn btn-icon btn-danger remove-ability"><i class="la la-trash"></i></button></td>
                                            </tr>

                                            <tr class="total-row">
                                                <td style="font-size: 16px; font-weight: bold">Valor total:</td>
                                                <td id="valor-total" style="font-size: 16px; font-weight: bold">0,00</td>
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
                                        <label class="">{{$complemento->no_usuario}}  ({{$complemento->nr_matricula}}) - {{$complemento->no_status_solicitacao}} - {{$complemento->dt_complemento}}</label>
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
            </form>
            <!--end::Form-->
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
                    <input type="text" name="vl_ted[${rowCount}][name]"
                           class="form-control valor-ted" required>
                </td>
                <td>
                    <button type="button" class="btn btn-icon btn-danger remove-ability">
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
            $(document).on("click", ".remove-ability", function () {
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
                    $(row).find("input").attr("name", `vl_ted[${i}][name]`);
                });
            }


            // 🎯 SOMAR TODOS OS VALORES
            function calcularTotal() {
                let total = 0;

                $(".valor-ted").each(function () {

                    let val = $(this).val()
                        .replace(/\./g, '')   // remove pontos
                        .replace(',', '.');   // troca vírgula por ponto

                    val = parseFloat(val);

                    if (!isNaN(val)) {
                        total += val;
                    }
                });

                // converte para formato BR
                let formatado = total.toLocaleString("pt-BR", { minimumFractionDigits: 2 });

                $("#valor-total").text(formatado);
            }

            // calcula uma vez ao carregar a página
            calcularTotal();
        });


    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/select2.js') }}" type="text/javascript"></script>


    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/input-mask.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/components/extended/sweetalert2.js') }}" type="text/javascript"></script>
@endsection





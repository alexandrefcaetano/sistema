@extends('layout._main')

@section('content')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">{{isset($user) ? 'Update Usuário': 'Cadastro Usuário' }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link"> Lista </a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link"> {{isset($user) ? 'Update': 'Cadastro' }}</a>
                </div>
            </div>
        </div>


        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        {{isset($user) ? 'Update Usuário': 'Cadastro Usuário' }}
                    </h3>
                </div>
            </div>

            <!--begin::Form-->

            <form
                    action="{{ $user->id ? route('usuario.update', $user->id) : route('usuario.store') }}"
                    method="POST"
                    class="kt-form kt-form--label-right form"
                    data-form-contato="contato"
            >
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="kt-portlet__body">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Nome Completo:</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome Completo"
                                   value="{{ old('name', $user->name ?? '') }}">
                            <span class="form-text text-muted">Entre com o Nome Completo</span>
                        </div>


                        <div class="col-lg-4">
                            <label class="">Email:</label>
                            <input type="text" name="email" class="form-control" placeholder="Digite seu Email"
                                   value="{{ old('email', $user->email ?? '') }}"/>
                            <span class="form-text text-muted">Entre com o email</span>
                        </div>


                        <div class="col-lg-4">
                            <label>status:</label>
                            <div class="form-group">
                                @if(!$user->exists)
                                    <input type="text" class="form-control" disabled value="Bloqueado">
                                @else
                                    <select class="form-control" id="status"
                                            name="status" {{ $user->exists ? '' : 'disabled' }}>
                                        <option value="AT" {{ old('status', $user->status ?? '') == 'AT' ? 'selected' : '' }}>
                                            Ativo
                                        </option>
                                        <option value="IN" {{ old('status', $user->status ?? '') == 'IN' ? 'selected' : '' }}>
                                            Inativo
                                        </option>
                                        <option value="BL" {{ old('status', $user->status ?? '') == 'BL' ? 'selected' : '' }}>
                                            Bloqueado
                                        </option>
                                        <option value="CA" {{ old('status', $user->status ?? '') == 'CA' ? 'selected' : '' }}>
                                            Cancelado
                                        </option>
                                    </select>
                                    <span class="form-text text-muted">Selecione o Status</span>
                                @endif
                            </div>
                        </div>


                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Cpf:</label>
                            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="CPF"
                                   value="{{ old('cpf', $user->cpf ?? '') }}">
                            <span class="form-text text-muted">Entre com o seu CPF</span>
                        </div>
                        <div class="col-lg-4">
                            <label class="">Data Nascimento:</label>
                            <input type="text" name="data_nascimento" class="form-control" id="kt_datepicker_1"
                                   value="{{ old('data_nascimento', $user->data_nascimento ?? '') }}" readonly
                                   placeholder="Select date"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Sexo:</label>
                            <div class="form-group">
                                <select class="form-control" id="sexo" name="sexo">
                                    <option value="">Selecione</option>
                                    <option value="MA" {{ old('sexo', $user->sexo ?? '') == 'MA' ? 'selected' : '' }}>
                                        Masculino
                                    </option>
                                    <option value="FE" {{ old('sexo', $user->sexo ?? '') == 'FE' ? 'selected' : '' }}>
                                        Feminico
                                    </option>
                                </select>
                                <span class="form-text text-muted">Entre com o seu Sexo</span>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Permissões</label>
                        <div class="col-lg-4 col-md-9 col-sm-12">
                            <select class="form-control m-select2"
                                    id="kt_select2_3"
                                    name="roles[]"
                                    multiple="multiple">

                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                            {{ in_array(
                                                $role->id,
                                                (array) old('roles', $user->roles->pluck('id')->toArray())
                                            ) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        {{-- Campo Senha --}}
                        <div class="col-lg-4">
                            <label>Senha:</label>

                            <input type="password" class="form-control" name="password"
                                   value="{{ old('password', $user->exists ? '********' : 'BRB@2025') }}"
                                    {{ $user->exists ? '' : 'disabled' }}
                            >

                            @unless($user->exists)
                                <small class="text-muted">Senha padrão: BRB@2025</small>
                            @endunless
                        </div>

                        {{-- Campo de confirmação só aparece em edição --}}
                        @if($user->exists)
                            <div class="col-lg-4">
                                <label>Repita Senha:</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Redefinir senha padrão</label>
                            <div class="form-check mt-2">
                                @if(!isset($user))
                                    {{-- Cadastro: desabilitado --}}
                                    <input type="checkbox" class="form-check-input" id="redefinir_senha" disabled>
                                    <label class="form-check-label text-muted" for="redefinir_senha">
                                        Senha padrão: {{ \App\Models\Usuario::SENHA_PADRAO }}
                                    </label>
                                @else
                                    {{-- Edição: habilitado --}}
                                    <input type="checkbox" class="form-check-input" id="redefinir_senha"
                                           name="redefinir_senha" value="1">
                                    <label class="form-check-label" for="redefinir_senha">
                                        Restaurar senha padrão ({{ \App\Models\Usuario::SENHA_PADRAO }})
                                    </label>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3>Contatos</h3>
                        </div>
                    </div>
                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg kt-separator--portlet-fit"></div>
                    <div class="form-group row">
                        <div class="col-md-8" style="margin-bottom: 8px;">
                            <a href="javascript:abrirModalContato()" class="btn btn-info"><i
                                        class="fa fa-plus-square-o"></i> Incluir Contato</a>
                        </div>
                        <div class="col-md-8">
                            <table data-toggle="table" class="table table-bordered table-hover table-contato"
                                   data-unique-id="id">
                                <thead class="thead-light">
                                <tr>
                                    <th data-field="tipo" data-align="center">Tipo</th>
                                    <th data-field="descricao">Contato</th>
                                    <th data-field="flg_principal" data-align="center" data-formatter="formatPrincipal">
                                        Principal
                                    </th>
                                    <th data-formatter="formatAcao" data-align="center">Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <input type="hidden" name="contato" class="contato" value=""/>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="kt-portlet__foot">
                    <div class="kt-form__actions">
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-8">
                                <button type="submit"
                                        class="btn btn-primary">{{ isset($user) ? 'Atualizar' : 'Salvar' }}</button>
                                <a href="{{ route('usuario.index') }}" class="btn btn-danger"> Voltar </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>


    @include('modal.modal-contato')

@endsection



@section('scripts')
    <script>
        // Aqui você envia os dados do backend para o JS global
        window.itensAtributo = {!! json_encode(json_decode($user->contato, true)) !!};

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/select2.js') }}"
            type="text/javascript"></script>

    <script src="{{ asset('js/modal-contato.js') }}"></script>

    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/bootstrap-datepicker.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/crud/forms/widgets/input-mask.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('assets/app/custom/general/components/extended/sweetalert2.js') }}"
            type="text/javascript"></script>

@endsection


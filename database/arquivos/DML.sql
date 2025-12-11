INSERT INTO public.tb_aplicacao (no_aplicacao, st_aplicacao, no_rota) VALUES ('Dossiê Digital', 'A', 'dossie.index');
INSERT INTO public.tb_aplicacao (no_aplicacao, st_aplicacao, no_rota) VALUES ('Efetivações 'A', 'efetivacoes.index');
INSERT INTO public.tb_aplicacao (no_aplicacao, st_aplicacao, no_rota) VALUES ('Previsão de TEDs','A',ted.index');

-- USUARJIO --

INSERT INTO public.usuario (id, no_usuario, password, status, cpf, data_nascimento, sexo, contato, excluido, created_at, updated_at, nr_agencia, nr_matricula) VALUES (1, 'Mrs. Carley Stoltenberg II', '$2y$12$82XyptA.hpUkT.1uJuy/SON6JBlJGH2CVCFOg040mHoxD0omAzcSW', 'AT', '005.389.003-75', '2024-06-12', 'FE', '"[{\"tipo\":\"celular\",\"descricao\":\"(947) 962-9579\",\"flg_principal\":true}]"', false, '2025-11-05 00:06:46', '2025-11-05 00:06:46', null, null);
INSERT INTO public.usuario (id, no_usuario, password, status, cpf, data_nascimento, sexo, contato, excluido, created_at, updated_at, nr_agencia, nr_matricula) VALUES (2, 'Mr. Roy Goodwin PhD', '$2y$12$M3nC8vfZDQvkq5tuAOt5ceMSWKYjdA7OSQ.3cZu2z9FIiiZBN/7ia', 'AT', '128.074.070-44', '2001-03-12', 'MA', '"[{\"tipo\":\"celular\",\"descricao\":\"640.944.2284\",\"flg_principal\":true}]"', false, '2025-11-05 00:06:46', '2025-11-05 00:06:46', null, null);
INSERT INTO public.usuario (id, no_usuario, password, status, cpf, data_nascimento, sexo, contato, excluido, created_at, updated_at, nr_agencia, nr_matricula) VALUES (151, 'alexandre faustino cetano', '$2y$12$54.9NNzWSV9VnkeAsZJVkeeQpmq81WJsOvdHyNeY6rA2qQixD21uq', 'BL', '70273553100', '2000-02-08', 'MA', '"[{\"tipo\":\"Email\",\"tipo_contato\":\"EM\",\"descricao\":\"alexandre.f.caetano@gmail.com\",\"flg_principal\":\"T\"}]"', false, '2025-11-20 23:02:45', '2025-11-20 23:02:45', null, 677138);
INSERT INTO public.usuario (id, no_usuario, password, status, cpf, data_nascimento, sexo, contato, excluido, created_at, updated_at, nr_agencia, nr_matricula) VALUES (150, 'Chris Hagenes DVM', '$2y$12$1YFH6uf.NZ1eAj6x6I6VJefV9R5I2AvoQtTy54iV7lAO/ncJ3Zf4K', 'AT', '36979483386', '1990-02-08', 'MA', '"[{\"tipo\":\"Email\",\"tipo_contato\":\"EM\",\"descricao\":\"crystal68@example.net\",\"flg_principal\":\"T\"}]"', false, '2025-11-05 00:07:10', '2025-11-23 01:31:39', null, null);


--- ROLE ---
INSERT INTO public.roles (id, name, status, description, created_at, updated_at, excluido) VALUES (1, 'Administrador', 'AT', 'Acesso total', '2025-11-05 00:07:10', '2025-11-05 00:07:10', false);
INSERT INTO public.roles (id, name, status, description, created_at, updated_at, excluido) VALUES (2, 'Usuário', 'AT', 'Acesso de usuário', '2025-11-05 00:07:10', '2025-11-05 00:07:10', false);
INSERT INTO public.roles (id, name, status, description, created_at, updated_at, excluido) VALUES (3, 'Convidado', 'AT', 'Acesso convidado', '2025-11-05 00:07:10', '2025-11-05 00:07:10', false);
INSERT INTO public.roles (id, name, status, description, created_at, updated_at, excluido) VALUES (4, 'teste', 'AT', 'teste teste tesaet', '2025-12-11 00:07:43', '2025-12-11 00:07:44', false);


-- MODEULE---

INSERT INTO public.modules (id, name, display_name, description, created_at, updated_at, status, excluido) VALUES (1, 'usuarios', 'Usuários', null, '2025-11-05 00:51:53', '2025-11-06 02:03:45', 'IN', false);
INSERT INTO public.modules (id, name, display_name, description, created_at, updated_at, status, excluido) VALUES (3, 'Diretor', 'Diretor', null, '2025-11-06 00:33:34', '2025-11-06 00:41:30', 'AT', false);
INSERT INTO public.modules (id, name, display_name, description, created_at, updated_at, status, excluido) VALUES (2, 'Permissões', 'Permissões', null, '2025-11-05 00:51:53', '2025-11-08 16:50:34', 'AT', false);
INSERT INTO public.modules (id, name, display_name, description, created_at, updated_at, status, excluido) VALUES (4, 'Module', 'Modulos', null, '2025-11-22 21:23:16', '2025-11-22 21:41:04', 'AT', false);
INSERT INTO public.modules (id, name, display_name, description, created_at, updated_at, status, excluido) VALUES (5, 'Aplicacao', 'Aplicacao', null, '2025-12-05 03:42:49', '2025-12-05 03:42:49', 'AT', false);



-- ABILITES --

INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (1, 1, 'list', 'Listar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (2, 1, 'create', 'Criar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (3, 1, 'edit', 'Editar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (4, 1, 'delete', 'Excluir', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (35, 3, 'list', 'Lisar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (36, 3, 'create', 'Criar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (37, 3, 'update', 'Editar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (38, 3, 'delete', 'Excluir', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (39, 3, 'ativar', 'Ativar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (40, 2, 'list', 'Listar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (41, 2, 'create', 'Criar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (42, 2, 'update', 'Editar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (43, 2, 'delete', 'Excluir', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (44, 2, 'ativar', 'Ativar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (49, 4, 'list', 'Listar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (50, 4, 'create', 'Criar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (51, 4, 'update', 'Editar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (52, 4, 'delete', 'Excluir', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (53, 5, 'list', 'Listar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (54, 5, 'create', 'Criar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (55, 5, 'update', 'Alterar', null, null);
INSERT INTO public.abilities (id, module_id, name, display_name, created_at, updated_at) VALUES (56, 5, 'delete', 'Apagar', null, null);


-- ABILITE ROLES ---

INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (1, 1, 1, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (2, 1, 2, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (3, 1, 3, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (4, 1, 4, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (7, 2, 1, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (8, 2, 2, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (9, 3, 1, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (10, 4, 1, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (14, 4, 2, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (15, 4, 36, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (16, 4, 37, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (17, 4, 38, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (18, 4, 42, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (19, 4, 43, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (20, 4, 44, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (21, 1, 35, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (22, 1, 36, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (23, 1, 37, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (24, 1, 38, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (25, 1, 39, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (26, 1, 40, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (27, 1, 41, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (28, 1, 42, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (29, 1, 43, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (30, 1, 44, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (35, 1, 49, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (36, 1, 50, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (37, 1, 51, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (39, 1, 52, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (40, 1, 53, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (41, 1, 54, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (42, 1, 55, null, null);
INSERT INTO public.ability_role (id, role_id, ability_id, created_at, updated_at) VALUES (43, 1, 56, null, null);


-- USUARIO ROLE ---

INSERT INTO public.role_usuario (id, role_id, usuario_id, created_at, updated_at) VALUES (1, 1, 1, '2025-11-04 21:53:29', '2025-11-04 21:53:30');
INSERT INTO public.role_usuario (id, role_id, usuario_id, created_at, updated_at) VALUES (2, 2, 2, '2025-11-04 21:53:40', '2025-11-04 21:53:42');
INSERT INTO public.role_usuario (id, role_id, usuario_id, created_at, updated_at) VALUES (3, 1, 151, '2025-11-20 23:59:32', '2025-11-20 23:59:33');
INSERT INTO public.role_usuario (id, role_id, usuario_id, created_at, updated_at) VALUES (5, 2, 150, '2025-11-22 22:37:54', '2025-11-22 22:37:56');


-- VW_EMPRESA_DEPENDENTE ---

INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (4, 'BRB SERV GEAFI GEREN ADMINIST FINANCEIRA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (5, 'ASSESSORIA JURIDICA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (6, 'GERENCIA OPERACIONAL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (7, 'GERENCIA DE APOIO LOGISTICO E FINANCAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (9, 'PAB 009 CARTAO (CARTEIRA 09)');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (10, 'AG. CONSOLIDADAS IFRS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (11, 'AG. CEASA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (13, 'AG. GUARA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (14, 'NUCLEO CONTABIL CEJUD');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (15, 'AG. GOIANIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (16, 'PA FUNDO EXCLUSIVO 843');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (18, 'AG. ANAPOLIS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (20, 'CONSAD - CONSELHO DE ADMINISTRAÇÃO CRT');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (22, 'AG. RIO DE JANEIRO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (23, 'AG. SAO PAULO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (24, 'AG. TAGUATINGA NORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (25, 'AG. BRAZLANDIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (26, 'AG. CEILANDIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (27, 'AG. CENTRAL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (28, 'AG. SETOR DE IND. GRAFICAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (30, 'CONFIS - CONSELHO FISCAL CRT');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (31, 'PA CAPIM DOURADO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (32, 'ESCRITORIO DE NEGOCIOS TEOTONIO SEGURADO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (36, 'AGENCIA SALVADOR');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (37, 'AG. ASA SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (40, 'AG. PARKSHOPPING');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (41, 'PA BARREIRAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (43, 'AG. CEILANDIA NORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (44, 'AG. MILLENIUM CAPITAL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (46, 'AG. CORPORATE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (47, 'AG. TAGUATINGA SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (50, 'AG. PONTANORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (53, 'AG. SAMAMBAIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (54, 'AG. GUARA II');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (56, 'AG. CANDANGOLANDIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (57, 'AG. PARANOA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (58, 'AG. CNB 12');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (59, 'AG. RTV-SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (60, 'AG. SAAN');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (61, 'AG. LAGO NORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (62, 'AG. SETOR HOSPITALAR');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (63, 'AG. SETOR DE DIVERSOES SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (64, 'AG. SANTA MARIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (66, 'AG. SUDOESTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (67, 'AG. TERRACO SHOPPING');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (69, 'NUCLEO CONTABIL CEOPE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (71, 'AG. FLORIDA MALL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (72, 'AG. LUZIANIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (74, 'AG. QNL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (75, 'ESCRITORIO DE NEGOCIOS LAGO SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (76, 'AG. CAMPO GRANDE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (77, 'AG. FORMOSA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (78, 'AG. AGUAS CLARAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (79, 'AG. HELIO PRATES');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (80, 'AG. CUIABA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (81, 'AG. EPNB');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (82, 'AG. PRACA DO DI');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (83, 'AG. P SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (84, 'AG. AGUAS LINDAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (85, 'AG. VILA BURITIS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (86, 'AG. JARDIM BOTANICO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (87, 'AG. SANTO ANTONIO DO DESCOBERTO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (88, 'PA CRUZEIRO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (89, 'AG. SOBRADINHO II');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (90, 'AGENCIA JOAO PESSOA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (91, 'AGENCIA MANAIRA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (92, 'AGENCIA MANGABEIRA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (93, 'AGENCIA TAMBAU');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (94, 'AGENCIA CEASA JOAO PESSOA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (95, 'AGENCIA VALENTINA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (96, 'AGENCIA EPITACIO PESSOA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (97, 'ESCRITORIO DE NEGOCIOS ALTIPLANO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (98, 'ESCRITORIO DE NEGOCIOS CENTRAD JOAO PESS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (99, 'PLATAFORMA DE ATACADO DE JOAO PESSOA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (100, 'AG. JK');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (101, 'BRB SERVICOS PRESI-PRESIDENCIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (102, 'AG. RIACHO FUNDO II');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (103, 'AG. TAGUATINGA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (104, 'AG. GAMA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (105, 'AG. BANDEIRANTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (106, 'AG. SIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (107, 'AG. SOBRADINHO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (108, 'AG. 504 NORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (109, 'ESCRITORIO DE NEGOCIOS IATE CLUBE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (110, 'AG. PLANALTINA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (111, 'CARTAO GECIT - GER. DE CONTROLES INT.');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (112, 'ESCRITORIO DE NEGOCIOS ASA SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (113, 'AG. SEE-DF GUARA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (114, 'COORD COBRANÇA E RECUPERACAO DE CREDITO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (115, 'COORDENACAO DE INTERCAMBIO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (116, 'COCORC COORDENACAO DE ORCAMENTO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (121, 'AG. TERRACAP');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (124, 'AG. PMDF TAGUATINGA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (125, 'AG. PROCURADORIA DF');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (127, 'AG. SEF');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (130, 'AG. METRO-AGUAS CLARAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (133, 'AG. SES-DF/HRT');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (134, 'AG. CEMAB');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (139, 'AG. DPE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (141, 'AG. VALPARAISO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (142, 'AG. SES-DF/HRC');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (143, 'AG. PMDF GAMA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (144, 'AG. SES-DF/HRG');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (145, 'AG. SINDSIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (146, 'AG. CBMDF');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (148, 'AG. SAO SEBASTIAO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (150, 'PAB TJ BANDEIRANTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (155, 'AG. TRIB. DE JUSTICA DO DF');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (161, 'AG. TJ CEILANDIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (163, 'AG. CAESB');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (164, 'AG. VENANCIO 2000');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (168, 'AG. SEE-DF SOBRADINHO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (169, 'AG. SES-DF/HRS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (172, 'AG. SES-DF/HMIB');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (174, 'AG. CEILANDIA SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (185, 'PAB EVENTOS III- RENDA MINHA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (198, 'AG. CAESB SIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (200, ' DIRETORIA DE OPERACOES PESSOAS E ADMINI');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (200, 'BRB SERVICOS DICOL DIRETORIA COLEGIADA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (201, 'AG. CONJUNTO NACIONAL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (202, 'AG. W3');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (203, 'AG. TIRADENTES');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (204, 'AG. L2 SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (205, 'AG. SHOPPING POPULAR DE BRASILIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (206, 'AG. NOVACAP');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (207, 'AG. CEB SEDE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (208, 'AG. COMERCIAL SUL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (209, 'AG. NORTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (210, 'AG. SEE-DF/SEDE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (211, 'AG. TCDF');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (212, 'AG. BURITI');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (213, 'AG. DETRAN');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (214, 'AG. LAGO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (215, 'AG. HDB');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (216, 'AG. ALFA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (217, 'AG. SEE-DF/DRE CEILANDIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (218, 'AG. CAMARA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (219, 'AG. UNIVERSIDADE DE BRASILIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (221, 'PAB CAC');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (222, 'AG. TJ SAMAMBAIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (231, 'CENTRALIZADORA DE CONCILIACAO CONTABIL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (234, 'PAB CCL - SAAN');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (235, 'PAB CCL TAG');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (236, 'PAB CCL - L2');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (237, 'AG. TJ TAGUATINGA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (238, 'PA DF SOCIAL');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (239, 'AG. DOM PEDRO II');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (240, 'AG. RECANTO DAS EMAS');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (241, 'AG. RIACHO FUNDO');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (244, 'PAB POSTO PROSEGUR');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (245, 'PA CORRESPONDENTE');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (246, 'CENTRAL SERVICOS DE  TESOURARIA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (252, 'AG. TAGUATINGA SHOPPING');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (253, 'AG. SES-DF/HRP');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (254, 'AG. SEE-DF PLANALTINA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (255, 'AG. SEE-DF/GAMA');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (258, 'PA PLATAFORMA DT-E');
INSERT INTO public.vw_empresa_dependente (cd_dependencia, nm_dependencia) VALUES (260, 'PA TRT-9');



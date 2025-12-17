-- =====================================================
-- SCHEMA
-- =====================================================
CREATE SCHEMA IF NOT EXISTS frm;

SET search_path TO frm;


-- =====================================================
-- TABLE abilities
-- =====================================================

DROP TABLE IF EXISTS frm.abilities CASCADE;

CREATE TABLE  frm.abilities
(
    id   bigserial  constraint abilities_pkey      primary key,
    module_id    bigint       not null
        constraint abilities_module_id_foreign
            references modules
            on delete cascade,
    name         varchar(120) not null,
    display_name varchar(120),
    created_at   timestamp(0),
    updated_at   timestamp(0)
);




-- =====================================================
-- TABLE td_status
-- =====================================================

DROP TABLE IF EXISTS frm.td_status CASCADE;

CREATE TABLE frm.td_status (
    cd_status INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    no_status VARCHAR(200) NOT NULL,
    ds_status VARCHAR(255)
);

-- =====================================================
-- TABLE tb_aplicacao
-- =====================================================

DROP TABLE IF EXISTS frm.tb_aplicacao CASCADE;

CREATE TABLE frm.tb_aplicacao (
    cd_aplicacao INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    no_aplicacao VARCHAR(155) NOT NULL,
    no_rota VARCHAR(255) NOT NULL,
    st_aplicacao VARCHAR(2) NOT NULL
);


-- =====================================================
-- TABLE td_solicitacao
-- =====================================================

DROP TABLE IF EXISTS frm.td_solicitacao CASCADE;

CREATE TABLE frm.td_solicitacao (
    cd_solicitacao INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cd_aplicacao INTEGER NOT NULL,
    CONSTRAINT fk_td_solicitacao_tb_aplicacao1
      FOREIGN KEY (cd_aplicacao)
      REFERENCES frm.tb_aplicacao (cd_aplicacao)
);

CREATE INDEX idx_td_solicitacao_cd_aplicacao
    ON frm.td_solicitacao (cd_aplicacao);

-- =====================================================
-- TABLE td_ted
-- =====================================================

DROP TABLE IF EXISTS frm.td_ted CASCADE;

CREATE TABLE frm.td_ted (
    cd_ted INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cd_status INTEGER NOT NULL,
    cd_solicitacao INTEGER NOT NULL,
    cd_dependencia INTEGER NOT NULL,
    no_unidade VARCHAR(155) NOT NULL,
    nr_agencia INTEGER,
    nt_telefone INTEGER,
    nr_conta INTEGER NOT NULL,
    dt_emissao TIMESTAMP NOT NULL,
    nr_matricula_create INTEGER NOT NULL,
    dt_create TIMESTAMP NOT NULL,
    nr_matricula_update INTEGER,
    dt_update TIMESTAMP,
    CONSTRAINT fk_td_ted_td_status
        FOREIGN KEY (cd_status)
        REFERENCES frm.td_status (cd_status),

    CONSTRAINT fk_td_ted_td_solicitacao1
        FOREIGN KEY (cd_solicitacao)
        REFERENCES frm.td_solicitacao (cd_solicitacao)
);

CREATE INDEX idx_td_ted_cd_status
    ON frm.td_ted (cd_status);

CREATE INDEX idx_td_ted_cd_solicitacao
    ON frm.td_ted (cd_solicitacao);


-- =====================================================
-- TABLE tb_complemento
-- =====================================================

DROP TABLE IF EXISTS frm.tb_complemento CASCADE;

CREATE TABLE frm.tb_complemento (
    cd_complemento INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cd_status INTEGER NOT NULL,
    cd_solicitacao INTEGER NOT NULL,
    nr_matricula INTEGER,
    ds_obs TEXT,
    nr_matricula_create INTEGER,
    dt_create TIMESTAMP,
    nr_matricula_update INTEGER,
    dt_update TIMESTAMP,
    CONSTRAINT fk_tb_complemento_td_status1
        FOREIGN KEY (cd_status)
        REFERENCES frm.td_status (cd_status),

    CONSTRAINT fk_tb_complemento_td_solicitacao1
        FOREIGN KEY (cd_solicitacao)
        REFERENCES frm.td_solicitacao (cd_solicitacao)
);

CREATE INDEX idx_tb_complemento_cd_status
    ON frm.tb_complemento (cd_status);

CREATE INDEX idx_tb_complemento_cd_solicitacao
    ON frm.tb_complemento (cd_solicitacao);

-- =====================================================
-- TABLE ted_valores
-- =====================================================

DROP TABLE IF EXISTS frm.ted_valores CASCADE;

CREATE TABLE frm.ted_valores (
    cd_valor_ted INTEGER GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cd_ted INTEGER NOT NULL,
    vlr_ted NUMERIC(15,2) NOT NULL,
    nr_matricula_create INTEGER NOT NULL,
    dt_create TIMESTAMP NOT NULL,
    nr_matricula_update INTEGER,
    dt_update TIMESTAMP,
    CONSTRAINT fk_ted_valores_td_ted1
        FOREIGN KEY (cd_ted)
        REFERENCES frm.td_ted (cd_ted)
);

CREATE INDEX idx_ted_valores_cd_ted
    ON frm.ted_valores (cd_ted);

-- =========================================
-- TABELA TB_TIPO_DOSSIE
-- =========================================
DROP TABLE IF EXISTS frm.tb_tipo_dossie CASCADE;

CREATE TABLE frm.tb_tipo_dossie (
    cd_tipo_dossie BIGSERIAL PRIMARY KEY,
    no_tipo_dossie VARCHAR(200) NOT NULL,
    st_ativo CHAR(1) DEFAULT 'S' CHECK (st_ativo IN ('S','N'))
);

CREATE UNIQUE INDEX idx_tb_tipo_dossie_cd_tipo_dossie
    ON frm.tb_tipo_dossie (cd_tipo_dossie);

-- =========================================
-- TABELA TB_TIPO_DOCUMENTO_DOSSIE
-- =========================================
DROP TABLE IF EXISTS frm.tb_tipo_documento_dossie CASCADE;

CREATE TABLE frm.tb_tipo_documento_dossie (
  cd_tipo_documento_dossie BIGSERIAL PRIMARY KEY,
  no_tipo_documento_dossie VARCHAR(200) NOT NULL,
  ds_tipo_documento_dossie VARCHAR(400) NULL,
  st_ativo CHAR(1) DEFAULT 'S' CHECK (st_ativo IN ('S','N'))
);

CREATE UNIQUE INDEX idx_tb_tipo_documento_dossie_cd_tipo
    ON frm.tb_tipo_documento_dossie (cd_tipo_documento_dossie);


-- =========================================
-- TABELA TB_DOSSIE_DESTINO
-- =========================================
DROP TABLE IF EXISTS frm.tb_dossie_destino CASCADE;

CREATE TABLE frm.tb_dossie_destino (
   cd_dossie_destino BIGSERIAL PRIMARY KEY,
   ds_dossie_destino VARCHAR(200) NOT NULL,
   st_ativo CHAR(1) DEFAULT 'S' CHECK (st_ativo IN ('S','N'))
);

CREATE UNIQUE INDEX idx_tb_dossie_destino_cd_dossie
    ON frm.tb_dossie_destino (cd_dossie_destino);


-- =========================================
-- TABELA TB_DOSSIE
-- =========================================
DROP TABLE IF EXISTS frm.tb_dossie CASCADE;

CREATE TABLE frm.tb_dossie (
   sq_dossie BIGSERIAL PRIMARY KEY,
   cd_solicitacao BIGINT NULL,
   cd_tipo_documento_dossie BIGINT NULL,
   cd_dossie_destino BIGINT NULL,
   cd_produto_conta BIGINT NULL,
   cd_tipo_dossie BIGINT NULL,
   dn_cpf_cnpj VARCHAR(20) NULL,
   ds_motivo_abertura VARCHAR(4000) NULL,
   nr_ordem_conta INTEGER NULL,
   cd_especie_conta INTEGER NULL,
   nr_conta VARCHAR(20) NULL,
   ds_chave_negocio VARCHAR(255) NULL,
   CONSTRAINT fk_tb_dossie_tipo_documento
       FOREIGN KEY (cd_tipo_documento_dossie)
           REFERENCES frm.tb_tipo_documento_dossie (cd_tipo_documento_dossie)
           ON DELETE SET NULL,
   CONSTRAINT fk_tb_dossie_destino
       FOREIGN KEY (cd_dossie_destino)
           REFERENCES frm.tb_dossie_destino (cd_dossie_destino)
           ON DELETE SET NULL,
   CONSTRAINT fk_tb_dossie_tipo_dossie
       FOREIGN KEY (cd_tipo_dossie)
           REFERENCES frm.tb_tipo_dossie (cd_tipo_dossie)
           ON DELETE SET NULL
);

ALTER TABLE tb_dossie
    ADD COLUMN cd_status INTEGER NOT NULL,
    ADD COLUMN nr_matricula_create INTEGER NOT NULL,
    ADD COLUMN dt_create TIMESTAMP NOT NULL,
    ADD COLUMN nr_matricula_update INTEGER,
    ADD COLUMN dt_update TIMESTAMP;

ALTER TABLE tb_dossie
    ADD CONSTRAINT fk_td_dossie_td_status
        FOREIGN KEY (cd_status)
            REFERENCES tb_status (cd_status);

CREATE INDEX idx_tb_dossie_cd_tipo_documento
    ON frm.tb_dossie (cd_tipo_documento_dossie);

CREATE INDEX idx_tb_dossie_cd_dossie_destino
    ON frm.tb_dossie (cd_dossie_destino);

CREATE INDEX idx_tb_dossie_cd_tipo_dossie
    ON frm.tb_dossie (cd_tipo_dossie);


-- =========================================
-- TABELA TB_DOSSIE_STATUS
-- =========================================
DROP TABLE IF EXISTS frm.tb_dossie_status CASCADE;

CREATE TABLE frm.tb_dossie_status (
  sq_dossie_status BIGSERIAL PRIMARY KEY,
  sq_dossie BIGINT NULL,
  st_contrato_unico CHAR(1) NULL CHECK (st_contrato_unico IN ('S','N')),
  st_ficha_qualificacao_pf CHAR(1) NULL CHECK (st_ficha_qualificacao_pf IN ('S','N')),
  st_doc_identificacao CHAR(1) NULL CHECK (st_doc_identificacao IN ('S','N')),
  st_nao_consta CHAR(1) NULL CHECK (st_nao_consta IN ('S','N')),
  st_doc_confere_original CHAR(1) NULL CHECK (st_doc_confere_original IN ('S','N')),
  st_assinatura_conferida CHAR(1) NULL CHECK (st_assinatura_conferida IN ('S','N')),
  st_renda_presumida CHAR(1) NULL CHECK (st_renda_presumida IN ('S','N')),
  st_renda_automatica CHAR(1) NULL CHECK (st_renda_automatica IN ('S','N')),
  st_renda_anexa CHAR(1) NULL CHECK (st_renda_anexa IN ('S','N')),
  st_cartao_assinatura CHAR(1) NULL CHECK (st_cartao_assinatura IN ('S','N')),
  st_comprovante_renda CHAR(1) NULL CHECK (st_comprovante_renda IN ('S','N')),
  st_cartao_cnpj CHAR(1) NULL CHECK (st_cartao_cnpj IN ('S','N')),
  st_contrato_social CHAR(1) NULL CHECK (st_contrato_social IN ('S','N')),
  st_faturamento CHAR(1) NULL CHECK (st_faturamento IN ('S','N')),
  st_outro CHAR(1) NULL CHECK (st_outro IN ('S','N')),
  st_ficha_qualificacao_pj CHAR(1) NULL CHECK (st_ficha_qualificacao_pj IN ('S','N')),
  CONSTRAINT fk_tb_dossie_status_dossie
      FOREIGN KEY (sq_dossie)
          REFERENCES frm.tb_dossie (sq_dossie)
          ON DELETE SET NULL
);

CREATE INDEX idx_tb_dossie_status_sq_dossie
    ON frm.tb_dossie_status (sq_dossie);





create table vw_empresa_dependente
(
    cd_dependencia integer,
    nm_dependencia varchar(255)
);

-- =====================================================
-- SCHEMA
-- =====================================================
CREATE SCHEMA IF NOT EXISTS frm;

SET search_path TO frm;

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
-- TABLE table1 (vazia)
-- =====================================================

DROP TABLE IF EXISTS frm.table1 CASCADE;

CREATE TABLE frm.table1 ();

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


#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname postgres <<-EOSQL

DROP DATABASE IF EXISTS rhparana;

CREATE DATABASE rhparana OWNER saude;

\connect rhparana;

CREATE TABLE public.pm_cm
(
   ID_META4 varchar(18),
   STD_OR_HR_PERIOD bigint,
   DATA_ADMISSAO timestamp,
   NOME varchar(100),
   RG varchar(30),
   CLASSE varchar(10),
   NASCIMENTO timestamp,
   ID_SEXO bigint,
   SEXO varchar(30),
   ADMISSAO_REAL timestamp,
   EMAIL_META4 varchar(100),
   FUNCAO varchar(120),
   CARGO varchar(60),
   QUADRO varchar(30),
   SUBQUADRO varchar(20),
   PROMOCAO timestamp,
   REFERENCIA varchar(10),
   BAIRRO varchar(100),
   CIDADE varchar(80),
   OPM_DESCRICAO varchar(80),
   OPM_META4 varchar(30),
   CDOPM varchar(10),
   nome_mae varchar(100),
   nome_pai varchar(100),
   numero_titulo varchar(15),
   zona varchar(5),
   secao varchar(5),
   uf varchar(4),
   CPF varchar(11),
   id int PRIMARY KEY NOT NULL
)
;

CREATE TABLE public.INATIVOS
(
   STD_ID_HR varchar(255),
   STD_OR_RH_PERIOD bigint,
   DT_INI_RH timestamp,
   ID_TIPO_RH varchar(255),
   N_TIPO_RH varchar(255),
   CBR_NUM_RG varchar(255),
   NOME varchar(255),
   DT_NASC timestamp,
   SEXO varchar(100),
   cargo varchar(50),
   POSTO varchar(255),
   N_RUA varchar(255),
   N_TIPO_LOCAL_END varchar(255),
   QUADRO varchar(255),
   ORD_FONE bigint,
   N_TIPO_LOCAL_FONE varchar(255),
   N_TIPO_LINHA varchar(255),
   FONE varchar(255),
   END_LOGRADOURO varchar(255),
   END_NUMERO varchar(255),
   END_COMPL varchar(255),
   END_BAIRRO varchar(255),
   END_CIDADE varchar(255),
   END_CEP varchar(255)
)
;
CREATE INDEX IX_INATIVOS_3 ON public.INATIVOS
(
  cargo,
  POSTO
)
;
CREATE INDEX INATIVOS_IX_INATIVOS ON public.INATIVOS(CBR_NUM_RG)
;
CREATE INDEX IX_INATIVOS_2 ON public.INATIVOS(DT_NASC)
;
CREATE INDEX IX_INATIVOS_1 ON public.INATIVOS(NOME)
;

CREATE TABLE public.opmPMPR
(
   META4 varchar(20) PRIMARY KEY NOT NULL,
   NOME_META4 varchar(255),
   CODIGO char(10),
   DESCRICAO varchar(255),
   ABREVIATURA varchar(255),
   TIPO varchar(255),
   MUNICIPIO varchar(255),
   CDMUNICIPIO varchar(20),
   TITULO varchar(255),
   CODIGOBASE varchar(10),
   CODIGONOVO varchar(10),
   TELEFONE varchar(40)
)
;
CREATE INDEX opmPMPR_IX_MUNICIPIO ON public.opmPMPR(MUNICIPIO)
;
CREATE INDEX opmPMPR_IX_CODIGO ON public.opmPMPR(CODIGO)
;


INSERT INTO pm_cm (
   ID_META4,
   STD_OR_HR_PERIOD,
   DATA_ADMISSAO,
   NOME,
   RG,
   CLASSE,
   NASCIMENTO,
   ID_SEXO,
   SEXO,
   ADMISSAO_REAL,
   EMAIL_META4,
   FUNCAO,
   CARGO,
   QUADRO,
   SUBQUADRO,
   PROMOCAO,
   REFERENCIA,
   BAIRRO,
   CIDADE,
   OPM_DESCRICAO,
   OPM_META4,
   CDOPM,
   nome_mae,
   nome_pai,
   numero_titulo,
   zona,
   secao,
   uf,
   CPF,
   id
) VALUES (
   'W12345',
   1,
   '1999-02-01 00:00:00',
   'DINO DA SILVA SAURO',
   '123456789',
   'PM',
   '1980-04-21 00:00:00',
   1,
   'Masculino',
   '1999-02-01 00:00:00',
   'nome@dominio.com',
   null,
   'SD1C',
   'QPMG1',
   '0',
   '2016-10-01 00:00:00',
   '5',
   'PM Curitiba / ENGENHEIRO REBOUÇAS',
   'Curitiba',
   'VIGÉSIMO QUINTO BATALHÃO DE POLÍCIA MILITAR',
   'W7400792',
   '4400000000',
   'MARIA SAURO',
   'JOAO SAURO',
   '12345',
   '007',
   '123',
   'PR',
   '01234567890',
   1
);

INSERT INTO public.INATIVOS
(
   STD_ID_HR,
   STD_OR_RH_PERIOD,
   DT_INI_RH,
   ID_TIPO_RH,
   N_TIPO_RH,
   CBR_NUM_RG,
   NOME,
   DT_NASC,
   SEXO,
   cargo,
   POSTO,
   N_RUA,
   N_TIPO_LOCAL_END,
   QUADRO,
   ORD_FONE,
   N_TIPO_LOCAL_FONE,
   N_TIPO_LINHA,
   FONE,
   END_LOGRADOURO,
   END_NUMERO,
   END_COMPL,
   END_BAIRRO,
   END_CIDADE,
   END_CEP
) VALUES (
   'W54321',
   85,
   '1990-01-01 00:00:00',
   '02',
   'APOSENTADO',
   '87654321',
   'ARNOLD SILVA JUNIOR',
   '1944-03-21 00:00:00',
   'Feminino',
   '2SGT',
   'NA',
   'RUA',
   'Residencial',
   'PM',
   1,
   'Correspondência',
   'Telefone',
   '424242424',
   'XV DE NOVEMBRO',
   '1',
   NULL,
   'CENTRO',
   'Curitiba',
   '80000000'
),(
   'W54321',
   85,
   '1990-01-01 00:00:00',
   '02',
   'APOSENTADO',
   '87654321',
   'ARNOLD SILVA JUNIOR',
   '1944-03-21 00:00:00',
   'Feminino',
   '2SGT',
   'NA',
   'RUA',
   'Residencial',
   'PM',
   1,
   'Trabalho',
   'Telefone',
   '52525252',
   'XV DE NOVEMBRO',
   '1',
   NULL,
   'CENTRO',
   'Curitiba',
   '80000000'
);

INSERT INTO public.opmPMPR
(
   META4,
   NOME_META4,
   CODIGO,
   DESCRICAO,
   ABREVIATURA,
   TIPO,
   MUNICIPIO,
   CDMUNICIPIO,
   TITULO,
   CODIGOBASE,
   CODIGONOVO,
   TELEFONE
) VALUES (
   'W54321',
   'VIGÉSIMO QUINTO BATALHÃO DE POLÍCIA MILITAR',
   '4400000000',
   'VIGÉSIMO QUINTO BATALHÃO DE POLÍCIA MILITAR',
   '25BPM',
   'OP',
   'Umuarama',
   null,
   'BATALHAO',
   '440',
   NULL,
   '4431233212' 
   
);

EOSQL
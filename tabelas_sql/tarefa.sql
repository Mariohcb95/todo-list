create table tarefa
(
    id             bigint unsigned auto_increment
        primary key,
    descricao      text                 null,
    dt_criacao     datetime             null,
    dt_finalizacao datetime             null,
    concluido      tinyint(1) default 0 null
)
    comment 'Contem todas as tarefas.';

create table usuario
(
    id    bigint unsigned auto_increment
        primary key,
    nome  text null,
    email text null,
    senha text null
);


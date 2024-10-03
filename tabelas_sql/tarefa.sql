create table tarefa
(
    id             serial auto_increment
        primary key,
    descricao      text                  null,
    dt_criacao     datetime              null,
    dt_finalizacao datetime              null,
    concluido      boolean default false null
)
    comment 'Contem todas as tarefas.';

    create table usuario
(
    id    serial not null
        primary key,
    nome  text   null,
    email text   null,
    senha text   null
);


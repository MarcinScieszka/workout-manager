create table user_type
(
    id   integer default nextval('table_name_id_seq'::regclass) not null
        constraint table_name_pk
            primary key,
    type varchar(20)                                            not null
);

alter table user_type
    owner to nspbtrbjimkvml;

create table "user"
(
    id           serial
        constraint user_pk
            primary key,
    email        varchar(255)          not null,
    password     varchar(255)          not null,
    created_at   date                  not null,
    logged_in    boolean default false not null,
    id_user_type integer default 1     not null
        constraint user_type___fk
            references user_type
            on update cascade on delete cascade
);

alter table "user"
    owner to nspbtrbjimkvml;

create unique index user_id_uindex
    on "user" (id);

create unique index user_email_uindex
    on "user" (email);

create unique index table_name_id_uindex
    on user_type (id);

create table user_details
(
    id      serial
        constraint user_details_pk
            primary key,
    gender  varchar(50) not null,
    id_user integer     not null
        constraint id_user___fk
            references "user"
            on update cascade on delete cascade
);

alter table user_details
    owner to nspbtrbjimkvml;

create unique index user_details_id_uindex
    on user_details (id);

create table login
(
    id          serial
        constraint login_pk
            primary key,
    login_time  timestamp not null,
    successful  boolean   not null,
    id_user     integer   not null
        constraint id_user
            references "user"
            on update cascade on delete cascade,
    logout_time timestamp,
    session_id  varchar(255)
);

alter table login
    owner to nspbtrbjimkvml;

create unique index login_id_uindex
    on login (id);

create table workout_type
(
    id   serial
        constraint workout_type_pk
            primary key,
    type varchar(50) not null
);

alter table workout_type
    owner to nspbtrbjimkvml;

create unique index workout_type_id_uindex
    on workout_type (id);

create table workout_difficulty
(
    id         serial
        constraint workout_difficulty_pk
            primary key,
    difficulty varchar(50) not null
);

alter table workout_difficulty
    owner to nspbtrbjimkvml;

create table workout
(
    id                    serial
        constraint workout_pk
            primary key,
    workout_name          varchar(100) not null,
    id_workout_type       integer      not null
        constraint type___fk
            references workout_type
            on update cascade on delete cascade,
    id_workout_difficulty integer      not null
        constraint difficulty___fk
            references workout_difficulty
            on update cascade on delete cascade,
    creator_user_id       integer
);

alter table workout
    owner to nspbtrbjimkvml;

create unique index workout_id_uindex
    on workout (id);

create unique index workout_workout_name_uindex
    on workout (workout_name);

create unique index workout_difficulty_id_uindex
    on workout_difficulty (id);

create table exercise_type
(
    id            serial
        constraint exercise_type_pk
            primary key,
    exercise_type varchar(30) not null
);

alter table exercise_type
    owner to nspbtrbjimkvml;

create table exercise
(
    id               serial
        constraint exercise_pk
            primary key,
    exercise_name    varchar(100) not null,
    id_exercise_type integer      not null
        constraint id_exercise_type___fk
            references exercise_type
            on update cascade on delete cascade
);

alter table exercise
    owner to nspbtrbjimkvml;

create unique index exercise_id_uindex
    on exercise (id);

create unique index exercise_exercise_name_uindex
    on exercise (exercise_name);

create table workout_exercise
(
    id_workout  integer not null
        constraint workout___fk
            references workout
            on update cascade on delete cascade,
    id_exercise integer not null
        constraint exercise___fk
            references exercise
            on update cascade on delete cascade
);

alter table workout_exercise
    owner to nspbtrbjimkvml;

create unique index exercise_type_exercise_type_uindex
    on exercise_type (exercise_type);

create unique index exercise_type_id_uindex
    on exercise_type (id);

create table workout_exercise_details
(
    id          integer default nextval('exercise_details_id_seq'::regclass) not null
        constraint exercise_details_pk
            primary key,
    id_exercise integer                                                      not null
        constraint id_exercise___fk
            references exercise
            on update cascade on delete cascade,
    sets        integer,
    reps        integer,
    id_workout  integer
        constraint workout___fk
            references workout
            on update cascade on delete cascade,
    details     text
);

alter table workout_exercise_details
    owner to nspbtrbjimkvml;

create unique index exercise_details_id_uindex
    on workout_exercise_details (id);

create table status
(
    id     serial
        constraint status_pk
            primary key,
    status varchar(20) not null
);

alter table status
    owner to nspbtrbjimkvml;

create table workout_assignment
(
    id           serial,
    id_workout   integer           not null
        constraint workout___fk
            references workout
            on update cascade on delete cascade,
    id_user      integer           not null
        constraint user___fk
            references "user"
            on update cascade on delete cascade,
    workout_date timestamp         not null,
    id_status    integer default 1 not null
        constraint status___fk
            references status
            on update cascade on delete cascade
);

alter table workout_assignment
    owner to nspbtrbjimkvml;

create unique index workout_assignment_id_uindex
    on workout_assignment (id);

create unique index status_id_uindex
    on status (id);

create unique index status_status_uindex
    on status (status);



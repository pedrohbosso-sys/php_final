--
-- PostgreSQL database dump
--

\restrict yYsf38FOU7SX8zfTas2DOctKO4HTHEg0146HEAky0g0NhfhfQzXBibYORtWEgWs

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: campeonato_times; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.campeonato_times (
    id integer NOT NULL,
    campeonato_id integer,
    time_id integer
);


ALTER TABLE public.campeonato_times OWNER TO postgres;

--
-- Name: campeonato_times_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.campeonato_times_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.campeonato_times_id_seq OWNER TO postgres;

--
-- Name: campeonato_times_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.campeonato_times_id_seq OWNED BY public.campeonato_times.id;


--
-- Name: campeonatos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.campeonatos (
    id integer NOT NULL,
    nome character varying(100),
    jogo character varying(50),
    data_campeonato date,
    status character varying(50),
    modo_partida character varying(20) DEFAULT 'placar'::character varying,
    categoria character varying(30)
);


ALTER TABLE public.campeonatos OWNER TO postgres;

--
-- Name: campeonatos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.campeonatos_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.campeonatos_id_seq OWNER TO postgres;

--
-- Name: campeonatos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.campeonatos_id_seq OWNED BY public.campeonatos.id;


--
-- Name: inscricoes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inscricoes (
    id integer NOT NULL,
    usuario_id integer NOT NULL,
    campeonato_id integer NOT NULL
);


ALTER TABLE public.inscricoes OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.inscricoes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.inscricoes_id_seq OWNER TO postgres;

--
-- Name: inscricoes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.inscricoes_id_seq OWNED BY public.inscricoes.id;


--
-- Name: partida_resultados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partida_resultados (
    id integer NOT NULL,
    partida_id integer,
    time_id integer,
    colocacao integer,
    eliminacoes integer,
    pontos integer
);


ALTER TABLE public.partida_resultados OWNER TO postgres;

--
-- Name: partida_resultados_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.partida_resultados_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.partida_resultados_id_seq OWNER TO postgres;

--
-- Name: partida_resultados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partida_resultados_id_seq OWNED BY public.partida_resultados.id;


--
-- Name: partidas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partidas (
    id integer NOT NULL,
    campeonato_id integer,
    time1_id integer,
    time2_id integer,
    placar1 integer,
    placar2 integer,
    pontos_time1 integer DEFAULT 0,
    pontos_time2 integer DEFAULT 0
);


ALTER TABLE public.partidas OWNER TO postgres;

--
-- Name: partidas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.partidas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.partidas_id_seq OWNER TO postgres;

--
-- Name: partidas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.partidas_id_seq OWNED BY public.partidas.id;


--
-- Name: time_membros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.time_membros (
    id integer NOT NULL,
    time_id integer,
    usuario_id integer
);


ALTER TABLE public.time_membros OWNER TO postgres;

--
-- Name: time_membros_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.time_membros_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.time_membros_id_seq OWNER TO postgres;

--
-- Name: time_membros_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.time_membros_id_seq OWNED BY public.time_membros.id;


--
-- Name: times; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.times (
    id integer NOT NULL,
    nome character varying(100),
    jogo character varying(50),
    descricao text,
    usuario_id integer
);


ALTER TABLE public.times OWNER TO postgres;

--
-- Name: times_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.times_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.times_id_seq OWNER TO postgres;

--
-- Name: times_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.times_id_seq OWNED BY public.times.id;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer NOT NULL,
    nome character varying(100),
    email character varying(100),
    senha character varying(255),
    tipo character varying(20) DEFAULT 'usuario'::character varying NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO postgres;

--
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuarios_id_seq OWNED BY public.usuarios.id;


--
-- Name: campeonato_times id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonato_times ALTER COLUMN id SET DEFAULT nextval('public.campeonato_times_id_seq'::regclass);


--
-- Name: campeonatos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonatos ALTER COLUMN id SET DEFAULT nextval('public.campeonatos_id_seq'::regclass);


--
-- Name: inscricoes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes ALTER COLUMN id SET DEFAULT nextval('public.inscricoes_id_seq'::regclass);


--
-- Name: partida_resultados id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partida_resultados ALTER COLUMN id SET DEFAULT nextval('public.partida_resultados_id_seq'::regclass);


--
-- Name: partidas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas ALTER COLUMN id SET DEFAULT nextval('public.partidas_id_seq'::regclass);


--
-- Name: time_membros id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros ALTER COLUMN id SET DEFAULT nextval('public.time_membros_id_seq'::regclass);


--
-- Name: times id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.times ALTER COLUMN id SET DEFAULT nextval('public.times_id_seq'::regclass);


--
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios ALTER COLUMN id SET DEFAULT nextval('public.usuarios_id_seq'::regclass);


--
-- Data for Name: campeonato_times; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.campeonato_times (id, campeonato_id, time_id) FROM stdin;
\.


--
-- Data for Name: campeonatos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.campeonatos (id, nome, jogo, data_campeonato, status, modo_partida, categoria) FROM stdin;
9	fncs	fortnite	2026-02-10	aberto	placar	Battle Royale
10	fxt	cs	2026-12-10	aberto	placar	FPS
\.


--
-- Data for Name: inscricoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inscricoes (id, usuario_id, campeonato_id) FROM stdin;
10	14	9
\.


--
-- Data for Name: partida_resultados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partida_resultados (id, partida_id, time_id, colocacao, eliminacoes, pontos) FROM stdin;
\.


--
-- Data for Name: partidas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partidas (id, campeonato_id, time1_id, time2_id, placar1, placar2, pontos_time1, pontos_time2) FROM stdin;
10	9	20	21	100	209	0	0
11	10	23	24	12	12	0	0
\.


--
-- Data for Name: time_membros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.time_membros (id, time_id, usuario_id) FROM stdin;
\.


--
-- Data for Name: times; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.times (id, nome, jogo, descricao, usuario_id) FROM stdin;
5	fxt	fortnite	o milhor	2
20	daas	fortnite	asdasd	14
21	asdasdad	fortnite	asdasd	14
22	asdasd	fortnite	aSasasAS	14
23	ghjghjg	cs	sadasdfgfhgfh	14
24	kikikik	cs	fgfhfghfgh	14
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, nome, email, senha, tipo) FROM stdin;
2	pedro	pedro@gmail.com	$2y$12$6a7tYUsWiQtg876f30DViOer55COpQdQbjRKHkhn57Rc50pQiaaUa	admin
14	admin	admin@proleague.com	$2y$12$Sloz6BKHORH6F5BuXHc0M.4KgSqecI15xYGZFAUIWZtiyDAY8sApO	admin
\.


--
-- Name: campeonato_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.campeonato_times_id_seq', 1, false);


--
-- Name: campeonatos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.campeonatos_id_seq', 10, true);


--
-- Name: inscricoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inscricoes_id_seq', 10, true);


--
-- Name: partida_resultados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partida_resultados_id_seq', 1, false);


--
-- Name: partidas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partidas_id_seq', 11, true);


--
-- Name: time_membros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_membros_id_seq', 1, false);


--
-- Name: times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.times_id_seq', 24, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 14, true);


--
-- Name: campeonato_times campeonato_times_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonato_times
    ADD CONSTRAINT campeonato_times_pkey PRIMARY KEY (id);


--
-- Name: campeonatos campeonatos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonatos
    ADD CONSTRAINT campeonatos_pkey PRIMARY KEY (id);


--
-- Name: inscricoes inscricoes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes
    ADD CONSTRAINT inscricoes_pkey PRIMARY KEY (id);


--
-- Name: partida_resultados partida_resultados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partida_resultados
    ADD CONSTRAINT partida_resultados_pkey PRIMARY KEY (id);


--
-- Name: partidas partidas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_pkey PRIMARY KEY (id);


--
-- Name: time_membros time_membros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros
    ADD CONSTRAINT time_membros_pkey PRIMARY KEY (id);


--
-- Name: times times_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.times
    ADD CONSTRAINT times_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_email_key UNIQUE (email);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- Name: campeonato_times campeonato_times_campeonato_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonato_times
    ADD CONSTRAINT campeonato_times_campeonato_id_fkey FOREIGN KEY (campeonato_id) REFERENCES public.campeonatos(id);


--
-- Name: campeonato_times campeonato_times_time_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.campeonato_times
    ADD CONSTRAINT campeonato_times_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id) ON DELETE CASCADE;


--
-- Name: inscricoes inscricoes_campeonato_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes
    ADD CONSTRAINT inscricoes_campeonato_id_fkey FOREIGN KEY (campeonato_id) REFERENCES public.campeonatos(id);


--
-- Name: inscricoes inscricoes_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes
    ADD CONSTRAINT inscricoes_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- Name: partida_resultados partida_resultados_partida_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partida_resultados
    ADD CONSTRAINT partida_resultados_partida_id_fkey FOREIGN KEY (partida_id) REFERENCES public.partidas(id) ON DELETE CASCADE;


--
-- Name: partida_resultados partida_resultados_time_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partida_resultados
    ADD CONSTRAINT partida_resultados_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id) ON DELETE CASCADE;


--
-- Name: partidas partidas_campeonato_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_campeonato_id_fkey FOREIGN KEY (campeonato_id) REFERENCES public.campeonatos(id);


--
-- Name: partidas partidas_time1_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_time1_id_fkey FOREIGN KEY (time1_id) REFERENCES public.times(id) ON DELETE CASCADE;


--
-- Name: partidas partidas_time2_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_time2_id_fkey FOREIGN KEY (time2_id) REFERENCES public.times(id) ON DELETE CASCADE;


--
-- Name: time_membros time_membros_time_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros
    ADD CONSTRAINT time_membros_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id) ON DELETE CASCADE;


--
-- Name: time_membros time_membros_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros
    ADD CONSTRAINT time_membros_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- Name: times times_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.times
    ADD CONSTRAINT times_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict yYsf38FOU7SX8zfTas2DOctKO4HTHEg0146HEAky0g0NhfhfQzXBibYORtWEgWs


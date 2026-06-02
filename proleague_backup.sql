--
-- PostgreSQL database dump
--

\restrict WTKKDKdbCWPkXRM8YzXgMVHDFbMulYJXNPkltD1ydkj7G7GoMJDUdbxsBclSOM6

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
    status character varying(50)
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
-- Name: partidas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.partidas (
    id integer NOT NULL,
    campeonato_id integer,
    time1_id integer,
    time2_id integer,
    placar1 integer,
    placar2 integer
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

COPY public.campeonatos (id, nome, jogo, data_campeonato, status) FROM stdin;
1	fncs	fortnite	2000-10-01	aberto
2	fncs	fortnite	2000-10-10	aberto
3	fxt	valorant	2008-10-10	aberto
\.


--
-- Data for Name: inscricoes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inscricoes (id, usuario_id, campeonato_id) FROM stdin;
1	6	2
2	6	1
3	7	3
4	6	3
\.


--
-- Data for Name: partidas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.partidas (id, campeonato_id, time1_id, time2_id, placar1, placar2) FROM stdin;
2	3	4	3	9	12
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
1	canhotinha	fortnite	só ganhatos	6
2	direitinha	fortnite	só direitas	6
3	sla	valorant	sla man	6
4	pvpshadow	valorant	eu sou o milhor	7
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id, nome, email, senha, tipo) FROM stdin;
3	vini	vini@gmail.com	$2y$12$SxeGLC6hhfHUjd4/ce7A0usbFup4llXvf/cBflyEAHrseFohNhy8C	usuario
4	Neymar	neyJr@gmail.com	$2y$12$2919zMJDzuWHUAvoJdZBa.CpUNCoI5v2PAj7l.oPxdR7g2BuNznd.	usuario
5	joao	j@gmail.com	$2y$12$sHWxpXOme0FBJIpvyarZVuSv6OrVXLuT.A7cDKdsOTLdG16oT7CyW	usuario
6	pini	pini@gmail.com	$2y$12$wgX6Kommhs79nd.HEBoqX.dyBTb5.X33Dzb2o7vMo.WQOtYqWhGXu	usuario
2	pedro	pedro@gmail.com	$2y$12$6a7tYUsWiQtg876f30DViOer55COpQdQbjRKHkhn57Rc50pQiaaUa	admin
1	pedro	pedrohbosso@gmail.com	$2y$12$L7aSed85K648zl1iqD5.rOrTly1YVcWxECcRYejzCZxJzMLiiKX..	admin
7	joaozinho	joaozinho@gmail.com	$2y$12$dZLxLeNTP/rM8ClRqWaXlOccS/0fjkthXl68YsfZwhY1eVjom..QO	usuario
\.


--
-- Name: campeonato_times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.campeonato_times_id_seq', 1, false);


--
-- Name: campeonatos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.campeonatos_id_seq', 3, true);


--
-- Name: inscricoes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inscricoes_id_seq', 4, true);


--
-- Name: partidas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.partidas_id_seq', 2, true);


--
-- Name: time_membros_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.time_membros_id_seq', 1, false);


--
-- Name: times_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.times_id_seq', 4, true);


--
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuarios_id_seq', 7, true);


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
    ADD CONSTRAINT campeonato_times_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id);


--
-- Name: inscricoes inscricoes_campeonato_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes
    ADD CONSTRAINT inscricoes_campeonato_id_fkey FOREIGN KEY (campeonato_id) REFERENCES public.campeonatos(id);


--
-- Name: inscricoes inscricoes_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inscricoes
    ADD CONSTRAINT inscricoes_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id);


--
-- Name: partidas partidas_campeonato_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_campeonato_id_fkey FOREIGN KEY (campeonato_id) REFERENCES public.campeonatos(id);


--
-- Name: partidas partidas_time1_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_time1_id_fkey FOREIGN KEY (time1_id) REFERENCES public.times(id);


--
-- Name: partidas partidas_time2_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.partidas
    ADD CONSTRAINT partidas_time2_id_fkey FOREIGN KEY (time2_id) REFERENCES public.times(id);


--
-- Name: time_membros time_membros_time_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros
    ADD CONSTRAINT time_membros_time_id_fkey FOREIGN KEY (time_id) REFERENCES public.times(id);


--
-- Name: time_membros time_membros_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.time_membros
    ADD CONSTRAINT time_membros_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id);


--
-- Name: times times_usuario_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.times
    ADD CONSTRAINT times_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(id);


--
-- PostgreSQL database dump complete
--

\unrestrict WTKKDKdbCWPkXRM8YzXgMVHDFbMulYJXNPkltD1ydkj7G7GoMJDUdbxsBclSOM6


--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

-- Started on 2024-11-26 00:30:11

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

--
-- TOC entry 2 (class 3079 OID 16397)
-- Name: postgis; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;


--
-- TOC entry 5784 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION postgis; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 225 (class 1259 OID 17480)
-- Name: objets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.objets (
    nom character varying,
    minzoomvisible integer,
    depart boolean,
    type character varying,
    id integer NOT NULL,
    idbloque integer,
    code integer,
    "position" double precision[],
    taille double precision[],
    url_icone character varying,
    point public.geometry(Point,4326)
);


ALTER TABLE public.objets OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 17485)
-- Name: objets_code_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.objets_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.objets_code_seq OWNER TO postgres;

--
-- TOC entry 5785 (class 0 OID 0)
-- Dependencies: 226
-- Name: objets_code_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.objets_code_seq OWNED BY public.objets.code;


--
-- TOC entry 227 (class 1259 OID 17486)
-- Name: objets_idBloque_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."objets_idBloque_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."objets_idBloque_seq" OWNER TO postgres;

--
-- TOC entry 5786 (class 0 OID 0)
-- Dependencies: 227
-- Name: objets_idBloque_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."objets_idBloque_seq" OWNED BY public.objets.idbloque;


--
-- TOC entry 228 (class 1259 OID 17487)
-- Name: objets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.objets_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.objets_id_seq OWNER TO postgres;

--
-- TOC entry 5787 (class 0 OID 0)
-- Dependencies: 228
-- Name: objets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.objets_id_seq OWNED BY public.objets.id;


--
-- TOC entry 229 (class 1259 OID 17488)
-- Name: objets_minZoomVisible_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."objets_minZoomVisible_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public."objets_minZoomVisible_seq" OWNER TO postgres;

--
-- TOC entry 5788 (class 0 OID 0)
-- Dependencies: 229
-- Name: objets_minZoomVisible_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."objets_minZoomVisible_seq" OWNED BY public.objets.minzoomvisible;


--
-- TOC entry 218 (class 1259 OID 16389)
-- Name: score; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.score (
    id integer NOT NULL,
    pseudo character varying,
    value integer
);


ALTER TABLE public.score OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16394)
-- Name: score_score_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.score ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.score_score_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 5611 (class 2604 OID 17489)
-- Name: objets minzoomvisible; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objets ALTER COLUMN minzoomvisible SET DEFAULT nextval('public."objets_minZoomVisible_seq"'::regclass);


--
-- TOC entry 5612 (class 2604 OID 17490)
-- Name: objets id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objets ALTER COLUMN id SET DEFAULT nextval('public.objets_id_seq'::regclass);


--
-- TOC entry 5613 (class 2604 OID 17491)
-- Name: objets idbloque; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objets ALTER COLUMN idbloque SET DEFAULT nextval('public."objets_idBloque_seq"'::regclass);


--
-- TOC entry 5614 (class 2604 OID 17492)
-- Name: objets code; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objets ALTER COLUMN code SET DEFAULT nextval('public.objets_code_seq'::regclass);


--
-- TOC entry 5774 (class 0 OID 17480)
-- Dependencies: 225
-- Data for Name: objets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.objets (nom, minzoomvisible, depart, type, id, idbloque, code, "position", taille, url_icone, point) FROM stdin;
ballon	19	t	Code	4	\N	4751	{48.836,2.579}	{60,60}	images/ballon.jpg	0101000020E61000006F1283C0CAA104405EBA490C026B4840
livre	19	t	Recuperable	1	\N	\N	{48.841,2.5872}	{66,80}	images/livre_729.jpg	0101000020E61000008AB0E1E995B20440CFF753E3A56B4840
gta	19	t	Bloque_objet	2	1	\N	{48.837,2.593}	{79,100}	images/gta.jpg	0101000020E61000005839B4C876BE04404260E5D0226B4840
trophée	19	f	Bloque_code	3	4	\N	{48.837,2.593}	{69.25,90}	images/trophee.jpg	0101000020E61000005839B4C876BE04404260E5D0226B4840
trésor	19	f	Recuperable	5	\N	\N	{48.837,2.593}	{69.25,90}	images/tresor.jpg	0101000020E61000005839B4C876BE04404260E5D0226B4840
\.


--
-- TOC entry 5772 (class 0 OID 16389)
-- Dependencies: 218
-- Data for Name: score; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.score (id, pseudo, value) FROM stdin;
1	Bruce	100
2	Vivien	100
3	Victor	200
4	Vincent	200
5	SuperÉlève	500
6	MauvaisÉlève	50
8	RandomPlayer3	78
9	RandomPlayer2	80
10	RandomPlayer4	90
11	RandomPlayer5	120
7	RandomPlayer1	25
18	BruceBPN	200
19	BruceBPN	200
20	BruceBPN	300
21	BruceBPN	400
\.


--
-- TOC entry 5610 (class 0 OID 16719)
-- Dependencies: 221
-- Data for Name: spatial_ref_sys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
\.


--
-- TOC entry 5789 (class 0 OID 0)
-- Dependencies: 226
-- Name: objets_code_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.objets_code_seq', 1, true);


--
-- TOC entry 5790 (class 0 OID 0)
-- Dependencies: 227
-- Name: objets_idBloque_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."objets_idBloque_seq"', 1, true);


--
-- TOC entry 5791 (class 0 OID 0)
-- Dependencies: 228
-- Name: objets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.objets_id_seq', 1, false);


--
-- TOC entry 5792 (class 0 OID 0)
-- Dependencies: 229
-- Name: objets_minZoomVisible_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."objets_minZoomVisible_seq"', 1, false);


--
-- TOC entry 5793 (class 0 OID 0)
-- Dependencies: 219
-- Name: score_score_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.score_score_id_seq', 21, true);


--
-- TOC entry 5621 (class 2606 OID 17494)
-- Name: objets id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.objets
    ADD CONSTRAINT id PRIMARY KEY (id);


--
-- TOC entry 5617 (class 2606 OID 16396)
-- Name: score pk_score_id; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.score
    ADD CONSTRAINT pk_score_id PRIMARY KEY (id);


-- Completed on 2024-11-26 00:30:11

--
-- PostgreSQL database dump complete
--


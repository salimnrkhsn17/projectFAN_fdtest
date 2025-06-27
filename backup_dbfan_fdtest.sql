--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2
-- Dumped by pg_dump version 16.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
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
-- Name: books; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.books (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    title character varying(255) NOT NULL,
    author character varying(255) NOT NULL,
    description text NOT NULL,
    thumbnail character varying(255),
    rating smallint DEFAULT '1'::smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.books OWNER TO postgres;

--
-- Name: books_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.books_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.books_id_seq OWNER TO postgres;

--
-- Name: books_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.books_id_seq OWNED BY public.books.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: books id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books ALTER COLUMN id SET DEFAULT nextval('public.books_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: books; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.books (id, user_id, title, author, description, thumbnail, rating, created_at, updated_at) FROM stdin;
2	1	Milea: Suara dari Dilan	Pidi Baiq	Milea rindu	thumbnails/yehNGFD4c9QIzm3yGA0WtcUQe3Zhuwp9McRrO6XP.jpg	4	2025-06-26 11:36:40	2025-06-26 11:36:40
1	1	Dilan: Dia adalah dilan ku	Pidi Baiq	Dilan da hutang	thumbnails/RkWWWt39CnQg2lGum6nh6plO3YvnnBV5Od39awZM.jpg	5	2025-06-26 11:02:36	2025-06-26 15:16:58
3	2	Layangan Putus	drh Eka Nur Prasetyawati	Novel Layangan Putus	thumbnails/yUUFxEBhFO8R8iXfiLplMfZYQAwP28k5X2bAWjDz.jpg	5	2025-06-26 15:29:22	2025-06-26 15:29:22
4	2	Nanti Kita Cerita Tentang Hari Ini	Marchella FP	Novel Nanti Kita Cerita Tentang Hari Ini	thumbnails/JwowpvJkEvvo2PyDtXleFE54PTgm3bkOhHdWuccX.jpg	4	2025-06-26 15:31:35	2025-06-26 15:31:35
5	2	Muhammad the Messanger	Abdurrahman Asy Syarqawi	Cerita perjalanan Nabi Muhammad S.A.W	thumbnails/mh2CCncZWZbmjscNB5nR3bel9dPUi4g3I4VirTeJ.jpg	5	2025-06-26 15:34:19	2025-06-26 15:34:19
6	2	Ayat Ayat Cinta	Habiburrahman El Shirazy	Kisah cinta Fahri yang dibalut nilai-nilai Islam, setting di Mesir, sangat populer.	thumbnails/7FqGbtwnftrz8itHxeJhGczKRyGkJctSuI8X9Umh.png	5	2025-06-26 15:38:19	2025-06-26 15:38:19
7	2	Rembulan Tenggelam di Wajahmu	Tere Liye	Sarat makna kehidupan dan refleksi keimanan, walaupun tidak eksplisit Islami.	thumbnails/1V1nK0hsIvtTTiuD7XWXcmuiIosSwDue1hgalgcx.jpg	5	2025-06-26 15:40:39	2025-06-26 15:40:39
8	2	A Thousand Splendid Suns	Khaled Hosseini	entang perempuan di Afghanistan, menggambarkan penderitaan, cinta, dan keteguhan iman.	thumbnails/LTlZy5G9HRqhTTklViy8N1daluE04RJCmUi3TBSw.jpg	4	2025-06-26 15:42:13	2025-06-26 15:42:13
9	2	Bidadari Bermata Bening	Habiburrahman El Shirazy	Kisah santriwati yang kuat dan tangguh menghadapi fitnah dan cobaan hidup.	thumbnails/k3oLTMBO0omHFVxZHb8K0EZbxEQWMPEMARZarFOe.jpg	4	2025-06-26 16:03:56	2025-06-26 16:03:56
10	2	The Kite Runner	Khaled Hosseini	Tidak eksplisit Islami, namun sarat dengan nilai moral, religiusitas, dan pengampunan.	thumbnails/QdPK7BOkVcA666IsHhAVtBunowZG6PnIudbKkbDI.jpg	4	2025-06-26 16:05:22	2025-06-26 16:05:22
11	2	Ketika Cinta Bertasbih	Habiburrahman El Shirazy	Lika-liku perjuangan dan cinta Azzam di Mesir, sangat Islami dan menyentuh.	thumbnails/kXxHkOPqbL2hnmJZOnGCPsYrT5Mj0bBUpgOk2tVa.jpg	5	2025-06-26 16:06:55	2025-06-26 16:06:55
12	2	Surga yang Tak di Rindukan	Asma Nadia	Novel tentang poligami yang menggugah emosi dan mempertanyakan makna cinta dan surga dunia.	thumbnails/M5aS484xVdmtlY1zuIHThACjMaEceGsq1tXYl95b.jpg	4	2025-06-26 16:08:34	2025-06-26 16:08:34
14	1	Assalamu'alaikum Beijing	Asma Nadia	Novel Islami romantis dengan latar Beijing. Mengandung nilai dakwah dan inspirasi perempuan muslimah.	thumbnails/Pooc6qBrIwXHGFEVyqg633BhZebnOcwGfa6S76kc.jpg	5	2025-06-26 16:38:14	2025-06-26 16:38:14
15	1	Negeri 5 Menara	Ahmad Fuadi	Tidak eksplisit Islami, tapi sangat kental dengan nilai-nilai pesantren dan perjuangan belajar.	thumbnails/UAvkAen0Jn7kkeshiiON7unrt4mRjsdaIHlnXxnU.jpg	3	2025-06-26 16:40:02	2025-06-26 16:40:02
16	1	Habibie & Ainun	Bacharuddin Jusuf Habibie	Kisah cinta nyata antara B.J. Habibie (Presiden ke-3 RI) dan istrinya, Ainun. Ditulis langsung oleh Habibie setelah wafatnya sang istri.	thumbnails/gtPKapCNcC3cJpseaOqmg028N2yIkIiYzoaDr8O0.jpg	5	2025-06-26 16:41:58	2025-06-26 16:41:58
17	1	The Conference of the Birds	Farid ud-Din Attar	Klasik sufistik (fabel), tentang pencarian makna Ilahi oleh burung-burung—sarat makna spiritual Islam.	thumbnails/5sBQEhbScpYyY0AFazK0OUetTGxUdIZnNIgZ85BS.jpg	3	2025-06-26 16:44:13	2025-06-26 16:44:13
18	1	Hafalan Shalat Delisa	Tere Liye	Kisah seorang anak korban tsunami Aceh, menyentuh, islami, dan penuh nilai kehidupan.	thumbnails/Ime83Y4oFZ4H5QWNwvrmrFANFGwfpkU9gK0tBliA.jpg	4	2025-06-26 16:45:45	2025-06-26 16:45:45
19	1	Cinta Suci Zahrana	Habiburrahman El Shirazy	Mengangkat kisah perempuan Muslim cerdas dan tangguh, dikisahkan dengan sentuhan sastra.	thumbnails/1ZnSWcyi945gSwshypg5eOeFXbyWSFdgVyI5fUpr.jpg	3	2025-06-26 16:48:29	2025-06-26 16:48:29
20	1	Kuantar ke Gerbang	Ramadhan K.H.	Kisah cinta dan perjuangan Soekarno dan Inggit Garnasih; romantis sekaligus politis.	thumbnails/26U9SNq6AHvlInwRQX2CqYxP5yRuVfmkZBDxGcgg.jpg	4	2025-06-26 16:50:35	2025-06-26 16:50:35
21	1	Laskar Pelangi	Andrea Hirata	Terinspirasi dari kehidupan penulis sendiri, tentang anak kampung yang bermimpi besar, penuh nilai pendidikan dan perjuangan.	thumbnails/SDw3sKqNozVVSomyMTG1XEqfrKopqTsWuNwCrssT.jpg	5	2025-06-26 16:52:19	2025-06-26 16:52:19
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_06_26_075639_create_books_table	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
KRS59T4dEjlSXDe1N3E66sVQBEVAQxtAuwsMyYfT	2	127.0.0.1	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnlGVmtvZTg2QWFoNFBTcHVpY2I2aUI4b3lDcFF2OEk1TDlpdWxtMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VycyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==	1751005410
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
1	Salim	salimnurikhsan.17@gmail.com	2025-06-26 09:05:10	$2y$12$aaUOMwYsM2/.B5xg6BaK..dFqWYQ4GliatI6aB6MfP4iKqy3doO5W	PiB9s8bbVFUaXjytISLQxyolTNnDu0igtvXMjZGC97CD3e68WXtITGxFzFZ3	2025-06-26 08:37:10	2025-06-26 12:45:34
2	Nurikhsan	nurikhsanror@gmail.com	2025-06-26 13:11:14	$2y$12$4OZrGrby9u52oCQxO5H7..UZFreJWv2Y5rwwDRKUXL.RHuKXkpIEG	\N	2025-06-26 13:02:52	2025-06-27 06:10:55
\.


--
-- Name: books_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.books_id_seq', 21, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 4, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


--
-- Name: books books_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: books books_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.books
    ADD CONSTRAINT books_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--


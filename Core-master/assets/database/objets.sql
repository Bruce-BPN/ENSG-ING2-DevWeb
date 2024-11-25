PGDMP  )                 
    |            objets    17.2    17.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    16388    objets    DATABASE     y   CREATE DATABASE objets WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_France.1252';
    DROP DATABASE objets;
                     postgres    false                        3079    16397    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                        false            �           0    0    EXTENSION postgis    COMMENT     ^   COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';
                             false    2            �            1259    17480    objets    TABLE     Q  CREATE TABLE public.objets (
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
    DROP TABLE public.objets;
       public         heap r       postgres    false    2    2    2    2    2    2    2    2            �            1259    17485    objets_code_seq    SEQUENCE     �   CREATE SEQUENCE public.objets_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.objets_code_seq;
       public               postgres    false    225            �           0    0    objets_code_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.objets_code_seq OWNED BY public.objets.code;
          public               postgres    false    226            �            1259    17486    objets_idBloque_seq    SEQUENCE     �   CREATE SEQUENCE public."objets_idBloque_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public."objets_idBloque_seq";
       public               postgres    false    225            �           0    0    objets_idBloque_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public."objets_idBloque_seq" OWNED BY public.objets.idbloque;
          public               postgres    false    227            �            1259    17487    objets_id_seq    SEQUENCE     �   CREATE SEQUENCE public.objets_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.objets_id_seq;
       public               postgres    false    225            �           0    0    objets_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.objets_id_seq OWNED BY public.objets.id;
          public               postgres    false    228            �            1259    17488    objets_minZoomVisible_seq    SEQUENCE     �   CREATE SEQUENCE public."objets_minZoomVisible_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public."objets_minZoomVisible_seq";
       public               postgres    false    225            �           0    0    objets_minZoomVisible_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public."objets_minZoomVisible_seq" OWNED BY public.objets.minzoomvisible;
          public               postgres    false    229            �            1259    16389    score    TABLE     h   CREATE TABLE public.score (
    id integer NOT NULL,
    pseudo character varying,
    value integer
);
    DROP TABLE public.score;
       public         heap r       postgres    false            �            1259    16394    score_score_id_seq    SEQUENCE     �   ALTER TABLE public.score ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.score_score_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public               postgres    false    218            �           2604    17489    objets minzoomvisible    DEFAULT     �   ALTER TABLE ONLY public.objets ALTER COLUMN minzoomvisible SET DEFAULT nextval('public."objets_minZoomVisible_seq"'::regclass);
 D   ALTER TABLE public.objets ALTER COLUMN minzoomvisible DROP DEFAULT;
       public               postgres    false    229    225            �           2604    17490 	   objets id    DEFAULT     f   ALTER TABLE ONLY public.objets ALTER COLUMN id SET DEFAULT nextval('public.objets_id_seq'::regclass);
 8   ALTER TABLE public.objets ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    228    225            �           2604    17491    objets idbloque    DEFAULT     t   ALTER TABLE ONLY public.objets ALTER COLUMN idbloque SET DEFAULT nextval('public."objets_idBloque_seq"'::regclass);
 >   ALTER TABLE public.objets ALTER COLUMN idbloque DROP DEFAULT;
       public               postgres    false    227    225            �           2604    17492    objets code    DEFAULT     j   ALTER TABLE ONLY public.objets ALTER COLUMN code SET DEFAULT nextval('public.objets_code_seq'::regclass);
 :   ALTER TABLE public.objets ALTER COLUMN code DROP DEFAULT;
       public               postgres    false    226    225            �          0    17480    objets 
   TABLE DATA           }   COPY public.objets (nom, minzoomvisible, depart, type, id, idbloque, code, "position", taille, url_icone, point) FROM stdin;
    public               postgres    false    225   �        �          0    16389    score 
   TABLE DATA           2   COPY public.score (id, pseudo, value) FROM stdin;
    public               postgres    false    218   "       �          0    16719    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public               postgres    false    221   �"       �           0    0    objets_code_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.objets_code_seq', 1, true);
          public               postgres    false    226            �           0    0    objets_idBloque_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public."objets_idBloque_seq"', 1, true);
          public               postgres    false    227            �           0    0    objets_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.objets_id_seq', 1, false);
          public               postgres    false    228            �           0    0    objets_minZoomVisible_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public."objets_minZoomVisible_seq"', 1, false);
          public               postgres    false    229            �           0    0    score_score_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.score_score_id_seq', 21, true);
          public               postgres    false    219            �           2606    17494 	   objets id 
   CONSTRAINT     G   ALTER TABLE ONLY public.objets
    ADD CONSTRAINT id PRIMARY KEY (id);
 3   ALTER TABLE ONLY public.objets DROP CONSTRAINT id;
       public                 postgres    false    225            �           2606    16396    score pk_score_id 
   CONSTRAINT     O   ALTER TABLE ONLY public.score
    ADD CONSTRAINT pk_score_id PRIMARY KEY (id);
 ;   ALTER TABLE ONLY public.score DROP CONSTRAINT pk_score_id;
       public                 postgres    false    218            �     x���KN�0�s�(���2Β�JURLhHHS6U�s�b�Ai�T���,�|��m�~�@X�UËC-���=S��"'����r�~o:�}hca�;�o�X/ jL��*K���d* �0� ��_�K�[�F75m��O���$�"W;V/%�7xU��j�	|UגSKK��ws�p��;�ڍ�I~�[\SoK��������rE�a�����2"��G ��i�N�8���^��i��/-tAx�/x����8�Ô����u�������"˲oԄ�C      �   �   x�U�1� ����c�i�t��i4qr!�ФR���G�&ޣqh�wz]�ց� �˰�gT	v�dB���s��9>\X���YTJ{L\���"i���M�~4/*4��"IhA,�V�M����RPS4�T�����<�mi)6W?��:��#�/�I$      �      x������ � �     
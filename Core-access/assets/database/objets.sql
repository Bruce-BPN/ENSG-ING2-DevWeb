PGDMP  4                
    |            objets    17.1    17.1     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            �           1262    24580    objets    DATABASE     y   CREATE DATABASE objets WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_France.1252';
    DROP DATABASE objets;
                     postgres    false                        3079    35324    postgis 	   EXTENSION     ;   CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;
    DROP EXTENSION postgis;
                        false            �           0    0    EXTENSION postgis    COMMENT     ^   COMMENT ON EXTENSION postgis IS 'PostGIS geometry and geography spatial types and functions';
                             false    2            �            1259    24585    objets    TABLE     Q  CREATE TABLE public.objets (
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
       public         heap r       postgres    false    2    2    2    2    2    2    2    2            �            1259    24584    objets_code_seq    SEQUENCE     �   CREATE SEQUENCE public.objets_code_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.objets_code_seq;
       public               postgres    false    222            �           0    0    objets_code_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.objets_code_seq OWNED BY public.objets.code;
          public               postgres    false    221            �            1259    24583    objets_idBloque_seq    SEQUENCE     �   CREATE SEQUENCE public."objets_idBloque_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ,   DROP SEQUENCE public."objets_idBloque_seq";
       public               postgres    false    222            �           0    0    objets_idBloque_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public."objets_idBloque_seq" OWNED BY public.objets.idbloque;
          public               postgres    false    220            �            1259    24582    objets_id_seq    SEQUENCE     �   CREATE SEQUENCE public.objets_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.objets_id_seq;
       public               postgres    false    222            �           0    0    objets_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.objets_id_seq OWNED BY public.objets.id;
          public               postgres    false    219            �            1259    24581    objets_minZoomVisible_seq    SEQUENCE     �   CREATE SEQUENCE public."objets_minZoomVisible_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public."objets_minZoomVisible_seq";
       public               postgres    false    222            �           0    0    objets_minZoomVisible_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public."objets_minZoomVisible_seq" OWNED BY public.objets.minzoomvisible;
          public               postgres    false    218            �           2604    24588    objets minzoomvisible    DEFAULT     �   ALTER TABLE ONLY public.objets ALTER COLUMN minzoomvisible SET DEFAULT nextval('public."objets_minZoomVisible_seq"'::regclass);
 D   ALTER TABLE public.objets ALTER COLUMN minzoomvisible DROP DEFAULT;
       public               postgres    false    218    222    222            �           2604    24589 	   objets id    DEFAULT     f   ALTER TABLE ONLY public.objets ALTER COLUMN id SET DEFAULT nextval('public.objets_id_seq'::regclass);
 8   ALTER TABLE public.objets ALTER COLUMN id DROP DEFAULT;
       public               postgres    false    222    219    222            �           2604    24590    objets idbloque    DEFAULT     t   ALTER TABLE ONLY public.objets ALTER COLUMN idbloque SET DEFAULT nextval('public."objets_idBloque_seq"'::regclass);
 >   ALTER TABLE public.objets ALTER COLUMN idbloque DROP DEFAULT;
       public               postgres    false    222    220    222            �           2604    24591    objets code    DEFAULT     j   ALTER TABLE ONLY public.objets ALTER COLUMN code SET DEFAULT nextval('public.objets_code_seq'::regclass);
 :   ALTER TABLE public.objets ALTER COLUMN code DROP DEFAULT;
       public               postgres    false    222    221    222            �          0    24585    objets 
   TABLE DATA           }   COPY public.objets (nom, minzoomvisible, depart, type, id, idbloque, code, "position", taille, url_icone, point) FROM stdin;
    public               postgres    false    222   �       �          0    35646    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public               postgres    false    224   �       �           0    0    objets_code_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.objets_code_seq', 1, true);
          public               postgres    false    221            �           0    0    objets_idBloque_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public."objets_idBloque_seq"', 1, true);
          public               postgres    false    220            �           0    0    objets_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.objets_id_seq', 1, false);
          public               postgres    false    219            �           0    0    objets_minZoomVisible_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public."objets_minZoomVisible_seq"', 1, false);
          public               postgres    false    218            �   0  x���Kn�0@��9 �c{�[bj�]t����D�PB��r ��Ŋ!i�lZ�ے罙q��lB����o�зY^�Wd���u���,Z�9Jj8��[V��ʿR�D��$@�9NNбG�1�2@�$M����BZ�A�����O/�V��a�WM֮6�sA8��W��p/a"&B�x|����L���،���V�:��YU��s!���=��g+���<?����h �3V��i�@�t�v����vN�g�u���24�ī3�ѡ�9����������oe�1�E`�ײ�� � F�f      �      x������ � �     
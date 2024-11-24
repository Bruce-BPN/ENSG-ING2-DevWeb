PGDMP  5    5            
    |            objets    17.2    17.2     �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
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
                             false    2            �            1259    17469    objets    TABLE     Q  CREATE TABLE public.objets (
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
       public         heap r       postgres    false    2    2    2    2    2    2    2    2            �            1259    16389    score    TABLE     h   CREATE TABLE public.score (
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
            public               postgres    false    218            �          0    17469    objets 
   TABLE DATA           }   COPY public.objets (nom, minzoomvisible, depart, type, id, idbloque, code, "position", taille, url_icone, point) FROM stdin;
    public               postgres    false    225   G       �          0    16389    score 
   TABLE DATA           2   COPY public.score (id, pseudo, value) FROM stdin;
    public               postgres    false    218   P       �          0    16719    spatial_ref_sys 
   TABLE DATA           X   COPY public.spatial_ref_sys (srid, auth_name, auth_srid, srtext, proj4text) FROM stdin;
    public               postgres    false    221   �       �           0    0    score_score_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.score_score_id_seq', 5, true);
          public               postgres    false    219            �           2606    16396    score pk_score_id 
   CONSTRAINT     O   ALTER TABLE ONLY public.score
    ADD CONSTRAINT pk_score_id PRIMARY KEY (id);
 ;   ALTER TABLE ONLY public.score DROP CONSTRAINT pk_score_id;
       public                 postgres    false    218            �   �   x���1r�0E��> �����J�J�"���0ƕ��\,`Ȑ�$M&�ͪо���<pdu8��~��v�Cف ���aF&�`��+\s�+����<�U�g���c�%��ۀ$4:�E!tF�Pi3�M�3�Dumh^�����	��S	�'��L�خ�k��Q�����	|�R����;�c��珿`��R�����\�c��|I?������~n���E]���!�ZIӗ7!��aǢ(� �i��      �   /   x�3�t**MN�44�2B0�aL#.N������Ҕ|��)BQ� �y      �      x������ � �     
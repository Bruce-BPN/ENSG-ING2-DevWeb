PGDMP      .            
    |            objets    17.0    17.0 	    N           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            O           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            P           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            Q           1262    16388    objets    DATABASE     y   CREATE DATABASE objets WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'French_France.1252';
    DROP DATABASE objets;
                     postgres    false            �            1259    17497    score    TABLE     h   CREATE TABLE public.score (
    id integer NOT NULL,
    pseudo character varying,
    value integer
);
    DROP TABLE public.score;
       public         heap r       postgres    false            �            1259    17502    score_score_id_seq    SEQUENCE     �   ALTER TABLE public.score ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.score_score_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public               postgres    false    223            J          0    17497    score 
   TABLE DATA           2   COPY public.score (id, pseudo, value) FROM stdin;
    public               postgres    false    223   x       R           0    0    score_score_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.score_score_id_seq', 11, true);
          public               postgres    false    224            �           2606    17504    score pk_score_id 
   CONSTRAINT     O   ALTER TABLE ONLY public.score
    ADD CONSTRAINT pk_score_id PRIMARY KEY (id);
 ;   ALTER TABLE ONLY public.score DROP CONSTRAINT pk_score_id;
       public                 postgres    false    223            J   �   x�U�1
�0���������.���K�o�Tb���{�b�.��������"�k(A↮�/s���+���l2�䧤�3��"0��8�\\x��,�.���iroIKcSV��z���9֊����mGD?��9�     
??          ?      l      ?     ?     ?          )     A     Y     q     ?     ?     ?     ?     ?               7     Q     k     ?     ?     ?  `  ?  ?   &         3     B  ?   T       ?        ?  ?   ?     r	  E   ~	     ?	     ?	     ?	     ?	     ?	     ?	     ?	  ?   ?	     ?
                	          
                                                                        ['int_format_ex1_desc'] ['int_format_ex1_form'] ['int_format_ex2_desc'] ['int_format_ex2_form'] ['int_format_ex3_desc'] ['int_format_ex3_form'] ['int_format_ex4_desc'] ['int_format_ex4_form'] ['int_format_ex5_desc'] ['int_format_ex5_form'] ['int_format_ex_other'] ['int_format_ex_other_1'] ['int_format_ex_other_2'] ['int_format_ex_other_3'] ['int_format_ex_other_4'] ['int_format_ex_other_5'] ['int_format_ex_other_6'] ['int_format_ex_other_7'] ['int_format_explain'] ['page_title'] Project-Id-Version: Scriptcase
Plural-Forms: nplurals=2; plural=(n != 1);
POT-Creation-Date: 
PO-Revision-Date: 
Last-Translator: Vinicius <vinicius@netmake.com.br>
Language-Team: 
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
Language: {$lang_folder}
X-Generator: Poedit 2.0.1
X-Poedit-SourceCharset: UTF-8
 Exemple 1: Une date est contenue dans un champ défini en tant que char(8) où la position 1 à 4 contiennent l&#39;année, la position 5 à 6 contiennent le mois et la position 7 à 8 contiennent le jour, remplissez le format interne comme suit : AAAAMMJJ ou aaaammjj Exemple 2 : Une valeur de temps est contenue dans un champ SQL défini en tant que char(6) où la position 1 à 2 contiennent les heures, la position 3 à 4 contiennent les minutes et la position 5 à 6 contiennent les secondes, remplissez le format interne comme suit : HHMMSS ou hhmmss  Exemple 3 : Champ SQL numérique contenant une quantité de secondes et vous aimeriez l&#39;afficher en tant que jour et/ou heure et/ou minutes, remplissez le format interne comme suit : SEC ou sec  Exemple 4: Champs SQL numérique contenant une quantité de minutes et vous aimeriez les afficher en tant que jour et/ou heures, remplissez le format interne comme suit : MIN ou min  Exemple 5: Champ SQL numérique avec le nombre d&#39;heures que vous voulez afficher dans le format jours, remplissez ce champ avec les informations suivantes: HOR ou hor  Vous pouvez utiliser d&#39;autres types de format, voir des exemples: jjmmaaaa HHII  MMAAAA  AAAA MMJJ JJ HH Informations utilisée lorsque le type de champ est date, heure ou de date/heure mais qui est stocké dans la base de données dans un autre type de données SQL. Format interne  
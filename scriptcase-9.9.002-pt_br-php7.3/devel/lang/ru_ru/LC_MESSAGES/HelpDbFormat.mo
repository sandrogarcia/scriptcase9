��          �      l      �     �     �          )     A     Y     q     �     �     �     �     �               7     Q     k     �     �     �  `  �  �   &  (   �  �   #        
  .     9  �   N     8	  �   M	     ,
  �   A
     �
     �
     �
     �
     �
                !   (                	          
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
 Пример 1: Дата сохранена в поле SQL как char(8), где позиции 1-4 - это года, 5-6 - это месяц и 7-8 - это день, укажите формат в виде: ГГГГММДД или ггггммдд Пример 2: Время сохранено в поле SQL как char(6), где 1-2 - это часы, эти 3-4 - это минуты и 5-6 - это секунды, укажите внутренний формат ввиде: ЧЧММСС или ччммсс Пример 3: SQL числовая область, хранящая количество секунд и Вы хотите показать его как дни и/или часы и/или минуты, заполнить внутренний формат как: СЕК или сек Пример 4: SQL numeraic область, хранящая количество минут и Вы хотите показать его как дни и/или часы, заполнить внутренний формат как: МИН или мин Пример 5: SQL числовая область, хранящая количество часов и Вы хотите показать его как дни, заполнить внутренний формат как: ЧАС или час Вы можете использовать другие стили форматирование (посмотрите примеры): ДДММГГГГ ЧЧММ ММГГГГ ГГГГ ММДД ДД ЧЧ Информация использовала для форматирования ценности, когда полевой тип - дата, время или datetime на ScriptCase, но сохранен на базе данных, используя другой SQL datatype. Внутренний формат 
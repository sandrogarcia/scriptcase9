??          ?      l      ?     ?     ?          )     A     Y     q     ?     ?     ?     ?     ?               7     Q     k     ?     ?     ?  `  ?  ?   &     ?  ?   ?     V  c   h  	   ?  Y   ?     0  U   <  	   ?  6   ?     ?     ?     ?     ?     ?     ?     ?  s   ?     l                	          
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
 例1：日期值存储在SQL字段定义为char (8)的数据表中：1至4位存储年，5至6位存储月，7日至8位存储日，格式： YYYYMMDD或yyyymmdd 例2：时间值存储在SQL字段定义为char (6)的数据表中：1至2位存储时，3至4位存储分，5日至6位存储秒，格式： HHIISS 或 hhiiss 例3：SQL数字字段存储秒数和您要显示天和/或小时和/或分钟，内部格式为： SEC或sec 例4：SQL数字字段存储分钟数和您要显示日和/或小时，内部格式为： MIN 或 min 例5：SQL数字字段存储小时数和您希望显示它为日，内部格式为： HOR或hor 您可以使用其他格式样式，请参见示例： DDMMYYYY HHII MMYYYY YYYY MMDD DD HH 当日期、时间或日期时间在ScriptCase中与在数据库中的格式不同时，使用数值格式设置。 内部格式 
??          ?      l      ?     ?     ?          )     A     Y     q     ?     ?     ?     ?     ?               7     Q     k     ?     ?     ?  `  ?  ?   &     ?  ?   ?     }  i   ?     ?  _        e  [   q     ?  6   ?                    %     *     /     2  ?   5     ?                	          
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
 例1：日期值存儲在SQL中，欄位定義為char（8）1至4位存放年，5至6位元存儲月，7日至8位元存儲日，填充內部格式為： YYYYMMDD 或 yyyymmdd 例2：時間值存儲_在SQL中，欄位定義為char（6），1至2個位置存儲小時，3至4位置存儲分鐘，5至6位元存儲秒，填充內部格式為： HHIISS 或 hhiiss 例3：SQL數位欄位存儲秒數和您要顯示天和/或小時和/或分鐘，填充內部格式為： SEC 或 sec 例4：SQL數位欄位存儲分鐘數和您要顯示日和/或小時，填充內部格式為： MIN 或 min 例5：SQL數位欄位存儲小時數和您希望顯示它為日，填充內部格式為： HOR 或 hor 您可以使用其他格式樣式，請參見示例： DDMMYYYY HHII MMYYYY YYYY MMDD DD HH 當在Scriptcase是使用另一個SQL資料類型來存儲欄位類型為日期、時間或日期時，使用這些資訊來格式值。 內部格式 
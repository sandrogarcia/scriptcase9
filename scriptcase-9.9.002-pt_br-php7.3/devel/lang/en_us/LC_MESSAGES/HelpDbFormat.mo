??          ?      l      ?     ?     ?          )     A     Y     q     ?     ?     ?     ?     ?               7     Q     k     ?     ?     ?  `  ?  ?   &     ?  ?        ?  ?     
   ?  ?   ?  
   1  y   <  
   ?  2   ?     ?     ?     	     		     	     	     	  ?   	     ?	                	          
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
 Example 1: A date value is stored in a SQL field defined as char(8) where the 1 to 4 positions store the year, the 5 to 6 positions store the month and the 7 to 8 positions store the day, fill the internal format as: YYYYMMDD or yyyymmdd Example 2: A time value is stored in a SQL field defined as char(6) where the 1 to 2 positions store the hours, the 3 to 4 positions store the minutes and the 5 to 6 positions store the seconds, fill the internal format as: HHIISS or hhiiss Example 3: SQL numeric field storing a quantity of seconds and you wish to display it as days and/or hours and/or minutes, fill the internal format as: SEC or sec Example 4: SQL numeric field storing a quantity of minutes and you wish to display it as days and/or hours, fill the internal format as: MIN or min Example 5: SQL numeric field storing a quantity of hours and you wish to display it as days, fill the internal format as: HOR ou hor You can use other formatting styles, see examples: DDMMYYYY HHII MMYYYY YYYY MMDD DD HH Information used for formatting values when the field type is date, time or datetime on ScriptCase but is stored on the database using another SQL datatype. Internal Format 
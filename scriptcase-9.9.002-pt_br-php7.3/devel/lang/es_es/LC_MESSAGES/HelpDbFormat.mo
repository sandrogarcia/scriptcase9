??          ?      l      ?     ?     ?          )     A     Y     q     ?     ?     ?     ?     ?               7     Q     k     ?     ?     ?  `  ?  ?   &       ?          ?     	   ?  ?   ?  	   H  }   R  	   ?  6   ?     	     	     	     &	     +	     0	     3	  ?   6	     ?	                	          
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
 Ejemplo 1: Un valor de fecha se almacena en un campo de SQL definido como char (8) cuando el 1 a 4 posición almacena el año, el 5 a 6 posición almacena el mes y el 7 a 8 posiciones  el día, llenar el formato interno como: AAAAMMDD o aaaammdd Ejemplo 2: Un valor de hora se almacena en un campo de SQL definido como char (6), cuando el 1 a 2 posición es la  hora, de 3 a 4 posición  los minutos, 5  y 6 posición para almacenar el segundo, llenar el formato interno como: HHIISS o hhiiss Ejemplo 3: Campo numérico SQL almacena una cantidad de segundos y que desea mostrar como días y / o las horas y / o minutos, llenar el formato interno como: SEC o sec Ejemplo 4: Campo numérico SQL almacena una cantidad de minutos y que desea mostrar como días y / o horas, llenar el formato interno como: MIN o min Ejemplo 5: Campo numérico SQL almacena una cantidad de horas y que desea mostrar como días, llenar el formato interno como: HOR o hor Puede utilizar otros estilos de formato, ver ejemplos: DDMMAAAA HHII MMAAAA AAAA MMDD DD HH La información utilizada para formatear el valor cuando el tipo de campo es fecha, hora o fecha/hora en el ScriptCase pero se almacena en la base de datos SQL utilizando otro tipo. Formato interno 
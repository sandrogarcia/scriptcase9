<?php
//__NM__Validaзгo do nъmero de processos na esfera do governo federal__NM__FUNCTION__NM__//
function sc_valida_proc($num_proc)
{
   if (strlen($num_proc) != 17)
   {
       return false;
   }
   $corpo_proc = substr($num_proc, 0, -2);
   $dig_proc   = substr($num_proc, -2);
   $orgao      = substr($num_proc, 0, 5);
   $ano        = substr($num_proc, 11, 4);
   
   $x    = 0;
   $y    = 16;
   $soma = 0;
   for ($x = 0 ; $x < 15 ; $x++)
   {
        $soma += substr($corpo_proc, $x , 1) * $y;
        $y--;
   }
   $resto = $soma % 11;
   $dig1  = 11 - $resto;
   if (strlen($dig1) == 2)
   {
       $dig1 = substr($dig1, 1, 1);
   }
   $parte2 = $corpo_proc . $dig1;

   $x    = 0;
   $y    = 17;
   $soma = 0;
   for ($x = 0 ; $x < 16 ; $x++)
   {
        $soma += substr($parte2, $x , 1) * $y;
        $y--;
   }
   $resto = $soma % 11;
   $dig2  = 11 - $resto;
   if (strlen($dig2) == 2)
   {
       $dig2 = substr($dig2, 1, 1);
   }
   $parte2 .= $dig2;
   if ($parte2 == $num_proc)
   {
       return true;
   }
   else
   {
       return false;
   }
}
?>
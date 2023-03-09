<?php

   $mens_conv    = "";
   if (isset($_POST['path']) && is_file($_POST['path'] . "/log/mens_conv.txt"))
   {
        $mens_conv = file_get_contents($_POST['path'] . "/log/mens_conv.txt");
   }
   echo $mens_conv;
   
?>
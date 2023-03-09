<?php
/**
 * $Id: nm_gp_gera_cep_log.php,v 1.3 2011-10-05 18:56:47 sergio Exp $
 */

$_SESSION['scriptcase']['nm_charset_cep'] = "ISO-8859-1";
if (isset($_SESSION['scriptcase']['charset']) && !empty($_SESSION['scriptcase']['charset']))
{
    $_SESSION['scriptcase']['nm_charset_cep'] = $_SESSION['scriptcase']['charset'];
}
ini_set('default_charset', $_SESSION['scriptcase']['nm_charset_cep']);
include_once("../_lib/lib/php/nm_utf8.php");
?>
<HTML>
<HEAD>
 <TITLE>CEP</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['nm_charset_cep'] ?>" />
 <STYLE TYPE="text/css">
  .nm_botao {font-family: Tahoma, Arial, sans-serif; font-size: 12px; color: #000000}
  #form-cep * {
    box-sizing: border-box;
}

#form-cep {
    padding: 10px;
    font-family: Arial, sans-serif;
}

#form-cep h1 {
    font-size: 12px;
    background: #F9FAFC;
    border: 1px solid #DFE5EC;
    padding: 5px 10px;
    margin: 0 0 10px;
}

#form-cep .control {
    display: flex;
    margin: 0 0 10px;
}

#form-cep .control label {
    width: 100px;
    padding: 0 0 0 12px;
}

#form-cep .control .field {
    flex: 1;
}

#form-cep .control .field input,
#form-cep .control .field select {
    font-size: 12px;
    font-family: Arial, sans-serif;
    border: 1px solid #8492A6;
    border-radius: 3px;
    padding: 1px 4px;
}

#form-cep .control .field input
{
  width: 240px;
}

#form-cep .control .field + a {
    position: absolute;
    opacity: 0;
    display: none;
}

#form-cep .form-header {
    text-align: left;
    margin: 10px 5px;
    padding: 10px 0 0;
}

#form-cep .form-footer {
    text-align: right;
    padding: 10px 0 0;
    border-top: 1px solid #DFE5EC;
    margin-top: 10px;
}

#form-cep .form-footer .button {
    border-radius: 4px;
    color: white;
    border: none;
    padding: 4px 10px;
    background: none;
    color: #308AC6;
    cursor: pointer;
}

#form-cep .form-footer .button + .button {
    margin-left: 5px;
}

#form-cep .form-footer .button-primary {
    background: #308AC6;
    color: white;
}

#form-cep .form-footer .button-text {
    text-decoration: underline;
}
 </STYLE>
 <SCRIPT LANGUAGE="Javascript">
 function nm_fecha_janela()
 {
  if (self.parent && self.parent.$)
  {
   self.parent.tb_remove();
  }
  else
  {
   window.close();
  }
 }
<?php
    CEP_form_loc();
?>
 </SCRIPT>
<script Language="JavaScript">
function CriticaCampos()
{
  if (document.Geral.UF.value == "")
  {
    alert("Selecione um Estado (UF) !!");
    document.Geral.UF.focus();
    return (false);
  }
  if (document.Geral.Localidade.value == "")
  {
    alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
    document.Geral.Localidade.focus();
    return (false);
  }
  else
  {
   var Branco = " ";
   var Posic, Carac;
   var Temp = document.Geral.Localidade.value.length;
   var Cont = 0;
   for (var i=0; i < Temp; i++)
   {
   Carac =  document.Geral.Localidade.value.charAt (i);
   Posic  = Branco.indexOf (Carac);
   if (Posic == -1)
      Cont++;
   }
   if (Cont <= 0)
   {
        alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
        document.Geral.Localidade.focus();
        return (false);
   }
  }
  if (document.Geral.Logradouro.value == "")
  {
    alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, praÁa, rua, travessa etc. N„o informe o n˙mero da casa/lote/apartamento.", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
    document.Geral.Logradouro.focus();
    return (false);
  }
   var Branco = " ";
   var Posic, Carac;
   var Temp = document.Geral.Logradouro.value.length;
   var Cont = 0;
   for (var i=0; i < Temp; i++)
   {
   Carac =  document.Geral.Logradouro.value.charAt (i);
   Posic  = Branco.indexOf (Carac);
   if (Posic == -1)
      Cont++;
   }
   if (Cont <= 0)
   {
        alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, praÁa, rua, travessa etc. N„o informe o n˙mero da casa/lote/apartamento.", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
        document.Geral.Logradouro.focus();
        return (false);
   }
   else
   {
       if (Cont <= 2)
       {
/*
          if (document.Geral.Opcao[2].checked)
          {
             alert('<?php echo sc_convert_encoding("Na opÁ„o COME«ANDO POR, informe no mÌnimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
             document.Geral.Logradouro.focus();
             return (false);
          }
          else
*/
             if (document.Geral.Opcao[0].checked)
             {
                alert('<?php echo sc_convert_encoding("Na opÁ„o CONTENHA, informe no mÌnimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
                document.Geral.Logradouro.focus();
                return (false);
             }
             else
                if (document.Geral.Opcao[3].checked)
                {
                   alert('<?php echo sc_convert_encoding("Na opÁ„o TERMINADO EM, informe no mÌnimo 3 caracteres !!", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
                   document.Geral.Logradouro.focus();
                   return (false);
                }
       }
  }
}
</script>
<script Language="JavaScript">
 function RetiraAcentos(Campo)
 {
/*
   var Acentos = "√°√†√£√¢√¢√Å√Ä√É√Ç√©√™√â√ä√≠√ç√≥√µ√¥√ì√î√ï√∫√º√ö√ú√ß√áabcdefghijklmnopqrstuvxwyz";
   var Traducao ="AAAAAAAAAEEEEIIOOOOOOUUUUCCABCDEFGHIJKLMNOPQRSTUVXWYZ";
   var Posic, Carac;
   var TempLog = "";
   for (var i=0; i < Campo.length; i++)
   {
   Carac = Campo.charAt (i);
   Posic  = Acentos.indexOf (Carac);
   if (Posic > -1)
      TempLog += Traducao.charAt (Posic);
   else
      TempLog += Campo.charAt (i);
   }
   return (TempLog);
*/
   return (Campo);
}
function cep_fecha_janela()
{
  if (self.parent && self.parent.$)
  {
    self.parent.tb_remove();
  }
  else
  {
    window.close();
  }
}
</script>
<script Language="JavaScript">
 function AjudaLocalidade()
 {
//   DocRemote = window.open ('http://www.correios.com.br/servicos/cep/AjudaLocalidade.cfm','Localidade','scrollbars,resizable,width=410,height=180');
     alert("Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc) !!");
     document.Geral.Localidade.focus();
 }
</script>

<script Language="JavaScript">
 function AjudaLogradouro()
 {
//   DocRemote = window.open ('http://www.correios.com.br/servicos/cep/AjudaLogradouro.cfm','Logradouro','scrollbars,resizable,width=410,height=220');
     alert('<?php echo sc_convert_encoding("Informe o nome da avenida, alameda, beco, passagem, praÁa, rua, travessa etc. N„o informe o n˙mero da casa/lote/apartamento. N„o informe o tipo (avenida, rua, etc) nem o tÌtulo ou patente (coronel, tenente, doutor, etc.)", $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1")?>');
     document.Geral.Logradouro.focus();
 }

</script>
</HEAD>
<BODY>
  <form name="Geral" method="get" onSubmit="return CriticaCampos();" id="form-cep">
  <input type=hidden name="form_origem" value="<?php echo $form_origem ?>">
  <h1>CEP</h1>

    <div class="control">
        <label>UF:</label>
        <div class="field">
            <select name="UF" class="nm_input">
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AM">AM</option>
                <option value="AP">AP</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MG">MG</option>
                <option value="MS">MS</option>
                <option value="MT">MT</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="PR">PR</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="RS">RS</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
            </select>
        </div>
    </div>

    <div class="control">
        <label>Localidade:</label>
        <div class="field">
            <input maxlength="40" name="Localidade" title="Informe o nome completo da Localidade (Cidade, Distrito, Povoado, etc)" onblur="document.Geral.Localidade.value = RetiraAcentos(document.Geral.Localidade.value)" ;=""></div></div><div class="control"><label>Tipo:</label><div class="field"><select name="Tipo" class="nm_input">
                <option value=""></option>
                <option value="Avenida">Avenida</option>
                <option value="Bloco">Bloco</option>
                <option value="Pra√ßa">Pra√ßa</option>
                <option value="Quadra">Quadra</option>
                <option value="Rua">Rua</option>
                <option value="Outros">Outros</option>
            </select>
        </div>
    </div>

    <div class="control">
        <label>Logradouro:</label>
        <div class="field">
            <input maxlength="60" name="Logradouro" title="Informe o nome da avenida, alameda, beco, passagem, pra√ßa, rua, travessa etc.
N√£o informe o n√∫mero da casa/lote/apartamento." onblur="document.Geral.Logradouro.value = RetiraAcentos(document.Geral.Logradouro.value)">
        </div>
    </div>

    <div class="control">
        <label></label>
        <div class="field">
            <select name="Opcao">
                <option selected value="Contenha" title="Pesquisar os logradouros que contenham o argumento informado.">Que contenha</option>
                <option value="Exatamente" title="Pesquisar os logradouros que sejam exatamente iguais ao argumento informado.">Exatamente</option>
                <option value="Comecando" title="Pesquisar os logradouros que comecem com o argumento fornecido.">Come√ßando</option>
                <option value="Terminando" title="Pesquisar os logradouros que terminem com o argumento fornecido.">Termiando</option>
            </select>
        </div>
    </div>

    <div class="form-footer">
        <button name="BUSCAR" type="submit" class="button button-primary">Pesquisar</button>
        <button name="fechar" type="button" class="button button-text" onclick="cep_fecha_janela()">Sair</button>
    </div>

  </form>
<script Language="JavaScript">
<?php
   if (isset($_SESSION['scriptcase']['cep_ult_estado']) && (!isset($Est) || empty($Est)))
   {
       $Est = $_SESSION['scriptcase']['cep_ult_estado'];
   }
   if (isset($_SESSION['scriptcase']['cep_ult_cidade']) && (!isset($Localidade) || empty($Localidade)))
   {
       $Localidade = $_SESSION['scriptcase']['cep_ult_cidade'];
   }

   if ($_SESSION['scriptcase']['nm_charset_cep'] != "ISO-8859-1")
   {
       $Localidade = sc_convert_encoding($Localidade, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
       $Logradouro = sc_convert_encoding($Logradouro, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
       $Tipo       = sc_convert_encoding($Tipo, $_SESSION['scriptcase']['nm_charset_cep'], "ISO-8859-1");
  }
?>
   opc_ant = "<?php echo $Opcao ?>";
   document.Geral.UF.value = "<?php echo $Est ?>";
   document.Geral.Localidade.value = "<?php echo $Localidade ?>";
   document.Geral.Tipo.value = "<?php echo $Tipo ?>";
   document.Geral.Logradouro.value = "<?php echo $Logradouro ?>";
   if (opc_ant == "Contenha")
   {
       document.Geral.Opcao[0].checked = true;
   }
   if (opc_ant == "Exatamente")
   {
       document.Geral.Opcao[1].checked = true;
   }
   if (opc_ant == "Comecando")
   {
       document.Geral.Opcao[2].checked = true;
   }
   if (opc_ant == "Terminando")
   {
       document.Geral.Opcao[3].checked = true;
   }
</script>
</BODY>
</HTML>
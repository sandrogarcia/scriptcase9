<?php
/* Definicao da classe */
class nmFileSystem
{
  /**
   * Dados do XML.
   *
   * Matriz de dados.
   *
   */
  var $dataSys;


  /* ----- Construtor ------------------------------------ */

  /**
   * Construtor da classe.
   *
   * Inicializa o elemento.
   *
   */
  function __construct()
  {
    $this->InitDataSys();
  }// End function __construct()

  /* ----- Getters & Setters ----------------------------------------- */

  /**
   * Recupera dados.
   *
   * Recupera array com os dados.
   *
   */
  function GetDataSysAll()
  {
    return $this->dataSys;
  } // GetDataSysAll

  /**
   * Recupera um elemento.
   *
   * Recupera um elemento do array de dados.
   *
   */
  function GetDataSys($v_str_field)
  {
    if (isset($this->dataSys[strtolower($v_str_field)]))
      return $this->dataSys[strtolower($v_str_field)];
  }// GetDataSys()

  /**
   * Seta um dado.
   *
   * Armazena um dado na array dataSys.
   *
   */
  function SetDataSys($v_str_field, $v_mix_val)
  {
    $this->dataSys[strtolower($v_str_field)] = $v_mix_val;
  }// End SetDataSys()



  /* ----- Metodos Privados ------------------------------------------ */

  /**
   *  Inicializa dados do array dataSys.
   *
   *  Cria array vazio para armazenar os dados.
   *
   *  @access  private
   */
  function InitDataSys()
  {
    $this->dataSys = array();
  } // InitDataSys


  /* ----- Metodos Publicos ------------------------------------------ */


  /**
   *  DelDir()  -----------------------------------------------------------  //
   *  ========
   *  Apagar um Diretorio e seus subDiretorios
   *
   *  @param     string      $nDir        Nome do Diretório
   *  @return    boolean     $success     True em caso de Sucesso
   */
  function DelDir($nDir)
  {
    $success = false;

    if (is_dir($nDir))
    {
      $handle = opendir($nDir);
      while (false !== ($FolderOrFile = readdir($handle)) )
      {
        if($FolderOrFile != "." && $FolderOrFile != "..")
        {
          if(is_dir("$nDir/$FolderOrFile"))
            $this->DelDir("$nDir/$FolderOrFile");
          else
            unlink("$nDir/$FolderOrFile");
        }// End if($FolderOrFile != "." && $FolderOrFile != "..")
      }// End while (false !== ($FolderOrFile = readdir($handle)) )
      closedir($handle);

      if(rmdir($nDir))
        $success = true;

    }// End if (is_dir($nDir))

    return $success;
  }//  End function DelDir($nDir)


  /**
   *  GetDir()  -----------------------------------------------------------  //
   *  ========
   *  Retorna a lista de Arquivos de um Diretório
   *
   *  @return      boolean      $ret      True em caso de Sucesso
   */
  function GetDir($nDir)
  {
    $arr_list = array();
    $res_dir  = @opendir($nDir);

    if ($res_dir)
    {
      while (FALSE !== ($str_file = @readdir($res_dir)))
      {
        if ( ('.'  != $str_file) &&
             ('..' != $str_file) &&
             @is_dir($nDir.$str_file)  )
        {
          if ('.svn' != $str_file)
            $arr_list[] = $str_file;
        }// End if ( ('.'  != $str_file) &&
      }// End while (FALSE !== ($str_file = @readdir($res_dir)))
    }// End if ($res_dir)

    return $arr_list;
  }// End function GetDir($nDir)



  /**
   *  GetFile()  ----------------------------------------------------------  //
   *  =========
   *  retorna os nomes dos arquivos do Diretório informado que comecem
   *  com o prefixo (mask) informado
   *
   *  @param      string     $nDir          nome do Diretório
   *  @mask       string     $mask          prefixo para o nome dos arquivos
   *  @return     array      $arr_list      array com os nomes de arquivos
   */
  function GetFile($nDir, $mask)
  {
    $arr_list = array();
    $res_dir  = @opendir($nDir);
    if ($res_dir)
    {
      while (FALSE !== ($str_file = @readdir($res_dir)))
      {
        if ( ('.'  != $str_file) &&
             ('..' != $str_file) &&
             ($mask == substr($str_file, 0, strlen($mask)) )
           )
        {
          $arr_list[] = $str_file;
        }// End if ( ('.'  != $str_file) &&
      }// End while (FALSE !== ($str_file = @readdir($res_dir)))
    }// End if ($res_dir)
    return $arr_list;
  }// End function GetDir($nDir)



  /**
   *  MakeDir()  ----------------------------------------------------------  //
   *  =========
   *  Criar um Diretório
   *
   *  @param       string       $target   nome do diretório
   *  @return      boolean      $ret      True em caso de Sucesso
   */
  function MakeDir($target)
  {
    $ret = false;
    clearstatcache();
    if (file_exists($target) && is_dir($target))
      $ret = true;
    else
    {
      if ($erro = mkdir($target,0755))
        $ret = true;
      else
        $ret = false;
    }// End if (file_exists($target) && is_dir($target))

    return $ret;
  }// End function MakeDir($target)




  /**
   *  GetFileDir()  -------------------------------------------------------  //
   *  ============
   *  Recupera os arquivos de um diretório
   *
   *  @param   String       $nDir
   *  @param   boolean      $dir
   *  @return  array        $arr_list      Array com os nomes dos arquivos
   */
  function GetFileDir($nDir, $dir = false)
  {
    $arr_list = array();
    $res_dir  = @opendir($nDir);
    if ($res_dir)
    {
      while (FALSE !== ($str_file = @readdir($res_dir)))
      {
        if (
             ('.' != $str_file)    &&
             ('..' != $str_file)   &&
             ('.svn' != $str_file)  &&
             ('.' != $str_file[0]) &&
              !@is_dir($nDir.$str_file)
           )
        {
           $arr_list[] = $str_file;
        }// End if (('.' != $str_file) && ('..' != $str_file) && ('.svn' != $str_file) &&
      }// End while (FALSE !== ($str_file = @readdir($res_dir)))
    }// End if ($res_dir)

    return $arr_list;
  }// End function GetFileDir($nDir)



  /**
   *  CopyDir()  ----------------------------------------------------------  //
   *  =========
   *  Copiar um Diretorio e seus subDiretorios para outro diretorio
   *
   *  @param     string      $nOrigem     Nome do Diretório de Origem
   *  @param     string      $nDestino    Nome do Diretório de Destino
   *  @return    integer     $nrDir       Numero de Diretórios Copiados
   */
  function CopyDir($nOrigem, $nDestino)
  {
//echo"<br>cp<br>";
    $nrDir = 0;

    if (is_dir($nOrigem))
    {
      /*
       *  Cria o Diretorio raiz
       */
      if($this->MakeDir($nDestino))
      {
//echo "mk: $nDestino <br>";
        $handle = opendir($nOrigem);
        while (false !== ($FolderOrFile = readdir($handle)) )
        {

          if($FolderOrFile != "." && $FolderOrFile != "..")
          {
            if(is_dir($nOrigem.$FolderOrFile))
            {
              $this->MakeDir($nOrigem.$FolderOrFile);
              $this->CopyDir($nOrigem.$FolderOrFile.'/', $nDestino.$FolderOrFile.'/');
              $nrDir ++;
            }else
            {
              copy($nOrigem.$FolderOrFile, $nDestino.$FolderOrFile);
//echo "copy:<br> ::::::::::$nOrigem$FolderOrFile<br> ::::::::::$nDestino$FolderOrFile<br>";
            }// end if(is_dir($nOrigem.$FolderOrFile))

          }// End if($FolderOrFile != "." && $FolderOrFile != "..")
        }// End while (false !== ($FolderOrFile = readdir($handle)) )

        closedir($handle);
      }// End

    }// End if (is_dir($nDir))
    return $nrDir;
  }//  End function DelDir($nDir)


}// End class nmFileSystem
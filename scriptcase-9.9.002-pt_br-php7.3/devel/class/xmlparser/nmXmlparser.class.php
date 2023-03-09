<?php
class nmXmlparser
{
    /**
     * Dados
     *
     * Matriz com dados estruturados
     *
     * @access  protected
     * @var     array
     */
    var $arr_xml;

    /**
     * Dados do XML.
     *
     * Matriz com dados estruturados do XML.
     *
     * @access  protected
     * @var     array
     */
    var $data;

    /**
     * Parser do XML.
     *
     * Parser do XML quando for utilizado
     *
     * @access  protected
     * @var     resource
     */
    var $parser;

    /**
     * Root do XML.
     *
     * Nome do elemento root do XML.
     *
     * @access  protected
     * @var     string
     */
    var $root;

    var $use_simplexml   = true;
    var $ignore_old      = false; //false
    var $teste_simplexml = false; //false

    var $use_lowercase = true;
    var $use_root      = '';
    var $use_array     = false;
    var $return_after_serialize= false;
    
	/**
     * Id do novo xml
     *
     * Id dos valores defaulto serialize de devel/lib/php/default_values
     *
     * @access  protected
     * @var     array
     */
	var $str_id = '';

	/**
     * Flag de alteracao.
     *
     * Define se alguma das variaveis foi alterada.
     *
     * @access  protected
     * @var     boolean
     */
    var $changed = false;

    /* ----- Getters & Setters ----------------------------------------- */

    /**
     * Recupera dados.
     *
     * Recupera array com os dados do XML.
     *
     * @access  protected
     * @return  array      $arr_result  Dados do XML.
     */
    function GetData()
    {
        return $this->data;
    } // GetData

    /**
     * Recupera root.
     *
     * Recupera nome do elemento root do XML.
     *
     * @access  protected
     * @return  string     $str_result  Elemento root.
     */
    function GetRoot()
    {
        return $this->root;
    } // GetRoot

    /**
     * Seta dados.
     *
     * Armazena array com os dados do XML.
     *
     * @access  protected
     * @param   array      $v_arr_data  Dados do XML.
     */
    function SetData($v_arr_xml, $v_str_charset="")
    {
		if($this->str_id != '')
		{
			if (is_array($v_arr_xml))
			{
				$this->data = $v_arr_xml;
			}
		}
        elseif (is_array($v_arr_xml))
        {
			if(!empty($v_str_charset))
			{
				$this->data = $this->SetDataConvertUtf8($v_arr_xml, $v_str_charset);
			}
			else
			{
				$this->data = $v_arr_xml;
			}
        }
    } // SetData

    /**
     * Seta dados.
     *
     * Armazena array com os dados do XML.
     *
     * @access  protected
     * @param   array      $v_arr_data  Dados do XML.
     */
    function SetDataConvertUtf8($v_arr, $v_str_charset)
    {
        if (is_array($v_arr))
        {
			foreach ($v_arr as $key => $val)
			{
			   $v_arr[$key] = $this->SetDataConvertUtf8($val, $v_str_charset);
			}
			return $v_arr;
        }
		else
		{
			return mb_convert_encoding($v_arr, $v_str_charset, "UTF-8");
		}
    } // SetData

    /**
     * Seta root.
     *
     * Armazena nome do elemento root do XML.
     *
     * @access  protected
     * @param   string     $v_str_root  Elemento root.
     */
    function SetRoot($v_str_root)
    {
        if ('' != $v_str_root)
        {
            $this->root = $v_str_root;
        }
    } // SetRoot

    /* ----- Metodos Protegidos ---------------------------------------- */

	/**
     * Seta alteracao.
     *
     * Seta flag de alteracao das variaveis.
     *
     * @access  protected
     */
    function Changed()
    {
        $this->changed = TRUE;
    } // Changed

    /**
     * Verifica se houve alteracao.
     *
     * Verifica se houve alteracao em alguma das variaveis.
     *
     * @access  public
     * @return  boolean  $bol_result  Flag de alteracao.
     */
    function HasChanged()
    {
        return $this->changed;
    } // HasChanged

    /**
     * Inicializa alteracao.
     *
     * Inicializa flag de alteracao das variaveis.
     *
     * @access  public
     */
    function InitChanged()
    {
        $this->changed = FALSE;
    } // InitChanged

    /**
     * Inicializa XML.
     *
     * Inicializa string XML devolvendo matriz com dados a serem normalizados.
     *
     * @access  protected
     * @param   string     $v_str_xml  String com XML original.
     * @return  array      $obj_xml    Matriz com dados estruturados.
     */
    function Init($v_str_xml)
    {
        $obj_ezxml = eZXML::domTree($v_str_xml);

        if (null == $obj_ezxml->children)
        {
            return array();
        }
        $int_node = 0;
        for ($i = 0; $i < sizeof($obj_ezxml->children); $i++)
        {
            $obj_temp = $obj_ezxml->children[$i];
            if (strtoupper($this->GetRoot()) == strtoupper($obj_temp->name))
            {
                $int_node = $i;
            }
        }
        $obj_xml = $this->Prepare($obj_ezxml->children[$int_node]);

        return $obj_xml;
    } // Init

    /**
     * Normaliza estrutura de dados.
     *
     * Normaliza estrutura retornada pelo EZXML para uso no sistema. M�todo
     * abstrato.
     *
     * @abstract
     */
    function Normalize($v_arr_ezxml)
    {
		if($this->str_id != '')
		{
            return $this->HandleExceptions(sc_unserialize($this->str_id, "", $v_arr_ezxml, $this->GetUseArray(), $this->GetReturnAfterSerialize()), $this->GetData());
		}
    } // Normalize

    /**
     * Normaliza estrutura de dados.
     *
     * Normaliza estrutura retornada pelo EZXML para uso no sistema. M�todo
     * abstrato.
     *
     * @abstract
     */
    function NormalizeExpat($v_arr_ezxml)
    {
		return $this->Normalize($v_arr_ezxml);
    } // Normalize

    function HandleExceptions($v_arr_unserialize, $v_arr_default = array())
    {
        return $v_arr_unserialize;
    } // HandleExceptions

    /**
     * Prepara um objeto XML.
     *
     * Prepara um objeto XML retornando uma matriz com os dados do XML.
     *
     * @access  protected
     * @param   object     $v_obj_xml  Objeto XML.
     * @return  array      $arr_xml    Matriz com os dados XML.
     */
    function Prepare($v_obj_xml)
    {
        // Testa se objeto e um no
        if (1 == $v_obj_xml->type)
        {
            // Testa se objeto tem um nome
            if (isset($v_obj_xml->name))
            {
                $arr_xml                       = array();
                $str_name                      = $v_obj_xml->name;
                $obj_child                     = $v_obj_xml->children;
                $temp                          = $obj_child[0];
                $arr_xml[$str_name]['content'] = $temp->content;
            }
        }
        // Testa se objeto tem atributos
        if (isset($v_obj_xml->attributes))
        {
            $arr_xml[$str_name]['attributes'] = array();
            foreach ($v_obj_xml->attributes as $obj_attr)
            {
                $arr_xml[$str_name]['attributes'][$obj_attr->name] = $obj_attr->content;
            }
        }
        // Testa se objeto tem filhos
        if (isset($v_obj_xml->children))
        {
            foreach ($v_obj_xml->children as $obj_child)
            {
                $obj_xml_child = $this->Prepare($obj_child);
                if ($obj_xml_child && isset($arr_xml))
                {
                    $arr_xml[$str_name]['children'][] = $obj_xml_child;
                }
            }
        }
        // Retorna dados do objeto
        if (isset($arr_xml))
        {
            return $arr_xml;
        }
        else
        {
            return FALSE;
        }
    } // Prepare

    /**
     * Seta o valor de uma tag.
     *
     * Verifica se o caminho da tag leva a uma folha. Caso sim, seta o valor.
     * Caso nao, segue um nivel acima no caminho.
     *
     * @access  protected
     * @param   array      $v_arr_xml  Array com o XML.
     * @param   string     $v_str_tag  Caminho da tag.
     * @param   mixed      $v_mix_val  Valor da tag.
     */
    function SetTagRecur(&$v_arr_xml, $v_str_tag, $v_mix_val)
    {
        if (FALSE === strpos($v_str_tag, '/'))
        {
            $v_arr_xml[$v_str_tag] = $v_mix_val;
        }
        else
        {
            $str_tag  = substr($v_str_tag, 0, strpos($v_str_tag, '/'));
            $str_rest = substr($v_str_tag, strpos($v_str_tag, '/') + 1);
            $this->SetTagRecur($v_arr_xml[$str_tag], $str_rest, $v_mix_val);
        }
    } // SetTagRecur

    function UnsetTagRecur(&$v_arr_xml, $v_str_tag)
    {
        if (FALSE === strpos($v_str_tag, '/'))
        {
            unset($v_arr_xml[$v_str_tag]);
        }
        else
        {
            $str_tag  = substr($v_str_tag, 0, strpos($v_str_tag, '/'));
            $str_rest = substr($v_str_tag, strpos($v_str_tag, '/') + 1);
            $this->UnsetTagRecur($v_arr_xml[$str_tag], $str_rest);
        }
    } // UnsetTagRecur

    /* ----- Metodos Publicos ------------------------------------------ */

    /**
     * Cria string XML.
     *
     * Cria string XML a partir dos dados atuais. M�todo abstrato.
     *
     * @abstract
     */
    function Create()
    {
        if($this->GetUseArray())
        {
            return $this->GetData();
        }
		if($this->str_id != '')
		{
			return serialize($this->GetData());
		}
    } // Create

    /**
     * Recupera o valor de uma tag.
     *
     * Procura dentro do XML por uma tag e retorna o seu valor caso seja
     * encontrada. Caso nao exista a tag, retorna FALSE.
     *
     * @access  public
     * @param   string  $v_str_tag   Caminho completo da tag.
     * @return  mixed   $mix_result  Valor da tag caso exista, senao FALSE.
     */
    function GetTag($v_str_tag)
    {
        $arr_xml    = $this->GetData();
        $str_tag    = $this->GetXmlString($v_str_tag);
        $bol_status = TRUE;

        while (FALSE != strpos($str_tag, '/') && $bol_status)
        {
            $str_base = substr($str_tag, 0, strpos($str_tag, '/'));
            $str_tag  = substr($str_tag, strpos($str_tag, '/') + 1);
            if (isset($arr_xml[$str_base]))
            {
                $arr_xml = $arr_xml[$str_base];
            }
            else
            {
                $bol_status = FALSE;
            }
        }
        if (isset($arr_xml[$str_tag]))
        {
            return $arr_xml[$str_tag];
        }
        else
        {
            return FALSE;
        }
    } // GetTag

    /**
     * Cria matriz de dados do XML.
     *
     * A partir de uma string, cria uma matriz com os dados XML estruturados.
     *
     * @access  public
     * @param   string  $v_str_xml   String original do XML.
     * @return  array   $arr_result  Matriz com os dados estruturados.
     */
    function Handle($v_str_xml, $v_str_charset = "")
    {
		//novo xml
		if($this->str_id != '')
		{
			$this->SetData($this->Normalize($v_str_xml));
		}else
		{
			if(substr($v_str_xml, 0, 5) != '<?xml' && strpos($v_str_xml, "<?xml") !== false)
			{
				$v_str_xml = trim(substr($v_str_xml, strpos($v_str_xml, "<?xml")));
			}

			$tmp_pos = strpos($v_str_xml, "?>");
			if ($tmp_pos !== false)
			{
				$parte1 = substr($v_str_xml, 0, $tmp_pos);
				$parte2 = substr($v_str_xml, $tmp_pos);

				while(strpos($parte1, "\\\"") !== false)
				{
						$parte1 = str_replace("\\\"", "\"", $parte1);
				}

				$v_str_xml = $parte1 . $parte2;
			}

			if ($this->use_simplexml && method_exists($this, 'NormalizeSimpleXML'))
			{
				if ($this->teste_simplexml)
				{
					$a_norm = $this->Normalize($this->Init($v_str_xml));
					$a_simp = $this->NormalizeSimpleXML($v_str_xml);
					$this->comparaArrays($a_norm, $a_simp, $v_str_xml);
					$this->SetData($this->Normalize($this->Init($v_str_xml)));
					return;
				}
				$this->SetData($this->NormalizeSimpleXML($v_str_xml), $v_str_charset);
			}
			elseif ($this->use_simplexml && $this->ignore_old)
			{
				echo '<hr>ainda implementado como Handle: ' . get_class($this);
				exit;
			}
			else
			{
				$this->SetData($this->Normalize($this->Init($v_str_xml)));
			}
		}
    } // Handle

    function GetXmlString($s)
    {
      return $this->use_lowercase ? strtolower($s) : $s;
    } // GetXmlString

    function SetCase($o)
    {
      $this->use_lowercase = 'original' != $o;
    } // SetCase

    function SetUseRoot($r)
    {
      $this->use_root = $r;
    } // SetUseRoot

    function comparaArrays($a1, $a2, $xml)
    {
      $bIgual = true;
      $tab_is_open = false;

      foreach ($a1 as $k => $v)
      {
        if (!isset($a2[$k]))
        {
          $bIgual = false;
          $this->imprimeValores($k, $v, '', $tab_is_open);
        }
        elseif ($this->valoresDiferentes($v, $a2[$k]))
        {
          $bIgual = false;
          $this->imprimeValores($k, $v, $a2[$k], $tab_is_open);
          unset($a2[$k]);
        }
        else
        {
          unset($a2[$k]);
        }
      }
      foreach ($a2 as $k => $v)
      {
        $bIgual = false;
        $this->imprimeValores($k, '', $v, $tab_is_open);
      }
      if ($bIgual)
      {
        //echo '<tr><td>tudo igual</td></tr>';
      }

      if (!$bIgual)
      {
        echo '</table>';
        echo '<pre>' . htmlentities($xml) . '</pre>';
        exit;
      }
    } // comparaArrays

    function imprimeValores($k, $v1, $v2, &$tab_is_open)
    {
      if (!$tab_is_open)
      {
        echo '<hr>' . get_class($this) . '<br><table style="border-width: 1px; border-style: solid">';
        $tab_is_open = true;
      }

      echo '<tr><td style="border-width: 1px; border-style: solid">' . $k . '</td><td style="border-width: 1px; border-style: solid"><pre>';
      var_export($v1);
      echo '</pre></td><td style="border-width: 1px; border-style: solid"><pre>';
      var_export($v2);
      echo '</pre></td></tr>';
    } // imprimeValores

    function valoresDiferentes($v1, $v2)
    {
      //echo '<hr>';print_r($v1);echo '<br>';print_r($v2);echo '<br>';
      if (!is_array($v1) && !is_array($v2))
      {
        //echo 'atomicidade<br>';var_export($v1);echo'<br>';var_export($v2);echo '<br>';var_dump($v1 != $v2).'<br>';
        $v1 = str_replace("\r\n", "\n", $v1);
        $v2 = str_replace("\r\n", "\n", $v2);

        if (function_exists('conv_utf8_all'))
        {
            return conv_utf8_all($v1) != conv_utf8_all($v2);
        }
        else
        {
            return $v1 != $v2;
        }
      }
      elseif (is_array($v1) && !is_array($v2))
      {
        return true;
      }
      elseif (!is_array($v1) && is_array($v2))
      {
        return true;
      }
      else
      {
        $bIgual = true;
        foreach ($v1 as $k => $v)
        {
          if (!isset($v2[$k]))
          {//echo "<h1>111 - $k</h1>";  var_dump($v1);
            $bIgual = false;
          }
          elseif ($this->valoresDiferentes($v, $v2[$k]))
          {
            $bIgual = false;
            unset($v2[$k]);
          }
          else
          {
            unset($v2[$k]);
          }
        }
        if (!empty($v2))
        {
          $bIgual = false;
        }

        return !$bIgual;
      }
    } // valoresDiferentes

    /**
     * Trata XML para string.
     *
     * Trata string com caracteres especiais para ser inserida no XML.
     *
     * @access  public
     * @param   string  $v_str_dado  String a ser inserida no XML.
     * @return  string  $str_dado    String tratada.
     */
    function HandleChars($v_str_data)
    {
        global $nm_config;
        $str_data = str_replace(array_keys($nm_config['chars_bkp_dat']), array_values($nm_config['chars_bkp_dat']), $v_str_data);

        $str_data = str_replace('&', $nm_config['chars_xml']['&'], $str_data);
        $str_data = str_replace('<', $nm_config['chars_xml']['<'], $str_data);
        $str_data = str_replace('>', $nm_config['chars_xml']['>'], $str_data);
        $str_data = str_replace('"', $nm_config['chars_xml']['"'], $str_data);
        $str_data = str_replace("'", $nm_config['chars_xml']["'"], $str_data);

        return $str_data;

    } // HandleChars

    /**
     * Trata XML para string.
     *
     * Trata string com caracteres especiais para ser inserida no XML.
     *
     * @access  public
     * @param   string  $v_str_dado  String a ser inserida no XML.
     * @return  string  $str_dado    String tratada.
     */
    function HandleCharsBack($v_str_data)
    {
        global $nm_config;

        if(isset($nm_config['chars_bkp_dat']) && is_array($nm_config['chars_bkp_dat']) && isset($nm_config['chars_xml']) && is_array($nm_config['chars_xml']))
        {
			$str_data = str_replace(array_keys($nm_config['chars_bkp_dat']), array_values($nm_config['chars_bkp_dat']), $v_str_data);
			return str_replace(array_values($nm_config['chars_xml']), array_keys($nm_config['chars_xml']), $str_data);
        }else
        {
			return $v_str_data;
        }
    } // HandleCharsBack

    /**
     * Trata string para XML.
     *
     * Trata string com caracteres especiais para ser inserida no XML.
     *
     * @access  public
     * @param   string  $v_str_dado  String a ser inserida no XML.
     * @return  string  $str_dado    String tratada.
     */
    function HandleCharsXml($v_str_data)
    {
        $str_data = str_replace('&lt;'    , '<', $v_str_data);
        $str_data = str_replace('&gt;'    , '>', $str_data);
        $str_data = str_replace('&quot;'  , '"', $str_data);
        $str_data = str_replace('&apos;'  , "'", $str_data);
        $str_data = str_replace('&amp;'   , '&', $str_data);
        return $str_data;
    } // HandleChars

    /**
     * Define o valor de uma tag.
     *
     * Define o valor de uma tag do XML caso existe, caso constrario a tag e
     * criada.
     *
     * @access  public
     * @param   string  $v_str_tag  Caminho completo da tag.
     * @param   mixed   $v_mix_val  Valor da tag.
     */
    function SetTag($v_str_tag, $v_mix_val)
    {
        $arr_data = $this->GetData();
        $this->SetTagRecur($arr_data, $this->GetXmlString($v_str_tag), $v_mix_val);
        $this->SetData($arr_data);
    } // SetTag

    /**
     * Exclui uma tag.
     *
     * Apaga tag dos dados, para forçar utilização do valor default.
     *
     * @access  public
     * @param   string  $v_str_tag  Caminho completo da tag.
     */
    function UnsetTag($v_str_tag)
    {
        $arr_data = $this->GetData();
        $this->UnsetTagRecur($arr_data, $this->GetXmlString($v_str_tag));
        $this->SetData($arr_data);
    } // UnsetTag

	function StartDefault()
	{
		$this->SetData($this->Normalize(""));
	}
    
    /**
     * Recupera o modulo do complemento.
     *
     * Retorna o modulo do complemento a ser usado.
     *
     * @access  protected
     * @return  string     $str_result  Modulo do complemento.
     */
    function GetUseArray()
    {
        return $this->use_array;
    } // GetUseArray

    /**
     * Seta o modulo do complemento.
     *
     * Armazena o modulo do complemento a ser usado.
     *
     * @access  protected
     * @param   string     $v_str_mod  Modulo do complemento.
     */
    function SetUseArray($b_use_array)
    {
        $this->use_array = $b_use_array;
    } // SetUseArray
    
    /**
     * Recupera o modulo do complemento.
     *
     * Retorna o modulo do complemento a ser usado.
     *
     * @access  protected
     * @return  string     $str_result  Modulo do complemento.
     */
    function GetReturnAfterSerialize()
    {
        return $this->return_after_serialize;
    } // GetReturnAfterSerialize

    /**
     * Seta o modulo do complemento.
     *
     * Armazena o modulo do complemento a ser usado.
     *
     * @access  protected
     * @param   string     $v_str_mod  Modulo do complemento.
     */
    function SetReturnAfterSerialize($b_return_after_serialize)
    {
        $this->return_after_serialize = $b_return_after_serialize;
    } // SetReturnAfterSerialize
}

?>
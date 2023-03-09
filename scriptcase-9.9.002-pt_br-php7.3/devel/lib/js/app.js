
function nm_pdf_type(obj)
{
	      if (obj.value == 2)
	      {
              __nm_toggle_field('Cabecalho_Grid_Mostra');
              __nm_toggle_field('rod_grid_usa');
	      	  __nm_toggle_field('pdf_height_line');
	      	  __nm_toggle_field('pdf_header_height');
	      	  __nm_toggle_field('pdf_footer_height');
			  __nm_toggle_field('pdf_height_ini');
			  __nm_toggle_field('pdf_qtd_page');
			  __nm_toggle_field('pdf_cab');
			  __nm_toggle_field('pdf_rod');
			  __nm_toggle_field('pdf_qtd_col', true);
			  __nm_toggle_field('pdf_dist_col', true);
			  __nm_toggle_field('pdf_alt_col', true);
			  __nm_toggle_field('pdf_height_line_c');
			  __nm_toggle_field('pdf_height_ini_c');
			  __nm_toggle_field('pdf_qtd_page_c', true);
			  __nm_toggle_field('pdf_cab_c');
			  __nm_toggle_field('pdf_rod_c');
			  __nm_toggle_field('pdf_qtd_col_c', true);
			  __nm_toggle_field('pdf_dist_col_c', true);
			  __nm_toggle_field('pdf_alt_col_c', true);
	          $('input[name=pdf_qtd_page]').val( $('input[name=pdf_qtd_page_aux]').val() );
	      }
	      else
	      {
			  __nm_toggle_field('Cabecalho_Grid_Mostra', true);
			  __nm_toggle_field('rod_grid_usa', true);
			  __nm_toggle_field('pdf_height_line', true);
			  __nm_toggle_field('pdf_height_ini',true);
			  if($('input[name=rod_grid_usa]').val() == 'S')
              {
                  __nm_toggle_field('pdf_footer_height', true);
              }
			  if($('input[name=Cabecalho_Grid_Mostra]').val() == 'S')
              {
                  __nm_toggle_field('pdf_header_height', true);
              }

			  __nm_toggle_field('pdf_qtd_page');
			  __nm_toggle_field('pdf_cab',true);
			  __nm_toggle_field('pdf_rod',true);
			  __nm_toggle_field('pdf_qtd_col');
			  __nm_toggle_field('pdf_dist_col');
			  __nm_toggle_field('pdf_alt_col');
			  __nm_toggle_field('pdf_height_line_c',true);
			  __nm_toggle_field('pdf_height_ini_c',true);
			  __nm_toggle_field('pdf_qtd_page_c');
			  __nm_toggle_field('pdf_cab_c');
			  __nm_toggle_field('pdf_rod_c');
			  __nm_toggle_field('pdf_qtd_col_c');
			  __nm_toggle_field('pdf_dist_col_c');
			  __nm_toggle_field('pdf_alt_col_c');
			  $('input[name=pdf_qtd_page]').val( 1 );
	      }
}


function nm_change_desc_pdf_dest_doc(val, tooltipster)
{ 
  if (val == 'D')
  { 
    d = nm_get_text_lang("['pdf_dest_doc_desc_D']");
  } 
  else if (val == 'F')
  { 
    d = nm_get_text_lang("['pdf_dest_doc_desc_F']");
  } 
  else
  { 
    d = nm_get_text_lang("['pdf_dest_doc_desc_I']");
  }

    if(tooltipster == true) {
        if($('#id_desc_pdf_dest_path').hasClass('tooltipstered')) {
            $('#id_desc_pdf_dest_doc').tooltipster('update', d);
        }
        else {
            $('#id_desc_pdf_dest_doc').tooltipster({
                theme: 'tooltipster-borderless',
                position: 'bottom-right',
                content: d
            });
        }
    }
    else
    {
        $('#id_desc_pdf_dest_doc').html(d);
    }

}

function nm_change_desc_pdf_margens(val) 
{ 
  desc_top = $('#id_desc_pdf_marge_top');
  desc_bot = $('#id_desc_pdf_marge_bot');
  desc_right = $('#id_desc_pdf_marge_right');
  desc_left = $('#id_desc_pdf_marge_left');
  if (val == 'pt')
  { 
    d = nm_get_text_lang("['pdf_unid_med_pt']");
  } 
  else if (val == 'mm')
  { 
    d = nm_get_text_lang("['pdf_unid_med_mm']");
  } 
  else if (val == 'cm')
  { 
    d = nm_get_text_lang("['pdf_unid_med_cm']");
  } 
  else
  { 
    d =  nm_get_text_lang("['pdf_unid_med_in']");
  }
  d += '.';
  desc_top.innerHTML =  nm_get_text_lang("['app_fld']['pdf_marge_top']['desc']") +d;
  desc_bot.innerHTML =  nm_get_text_lang("['app_fld']['pdf_marge_bot']['desc']") +d;
  desc_right.innerHTML = nm_get_text_lang("['app_fld']['pdf_marge_right']['desc']") +d;
  desc_left.innerHTML  = nm_get_text_lang("['app_fld']['pdf_marge_left']['desc']") +d;
}

function nm_disable_ckeck_field(target, state, defineValue)
{

    var input       = $('[name="' + target + '"]');
    var input_value = $('[name="' + target + '"][value="' + defineValue + '"]');
    var el = $('#id_tr_' + target + ' .icheck');


    if(el.length > 0)
    {
        if (state === undefined) {
            state = !el.prop('disabled');
        }
        if (defineValue !== undefined && input[0]) {
            if (input.val() !== defineValue) {
                nmiCheckToggle(el);
            }
        }

        // input.prop('disabled', state);
        if (state) {
            el.addClass('disabled');
        } else {
            el.removeClass('disabled');
        }
    }
    else {
        input_value.prop("checked", true);
    }
}


function nm_exib_height_width_pdf_formato(val)
{
    if(val == 15) {
        __nm_toggle_field('pdf_formato_width', true);
        __nm_toggle_field('pdf_formato_height', true);
        return;
    }
    __nm_toggle_field('pdf_formato_width');
    __nm_toggle_field('pdf_formato_height');
}

function nm_pdf_dest_doc(obj, tooltipster)
  {
      if (obj.value == 'I')
      {
		  __nm_toggle_field('pdf_dest_path');
      }
      else
      {
		  __nm_toggle_field('pdf_dest_path',true);
      }

      if (obj.value == 'D')
      {
          $('input[name=pdf_dest_path]').attr('size', 20);
		  $('#id_title_pdf_dest_path').html(nm_get_text_lang("['pdf_dest_path_title_D']") );
          if(tooltipster == true) {

              if($('#id_desc_pdf_dest_path').hasClass('tooltipstered')) {
                  $('#id_desc_pdf_dest_path').tooltipster('update', nm_get_text_lang("['pdf_dest_path_desc_D']"));
              }
              else {
                  $('#id_desc_pdf_dest_path').tooltipster({
                      theme: 'tooltipster-borderless',
                      position: 'bottom-right',
                      content: nm_get_text_lang("['pdf_dest_path_desc_D']")
                  });
              }

          }
          else
          {
              $('#id_desc_pdf_dest_path').html( nm_get_text_lang("['pdf_dest_path_desc_D']"));
          }
		  $('input[name=pdf_dest_path]').val( $('input[name=pdf_dest_path_hid_D]').val());
      }
      else if (obj.value == 'F')
      {
		  $('input[name=pdf_dest_path]').attr('size', 20);
		  $('#id_title_pdf_dest_path').html(nm_get_text_lang("['pdf_dest_path_title_F']") );

          if(tooltipster == true) {
              if($('#id_desc_pdf_dest_path').hasClass('tooltipstered')) {
                  $('#id_desc_pdf_dest_path').tooltipster('update', nm_get_text_lang("['pdf_dest_path_desc_F']"));
              }
              else {
                  $('#id_desc_pdf_dest_path').tooltipster({
                      theme: 'tooltipster-borderless',
                      position: 'bottom-right',
                      content: nm_get_text_lang("['pdf_dest_path_desc_F']")
                  });
              }
          }
          else
          {
              $('#id_desc_pdf_dest_path').html( nm_get_text_lang("['pdf_dest_path_desc_F']"));
          }

		  $('input[name=pdf_dest_path]').val( $('input[name=pdf_dest_path_hid_F]').val());
      }
  }

function nm_pdf_qtd_page(obj)
{
       $('input[name=pdf_qtd_page_aux]').val(obj.value);
}

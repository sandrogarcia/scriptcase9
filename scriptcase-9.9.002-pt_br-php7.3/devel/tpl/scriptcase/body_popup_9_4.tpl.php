<?php

/* Protecao contra hacks */
if (!defined('SC_LOCKED_VERSION_8976') || ('CARREGADO4536' != SC_LOCKED_VERSION_8976))
{
	die('<br /><span style="font-weight: bold">Fatal error</span>: ' .
		'invalid access to system file.');
}

?>
<div id="sc-ui-popup-9-4" class="ui modal" style="text-align: center;">
	<i class="close icon"></i>
	<div class="header"
		style="border: none;background: linear-gradient(135deg, #8f75da 0, #727cf5 60%);color:white">
		<?php echo nm_get_text_lang("['popup_9_4_apresentando']"); ?>
	</div>
	<div class="ui secondary pointing menu" style="justify-content: center;">
		<a class="item active" id='0'>
			<?php echo nm_get_text_lang("['popup_9_4_novos_temas']"); ?>
		</a>
		<a class="item" id='1'>
			<?php echo nm_get_text_lang("['popup_9_4_novos_botoes']"); ?>
		</a>
		<a class="item" id='2'>
			Font Awesome
		</a>
		<a class="item" id='3'>
			Google Fonts
		</a>
		<a class="item" id='4'>
			Sweet Alert 2
		</a>
		<a class="item" id='5'>
			Toast
		</a>
		<a class="item" id='6'>
			<?php echo nm_get_text_lang("['popup_9_4_export_excel']"); ?>
		</a>
	</div>
	<div class="image content" style="height: 60vh; overflow:hidden">
		<div class="description" style="width: 100%">
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_temas_modernos']"); ?></h2>
				<div class="ui image">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-new-themes.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_botoes_configuraveis']"); ?></h2>
				<div class="ui image">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-new-buttons.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_icones_fontawesome']"); ?></h2>
				<div class="ui small">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-font-awesome.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_fontes_google']"); ?></h2>
				<div class="ui small">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-google-fonts.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_alerta_amigavel']"); ?></h2>
				<div class="ui small">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-sweetalert.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_notificacao_amigavel']"); ?></h2>
				<div class="ui small">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-toast.jpg" alt="">
				</div>
			</div>
			<div class="content-item">
				<h2><?php echo nm_get_text_lang("['popup_9_4_exportacoes_completas']"); ?></h2>
				<div class="ui image">
					<img class="fluid" src="<?php echo $this->GetVar('popup_9_4_img_path'); ?>popup94-export-excel.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
	<div class="actions" style="text-align:center;border:none;">
		<div id="sc-ui-popup-9-4-button" class="ui button approve primary"
			style="background: linear-gradient(135deg, #8f75da 0, #727cf5 60%);padding: 15px 20px;"><?php echo $this->GetVar('popup_9_4_button_label'); ?></div>
	</div>
</div>

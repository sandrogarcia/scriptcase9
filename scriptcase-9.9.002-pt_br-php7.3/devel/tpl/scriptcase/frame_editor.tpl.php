<?php
$url_img = $this->GetVar('url_img');
$url_iface = $this->GetVar('url_iface');
$url_scriptcase_img = $this->GetVar('url_scriptcase_img');
$path_iface = $this->GetVar('path_iface');
$url_js_thirddevel = $this->GetVar('url_js_thirddevel');
?><body style="margin:0;" class="bg-snow ui-layout" scroll="no">
	<table style='width:100%; height:100%' cellpadding="0" cellspacing="0">
		<tbody>
			<tr>
				<td class="ui-layout-center-west nmOpenRightSide" onclick="nm_toggle_left_layout();" style="padding:0;">
					<div class="layout-item" style="width:16px;border-top:none!important;border-bottom:none!important;">
						<i class="nmMiniIcon arrow-left"></i>
					</div>
				</td>

				<td class="ui-layout-west">
					<div class="layout-item">
					  <iframe id="id_ifr_left_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" name="nmFrmLeft_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" frameborder="0" style="border-style: none; border-width: 0px; height: 100%; width:100%;" src="<?php echo nm_url_rand($url_iface . 'menu.php'); ?>">
					  </iframe>

					   <div id="id_priv_error" style="display:none;">
							<p>
								<?php
									$dt_upd = format_data_by_lang($_SESSION['nm_session']['nm_sc_data_update']);

									echo nm_get_text_lang("['sc_upd_lbl_msg_1']") . " " . $dt_upd . "<br><br>" .
										 nm_get_text_lang("['sc_upd_lbl_msg_2']") . "<br><br>" .
										 nm_get_text_lang("['sc_upd_lbl_msg_3']") ;
								?>
							</p>
					   </div>

					   <div id="id_conn_not_exist" style="display:none;">
							<p>
								<center>
									<?php echo nm_get_text_lang("['msg_conn_not_exist']"); ?>
								</center>
							</p>
					   </div>

						<DIV id="id_cmp_info" style="display:none;position:absolute;background-color: white;padding: 2px;">
							<table cellpadding="0" cellspacing="0" border="0" class="nmTable">
							  <tr class="nmTitle">
							<td colspan="2" class="nmTextTitle">
							  &nbsp;&nbsp;
							  <span id="id_cmp_info_seq" style="display:none"></span>
							  <span id="id_cmp_info_campo"></span>
							</td>
							<td style="text-align:right" class="nmTextTitle">
							  <a href="javascript:HideContent('id_cmp_info');"><img src='<?php echo $url_img; ?>menu_top_logout.gif' style='vertical-align: middle' border='0'></a>
							</td>
							  </tr>
							  <tr>
							  <td class="nmPageTitle" style="text-align: right; vertical-align: middle;"><?php echo nm_get_text_lang("['cmp_info_atri']"); ?></td>
							  <td class="nmPageTitle" style="text-align: left; vertical-align: middle;"><img src="<?php echo $url_img;?>sep_titulos_acoes.gif" width="26" height="9"></td>
							  <td class="nmPageTitle" style="text-align: left; vertical-align: middle;"><?php echo nm_get_text_lang("['cmp_info_val']"); ?></td>
							  </tr>
							  <tr class="nmTableLine" >
							<td height="1" colspan="3"><img src="<?php echo $url_img; ?>nm_transparent.gif" width="1" height="1"></td>
							  </tr>
							  <tr class="nmLineV3">
							<td style="text-align:right;">
							  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo nm_get_text_lang("['id_cmp_info_label']"); ?>
							</td>
							<td class="nmLineV3" style="text-align: right; vertical-align: top;">&nbsp;</td>
							<td>
							  <span id="id_cmp_info_label"></span>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							  </tr>
							  <tr class="nmTableLine" >
							<td height="1" colspan="3"><img src="<?php echo $url_img; ?>nm_transparent.gif" width="1" height="1"></td>
							  </tr>
							  <tr class="nmLineV3">
							<td style="text-align:right;">
							  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo nm_get_text_lang("['id_cmp_info_tipo_sc']"); ?>
							</td>
							<td class="nmLineV3" style="text-align: right; vertical-align: top;">&nbsp;</td>
							<td>
							  <span id="id_cmp_info_tipo_sc"></span>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							  </tr>
							  <tr class="nmTableLine" >
							<td height="1" colspan="3"><img src="<?php echo $url_img; ?>nm_transparent.gif" width="1" height="1"></td>
							  </tr>
							  <tr class="nmLineV3">
							<td style="text-align:right;">
							  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo nm_get_text_lang("['id_cmp_info_tipo_sql']"); ?>
							</td>
							<td class="nmLineV3" style="text-align: right; vertical-align: top;">&nbsp;</td>
							<td>
							  <span id="id_cmp_info_tipo_sql"></span>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							  </tr>
							  <tr class="nmTableLine" >
							<td height="1" colspan="3"><img src="<?php echo $url_img; ?>nm_transparent.gif" width="1" height="1"></td>
							  </tr>
							  <tr class="nmLineV3">
							<td style="text-align:right;">
							  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo nm_get_text_lang("['id_cmp_info_tipo_html']"); ?>
							</td>
							<td class="nmLineV3" style="text-align: right; vertical-align: top;">&nbsp;</td>
							<td>
							  <span id="id_cmp_info_tipo_html"></span>&nbsp;&nbsp;&nbsp;&nbsp;
							</td>
							  </tr>
							  <tr class="nmTableLine" id='tr_id_cmp_info_categ_lin'>
							<td height="1" colspan="3"><img src="<?php echo $url_img; ?>nm_transparent.gif" width="1" height="1"></td>
							  </tr>
							  <tr class="nmLineV3" id='tr_id_cmp_info_categ'>
							<td style="text-align:center;" colspan="3">
							  <span style="display:none">
								 <a href="javascript: nm_del_fld('<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>')" class="nmText" title="<?php echo nm_get_text_lang("['delete_tooltip']"); ?>"><img src="<?php echo $url_scriptcase_img; ?>img_delete.gif" style="border-width: 0px; vertical-align: middle" /></a>
							  </span>
							</td>
							  </tr>
							</table>

							<span style="display:none">
								<form name="form_del_field" target="nmFrmDelFld" action="<?php echo nm_url_rand($url_iface . 'del_field.php'); ?>" method="post">
									<input type="hidden" name="hid_seq" value="" />
									<input type="hidden" name="hid_campo" value="" />
								</form>

								<iframe name="nmFrmDelFld">
								</iframe>
							</span>
						</DIV>

						<div id="span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" style="position:absolute; top:200px; width:330px; border:2px solid #9EBFD8; background:#BED9F1; layer-background-color:#eeeeee; overflow:hidden; visibility:hidden">
							<table width="100%">
								<tr>
									<td align="left" width="90%" class="nmText" style="color: #4B7EBC;"><b><?php echo nm_get_text_lang("['msg_alert_auto_save_tit']"); ?></b></td>
									<td align="right"  width="10%" valign="top"><a href="javascript:close_popup();"><img src="<?php echo $url_img; ?>img_popup_close.gif" border="0"></a></td>
								</tr>
							</table>
							<center>
							<table width="325px" cellpadding="0" cellspacing="0" bgcolor="white">
								 <tr>
								  <td class="nmToolbarBg2" style="border-style: ridge; border-width: 0px 0px 2px 0px; height: 35px; padding: 2px 0px 0px 4px"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr>
								   <td style="text-align: left; vertical-align: middle"><img src="<?php echo $url_scriptcase_img; ?>img_scriptcase_small.gif" style="border-width: 0px; vertical-align: middle"></td>
								   <td style="padding: 0px 4px 0px 0px; text-align: right; vertical-align: middle"><span class="nmText" style="font-size: 17px"><?php echo ""; ?></span></td>
								  </tr></table></td>
								 </tr>
								 <tr>
									<td  colspan="3" class="nmText" height="50px">
										<span class="nmText" style="margin-left:10px; margin-top:10px">
											<center>
												<table width="95%">
													<tr>
														<td width="10%" valign="middle"><img src='<?php echo $url_img ?>ajax_load1.gif' /></td>
														<td width="90%" valign="middle" class="nmText"><?php echo nm_get_text_lang("['msg_alert_auto_save']"); ?></td>
													</tr>
												</table>
											</center>
										</span>
									</td>
								 </tr>
							</table>
							</center>
						</div>
					</div> <!-- /layout-item -->
				</td>

				<td class="ui-layout-center">
					<div class="layout-item">
						<iframe id="id_ifr_right_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" name="nmFrmRight_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>" frameborder="0" style="border-style: none; border-width: 0px; height: 100%; width:100%;" src="<?php echo nm_url_rand($this->GetVar('frame_right')); ?>">
						</iframe>
						<?php include_once($path_iface . "generate_code.php"); ?>
				   </div>
				</td>

				<td class="ui-layout-east">
					<div class="layout-item">
					</div>
				</td>
			</tr>
		</tbody>
	</table>

	<script language="javascript" src="<?php echo $url_js_thirddevel; ?>wz_dragdrop/wz_dragdrop.js"></script>
	<script type="text/JavaScript" language="JavaScript">
		SET_DHTML(CURSOR_MOVE, RESIZABLE, NO_ALT, SCROLL, "bikegoeteborg"+TRANSPARENT, "button"+VERTICAL+HORIZONTAL+CURSOR_DEFAULT, "cat"+TRANSPARENT, "chameleon", "counter", "span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>"+TRANSPARENT, "muckl"+TRANSPARENT+COPY+4, "northcape"+TRANSPARENT, "redarrow", "reldiv", "reldivn4", "reldiv2"+TRANSPARENT, "reldiv2n4"+TRANSPARENT, "reltab", "sepline1"+NO_DRAG, "skitour"+TRANSPARENT, "slidercanvas", "smile1"+SCALABLE, "tryit", "upleft");
		dd.elements.span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>.moveTo(-500, -500);
		dd.elements.span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>.show();

		function show_popup()
		{
			dd.elements.span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>.moveTo(350, 50);
			setTimeout(close_popup, 4000);
		}

		function close_popup()
		{
			dd.elements.span_auto_save_<?php echo $_SESSION['nm_session']['control_abas']['frm_atual']; ?>.moveTo(-500, -500);
		}
	</script>

	<?php
	    if (isset($_SESSION['nm_session']['app_new']) && $_SESSION['nm_session']['app_new'])
	    {
			foreach ($_SESSION['nm_session']['control_abas']['apps'] as $i_app => $arr_app)
			{
				if ($arr_app['app'] == '__nm_sys_aba__src_new_app')
				{
					$_SESSION['nm_session']['control_abas']['apps'][$i_app]['app'] = $_SESSION['nm_session']['app']['cod'];
					break;
				}
			}
	?>
	<script language="javascript">
		parent.document.getElementById('sys_aba_page_title_<?php echo $_SESSION['nm_session']['control_abas']['app_atual']; ?>').innerHTML = "<img src='<?php echo $url_img; ?>app_<?php echo nm_app_icon($_SESSION['nm_session']['app']['type']); ?>.png' />" + '<?php echo $_SESSION['nm_session']['app']['cod']; ?>';
		parent.document.form_top.refresh_home_open_app.value = 'S';
	</script>
	<?php
	    	unset($_SESSION['nm_session']['app_new']);
	    }
	?>
</body>
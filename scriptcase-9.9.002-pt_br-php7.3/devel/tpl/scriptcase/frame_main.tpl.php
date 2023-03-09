<?php
$int_size = ('Y' == $this->GetVar('frame_hidden')) ? 0 : 55;
?>

<frameset rows="<?php echo $int_size; ?>,*" frameborder="no" border="0" framespacing="0">
  <frame name="nmFrmTop" src="<?php echo nm_url_rand($nm_config['url_iface'] . 'top.php'); ?>" scrolling="no" noresize="noresize"/>
  <frame name="nmFrmBot" src="<?php echo nm_url_rand($this->GetVar('frame_bottom')); ?>" scrolling="auto" noresize="noresize" />
</frameset>
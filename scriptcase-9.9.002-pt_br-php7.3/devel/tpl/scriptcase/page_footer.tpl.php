<?php
if (NM_PAGE_BODY_FRAME != $this->GetVar('page_body'))
{
    if ('' != $this->GetVar('footer_data'))
    {
?>
<br />
<br />
<p class="nmText" style="text-align: center">
<?php echo $this->GetVar('footer_data'); ?>
</p>
<?php
    }

    nm_print_lang_no_exist();
?>

</body>
<?php
}
?>

</html>
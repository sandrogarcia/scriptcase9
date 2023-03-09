<?php
$arr_data  = $this->GetVar('field_data');
$upgrade_no_permission  = isset($arr_data['upgrade_no_permission'])? $arr_data['upgrade_no_permission'] : false;
$label_new_opt  = isset($arr_data['label_new_opt'])? $arr_data['label_new_opt'] : false;
$str_class = ($arr_data['error'])           ? 'nmErrorMsg' : $arr_data['class'];
$str_mult  = ('N' == $arr_data['multiple']) ? ''           : ' multiple="multiple"';
$new_opt            = (isset($arr_data['new_options'])) ?$arr_data['new_options']: [];
$unavailable_opt    = (isset($arr_data['unavailable_options'])) ?$arr_data['unavailable_options']: [];

$changeEvt = $nm_config['form_modif2'] . '; ' . $arr_data['on_change'];
if (!empty($unavailable_opt)) {
    $changeEvt = $nm_config['form_modif2'] . '; check_permission_select(this, function(e) { ' . $arr_data['on_change'] . ' })';
}

$templateList = array(
    'basic' => 'is-basic',
    'boxed' => 'is-boxed',
    'lined' => 'is-lined',
    'numbered' => 'is-numbered'
);

?>
<tr class="nmTrAttr nmTrHover <?php echo isset($arr_data['tr_class']) ? $arr_data['tr_class'] : ''; ?>" id="id_tr_<?php echo $arr_data['name']; ?>" <?php echo $arr_data['tr_style']; ?>>
    <td class="nmAttrTitle <?php echo $str_class; ?>" style="text-align: right; vertical-align: top; ">
        <?php echo $arr_data['title']; ?>
        <a name="anchor_<?php echo $arr_data['name']; ?>"></a>
        <?php if ($upgrade_no_permission) {?>
            <small class="upgradeOnlyInfo"><?php echo nm_get_text_lang("['upgrade_only_feature']"); ?></small>
        <?php } else if ($label_new_opt) { ?>
            <span class="field-new-sticker"><?php echo nm_get_text_lang("['menu_new_label']", 'Menu'); ?></span>
        <?php } ?>
    </td>
    <td class="<?php echo $str_class; ?>" style="text-align: right; vertical-align: top;">&nbsp;</td>
    <td class="nmAttrValue <?php echo $str_class; ?>" style="text-align: left; vertical-align: top" id="id_td_obj_<?php echo $arr_data['name']; ?>" colspan="3">
        <style type="text/css">
            @charset "UTF-8";
            /* componente */
            .sc-div-steps {
                margin-bottom: 1rem;
            }
            .sc-steps {
                list-style: none;
                margin: 0;
                padding: 1.25rem 0;
                display: inline-flex;
                align-items: baseline;
                overflow: hidden;
                box-sizing: border-box;
            }
            .sc-steps *,
            .sc-steps *::after,
            .sc-steps *::before {
                box-sizing: border-box;
            }
            .sc-steps .item {
                display: flex;
                flex-wrap: wrap;
                padding: 0.75rem 1.5em;
                position: relative;
                flex: 1;
                background-color: inherit;
            }
            .sc-steps .item .icon {
                font-size: 200%;
            }
            .sc-steps .item .title {
                margin: 0;
                font-size: 100%;
            }
            .sc-steps .item .description {
                font-size: 80%;
                opacity: 0.65;
                flex: 1;
            }

            /* full width */
            .sc-steps.is-full-width {
                display: flex;
            }
            .sc-steps.is-full-width .item {
                flex: 1;
                justify-content: center;
            }

            /* boxed */
            .sc-steps.is-boxed {
                padding: 0;
                border-radius: 4px;
                border-width: 1px;
                border-style: solid;
            }
            .sc-steps.is-boxed .item {
                padding: 1rem 1.75rem;
            }
            .sc-steps.is-boxed .item + .item {
                border-style: solid;
                border-width: 0 0 0 1px;
            }
            .sc-steps.is-boxed .item + .item::after {
                content: '';
                display: block;
                position: absolute;
                top: 50%;
                left: 0;
                height: 0.75rem;
                width: 0.75rem;
                background-color: inherit;
                border-style: solid;
                border-width: 1px 1px 0 0;
                transform: translate(-50%, -50%) rotate(45deg);
            }

            /* lined */
            .sc-steps.is-lined,
            .sc-steps.is-numbered {
                background-color: transparent;
                border: 0;
            }
            .sc-steps.is-lined .item,
            .sc-steps.is-numbered .item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .sc-steps.is-lined .item::before,
            .sc-steps.is-numbered .item::before {
                margin-bottom: 0.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                content: '';
                transform: translateY(-50%);
                text-align: center;
                border-radius: 50%;
                font-weight: bold;
                padding: 0.25rem;
                box-shadow: 0 0 0 2px white;
            }

            .sc-steps.is-numbered .item::before {
                margin-bottom: 0;
            }

            .sc-steps.is-lined .item.is-complete::before,
            .sc-steps.is-numbered .item.is-complete::before {
                color: white;
                z-index: 90;
            }
            .sc-steps.is-lined .item + .item,
            .sc-steps.is-numbered .item + .item {
                padding: 0 1.5rem;
            }
            .sc-steps.is-lined .item + .item.is-complete::after,
            .sc-steps.is-numbered .item + .item.is-complete::after {
                border-color: var(--color-checked);
            }
            .sc-steps.is-lined .item + .item::after,
            .sc-steps.is-numbered .item + .item::after {
                content: '';
                width: 100%;
                border-top-width: 2px;
                border-top-style: solid;
                position: absolute;
                left: -50%;
                top: 0;
                z-index: -1;
            }

            /* numbered */
            .sc-steps.is-numbered .item {
                counter-increment: count;
            }
            .sc-steps.is-numbered .item::before {
                content: counter(count);
                width: 1.5rem;
                height: 1.5rem;
            }
            .sc-steps.is-numbered .item.is-complete::before {
                content: '✓';
            }
            .sc-steps.is-numbered .item + .item {
                padding: 0 1.5rem;
            }

            /* sizes */
            .sc-steps.is-small {
                font-size: 80%;
            }
            .sc-steps.is-small .item {
                padding: 0.5rem 1.5rem;
            }
            .sc-steps.is-medium {
                font-size: 100%;
            }
            .sc-steps.is-large {
                font-size: 120%;
            }

            .sc-steps *,
            .sc-steps *::after,
            .sc-steps *::before {
                font-size: 100%;
            }
            .sc-steps.is-lined .icon,
            .sc-steps.is-numbered .icon {
                margin: 1rem;
            }
            .sc-steps.is-lined .item + .item::after,
            .sc-steps.is-numbered .item + .item::after {
                z-index: 0;
            }
            .sc-steps.is-lined .item::before,
            .sc-steps.is-numbered .item::before {
                z-index: 2;
            }
            .sc-steps.is-lined .item,
            .sc-steps.is-numbered .item {
                flex: 1;
            }
            .sc-steps.is-boxed {
                align-items: normal;
            }
            .sc-steps .item {
                align-items: center;
            }
            .sc-steps.is-lined .item + .item::after,
            .sc-steps.is-numbered .item + .item::after {
                margin-top: -1px;
            }
            .sc-steps.is-noicons .icon {
                display: none;
            }

            .sc-steps.is-aligned-left {
                margin-left: 0px;
                /* margin-right: auto; */
            }

            .sc-steps.is-aligned-center {
                margin-left: auto;
                margin-right: auto;
            }

            .sc-steps.is-aligned-right {
                margin-right: 0px;
                margin-left: auto;
            }

            .sc-div-steps {
                display: flex;
            }

            :root {
                --color-background: #ffffff;
                --color-border: #cccccc;
                --color-text: #111111;
                --color-checked: #21BA45;
            }

            .sc-steps {
                font-family: Arial, sans-serif;
                font-size: 100%;
                color: var(--color-text);
            }

            .sc-steps .item.is-complete {
                color: var(--color-checked);
            }

            .sc-steps.is-boxed {
                background: var(--color-background);
                border-color: var(--color-border);
            }

            .sc-steps.is-boxed .item + .item {
                border-color: var(--color-border);
            }

            .sc-steps.is-boxed .item + .item::after {
                border-color: var(--color-border);
            }

            .sc-steps.is-lined .item::before,
            .sc-steps.is-numbered .item::before {
                background: var(--color-border);
            }

            /*.sc-steps.is-lined .item.is-complete::before,
            .sc-steps.is-numbered .item.is-complete::before {
                background-color: var(--color-checked);
            }*/

            .sc-steps.is-lined .item + .item::after,
            .sc-steps.is-numbered .item + .item::after {
                border-top-color: var(--color-border);
            }

            .sc-div-steps.is-rtl .sc-steps.is-boxed .item:last-child {
                border-width: 0;
            }

            .sc-div-steps.is-rtl .sc-steps.is-boxed .item:last-child::after,
            .sc-div-steps.is-rtl .sc-steps.is-numbered .item:last-child::after,
            .sc-div-steps.is-rtl .sc-steps.is-lined .item:last-child::after {
                content: none;
            }

            .sc-div-steps.is-rtl .sc-steps.is-boxed .item {
                border-style: solid;
                border-width: 0 0 0 1px;
                border-color: var(--color-border);
            }

            .sc-div-steps .sc-steps.is-aligned-left:not(.is-boxed) .item:first-child {
                padding-left: 0;
            }

            .sc-div-steps.is-full .sc-steps {
                display: flex;
                justify-content: space-between;
            }

            .sc-div-steps.is-full .sc-steps {
                flex: 1;
            }

            .sc-div-steps.is-full .sc-steps.is-basic .item {
                align-items: center;
                justify-content: center;
            }

            .sc-div-steps.is-rtl {
                display: flex;
            }

            .sc-div-steps.is-rtl .sc-steps.is-lined .item + .item::after,
            .sc-div-steps.is-rtl
            .sc-steps.is-numbered
            .item
            + .item::after
            .sc-div-steps.is-rtl
            .sc-steps.is-boxed
            .item
            + .item::after {
                content: none;
            }

            .sc-div-steps.is-rtl .sc-steps:not(.is-boxed) .item:first-child {
                padding: 0 1.5rem;
                position: relative;
            }

            .sc-div-steps.is-rtl .sc-steps.is-boxed .item::after,
            .sc-div-steps.is-rtl .sc-steps.is-lined .item::after,
            .sc-div-steps.is-rtl .sc-steps.is-numbered .item::after {
                border-color: var(--color-border);
            }

            .sc-div-steps.is-rtl .sc-steps .item:after {
                content: '';
            }

            .sc-div-steps.is-rtl .sc-steps.is-boxed .item::after {
                content: '';
                display: block;
                position: absolute;
                top: 50%;
                left: 0;
                height: 0.75rem;
                width: 0.75rem;
                background-color: inherit;
                border-style: solid;
                border-width: 1px 1px 0 0;
                transform: translate(-50%, -50%) rotate(225deg);
                z-index: 1;
            }

            .sc-steps.is-lined .item::after,
            .sc-steps.is-numbered .item::after {
                width: 100%;
                border-top-width: 2px;
                border-top-style: solid;
                position: absolute;
                left: -50%;
                top: -1px;
                z-index: 1;
            }

            .sc-div-steps.is-rtl .sc-steps.is-lined {
                padding: 0.3rem 0;
            }

            .sc-div-steps.is-rtl .sc-steps.is-numbered {
                padding: 0.8rem 0;
            }

            .sc-div-steps.is-rtl .sc-steps.is-lined.is-large .item,
            .sc-div-steps.is-rtl .sc-steps.is-numbered.is-large .item {
                padding: 0 2.25rem;
            }

            .sc-div-steps.is-rtl .sc-steps.is-lined.is-small .item,
            .sc-div-steps.is-rtl .sc-steps.is-numbered.is-small .item {
                padding: 0 1.5rem;
            }

            .sc-div-steps.is-rtl .sc-steps.is-aligned-right {
                margin-left: auto;
            }

            .sc-div-steps.is-rtl .sc-steps.is-aligned-left {
                margin-right: auto;
            }

            .sc-steps.is-boxed .item,
            .sc-steps.is-basic .item {
                grid-gap: 1rem;
                align-items: flex-start;
                flex-wrap: nowrap;
            }
        </style>
<?php

$templateCount = 0;
foreach ($templateList as $templateName => $templateInfo) {
?>
    <div style="padding: 10px 0 10px 0">
        <p>
            <input type="radio" name="wizard_template" value="<?php echo $templateName; ?>" id="sc-id-wizard-template-<?php echo $templateName; ?>" onclick="<?php echo $nm_config['form_modif2']; ?>" <?php if ($templateName == $arr_data['value']) { echo 'checked'; } ?>> <label for="sc-id-wizard-template-<?php echo $templateName; ?>"><?php echo nm_get_text_lang("['wizard_template_{$templateName}']"); ?></label>
        </p>
        <ol class="sc-steps <?php echo $templateInfo; ?>">
<?php
    $stepComplete = ' is-complete';

    foreach ($arr_data['wizard_steps'] as $stepInfo) {
?>
            <li class="item<?php echo $stepComplete; ?>">
<?php
        if (isset($stepInfo['fontawesome']) && '' != $stepInfo['fontawesome']) {
?>
                <span class="icon">
                    <i class="<?php echo $stepInfo['fontawesome']; ?>"></i>
                </span>
<?php
        }
?>
                <div class="content">
                    <h4 class="title"><?php echo (isset($stepInfo['titulo']) && '' != $stepInfo['titulo'] ? $stepInfo['titulo'] : $stepInfo['nome']); ?></h4>
<?php
        if (isset($stepInfo['descricao']) && '' != $stepInfo['descricao']) {
?>
                    <span class="description"><?php echo $stepInfo['descricao']; ?></span>
<?php
        }
?>
                </div>
            </li>
<?php
        $stepComplete = '';
    }
?>
        </ol>
    </div>
<?php
    $templateCount++;
    if ($templateCount < count($templateList)) {
?>
    <hr style="width: 90%">
<?php
    }
}

?>
    </td>
</tr>
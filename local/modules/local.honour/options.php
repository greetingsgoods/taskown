<?php

use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

$module_id = 'local.honour';

Loc::loadMessages($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/options.php");
Loc::loadMessages(__FILE__);

if ($APPLICATION->GetGroupRight($module_id) < "S") {
	$APPLICATION->AuthForm(Loc::getMessage("ACCESS_DENIED"));
}

Loader::includeModule($module_id);

$request = HttpApplication::getInstance()->getContext()->getRequest();


$aTabs = array(
	array(
		'DIV' => 'OSNOVNOE',
		'TAB' => Loc::getMessage('LOCAL_HONOUR_TAB_OSNOVNOE'),
		'OPTIONS' => array(
			array('infoblok', Loc::getMessage('LOCAL_HONOUR_OPTION_INFOBLOK_TITLE'), '', array('text', 0)),
			array('nazvanie_svoystva', Loc::getMessage('LOCAL_HONOUR_OPTION_NAZVANIE_SVOYSTVA_TITLE'), '', array('text', 0)),),
	),

	array(
		"DIV" => "rights",
		"TAB" => Loc::getMessage("MAIN_TAB_RIGHTS"),
		"TITLE" => Loc::getMessage("MAIN_TAB_TITLE_RIGHTS"),
		"OPTIONS" => array()
	),
);
#Сохранение

if ($request->isPost() && $request['Apply'] && check_bitrix_sessid()) {

	foreach ($aTabs as $aTab) {
		foreach ($aTab['OPTIONS'] as $arOption) {
			if (!is_array($arOption))
				continue;

			if ($arOption['note'])
				continue;


			$optionName = $arOption[0];

			$optionValue = $request->getPost($optionName);

			Option::set($module_id, $optionName, is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
		}
	}
}

$tabControl = new CAdminTabControl('tabControl', $aTabs);

?>
<? $tabControl->Begin(); ?>
<form method='post'
      action='<? echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($request['mid']) ?>&amp;lang=<?= $request['lang'] ?>'
      name='local_honour_settings'>

	<? foreach ($aTabs as $aTab):
		if ($aTab['OPTIONS']):?>
			<? $tabControl->BeginNextTab(); ?>
			<? __AdmSettingsDrawList($module_id, $aTab['OPTIONS']); ?>

		<? endif;
	endforeach; ?>

	<?
	$tabControl->BeginNextTab();

	require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php");

	$tabControl->Buttons(); ?>

    <input type="submit" name="Apply" value="<? echo GetMessage('MAIN_SAVE') ?>">
    <input type="hidden" name="Update" value="Y">
    <input type="reset" name="reset" value="<? echo GetMessage('MAIN_RESET') ?>">
	<?= bitrix_sessid_post(); ?>
</form>
<? $tabControl->End(); ?>


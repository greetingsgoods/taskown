<?

use Bitrix\Main\Loader;
use Bitrix\Report\VisualConstructor\Helper\Analytic;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/report/analytics/index.php");

if (Loader::includeModule('report') && !Analytic::isEnable()) {
	echo 'Analytics is not enabled.';
} else {
	$APPLICATION->IncludeComponent(
		'bitrix:ui.sidepanel.wrapper',
		'',
		[
			'POPUP_COMPONENT_NAME' => 'bitrix:report.analytics.base',
			'POPUP_COMPONENT_TEMPLATE_NAME' => '',
			'POPUP_COMPONENT_PARAMS' => [
				'PAGE_TITLE' => GetMessage('REPORT_CRM_ANALYTICS_PAGE_TITLE')
			],
			//'PLAIN_VIEW' => true,
			'USE_PADDING' => false,
			'PAGE_MODE' => false,
			'PAGE_MODE_OFF_BACK_URL' => '/crm/',
		]
	);
}
?><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/intranet/public/auth/.left.menu.php");

$aMenuLinks = array(
	array(
		GetMessage("AUTH_LOGIN"),
		"/auth/index.php?login=yes",
		array(),
		array(),
		""
	),
	array(
		GetMessage("AUTH_REG"),
		"/auth/index.php?register=yes",
		array(),
		array(),
		"COption::GetOptionString(\"main\", \"new_user_registration\") == \"Y\""
	),
	array(
		GetMessage("AUTH_FORGOT_PASS"),
		"/auth/index.php?forgot_password=yes",
		array(),
		array(),
		""
	)
);
?>

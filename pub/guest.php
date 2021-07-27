<?php

use Bitrix\Crm\SiteButton\Guest;
use Bitrix\Main\Loader;

define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC", "Y");
define('SKIP_TEMPLATE_AUTH_ERROR', true);
define('NOT_CHECK_PERMISSIONS', true);

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if (Loader::includeModule('crm')) {
	Guest::runController();
}

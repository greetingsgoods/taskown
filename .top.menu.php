<?
$aMenuLinks = array(
	array(
		"CRM",
		"/crm/",
		array(),
		array(),
		"CBXFeatures::IsFeatureEnabled('crm') && CModule::IncludeModule('crm') && CCrmPerms::IsAccessEnabled()"
	)
);
?>

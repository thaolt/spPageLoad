<?php
if (isset($_SERVER['HTTP_X_PJAX']) || isset($_REQUEST['pjax_debug'])) {
	$_SERVER['HTTP_X_REQUESTED_WITH']="";
	unset($_SERVER['HTTP_X_REQUESTED_WITH']);

	OW::getEventManager()->bind(
		OW_EventManager::ON_FINALIZE, 
		array(SPPAGELOAD_BOL_Service::getInstance(), 'spPageLoadFinalize')
	);
}


OW::getEventManager()->bind(
	OW_EventManager::ON_BEFORE_DOCUMENT_RENDER, 
	array(SPPAGELOAD_BOL_Service::getInstance(), 'requireSpPageLoadJs')
);


<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_cablansafesinglenews_pi1.php', '_pi1', '', 1);


$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['what_to_display'][] = array('SAFE_SINGLE', 'SAFE_SINGLE');


$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['tt_news']['extraCodesHook'][] = 'EXT:cablan_safe_single_news/pi1/class.tx_cablansafesinglenews_pi1.php:tx_cablansafesinglenews_pi1';
?>
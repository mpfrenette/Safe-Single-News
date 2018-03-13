<?php

########################################################################
# Extension Manager/Repository config file for ext "cablan_safe_single_news".
#
# Auto generated 12-03-2012 08:11
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Safe Single News',
	'description' => 'This extension adds a new tt_news code: SAFE_SINGLE which ensures that a single news article is shown even if none is specified.

If a news article is selected, it will simply show it. If none is selected, it will display the latest news article for the configured category.

It is compatible with a specified category (a cat menu) and with virtual tt_news.',
	'category' => '',
	'author' => 'Martin-Pierre Frenette',
	'author_email' => 'typo3@cablan.net',
	'shy' => '',
	'dependencies' => 'tt_news',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'tt_news' => '',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:7:{s:9:"ChangeLog";s:4:"7a35";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"63a4";s:19:"doc/wizard_form.dat";s:4:"7679";s:20:"doc/wizard_form.html";s:4:"0d26";s:41:"pi1/class.tx_cablansafesinglenews_pi1.php";s:4:"3640";}',
);

?>
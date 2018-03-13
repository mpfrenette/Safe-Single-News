<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Martin-Pierre Frenette <typo3@cablan.net>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');


/**
 * Plugin 'Safe Single News' for the 'cablan_safe_single_news' extension.
 *
 * @author	Martin-Pierre Frenette <typo3@cablan.net>
 * @package	TYPO3
 * @subpackage	tx_cablansafesinglenews
 */
class tx_cablansafesinglenews_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_cablansafesinglenews_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_cablansafesinglenews_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'cablan_safe_single_news';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf)	{
		return 'Hello World!<HR>
			Here is the TypoScript passed to the method:'.
					t3lib_div::view_array($conf);
	}


	function GetSubcategoriesRecursively(&$categories, $parent_cat){
	 global $DB;

		
		$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tt_news_cat',
							  'parent_category='.intval($parent_cat).' AND deleted=0 AND hidden=0');

		if ( $result && $GLOBALS['TYPO3_DB']->sql_num_rows($result) > 0 ) {
			while ( $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)){
				$categories[] = $row['uid'];
				$this->getSubcategoriesRecursively($categories, $row['uid']);		
				
			}
		}
		return $categories; 

	}


	function extraCodesProcessor($news){

		if ($news->theCode == 'SAFE_SINGLE' ){
	//echo t3lib_div::view_array($news->conf);
			$news->theCode = 'SINGLE';
			if ( $news->tt_news_uid > 0 ){
				$content = $news->DisplaySingle();
			}
			else{

			if ( isset($news->piVars['cat'])){
				$news->catExclusive = intval($news->piVars['cat']);
			}
			else if ($news->conf['displaySingle.']['safeSingleCat'] > 0) {
				$news->catExclusive =$news->conf['displaySingle.']['safeSingleCat'];
			}



			$selectConf = $news->getSelectConf($where, $noPeriod);


				//$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tt_news', '1 '.$news->cObj->enableFields('tt_news'), '','datetime DESC', '1');
				$res = $news->exec_getQuery('tt_news', $selectConf);
				if ( $res && ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))){
					$news->tt_news_uid  = $row['uid'];
					$content =  $news->DisplaySingle();		
				}
				else{

					$categories = $this->GetSubcategoriesRecursively($categories,$news->conf['displaySingle.']['safeSingleCat']);

					$news->catExclusive = implode(',', $categories);
					$selectConf = $news->getSelectConf($where, $noPeriod);
					$res = $news->exec_getQuery('tt_news', $selectConf);
					if ( $res && ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))){
						$news->tt_news_uid  = $row['uid'];
						$content =  $news->DisplaySingle();		
					}
									



				}
				

						
			}
		}
		//exit ( $content);

		return $content;
	}
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cablan_safe_single_news/pi1/class.tx_cablansafesinglenews_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/cablan_safe_single_news/pi1/class.tx_cablansafesinglenews_pi1.php']);
}

?>
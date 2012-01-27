<?php

########################################################################
# Extension Manager/Repository config file for ext "displaycontroller_advanced".
#
# Auto generated 27-09-2010 15:10
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Advanced Controller  - Tesseract project',
	'description' => 'This extension manages relations between Tesseract components and produces output in the FE.  More info on http://www.typo3-tesseract.com',
	'category' => 'plugin',
	'author' => 'Francois Suter (Cobweb), Fabien Udriot (Ecodev)',
	'author_email' => 'typo3@cobweb.ch,fabien.udriot@ecodev.ch',
	'shy' => '',
	'dependencies' => 'cms,tesseract',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'stable',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '1.0.0',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'typo3' => '4.3.0-0.0.0',
			'tesseract' => '0.1.0-0.0.0',
			'displaycontroller' => ''
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:18:{s:9:"ChangeLog";s:4:"8d21";s:10:"README.txt";s:4:"319e";s:38:"class.tx_displaycontrolleradvanced.php";s:4:"7640";s:46:"class.tx_displaycontrolleradvanced_service.php";s:4:"0c8d";s:16:"ext_autoload.php";s:4:"bb6f";s:12:"ext_icon.gif";s:4:"f02f";s:17:"ext_localconf.php";s:4:"94b0";s:14:"ext_tables.php";s:4:"f150";s:14:"ext_tables.sql";s:4:"2aa6";s:16:"ext_typeicon.gif";s:4:"0c33";s:27:"locallang_csh_ttcontent.xml";s:4:"a95d";s:16:"locallang_db.xml";s:4:"bdd8";s:64:"Configuration/TCA/tx_displaycontrolleradvanced_providergroup.php";s:4:"efcf";s:70:"Resources/Public/Images/tx_displaycontrolleradvanced_providergroup.png";s:4:"d3db";s:14:"doc/manual.pdf";s:4:"f467";s:14:"doc/manual.sxw";s:4:"545b";s:46:"pi1/class.tx_displaycontrolleradvanced_pi1.php";s:4:"842a";s:46:"pi2/class.tx_displaycontrolleradvanced_pi2.php";s:4:"b939";}',
);

?>
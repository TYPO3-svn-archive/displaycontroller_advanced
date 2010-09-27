<?php
// $Id$
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_div::loadTCA('tt_content');

	// Add new columns to tt_content
	//
	// A note about MM_match_fields:
	// This structure makes use of a lot of additional fields in the MM table
	// "component" defines whether the related component is a consumer, a provider and a filter
	// "rank" defines the position of the component in the relation chain (1, 2, 3, ...)
	// "local_table" and "local_field" are set so that the relation can be reversed-engineered
	// when looking from the other side of the relation (i.e. the component). They help
	// the component know to which record from which table it is related and in which
	// field to find the type of controller (which is matched to a specific datacontroller service)
$tempColumns = array(
	'tx_displaycontroller_consumer' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:displaycontroller/locallang_db.xml:tt_content.tx_displaycontroller_consumer',
		'config' => array(
			'type' => 'group',
			'internal_type' => 'db',
			'allowed' => '',
			'size' => 1,
			'minitems' => 1,
			'maxitems' => 1,
			'prepend_tname' => 1,
			'MM' => 'tx_displaycontroller_components_mm',
			'MM_match_fields' => array(
				'component' => 'consumer',
				'rank' => 1,
				'local_table' => 'tt_content',
				'local_field' => 'CType'
			),
			'wizards' => array(
				'edit' => array(
					'type' => 'popup',
					'title' => 'LLL:EXT:displaycontroller/locallang_db.xml:wizards.edit_dataconsumer',
					'script' => 'wizard_edit.php',
					'icon' => 'edit2.gif',
					'popup_onlyOpenIfSelected' => 1,
					'notNewRecords' => 1,
					'JSopenParams' => 'height=500,width=800,status=0,menubar=0,scrollbars=1,resizable=yes'
				),
			)
		)
	),
	'tx_displaycontrolleradvanced_providergroup' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:displaycontroller_advanced/locallang_db.xml:tt_content.tx_displaycontrolleradvanced_providergroup',
		'config' => array(
			'type' => 'inline',
			'foreign_table' => 'tx_displaycontrolleradvanced_providergroup',
			'foreign_field' => 'content',
		)
	),
);
t3lib_extMgm::addTCAcolumns('tt_content', $tempColumns, 1);

	// Define showitem property for both plug-ins
$showItem = 'CType;;4;button,hidden,1-1-1, header;;3;;2-2-2,linkToTop;;;;3-3-3';
$showItem .= ', --div--;LLL:EXT:displaycontroller/locallang_db.xml:tabs.dataobjects, tx_displaycontroller_consumer;;;;1-1-1, tx_displaycontrolleradvanced_providergroup;;;;2-2-2';
$showItem .= ', --div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access, starttime, endtime';

$TCA['tt_content']['types'][$_EXTKEY . '_pi1']['showitem'] = $showItem;
$TCA['tt_content']['types'][$_EXTKEY . '_pi2']['showitem'] = $showItem;
$TCA['tt_content']['ctrl']['typeicons'][$_EXTKEY . '_pi1'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_typeicon.gif';
$TCA['tt_content']['ctrl']['typeicons'][$_EXTKEY . '_pi2'] = t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_typeicon.gif';

	// Add context sensitive help (csh) for the new fields
t3lib_extMgm::addLLrefForTCAdescr('tt_content', 'EXT:' . $_EXTKEY . '/locallang_csh_ttcontent.xml');

	// Register plug-ins (pi1 is cached, pi2 is not cached)
t3lib_extMgm::addPlugin(array('LLL:EXT:displaycontroller_advanced/locallang_db.xml:tt_content.CType_pi1', $_EXTKEY . '_pi1', t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_typeicon.gif'), 'CType');
t3lib_extMgm::addPlugin(array('LLL:EXT:displaycontroller_advanced/locallang_db.xml:tt_content.CType_pi2', $_EXTKEY . '_pi2', t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_typeicon.gif'), 'CType');

	// Register the name of the table linking the controller and its components
#$T3_VAR['EXT']['tesseract']['controller_mm_tables'][] = 'tx_displaycontrolleradvanced_components_mm';

	// Define main TCA for table tx_displaycontrolleradvanced_providergroup
t3lib_extMgm::allowTableOnStandardPages('tx_displaycontrolleradvanced_providergroup');

$TCA['tx_displaycontrolleradvanced_providergroup'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:displaycontroller_advanced/locallang_db.xml:tx_displaycontrolleradvanced_providergroup',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'versioningWS' => TRUE,
		'origUid' => 't3_origuid',
		'default_sortby' => 'ORDER BY uid',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/tx_displaycontrolleradvanced_providergroup.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/tx_displaycontrolleradvanced_providergroup.png',
		'dividers2tabs' => 1,
	),
	'feInterface' => array (
		'fe_admin_fieldList' => 'hidden, title, description, sql_query, t3_mechanisms',
	)
);

	// ATM, defines here allowed data type + wizard
t3lib_div::loadTCA('tx_displaycontrolleradvanced_providergroup');
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_provider']['config']['allowed'] .= ',tx_dataquery_queries';
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_datafilter']['config']['allowed'] .= ',tx_datafilter_filters';
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_datafilter2']['config']['allowed'] .= ',tx_datafilter_filters';

	// Add a wizard for adding a dataquery
$addDataqueryWizard = array(
						'type' => 'script',
						'title' => 'LLL:EXT:dataquery/locallang_db.xml:wizards.add_dataquery',
						'script' => 'wizard_add.php',
						'icon' => 'EXT:dataquery/res/icons/add_dataquery_wizard.gif',
						'params' => array(
								'table' => 'tx_dataquery_queries',
								'pid' => '###CURRENT_PID###',
								'setValue' => 'append'
							)
						);
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_provider']['config']['wizards']['add_dataquery'] = $addDataqueryWizard;


$addDatafilteryWizard = array(
						'type' => 'script',
						'title' => 'LLL:EXT:datafilter/locallang_db.xml:wizards.add_datafilter',
						'script' => 'wizard_add.php',
						'icon' => 'EXT:datafilter/res/icons/add_datafilter_wizard.gif',
						'params' => array(
								'table' => 'tx_datafilter_filters',
								'pid' => '###CURRENT_PID###',
								'setValue' => 'append'
							)
						);
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_datafilter']['config']['wizards']['add_datafilter'] = $addDatafilteryWizard;
$TCA['tx_displaycontrolleradvanced_providergroup']['columns']['tx_displaycontroller_datafilter2']['config']['wizards']['add_datafilter2'] = $addDatafilteryWizard;

?>
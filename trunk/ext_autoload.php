<?php
/* 
 * Register necessary class names with autoloader
 *
 * $Id$
 */
$extensionPath = t3lib_extMgm::extPath('displaycontroller_advanced');
return array(
	'tx_displaycontrolleradvanced_pi1'			=> $extensionPath . 'pi1/class.tx_displaycontrolleradvanced_pi1.php',
	'tx_displaycontrolleradvanced_pi2'			=> $extensionPath . 'pi2/class.tx_displaycontrolleradvanced_pi2.php',
	'tx_displaycontrolleradvanced'				=> $extensionPath . 'class.tx_displaycontrolleradvanced.php',
	'tx_displaycontrolleradvanced_service'		=> $extensionPath . 'class.tx_displaycontrolleradvanced_service.php',
);
?>

<?php

use WHMCS\Module\Addon\BsFundsRecollector\Admin\AdminDispatcher;

if (!defined("WHMCS")) {
	die("This file cannot be accessed directly");
}

function bs_funds_recollector_config()
{
	return [
		'name' => 'Guthaben verereinahmlichen',
		'description' => 'Mit diesem Modul können Sie Guthaben von Kunden vereinahmlichen die länger inaktiv waren.',
		'author' => 'Martin Becker',
		'language' => 'german',
		'version' => '1.0',
		'fields' => [],
	];
}

function bs_funds_recollector_activate()
{
	return [
		// Supported values here include: success, error or info
		'status' => 'success',
		'description' => 'Die installation des Modules ist erfolgreich.',
	];
}

function bs_funds_recollector_deactivate()
{
	return [
		// Supported values here include: success, error or info
		'status' => 'success',
		'description' => 'Die deinstallation des Modules war erfolgreich.',
	];
}

function bs_funds_recollector_output($vars)
{
	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

	$dispatcher = new AdminDispatcher();
	$response = $dispatcher->dispatch($action, $vars);
	echo $response;
}

function bs_funds_recollector_sidebar($vars)
{
	// Get common module parameters
	$modulelink = $vars['modulelink'];
	$version = $vars['version'];
	return <<<"EOD"
<div class="sidebar-header">
    <i class="fas fa-user"></i>
    Guthaben
    </div>
    <ul class="menu">
        <li><a href="addonmodules.php?module=bs_funds_recollector">Massenaktion</a></li>
        <li><a href="addonmodules.php?module=bs_funds_recollector&action=single">Einzelauftrag</a></li>
    </ul>
</div>
EOD;
}
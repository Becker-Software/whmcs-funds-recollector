<?php

use WHMCS\Module\Addon\BsFundsRecollector\Admin\AdminDispatcher;

if (!defined("WHMCS")) {
	die("This file cannot be accessed directly");
}

function bs_funds_recollector_config()
{
	return [
		'name' => 'Recollect funds',
		'description' => 'This Module can be used to recollect funds after a certain time or by manual entry of the customer id.',
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
		'description' => 'Success',
	];
}

function bs_funds_recollector_deactivate()
{
	return [
		// Supported values here include: success, error or info
		'status' => 'success',
        'description' => 'Success',
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
    Credit
    </div>
    <ul class="menu">
        <li><a href="addonmodules.php?module=bs_funds_recollector">Mass action</a></li>
        <li><a href="addonmodules.php?module=bs_funds_recollector&action=single">Single action</a></li>
    </ul>
</div>
EOD;
}
<?php

namespace WHMCS\Module\Addon\BsFundsRecollector\Admin;

use Illuminate\Database\Capsule\Manager as Capsule;
use Smarty;
use WHMCS\Carbon;

/**
 * Sample Admin Area Controller
 */
class Controller
{

	/**
	 * Index action.
	 *
	 * @param array $vars Module configuration parameters
	 *
	 * @return string
	 */
	public function index($vars)
	{
		$date = $_POST['date'];
		if(!empty($_POST['date'])) {
			$clients = Capsule::table('tblcredit')->selectRaw(
				'tblclients.id,tblclients.firstname,tblclients.lastname,tblclients.companyname,tblclients.credit,max(tblcredit.date) as date'
			)
				->join('tblclients', 'tblclients.id', '=', 'tblcredit.clientid')
				->where('tblclients.credit', '>', '0')
				->havingRaw('MAX(tblcredit.date) < ? ',[Carbon::parse($date)->format('Y-m-d')])
				->groupBy('tblcredit.clientid');
			$clients = $clients->get();
		}

		if(isset($_POST['recollect_funds'])) {
			foreach($clients as $client) {
				$command = 'CreateInvoice';
				$postData = array(
					'userid' => $client->id,
					'sendinvoice' => '0',
					'itemdescription1' => 'Einzug abgelaufenes Guthaben',
					'itemamount1' => $client->credit,
					'itemtaxed1' => '1',
					'autoapplycredit' => '1',
				);

				$results = localAPI($command, $postData);
			}
		}

		$smarty = new Smarty();
		$smarty->assign('clients', $clients);
		$smarty->caching = false;
		$smarty->assign('date', $date);
		$smarty->compile_dir = $GLOBALS['templates_compiledir'];
		$smarty->display(dirname(__FILE__) . '/../../templates/index.tpl');
	}

	public function single()
	{

		$smarty = new Smarty();
		$smarty->caching = false;
		if($_POST['client_id']) {
			$client_id = $_POST['client_id'];
			$smarty->assign('client_id', $client_id);

			$command = 'GetClientsDetails';
			$postData = array(
				'clientid' => $client_id,
				'stats' => false,
			);

			$results = localAPI($command, $postData);

			$command = 'CreateInvoice';
			$postData = array(
				'userid' => $results['client_id'],
				'sendinvoice' => '0',
				'itemdescription1' => 'Einzug abgelaufenes Guthaben',
				'itemamount1' => $results['credit'],
				'itemtaxed1' => '1',
				'autoapplycredit' => '1',
			);
			localAPI($command, $postData);
		}
		$smarty->compile_dir = $GLOBALS['templates_compiledir'];
		$smarty->display(dirname(__FILE__) . '/../../templates/single.tpl');
	}
}

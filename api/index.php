<?phpsession_start();/*SIMPLE MPOS REST SERVICE*AUTHOR;JAIRUS*DESCR: SIMPLY FOR MADEALS DEMO, WILL NEED REDOING!*/include "connection/config.php";include "library.php";$action = $_REQUEST['rest_action'];$client_id = $_REQUEST['client_id'];$device_id = $_REQUEST['device_id'];$device_trans_id = $_REQUEST['device_trans_id'];$received_post = json_encode($_REQUEST);traceActivity("REQUEST: ".$received_post);$json = "";switch($action){	case get_live_items:		$data = getLiveItems();		$response['response_code'] = 100;		$response['live_items'] = $data;		$json = json_encode($response);		echo $json;		traceActivity("RESPONSE: ".$json);	break;		case create_bid:		$customer_id = $_REQUEST['customer_id'];		$auction_id = $_REQUEST['auction_id'];		$bid_id = creatAuctionBid($customer_id,$auction_id);		$response['response_code'] = 100;		$response['bid_id'] = $bid_id;		$json = json_encode($response);		echo $json;		traceActivity("RESPONSE: ".$json);		break;		case get_live_time:		$data = getLiveTime();		$response['response_code'] = 100;		$response['live_items'] = $data;		$json = json_encode($response);		echo $json;		traceActivity("RESPONSE: ".$json);	break;		default:	   $response['response_code'] = 100;	   echo json_encode($response);									break;}?>
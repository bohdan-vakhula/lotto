<?php
define('TOKEN', 'ahgX0248kQSD492');
/*
SandBox: https://5.100.249.154/api/
Live: https://api.lottoyard.com/
*/

define('BASE_API_URL', 'https://api.lottoyard.com/');
// define('BASE_API_URL', 'https://5.100.249.154/api/');
define('BRAND_ID', '15');

if (session_id() == "")
{
  session_start();
}
if(isset($_GET["bta"])){
	$_SESSION["bta"] = trim($_GET["bta"]);
}
if(isset($_GET["cxd"])){
	$_SESSION["cxd"] = trim($_GET["cxd"]);
}
if(isset($_GET["clickid"])){
	$_SESSION["clickid"] = trim($_GET["clickid"]);
}
if (isset($_GET["utm_campaign"])) {
        $_SESSION["utm_campaign"] = trim($_GET["utm_campaign"]);
}

function apiCall($url,$data)
{
		$url = BASE_API_URL.$url; // New url

		$data_string = json_encode($data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Token: ' . TOKEN)
        );

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);


       return $resultData = curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
		return $resultData;
}

$message = '';
if (isset($_POST) && ($_POST['Email'] != '')) {
	$data = array(
		"FirstName" => str_replace('\\', '', $_POST['firstName']),
		"LastName" => str_replace('\\', '', $_POST['lastName']),
		"Email" => $_POST['Email'], 
		"PhoneNumber" => $_POST['code'] . $_POST['Phone'], 
		"Country" => $_POST['Country'], 
		"City" => $_POST['city'], 
		"ZipCode" => $_POST['zipcode'], 
		"BrandID" => BRAND_ID, 
		"AffiliateId" => $_SESSION["bta"] == null? 0 : $_SESSION["bta"], 
		"cxd" => $_SESSION["cxd"] == null ? 0 : $_SESSION["cxd"],
		"IP" => $_SERVER['REMOTE_ADDR']
	); // singup

	$result = json_decode(apiCall("userinfo/signup", $data), true);
	
	if (! empty($result['Result']['UserSessionId'])) {
		$signupresult = $result;
		$_SESSION['user_data'] = $result;
		$data = array(
			"MemberId" => $result['MemberId'], 
			"BrandID" => BRAND_ID,
		);
		$result = json_decode(apiCall("playlottery/insert-member-free-product", $data), true);
		if (is_array($result) && $result['ProductManagementCounter'] !== "") {
			$_SESSION['has_free_ticket'] = 1;
			$c = $_SESSION['clickid'];
			$pixel = '<iFrame src="https://go-rilladigitaladvertising.afftrack.com/pb?mid=b94a1af29ae12e3f&status=1&subid=' . $c . '" width="0" height="0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iFrame>';
			$message  = '<script>document.location.href="https://www.orolotto.com/en/autologin/' . $signupresult['Result']['UserSessionId'] . '/' . BRAND_ID . '/' . $_SESSION['utm_campaign'] . '";</script>';
			
			
		}
		
		
	}
	else {
		if (isset($result[0]['ErrorMessage'])) {
               $message = '<script>document.getElementById("errorfromapi").innerHTML ="Email address not verified";</script>';
		} else {
			$message  = '<script>document.getElementById("errorfromapi").innerHTML ="Email address is already registered";</script>';
			
		}
	}
}


$draws = array('PowerBall' => array('Powerball', '$', 'lotto-2.png'), 'MegaMillions' => array('Mega Millions', '$', 'lotto-1.png'), 'SuperEnalotto' => array('SuperEnaLotto', '€', 'lotto-6.png'), 'EuroJackpot' => array('EuroJackpot', '€', 'lotto-7.png'), 'EuroMillions' => array('Euromillions', '€', 'lotto-3.png'), 'LaPrimitiva' => array('LaPrimitiva', '€', 'lotto-5.png'), 'ElGordo' => array('ElGordo', '€', 'lotto-8.png'), 'Lotto649' => array('Lotto649', '$', 'lotto-4.png'), 'NewYorkLotto' => array('NewYorkLotto', '$', 'lotto-9.png'), 'UkLotto' => array('UkLotto', '$', 'lotto-10.png'),'OzLotto' => array('OzLotto', '$', 'lotto-11.png'), 'BonoLoto' => array('BonoLoto', '€', 'lotto-12.png'));
 
function getFeed() {
	global $draws;
	$guid = time();
	$feed_url = 'https://www.icelotto.com/rss/draws/?a=' . $guid . '/';
	$highest = array();
    $jackpots = array();
	$now =  new DateTime();
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
    foreach($x->channel->item as $entry) {
		 if ($count == 4) {
        continue;  
		
    }
	$count++;	
		$title = strip_tags($entry->title);
		if (array_key_exists($title, $draws)) {
			$description =  str_replace('0 ','0&', str_replace('Jackpot','&Jackpot', str_replace(': ','=', strip_tags($entry->description))));
			parse_str($description, $output);
			$int = ereg_replace("[^0-9]", "", $output['Jackpot']);
			$number = number_format(round(($int/1000000),1)); 
			
			$jackpot = array('title' => $title, 'link' => 'https://www.orolotto.com/' . strtolower ($title) . '-lottery/', 'date' => $output['Draw_Date'], 'jackpot' => $output['Jackpot'], 'int' => $int, 'number' => $number);
			$jackpots[$title] = $jackpot;
			
			$date = new DateTime((String)$output['Draw_Date']);
//			if($date > $now) {
				if (count($highest) > 0) {
					if (intval($highest['int']) < intval($jackpot['int'])) {
						$highest = $jackpot;
					}
				} else {
					$highest = $jackpot;
				}
//			}			
		}
    }
	return array('highest' => $highest, 'jackpots' => $jackpots);
}

?>
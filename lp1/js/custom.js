(function ($) {
	
	$(document).ready(function () {


		
		function getParameterByName(name) {
		    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		        results = regex.exec(location.search);
		    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
		}
		
		var lang = getParameterByName('lang');
		if (typeof lang === 'undefined' || lang === null ) {
			lang='en';
		};
		switch (lang) {
			case 'fr':
				lang = 'fr';
				break;
			default:
			lang ='en';
		};

		//load translations
		$.getScript("./js/validationtranslations.js", function(){
		});


		

		jQuery.validator.addMethod("latinAndCiric", function (value, element) {
	        if (/^([а-яА-ЯёЁ |a-zA-Z-_]{3,40})$$/gm.test(value)) {
	            return true;
	        } else {
	            return false;
	        };
   		}, "Wrong Field");


		//console.log(selectedLottery);
		$('#playbtn').on('click', function () {

			// console.log(7-($('#phone_prefix').html().length));

				var mobilePhoneMaxLenght = 7-($('#phone_prefix').html().length);

				 $('#signupform').validate({ // initialize the plugin
				 	errorLabelContainer: $("#signupform div.error"),
				 	rules: {
			 			FirstName: {
		                    // required: true,
		                    // minlength: 3,
		                    // lettersonly: true,
		                    latinAndCiric: true,
	                	},
			 			LastName: {
		                    // required: true,
		                    // minlength: 3,
		                    // lettersonly: true,
		                    latinAndCiric: true,
	                	},
	                	 MobileNumber: {
		                    required: true,
		                    number: true,
		                    minlength: mobilePhoneMaxLenght
		                },

		                Email: {
		                    required: true,
		                    email: true,
		                },
				 	},
				 	messages: {
				 		FirstName: {
				 			required: obj[lang].invalidName,
				 			minlength: obj[lang].invalidName,
				 			lettersonly: obj[lang].invalidName
				 		},
				 		MobileNumber: {
				 			required: obj[lang].invalidPhone,
				 			number: obj[lang].invalidPhone,
				 			minlength: obj[lang].invalidPhone
				 		},
				 		Email: {
				 			required: obj[lang].invalidEmail,
				 			email: obj[lang].invalidEmail,
				 		}
				 	},
		       
		   		 });

				
			 if ($("#signupform").valid() === true) {
				sendForm(SignupUrl, lang);
			 };
		});

	});

	

	//add tracking pixel in head
	function AddMeidaPx(url) {
		 var my_awesome_script = document.createElement('script');
		 my_awesome_script.setAttribute('src',url);
		 my_awesome_script.setAttribute('language','JavaScript1.1');
		 document.head.appendChild(my_awesome_script);
	}
	
	function redirect(sessionid, lang) {
	    var redirect_url = RedirectHost;
		var bta = qs["bta"];
	    if(bta != null && bta != 'undefined' && bta > 0) {
		    var bta = qs["bta"];
	    }else{
	    	var bta=0;
	    }
		var clickid = qs["clickid"];
	    if(clickid != null && clickid != 'undefined' && clickid > 0) {
		    var clickid = qs["clickid"];
	    }else{
	    	var clickid="";
	    }
		var memberid = parseInt(sessionid + 357) / 589;
		// Store
		localStorage.setItem("SessionId", sessionid);
		localStorage.setItem("MemberId", memberid);
		localStorage.setItem("bta", bta);
		localStorage.setItem("clickid", clickid);

		// add tracking script in head
		//AddMeidaPx(FX_PIXEL.onRegistred);

		// dynamic pixel
		geoip2.country(function(data){
			$('#firedPixelOnSucces').attr('src','https://go-rilladigitaladvertising.afftrack.com/pb?mid=b94a1af29ae12e3f&status=1&subid='+clickid+'');
			// https://www.icelotto.com/en/lottery-ticket/PowerBall/ + BTA + user logged in.
			redirect_url = redirect_url+'/'+lang+'/autologin2/'+bta+'/'+memberid+'/15';
			redirect_url = redirect_url.toLowerCase();

			// console.log(redirect_url+'?lang='+lang);
			window.top.location.href = redirect_url+'?lang='+lang;
		});
	}

	
	

	function getLanguageFromQueryString() {
		var language = qs["lang"];
		if (language == "nl" || language == "ru" || language == "fr") { // check for all supported	
			return language;
		}
		return 'en';
	}

	function getTextsForLanguage() {
		var language = getLanguageFromQueryString();
		return LocalizedTexts[language];
	}

	function sendForm(url, lang) {
		
		$('.error').empty().css('color', 'Red');
		var $result = $('.error');
		//lotteryid
		var lotteryid = $("[name='lotteryid']").val();

		var sendData = $('#signupform').serialize();
		// console.log(url);

		sendData = sendData.replace("MobileNumber=",'MobileNumber='+$('#phone_prefix').val());

		// console.log(sendData);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: url, //url you posting to
			// data: $('#signupform').serialize(), //serialize the data in your form
			cache: false,
			data: sendData, //serialize the data in your form
			success: function (result) {
				// console.log(result);
				if ($.isArray(result)) {
					$.each(result, function (index, value) {
						if (value.Property && value.ErrorMessage) {
							$result.append(value.ErrorMessage + '<br />');
						}
					});
				}
				else if (result.SessionId != null && result.SessionId != 'undefined' && result.SessionId > 0) {
					$result.css('color', 'Green');
					$result.html('Successfully registered, redirecting');


					redirect(result.SessionId, lang);
					return;
				}
				else {
					$result.html(result);
				}
			},
			error: function (result) {
				//console.log(result);
				$result.html("An error occurred, please try again");
			}
		});
	}

})(jQuery);

var LotteryCountryNames = [
	{ lottery: 'EuroMillions', country: 'EUROPE', id: "5" },
	{ lottery: 'PowerBall', country: 'USA', id: "1" },
	{ lottery: 'Lotto649', country: 'Canada', id: "3" },
	{ lottery: 'EuroJackpot', country: 'EUROPE', id: "9" },
	{ lottery: 'MegaMillions', country: 'USA', id: "2" },
	{ lottery: 'ElGordo', country: 'Spain', id: "10" },
	{ lottery: 'UkLotto', country: 'UK', id: "12" },
	{ lottery: 'LaPrimitiva', country: 'Spain', id: "4" },
	{ lottery: 'SuperEnalotto', country: 'Italy', id: "8" },
	{ lottery: 'BonoLoto', country: 'Spain', id: "11" },
	{ lottery: 'NewYorkLotto', country: 'USA', id: "14" }
];

var LocalizedTexts = {
	en: { play_button: "PLAY NOW", draw_date: "DRAW DATE" },
	nl: { play_button: "Speel", draw_date: "Volgende Trekking" },
	ru: { play_button: "Играть", draw_date: "Pозыгрыш" },
	fr: { play_button: "Jouer", draw_date: "Jour du tirage" }
};
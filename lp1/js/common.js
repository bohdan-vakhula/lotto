$(document).ready(function () {

$('.phone-1').change(function() {
		var prefix = $(this).val();
		for(var i in CountryCodePrefixes) {
			if(CountryCodePrefixes[i] == prefix) {
				$('.select select').val(i);
				break;
			}
		}				
	});
	if(document.referrer){
		$('#Referral').val(document.referrer);
	}
    if ($(window).width() < 768){
		$('input.email').insertBefore($('input.phone-1'));
		$('input.last-name').insertBefore($('input.email'));
	}	
	$('.col-sm-12 .l-btn').on('click', function() {
		if(checked('.check input')) {
			sendForm(SignupUrl);
		}
	});
	$('.check input').on('click', function() {
		checked('.check input');
	});	
	
	
	
	var $selects = $('.select select');	
	
	geoip2.country(function(data){
		$selects.val(data.country.iso_code);
		$('.phone-1').val(CountryCodePrefixes[data.country.iso_code]);
		$('#CountryCode').val(data.country.iso_code);
	});
	
	$body = $("body");
	$(document).on({
		ajaxStart: function() { $body.addClass("loading"); },
		ajaxStop: function() { $body.removeClass("loading"); }
	});

});

$(window).resize(function(){if ($(window).width() < 768){
	$('input.email').insertBefore($('input.phone-1'));
    $('input.last-name').insertBefore($('input.email'));
} else {
	$('input.last-name, input.email').insertBefore($('div.check'));
}});



var urlParams;
  (window.onpopstate = function () {
      var match,
          pl     = /\+/g,  // Regex for replacing addition symbol with a space
          search = /([^&=]+)=?([^&]*)/g,
          decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
          query  = window.location.search.substring(1);

      urlParams = {};
      while (match = search.exec(query))
         urlParams[decode(match[1])] = decode(match[2]);


     // normalization for bta
     if (urlParams.bta === undefined || urlParams.bta=== '' || urlParams.bta===null) {
     	urlParams.bta=0;
     };
	 if (urlParams.clickid === undefined || urlParams.clickid=== '' || urlParams.clickid===null) {
     	urlParams.clickid="";
     };
  })();



function sendForm(url){
	
	$('#result').empty().css('color', 'Red');		
	$('#country_code').val($('.select select').val());		
	$('#phone').val($('.phone-1').val() + $('.phone-2').val());
	var $result = $('.col-sm-12 .error');
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: url, //url you posting to
		data: $('.cont-form.row form').serialize(), //serialize the data in your form
		success: function (result) {
			//console.log(result);
			if ($.isArray(result)) {
				$.each(result, function (index, value) {
					if (value.Property && value.ErrorMessage) {
						$result.append(value.ErrorMessage + '<br />');
					}
				});
			}
			else if (result.SessionId != null && result.SessionId != 'undefined' && result.SessionId > 0) {
					var memberid = parseInt(result.SessionId + 357) / 589;
					$result.css('color', 'Green');
					$result.html('Successfully registered '+memberid+', redirecting');
					window.location = RedirectHost + '/autologin2/?lang='+result.Language+'&memberid='+memberid+'&bta='+ result.AffiliateId+'brandid=15';						
					return;
			}
			else {	
				$result.html(result);
			}
		},
		error: function (result) {
			console.log(result);
			console.log(result.Result.UserSessionId);
			$result.html("An error occurred, please try again");
		}
	});
}


	
function showError(err) {		
	$('.col-sm-12 .error').text(err);
}

function clearError() {
	$('.col-sm-12 .error').text('');
}
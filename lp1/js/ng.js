// angular code
(function() {
	var app = angular.module('lpApp', ['ngResource']);

	app.controller('lpController', ['$scope', 'translationService',function($scope,translationService) {

		

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


		translationService.getTranslation($scope, lang);


		$scope.country_codes = CountryCodeNames;
		$scope.country_prefixes = CountryCodePrefixes;
		$scope.landing_qs = '';
		$scope.country_code = '';
		$scope.phone_prefix = '';
		$scope.affiliate_id = function() {
			// affiliate logic here
			var affiliate_id = 0;
			var bta = qs["bta"];
			if(bta != null && bta != 'undefined' && bta > 0) {				
				affiliate_id = bta;
				$scope.landing_qs = '?bta='+ bta;
			}
			return affiliate_id;
		};
		$scope.setPrefix = function(code) {
			//console.log($scope.country_prefixes[code]);
			$scope.phone_prefix = $scope.country_prefixes[code];			
		};
	}]).service('translationService', function ($resource) {
		this.getTranslation = function($scope, language) {
	        var languageFilePath = 'translations/translation_' + language + '.json';
            $resource(languageFilePath).get(function (data) {
                $scope.translation = data;
            });
        };
	});;
}());
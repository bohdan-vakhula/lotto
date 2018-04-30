console.log("request to maxmind");
var onSuccess = function (location) {
    if(typeof location.registered_country.iso_code !== undefined) {

        var countriesPhoneCodes = {DZ:213,AD:376,AO:244,AI:1264,AG:1268,AR:54,AM:374,AW:297,AU:61,AT:43,AZ:994,BS:1242,BH:973,BD:880,BB:1246,BY:375,BE:32,BZ:501,BJ:229,BM:1441,BT:975,BO:591,BA:387,BW:267,BR:55,BN:673,BG:359,BF:226,BI:257,KH:855,CM:237,CA:1,CV:238,KY:1345,CF:236,CL:56,CN:86,CO:57,KM:269,CG:242,CK:682,CR:506,HR:385,CU:53,CY:90392,CZ:42,DK:45,DJ:253,DM:1809,DO:1809,EC:593,EG:20,SV:503,GQ:240,ER:291,EE:372,ET:251,FK:500,FO:298,FJ:679,FI:358,FR:33,GF:594,PF:689,GA:241,GM:220,GE:7880,DE:49,GH:233,GI:350,GR:30,GL:299,GD:1473,GP:590,GU:671,GT:502,GN:224,GW:245,GY:592,HT:509,HN:504,HK:852,HU:36,IS:354,IN:91,ID:62,IR:98,IQ:964,IE:353,IL:972,IT:39,JM:1876,JP:81,JO:962,KZ:7,KE:254,KI:686,KP:850,KR:82,KW:965,KG:996,LA:856,LV:371,LB:961,LS:266,LR:231,LY:218,LI:417,LT:370,LU:352,MO:853,MK:389,MG:261,MW:265,MY:60,MV:960,ML:223,MT:356,MH:692,MQ:596,MR:222,YT:269,MX:52,FM:691,MD:373,MC:377,MN:976,MS:1664,MA:212,MZ:258,MM:95,NA:264,NR:674,MP:977,NL:31,NC:687,NZ:64,NI:505,NE:227,NG:234,NU:683,NF:672,NP:670,NO:47,OM:968,PW:680,PA:507,PG:675,PY:595,PE:51,PH:63,PL:48,PT:351,PR:1787,QA:974,RE:262,RO:40,RU:7,RW:250,SM:378,ST:239,SA:966,SN:221,CS:381,SC:248,SL:232,SG:65,SK:421,SI:386,SB:677,SO:252,ZA:27,ES:34,LK:94,SH:290,KN:1869,LC:1758,SD:249,SR:597,SZ:268,SE:46,CH:41,SY:963,TW:886,TJ:7,TH:66,TG:228,TO:676,TT:1868,TN:216,TR:90,TM:993,TC:1649,TV:688,UG:256,GB:44,UA:380,AE:971,UY:598,US:1,UZ:7,VU:678,VA:379,VE:58,VN:84,VG:84,VI:84,WF:681,YE:969,ZM:260,ZW:263};

        if (jQuery('input[name=phone]').val() == '') {
            jQuery('input[name=phone]').val(countriesPhoneCodes[location.registered_country.iso_code]);
        }

        jQuery.ajax({
            type: "POST",
            url: CONFIG.adminURL,
            data: "action=set_country_code&geoipdata=" + location.registered_country.iso_code,
            dataType: 'json'
        })
    }
};

var onError = function (error) {
    console.log(JSON.stringify(error, undefined, 4));
};

geoip2.country(onSuccess, onError);
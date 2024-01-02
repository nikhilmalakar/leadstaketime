<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Puerto Premium Survey 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤  Whatsapp: +212 654 211 360                ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 10/02/2022                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

include __DIR__."/configs.php";


switch ($pg) {
	case 'pages':       include __DIR__."/files/pages.php"; break;
	case 'plans':       include __DIR__."/files/plans.php"; break;
	case 'userdetails': include __DIR__."/files/userdetails.php"; break;
	case 'mysurveys':   include __DIR__."/files/mysurvies.php"; break;
	case 'editor':      include __DIR__."/files/editor.php"; break;
	case 'survey':      include __DIR__."/files/survey.php"; break;
	case 'responses':   include __DIR__."/files/responses.php"; break;
	case 'report':      include __DIR__."/files/rapport.php"; break;
	case 'payment':     include __DIR__."/files/payment.php"; break;

	default:
		if(site_landing){
			include __DIR__."/files/home.php";
		} else {
			include __DIR__."/files/mysurvies.php";
		}
	break;
}

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
#	¤  Last Update: 13/09/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

# Header Page
include __DIR__.'/files/header.php';

# Main Page
if(!us_level):

	if(isset($_REQUEST['oauth_token']) && $_SESSION['token']  !== $_REQUEST['oauth_token']) {
		session_destroy();
		fh_go(path);
	} elseif(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {
		$connection = new TwitterOAuth(twConKey, twConSecret, $_SESSION['token'] , $_SESSION['token_secret']);
		$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
		if($connection->http_code == '200'){
			$_SESSION['status'] = 'verified';
			$_SESSION['request_vars'] = $access_token;
			$profile = $connection->get('account/verify_credentials');

			fh_social_login( 'twitter', $profile );

			unset($_SESSION['token']);
			unset($_SESSION['token_secret']);
		} else {
			echo fh_alerts("error, try again later!");
		}
	} else {
		if(isset($_GET["denied"])){
			fh_go(path);
			die();
		}
		$connection = new TwitterOAuth(twConKey, twConSecret);
		$request_token = $connection->getRequestToken(twOauthCallback);
		$_SESSION['token'] 			= $request_token['oauth_token'];
		$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];
		if($connection->http_code == '200') {
			$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
			echo '<div class="padding"><div class="pt-twitterbox"><div><i class="fas fa-spinner fa-pulse"></i></div> Redirecting you to the application.<br>This may take a few moments.</div></div>';
			fh_go($twitter_url,2);
		} else{
			echo fh_alerts("error connecting to twitter! try again later!");
		}
	}
else:
	echo fh_alerts($lang['alerts']['permission']);
endif;

$sidebar = false;

# Footer Page
include __DIR__.'/files/footer.php';

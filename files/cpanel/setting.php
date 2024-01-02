<div class="pt-body">
	<div class="pt-title">
		<h3><?=$lang['dashboard']['set_title']?></h3>
	</div>
	<form class="pt-sendsettings">
	<div class="pt-admin-setting">

		<ul class="nav nav-tabs">
			<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#General">General</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Landing">Landing Page</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Colors">Colors</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Socails">Socails login</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Ads">Ads</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Payments">Payments</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#SMTP">SMTP</a></li>
	  </ul>

		<div class="tab-content">
	    <div id="General" class="container active tab-pane pt-tab2"><br />

				<div class="form-row">
					<div class="col">
						<div class="form-group">
							<label>Logo (204x48)</label>
							<div class="file-upload">
								<div class="file-select">
									<div class="file-select-button" id="fileName2"><?=$lang['details']['image_c']?></div>
									<div class="file-select-name" id="noFile2"><?=$lang['details']['image_n']?></div>
									<input type="file" name="chooseFile" id="chooseFile2">
								</div>
							</div>
							<input type="hidden" name="site_logo" rel="#chooseFile2" value="<?=site_logo?>">
							<div id="thumbnails2"><img src="<?=path?>/<?=site_logo?>" onerror="this.src='<?=nophoto?>'" class="nophoto" /></div>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label>Favicon</label>
							<div class="file-upload">
								<div class="file-select">
									<div class="file-select-button" id="fileName1"><?=$lang['details']['image_c']?></div>
									<div class="file-select-name" id="noFile1"><?=$lang['details']['image_n']?></div>
									<input type="file" name="chooseFile" id="chooseFile1">
								</div>
							</div>
							<input type="hidden" name="site_favicon" rel="#chooseFile1" value="<?=site_favicon?>">
							<div id="thumbnails1"><img src="<?=path?>/<?=site_favicon?>" onerror="this.src='<?=nophoto?>'" class="nophoto" /></div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label><?=$lang['dashboard']['set_stitle']?></label>
					<input type="text" name="site_title" value="<?=site_title?>">
				</div>
				<div class="form-group">
					<label><?=$lang['dashboard']['set_keys']?></label>
					<input type="text" name="site_keywords" value="<?=site_keywords?>">
				</div>
				<div class="form-group">
					<label><?=$lang['dashboard']['set_desc']?></label>
					<textarea name="site_description"><?=site_description?></textarea>
				</div>
				<div class="form-group">
					<label><?=$lang['dashboard']['set_url']?></label>
					<input type="text" name="site_url" value="<?=site_url?>">
				</div>
				<div class="form-group">
					<label>Site Email</label>
					<input type="text" name="site_email" value="<?=site_email?>">
				</div>
				<div class="form-group">
					<label>Site phone</label>
					<input type="text" name="site_phone" value="<?=site_phone?>">
				</div>

				<div class="form-group">
					<label><?=$lang['dashboard']['set_noreply']?></label>
					<input type="text" name="site_noreply" value="<?=site_noreply?>">
				</div>
				<div class="form-group">
					<label>Phone form</label>
					<input type="text" name="site_phonemask" value="<?=site_phonemask?>">
				</div>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb1" value="1" name="site_register" type="checkbox"<?=(site_register ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb1"></label>
					<label><?=$lang['dashboard']['set_register']?></label>
				</div>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb6c1" value="1" name="site_onlyadmins" type="checkbox"<?=(site_onlyadmins ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb6c1"></label>
					<label>Members and visitors cannot create surveys (Only the administrator)</label>
				</div>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb6c2" value="1" name="site_onlymembers" type="checkbox"<?=(site_onlymembers ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb6c2"></label>
					<label>Visitors cannot answer surveys (only members)</label>
				</div>

				<div class="form-row">
					<div class="col form-group">
						<label>Facebook</label>
						<input type="text" name="site_facebook" placeholder="Facebook ID" value="<?=site_facebook?>">
					</div>
					<div class="col form-group">
						<label>Twitter</label>
						<input type="text" name="site_twitter" placeholder="Twitter ID" value="<?=site_twitter?>">
					</div>
					<div class="col form-group">
						<label>Instagram</label>
						<input type="text" name="site_instagram" placeholder="Instagram ID" value="<?=site_instagram?>">
					</div>
					<div class="col form-group">
						<label>Youtube</label>
						<input type="text" name="site_youtube" placeholder="Youtube ID" value="<?=site_youtube?>">
					</div>
					<div class="col form-group">
						<label>Skype</label>
						<input type="text" name="site_skype" placeholder="Skype ID" value="<?=site_skype?>">
					</div>
				</div>

				<hr />
				<div class="form-group">
					<label>Google Analytics</label>
					<input type="text" name="google_analytics" placeholder="Google Analytics" value="<?=google_analytics?>">
				</div>

				<hr />

				<div class="form-group">
					<label>Send Survey Email Template</label>
					<textarea name="site_sendsurveyemail" id="wysibb-editor3"><?php echo site_sendsurveyemail ?></textarea>
				</div>


	    </div>



	    <div id="Landing" class="container tab-pane pt-tab2"><br />


				<div class="form-group">
					<input class="tgl tgl-light" id="sb1" value="1" name="site_landing" type="checkbox"<?=(site_landing ? ' checked' : '')?>/>
					<label class="tgl-btn" for="sb1"></label>
					<label>Landing page</label>
				</div>

				<div class="form-group">
					<input class="tgl tgl-light" id="show_allsurveys" value="1" name="show_allsurveys" type="checkbox"<?=(show_allsurveys ? ' checked' : '')?>/>
					<label class="tgl-btn" for="show_allsurveys"></label>
					<label>Show all surveys in header menu</label>
				</div>


						<h3 class="cp-form-title">HOME PAGE</h3>

						<div class="form-group">
							<input class="tgl tgl-light" id="cb6c" value="1" name="site_hidetopbar" type="checkbox"<?=(site_hidetopbar ? ' checked' : '')?>/>
							<label class="tgl-btn" for="cb6c"></label>
							<label>Hide top bar</label>
						</div>
						<div class="form-group">
							<label>privacy link </label>
							<input type="text" name="privacy_link" placeholder="privacy link" value="<?=privacy_link?>">
						</div>
						<div class="form-group">
							<label>terms link </label>
							<input type="text" name="terms_link" placeholder="terms link" value="<?=terms_link?>">
						</div>
						<div class="form-group">
							<label>support link </label>
							<input type="text" name="support_link" placeholder="support link" value="<?=support_link?>">
						</div>
						<div class="form-group">
							<label>feature link 1</label>
							<input type="text" name="feature_link1" placeholder="feature link 1" value="<?=feature_link1?>">
						</div>
						<div class="form-group">
							<label>feature link 2</label>
							<input type="text" name="feature_link2" placeholder="feature link 2" value="<?=feature_link2?>">
						</div>
						<div class="form-group">
							<label>feature link 3</label>
							<input type="text" name="feature_link3" placeholder="feature link 3" value="<?=feature_link3?>">
						</div>
						<div class="form-group">
							<label>feature link 4</label>
							<input type="text" name="feature_link4" placeholder="feature link 4" value="<?=feature_link4?>">
						</div>
						<div class="form-group">
							<label>phone iFrame link</label>
							<input type="text" name="iframe_link" placeholder="phone iFrame link" value="<?=iframe_link?>">
						</div>


	    </div>




	    <div id="Colors" class="container tab-pane pt-tab2"><br />


				<div class="form-group">
					<label class="float-left mr-3">links </label>
					<input type="text" name="site_colors[a]" id="colorpicker-popup" value="<?=($SITE_COLORS['a'] ?? '#5385f1')?>">
				</div>

				<div class="form-group">
					<label class="float-left mr-3">Body BG </label>
					<input type="text" name="site_colors[body]" id="colorpicker-popup" value="<?=($SITE_COLORS['body'] ?? '#f2f3f7')?>">
				</div>

				<div class="form-group">
					<label class="float-left mr-3">Header BG </label>
					<input type="text" name="site_colors[header]" id="colorpicker-popup" value="<?=($SITE_COLORS['header'] ?? '#38395f')?>">
				</div>

				<div class="form-group">
					<label class="float-left mr-3">Top Header BG </label>
					<input type="text" name="site_colors[header_t]" id="colorpicker-popup" value="<?=($SITE_COLORS['header_t'] ?? '#2a2b4a')?>">
				</div>

				<div class="form-group">
					<label class="float-left mr-3">Top Menu BG </label>
					<input type="text" name="site_colors[header_m]" id="colorpicker-popup" value="<?=($SITE_COLORS['header_m'] ?? '#22233e')?>">
				</div>
				<div class="form-group">
					<label class="float-left mr-3">Plans </label>
					<input type="text" name="site_colors[plans]" id="colorpicker-popup" value="<?=($SITE_COLORS['plans'] ?? '#5f90fa')?>">
				</div>

				<!-- <div class="form-group">
					<label class="float-left mr-3">Footer link </label>
					<input type="text" name="site_colors[footer_a]" id="colorpicker-popup" value="<?=($SITE_COLORS['footer_a'] ?? '')?>">
				</div> -->


				<h3 class="cp-form-title">Landing Page</h3>
				<div class="form-group">
					<label class="float-left mr-3">Body BG </label>
					<input type="text" name="site_colors[body_h]" id="colorpicker-popup" value="<?=($SITE_COLORS['body_h'] ?? '#FFF')?>">
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 1: &nbsp;&nbsp;&nbsp; BG </label>
						<input type="text" name="site_colors[home_a1]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a1'] ?? '#fba70c')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG Hover </label>
						<input type="text" name="site_colors[home_a1_h]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a1_h'] ?? '#FFF')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">Text </label>
						<input type="text" name="site_colors[home_a1_c]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a1_c'] ?? '#FFF')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 2: &nbsp;&nbsp;&nbsp; BG </label>
						<input type="text" name="site_colors[home_a2]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a2'] ?? '#1bce5b')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">Text </label>
						<input type="text" name="site_colors[home_a2_c]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a2_c'] ?? '#FFF')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 3: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[home_a3_1]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a3_1'] ?? '#5845b9')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[home_a3_2]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a3_2'] ?? '#453497')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">Text </label>
						<input type="text" name="site_colors[home_a3_c]" id="colorpicker-popup" value="<?=($SITE_COLORS['home_a3_c'] ?? '#FFF')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Feature: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[features1]" id="colorpicker-popup" value="<?=($SITE_COLORS['features1'] ?? '#281a65')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[features2]" id="colorpicker-popup" value="<?=($SITE_COLORS['features2'] ?? '#7761ee')?>">
					</div>
				</div>


				<h3 class="cp-form-title">Buttons</h3>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 1: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[btn1]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn1'] ?? '#3f79fc')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[btn2]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn2'] ?? '#6694fa')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">Text </label>
						<input type="text" name="site_colors[btn1_c]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn1_c'] ?? '#FFF')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 3: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[btn3_1]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn3_1'] ?? '#fc3f59')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[btn3_2]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn3_2'] ?? '#fa667a')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 4: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[btn4_1]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn4_1'] ?? '#07b81e')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[btn4_2]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn4_2'] ?? '#2ee934')?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-3 form-group">
						<label class="float-left mr-3">Button 5: &nbsp;&nbsp;&nbsp; BG 1 </label>
						<input type="text" name="site_colors[btn5_1]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn5_1'] ?? '#2e62d2')?>">
					</div>
					<div class="col-3 form-group">
						<label class="float-left mr-3">BG 2 </label>
						<input type="text" name="site_colors[btn5_2]" id="colorpicker-popup" value="<?=($SITE_COLORS['btn5_2'] ?? '#5f90fa')?>">
					</div>
				</div>



	    </div>



	    <div id="Payments" class="container tab-pane pt-tab2">


				<h3 class="cp-form-title">Paypal</h3>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb5" value="1" name="site_paypal_live" type="checkbox"<?=(site_paypal_live ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb5"></label>
					<label>Live</label>
				</div>
				<div class="form-row">
					<div class="col-6 form-group">
						<label>Paypal id</label>
						<input type="text" name="site_paypal_id" placeholder="Paypal id" value="<?=site_paypal_id?>">
					</div>
					<div class="col form-group">
						<label>Paypal Currency</label>
						<input type="text" name="site_currency_name" placeholder="Currency name" value="<?=site_currency_name?>">
					</div>
					<div class="col form-group">
						<label>Currency Symbol</label>
						<input type="text" name="site_currency_symbol" placeholder="Currency Symbol" value="<?=site_currency_symbol?>">
					</div>
				</div>



	    </div>



	    <div id="SMTP" class="container tab-pane pt-tab2">



				<h3 class="cp-form-title">PHPMAILER SMTP</h3>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb6" value="1" name="site_smtp" type="checkbox"<?=(site_smtp ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb6"></label>
					<label>is SMTP</label>
				</div>
				<div class="form-row">
					<div class="col form-group">
						<label>Host</label>
						<input type="text" name="site_smtp_host" placeholder="SMTP Host" value="<?=site_smtp_host?>">
					</div>
					<div class="col form-group">
						<label>Username</label>
						<input type="text" name="site_smtp_username" placeholder="SMTP Username" value="<?=site_smtp_username?>">
					</div>
					<div class="col form-group">
						<label>Password</label>
						<input type="password" name="site_smtp_password" placeholder="SMTP Password" value="<?=site_smtp_password?>">
					</div>
					<div class="col form-group">
						<label>Port</label>
						<input type="text" name="site_smtp_port" placeholder="SMTP Port" value="<?=site_smtp_port?>">
					</div>
					<div class="col form-group">
						<label>Auth</label>
						<select name="site_smtp_auth">
							<option value="0" <?=(site_smtp_auth=='0'?'selected':'')?>>False</option>
							<option value="1" <?=(site_smtp_auth=='1'?'selected':'')?>>True</option>
						</select>
					</div>
					<div class="col form-group">
						<label>Encryption</label>
						<select name="site_smtp_encryption">
							<option value="none" <?=(site_smtp_encryption=='none'?'selected':'')?>>None</option>
							<option value="tls" <?=(site_smtp_encryption=='tls'?'selected':'')?>>TLS</option>
						</select>
					</div>
				</div>



	    </div>




	    <div id="Socails" class="container tab-pane pt-tab2">


				<h3 class="cp-form-title">Facebook login</h3>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb2" value="1" name="login_facebook" type="checkbox"<?=(login_facebook ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb2"></label>
					<label>Facebook Login</label>
				</div>
				<div class="form-row">
					<div class="col-5 form-group">
						<label>App id</label>
						<input type="text" name="login_fbAppId" placeholder="Facebook App Id" value="<?=login_fbAppId?>">
					</div>
					<div class="col-5 form-group">
						<label>App secret</label>
						<input type="password" name="login_fbAppSecret" placeholder="Facebook app secret" value="<?=login_fbAppSecret?>">
					</div>
					<div class="col form-group">
						<label>App version</label>
						<input type="text" name="login_fbAppVersion" placeholder="Facebook app version" value="<?=login_fbAppVersion?>">
					</div>
				</div>
				<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-facebook.php</b></p>

				<h3 class="cp-form-title">Twitter login</h3>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb3" value="1" name="login_twitter" type="checkbox"<?=(login_twitter ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb3"></label>
					<label>Twitter Login</label>
				</div>
				<div class="form-row">
					<div class="col form-group">
						<label>App Key</label>
						<input type="text" name="login_twConKey" placeholder="Twitter App Key" value="<?=login_twConKey?>">
					</div>
					<div class="col form-group">
						<label>App secret</label>
						<input type="password" name="login_twConSecret" placeholder="Twitter App Secret" value="<?=login_twConSecret?>">
					</div>
				</div>
				<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-twitter.php</b></p>

				<h3 class="cp-form-title">Google login</h3>
				<div class="form-group">
					<input class="tgl tgl-light" id="cb4" value="1" name="login_google" type="checkbox"<?=(login_google ? ' checked' : '')?>/>
					<label class="tgl-btn" for="cb4"></label>
					<label>Google Login</label>
				</div>
				<div class="form-row">
					<div class="col form-group">
						<label>Client id</label>
						<input type="text" name="login_ggClientId" placeholder="Google client id" value="<?=login_ggClientId?>">
					</div>
					<div class="col form-group">
						<label>Client secret</label>
						<input type="password" name="login_ggClientSecret" placeholder="Google client Secret" value="<?=login_ggClientSecret?>">
					</div>
				</div>
				<p><i class="fas fa-exclamation-triangle"></i> The Redirect Url: <b><?=path?>/login-google.php</b></p>



	    </div>

	    <div id="Ads" class="container tab-pane pt-tab2"><br />


				<div class="form-group">
					<label>Header Ads (728x90)</label>
					<textarea name="site_ads_header" placeholder="header ads"><?=site_ads_header?></textarea>
				</div>
				<div class="form-group">
					<label>Footer Ads (851x315)</label>
					<textarea name="site_ads_footer" placeholder="footer ads"><?=site_ads_footer?></textarea>
				</div>
				<div class="form-group">
					<label>Survey Ads</label>
					<textarea name="site_ads_survey" placeholder="survey ads"><?=site_ads_survey?></textarea>
				</div>



	    </div>
    </div>





		<div class="pt-link">
			<button type="submit" class="fancy-button bg-gradient5">
				<span><?=$lang['dashboard']['set_btn']?> <i class="fas fa-arrow-circle-right"></i></span>
			</button>
		</div>
	</div>

	</form>
</div>


--
-- Base de données : `2023_puertosurvey_v1_null`
--

-- --------------------------------------------------------

--
-- Structure de la table `puerto_answers`
--

CREATE TABLE `puerto_answers` (
  `id` int(11) NOT NULL,
  `title` text,
  `date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `author` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `survey` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `step` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `question` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `question_id` int(11) DEFAULT '0',
  `type` varchar(50) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `responses` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `lastresponse` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_configs`
--

CREATE TABLE `puerto_configs` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `variable` varchar(255) DEFAULT NULL,
  `value` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `puerto_configs`
--

INSERT INTO `puerto_configs` (`id`, `variable`, `value`) VALUES
(1, 'site_title', 'Puerto Premium Survey'),
(2, 'site_url', 'puertokhalid.com'),
(3, 'site_description', 'Creating surveys and polls should be simple and fast.\r\nYou have things to get done. You need info to do them well. Puerto Premium Survey is the way to a survey or poll in minutes. A simple tool, but surprisingly powerful.'),
(4, 'site_keywords', 'survey, vote, poll, voting, puerto, surveys, puerto survey, codecanyon, php script'),
(5, 'site_author', 'Puerto Khalid'),
(6, 'site_register', '1'),
(7, 'site_plans', '0'),
(8, 'site_forget', '1'),
(10, 'site_noreply', 'donotreply@puertokhalid.com'),
(12, 'login_facebook', '1'),
(13, 'login_twitter', '1'),
(14, 'login_google', '1'),
(15, 'login_fbAppId', ''),
(16, 'login_fbAppSecret', ''),
(17, 'login_fbAppVersion', ''),
(18, 'login_twConKey', ''),
(19, 'login_twConSecret', ''),
(20, 'login_ggClientId', ''),
(21, 'login_ggClientSecret', ''),
(22, 'site_paypal_id', ''),
(23, 'site_paypal_live', '0'),
(24, 'site_currency_symbol', '$'),
(25, 'site_currency_name', 'USD'),
(26, 'site_smtp', '1'),
(27, 'site_smtp_host', 'smtp1.example.com'),
(28, 'site_smtp_username', 'user@example.com'),
(29, 'site_smtp_password', ''),
(30, 'site_smtp_encryption', 'tls'),
(31, 'site_smtp_port', '587'),
(32, 'site_smtp_auth', '1'),
(33, 'site_country', 'US'),
(34, 'site_landing', '1'),
(35, 'site_facebook', 'prof.puertokhalid'),
(36, 'site_instagram', 'khalidpuerto'),
(37, 'site_twitter', ''),
(38, 'site_youtube', ''),
(39, 'site_skype', ''),
(40, 'site_logo', 'assets/img/logo3.png'),
(41, 'site_favicon', 'assets/img/fav.png'),
(42, 'site_ads_header', ''),
(43, 'site_ads_footer', ''),
(44, 'site_ads_survey', ''),
(45, 'google_analytics', 'google analytics'),
(46, 'site_hidetopbar', '0'),
(47, 'feature_link1', '1'),
(48, 'feature_link2', '1'),
(49, 'feature_link3', '1'),
(50, 'feature_link4', '1'),
(51, 'iframe_link', '1'),
(52, 'site_email', 'support@company.com'),
(53, 'site_phone', '(+1) 987 654 3210'),
(54, 'support_link', NULL),
(55, 'privacy_link', NULL),
(56, 'terms_link', NULL),
(57, 'site_onlymembers', '0'),
(58, 'site_onlyadmins', '0'),
(59, 'site_sendsurveyemail', ''),
(60, 'site_phonemask', '000-000-0000'),
(61, 'site_colors', NULL),
(62, 'show_allsurveys', '1');

-- --------------------------------------------------------

--
-- Structure de la table `puerto_languages`
--

CREATE TABLE `puerto_languages` (
  `id` int(11) NOT NULL,
  `language` varchar(100) DEFAULT NULL,
  `short` varchar(4) DEFAULT NULL,
  `isdefault` tinyint(1) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `content` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `puerto_languages`
--

INSERT INTO `puerto_languages` (`id`, `language`, `short`, `isdefault`, `created_at`, `updated_at`, `content`) VALUES
(1, 'English', 'us', 1, 1634381925, 1658420628, '{\"rtl\":\"rtl_false\",\"lang\":\"en\",\"close\":\"Close\",\"confirm\":\"Confirm\",\"loading\":\"Loading...\",\"created\":\"Created at\",\"updated\":\"Updated at\",\"error\":\"Error!\",\"success\":\"Success!\",\"nofile\":\"No file chosen!\",\"next\":\"Next\",\"finish\":\"Finish\",\"previous\":\"Previous\",\"required\":\"Required!\",\"notalllikely\":\"Not at all likely\",\"neutral\":\"Neutral\",\"exlikely\":\"Extremely likely\",\"second\":\"second\",\"minute\":\"minute\",\"hour\":\"hour\",\"day\":\"day\",\"week\":\"week\",\"month\":\"month\",\"year\":\"year\",\"decade\":\"decade\",\"ago\":\"ago\",\"home\":{\"home\":\"Home\",\"login\":\"Login\",\"support\":\"Support & FAQs\",\"get\":\"Get Started\",\"s_h\":\"Easily build & create surveys,{br}quistionaires and polls..\",\"s_p\":\"Build on top of Forms the Pro version helps you capture and analyze feedback to improve how you engage across your business with this simple, yet comprehensive survey solution.\",\"s_b\":\"Get Started for FREE\",\"sf_h\":\"Grow Your Brand With Every Click\",\"sf_p\":\"Build on top of Forms the Pro version helps you capture and analyze feedback to improve how you engage across your business with this simple, yet comprehensive survey solution.\",\"sf_b\":\"LEARN MORE\",\"sf_h1\":\"Inspire trust\",\"sf_p1\":\"As your click numbers go up, your brand recognition increases. And the more that grows, the more confident people become in the integrity of your content and communications.\",\"sf_h2\":\"Boost results\",\"sf_p2\":\"Better deliverability and improved click-through are just the start. Rich link-level data allows you to understand who is clicking your links, as well as when and where, so you can make smarter .\",\"sf_h3\":\"Gain control\",\"sf_p3\":\"On top of being able to fully customize your links, auto-branding boosts awareness of your brand by giving you credit for your content and more insight into how it’s being consumed.\",\"sf_h4\":\"Big Data Analysis\",\"sf_p4\":\"Lorem ipsum dolor sit amet adicing elit maecenas sa faubus mollis interdum, decisions around the content and communications you share, amet adicing elit maecenas sa faubus mollis.\",\"link1\":\"Choose a plan\",\"link2\":\"Get Started\",\"stats_h1\":\"TOTAL Surveys CREATED\",\"stats_h2\":\"TOTAL Surveys Responses\",\"stats_h3\":\"TOTAL Users Sign up\",\"top_h\":\"Our Top Surveys\",\"top_p\":\"Branded links can drive a 34% higher click-through versus non-branded links, meaning they help get more eyeballs on your brand and its content.\",\"rel\":\"Responses - Last one:\",\"integ_h\":\"Integrate Your Survey Every Where\",\"integ_p\":\"Branded links can drive a 34% higher click-through versus non-branded links, meaning they help get more eyeballs on your brand and its content.\",\"flinks\":\"Links\",\"privacy\":\"Privacy policy\",\"terms\":\"Terms of uses\",\"login2\":\"OR login using social media\",\"accepting\":\"By clicking in \'Sign up\' button you are automaticly accepting in our {link_privacy} and {link_terms}!\",\"cookie1\":\"We use cookies/targeted advertising to ensure you have the best experience on our site. If you continue to use our site, we will assume that you agree to their use. For more information, please see our {link_privacy} and {link_terms}.\",\"cookie2\":\"Accept all\",\"cookie3\":\"Configuring choices\",\"cookie4\":\"Save choices\",\"cookie5\":\"Allow access to geolocation data\",\"cookie6\":\"Allow personalised ads and content, ad measurement and audience analysis\",\"cookie7\":\"Storing and/or accessing information on a device\",\"copyright\":\"Copyright &copy; 2022 {link}. All Rights Reserved.\"},\"editor\":{\"radio\":\"Radio Button\",\"checkbox\":\"Check Box\",\"input\":\"Text Input\",\"text\":\"Descriptive Text\",\"dropdown\":\"Dropdown Selector\",\"textarea\":\"Text Area\",\"image\":\"Image\",\"rating\":\"Rating Scale\",\"date\":\"Calendar\",\"phone\":\"Phone Number\",\"country\":\"Country\",\"email\":\"Email\",\"break\":\"Break Page\",\"scale\":\"Likert scale\",\"file\":\"Attachment\",\"edit\":\"Edit survey\",\"create\":\"Create new survey\",\"title\":\"Survey Title\",\"sdate\":\"Survey Start Date\",\"edate\":\"Survey End Date\",\"url\":\"Redirect Url\",\"url_i\":\"When the taker end the survey, the system will rederect it to the URL you put.\",\"pass\":\"Survey Password\",\"pass_i\":\"Only people with password can take this survey.\",\"private\":\"This surevey is private (Takes only by URL)\",\"private_i\":\"people can\'t find this survey from this site it only can token by url.\",\"single\":\"Single page\",\"single_i\":\"Only one page view.\",\"ip\":\"IP Restriction\",\"ip_i\":\"People with same ip can\'t take the survey.\",\"form\":\"Questionaire\",\"preview\":\"Preview\",\"logics\":\"Logics\",\"logics_i\":\"You must save the survey first.\",\"options\":\"Options\",\"unpublished\":\"Unpublished\",\"unpublished_i\":\"The survey still incomplete, no one can view it or take it.\",\"save\":\"Save Survey\",\"nofound\":\"No questions founds!\",\"share\":\"Share button\",\"send_email\":\"Send email when finishing\",\"send_email_i\":\"You need to have an email question in the survey.\",\"page\":\"Page\",\"q\":\"Q\",\"question\":\"Your question\",\"desc\":\"Your question brief description (optional)\",\"icon\":\"Choose an icon\",\"icons\":\"Number of icons\",\"ftype\":\"File type\",\"zip\":\"Zip\",\"rar\":\"Rar\",\"new_qre\":\"Required question to answer\",\"new_qln\":\"As Rows (horizontal view)\",\"rows\":\"Number of rows (min 2 max 8)\",\"answers\":\"Answers\",\"new\":\"New\",\"answer\":\"Your Answer\",\"bbcode\":\"BBCodes are allowed (Exemple: [B][/B], [P][/P], [H1][/H1]...)\",\"change\":\"Change Image\",\"drag\":\"Drag & Drop your questions here!\",\"qchoose\":\"Choose a question...\",\"add\":\"add\",\"design\":\"Design\",\"design_bs\":\"Button shadow:\",\"design_bb\":\"Button style\",\"design_bc\":\"Button border color\",\"design_si\":\"Size\",\"design_s\":\"Style\",\"design_c\":\"Color\",\"design_btg\":\"Button background style\",\"design_btg1\":\"Button 1 background\",\"design_btg2\":\"Button 2 background\",\"design_g\":\"Gradient\",\"design_n\":\"Normal\",\"design_btc\":\"Button text color\",\"design_sbg\":\"Survey background\",\"design_stbg\":\"Label background\",\"design_ibg\":\"Input background\",\"design_yes\":\"Yes\",\"design_no\":\"No\"},\"survey\":{\"close_h\":\"This survey is currently closed.\",\"close_p\":\"Want to create your own survey?\",\"button\":\"SIGN UP FREE\",\"back\":\"Back\",\"next\":\"Next\",\"passh\":\"Please enter the survey password\",\"passp\":\"This survey is protected by password!\",\"pass\":\"Survey Password\",\"passbtn\":\"Submit\",\"share\":\"Share\",\"facebook\":\"Via Facebook\",\"twitter\":\"Via Twitter\",\"email\":\"Via Email\",\"whatsapp\":\"Via Whatsapp\",\"button1\":\"Submit your answers\",\"upattash\":\"Upload your Attachment (we only accept: \",\"upattashalr\":\"already uploaded\",\"choose\":\"Choose one of the following...\"},\"login\":{\"username\":\"Your Username or Email\",\"password\":\"Your Password\",\"keep\":\"Keep me logged in\",\"button\":\"Sign In\",\"footer\":\"You don\'t have an account?\",\"footer_l\":\"Sign up FREE\"},\"signup\":{\"username\":\"Your Username\",\"password\":\"Your Password\",\"email\":\"Your Email\",\"button\":\"Sign Up\",\"footer\":\"Do you have an account?\",\"footer_l\":\"Sign in\"},\"menu\":{\"home\":\"Home\",\"forms\":\"All Surveys\",\"my\":\"My Surveys\",\"about\":\"About us\",\"plans\":\"Plans\",\"welcome\":\"Welcome\",\"new\":\"New Survey\",\"admin\":\"Administration\",\"info\":\"Manage Info\",\"logout\":\"Logout\",\"signin\":\"Sign in\"},\"details\":{\"title\":\"Manage infos:\",\"firstname\":\"Your first name\",\"lastname\":\"Your last name\",\"username\":\"Edit Username\",\"password\":\"Edit Password\",\"email\":\"Edit Email\",\"gender\":\"Gender\",\"yourplan\":\"You are in\",\"freeplan\":\"Free plan\",\"plan\":\"Plan\",\"male\":\"Male\",\"female\":\"Female\",\"country\":\"Country\",\"state\":\"State/Region\",\"city\":\"City\",\"address\":\"Full Address\",\"image_n\":\"No image chosen...\",\"image_c\":\"Choose Image\",\"button\":\"Save info\"},\"alerts\":{\"no-data\":\"No data found!\",\"permission\":\"You can\'t access to this page because you have to upgrade your plan!\",\"wrong\":\"Something went wrong!\",\"required\":\"All fields marked with * are required!\",\"logout\":\"are you sure you want to logout?\",\"danger\":\"Oh snap!\",\"success\":\"Well done!\",\"warning\":\"Warning!\",\"info\":\"Heads up!\",\"requiredanswer\":\"required to answer!\",\"alldone\":\"all done successfully.\",\"loginrequired\":\"You left username or password empty!\",\"loginmoderat\":\"Membership has been banned by admin, if you think this is a mistak please feel free to contact us.\",\"loginactivation\":\"Membership need email activation.\",\"loginapprove\":\"Membership need to be approved by administration.\",\"loginsuccess\":\"You are logged in successfully, We wish you having good times.\",\"loginsocial\":\"There is a problem with your social ID, the username you want to login with is not yours or already exist with a different social ID!\",\"loginerror\":\"Username or password is not available!\",\"signupchar_username\":\"The username must contain only letters!\",\"signuplimited_username\":\"The Username must be limited between 3 and 15 characters!\",\"signupexist_username\":\"Username is already exists!\",\"signuplimited_pass\":\"The Password must be limited between 6 and 12 characters!\",\"signuprepass\":\"Re-password is Must match with the password!\",\"signupcheck_email\":\"Please input a valid e-mail!\",\"signupexist_email\":\"E-mail Address is already exists!\",\"signupbirth\":\"Your birth date need to be between <b>1-1-2005</b> and <b>1-1-1942</b>!\",\"signupsuccess\":\"Registration process has ended successfully.\",\"signupsuccess1\":\"Registration process has ended successfully. But, still need approved by administration.\",\"signupsuccess2\":\"Registration process has ended successfully. But, still need activate by email.\",\"signuperror\":\"Username or password is not available!\",\"planssuccess\":\"Your payments has been calculated!\",\"wrongpass\":\"Wrong password.\",\"surveyerror\":\"Error! Some survey fields are required!\",\"surveyerror1\":\"Error! you already take the survey!\",\"surveyerror2\":\"Error! Some survey answers are required!\",\"surveyjust\":\"you just created the same survey!\",\"surveyurl\":\"You need to put a valid url\",\"surveypass\":\"The password must more than 8 charachters!\",\"surveyquestion\":\"The question must be not empty!\",\"surveyanswers\":\"The answers must be not empty!\",\"surveydone\":\"all survey data saved succesfully\",\"surveynoq\":\"There is no questions!\",\"fileready\":\"The file is ready to download.\",\"pconfirm\":\"Please confirm!\",\"delete\":\"Are you sure you want to delete?\",\"uban\":\"Are you sure you want to {var} this user?\",\"maxsteps\":\"max steps\",\"maxquestion\":\"max question\",\"maxanswers\":\"max answers\",\"unactive\":\"ban/unactive\",\"activate\":\"activate\"},\"report\":{\"rtitle\":\"My Survey Responses\",\"btn_1\":\"See Rapport\",\"download\":\"Download file\",\"title\":\"My Survey Rapport\",\"btn1\":\"Create Survey\",\"btn2\":\"Edit Survey\",\"btn3\":\"Export .csv\",\"stats_d\":\"Statistics for the last 7 days\",\"stats_m\":\"Statistics for this year\",\"stitle\":\"Title:\",\"views\":\"Views:\",\"responses\":\"Responses:\",\"rate\":\"Completed Rate:\",\"start\":\"Start Date:\",\"end\":\"End Date:\",\"last_r\":\"Last Response:\",\"days\":\"Last 7 Days\",\"months\":\"Month\",\"results\":\"All results\",\"export\":\"Export Data\",\"by\":\"Answer by\",\"people\":\"people\"},\"plans\":{\"title\":\"Simple Pricing for Everyone!\",\"desc\":\"Pricing built for buisenesses of all sizes. Always know what you\'ll pay. All plans comse with 100% money back guarane.\",\"month\":\"/per month\",\"btn\":\"Get Started\"},\"mysurvys\":{\"title\":\"My Surveys\",\"alltitle\":\"Public Surveys\",\"create\":\"Create Survey\",\"status\":\"Unpublished\",\"name\":\"Survey Name\",\"views\":\"Views\",\"responses\":\"Responses\",\"rate\":\"Complete Rate\",\"created\":\"Created\",\"last_r\":\"Last Response\",\"op_view\":\"View Survey\",\"op_stats\":\"Survey Statistics\",\"op_resp\":\"Show Responses\",\"op_edit\":\"Edit Survey\",\"op_delete\":\"Delete Survey\",\"op_embed\":\"Embed Survey\",\"op_send\":\"Send Survey\",\"subject\":\"Subject\"},\"dashboard\":{\"hello\":\"Hello,\",\"welcome\":\"Welcome back again to your dashboard.\",\"stats_line_d\":\"Statistics for the last 7 days\",\"stats_line_m\":\"Statistics for this year\",\"stats_bar_d\":\"Statistics for the last 7 days\",\"stats_bar_m\":\"Statistics for this year\",\"surveys\":\"Surveys\",\"users\":\"Users\",\"responses\":\"Responses\",\"questions\":\"Questions\",\"new_u\":\"New Users (24h)\",\"new_p\":\"Latest Payements (24h)\",\"new_s\":\"Latest Surveys (24h)\",\"delete\":\"Delete\",\"edit\":\"Edit\",\"save\":\"Save\",\"u_users\":\"Members\",\"u_status\":\"Status\",\"u_username\":\"Username\",\"u_email\":\"Email\",\"u_pass\":\"Password\",\"u_plan\":\"Plan\",\"u_credits\":\"Credits\",\"u_last_p\":\"Last Payment\",\"u_registred\":\"Registred at\",\"u_updated\":\"Updated at\",\"u_delete\":\"Delete User\",\"u_edit\":\"Edit User\",\"u_create\":\"Create a user\",\"pl_title\":\"Desabled\",\"pl_create\":\"Create Plan\",\"pl_delete\":\"Delete Plan\",\"pl_steps\":\"steps\",\"p_title\":\"Payments\",\"p_user\":\"User\",\"p_status\":\"Status\",\"p_plan\":\"Plan\",\"p_amount\":\"Amount\",\"p_date\":\"Payment Date\",\"p_txn\":\"TXN\",\"pg_title\":\"Pages\",\"pcreate\":\"Create a Page\",\"ptitle\":\"Footer\",\"ptheader\":\"Header\",\"ptfooter\":\"Footer\",\"psort\":\"Page Sort\",\"pfooter\":\"Don\'t show in Footer\",\"pheader\":\"Don\'t show in header\",\"pcontent\":\"Page Content\",\"languages\":\"Languages\",\"ln_title\":\"Language\",\"ln_short\":\"Short name\",\"ln_def\":\"Default language\",\"settings\":\"Settings\",\"set_title\":\"General Settings\",\"set_stitle\":\"Site title:\",\"set_keys\":\"Site keywords:\",\"set_desc\":\"Site Description:\",\"set_url\":\"Site URL:\",\"set_noreply\":\"Do not reply email:\",\"set_register\":\"Site Registration\",\"set_btn\":\"Save Settings\"}}');

-- --------------------------------------------------------

--
-- Structure de la table `puerto_logics`
--

CREATE TABLE `puerto_logics` (
  `id` int(11) NOT NULL,
  `survey` int(11) DEFAULT NULL,
  `question1` int(11) DEFAULT NULL,
  `question2` int(11) DEFAULT NULL,
  `action` int(11) DEFAULT NULL,
  `condition1` int(11) DEFAULT NULL,
  `condition2` int(11) DEFAULT NULL,
  `answer` varchar(110) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_pages`
--

CREATE TABLE `puerto_pages` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` longtext,
  `created_at` int(11) DEFAULT '0',
  `updated_at` int(11) DEFAULT '0',
  `footer` tinyint(1) DEFAULT '0',
  `header` tinyint(4) DEFAULT '0',
  `sort` smallint(6) DEFAULT '0',
  `keywords` text,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `puerto_pages`
--

INSERT INTO `puerto_pages` (`id`, `title`, `content`, `created_at`, `updated_at`, `footer`, `header`, `sort`, `keywords`, `description`) VALUES
(1, 'About', '[b]Who are we?[/b]\r\niFood is a technology company that connects people with the best in their cities. We do this by empowering local businesses and in turn, generate new ways for people to earn, work and live. We started by facilitating door-to-door delivery, but we see this as just the beginning of connecting people with possibility — easier evenings, happier days, bigger savings accounts, wider nets and stronger communities.\r\n\r\n[b]Delivering good to Customers[/b]\r\nWith your favorite restaurants at your fingertips, iFood satisfies your cravings and connects you with possibilities — more time and energy for yourself and those you love.\r\n', 1472750541, 1593690346, 0, 0, 1, 'a:3:{i:0;s:4:\"key1\";i:1;s:4:\"key2\";i:2;s:4:\"key3\";}', ''),
(2, 'Contact', 'You can contact us at contact@email.com for your contact questions, opinions, suggestions or skills.\r\nKilic Ali Pasa Cad. No: 12 K: 1 karakãy, Istanbul, Turkey\r\nCana Bilisim Hizmetleri ve Ticaret A.Åž.\r\n\r\nTax Identification Number 1111438913\r\n0212 223 59 00', 1472750541, 1593691345, 0, 0, 2, '', ''),
(3, 'Privacy Policy', '[b]This is my [/b]', 1593868695, 0, 0, 0, 0, NULL, NULL),
(4, 'Support &amp; FAQs', 'Support &amp; FAQs', 1594845749, 1598452175, 0, 1, 0, NULL, NULL),
(5, 'Inspire trust', 'As your click numbers go up, your brand recognition increases. And the more that grows, the more confident people become in the integrity of your content and communications.', 1594845792, 1598452163, 0, 1, 0, NULL, NULL),
(6, 'Boost results', 'Better deliverability and improved click-through are just the start. Rich link-level data allows you to understand who is clicking your links, as well as when and where, so you can make smarter .', 1594845811, 1598452151, 0, 1, 0, NULL, NULL),
(7, 'Gain control', 'On top of being able to fully customize your links, auto-branding boosts awareness of your brand by giving you credit for your content and more insight into how it’s being consumed.', 1594845831, 1598452139, 0, 1, 0, NULL, NULL),
(8, 'Big Data Analysis', 'Lorem ipsum dolor sit amet adicing elit maecenas sa faubus mollis interdum, decisions around the content and communications you share, amet adicing elit maecenas sa faubus mollis interdum.', 1594845848, 1598452126, 0, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `puerto_payments`
--

CREATE TABLE `puerto_payments` (
  `id` int(11) NOT NULL,
  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `txn_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `author` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_plans`
--

CREATE TABLE `puerto_plans` (
  `id` int(11) NOT NULL,
  `plan` varchar(50) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `desc1` varchar(200) DEFAULT NULL,
  `desc2` varchar(200) DEFAULT NULL,
  `desc3` varchar(200) DEFAULT NULL,
  `desc4` varchar(200) DEFAULT NULL,
  `desc5` varchar(200) DEFAULT NULL,
  `desc6` varchar(200) DEFAULT NULL,
  `desc7` varchar(200) DEFAULT NULL,
  `desc8` varchar(200) DEFAULT NULL,
  `desc9` varchar(200) DEFAULT NULL,
  `created_at` int(11) DEFAULT '0',
  `surveys_month` int(11) DEFAULT '0',
  `surveys_steps` int(11) DEFAULT '0',
  `surveys_questions` int(11) DEFAULT '0',
  `surveys_answers` int(11) DEFAULT '0',
  `surveys_iframe` tinyint(1) DEFAULT '0',
  `surveys_rapport` tinyint(1) DEFAULT '0',
  `surveys_export` tinyint(1) DEFAULT '0',
  `survey_design` tinyint(1) DEFAULT '0',
  `show_ads` tinyint(1) DEFAULT '0',
  `support` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `puerto_plans`
--

INSERT INTO `puerto_plans` (`id`, `plan`, `price`, `currency`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `desc6`, `desc7`, `desc8`, `desc9`, `created_at`, `surveys_month`, `surveys_steps`, `surveys_questions`, `surveys_answers`, `surveys_iframe`, `surveys_rapport`, `surveys_export`, `survey_design`, `show_ads`, `support`) VALUES
(1, 'Free Plan', 0.00, '$', '1 Surveys per month', '3 Survey Question', '3 Survey Steps', 'Survey Statistics', 'Specific Survey Design', 'Export Responses', 'Integrate to your website', 'Priority support', 'No ads', 0, 1, 3, 3, 3, 0, 0, 0, 0, 0, 0),
(2, 'Basic Plan', 9.99, '$', '3 Surveys per month', '12 Survey Question', '5 Survey Steps', 'Survey Statistics', 'Specific Survey Design', 'Export Responses', 'Integrate to your website', 'Priority support', 'No ads', 0, 3, 5, 12, 6, 0, 1, 0, 0, 0, 0),
(3, 'Regular Plan', 19.99, '$', '8 Surveys per month', '18 Survey Question', '10 Survey Steps', 'Survey Statistics', 'Specific Survey Design', 'Export Responses', 'Integrate to your website', 'Priority support', 'No ads', 0, 8, 10, 18, 10, 1, 1, 0, 0, 0, 0),
(4, 'Pro Plan', 24.99, '$', 'Unlimited Surveys per month', 'Unlimited Survey Question', 'Unlimited Survey Steps', 'Survey Statistics', 'Specific Survey Design', 'Export Responses', 'Integrate to your website', 'Priority support', 'No ads', 0, 99999999, 99999999, 99999999, 99999999, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `puerto_questions`
--

CREATE TABLE `puerto_questions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `author` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `survey` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `step` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `inline` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `votes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `responses` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `lastresponse` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `sort` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(50) DEFAULT NULL,
  `crows` tinyint(2) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `file` varchar(10) DEFAULT NULL,
  `hide` tinyint(1) DEFAULT NULL,
  `scale1` varchar(200) DEFAULT NULL,
  `scale2` varchar(200) DEFAULT NULL,
  `scale3` varchar(200) DEFAULT NULL,
  `scale4` varchar(200) DEFAULT NULL,
  `scale5` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_responses`
--

CREATE TABLE `puerto_responses` (
  `id` int(11) NOT NULL,
  `response` varchar(255) DEFAULT NULL,
  `date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `author` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `survey` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `step` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `question` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `answer` int(11) DEFAULT '0',
  `ip` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `cook` varchar(255) DEFAULT NULL,
  `token_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_steps`
--

CREATE TABLE `puerto_steps` (
  `id` int(11) NOT NULL,
  `date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `author` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `survey` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `views` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `sort` mediumint(8) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_survies`
--

CREATE TABLE `puerto_survies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `date` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `author` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `views` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `responses` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `lastresponse` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `enddate` bigint(20) UNSIGNED DEFAULT '0',
  `code` varchar(255) DEFAULT NULL,
  `welcome_head` varchar(255) DEFAULT NULL,
  `welcome_text` longtext,
  `welcome_btn` varchar(255) DEFAULT NULL,
  `welcome_icon` varchar(255) DEFAULT NULL,
  `thanks_head` varchar(255) DEFAULT NULL,
  `thanks_text` longtext,
  `thanks_btn` varchar(255) DEFAULT NULL,
  `thanks_icon` varchar(255) DEFAULT NULL,
  `startdate` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `private` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `byip` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `button_shadow` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `button_border_size` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `button_border_style` varchar(7) DEFAULT NULL,
  `button_border_color` varchar(7) DEFAULT NULL,
  `bg_gradient` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `bg_color1` varchar(7) DEFAULT NULL,
  `bg_color2` varchar(7) DEFAULT NULL,
  `txt_color` varchar(7) DEFAULT NULL,
  `survey_bg` varchar(7) DEFAULT NULL,
  `input_bg` varchar(7) DEFAULT NULL,
  `step_bg` varchar(7) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `pagination` tinyint(1) DEFAULT NULL,
  `share` tinyint(1) DEFAULT NULL,
  `send_email` tinyint(1) DEFAULT NULL,
  `send_email_body` mediumtext,
  `colors` mediumtext,
  `template` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `puerto_users`
--

CREATE TABLE `puerto_users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `address` mediumtext,
  `birth` varchar(255) DEFAULT NULL,
  `moderat` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `credits` float UNSIGNED DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `language` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `updated_at` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `trash` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `plan` tinyint(1) DEFAULT '0',
  `lastpayment` int(11) DEFAULT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `social_id` varchar(200) DEFAULT NULL,
  `social_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `puerto_users`
--

INSERT INTO `puerto_users` (`id`, `firstname`, `lastname`, `username`, `password`, `photo`, `date`, `level`, `email`, `gender`, `address`, `birth`, `moderat`, `verified`, `credits`, `description`, `language`, `updated_at`, `trash`, `plan`, `lastpayment`, `txn_id`, `country`, `state`, `city`, `social_id`, `social_name`) VALUES
(1, NULL, NULL, 'khalid', '94ca247fff5ad413788a1c8d8c80394a246dba1c', NULL, 1694381381, 6, 'el.bouirtou@gmail.com', 0, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `puerto_answers`
--
ALTER TABLE `puerto_answers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_configs`
--
ALTER TABLE `puerto_configs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_languages`
--
ALTER TABLE `puerto_languages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_logics`
--
ALTER TABLE `puerto_logics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_pages`
--
ALTER TABLE `puerto_pages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_payments`
--
ALTER TABLE `puerto_payments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_plans`
--
ALTER TABLE `puerto_plans`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_questions`
--
ALTER TABLE `puerto_questions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_responses`
--
ALTER TABLE `puerto_responses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_steps`
--
ALTER TABLE `puerto_steps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_survies`
--
ALTER TABLE `puerto_survies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `puerto_users`
--
ALTER TABLE `puerto_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `puerto_answers`
--
ALTER TABLE `puerto_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_configs`
--
ALTER TABLE `puerto_configs`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `puerto_languages`
--
ALTER TABLE `puerto_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `puerto_logics`
--
ALTER TABLE `puerto_logics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_pages`
--
ALTER TABLE `puerto_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `puerto_payments`
--
ALTER TABLE `puerto_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_plans`
--
ALTER TABLE `puerto_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `puerto_questions`
--
ALTER TABLE `puerto_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_responses`
--
ALTER TABLE `puerto_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_steps`
--
ALTER TABLE `puerto_steps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_survies`
--
ALTER TABLE `puerto_survies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `puerto_users`
--
ALTER TABLE `puerto_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

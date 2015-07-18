<?php
/**
 * Plugin Name: MultiLanguage Site
 * Description: Build a Multi-Language Site. This plugin gives you a good framework. After activation, read the explanation.  (P.S.  OTHER MUST-HAVE PLUGINS FOR EVERYONE: http://bitly.com/MWPLUGINS  )
 * Version: 1.58
 */

if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly
//echo "plugin will be updated near the end of April. please, deactivate&delete the current 1.2 version... sorry..";return;
 //define essentials
define('domainURL__MLSS',				(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443) ? 'https://':'http://' ).$_SERVER['HTTP_HOST']);
define('homeURL__MLSS',					home_url());
define('homeFOLD__MLSS',				str_replace(domainURL__MLSS,'',	homeURL__MLSS));
define('requestURI__MLSS',				$_SERVER["REQUEST_URI"]); 				define('requestURIfromHome__MLSS', str_replace(homeFOLD__MLSS, '',requestURI__MLSS) ); 	define('requestURIfromHomeWithoutParameters__MLSS',parse_url(requestURIfromHome__MLSS, PHP_URL_PATH));
define('currentURL__MLSS',				domainURL__MLSS.requestURI__MLSS);
define('THEME_URL_nodomain__MLSS',		str_replace(domainURL__MLSS, '', get_template_directory_uri()) );
define('PLUGIN_URL_nodomain__MLSS',		str_replace(domainURL__MLSS, '', plugin_dir_url(__FILE__)) );
define('THEME_DIR__MLSS',				get_stylesheet_directory() );
define('PLUGIN_DIR__MLSS',				plugin_dir_path(__FILE__) );
	
	//option names
define('SITESLUG__MLSS',				str_replace('.','_',$_SERVER['HTTP_HOST'])  );
define('STYLESHEETURL__MLSS',			plugin_dir_url(__FILE__).'flags/stylesheet.css');
define('FullMode__MLSS',				(get_option('optMLSS__OnOffMode', 'oon') == 'oon' ? true :false)   );
define('cookienameLngs__MLSS',			SITESLUG__MLSS.'_lang');
define('Table1__MLSS',					$GLOBALS['wpdb']->prefix.'translatedwords__mlss');
define('C_CategPrefix__MLSS',			''); //'_'.get_option('optMLSS__CategSlugname', 'categories')
define('S_CategPrefix__MLSS',			'');
define('PagePrefix__MLSS',				''); //'_'.get_option('optMLSS__PageSlugname', 'pages')
define('IS_ADMIN__MLSS',				IS_ADMIN() ); //'_'.get_option('optMLSS__PageSlugname', 'pages')
//
define('CatBaseWpOpt__MLSS',			get_option('category_base') );
		define('CAT_BASE_WpOption_IS_EMPTY__MLSS', ( in_array(CatBaseWpOpt__MLSS, array('.','/.','\.')) ? true:false)   );
	//others
	$x= get_option('optMLSS__CatBaseRemoved','y'); 
define('REMOVE_CAT_BASE_FUNC__MLSS', ('y'==$x ? true : false) ); 
define('REMOVE_CAT_BASE_WpOption__MLSS', false);   //this is just a backup alternative for me..
		define('CAT_BASE_NOT_USED__MLSS', ((REMOVE_CAT_BASE_FUNC__MLSS || REMOVE_CAT_BASE_WpOption__MLSS || CAT_BASE_WpOption_IS_EMPTY__MLSS) ? true:false)   );
$GLOBALS['MLSS_VARS'] =array();
		
		
		
		
		
//==================================================== ACTIVATION commands ===============================	
if (IS_ADMIN__MLSS) {
	
	//REDIRECT SETTINGS PAGE (after activation)
	add_action( 'activated_plugin', 'activat_redirect__MLSS' ); function activat_redirect__MLSS( $plugin ) { if( $plugin == plugin_basename( __FILE__ ) ) { 
		//if not "update" action
		if (!get_option('optMLSS__Lngs')){
			exit( wp_redirect( admin_url( 'admin.php?page=my-mlss-slug' ) ) ); 
		}
	} }

	//ACTIVATION HOOK
	register_activation_hook( __FILE__, 'activation__MLSS' );function activation__MLSS() { 	global $wpdb;
		update_option( 'optMLSS__NeedFlush','okk'); 
		$InitialArray = array( 
			'optMLSS__Lngs'				=> 'English{eng},Русский{rus},Japan{jpn},Dutch{nld}',
			'optMLSS__HiddenLangs'		=> '',
			'optMLSS__HiddenFromQuery1' => array('__start1','') ,
			'optMLSS__OnOffMode'		=> 'oon' ,
			'optMLSS__DefForOthers'		=> 'dropdownn' ,
			'optMLSS__FirstMethod'		=> 'dropddd' ,
			'optMLSS__BuildType'		=> 'custom_p' ,
			'optMLSS__Target_'.'rus'	=> 'Russian Federation,Belarus,Ukraine,Kyrgyzstan,' ,
			'optMLSS__Target_'.'default'=> 'eng' ,
			'optMLSS__DropdHeader'		=> 'ddropdown' ,
			'optMLSS__DropdDFixedOrAbs'	=> 'fixed' ,
			'optMLSS__DropdSidePos'		=> 'left' ,
			'optMLSS__DropdDistanceTop'	=> '70' ,
			'optMLSS__DropdDistanceSide'=> '50' ,
			'optMLSS__IncludeNamesDropd'=> 'y' ,
			'optMLSS__CategSlugname'	=> '' ,
			'optMLSS__PageSlugname'		=> '' ,
			'optMLSS__EnableQueryStrPosts'=> 'n' ,
			//'optMLSS__ShowHideOtherCats'=> 'n' ,
			//'optMLSS__HidenEntriesIdSlug'=> 'post-' ,
			'optMLSS__EnableCustCat'	=> 'n' ,
			'optMLSS__CatBaseRemoved'	=> 'y' ,
			);
		foreach($InitialArray as $name=>$value){	if (!get_option($name)){update_option($name,$value);}	}	

				if (REMOVE_CAT_BASE_WpOption__MLSS) {
					update_option('optMLSS__Cat_base_BACKUP', CatBaseWpOpt__MLSS );  $GLOBALS['wp_rewrite']->set_category_base('/.'); MyFlush__MLSS(false);  
					//update_option('category_base',				'/.'); 	MyFlush__MLSS(false);  
					//$wp_rewrite->set_permalink_structure('/%postname%/' );
					//do_action ( 'permalink_structure_changed',$old_permalink_structure,$permalink_structure );
				}
								 $bla55555 = $wpdb->get_results("SELECT SUPPORT FROM INFORMATION_SCHEMA.ENGINES WHERE ENGINE = 'InnoDB'");
			$InnoDB_or_MyISAM = ($bla55555[0]->SUPPORT) ? 'InnoDB' : 'MyISAM' ;
			$x= $wpdb->query("CREATE TABLE IF NOT EXISTS `".Table1__MLSS."` (
				`IDD` int(11) NOT NULL AUTO_INCREMENT,
				`title_indx` varchar(150) NOT NULL,
				`lang` varchar(150) NOT NULL,
				`translation` LONGTEXT  NOT NULL DEFAULT '',
				`mycolumn3` LONGTEXT CHARACTER SET latin1 NOT NULL DEFAULT '',
				PRIMARY KEY (`IDD`),
				UNIQUE KEY `IDD` (`IDD`)
				) ENGINE=".$InnoDB_or_MyISAM." DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=1;"
			);
		if (!get_option('optMLSS_table1installed')){
			$r1=UPDATEE_OR_INSERTTT__MLSS(Table1__MLSS, array('translation'=>'Hii user!!!'),	array('title_indx'=>'my_HeadingMessage', 'lang'=>'eng'));
			$r2=UPDATEE_OR_INSERTTT__MLSS(Table1__MLSS,array('translation'=>'haи иуzer!'),		array('title_indx'=>'my_HeadingMessage', 'lang'=>'rus'));
			update_option('optMLSS_table1installed','y');
		}
		if (!get_option('optMLSS_InitDataInstalled')){	
			Create_initials__MLSS();  update_option('optMLSS_InitDataInstalled','y'); 
		}
			
		//flush-update permalinks for CUSTOM POST TYPES 
		GetLanguagesFromBase__MLSS(); registPTyps__MLSS(false);	MyFlush__MLSS(false);
	}


				
				function Create_initials__MLSS(){    Create_Cats__MLSS();    Create_Pages__MLSS();    Create_NavMenus__MLSS();   }
				function Create_Cats__MLSS(){
					foreach (GetLanguagesFromBase__MLSS() as $EachLng){      $slug= S_CategPrefix__MLSS;
						//categories
						if (!term_exists( $EachLng.$slug, 'category')){  // https://codex.wordpress.org/Function_Reference/wp_insert_term
							$parentt= wp_insert_term( $EachLng.$slug,'category', array());		$PT= get_term_by('slug',  $EachLng.$slug, 'category');
							$subb= wp_insert_term('samplecategoryyyy_'.rand(1,1111111),	'category', array('parent'=>$PT->term_id));	$subb= wp_insert_term('samplecategoryyyy_'.rand(1,1111111),	'category', array('parent'=>$PT->term_id)); 
						}	
					}
				}
				function Create_Pages__MLSS(){
					foreach (GetLanguagesFromBase__MLSS() as $EachLng){
							$slug= PagePrefix__MLSS; $RandSlug1='somethinggggg_'.rand(1,1111111).rand(1,1111111); $RandSlug2='somethinggggg_'.rand(1,1111111).rand(1,1111111);
						//pages
						$page =get_page_by_path($EachLng.$slug, OBJECT, 'page');
						//see, if exists,but trashed
						if($page && 'trash'==$page->post_status){wp_update_post(array('ID'=>$page->ID,'post_status'=>'publish'));}
						elseif(!$page){
			$parentt= wp_insert_post(array('post_title'=>$EachLng.$slug,'post_name'=>$EachLng.$slug,'post_type'=>'page','post_content'=>'samplee','post_status'=>'publish'));
			$subb	= wp_insert_post(array('post_title'=>$RandSlug1, 'post_name'=>$RandSlug1, 'post_type'=>'page', 'post_content'=>'samplee', 'post_status'=>'publish','post_parent'=> $parentt));
			$subb	= wp_insert_post(array('post_title'=>$RandSlug2, 'post_name'=>$RandSlug2, 'post_type'=>'page', 'post_content'=>'samplee', 'post_status'=>'publish','post_parent'=> $parentt));
						}
					}
				}
				
				function Create_NavMenus__MLSS(){		
					foreach ($GLOBALS['SiteLangs__MLSS'] as $name=>$value){
						$menu_name='Example_MyMENUUU_1_'.$value;
						$menu_exists = wp_get_nav_menu_object($menu_name);
						if( !$menu_exists){
							$menu_id = wp_create_nav_menu($menu_name);
							// Set up default menu items  - http://goo.gl/5h8eJU
			wp_update_nav_menu_item($menu_id, 0, array('menu-item-title'=>'Home Page',		 'menu-item-status'=>'publish', 'menu-item-url' => home_url('/') ));
			wp_update_nav_menu_item($menu_id, 0, array('menu-item-title'=>'Samplee Categoryy','menu-item-status'=>'publish', 'menu-item-url' => home_url("/$value/mycateg1") ));
			wp_update_nav_menu_item($menu_id, 0, array('menu-item-title'=>'Samplee Pagee',	 'menu-item-status'=>'publish', 'menu-item-url' => home_url("/$value/my-page1")	));
			wp_update_nav_menu_item($menu_id, 0, array('menu-item-title'=>'Samplee LinKk',	 'menu-item-status'=>'publish', 'menu-item-url' => 'http://google.com'	));
						}
					}
				}

	register_deactivation_hook( __FILE__, 'deactivation__MLSS' ); function deactivation__MLSS() { 
		if (REMOVE_CAT_BASE_WpOption__MLSS) { update_option('category_base', get_option('optMLSS__Cat_base_BACKUP')); $GLOBALS['wp_rewrite']->set_category_base(get_option('optMLSS__Cat_base_BACKUP')); }      
		MyFlush__MLSS(false); 
	}


	//add action link in PLUGINS list (beside ACIVATE/DEACTIVATE)
	add_filter( 'plugin_action_links', 'add_action_link__MLSS', 10, 5 );		
	function add_action_link__MLSS( $actions, $plugin_file ) 	{		
		static $plugin; 	if (!isset($plugin)) $plugin = plugin_basename(__FILE__);		
		if ($plugin == $plugin_file) {		
			$settings = array('settings' => '<a href="admin.php?page=my-mlss-slug">' . __('Settings', 'General') . '</a>');		
			$actions = array_merge($settings, $actions);		
		}		
		return $actions;		
	}
}
//=================================================== ### ACTIVATION commands===============================






//========================================= SEVERAL USEFUL FUNCTIONS ===============================
//CHECK IF USER IS ADMIN
	function iss_admiiiiiin__MLSS()   {require_once(ABSPATH.'wp-includes/pluggable.php'); return (current_user_can('create_users')? true:false);}
	function die_if_not_admin__MLSS() {if(!iss_admiiiiiin__MLSS()) {die('not adminn_error_755 '.$_SERVER["SCRIPT_FILENAME"]);}	}
//CHECK IF USER CAN MODIFY OPTIONS PAGE
	function NonceCheck__MLSS($value, $action_name){if ( !isset($value) || !wp_verify_nonce($value, $action_name) ) { die("not allowed due to interal_error_151");}}	
//add_action( 'wp_head', 'noindex_pagesss__MLSS' );	  //IT'S BETTER, THAT USELESS PAGES WERE NOT INDETEX BY GOOGLE
	function noindex_pagesss__MLSS() {
		if ( !is_404() && !is_page() && !is_single() && !is_search() && !is_archive() && !is_admin() && !is_attachment() && !is_author() && !is_category() && !is_front_page() && !is_home() && !is_preview() && !is_tag())  { echo '<meta name="robots" content="noindex, nofollow"><!-- by MLSS -->'; }
	}	
//DETECT ROOT CATEGORY slug for current post
	function PostRootCatDetect__MLSS ($postid=false, $catid=false) { $catParent='';
		if (!$postid){$postid=$GLOBALS['post']->ID;}
		if (!$catid) {$bla3423525=get_the_category($postid);    if (!empty($bla3423525[0])) {$catid=$bla3423525[0]->term_id;} }
		// continue, untill a parent $catid will be null
		while ($catid) 	{ $cat = get_category($catid);	$catid = $cat->category_parent;  $catParent=$cat->slug; }
		return $catParent;
	}
//DETECT ROOT CATEGORY's LANGUAGE
	function DetectedPostLang__MLSS($postid=false, $catid=false){
		$catRoot = PostRootCatDetect__MLSS($postid); if (in_array($catRoot, LANGS__MLSS())){return $catRoot;} else {return false;}
	}
//INSERT VALUE IN DATABASE  ===(check Updates:::: https://github.com/tazotodua/useful-php-scripts/blob/master/mysql-commands%20%28%2BWordpress%29.php )
	function UPDATEE_OR_INSERTTT__MLSS($tablename, $NewArrayValues, $WhereArray){	global $wpdb;
			//convert array to STRING
			$o=''; $i=1; foreach ($WhereArray as $key=>$value){ $o .= $key." = '".$value."'"; if(count($WhereArray)!=$i){$o .=' AND ';$i++;} }
			$CheckIfExists = $wpdb->get_results("SELECT * from `".$tablename."` WHERE ".$o);
		//check if already exist
		if (!empty($CheckIfExists))   {return $wpdb->update($tablename,  $NewArrayValues,	$WhereArray  			);}
		else                          {return $wpdb->insert($tablename,  array_merge($NewArrayValues,$WhereArray)	);}
	}	
// DETECT FLAG'S URLs
	define('FlagFolder__MLSS', "/flags__MLSS");
	function GetFlagUrl__MLSS($lang){
		$flg1= dirname(PLUGIN_DIR__MLSS).FlagFolder__MLSS   ."/$lang.png";
		$flg2= 		   PLUGIN_DIR__MLSS 		 		  ."/flags/$lang.png";
		if	 (file_exists($flg1))	{$flag_url= dirname( PLUGIN_URL_nodomain__MLSS) .FlagFolder__MLSS  ."/$lang.png";}
		elseif(file_exists($flg2))	{$flag_url=			 PLUGIN_URL_nodomain__MLSS  			     ."/flags/$lang.png";}
		else						{$flag_url= '';}
		return $flag_url;
	}
// WHEN FLUSH IS NEEDED
	function FINAL_MyFlush__MLSS(){}
	function MyFlush__MLSS($RedirectFlushToo=false){	$GLOBALS['wp_rewrite']->flush_rules(); 
		//DUE TO WORDPRESS BUG ( https://core.trac.wordpress.org/ticket/32023 ) , i use this: (//USE ECHO ONLY! because code maybe executed before other PHP functions.. so, we shouldnt stop&redirect, but  we should redirect from already executed PHP output )
		if($RedirectFlushToo) {echo '<form name="mlss_frForm" method="POST" action="" style="display:none;"><input type="text" name="mlss_FRRULES_AGAIN" value="ok" /> <input type="submit"></form><script type="text/javascript">document.forms["mlss_frForm"].submit();</script>';}
	}

//REDIRECT function (301,302 or 404)
	function  REDIRECTTT__MLSS($url,$SomethingWord=false, $RedirCodee=false){ if (!empty($_COOKIE['MLSS_cstRedirect']) || defined('MLSS_cstRedirect')) {return;}
		header("Cache-Control: no-store, no-cache, must-revalidate"); header("Expires: Thu, 01 Jan 1970 00:00:00 GMT"); $RedirCodee = $RedirCodee ? $RedirCodee:301;   header("location:" . $url, true, $RedirCodee ) or die('File:'.dirname(__file__).'['.($SomethingWord ? $SomethingWord : '' ) .']  (FROM:'.$_SERVER['REQUEST_URI'].'  TO:'.$url .') BACKTRACE:<br/>'.debug_print_backtrace()); exit; //echo '<script> window.location="'.homeURL__MLSS.'/'.LNG'"; </script> '; exit; 
	} //FIX for WP BUG,, w hile site loaded in: Appearence>customize.php:
		if (stripos(currentURL__MLSS, str_replace(home_url(),'',admin_url('customize.php'))) !== false)	{define('MLSS_cstRedirect',true); setcookie('MLSS_cstRedirect', 'hii', time()+100000000, homeFOLD__MLSS);} else {setcookie('MLSS_cstRedirect', 'hii', time()-100000000, homeFOLD__MLSS);}
	//Children of above
	function TRIGGERR_REDIRECTTT__MLSS($url,$SomethingWord=false, $RedirCodee=false){ if (FullMode__MLSS) {REDIRECTTT__MLSS($url,$SomethingWord,$RedirCodee);} }
	
//DETECT PLATFORM ===(check Updates:::: https://github.com/tazotodua/useful-php-scripts/ )
function get_OperatingSystem__MLSS() { 
	$user_agent=$_SERVER['HTTP_USER_AGENT']; $final =array(); $final['os_namee']="_Unknown_OS_";  $final['os_typee']="_Unknown_OS_";
	$os_array=array(
		'MOUSED'	=> array('/windows nt 6.3/i'=>'Windows 8.1', '/windows nt 6.2/i'=>'Windows 8', '/windows nt 6.1/i'=>'Windows 7',	'/windows nt 6.0/i'=>'Windows Vista','/windows nt 5.2/i'=>'Windows Server 2003/XP x64', '/windows nt 5.1/i'=>'Windows XP', '/windows xp/i'=>'Windows XP','/windows nt 5.0/i'=>'Windows 2000','/windows me/i'=>'Windows ME','/win98/i'=>'Windows 98','/win95/i'=>'Windows 95','/win16/i'=>'Windows 3.11',
			'/macintosh|mac os x/i' =>'Mac OS X','/mac_powerpc/i'=>'Mac OS 9', '/linux/i'=>'Linux','/ubuntu/i'=>'Ubuntu',	),
		'NOMOUSED'	=> array('/iphone/i'=>'iPhone','/ipod/i'=>'iPod','/ipad/i'=>'iPad','/android/i'=>'Android','/blackberry/i'=>'BlackBerry', '/webos/i'=>'Mobile'	)
	);
	foreach($os_array as $namee=>$valuee) { foreach ($valuee as $regex => $value1) {	if(preg_match($regex, $user_agent)){$final['os_namee']=$value1;  $final['os_typee'] = $namee;}		} } 	return $final;
}
$zz = get_OperatingSystem__MLSS();
$GLOBALS['MLSS_VARS']['isMobile'] = ( $zz['os_typee'] != 'MOUSED' ?    true : false );


//Redirect from NOTFOUND WP pages, but currently not used, because 404 redirection inside "add_action" may cause problems in custom pages (i.e. where include(..'/wp-load.php');). So, it's better,that this function was in header.php
	function errorrrr_404__MLSS(){if (is_404() && WP_USE_THEMES === true )	{REDIRECTTT__MLSS(homURL,'problemm_702',404);}}
	add_action( 'init', 'add_some_supportss__MLSS', 1); function add_some_supportss__MLSS() {  add_theme_support('post-thumbnails');  }
//================================================= ##### SEVERAL USEFUL FUNCTIONS ===============================

















  
	
//DETERMINE, WHEN PLUGIN SHOULD START LANG_DETERMINATION/TYPE REGISTRATION (default 7, OTHER PLUGINS CAN CHANGE THIS TOO)
define('MLSS_initNumb', (defined('MLSS_INIT_POINT') ? MLSS_INIT_POINT : 7));
	
//==================================================== pre-define languages ===============================
add_action('init','GetLanguagesFromBase__MLSS',MLSS_initNumb);
function GetLanguagesFromBase__MLSS(){
	// see COUNTRY_NAME abbreviations here (should be 639-3 type https://en.wikipedia.org/wiki/ISO_639-3 ) 
	$aarray = explode(',',  get_option('optMLSS__Lngs','None{none}') ); 
	foreach ($aarray as $value)	{ 	$value=trim($value);				//re-create array with KEYNAMES
		if (!empty($value))	{	preg_match('/(.*?)\{(.*)\}/si',$value,$nnn); 	//var_dump($nnn);exit;
			$finall[ trim($nnn[1]) ]=trim($nnn[2]);
		}
	}
	$GLOBALS['SiteLangs__MLSS'] = $finall; 	return $GLOBALS['SiteLangs__MLSS'];
}
	
	function LANGS__MLSS(){return ($GLOBALS['SiteLangs__MLSS'] ? $GLOBALS['SiteLangs__MLSS'] : GetLanguagesFromBase__MLSS());} 
	add_action('init','LANGS__MLSS',MLSS_initNumb);
	
	function Defines_MLSS(){ foreach (LANGS__MLSS() as $n=>$v) { define ($v.'__MLSS',$v); define($v.'_title__MLSS',$n);} }
	add_action('init','Defines_MLSS',MLSS_initNumb);
	
	//RETURN TRANSLATION OF ANY INDEX_PHRASE, according to visitor's detected language
	function MLSS_PHRAZE($variable,$lang=false){ global $wpdb; 
		$res = $wpdb->get_results("SELECT * from `".Table1__MLSS."` WHERE `title_indx`= '$variable' AND `lang` = '".($lang ? $lang : LNG)."'");
		return ( !empty($res[0]) ? stripslashes($res[0]->translation) : '_____'.$variable.'_____') ;
	} add_filter('MLSS','MLSS_PHRAZE',10,3);  //you can pass additional variables into this filter too.
	
	//DETERMINE TEMPORARY HIDDEN LANGUAGES
	$hidden_langs__mlss= get_option('optMLSS__HiddenLangs', 'Nothing{none}'); //let's make query only once..
	function isHiddenLang__MLSS($abbr){	return ( stripos($GLOBALS['hidden_langs__mlss'],'{'.$abbr.'}')!== false    ? true:false) ;}
	
	//to get the last COOKIE-d language value
	DEFINE("LastCookiedLanguage__MLSS", $_COOKIE[cookienameLngs__MLSS]);
//============================================================================================= //	
//======================================== SET LANGUAGE for visitor =========================== //	
//============================================================================================= //	


add_action('init', 'DetectLangUsingUrl__MLSS',MLSS_initNumb); 
function DetectLangUsingUrl__MLSS(){ $hom=str_replace('/','\/', homeFOLD__MLSS);$x=false;
	//if preview
	if (isset($_GET['previewDropd__MLSS'])) {define('SHOW_FT_POPUP_MLSS', true);return;}
						
	// =============== if LANGUAGE was set using URL.. (priority given to URL parameter)  =========//
			//if LNG parameter is already defined by developer (i dont know, maybe with his own functions)
			if (defined('LNG_PASSED'))	{define ('LNG',LNG_PASSED); return; } //{  $x = LNG_PASSED; } 
	//if ADMIN PANEL
		if (!$x && is_admin() && !empty($_COOKIE[cookienameLngs__MLSS]))			{ $x = $_COOKIE[cookienameLngs__MLSS];}
	//PARAMTERED URL 					(example.com/mypagee?lng=ENG)
		if	(!$x && !empty($_GET['lng']) && in_array($_GET['lng'], LANGS__MLSS()) )	{ $x = $_GET['lng'];}
	//CUSTOM POST inside category		(example.com/ENG-categories2/my-post
		preg_match("/$hom\/(.*?)".C_CategPrefix__MLSS.'\//si',	$_SERVER['REQUEST_URI'].'/',$n);		
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];} 		
	//STANDARD CATEGORY with prefix 	(example.com/category/ENG-categories1/ [P.S. IT MAY NOT INCLUDE base phraze "/category/"] 
				$addn= (CAT_BASE_NOT_USED__MLSS) ? '' :  CatBaseWpOpt__MLSS.'\/';
		preg_match("/$hom\/$addn(.*?)".S_CategPrefix__MLSS.'\//si',$_SERVER['REQUEST_URI'].'/',$n);
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];}
	//STANDARD PAGE with prefix 		(example.com/ENG-pages/my-page
		preg_match("/$hom\/(.*?)".PagePrefix__MLSS.'\//si',	$_SERVER['REQUEST_URI'].'/',$n);		
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];}
	//STANDARD POST inside category		(example.com/ENG-categories1/my-post
		preg_match("/$hom\/(.*?)".S_CategPrefix__MLSS.'\//si',	$_SERVER['REQUEST_URI'].'/',$n);		
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];}
	//other check: standard post Or standard page  (CUSTOM_POSTS are not yet registered...  so, I am detecting them with "postrootCat__MLSS" function
		if(!$x){  
			// 
			$p1 = get_page_by_path(requestURIfromHomeWithoutParameters__MLSS, OBJECT, get_post_types(array('_builtin'=>true))); //url_to_postid causes too early error
			if ($p1)  { if ($catslug=DetectedPostLang__MLSS($p1->ID))		{$x=$catslug; } }
		}
	//ANYTHING ALL (CUSTOM POST or etc)..(example.com/ENG/my-page)
		preg_match("/$hom\/(.*?)\//si",   						$_SERVER['REQUEST_URI'].'/',$n);		
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];}
	//COOKIEd URL 	
	if	(!$x && !empty($_COOKIE[cookienameLngs__MLSS]) && in_array($_COOKIE[cookienameLngs__MLSS], LANGS__MLSS()))     {$x = $_COOKIE[cookienameLngs__MLSS];} 
	// ==============================================================================//
	// ==============================================================================//
	//FINAL SET
	define('found_lang__MLSS',		((!empty($x) && in_array($x, LANGS__MLSS() )) ?  $x :'')  );  //if incorrect language,do nothing..
	define('isHomeURI__MLSS',		(in_array($_SERVER['REQUEST_URI'], array(homeFOLD__MLSS, homeFOLD__MLSS.'/'))  ?  true :false)  ); 
	define('isLangHomeURI__MLSS',	(found_lang__MLSS != '' && in_array(requestURI__MLSS, array( homeFOLD__MLSS.'/'.found_lang__MLSS,
																								 homeFOLD__MLSS.'/'.found_lang__MLSS.'/' ))) ? true :false ); 

	
	//=========================================== INITIALIZE LANGUAGE ==================================
	//LANGUAGE detected
	if (found_lang__MLSS!=''){
		 define('LNG',found_lang__MLSS); setcookie(cookienameLngs__MLSS, found_lang__MLSS, time()+100000000, homeFOLD__MLSS);
		 if (isHomeURI__MLSS) {TRIGGERR_REDIRECTTT__MLSS(homeFOLD__MLSS.'/'.found_lang__MLSS, 'error1048 .contact administrator');}
	}
	//LANGUAGE was NOT detected
	else { 
		if (isHomeURI__MLSS){ //only check, when it's home URL
			if (!empty($_COOKIE[cookienameLngs__MLSS])){	//cookie was set previously!! redirect to his last language
				define('LNG', $_COOKIE[cookienameLngs__MLSS]); 	//p.s. no need to set cookie again...
				TRIGGERR_REDIRECTTT__MLSS(homeURL__MLSS.'/'.LNG, 'problemm_709' );
			}
			else{ 	//if cookie not set, it maybe first-time visit
					$FIRST_TIME_METHOD=get_option('optMLSS__FirstMethod');
				if ($FIRST_TIME_METHOD=='dropddd')	{ define('SHOW_FT_POPUP_MLSS', true); return;}		
				if ($FIRST_TIME_METHOD=='fixeddd')	{ define('LNG',get_option('optMLSS__FixedLang')); }  //no need to set cookie
				if ($FIRST_TIME_METHOD=='ippp')		{ include( dirname(__file__) .'/flags/ip_country_detect/sample_test.php'); //gets $country_name
					if (!empty($country_name)){ 
						foreach (LANGS__MLSS() as $name=>$value){
							if (stristr(','.get_option('optMLSS__Target_'.$value).',', ','.$country_name.',')) {$xLang=$value;break;}
						}
					}
					if (isset($xLang)) { define('LNG',$xLang); setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
					else{
						if (get_option('optMLSS__DefForOthers')=='fixedd'){ define('LNG',get_option('optMLSS__Target_'.'default')); 
							setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
						else{	define('SHOW_FT_POPUP_MLSS', true);return;	}
					}
				}
						//if unknown situation happens, set default...   better not to set cookie at this time
				if (!defined('LNG')) { 
					define('LNG', (get_option('optMLSS__Target_default') ? get_option('optMLSS__Target_default') : $GLOBALS['SiteLangs__MLSS'][0]) ) ;
				}
				TRIGGERR_REDIRECTTT__MLSS( homeURL__MLSS.'/'.LNG, 'problemm_708' );    //redirect is needed
			}
		}
		//IF it not home
		else{}  //(if it's like: site.com/?p=123&search=abc, then COOKIES will help us!)
			//when the page is unknown (for example, custom page or "wp-login.php" or etc... then we dont need redirection
	}
	
	
	//--------------------------------------------------------------------------------------
	//lets add one additional, luxury trick - if STANDARD(or unknown cutom) POST is published under language category.. (i.e. site.com/my-post), then detect it's language, and redirect
	add_action('template_redirect','postrootCat__MLSS');function postrootCat__MLSS(){
		if (is_singular()) {
			if ($catslug= DetectedPostLang__MLSS(url_to_postid(currentURL__MLSS))) {}
			elseif ($p1 = get_page_by_path(requestURIfromHomeWithoutParameters__MLSS, OBJECT, get_post_types(array('_builtin'=>true))))  { $catslug= DetectedPostLang__MLSS($p1->ID); }
			elseif ($catslug= DetectedPostLang__MLSS()) {}
			if ( $catslug) {
				//if language constant incorrectly is set for this post
				if ( (defined('LNG') && $catslug != LNG) || !defined('LNG')){  
					setcookie(cookienameLngs__MLSS, $catslug, time()+100000000, homeFOLD__MLSS);
					//$final_req = str_ireplace('lng='.$_SERVER['REQUEST_URI']);
					TRIGGERR_REDIRECTTT__MLSS($_SERVER['REQUEST_URI'], 'problemm_714' );	
				}
			}
		}
	}
	//-------------------------------------------------------------------------------------------
}

//============================================================================================= //	
//=================================== ##### SET LANGUAGE for visitor ========================== //	
//============================================================================================= //	











//==================================== POST TYPES ================================== //
//================================================================================== //
if (FullMode__MLSS){ add_action( 'init', 'registPTyps__MLSS',MLSS_initNumb); }
function registPTyps__MLSS($FullFlushAllowed=true) {
	//if CUSTOM_POST_TYPES is chosen by administrator,  for LANGUAGE STRUCTURE
	if (get_option('optMLSS__BuildType') == 'custom_p'){
		foreach (LANGS__MLSS() as $name=>$value) {
			// http://codex.wordpress.org/Function_Reference/register_post_type
			register_post_type($value, array( 	'label'=>$value, 'labels' => array('name' => $name, 'singular_name' => $value.' '.'page'),
					'public' => true,
					'query_var'=> true,
					//'exclude_from_search' => false,
					'publicly_queryable'=> true, 'show_ui'=>true,	//'show_in_nav_menus' => true,'show_in_admin_bar'	=> true,
					//'show_in_menu' => 'edit.php?post_type=page',//true,
					'menu_position' => "65.888562" ,
					'menu_icon'   => GetFlagUrl__MLSS($value),  //below (using <style>) we also use CSS to resize these images
									// 'dashicons-editor-spellcheck', // https://developer.wordpress.org/resource/dashicons/#editor-spellcheck
					'hierarchical' => true,
					'has_archive' => true,
					'capability_type' => 'post',
					'supports' => array( 'title', 'editor', 'thumbnail' ,'page-attributes','post_tag', 'revisions','comments','post-formats' ),
					//'taxonomies' => array('category','post_tag','my_taxonomyy_'.$value),	
					'rewrite' => array('with_front'=>true),			'can_export' => true,	
					//'permalink_epmask'=>EP_PERMALINK, 
			));

			// http://codex.wordpress.org/Function_Reference/register_taxonomy
			register_taxonomy( $value.C_CategPrefix__MLSS, array(), array(
				'public'	=> true,	'query_var'=>true,	'hierarchical'=>true, 'show_in_nav_menus'=>true, 'show_admin_column'=>true,
				'labels'	=> array('name'=> "Custom Categories ($value)", 'singular_name' => $value.C_CategPrefix__MLSS,  ),
				'rewrite'	=> array('slug' => $value.C_CategPrefix__MLSS)
																			)
			);
			
			//maybe better to register TAXONOMIES using this:
			register_taxonomy_for_object_type( 'category', $value );
			register_taxonomy_for_object_type( 'post_tag', $value );
									if (get_option('optMLSS__EnableCustCat')=='y') {
			register_taxonomy_for_object_type(  $value.C_CategPrefix__MLSS, $value );
									}
		}
		//resize icon size within Dashboard sidebar
		add_action('admin_head','my633__MLSS'); function my633__MLSS() {echo '<style>li[id*=menu-posts-] .wp-menu-image img{height:20px;} </style>';}
	}
	//FLUSH RULES !!! READ: http://www.andrezrv.com/2014/08/12/efficiently-flush-rewrite-rules-plugin-activation/
	if ($FullFlushAllowed){if ( get_option( 'optMLSS__NeedFlush' )) { MyFlush__MLSS(true);	delete_option('optMLSS__NeedFlush' ); } }
	if (isset($_POST['mlss_FRRULES_AGAIN'])){ MyFlush__MLSS(false);   }
}
//================================= ##### POST TYPES =============================== //
//================================================================================== //		



























	//this was in below  "query function", but i have inserted it here, in "init" too..
	add_action('init','LangHomeRedirect__MLSS',99);function LangHomeRedirect__MLSS(){if (isLangHomeURI__MLSS) { 	
		//when static ID is set for the language's STARTPAGE
		if ($optValue= get_option('optMLSS__HomeID_'.LNG)){
			//if custom URL is set, instead of ID, then simply redirect..
			if (!is_numeric($optValue)) {REDIRECTTT__MLSS($optValue,'problem_823',302);}
			}
		}
	}
// ================================================================================================================= //
// ===================================================== QUERY MODIFY ============================================== //
// ================================================================================================================= //
//difference between [$query->is_XXX=true    and   $query->set('is_XXX', true) [-----same as ----> set_query_var()]
// http://wordpress.stackexchange.com/questions/130314/how-to-force-a-query-conditional
//ALSO possible:  query_posts(array( 'post_type' => 'portfolio','tax_query' => array(array('taxonomy' => LNG,'terms' => $cat->term_id,'field' => 'term_id')),	'orderby' => 'title',));
					//$q->queried_object=$tr; //$q->queried_object_id=$tr->term_id; $q->set('queried_object_id',.. 
					
if (FullMode__MLSS){ add_action( 'pre_get_posts', 'querymodify__MLSS',88); } 
function querymodify__MLSS($query) { $q=$query;
	if( $q->is_main_query() && !is_admin() ) {
		$excluded_posts = get_option("optMLSS__HiddenFromQuery1");
		//============================================================================================================================
		//===============      QUERY TO SET STARPAGE (i.e. yoursite.com/ENG,   yoursite.com/CHN,..)===================================
		//============================================================================================================================
		//this is removed from here, and moved as a separate function
		if (isLangHomeURI__MLSS) { 	  
		
			//change title
			add_filter( 'wp_title', 'my_title_filter__MLSS', 19, 2 ); function my_title_filter__MLSS($title, $sep){ return constant(LNG.'_title__MLSS').' | '.get_option('blogname'); }
			
			
			//when static ID is set for the language's STARTPAGE
			if ($optValue= get_option('optMLSS__HomeID_'.LNG)){
											//this moved into above separate function ----------->
						//if custom URL is set, instead of ID, then simply redirect..
						//if (!is_numeric($optValue)) {REDIRECTTT__MLSS($optValue,'problem_823',302);}
				$q->init();
					$post = get_post( $optValue, OBJECT);
					if($post->post_type==LNG ||is_post_type_archive() )	{$q->parse_query( array('post_type'=>array(LNG)) );	  $q->is_single = true;  $q->is_page = false; } 
					elseif($post->post_type=='post')					{$q->parse_query( array('post_type'=>array('post')) ); $q->is_single = true;  $q->is_page = false; }
					else												{$q->parse_query( array('post_type'=>array('page')) ); $q->is_single = false; $q->is_page = true;  }
				$q->is_home = false;
				$q->is_singular = true;
				$q->queried_object_id = $optValue; //get_post(get_option('page_on_front') ); 
					$q->set( 'page_id', $optValue );
				//inject "EDIT" link in adminbar
				add_action('shutdown','showw_EDIT_LINK__MLSS',99);
				return $q;
			}
			//NO static id ...
			else{
				//if CUSTOM POSTS   (is chosen as structure type by admin), then HOMEPAGE should display CUSTOM CATEGORY/TAXONOMY
				if (get_option('optMLSS__BuildType') == 'custom_p'){ 	
					$q->init(); $q->parse_query(array('post_type'=>array(LNG), 'post__not_in'=>array($excluded_posts) )); 
					$q->is_home=true;  $q->is_page = false;  $q->is_archive = true; 
					//$q->is_tax = false; $q->is_post_type_archive = true; 
					return $q;
				}
				//if STANDARD POSTS (is chosen as structure type by admin), then HOMEPAGE should display STANDARD CATEGORY
				elseif($tr = get_term_by('slug', basename(currentURL__MLSS) , 'category')){
					$q->init();	
					$q->parse_query(array('post_type' => array('post'), 'post__not_in'=>array($excluded_posts),
										'tax_query' =>array(array('taxonomy' => 'category','terms' => $tr->term_id,'field' => 'term_id'))));
					$q->is_home=true;	$q->is_page = false; $q->is_archive = true;
					$q->is_category=false; //$q->set('cat', $tr->term_id);	
					$q->is_single=false;
					return $q;
				}
			}
		}

											
		
														

		
		
		//============================================================================================================================
		//=====QUERY FOR ALL OTHER PAGES than HOMEPAGE( due to WORDPRESS QUERY BUG, i have made this correction )...   
		//=====i.e. we open: yoursite.com/eng/categ2/TORNADOO
		//============================================================================================================================
		elseif (!isLangHomeURI__MLSS) {  			 if (is_search() || $q->is_search) {return;} //i have search filter below separately
			define('CustPostsIsChosenBuildType',   'custom_p'==get_option('optMLSS__BuildType') ?     true:false );
			define('CustTaxonomiesIsEnabledToo',   'y'		 ==get_option('optMLSS__EnableCustCat') ? true:false );

			//url details
			$PostOrPageDetectedByWp = url_to_postid(currentURL__MLSS); //detects only for post and page (or custom post)

			$UrlArray=explode('/',requestURIfromHome__MLSS); $k=array_values(array_filter($UrlArray));
			$PathAfterHome		=requestURIfromHomeWithoutParameters__MLSS;
			$PathAfterLangRoot	=substr($PathAfterHome, 4);
			$PathAfterCustPost	=isset($GLOBALS['post']) ? substr($PathAfterHome, strlen($GLOBALS['post']->post_type)) : '';
			$BaseSLUG			=basename(currentURL__MLSS);  //i.e. "TORNADOO"

			if (1==1) { //if (!$PostOrPageDetectedByWp)


				//===========post using GUID SHORTURL  (i.e. site.com/?p=362&post_type=mytype )
					if (isset($_GET['p'])) {
					//if (isset($_GET['post_type'])){$tp=get_post($_GET['p']); if ($tp->post_type == $_GET['post_type']) {$post=$tp;}  }
					  $post=get_post($_GET['p']);
					}
				if (!empty($post)){ $passed=true; 
					$q->init();	$q->parse_query( array('post_type'=>array($post->post_type)) ) ;	
					$q->is_single=true; $q->is_page=false; $q->is_home=false; $q->is_singular=true; $q->queried_object_id=$post->ID; $q->set('page_id',$post->ID);
					return $q;
				}
				//===========PAGED post    i.e. site.com/yourpost/3/
			//	$page_part= get_query_var('page',1); if(!empty($page_part)){
			//		$pageNUM= trim($page_part, '/') ;
			//		$final_cpURL = substr($PathAfterCustPost,0, - strlen($page_part));
			//		$post= get_page_by_path($final_cpURL, OBJECT, get_post_types());	if ($post){  
			//			$q->init();	$q->parse_query( array('post_type'=>array($post->post_type)) ) ;	 $q->set('page', $pageNUM);
			//			$q->is_single=true; $q->is_page=false; $q->is_home=false; $q->is_singular=true; $q->queried_object_id=$post->ID; $q->set('page_id',$post->ID);
			//			return $q;
			//		}
			//	}


				//============if CUSTOM TAXONOMY found=============== 
				if (CustPostsIsChosenBuildType){ //IF ENABLED
					if (CustTaxonomiesIsEnabledToo){ //IF ENABLED
						//term_is_ancestor_of  get_term_link( 
						//$terms = get_the_terms( $post->ID, 'taxonomy'); foreach ( $terms as $term ) {    $termID[] = $term->term_id;}echo $termID[0]; 
						//get_queried_object()->name;
						//$term_slug = get_query_var( 'term' );
						//$taxonomyName = get_query_var( 'taxonomy' );
						//$current_term = get_term_by( 'slug', $term_slug, $taxonomyName );
						$tr = get_term_by('slug', $BaseSLUG , LNG); if ($tr){  
							$q->init();	$q->parse_query(array('post_type'=> array(LNG) ,'post__not_in'=>array($excluded_posts),
															  'tax_query'=>array(array('taxonomy' => LNG,'terms' => $tr->term_id,'field' => 'term_id'))));
							$q->is_home = false;	$q->is_single = false;	$q->is_archive = true;	$q->is_tax = true;	$q->is_post_type_archive=false;
							return $q;
						}
					}
				}
				
				//===========if STANDARD CATEGORY found==========//BUT IT SHOULD BE IN THE BASE (i.e. ENG) TYPE  
							//  (WE MUST CHECK IT!! because we use EMPTY(.) as CATEGORY BASE, and wordpress bugs that..)
							//special query for categories	.. for example, url is: yoursite.com/CATEGORY/ENG/BLABLA  or yoursite.com/ENG/BLABLA
							$catPath = $PathAfterHome;
							if(CAT_BASE_NOT_USED__MLSS){  $cBase= '/'.CatBaseWpOpt__MLSS;
								$UrlStartPart = substr($PathAfterHome,0, strlen($cBase));	//i.e. "/CATEGORY" or "/"
								if ($UrlStartPart == $cBase){
									$catPath = substr($PathAfterHome,    strlen($cBase));	//i.e. "/ENG/BLABLA"
								}
							}
				// term_exists($BaseSLUG, 'category'); <-- this bugs, because  basename from /eng/mylink/smth is "smth", and "smth" may be categoryy too, so, post may become  overrided in this case..
				$tr= get_category_by_path( $catPath, true ); if ($tr){   
					$q->init();	$q->parse_query(array( 'post_type'=>array('post', (CustPostsIsChosenBuildType ? LNG: '') ) ,'post__not_in'=>array($excluded_posts),
													   'tax_query'=>array(array('taxonomy'=>'category','terms'=>$tr->term_id, 'field'=>'term_id'))) );
					$q->is_home = false;	$q->is_single = false;	$q->is_archive = true;	$q->is_tax = true;	$q->is_post_type_archive=false;
					return $q;	
				}
				
				//===========CUSTOM post found===========//BUT IT SHOULD BE IN THE BASE (i.e. ENG) TYPE 
								if (CustPostsIsChosenBuildType){ 
				$post= get_page_by_path($PathAfterLangRoot, OBJECT, LNG);	if ($post){ 
					$q->init();	$q->parse_query( array('post_type'=>array($post->post_type)) ) ;	
					$q->is_single=true; $q->is_page=false; $q->is_home=false; $q->is_singular=true; $q->queried_object_id=$post->ID; $q->set('page_id',$post->ID);
					return $q;
				}
				
								}
				//===========STANDARD page found===========
				$post=get_page_by_path($PathAfterHome, OBJECT, 'page');	if ($post){ 
					$q->init();	$q->parse_query( array('post_type'=>array($post->post_type)) ) ;	
					$q->is_single=false; $q->is_page=true; $q->is_home=false; $q->is_singular=true; $q->queried_object_id=$post->ID; $q->set('page_id',$post->ID);
					return $q;
				}
				//===========STANDARD post found ===========//BUT IT SHOULD BE IN THE BASE (i.e. ENG) CATEGORY 
				$post=get_page_by_path($PathAfterHome, OBJECT, 'post');  	if ($post){ $passed=true;  
					for($i=0; $i<count($k)-1; $i++){ $cat = get_term_by('slug', $k[$i], 'category'); 
						if(!(in_category($cat->term_id,$post->ID) || post_is_in_descendant_category(array($cat->term_id),$post->ID))){ $passed=false; break; }
					} if ($passed){ 
					//new query
					$q->init();	$q->parse_query( array('post_type'=>array($post->post_type)) ) ;
					$q->is_single=true; $q->is_page=false; $q->is_home=false; $q->is_singular=true; $q->queried_object_id=$post->ID;  $q->set('page_id',$post->ID);
					return $q;
					}
				}

				
			//---------------------------------------------------------------------------------//
			//-----------"I dont know"  why i have to manually make this query, and why not WP makes itself?? ------------------//
			//---------------------------------------------------------------------------------//			
				//if other CUSTOM TAXONOMY (i.e. my_products,  or etc..)..
				/*
				if(is_post_type_archive()){
				}
				$tr = get_term_by('slug', $BaseSLUG , 'xxxxx');
				if ($tr){   
					$q->init();	$q->parse_query(array('post_type' => array(LNG) ,
													  'tax_query' =>array(array('taxonomy' => LNG,'terms' => $tr->term_id,'field' => 'term_id'))));
					$q->is_home=false; $q->is_single=false; $q->is_archive=true; $q->is_tax=true;  $q->is_post_type_archive=false;
					return $q;
				}
				
				//===========OTHER  POSTS (Custom type or whatever)========
						$other_ctypes_final = array_values(get_post_types( )); //array('_builtin'=>false )	//$other_ctypes_final= array_diff($other_ctypes1, LANGS__MLSS()); //$other_ctypes_final[]=LNG;
				$post= get_page_by_path($BaseSLUG, OBJECT, $other_ctypes_final);
				if ($post){
					$q->init();	$q->parse_query( array('post_type' =>array($post->post_type))  ) ;
					$q->is_home=false; $q->is_single=true; $q->is_singular=true; $q->is_page=false; $q->queried_object_id=$post->ID; $q->set('page_id',$post->ID );
					return $q;
				}
				*/
				//-----------------------------------------------------------------------------------//
			}
		}
	}
	return $q;
}
	function showw_EDIT_LINK__MLSS(){ ?><script>var adminbar__MLSS= document.getElementById("wp-admin-bar-root-default"); if (adminbar__MLSS) {adminbar__MLSS.innerHTML += '<li id="wp-admin-bar-editMlssHome"><a class="ab-item" href="<?php echo get_edit_post_link($GLOBALS['post']->ID);?>" ><span class="ab-icon"></span><span class="ab-label">*EDIT*</span></li>';}</script>	<?php }
	if ( ! function_exists( 'post_is_in_descendant_category' ) ) { function post_is_in_descendant_category( $cats, $_post = null ) {
			foreach ( (array) $cats as $cat ) {	$descendants = get_term_children( (int) $cat, 'category' );
				if ( $descendants && in_category( $descendants, $_post ) ) {return true;}				
			} return false;
		}
	}	

	
	
//================== SEARCH FILTER ===================
if (FullMode__MLSS){ add_action('pre_get_posts','search_filterr__MLSS'); }   
function search_filterr__MLSS($q) { 
	if ( !is_admin() && $q->is_main_query() && $q->is_search() ) 	{ 
		$arrs= array_merge(array(), array());
		$RootCat	= get_term_by('slug', LNG, 'category');
			$All_categories=get_categories('parent=0&hide_empty=0&taxonomy=category');
			foreach ($All_categories as $category) { if ($category->slug != LNG){ $OtherCats[]=$category->term_id; }	}
		//$RootPage= get_page_by_path(LNG, OBJECT, 'page');

		if (get_option('optMLSS__BuildType') == 'custom_p'){	//$arrs[]='page';  //pages are exluded -hard for me..  post_parent=> 
			$arrs[]='post';	$arrs[]=LNG;
			$q->set('post_type',$arrs);     $q->set('category__not_in', $OtherCats);
		}
		else {													//$arrs[]='page';  //pages are exluded -hard for me..  post_parent=> 
			$arrs[]='post';	//$arrs[]=LNG;		
			$q->set('post_type',  $arrs );  $q->set('category__not_in', $OtherCats);
			//add_filter( 'posts_where' , 'MyFilterFunction_1__MLSS' );
		}}	return $q;
}
			function MyFilterFunction_1__MLSS( $where ) { global $wpdb;  $cat_id=get_query_var('cat');  $this_cat=get_category($cat_id);
				if (!in_array($cat_id,44444) && !in_array($this_cat->parent, 33333) )
				     { $where .= " AND ({$wpdb->posts}.post_excerpt NOT LIKE '%myCutYout')";}	
				return $where;
			}
// ========================================== ### QUERY MODIFY ========================================== //
// ====================================================================================================== //	
	

	
	
//add Language parameter to URL
if (FullMode__MLSS){
	add_filter( 'post_link', 		'my_append_query_string__MLSS', 10, 2 );
	add_filter( 'post_type_link',	'my_append_query_string__MLSS', 10, 2 );
}
function my_append_query_string__MLSS( $permalink, $post) {
	if (!in_array($post->post_type,    array_merge(LANGS__MLSS(),array('page')) )  ){ 
		if ('y'==get_option('optMLSS__EnableQueryStrPosts')){
			if ( $catSlug = DetectedPostLang__MLSS($post->ID)) { 
				$permalink = $permalink . ( !stripos($permalink,'?') ? "?" : "&") . "lng=$catSlug" ; 	 //&&  get_option('permalink_structure') 
			} 
		}
	}
    return $permalink;
}
//CSS CLASSES for BODY
add_filter('body_class', 'my_body_class__MLSS'); function my_body_class__MLSS($classes){
	if (defined('LNG')) 	{$classes[]='MLSSlang___'.LNG; }
		//if (is_singular()) 		{$classes[]='MLSStype___'.$GLOBALS['post']->post_type;}
	return $classes;
}
	
	
//Change category permalinks - REMOVE "/CATEGORY" base
if (FullMode__MLSS){
	if (REMOVE_CAT_BASE_FUNC__MLSS){
		add_filter( 'user_trailingslashit', 'fix_slash__MLSS', 55, 2 );
		function fix_slash__MLSS( $string, $type ){global $wp_rewrite;
			//this below "IF" condition checks if trailing slash is the not last char of PRETY PERMALINKS(i.e. /%postname% )
			//If so, then the next codes cause /CATEGORY/my-cat to be redirected to /my-cat.
			//If not, then nothing will happen, and default will be....
					//so, i have just removed..
					//if ( $wp_rewrite->use_trailing_slashes == false )	{ 
				if ( $type != 'single' && $type != 'category' )  return trailingslashit( $string );
				if ( $type == 'single' && ( strpos( $string, '.html/' ) !== false ) )  {return trailingslashit( $string );}
				if ( $type == 'category' && ( strpos( $string, 'category' ) !== false ) )  {
					return trailingslashit(str_replace( "/category/", "/", $string ));
				}
				if ( $type == 'category' ) { return trailingslashit( $string ); }
					//}
			//MyFlush__MLSS(false);
			return $string;
		}

		add_filter( 'category_rewrite_rules', 'vipx_filter_category_rewrite_rules22' );
		function vipx_filter_category_rewrite_rules22( $rules ) {
			$categories = get_categories( array( 'hide_empty' => false ) );
			if ( is_array( $categories ) && ! empty( $categories ) ) {
				$slugs = array();
				foreach ( $categories as $category ) {
					if ( is_object( $category ) && ! is_wp_error( $category ) ) {
						if ( 0 == $category->category_parent ) {
							$slugs[] = $category->slug;
						} else {
							$slugs[] = trim( get_category_parents( $category->term_id, false, '/', true ), '/' );
						}
					}
				}
				if ( ! empty( $slugs ) ) {
					$rules = array();

					foreach ( $slugs as $slug ) {
						$rules[ '(' . $slug . ')/feed/(feed|rdf|rss|rss2|atom)?/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
						$rules[ '(' . $slug . ')/(feed|rdf|rss|rss2|atom)/?$' ] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
						$rules[ '(' . $slug . ')(/page/(\d)+/?)?$' ] = 'index.php?category_name=$matches[1]&paged=$matches[3]';
					}
				}
			}
			return $rules;
		}
	}
}	
	
	
	
	
	
//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors


	
	
//======================================= SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //	
//register style for default front-page	
if (FullMode__MLSS){ 
	add_action( 'wp_enqueue_scripts', 'stylesht__MLSS',1,98 ); function stylesht__MLSS() {
		wp_enqueue_style( 'custom_styles__MLSS', STYLESHEETURL__MLSS );
	}
}

//POPUP TO CHOOSE LANGUAGE -  ONLY FOR FIRST TIME VISITOR!
add_filter("MLSS__firsttimeselector","OutputFirstTimePopup__MLSS",9,1); function OutputFirstTimePopup__MLSS($cont){   $out = 
				//$smth = . '<title></title>';do_action("wp_head");echo '<title></title>';  
		'<!-- To add your styles, read the MLSS_SETTINGS page -->
		<link rel="stylesheet" id="mlsss_css"  href="'.STYLESHEETURL__MLSS.'" type="text/css" media="all" />'. //'<script type="text/javascript"  src="'.PLUGIN_URL_nodomain__MLSS.'flags/javascript_functions.php?jstypee"></script>
		  '<div id="my_black_bck_24141"></div>'.
		  '<div id="FirstTimeLanguage1__MLSS"  class="css_reset__MLSS">'.
			 '<div id="popup_CHOOSER2__MLSS"><div class="lnmenu__MLSS">';
				foreach (LANGS__MLSS() as $keyname => $value){		if (!isHiddenLang__MLSS($value) ) {  //not included in "HIDDEN LANGS"
				$out .= '<div class="LineHolder2__MLSS">'.
								'<a class="ImgHolder2__MLSS"  href="'.homeURL__MLSS.'/'.$value.'">'.
									'<img class="FlagImg2__MLSS '.$value.'_flagg2__MLSS" src="'. GetFlagUrl__MLSS($value).'" alt="'. $keyname .'" />'.
									'<span class="lnmenuSpn2__MLSS">'. $keyname.'</span>'.
								'</a>'.
						'</div>';										}
			}
			$out .= '</div></div></div>';	return $cont.$out;	
}
	//output
	if (FullMode__MLSS || isset($_GET['previewDropd__MLSS']) ){ 
		add_action('wp','fnc134__MLSS'); function fnc134__MLSS(){ if (defined('SHOW_FT_POPUP_MLSS')) {echo apply_filters('MLSS__firsttimeselector',''); exit; }} 
	}
	


//DEFAULT LANGUAGE SELECTOR, WHICH IS SEEN ON THE TOP OF PAGE	
add_filter("MLSS__dropdownselector","OutputDropdown__MLSS",9,1); function OutputDropdown__MLSS($cont){     $out = 
	'<!-- LanguageSelector__MLSS --><style>#LanguageSelector__MLSS {top:'.get_option('optMLSS__DropdDistanceTop').'px; '.get_option('optMLSS__DropdSidePos').':'.get_option('optMLSS__DropdDistanceSide').'px; position:'.get_option('optMLSS__DropdDFixedOrAbs').';}</style>'.
		'<div id="LanguageSelector__MLSS" class="css_reset__MLSS">'.
		 '<div class="'.Dtype__MLSS.'_LSTYPE__MLSS">';
			//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors
			$DisableCurrentLangClick = true; $include_names= 'y'==get_option('optMLSS__IncludeNamesDropd');	$SITE_LANGUAGES=LANGS__MLSS(); 
			//If language is set, then sort languages, as the first language FLAG should be the current language
			if (defined('LNG')) {								function fix_1($i){return $i != LNG;}
				$SITE_LANGUAGES = array_filter($SITE_LANGUAGES,  "fix_1");							//remove current language
				$SITE_LANGUAGES = array( constant(LNG."_title__MLSS") => LNG) + $SITE_LANGUAGES;	//insert current language in first place
			}	$out.=
		  '<div id="LangDropMenu1__MLSS">'.
		   '<div id="AllLines1__MLSS"> <a href="javascript:MyMobileFunc__MLSS();" id="RevealButton__MLSS">&#8897;</a>';
		foreach ($SITE_LANGUAGES as $keyname => $key_value){  	    if (!isHiddenLang__MLSS($key_value)) { //not included in "HIDDEN LANGS"
			$out.=
			'<div class="LineHolder1__MLSS" id="lnh_'.$key_value.'">'.
				'<a class="ImgHolder1__MLSS" '.( ($DisableCurrentLangClick && $key_value==LNG) ? '':'href="'.homeURL__MLSS.'/'.$key_value.'"') .'>'.
					'<img class="FlagImg1__MLSS '.$key_value.'_flagg1__MLSS" src="'. GetFlagUrl__MLSS($key_value). '" />'. ( ($include_names) ? "<span class=\"Flag1_lname__MLSS\">$keyname</span>" : "" ).
				'</a>'.
			'</div>'.'<span class="clerboth2__MLSS"></span>';											}
		}	$out.=  
		'</div>'. '</div>'. '</div>'.'</div>';
		
		
		include_once(dirname(__file__) ."/flags/detect_platform.php");
		$out.= '<!-- ###LanguageSelector__MLSS### -->
	<script type="text/javascript">
		var langMenu__MLSS = document.getElementById("LanguageSelector__MLSS"); document.body.insertBefore(langMenu__MLSS, document.body.childNodes[0]);
		var langmnSelcr__MLSS=document.getElementById("RevealButton__MLSS"); 
		var ALines__MLSS=document.getElementById("AllLines1__MLSS");
		var ALines_startHEIGHT__MLSS= ALines__MLSS.clientHeight; //overflow maybe  hidden white started
		//For mobile devices, instead of hover, we need "onclick" action to be triggered (already injected into that button)
			var isMobile__MLSS='.( $GLOBALS['MLSS_VARS']['isMobile'] ? "true":"false" ).';
			function MyMobileFunc__MLSS(){	if (isMobile__MLSS){ HideShowAllLines1__MLSS(); }  }	//langmnSelcr__MLSS.addEventListener("click", .....
			Shown__MLSS=false;	function HideShowAllLines1__MLSS()	{
				if (Shown__MLSS===true)	{ Shown__MLSS=false; ALines__MLSS.style.overflow="hidden";   ALines__MLSS.style.height=ALines_startHEIGHT__MLSS + "px";}
				else					{ Shown__MLSS=true;  ALines__MLSS.style.overflow="visible";  ALines__MLSS.style.height="auto";}
			}
	</script>';	return $cont.$out;
} 
	//output
	if (FullMode__MLSS){  
		add_action('wp_footer','fnc138__MLSS'); function fnc138__MLSS(){ define('Dtype__MLSS', get_option('optMLSS__DropdHeader') ); if ( Dtype__MLSS != 'hhide') { echo apply_filters('MLSS__dropdownselector',''); }}
	}
//================================= ##### SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //	


	
	
	
	
		
	
	
	
	
	
//======================================= HIDE/SHOW special WIDGETS  ============================ //
//=============================================================================================== //		

//ADD classname to widget ..  THANKS to AUTHOR of "SIMPLE WIDGET CLASSES" ( http://markwilkinson.me/saythanks )
class Simple_Widget_Classes__MLSS {
	public function __construct() {	add_filter( 'widget_form_callback', array($this,'myForm'),9,2);	add_filter('widget_update_callback', array($this,'myUpdate'),9,2); 	add_filter( 'dynamic_sidebar_params', array($this,'myApply'),9);   add_filter( 'dynamic_sidebar_params', array($this,'myApply2'),9);}
	//add form into ADMIN SIDEBARS (add dropdown checkbox to each widget)
	public function myForm( $instance, $widget ) {
		if( !isset($instance['WidgetLang__MLSS']) ) { $instance['WidgetLang__MLSS'] = null; }	?>
		<p><label for='widget-<?php echo $widget->id_base; ?>-<?php echo $widget->number; ?>-WidgetLang__MLSS'>(MLSS) Shown on Language:
				<select class="widefat" id="<?php echo $instance[ 'WidgetLang__MLSS' ]; ?>" name="widget-<?php echo $widget->id_base; ?>[<?php echo $widget->number; ?>][WidgetLang__MLSS]">
					<option value="ALL">EVERYWHERE</option>
					<?php foreach (LANGS__MLSS() as $name=>$value) { 
						echo '<option value="'.$value. '"'. ( ($value==$instance['WidgetLang__MLSS']) ? 'selected':'' )."> $value ($name)</option>";}?>
				</select>
		</label></p> <?php return $instance;
	}
	public function myUpdate($instance,$new_instance) {$instance['WidgetLang__MLSS']=wp_strip_all_tags($new_instance['WidgetLang__MLSS']);return $instance;}
	// change front-end output 
	public function myApply( $params ) {	global $wp_registered_widgets;	$widget_id = $params[0][ 'widget_id' ];	$widget = $wp_registered_widgets[ $widget_id ];
			// because the Widget Logic plugin changes this structure - how selfish of it!
			if ( !( $default_name_fixed = $widget['callback'][0]->option_name ) ) { $default_name_fixed = $widget['callback_wl_redirect'][0]->option_name; }
		$option_name = get_option( $default_name_fixed ); $number = $widget['params'][0]['number'];
		if( isset( $option_name[ $number ][ 'WidgetLang__MLSS' ] ) && !empty( $option_name[ $number ][ 'WidgetLang__MLSS' ] ) ) {
			// find the end of the class= part and replace with new 
			$params[0]['before_widget'] = preg_replace('/"\>/', ' MLSS_widgetCL MLSS_widget_'.$option_name[$number]['WidgetLang__MLSS'].'">', $params[0]['before_widget'], 1);
		} return $params;
	}
	//BASED ON CLASSNAME,  Hide Other Language Widgetssss
	public function myApply2($params) {	global $wp_registered_widgets;
		$incl_nm= $params[0]['before_widget'];
		if (stripos($incl_nm,'MLSS_widget_') !== false && !is_admin() &&  (stripos($incl_nm,'MLSS_widget_ALL') === false && stripos($incl_nm,'MLSS_widget_'.LNG) === false)   ) { $params=array(); $params['blabla']=''; }  return $params;
	}	
		
} $simple_widget_classes__MLSS = new Simple_Widget_Classes__MLSS();

//add "HIDE(disable) widget temporarily" checkbox, to temporarily hide it.
if (!class_exists('EnableDisableWidget__TT')){
	class EnableDisableWidget__TT {
		public function __construct() {	add_filter( 'widget_form_callback', array( $this, 'myForm' ), 6, 2 );	add_filter( 'widget_update_callback', array ($this, 'myUpdate' ), 9, 2 ); 	add_filter( 'dynamic_sidebar_params', array( $this, 'myApply' ), 9 );   add_filter( 'dynamic_sidebar_params', array( $this, 'myApply2' ), 9 ); }
		//add form into ADMIN SIDEBARS
		public function myform( $instance, $widget ) {  if( !isset($instance['wONOFF__TT']) ) { $instance['wONOFF__TT'] = null; }	?>	
			<div style="font-size:0.8em;font-style:italic;background-color:#e7e7e7;margin:10px 0 0;padding:0 2px;text-align: right;">Disable this widget temporarily: <input type="checkbox" value="offf" name="widget-<?php echo $widget->id_base; ?>[<?php echo $widget->number; ?>][wONOFF__TT]" <?php if ('offf'==$instance['wONOFF__TT']){echo 'checked="checked"';}?>/> </div>	<?php return $instance;
		}
		public function myUpdate($instance,$new_instance) {$instance['wONOFF__TT']=wp_strip_all_tags($new_instance['wONOFF__TT']);return $instance;}
		// change front-end output 
		public function myApply( $params ) {	global $wp_registered_widgets;	$widget_id = $params[0][ 'widget_id' ];	$widget = $wp_registered_widgets[ $widget_id ];
				// because the Widget Logic plugin changes this structure - how selfish of it!
				if ( !( $default_name_fixed = $widget['callback'][0]->option_name ) ) { $default_name_fixed = $widget['callback_wl_redirect'][0]->option_name; }
			$option_name = get_option( $default_name_fixed ); $number = $widget['params'][0]['number'];
			if( isset( $option_name[$number][ 'wONOFF__TT' ] ) && !empty( $option_name[$number][ 'wONOFF__TT' ] ) ) {
				// find the end of the class= part and replace with new 
				$params[0]['before_widget'] = preg_replace('/"\>/', ' wONOFFvalue__TT_'.$option_name[$number]['wONOFF__TT'].'">', $params[0]['before_widget'], 1);
			} 
			return $params;
		}			
		//BASED ON FOUND CLASSNAME,  SHOW or HIDE
		public function myApply2( $params ) {	global $wp_registered_widgets; 
			$incl_nm= $params[0]['before_widget']; if (stripos($incl_nm,'wONOFFvalue__TT_offf') !== false && !is_admin())  { $params=array(); $params['blabla']=''; }  return $params;
		}	
	} $enabledisablewidget__TT = new EnableDisableWidget__TT();
}


		/*  add_action('wp_head','ShowHideWidgets1__MLSS'); function ShowHideWidgets1__MLSS(){
		  $out=''; foreach (LANGS__MLSS() as $each) {	if ($each != LNG) { $out .= '.MLSS_widget_'.$each.'{display:none;}';}
		  } echo '<style type="text/css">'.$out.'</style>';   $out=''; foreach (LANGS__MLSS() as $each) {
			if ($each != LNG) { $out .= 'var obj = document.getElementsByClassName("MLSS_widget_'.$each.'");
			for (var i = 0; i< obj.length; ++i) { output = output + obj[i];	obj[i].parentNode.removeChild(obj[i]);}'; }
		  } echo '<script type="text/javascript">window.onload = function(){'.$out.'};</script>'; }  */
		  

//================================================================================================= //	
//=====================================### HIDE/SHOW special WIDGETS  ============================= //
//================================================================================================= //		
	


		
	
	



//add sample widget 
add_action( 'widgets_init', 'widg_sample__MLSS' );	function widg_sample__MLSS() {
	register_sidebar( array('name' => 'MLSS_sample_sidebar1','id' => 'mlss_221',
		'before_widget'=>'<div class="MLSS_sideb1">','after_widget'=>'</div>','before_title'=>'<h2 class="MLSS_roundedd">','after_title'=>'</h2>',) );
}

add_filter( 'widget_text', 'do_shortcode' ); //enable SHORTCODES in widgets

add_shortcode( 'MLSS_phrase', 'wordOutp__MLSS' ); function wordOutp__MLSS($atts){
	echo '<span class="mlss__WidgetText">'.apply_filters("MLSS",$atts['name']).'</span>';
}


//http://codex.wordpress.org/Function_Reference/shortcode_atts
add_shortcode( 'MLSS_navigation', 'treemenuOutp__MLSS' ); function treemenuOutp__MLSS($atts){
	//http://codex.wordpress.org/Function_Reference/wp_nav_menu
	//http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
	if (stripos($atts['name'],'AUTODETECT') !== false) {	$menu_name =str_replace('_AUTODETECT','', str_replace('AUTODETECT_','',$atts['name']) )  . '_' . LNG ;	}
	else {$menu_name = $atts['name']; }
	
	$menu_exists = wp_get_nav_menu_object($menu_name);
	if($menu_exists){
		echo wp_nav_menu( array('theme_location'=>'',    'menu'=> $menu_name,
			'container'       => 'div',			'container_class' => 'sideMyBox',    'container_id'=> 'my_SideMenuTreeee',
			'menu_class'      => 'menu',		'menu_id'         => '',
			'echo'            => 0,				'fallback_cb'     => 'wp_page_menu',
				'before'=>'', 'after'=>'', 'link_before'=>'', 'link_after'=>'',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,	'walker'          => ''
		));
	}
}

//register navigation menus  (shown in   /wp-admin/nav-menus.php?action=locations  )
//add_action( 'init', 'my_menu_registers__MLSS',91 ); 
function my_menu_registers__MLSS() {
	register_nav_menus(array(
		'mlss_menu_sidebarr1' =>'MLSS MenuBar1',
		'mlss_menu_sidebarr2' =>'MLSS MenuBar2',
		'mlss_menu_sidebarr3' =>'MLSS MenuBar3'
	));
}







include(dirname(__file__).'/____dashboard_options.php');












/*
My TO-DO-LIST:::
 
1) sticky posts query (http://goo.gl/otIDaA); 
2)tags; autors pages should contain only langs..; 
3) category is found on any 404 page, if basename meets category.. 
4) post alternatives
5) tu sxva custom-post-type-shi gamoqveynenbulia ori sxvadasxna enispostebi, mashin imis ARCHIVE_HOME-shi marto iuzeris ena iyos??
6) sequence
	i.e.  /eng/eng-sub
	Homepage:
	- custom post archive
	- standard category
	..
	..
	not-homepage (i.e. subpage):

	 wordpress default url_to_postid ( if enabled cposts: then custom-type; others 404 ; if not enabled cposts: then  page; others 404)
	if url_to_postid not found
		//- cust.post.
		- page 
		- post
		==if post not detected==
			//- cust.taxonomy.cat  (wp default 404)  created manually
			- category	(wp default 404)   created manually
			//- cust.post.
			- page
			- post

*/	

//======================================== check for plugin updates =======================
if (is_admin()){
	define('PluginName__MLSS', 'Multi-Language-Plugin-Simple'); define('PluginUrl__MLSS','http://plugins.svn.wordpress.org/multi-language-site-basis/trunk/index.php'); define('PluginDown__MLSS','https://wordpress.org/plugins/multi-language-site-basis/changelog/');
	
	add_action('admin_notices', 'check_updates__MLSS'); function check_updates__MLSS(){if (current_user_can('create_users')){
			$OPTNAME_checktimee=PluginName__MLSS.'_updatechecktime';	$last_checktime=get_option($OPTNAME_checktimee,false); 	
			if (!$last_checktime || (is_numeric($last_checktime) && $last_checktime<time()-5*86400)  ){	update_option($OPTNAME_checktimee,time()); 
				$VPattern='/plugin name(.*?)version\:(.*?)(\r\n|\r|\n)/si';
				preg_match($VPattern,file_get_contents(__FILE__),$A); preg_match($VPattern,get_remote_data__MLSS(PluginUrl__MLSS),$B);
				if (trim($B[2]) && trim($B[2])!=trim($A[2])){ 
					echo '<div style="position: fixed; width: 100%; padding: 10px; background-color: #FFC0CB; z-index: 7777; border: 15px solid;">'.PluginName__MLSS.' has updated version('.$B[2].') already! Please, read <a href="'.PluginDown__MLSS.'" target="_blank">CHANGELOGS</a> page and <a href="'.admin_url("plugins.php").'" target="_blank">update</a> on your site too</a>!</div>'; return true;
	}}}}
	//=================== compressed version===============https://github.com/tazotodua/useful-php-scripts/==========================
	function get_remote_data__MLSS($url, $post_paramtrs=false)	{
	   $c = curl_init();curl_setopt($c, CURLOPT_URL, $url);curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);	if($post_paramtrs){curl_setopt($c, CURLOPT_POST,TRUE);	curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&".$post_paramtrs );}	curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0"); curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');	curl_setopt($c, CURLOPT_MAXREDIRS, 10);  $follow_allowed= ( ini_get('open_basedir') || ini_get('safe_mode')) ? false:true;  if ($follow_allowed){curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);}curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);curl_setopt($c, CURLOPT_REFERER, $url);curl_setopt($c, CURLOPT_TIMEOUT, 60);curl_setopt($c, CURLOPT_AUTOREFERER, true);  		curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');$data=curl_exec($c);$status=curl_getinfo($c);curl_close($c);preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si',  $status['url'],$link);$data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si','$1=$2'.$link[0].'$3$4$5', $data);$data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si','$1=$2'.$link[1].'://'.$link[3].'$3$4$5', $data);if($status['http_code']==200) {return $data;} elseif($status['http_code']==301 || $status['http_code']==302) { if (!$follow_allowed){if(empty($redirURL)){if(!empty($status['redirect_url'])){$redirURL=$status['redirect_url'];}}	if(empty($redirURL)){preg_match('/(Location:|URI:)(.*?)(\r|\n)/si', $data, $m);if (!empty($m[2])){ $redirURL=$m[2]; } }	if(empty($redirURL)){preg_match('/href\=\"(.*?)\"(.*?)here\<\/a\>/si',$data,$m); if (!empty($m[1])){ $redirURL=$m[1]; } }	if(!empty($redirURL)){$t=debug_backtrace(); return call_user_func( $t[0]["function"], trim($redirURL), $post_paramtrs);}}} return "ERRORCODE22 with $url!!<br/>Last status codes<b/>:".json_encode($status)."<br/><br/>Last data got<br/>:$data";
	}
}
?>
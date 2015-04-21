<?php
/**
 * Plugin Name: Multi-Language Site
 * Description: Build a Multi-Language Site. This plugin gives you a good framework. After activation, read the explanation.  (P.S.  OTHER MUST-HAVE PLUGINS FOR EVERYONE: http://bitly.com/MWPLUGINS  )
 * Version: 1.28
 -- future to-do list: sticky posts query (http://goo.gl/otIDaA); tags; autors pages should contain only langs..; category is found on any 404 page, if basename meets category..
 global $wpdb; $zzzzzz = $wpdb->query(DELETE FROM `'.$wpdb->prefix.'` WHERE `meta_key` = '_wp_old_slug');
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
	
	//option names
define('SITESLUG__MLSS',				str_replace('.','_',$_SERVER['HTTP_HOST'])  );
define('cookienameLngs__MLSS',			SITESLUG__MLSS.'_lang');
define('C_CategPrefix__MLSS',			''); //'_'.get_option('optMLSS__CategSlugname', 'categories')
define('S_CategPrefix__MLSS',			'');
define('PagePrefix__MLSS',				''); //'_'.get_option('optMLSS__PageSlugname', 'pages')
//
define('CatBaseWpOpt__MLSS',			get_option('category_base') );
		define('CAT_BASE_WpOption_IS_EMPTY__MLSS', ( in_array(CatBaseWpOpt__MLSS, array('.','/.','\.')) ? true:false)   );
	//others
	$x= get_option('optMLSS__CatBaseRemoved','y');
define('REMOVE_CAT_BASE_FUNC__MLSS', ('y'==$x ? true : false) );
define('REMOVE_CAT_BASE_WpOption__MLSS', false);   //this is just a backup alternative for me..
		define('CAT_BASE_NOT_USED__MLSS', ((REMOVE_CAT_BASE_FUNC__MLSS || REMOVE_CAT_BASE_WpOption__MLSS || CAT_BASE_WpOption_IS_EMPTY__MLSS) ? true:false)   );

		 
		
//Redirect to SETTINGS (after activation)
add_action( 'activated_plugin', 'activat_redirect__MLSS' ); function activat_redirect__MLSS( $plugin ) { 
    if( $plugin == plugin_basename( __FILE__ ) ) { exit( wp_redirect( admin_url( 'admin.php?page=my-mlss-slug' ) ) );  }
}
//==================================================== ACTIVATION commands ===============================
register_activation_hook( __FILE__, 'activation__MLSS' );function activation__MLSS() { 	global $wpdb;
	update_option( 'optMLSS__NeedFlush','okk');
	if (!get_option('optMLSS__Lngs')) {
		update_option('optMLSS__Lngs','English{eng},Русский{rus},Japan{jpn}');
		update_option('optMLSS__HiddenLangs',		'Japan{jpn},Dutch{nld},');
		update_option('optMLSS__DefForOthers',		'dropdownn');
		update_option('optMLSS__FirstMethod',		'dropddd');
			//
			if (REMOVE_CAT_BASE_WpOption__MLSS) {
				update_option('optMLSS__Cat_base_BACKUP',	CatBaseWpOpt__MLSS);
				$GLOBALS['wp_rewrite']->set_category_base('/.'); $GLOBALS['wp_rewrite']->flush_rules();  
				//update_option('category_base',				'/.'); 	$GLOBALS['wp_rewrite']->flush_rules();  
				//$wp_rewrite->set_permalink_structure('/%postname%/' );
				//do_action ( 'permalink_structure_changed',$old_permalink_structure,$permalink_structure );
			}
			//
		update_option('optMLSS__BuildType',			'custom_p');  
		update_option('optMLSS__Target_'.'rus',		'Russian Federation,Belarus,Ukraine,Kyrgyzstan,');
		update_option('optMLSS__Target_'.'default',	'eng');
		//
		update_option('optMLSS__DropdHeader','y'); update_option('optMLSS__DropdSidePos','left'); update_option('optMLSS__DropdDistanceTop','70');update_option('optMLSS__DropdDistanceSide','50');
		//
		update_option('optMLSS__CategSlugname',	'');   update_option('optMLSS__PageSlugname', '');
		update_option('optMLSS__EnableQueryStrPosts',	'n');
		update_option('optMLSS__EnableCustCat',			'n');
		update_option('optMLSS__CatBaseRemoved',		'y');
		//update_option('optMLSS__ShowHideOtherCats',		'n'); update_option('optMLSS__HidenEntriesIdSlug',	'post-');
	}
	
		$x= $wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."translatedwords__mlss` (
		`IDD` int(11) NOT NULL AUTO_INCREMENT,
		`title_indx` varchar(150) SET utf8 NOT NULL,
		`lang` varchar(150) SET utf8 NOT NULL,
		`translation` LONGTEXT SET utf8 NOT NULL DEFAULT '',
		`mycolumn3` LONGTEXT CHARACTER SET utf8 NOT NULL DEFAULT '',
		PRIMARY KEY (`IDD`),
		UNIQUE KEY `IDD` (`IDD`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=10; ");
	UPDATEE_OR_INSERTTT__MLSS($wpdb->prefix."translatedwords__mlss",
							array('translation'=>'Hii user!!!'),
							array('title_indx'=>'my_HeadingMessage', 'lang'=>'eng'));
	UPDATEE_OR_INSERTTT__MLSS($wpdb->prefix."translatedwords__mlss",
							array('translation'=>'haи иуzer!'),
							array('title_indx'=>'my_HeadingMessage', 'lang'=>'rus'));
	//flush-update permalinks for CUSTOM POST TYPES 
	DetermineLanguages__MLSS(); myf_63__MLSS();	flush_rewrite_rules();
	
	
	//=================================================================
	//================insert SAMPLE CATEGORIES and PAGES===============
	//=================================================================
	//categories
	$slug= S_CategPrefix__MLSS;
	if (!term_exists('eng'.$slug, 'category')){       // https://codex.wordpress.org/Function_Reference/wp_insert_term
		$parentt= wp_insert_term('eng'.$slug,'category', array());
			$PT= get_term_by('slug', 'eng'.$slug, 'category');
		$subb= wp_insert_term('my-sub-categorryy',	'category', array('parent'=>$PT->term_id)); 
	}	
	if (!term_exists('rus'.$slug, 'category')){       // https://codex.wordpress.org/Function_Reference/wp_insert_term
		$parentt= wp_insert_term('rus'.$slug,'category', array());
			$PT= get_term_by('slug', 'rus'.$slug, 'category');
		$subb= wp_insert_term('my-sub-categ',	'category', array('parent'=>$PT->term_id)); 
	}
	//pages
	$slug= PagePrefix__MLSS;
		$page =get_page_by_path('eng'.$slug, OBJECT, 'page');
		//see, if exists,but trashed
		if($page && 'trash'==$page->post_status){wp_update_post(array('ID'=>$page->ID,'post_status'=>'draft'));}
		elseif(!$page){
		  $parentt	= wp_insert_post(array('post_title'=>'eng'.$slug,	'post_name'=>'eng'.$slug,	'post_type'=>'page','post_content'=>'samplee'));
		  $subb		= wp_insert_post(array('post_title'=>'my-sub-page1','post_name'=>'my-sub-page1','post_type'=>'page','post_content'=>'samplee','post_parent'=> $parentt));
		}
	
		$page =get_page_by_path('rus'.$slug, OBJECT, 'page');
		//see, if exists,but trashed
		if($page && 'trash'==$page->post_status){wp_update_post(array('ID'=>$page->ID,'post_status'=>'draft'));}
		elseif(!$page){
		  $parentt	= wp_insert_post(array('post_title'=>'rus'.$slug,	'post_name'=>'rus'.$slug,  'post_type'=>'page','post_content'=>'samplee'));
		  $subb		= wp_insert_post(array('post_title'=>'my-sub-paag',	'post_name'=>'my-sub-paag','post_type'=>'page','post_content'=>'samplee','post_parent'=> $parentt));
		}
}
register_deactivation_hook( __FILE__, 'deactivation__MLSS' ); function deactivation__MLSS() { 
	if (REMOVE_CAT_BASE_WpOption__MLSS) {	update_option('category_base', get_option('optMLSS__Cat_base_BACKUP')); }
	flush_rewrite_rules(); 
}
//=================================================== ### ACTIVATION commands===============================







//========================================= SEVERAL USEFUL FUNCTIONS ===============================
//it's better,that useless pages not indexed in GOOGLE...
add_action( 'wp_head', 'noindex_pagesss__MLSS' );	function noindex_pagesss__MLSS() 	{
	if ( !is_404() && !is_page() && !is_single() && !is_search() && !is_archive() && !is_admin() && !is_attachment() && !is_author() && !is_category() && !is_front_page() && !is_home() && !is_preview() && !is_tag()) 
	{	echo '<meta name="robots" content="noindex, nofollow">';	}
}		
function iss_admiiiiiin__MLSS()	{require_once(ABSPATH . 'wp-includes/pluggable.php');
		if (current_user_can('create_users')){return true;}
		else {return false;}
}
function PostRootCatDetect__MLSS ($postid=false, $catid=false) { $catParent='';
	if (!$postid){$postid=$GLOBALS['post']->ID;}
	if (!$catid) {$catid=get_the_category($postid)[0]->term_id ;}
	// continue, untill a parent $catid will be null
	while ($catid) 	{ $cat = get_category($catid);	$catid = $cat->category_parent;  $catParent=$cat->slug; }
	return $catParent;
}
function DetectedPostLang__MLSS($postid=false, $catid=false){
	$catBase = PostRootCatDetect__MLSS($postid); 
	if (in_array($catBase, LANGS__MLSS())){return $catBase;} else {return false;}
}
//https://github.com/tazotodua/useful-php-scripts/blob/master/mysql-commands%20%28%2BWordpress%29.php
function UPDATEE_OR_INSERTTT__MLSS($tablename, $NewArrayValues, $WhereArray){	global $wpdb;
	  //convert array to STRING
	  $o=''; $i=1; foreach ($WhereArray as $key=>$value){ $o .= $key." = '".$value."'";   if(count($WhereArray)!=$i){$o .=' AND ';$i++;} }
	  $CheckIfExists = $wpdb->get_results("SELECT * from `".$tablename."` WHERE ".$o);
	//check if already exist
	if (!empty($CheckIfExists))   { $wpdb->update($tablename,  $NewArrayValues,	$WhereArray );}
	else                          { $wpdb->insert($tablename,  array_merge($NewArrayValues, $WhereArray));  }
}	


//DUE TO WORDPRESS BUG ( https://core.trac.wordpress.org/ticket/32023 ) , i use this: (//USE ECHO ONLY! because code maybe executed before other PHP functions.. so, we shouldnt stop&redirect, but  we should redirect from already executed PHP output )
define('ReFlushREDIRECT__MLSS',			'<form name="mlss_frForm" method="POST" action="" style="display:none;"><input type="text" name="mlss_FRRULES_AGAIN" value="ok" /> <input type="submit"></form><script type="text/javascript">document.forms["mlss_frForm"].submit();</script>');


function errorrrr_404__MLSS(){
	if (is_404() && WP_USE_THEMES === true )	{NOTFOUNDDD_REDIRECT2__MLSS(homURL,'problemm_702');}   
}
//404 inside "add_action" may cause problems in custom pages (i.e. where include(..'/wp-load.php');). So, it's better,that this function was in header.php

function NOTFOUNDDD_REDIRECT2__MLSS($urll,$myHINT){
	//global $wp_query;$wp_query->set_404();status_header(404);nocache_headers();
	header("HTTP/1.1 404 Not Found");header('Cache-Control: no-store, no-cache, must-revalidate');header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');  
	header("location:" . $urll ) or die('File:'.dirname(__file__).'['.$myHINT.'] (FROM:'.$_SERVER['REQUEST_URI'].'  TO:'.$urll .')');
}
	//FIX for WP BUG: Appearence>customize.php:
	if (stripos(currentURL__MLSS, str_replace(home_url(),'',admin_url('customize.php'))) !== false)	{define('MLSS_cstRedirect',true); setcookie('MLSS_cstRedirect', 'hii', time()+100000000, homeFOLD__MLSS);}
	else															{setcookie('MLSS_cstRedirect', 'hii', time()-100000000, homeFOLD__MLSS);}
function PERMANENTTT_REDIRECT2__MLSS($urll,$myHINT)	{
					if (!empty($_COOKIE['MLSS_cstRedirect']) || defined('MLSS_cstRedirect')) {return;}
	header("HTTP/1.1 301 Moved Permanently");header('Cache-Control: no-store, no-cache, must-revalidate');header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
	header("location:" . $urll ) or die('File:'.dirname(__file__).'['.$myHINT.']  (FROM:'.$_SERVER['REQUEST_URI'].'  TO:'.$urll .')');
	// echo '<script> window.location="'.homeURL__MLSS.'/'.LNG'"; </script> '; exit;
}
//================================================= ##### SEVERAL USEFUL FUNCTIONS ===============================




















//==================================================== pre-define languages ===============================
//add_action('muplugins_loaded','DetermineLanguages__MLSS',1); 
DetermineLanguages__MLSS(); 
function DetermineLanguages__MLSS(){
	// see COUNTRY_NAME abbreviations here (should be 639-3 type)  - http://www-01.sil.org/iso639-3/codes.asp?order=reference_name&letter=g ( OR http://en.wikipedia.org/wiki/ISO_639:k ) 
	$temp_contents = explode(',',  get_option('optMLSS__Lngs','None{none}') ); 
	foreach ($temp_contents as $value)	{ 	$value=trim($value);				//re-create array with KEYNAMES
		if (!empty($value))	{	preg_match('/(.*?)\{(.*)\}/si',$value,$nnn); 	//var_dump($nnn);exit;
			$finall[ trim($nnn[1]) ]=trim($nnn[2]);
		}
	}
	$GLOBALS['SiteLangs__MLSS'] = $finall;
}
	LANGS__MLSS(); //add_action('muplugins_loaded','LANGS__MLSS',1); 
	function LANGS__MLSS(){return $GLOBALS['SiteLangs__MLSS'];}
	
	Defines_MLSS();	//add_action('muplugins_loaded','Defines_MLSS',1); 
	function Defines_MLSS(){ foreach (LANGS__MLSS() as $n=>$v) { define ($v.'__MLSS',$v); define($v.'_title__MLSS',$n);} }
	
	//this function is(not?) loaded at this second		
	function MLSS_PHRAZE($variable){ global $wpdb; 
		$res = $wpdb->get_results("SELECT * from `".$wpdb->prefix."translatedwords__mlss` WHERE `title_indx`= '$variable' AND `lang` = '".LNG."'");
		return stripslashes($res[0]->translation);
	} add_filter('MLSS','MLSS_PHRAZE');
	
	//determine temporary hided languages by user
	$hidden_langs_mlss= get_option('optMLSS__HiddenLangs', 'Nothing{none}'); //let's make query only once..
	function isHiddenLang__MLSS($abbr){
		if (stripos($GLOBALS['hidden_langs_mlss'],'{'.$abbr.'}') !== false ) {return true;}
	}
//============================================================================================= //	
//======================================== SET LANGUAGE for visitor =========================== //	
//============================================================================================= //	
DetectLangUsingUrl__MLSS(); //add_action('mu_plugins_loaded', 'DetectLangUsingUrl__MLSS',1); 
function DetectLangUsingUrl__MLSS(){
	//if preview
	if (isset($_GET['previewDropd__MLSS'])) {define('ENABLED_FIRSTIME_POPUP_MLSS', true);return;}
				
	$hom=str_replace('/','\/', homeFOLD__MLSS);  $x=false;
	
	
	// ========================== if LANGUAGE was set using URL..===================//
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
			if ($p1)  { if ($catslug=DetectedPostLang__MLSS($p1->ID))	{ $x=$catslug; } }
		}
	//ANYTHING ALL (CUSTOM POST or etc)..(example.com/ENG/my-page)
		preg_match("/$hom\/(.*?)\//si",   						$_SERVER['REQUEST_URI'].'/',$n);		
		if(!$x && !empty($n[1]) && in_array($n[1], LANGS__MLSS()))         {$x=$n[1];}
	//COOKIEd URL 	
	if	(!$x && !empty($_COOKIE[cookienameLngs__MLSS]) && in_array($_COOKIE[cookienameLngs__MLSS], LANGS__MLSS()))     {$x = $_COOKIE[cookienameLngs__MLSS];} 
	// ==============================================================================//

					
	//FINAL SET
	define('found_lang__MLSS', ((!empty($x) && in_array($x, LANGS__MLSS() )) ?  $x :'')  );  //if incorrect language,do nothing..
	define('isHomeURI__MLSS',		(in_array($_SERVER['REQUEST_URI'], array(homeFOLD__MLSS.'/', homeFOLD__MLSS))  ?  true :false)  ); 
	define('isLangHomeURI__MLSS',	(found_lang__MLSS != '' && in_array(requestURI__MLSS, array( homeFOLD__MLSS.'/'.found_lang__MLSS,
																								 homeFOLD__MLSS.'/'.found_lang__MLSS.'/' )))
																								? true :false ); 

	//check if language is set for user.. priority language is given to URL parameter
	global $wpdb; $FIRST_TIME_METHOD=get_option('optMLSS__FirstMethod');
	
				
	
	//=========================================== INITIALIZE LANGUAGE ==================================
	//LANGUAGE detected
	if (found_lang__MLSS!=''){
		 define('LNG',found_lang__MLSS); setcookie(cookienameLngs__MLSS, found_lang__MLSS, time()+100000000, homeFOLD__MLSS);
		 if (isHomeURI__MLSS) {PERMANENTTT_REDIRECT2__MLSS(homeFOLD__MLSS.'/'.found_lang__MLSS, 'error1048 .contact administrator');}
	}
	//LANGUAGE was NOT detected
	else { 
		if (isHomeURI__MLSS){								//only check, when it's home URL
			if (empty($_COOKIE[cookienameLngs__MLSS])){ 	//if cookie not set, it may be the first-time visit
				if ($FIRST_TIME_METHOD=='dropddd')	{ define('ENABLED_FIRSTIME_POPUP_MLSS', true); return;}		
				if ($FIRST_TIME_METHOD=='fixeddd')	{ define('LNG',get_option('optMLSS__FixedLang')); }  //no need to set cookie
				if ($FIRST_TIME_METHOD=='ippp')		{ include( __DIR__ .'/flags/ip_country_detect/sample_test.php'); //gets $country_name
					if (!empty($country_name)){ 
						foreach (LANGS__MLSS() as $name=>$value){
							if (stristr(','.get_option('optMLSS__Target_'.$value).',', ','.$country_name.',')) {$xLang=$value;break;}
						}
					}
					if (isset($xLang)) { define('LNG',$xLang); setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
					else{
						if (get_option('optMLSS__DefForOthers')=='fixedd'){ define('LNG',get_option('optMLSS__Target_'.'default')); 
							setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
						else{	define('ENABLED_FIRSTIME_POPUP_MLSS', true);return;	}
					}
				}
						//if unknown situation happens, set default...   better not to set cookie at this time
				if (!defined('LNG')) { 
					define('LNG', (get_option('optMLSS__Target_default') ? get_option('optMLSS__Target_default') : $GLOBALS['SiteLangs__MLSS'][0]) ) ;
				}
				PERMANENTTT_REDIRECT2__MLSS( homeURL__MLSS.'/'.LNG, 'problemm_708' );    //redirect is needed
			}
			else{	//if cookie was set already 
				define('LNG', $_COOKIE[cookienameLngs__MLSS]); 	// no need to set cookie again...
				PERMANENTTT_REDIRECT2__MLSS(homeURL__MLSS.'/'.LNG, 'problemm_709' );
				//else {}  //when the page is unknown (for example, custom page or "wp-login.php" or etc... then we dont need redirection
			}
		}
		//IF it not home
		else{}  //(if it's like: site.com/?p=123&search=abc, then COOKIES will help us!)
			//when the page is unknown (for example, custom page or "wp-login.php" or etc... then we dont need redirection
	}
	
	
	//--------------------------------------------------------------------------------------
	//lets add one additional, luxury trick - if STANDARD(or unknown cutom) POST is published under language category.. (i.e. site.com/my-post), then detect it's language
	add_action('template_redirect','postrootCat__MLSS');function postrootCat__MLSS(){
		if ($catslug= DetectedPostLang__MLSS(url_to_postid(currentURL__MLSS))) {}
		elseif ($p1 = get_page_by_path(requestURIfromHomeWithoutParameters__MLSS, OBJECT, get_post_types(array('_builtin'=>true))))  { $catslug= DetectedPostLang__MLSS($p1->ID); }
		elseif ($catslug= DetectedPostLang__MLSS()) {}
		if ( $catslug) {
			//if language constant incorrectly is set for this post
			if ( (defined('LNG') && $catslug != LNG) || !defined('LNG')){  
				setcookie(cookienameLngs__MLSS, $catslug, time()+100000000, homeFOLD__MLSS);
				//$final_req = str_ireplace('lng='.$_SERVER['REQUEST_URI']);
				PERMANENTTT_REDIRECT2__MLSS($_SERVER['REQUEST_URI'], 'problemm_714' );	
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
add_action( 'init', 'myf_63__MLSS',1);function myf_63__MLSS() {
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
					'menu_icon'   => PLUGIN_URL_nodomain__MLSS.'flags/'.$value.'.png',  //below (using <style>) we also use CSS to resize these images
									// 'dashicons-editor-spellcheck', // https://developer.wordpress.org/resource/dashicons/#editor-spellcheck
					'hierarchical' => true,
					'has_archive' => true,
					'capability_type' => 'post',
					'supports' => array( 'title', 'editor', 'thumbnail' ,'page-attributes','post_tag', 'revisions','comments', ),
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
	if ( get_option( 'optMLSS__NeedFlush' ))	{ $GLOBALS['wp_rewrite']->flush_rules(); 
													echo ReFlushREDIRECT__MLSS;	delete_option('optMLSS__NeedFlush' ); }
	if (isset($_POST['mlss_FRRULES_AGAIN'])){ $GLOBALS['wp_rewrite']->flush_rules(); }
}
//================================= ##### POST TYPES =============================== //
//================================================================================== //		





























// ===================================================== QUERY MODIFY ============================================== //
// ================================================================================================================= //
//difference between [$query->is_XXX=true    and   $query->set('is_XXX', true) [set_query_var() is 100% this]
// http://wordpress.stackexchange.com/questions/130314/how-to-force-a-query-conditional
//ALSO possible:  query_posts(array( 'post_type' => 'portfolio','tax_query' => array(array('taxonomy' => LNG,'terms' => $cat->term_id,'field' => 'term_id')),	'orderby' => 'title',));


//QUERY FOR STARPAGE (i.e. yoursite.com/ENG,yoursite.com/CHN,..)
add_action( 'pre_get_posts', 'MAKE_POSTTYPE_STARTPAGE_AS_HOME__MLSS'); function MAKE_POSTTYPE_STARTPAGE_AS_HOME__MLSS($query) {
    if ( isLangHomeURI__MLSS && $query->is_main_query()   && !is_admin() ) { 	
		//if static ID is set for the language's STARTPAGE
		if ($optValue= get_option('optMLSS__HomeID_'.LNG)){ 
			$query->init();
					$post = get_post( $optValue, OBJECT);
					if($post->post_type==LNG || is_post_type_archive() )	{
						$query->parse_query( array('post_type' =>array(LNG)) );	
						$query->is_single = true;		
						$query->is_page = false; 
					} 
					elseif($post->post_type=='post') 						{
						$query->parse_query( array('post_type' =>array('post')) );	
						$query->is_single = true;		
						$query->is_page = false;
					}
					else 													{
						$query->parse_query( array('post_type' =>array('page')) );	
						$query->is_single = false;		
						$query->is_page = true;
					}
			
			$query->is_home = false;	
			$query->is_singular = true;
			$query->queried_object_id = $optValue; //get_post(get_option('page_on_front') ); 
				$query->set( 'page_id', $optValue );
			//add some links
			add_action('shutdown','showw_EDIT_LINK__MLSS',99);
		}
		else{
			//check if CUSTOM_POSTS is chosen by administrator as the website language BUILD-TYPE
			if (get_option('optMLSS__BuildType') == 'custom_p'){
				//set CUSTOM_POSTs archive it to behave as homepage
				$query->init();	$query->parse_query(array('post_type' => array(LNG) ));
				$query->is_home = true;
				$query->is_page = false;
				$query->is_archive = true;
				//$query->is_tax = false; $query->is_post_type_archive = true; 
			}
			else{
				//standard  CATEGORY
				$cat=term_exists(basename(currentURL__MLSS), 'category');
				if ($cat){  
					$tr = get_term_by('slug', basename(currentURL__MLSS) , 'category');
					$query->init();	$query->parse_query(array('post_type' => array('post') ,
										'tax_query' =>array(array('taxonomy' => 'category','terms' => $tr->term_id,'field' => 'term_id'))));
					$query->is_home = true;
					$query->is_page = false;
					$query->is_archive = true;
					
					$query->is_category = false; //$query->set('cat', $tr->term_id);	
					$query->is_single = false;
					//$query->queried_object=$tr; $query->queried_object_id=$tr->term_id; $query->set('queried_object_id',.. 
				}
			}
		}
    }
	return $query;
}



//QUERY FOR ALL OTHER PAGES( due WORDPRESS QUERY BUG, i have made this correction )...   i.e. yoursite.com/eng/categ2/TORNADOO
add_action( 'pre_get_posts', 'SOPHISTICATED_QUERY__MLSS'); function SOPHISTICATED_QUERY__MLSS($query) {
    if ( !isLangHomeURI__MLSS && $query->is_main_query()  && !is_admin() ) {
		
		//within custom language posts, when the PERMALINK was not found, then 404 maybe triggered.. But wait! maybe it is a standard post, under the standard category(which's name is i.e. "eng")
		$CustBuildEnabled 	= 'custom_p'==get_option('optMLSS__BuildType') ? true:false ;
		$CustTaxonmEnabled	= 'y'		==get_option('optMLSS__EnableCustCat') ? true:false ;
		
		//url details
		$PostOrPageDetectedByWp = url_to_postid(currentURL__MLSS); //detects only for posts,pages and custom posts,
		
		$UrlArray=explode('/',requestURIfromHome__MLSS); $k=array_values(array_filter($UrlArray));
		$PathAfterHome=requestURIfromHomeWithoutParameters__MLSS;
		$PathAfterLangRoot=substr($PathAfterHome, 4);
		$BaseSLUG=basename(currentURL__MLSS);  //i.e. "TORNADOO"

		//var_dump($PostOrPageDetectedByWp);
		//if (!$PostOrPageDetectedByWp)
		if (1==1)
		{ 
			//============CUSTOM TAXONOMY=============== 
			if ($CustBuildEnabled){ //IF ENABLED
				if ($CustTaxonmEnabled){ //IF ENABLED
					//term_is_ancestor_of  get_term_link( 
					//$terms = get_the_terms( $post->ID, 'taxonomy'); foreach ( $terms as $term ) {    $termID[] = $term->term_id;}echo $termID[0]; 
					//get_queried_object()->name;
					//$term_slug = get_query_var( 'term' );
					//$taxonomyName = get_query_var( 'taxonomy' );
					//$current_term = get_term_by( 'slug', $term_slug, $taxonomyName );
					
					$term= term_exists($BaseSLUG, LNG);
					if ($term){  
						$tr = get_term_by('slug', $BaseSLUG , LNG);
						$query->init();	$query->parse_query(array('post_type' => array(LNG) ,
											'tax_query' =>array(array('taxonomy' => LNG,'terms' => $tr->term_id,'field' => 'term_id'))));
						$query->is_home = false;
						$query->is_single = false;
						$query->is_archive = true;
						$query->is_tax = true;
						$query->is_post_type_archive=false;
						//$query->queried_object=$tr; $query->queried_object_id=$tr->term_id; $query->set('queried_object_id',.. 
						return $query;
					}
				}
			}
			
			//===========standard category==========  (WE MUST CHECK IT!! because we use . as CATEGORY BASE, and wordpress bugs that..)
			//special query for categories	.. for example, url is: yoursite.com/category/extrapart/blabla
						if(CAT_BASE_NOT_USED__MLSS){  $cBase= '/'.CatBaseWpOpt__MLSS;
							$LengthOfCBase = strlen($cBase);
							$UrlStartPart = substr($PathAfterHome,0,$LengthOfCBase);	//i.e. "/CATEGORY"
							if ($UrlStartPart == $cBase){
								$PathCAT = substr($PathAfterHome,$LengthOfCBase);		//i.e. "/EXTRAPART/BLABLA"
							}
						}
			$cat= get_category_by_path( ( isset($PathCAT) ?  $PathCAT : $PathAfterHome) , true ); // term_exists($BaseSLUG, 'category'); <-- this bugs, because  /mylink/smth >"smth" may be categoryy too, so, post may become  overrided in this case..
			if ($cat){   
				$tr = get_term_by('slug', $BaseSLUG , 'category');
				$query->init();	$query->parse_query(array('post_type' => array('post') ,
									'tax_query' =>array(array('taxonomy' => 'category','terms' => $tr->term_id,'field' => 'term_id'))));
				$query->is_home = false;
				$query->is_single = false;
				$query->is_archive = true;
				$query->is_tax = true;
				$query->is_post_type_archive=false;
				//$query->queried_object=$tr; $query->queried_object_id=$tr->term_id; $query->set('queried_object_id',..
				return $query;	
			}
			
						
			//===========CUSTOM post===========
							if ($CustBuildEnabled){ 
			$post= ($x = get_page_by_path($PathAfterHome, OBJECT, LNG)) ?  $x : ''; //get_page_by_path($BaseSLUG...
			if ($post){ 
				$query->init();	$query->parse_query(   array('post_type' =>array($post->post_type) )  ) ;	
				$query->is_single = true;	
				$query->is_page = false;	
				$query->is_home = false;	
				$query->is_singular = true;
				$query->queried_object_id = $post->ID; 
				$query->set('page_id', $post->ID );
				return $query;
			}
							}
			
			
			//===========standard page===========
			$post=($x = get_page_by_path($PathAfterHome, OBJECT, 'page')) ?  $x : ''; // get_page_by_path($BaseSLUG...
			if ($post){ 
				$query->init();	$query->parse_query(   array('post_type' =>array($post->post_type) )  ) ;	
				$query->is_home = false;	
				$query->is_single = false;	
				$query->is_singular = true;	
				$query->is_page = true;
				$query->queried_object_id = $post->ID; 
				$query->set( 'page_id', $post->ID );
				return $query;
			}
			
			//===========standard post===========
			$post= ($x = get_page_by_path($PathAfterHome, OBJECT, 'post')) ?  $x : ''; //get_page_by_path($BaseSLUG...
			if ($post){ $passed=true; 
				for($i=0; $i<count($k)-1; $i++){ $cat = get_term_by('slug', $k[$i], 'category'); 
					if(!(in_category($cat->term_id,$post->ID) || post_is_in_descendant_category(array($cat->term_id),$post->ID))){ $passed=false; break; }
				} if ($passed){
				//new query
				$query->init();	$query->parse_query(   array('post_type' =>array('post'))  ) ;	
				//others
				$query->is_home = false;	
				$query->is_single = true;	
				$query->is_singular = true;	
				$query->is_page = false;
				$query->queried_object_id = $post->ID; 
				$query->set( 'page_id', $post->ID );
				return $query;
				}
			}

			
		//---------------------------------------------------------------------------------//
		//-----------"I dont know"  why i have to manually make query, and why not WP makes itself?? ------------------//
		//---------------------------------------------------------------------------------//			
			//if other CUSTOM TAXONOMY (i.e. my_products,  or etc..)..
			if(is_post_type_archive()){
				
			}
			$term= term_exists($BaseSLUG, 'xxxxx');
			if ($term){   
				$tr = get_term_by('slug', $BaseSLUG , LNG);
				$query->init();	$query->parse_query(array('post_type' => array(LNG) ,
									'tax_query' =>array(array('taxonomy' => LNG,'terms' => $tr->term_id,'field' => 'term_id'))));
				$query->is_home = false;
				$query->is_single = false;
				$query->is_archive = true;
				$query->is_tax = true;
				$query->is_post_type_archive=false;
				//$query->queried_object=$tr; $query->queried_object_id=$tr->term_id; $query->set('queried_object_id',.. 
				return $query;
			}
					
			//===========OTHER CUSTOM POST TYPE===========
					$other_ctypes_final = array_values(get_post_types(array('_builtin'=>false )));
					//$other_ctypes_final= array_diff($other_ctypes1, LANGS__MLSS());
					//$other_ctypes_final[]=LNG;
			$post= ($x = get_page_by_path($BaseSLUG, OBJECT, $other_ctypes_final)) ?  $x : ''; //get_page_by_path($BaseSLUG...
			if ($post){
				$query->init();	$query->parse_query(   array('post_type' =>array($post->post_type))  ) ;	
				//others
				$query->is_home = false;	
				$query->is_single = true;	
				$query->is_singular = true;	
				$query->is_page = false;
				$query->queried_object_id = $post->ID; 
				$query->set( 'page_id', $post->ID );
				return $query;
			}
			
			//--------------------------"I dont know"  block :))-------------------------------//
			//---------------------------------------------------------------------------------//
			
			
			
		}
	}
	return $query;
}	
	if ( ! function_exists( 'post_is_in_descendant_category' ) ) { function post_is_in_descendant_category( $cats, $_post = null ) {
			foreach ( (array) $cats as $cat ) {	$descendants = get_term_children( (int) $cat, 'category' );
				if ( $descendants && in_category( $descendants, $_post ) ) {return true;}				
			}return false;
		}
	}	
	function showw_EDIT_LINK__MLSS(){ ?><script>var adminbar__MLSS= document.getElementById("wp-admin-bar-root-default"); if (adminbar__MLSS) {adminbar__MLSS.innerHTML += '<li id="wp-admin-bar-editMlssHome"><a class="ab-item" href="<?php echo get_edit_post_link($GLOBALS['post']->ID);?>" ><span class="ab-icon"></span><span class="ab-label">*EDIT*</span></li>';}</script>	<?php }

	
	
//================== SEARCH FILTER ===================
add_action('pre_get_posts','search_filterr__MLSS');function search_filterr__MLSS($query) {
	if ( !is_admin() && $query->is_main_query() ) 	{
		if ( $query->is_search ) {
			$arrs= array_merge(array(), array());
			$RootCat	= get_term_by('slug', LNG, 'category');
				$All_categories=get_categories('parent=0&hide_empty=0&taxonomy=category');
				foreach ($All_categories as $category) { if ($category->slug != LNG){ $OtherCats[]=$category->term_id; }	}
			//$RootPage= get_page_by_path(LNG, OBJECT, 'page');
			
			//var_dump($OtherCats);exit;
			if (get_option('optMLSS__BuildType') == 'custom_p'){
							//$arrs[]='page';  //pages are exluded -hard for me..  post_parent=> 
				$arrs[]=LNG;
				$arrs[]='post';	
				$query->set('post_type',  $arrs );	$query->set('category__not_in', $OtherCats);
			}
			else {
							//$arrs[]='page';  //pages are exluded -hard for me..  post_parent=> 
				//$arrs[]=LNG;
				$arrs[]='post';			
				$query->set('post_type',  $arrs );	$query->set('category__in', $RootCat);
				//add_filter( 'posts_where' , 'MyFilterFunction_1__MLSS' );
			}
		}
	}
	return $query;
}
	function MyFilterFunction_1__MLSS( $where ) { global $wpdb; 
		$cat_id = get_query_var('cat');
		$this_cat = get_category($cat_id);
		if (!in_array($cat_id,44444) && !in_array($this_cat->parent, 33333) ){
			$where .= " AND ({$wpdb->posts}.post_excerpt NOT LIKE '%myCutYout')";
		}
		return $where;
	}
// ========================================== ### QUERY MODIFY ========================================== //
// ====================================================================================================== //	
	

//add Language parameter to URL
add_filter( 'post_type_link', 'my_append_query_string', 10, 4 ); function my_append_query_string( $permalink, $post, $leavename, $sample ) {
	if (!in_array($post->post_type,    array_merge(LANGS__MLSS(),array('page')) )  ){ 
		if ('y'==get_option('optMLSS__EnableQueryStrPosts')){
			if ( $catSlug = DetectedPostLang__MLSS($post->ID)) { 
				$permalink = $permalink . ( !stripos($permalink,'?') ? "?lng=$catSlug" : "&lng=$catSlug") ; 	 //&&  get_option('permalink_structure') 
			} 
		}
	}
    return $permalink;
}
	
	
	
//Change category permalinks - REMOVE "/CATEGORY" base
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
	//$GLOBALS['wp_rewrite']->flush_rules();
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
	
	
	
	
	
	
	
	
//======================================= SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //			
add_action( 'wp_enqueue_scripts', 'stylesht__MLSS',99,99 ); function stylesht__MLSS() {
	wp_enqueue_style( 'custom_styles__MLSS', plugin_dir_url(__FILE__).'flags/stylesheet.css');
}

//first time visit POPUP
add_action('wp_head','OutputFirstTimePopup__MLSS',99); function OutputFirstTimePopup__MLSS(){
	if ( defined('ENABLED_FIRSTIME_POPUP_MLSS') && count(LANGS__MLSS()) > 1) {
	?>
		<?php //echo '<link rel="stylesheet" id="mlsss_css"  href="'.PLUGIN_URL_nodomain__MLSS.'flags/stylesheet.css" type="text/css" media="all" />';
		include_once(__DIR__.'/flags/javascript_functions.php'); echo '<div></div><script>SHOW_blackGROUND();</script>';
		?>
		<div id="FirstTimeLanguage1__MLSS"  class="css_reset__MLSS">
			<?php
			// ============================ COMBINE the "FIRST TIME POPUP" and "LANGUAGE DROPDOWN" initializations ===========
			//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors
			$SITE_LANGUAGES=LANGS__MLSS(); 
			$Choose_POPUP	='<div id="popup_CHOOSER2__MLSS"><div class="lnmenu__MLSS">';
			foreach ($SITE_LANGUAGES as $keyname => $key_value){
								$targt_lnk=homeURL__MLSS.'/'.$key_value;
								//if language is not included in "HIDDEN LANGS" option
								if (!isHiddenLang__MLSS($key_value) ) {
				$Choose_POPUP	.='<div class="LineHolder2__MLSS">'.
									'<a class="ImgHolder2__MLSS"  href="'. $targt_lnk.'">'.
										'<img class="FlagImg2__MLSS '.$key_value.'_flagg2__MLSS" src="'. PLUGIN_URL_nodomain__MLSS .'flags/' . $key_value .'.png" alt="'. strtoupper($keyname) .'" />'.
										'<span class="lnmenuSpn2__MLSS">'. $keyname.'</span>'.
									'</a>'.
								'</div>';										}
			}
			$Choose_POPUP .= '</div></div>';
			echo $Choose_POPUP; 
			?>
		</div>
		<?php exit;
	}
}




//Display dropdown on every page 
add_action('wp_footer',	'OutputDropdown__MLSS'); function OutputDropdown__MLSS(){
	if ('y' == get_option('optMLSS__DropdHeader') ) {
	?> 
	<style>#LanguageDropdown1__MLSS {<?php echo 'top:'.get_option('optMLSS__DropdDistanceTop').'px;'.get_option('optMLSS__DropdSidePos').':'.get_option('optMLSS__DropdDistanceSide').'px;';?></style>
	<div id="LanguageDropdown1__MLSS" class="css_reset__MLSS">
	<?php
		// ============================ COMBINE the "FIRST TIME POPUP" and "LANGUAGE DROPDOWN" initializations =======
		//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors
		$DisableCurrentLangClick = true;
		$SITE_LANGUAGES=LANGS__MLSS();
		//If language is set, then sort languages, as the first language FLAG should be the current language
		if (defined('LNG')) {						function fix_1($i){return $i != LNG;}
			$SITE_LANGUAGES = array_filter($SITE_LANGUAGES,  fix_1);							//remove current language
			$SITE_LANGUAGES = array( constant(LNG."__MLSS") => LNG) + $SITE_LANGUAGES; 			//insert current language in first place
		}		
		$lng_Dropdown	='<div id="LangDropMenu1__MLSS"><div id="AllLines1__MLSS">     <a href="javascript:MyMobileFunc__MLSS();" id="LngSelector1__MLSS">&#8897;</a>';
		foreach ($SITE_LANGUAGES as $keyname => $key_value){
						$targt_lnk=homeURL__MLSS.'/'.$key_value;
						//if language is not included in "HIDDEN LANGS" option
						if (!isHiddenLang__MLSS($key_value)) {
			$lng_Dropdown .='<div class="LineHolder1__MLSS" myyhref="'.$targt_lnk.'" id="lnh_'.$key_value.'">'.
								'<a class="ImgHolder1__MLSS" '.(   ($DisableCurrentLangClick && $key_value == LNG) ? '': 'href="'.$targt_lnk.'"') .'>'.
									'<img class="FlagImg1__MLSS '.$key_value.'_flagg1__MLSS" src="'. PLUGIN_URL_nodomain__MLSS .'flags/'. $key_value .'.png" />'.
								'</a>'.
							'</div>'
							.'<span class="clerboth2__MLSS"></span>'
							;
																												}
		}
		$lng_Dropdown .= '</div></div>';
		echo $lng_Dropdown;
		?>
	</div><!-- LanguageDropdown1__MLSS -->
	<script type="text/javascript">
		//============styles========
			//GETproperty >> http://stackoverflow.com/questions/324486/how-do-you-read-css-rule-values-with-javascript/29130215
			//function GETproperty(classOrId,property){ 
			//	var FirstChar = classOrId.charAt(0);  var Remaining= classOrId.substring(1);
			//	var elem = (FirstChar =='#') ?  document.getElementById(Remaining) : document.getElementsByClassName(Remaining)[0];
			//	return window.getComputedStyle(elem,null).getPropertyValue(property);
			//}
		//var ldrmen = document.getElementById("LangDropMenu1__MLSS");
		//var flagHeight = GETproperty(".FlagImg1__MLSS","height"); 
		//	ldrmen.style.height = parseInt(flagHeight.replace("px","")) + 0 + "px";
		//===========## style========
	
		var langMenu__MLSS = document.getElementById("LanguageDropdown1__MLSS");
				var BODYYY__MLSS = document.body;	BODYYY__MLSS.insertBefore(langMenu__MLSS, BODYYY__MLSS.childNodes[0]);
		var langmnSelcr__MLSS=document.getElementById("LngSelector1__MLSS"); 
		var AllLines1__MLSS=document.getElementById("AllLines1__MLSS");
		var AllLines1_startHEIGHT__MLSS= AllLines1__MLSS.clientHeight; //overflow maybe  hidden white started
		
		
		//for language chooser for mobile devices (if mobile device..so, instead of hover, we need "onclick" action) to be triggered while clicked on the main div
		var isMobile__MLSS=<?php include_once(__DIR__ .'/flags/detect_platform.php'); echo ( ($MLSS_VARS['isMobile']) ? "true":"false");?>;
		function MyMobileFunc__MLSS(){	if (isMobile__MLSS){	HideShowAllLines1__MLSS("show1");	}	}
																//langmnSelcr__MLSS.addEventListener('click', function(){...}, false);}
		shownOrHidden__MLSS=false;
		function HideShowAllLines1__MLSS(mystring)	{
			if (shownOrHidden__MLSS === true){ shownOrHidden__MLSS = false;
				AllLines1__MLSS.style.overflow="hidden";	AllLines1__MLSS.style.height=AllLines1_startHEIGHT__MLSS + "px";	
			}
			else{ shownOrHidden__MLSS = true;
				AllLines1__MLSS.style.overflow="visible";	AllLines1__MLSS.style.height="auto";
			}
		}

	</script>
	<?php 
	}
}
//================================= ##### SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //	


	
	
	
	
	
	
	
		
	
	
	
	
	
//======================================= HIDE/SHOW special WIDGETS  ============================ //
//=============================================================================================== //		

//ADD classname to widget ..  THANKS to AUTHOR of "SIMPLE WIDGET CLASSES" ( http://markwilkinson.me/saythanks )
class Simple_Widget_Classes__MLSS {
	public function __construct() {	add_filter( 'widget_form_callback', array( $this, 'Form' ), 9, 2 );
		add_filter( 'widget_update_callback', array ($this, 'Update' ), 9, 2 ); 	add_filter( 'dynamic_sidebar_params', array( $this, 'Apply' ), 9 ); }
	//add form into ADMIN SIDEBARS
	function form( $instance, $widget ) {
		if( !isset($instance['WidgetLang__MLSS']) ) { $instance['WidgetLang__MLSS'] = null; }	?>
		<p><label for='widget-<?php echo $widget->id_base; ?>-<?php echo $widget->number; ?>-WidgetLang__MLSS'>(MLSS) Shown on Language:
				<select class="widefat" id="<?php echo $instance[ 'WidgetLang__MLSS' ]; ?>" name="widget-<?php echo $widget->id_base; ?>[<?php echo $widget->number; ?>][WidgetLang__MLSS]">
					<option value="ALL">EVERYWHERE</option>
					<?php foreach (LANGS__MLSS() as $name=>$value) { 
						echo '<option value="'.$value. '"'. ( ($value==$instance['WidgetLang__MLSS']) ? 'selected':'' )."> $value ($name)</option>";}?>
				</select>
		</label></p> <?php return $instance;
	}
	function Update($instance,$new_instance) {$instance['WidgetLang__MLSS']=wp_strip_all_tags($new_instance['WidgetLang__MLSS']);return $instance;}
	// implement on frontend or ??? add  input box to each widget in the ADMIN DASHBOARD
	function Apply( $params ) {	global $wp_registered_widgets;	$widget_id = $params[0][ 'widget_id' ];	$widget = $wp_registered_widgets[ $widget_id ];
		if ( !( $widgetlogicfix = $widget['callback'][0]->option_name ) )
			// because the Widget Logic plugin changes this structure - how selfish of it!
			$widgetlogicfix = $widget['callback_wl_redirect'][0]->option_name;	$option_name = get_option( $widgetlogicfix );	$number = $widget['params'][0]['number'];
			
		if( isset( $option_name[ $number ][ 'WidgetLang__MLSS' ] ) && !empty( $option_name[ $number ][ 'WidgetLang__MLSS' ] ) ) {
			// find the end of the class= part and replace with new 
			$params[0]['before_widget'] = preg_replace('/"\>/', ' MLSS_widget_'.$option_name[$number]['WidgetLang__MLSS'].'">', $params[0]['before_widget'], 1);
		} return $params;}	
} $simple_widget_classes__MLSS = new Simple_Widget_Classes__MLSS();


//BASED ON CLASSNAME  -Hide Other Language Widgetssss
add_filter( 'dynamic_sidebar_params', 'widget_visible__MLSS', 10); function widget_visible__MLSS($params) {	global $wp_registered_widgets;
	$incl_clsnm= $params[0]['before_widget'];
	if (stripos($incl_clsnm,'MLSS_widget_') !== false && !is_admin() &&  (stripos($incl_clsnm,'MLSS_widget_ALL') === false && stripos($incl_clsnm,'MLSS_widget_'.LNG) === false)   ) { $params=array(); $params['blabla']=''; }  return $params;
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
	register_sidebar( array(
		'name' => 'sample_sidebar1__MLSS',						'id' => 'widget1__MLSS',
		'before_widget' => '<div class="sidebar1__MLSS">',		'after_widget' => '</div>',	
		'before_title' => '<h2 class="h2class__MLSS">',			'after_title' => '</h2>',
	) );
}

add_filter( 'widget_text', 'do_shortcode' ); //enable SHORTCODES in widgets

//http://codex.wordpress.org/Function_Reference/shortcode_atts
add_shortcode( 'MLSS_navigation', 'treemenuOutp__MLSS' ); function treemenuOutp__MLSS($atts){
	//http://codex.wordpress.org/Function_Reference/wp_nav_menu
	//http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
	echo wp_nav_menu( array('theme_location'=>'',    'menu'=> LNG.'_'.$atts['name'],
		'container'       => 'div',			'container_class' => 'sideMyBox',    'container_id'=> 'my_SideMenuTreeee',
		'menu_class'      => 'menu',		'menu_id'         => '',
		'echo'            => 0,				'fallback_cb'     => 'wp_page_menu',
			'before'=>'', 'after'=>'', 'link_before'=>'', 'link_after'=>'',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,	'walker'          => ''
	));
}
add_shortcode( 'MLSS_phrase', 'wordOutp__MLSS' ); function wordOutp__MLSS($atts){
	echo '<span class="mlss__WidgetText">'.apply_filters("MLSS",$atts['name']).'</span>';
}



include(__dir__.'/__admin_dashboard.php');
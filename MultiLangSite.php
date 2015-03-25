<?php
/**
 * Plugin Name: Multi-Language Site (basis)
 * Description: Build a Multi-Language Site. Basic framework for people and developers.  After activation, read the explanation. 
 * Version: 1.1
 */
if ( ! defined( 'ABSPATH' ) ) exit; //Exit if accessed directly

 //define essentials
define('domainURL__MLSS',				(((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']!=='off') || $_SERVER['SERVER_PORT']==443) ? 'https://':'http://')
										.$_SERVER['HTTP_HOST']);
define('homeURL__MLSS',					home_url());
define('homeFOLD__MLSS',				str_replace(domainURL__MLSS,'',	home_url()));
define('requestURI__MLSS',				$_SERVER["REQUEST_URI"]);
define('currentURL__MLSS',				domainURL__MLSS.requestURI__MLSS);
define('requestURIfromHome__MLSS',		str_replace(homeFOLD__MLSS, '',requestURI__MLSS) );
define('THEME_URL_WITHOUT_DOMAIN__MLSS',str_replace(domainURL__MLSS, '', get_template_directory_uri()) );
define('PLUGIN_URL_WITHOUT_DOMAIN__MLSS',str_replace(domainURL__MLSS, '', plugin_dir_url(__FILE__)) );
//option names
define('SITESLUG__MLSS',				str_replace('.','_',$_SERVER['HTTP_HOST'])  );
define('cookienameLngs__MLSS',			SITESLUG__MLSS.'_lang');
define('CategPrefix__MLSS',				get_option('optMLSS__CategSlugname', 'mycategories'));
define('PagePrefix__MLSS',				get_option('optMLSS__PageSlugnamed', 'parentpage'));


//==================================================== ACTIVATION command ===============================
add_action( 'activated_plugin', 'activat_redirect__MLSS' ); function activat_redirect__MLSS( $plugin ) { 
    if( $plugin == plugin_basename( __FILE__ ) ) {
        exit( wp_redirect( admin_url( 'admin.php?page=my-mlss-slug' ) ) );
    }
}

register_deactivation_hook( __FILE__, 'deactivation__MLSS' ); function deactivation__MLSS() { flush_rewrite_rules(); }
register_activation_hook( __FILE__, 'activation__MLSS' );function activation__MLSS() {
	if (!get_option('optMLSS__Lngs')) {
		update_option('optMLSS__Lngs','English(eng),Русский(rus),Spanish(spa),');
		update_option('optMLSS__HiddenLangs',		'Japan(jpn),Dutch(nld),');
		update_option('optMLSS__DefForOthers',		'dropdownn');
		update_option('optMLSS__FirstMethod',		'dropddd');
		//
		update_option('optMLSS__Target_'.'rus',		'Russian Federation,Belarus,Ukraine,Kyrgyzstan,');
		update_option('optMLSS__Target_'.'spa',		'Spain,Brazil,Argentina,');
		update_option('optMLSS__Target_'.'default',	'eng');
		//
		update_option('optMLSS__DropdHeader','y'); update_option('optMLSS__DropdSidePos','left'); update_option('optMLSS__DropdDistanceTop','70');update_option('optMLSS__DropdDistanceSide','50');
		//
		update_option('optMLSS__CategSlugname',	'mycategories');   update_option('optMLSS__PageSlugname', 'parentpage');
		
	}
	global $wpdb;
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
							array('translation'=>'holaaaa usuario!'),
							array('title_indx'=>'my_HeadingMessage', 'lang'=>'spa'));
	//flush-update permalinks for CUSTOM POST TYPES 
	DetermineLanguages__MLSS(); myf_63__MLSS();	flush_rewrite_rules();
}


//==================================================== pre-define languages ===============================
add_action('init','DetermineLanguages__MLSS',1); 
function DetermineLanguages__MLSS(){
	// see COUNTRY_NAME abbreviations here (should be 639-3 type)  - http://www-01.sil.org/iso639-3/codes.asp?order=reference_name&letter=g ( OR http://en.wikipedia.org/wiki/ISO_639:k ) 
	$temp_contents = explode(',',  get_option('optMLSS__Lngs') ); 
	foreach ($temp_contents as $value)	{ 	$value=trim($value);				//re-create array with KEYNAMES
		if (!empty($value))	{	preg_match('/(.*?)\((.*)\)/si',$value,$nnn); 	//var_dump($nnn);exit;
			$finall[ trim($nnn[1]) ]=trim($nnn[2]);
		}
	}
	$GLOBALS['SiteLangs__MLSS'] = $finall;
}

	function LANGS__MLSS(){return $GLOBALS['SiteLangs__MLSS'];}
	add_action('init','Defines_MLSS'); function Defines_MLSS(){ 	
		foreach (LANGS__MLSS() as $title=>$name) { define ($name.'__MLSS',$name);  define($name.'_title__MLSS',$title);} 
	}
	
	function MLSS($variable){ global $wpdb; 
		$res = $wpdb->get_results("SELECT * from `".$wpdb->prefix."translatedwords__mlss` WHERE `title_indx`= '$variable' AND `lang` = '".LNG."'");
		return $res[0]->translation;
	}





//================================================= SEVERAL USEFUL FUNCTIONS ===============================
//it's better,that useless pages not indexed in GOOGLE...
add_action( 'wp_head', 'noindex_pagesss__MLSS' );	function noindex_pagesss__MLSS() 	{
	if ( !is_404() && !is_page() && !is_single() && !is_search() && !is_archive() && !is_admin() && !is_attachment() && !is_author() && !is_category() && !is_front_page() && !is_home() && !is_preview() && !is_tag()) 
	{	echo '<meta name="robots" content="noindex, nofollow">';	}
}		
function iss_admiiiiiin__MLSS()	{if (is_admin()) {require_once(ABSPATH . 'wp-includes/pluggable.php');}	
		if (current_user_can('create_users')){return true;}
		else {return false;}
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

function errorrrr_404__MLSS(){
	if (is_404() && WP_USE_THEMES === true )	{NOTFOUNDDD_REDIRECT2__MLSS(homURL,'problemm_702');}   
}
//404 inside "add_action" may cause problems in custom pages (i.e. where include(..'/wp-load.php');). So, it's better,that this function was in header.php

function NOTFOUNDDD_REDIRECT2__MLSS($urll,$myHINT){
	//global $wp_query;$wp_query->set_404();status_header(404);nocache_headers();
	header("HTTP/1.1 404 Not Found");  
	header("location:" . $urll ) or die('File:'.dirname(__file__).'['.$myHINT.'] (FROM:'.$_SERVER['REQUEST_URI'].'  TO:'.$urll .')');
}
	//fix for customize.php theme viewer:
	if (stripos(currentURL__MLSS, '/customize.php?return=' ) !== false)	{setcookie('MLSS_cstRedirect', 'hii', time()+100000000, homeFOLD__MLSS);}
	else																{setcookie('MLSS_cstRedirect', 'hii', time()-100000000, homeFOLD__MLSS);}
function PERMANENTTT_REDIRECT2__MLSS($urll,$myHINT)	{
					if (!empty($_COOKIE['MLSS_cstRedirect'])) {return;}
	header("HTTP/1.1 301 Moved Permanently");
	header("location:" . $urll ) or die('File:'.dirname(__file__).'['.$myHINT.']  (FROM:'.$_SERVER['REQUEST_URI'].'  TO:'.$urll .')');
}
//================================================= ##### SEVERAL USEFUL FUNCTIONS ===============================


	
//============================================================================================= //	
//======================================== SET LANGUAGE for visitor =========================== //	
//============================================================================================= //	
add_action('init', 'DetectLangUsingUrl__MLSS',2); function DetectLangUsingUrl__MLSS(){
	//if preview
	if (isset($_GET['previewDropd__MLSS'])) {define('ENABLED_FIRSTIME_POPUP_MLSS', true);return;}
				
	$hom=str_replace('/','\/', homeFOLD__MLSS); 
	
	preg_match('/'.$hom.'\/(.*?)_'.PagePrefix__MLSS.'\//si',	$_SERVER['REQUEST_URI'].'/',  $found_C_matches);    //var_dump($x);exit;
	preg_match('/'.$hom.'\/(.*?)_'.CategPrefix__MLSS.'\//si',	$_SERVER['REQUEST_URI'].'/',  $found_B_matches);    //var_dump($x);exit;
	preg_match('/'.$hom.'\/(.*?)\//si',   						$_SERVER['REQUEST_URI'].'/',  $found_A_matches);    //var_dump($x);exit;
	// ======= IF LANGUAGE HAS BEEN SET USING:
	//URL PARAMTER
	if		(!empty($_GET['lng']))						{ $found = $_GET['lng'];}
	
	//STRUCTURED URL [with page prefix] (i.e. http://site.com/LANG_parentpage/my-page
	elseif	(!empty($found_B_matches[1]))				{ $found = $found_C_matches[1];}
	//STRUCTURED URL [with category prefix] (i.e. http://site.com/LANG_CATEG/my-page
	elseif	(!empty($found_B_matches[1]))				{ $found = $found_B_matches[1];}
	//STRUCTURED URL (i.e. http://site.com/LANG/my-page
	elseif	(!empty($found_A_matches[1]))				{ $found = $found_A_matches[1];}
	
	//COOKIE
	elseif	(!empty($_COOKIE[cookienameLngs__MLSS]))	{ $found = $_COOKIE[cookienameLngs__MLSS];}
	//FINAL SET
	define('found_lang__MLSS', ((!empty($found) && in_array($found, LANGS__MLSS() )) ?  $found :'')  ); 
		//when INCORRECT lang is typed
		//if (found_lang__MLSS == '' )		{ PERMANENTTT_REDIRECT2(homURL,'problemm_704');	}		
	
	define('isHomeURI__MLSS',		(in_array($_SERVER['REQUEST_URI'], array(homeFOLD__MLSS.'/', homeFOLD__MLSS))  ?  true :false)  ); 
	define('isLangHomeURI__MLSS',	(found_lang__MLSS != '' && in_array($_SERVER['REQUEST_URI'], array(homeFOLD__MLSS.'/'.found_lang__MLSS.'/', homeFOLD__MLSS.'/'.found_lang__MLSS)))  ?		true :false ); 

	
	// ================= ONCE ago, this below  block was separately in another "ADD_ACTION" ........ ==================
	//check if language is set for user.. priority language is not given to saved cookie's language, but to the current URL's parameter ($found_lang)
	global $wpdb; $FIRST_TIME_METHOD=get_option('optMLSS__FirstMethod');
	if (found_lang__MLSS==''){  						//if url doesnt containt any LANGUAGE component
		if (isHomeURI__MLSS){								//only check, when it's home URL
			if (empty($_COOKIE[cookienameLngs__MLSS])){ 	//if cookie not set, it may be the first-time visit
				if ($FIRST_TIME_METHOD=='dropddd') {define('ENABLED_FIRSTIME_POPUP_MLSS', true);return;}			
				if ($FIRST_TIME_METHOD=='ippp')	{			//if IP_DETECTION method is chosen
					include( __DIR__ ."/flags/ip_country_detect/sample_test.php");   //gets $country_name
					if (!empty($country_name)){ 
						foreach (LANGS__MLSS() as $name=>$value){
							if (stripos(','.get_option('optMLSS__Target_'.$value).',', ','.$country_name.',') != false ) {$xLang=$value; break; }
						}
					}
					if (isset($xLang)) { define('LNG',$xLang); setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
					else{
						if (get_option('optMLSS__DefForOthers')=='fixedd'){
							define('LNG',get_option('optMLSS__Target_'.'default')); setcookie(cookienameLngs__MLSS, LNG, time()+9999999, homeFOLD__MLSS); }
						else{
							define('ENABLED_FIRSTIME_POPUP_MLSS', true);return;	}
					}
					; 
					//set chosen lang (+REDIRECT IS NEEDED AFTER COOKIE SET)
					PERMANENTTT_REDIRECT2__MLSS( homeURL__MLSS.'/'.LNG, 'problemm_708' );
				}
				if ($FIRST_TIME_METHOD=='fixeddd') {define('LNG',get_option('optMLSS__FixedLang')); }					//dont need "SET COOKIE"
				
				//if unknown situation happens, set default...   better not to set cookie at this time
				if (!defined('LNG')) { 
					if (get_option('optMLSS__Target_'.'default'))	{ define('LNG', get_option('optMLSS__Target_'.'default') ); } 
					else												{ define('LNG', $GLOBALS['SiteLangs__MLSS'][0] ); }
				}	
			}
			else{									//if cookie was set already 
				define('LNG', $_COOKIE[cookienameLngs__MLSS]); 	// no need to set cookie again...
				//if it is home base url,then redirect to LANGUAGE START PAGE.
				//if (isHomeURI__MLSS){ 
					PERMANENTTT_REDIRECT2__MLSS(homeURL__MLSS.'/'.LNG, 'problemm_709' );
					//echo '<script> window.location="'.homeURL__MLSS.'/'.LNG'"; </script> '; exit;
				//}
				//when the page is unknown (for example, custom page or "wp-login.php" or etc... then we dont need redirection
				//else {}
			}
		}
		else{ //when the page is unknown (for example, custom page or "wp-login.php" or etc... then we dont need redirection
			
		}
	}
	
	//if CORRECT LANGUAGE was DETECTED for the visitor ...
	else {
		 define('LNG',found_lang__MLSS); setcookie(cookienameLngs__MLSS, found_lang__MLSS, time()+100000000, homeFOLD__MLSS);
		 if (isHomeURI__MLSS) {PERMANENTTT_REDIRECT2__MLSS(homFOLD.'/'.found_lang__MLSS, 'error1048 .contact administrator');}
	}
}
//============================================================================================= //	
//=================================== ##### SET LANGUAGE for visitor ========================== //	
//============================================================================================= //	




//==================================== POST TYPES ================================== //
//================================================================================== //		
add_action( 'init', 'myf_63__MLSS',1);function myf_63__MLSS() {
	foreach (LANGS__MLSS() as $name=>$value) {
		$args = array(  # http://codex.wordpress.org/Function_Reference/register_post_type
				'label'=>$value, 'labels' => array('name' => $name, 'singular_name' => $value.' '.'page'),
				'public' => true,
				'query_var'=> true,
				//'exclude_from_search' => false,
				'publicly_queryable'=> true, 'show_ui'=>true,	//'show_in_nav_menus' => true,'show_in_admin_bar'	=> true,
				//'show_in_menu' => 'edit.php?post_type=page',//true,
				'menu_position' => "65.888562" ,
				'menu_icon'   => 'dashicons-editor-spellcheck', // https://developer.wordpress.org/resource/dashicons/#editor-spellcheck
				'hierarchical' => true,		
				'has_archive' => true,	
				'capability_type' => 'post',
				'supports' => array( 'title', 'editor', 'thumbnail' ,'page-attributes', 'revisions','comments', ),
				//'taxonomies' => array('category','my_taxonomyy_'.$value),	
				'rewrite' => array('with_front'=>true),			'can_export' => true,	
				//'permalink_epmask'=>EP_PERMALINK, 
			);
			register_post_type( $value, $args );
			register_taxonomy( $value.'_'.CategPrefix__MLSS, array( $value ),  array(
				'public'	=> true,	'query_var'=>true,	'hierarchical'=>true, 'show_in_nav_menus'=>true, 'show_admin_column'=>true,
				'labels'	=> array('name'=> $value.'_'.CategPrefix__MLSS.'s', 'singular_name' => $value.'_'.CategPrefix__MLSS,  ),
				'rewrite'	=> array('slug' => $value.'_'.CategPrefix__MLSS)
																					)
			);
			flush_rewrite_rules();
			//register_taxonomy_for_object_type('category',$value);
			//register_taxonomy_for_object_type('my_custom_taxonomyy_1',$value);
	}
}
//================================= ##### POST TYPES =============================== //
//================================================================================== //		

add_action( 'pre_get_posts', 'MAKE_POSTTYPE_STARTPAGE_AS_HOME__MLSS' );
//difference between [$query->is_XXX=true    and   $query->set('is_XXX', true)]   : http://wordpress.stackexchange.com/questions/130314/how-to-force-a-query-conditional
function MAKE_POSTTYPE_STARTPAGE_AS_HOME__MLSS( $query ) {
    if ( $query->is_main_query() ) {
		if(is_post_type_archive()){
			//if static ID is set for the language's STARTPAGE
			$optValue=get_option('optMLSS__HomeID_'.LNG);
			if ($optValue){
				//new query
				$query->init();
				$query->parse_query(   array('post_type' =>array(LNG))   ) ;	
				//others
				$query->is_home = false;
				$query->is_single = true;
				$query->is_singular = true;
				$query->is_page = false;
				$query->queried_object_id = $optValue; //get_post(get_option('page_on_front') ); 
					$query->set( 'page_id', $optValue );
				//add some links
				add_action('shutdown','showw_EDIT_LINK__MLSS',99);
			}
			else{
				$query->is_home = true;	
				$query->is_page = false;	
			}
		}
    }
}
	function showw_EDIT_LINK__MLSS(){ ?>
		<script>var adminbar__MLSS= document.getElementById("wp-admin-bar-root-default");if (adminbar__MLSS) {
			adminbar__MLSS.innerHTML += '<li id="wp-admin-bar-editMlssHome"><a class="ab-item" href="<?php echo get_edit_post_link($GLOBALS['post']->ID);?>" ><span class="ab-icon"></span><span class="ab-label">*EDIT*</span></li>'; 
		}
		</script>
		<?php
	}


	
	
//======================================= SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //			
add_action( 'wp_enqueue_scripts', 'stylesht__MLSS',99,99 ); function stylesht__MLSS() {
	wp_enqueue_style( 'custom_styles__MLSS', plugin_dir_url(__FILE__).'flags/stylesheet.css');
}
function my_black_backgorund_output__MLSS(){	$scrpt=
	'<div id="my_black_backgr__MLSS" style="background:black; height:4000px; left:0px; opacity:0.9; position:fixed; top:0px; width:100%; z-index:9507;"></div>
	<script type="text/javascript">
	var BODYYY = document.body;	if (BODYYY)  {BODYYY.insertBefore(document.getElementById("my_black_backgr__MLSS").innerHTML, BODYYY.childNodes[0]);}
	</script>'; 	return $scrpt;
}



//first time visit POPUP
add_action('wp','OutputFirstTimePopup__MLSS'); function OutputFirstTimePopup__MLSS(){
	global $odd;
	if ( defined('ENABLED_FIRSTIME_POPUP_MLSS') && count(LANGS__MLSS()) > 1) {
	?><html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"><link rel='stylesheet' id='tipsy-css'  href='<?php echo plugin_dir_url(__FILE__).'flags/stylesheet.css';?>' type='text/css' media='all' /></head>
	<body>
	<?php echo my_black_backgorund_output__MLSS();  ?>
	<div id="languageSelectDropdown2__MLSS" >
		<?php
		// ============================ COMBINE the "FIRST TIME POPUP" and "LANGUAGE DROPDOWN" initializations ===========
		//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors
		$SITE_LANGUAGES=LANGS__MLSS(); $HIDDEN_LANGS = get_option('optMLSS__HiddenLangs');

		$Choose_POPUP	='<div id="popup_CHOOSER2__MLSS"><div class="lnmenu__MLSS">';
		foreach ($SITE_LANGUAGES as $keyname => $key_value){
							$targt_lnk=homeURL__MLSS.'/'.$key_value;
							//if language is not included in "HIDDEN LANGS" option
							if (stripos(",$HIDDEN_LANGS," ,     ",$key_value," ) === false) {
			$Choose_POPUP	.='<div class="LineHolder2__MLSS">'.
								'<a class="ImgHolder2__MLSS"  href="'. $targt_lnk.'">'.
									'<img class="FlagImg2__MLSS '.$key_value.'_flagg2__MLSS" src="'. PLUGIN_URL_WITHOUT_DOMAIN__MLSS .'flags/' . $key_value .'.png" alt="'. strtoupper($keyname) .'" />'.
									'<span class="lnmenuSpn2__MLSS">'. $keyname.'</span>'.
								'</a>'.
							'</div>';										}
		}
		$Choose_POPUP .= '</div></div>';
		echo $Choose_POPUP; exit;
		?>
	</div><?php
	}
}


//Display dropdown on every page 
add_action('wp_footer',	'OutputDropdown__MLSS'); function OutputDropdown__MLSS(){
	if ('y' == get_option('optMLSS__DropdHeader') ) {
	global $odd;?> 
	<style>#languageSelectDropdown1__MLSS {top:<?php echo get_option('optMLSS__DropdDistanceTop');?>px; <?php echo (('left'==get_option('optMLSS__DropdSidePos')) ? "left:" : "right:"); echo get_option('optMLSS__DropdDistanceSide');?>px;</style>
	<div id="languageSelectDropdown1__MLSS" >
	<?php
		// ============================ COMBINE the "FIRST TIME POPUP" and "LANGUAGE DROPDOWN" initializations =======
		//note:large php codes should not be inside <script...> tags, because NOTEPAD++ misunderstoods the scripting colors
		$SITE_LANGUAGES=LANGS__MLSS();
		//If language is set, then sort languages, as the first language FLAG should be the current language
		if (defined('LNG')) {						function fix_1($i){return $i != LNG;}
			$SITE_LANGUAGES = array_filter($SITE_LANGUAGES,  fix_1);							//remove current language
			$SITE_LANGUAGES = array( constant(LNG."__MLSS") => LNG) + $SITE_LANGUAGES; 			//insert current language in first place
		}
		
		$lng_Dropdown	='<div id="LangDropMenu1__MLSS"><div id="AllLines1__MLSS">     <a href="javascript:void(0);" id="LngSelector1__MLSS">&#8897;</a>';
		foreach ($SITE_LANGUAGES as $keyname => $key_value){
						$targt_lnk=homeURL__MLSS.'/'.$key_value;
						//if language is not included in "HIDDEN LANGS" option
						if (stripos(','.get_option('optMLSS__HiddenLangs').',',     ",$key_value," ) === false) {
			$lng_Dropdown .='<div class="LineHolder1__MLSS" myyhref="'.$targt_lnk.'" id="lnh_'.$key_value.'">'.
								'<a class="ImgHolder1__MLSS" href="'.$targt_lnk.'">'.
									'<img class="FlagImg1__MLSS '.$key_value.'_flagg1__MLSS" src="'. PLUGIN_URL_WITHOUT_DOMAIN__MLSS .'flags/'. $key_value .'.png" />'.
								'</a>'.
							'</div>'
							.'<div class="clerboth__MLSS"></div>'
							;
																												}
		}
		$lng_Dropdown .= '</div></div>';
		echo $lng_Dropdown;
		?>
	</div><!-- languageSelectDropdown1__MLSS -->
	<script type="text/javascript">
		//============styles========
			//GETproperty >> http://stackoverflow.com/questions/324486/how-do-you-read-css-rule-values-with-javascript/29130215
			function GETproperty(classOrId,property){ 
				var FirstChar = classOrId.charAt(0);  var Remaining= classOrId.substring(1);
				var elem = (FirstChar =='#') ?  document.getElementById(Remaining) : document.getElementsByClassName(Remaining)[0];
				return window.getComputedStyle(elem,null).getPropertyValue(property);
			}
		//var ldrmen = document.getElementById("LangDropMenu1__MLSS");
		//var flagHeight = GETproperty(".FlagImg1__MLSS","height"); 
		//	ldrmen.style.height = parseInt(flagHeight.replace("px","")) + 0 + "px";
		//===========## style========
		
		var langMenu = document.getElementById("languageSelectDropdown1__MLSS");
		var BODYYY = document.body;	BODYYY.insertBefore(langMenu, BODYYY.childNodes[0]);

		var langmnSelcr=document.getElementById("LngSelector1__MLSS");
		var AllLines1__MLSS=document.getElementById("AllLines1__MLSS");
		var AllLines1__MLSSstartHEIGHT= AllLines1__MLSS.clientHeight; //overflow maybe  hidden white started
		
		var shownOrHidden=false;
		function ToggleShowAllLines1__MLSS(mystring)	{
			if (shownOrHidden === true || mystring=="hide1"){ shownOrHidden = false;
				AllLines1__MLSS.style.height=AllLines1__MLSSstartHEIGHT + "px";		AllLines1__MLSS.style.overflow="hidden";
				
			}
			else{ shownOrHidden = true;
				AllLines1__MLSS.style.height="auto";								AllLines1__MLSS.style.overflow="visible";
			}
		}
		langmnSelcr.addEventListener('click',	function(){	ToggleShowAllLines1__MLSS(); }				, false);

	
		//function clickedLANGLINE(elmnt)	{
		//	//document.getElementById("the_id").getAttribute("original-title");
		//	ToggleShowAllLines1__MLSS("hide1");
		//	var linkk=elmnt.getAttribute("myyhref");
		//	top.window.location =linkk;
		//}
		
		//function showArrow()
		//{
		//	if(old_Arrow = document.getElementById('LngSelector1__MLSS'))	{	old_Arrow.parentNode.removeChild(old_Arrow); }
		//	document.getElementsByClassName("LineHolder1__MLSS")[0].innerHTML += '<div id="downar" style="height:' + dlines.clientHeight + 'px;">&#8897;</div>';
		//}
		//showArrow();

		//for language chooser for mobile devices (if mobile device..so, instead of hover, we need "onclick" action) to be triggered while clicked on the main div
		//var isMobile = "<?php if ($odd['isMobile']) {echo "true";} else {echo "false";} ?>";
		//if (isMobile)
		//	{
		//	ToggleShowAllLines1__MLSS.addEventListener('click', function() 
		//		{
		//		ToggleShowAllLines1__MLSS("show1");
		//		ToggleShowAllLines1__MLSS.removeEventListener("click", myFunction);
		//		}, false);
		//	}
	</script>
	<?php 
	}
}
//================================= ##### SHOW FLAGS SELECTOR  ============================ //
//========================================================================================= //	

//add sample widget 
add_action( 'widgets_init', 'widg_sample__MLSS' );	function widg_sample__MLSS() {
	register_sidebar( array(
		'name' => 'empty_sidebar1',								'id' => 'widget1__MLSS',
		'before_widget' => '<div class="sidebar1__MLSS">',		'after_widget' => '</div>',	
		'before_title' => '<h2 class="h2class__MLSS">',			'after_title' => '</h2>',
	) );
}

//enable in widgets
add_filter( 'widget_text', 'do_shortcode' );

//http://codex.wordpress.org/Function_Reference/shortcode_atts
add_shortcode( 'MLSS_navigation', 'treemenuOutp_MLSS' ); function treemenuOutp_MLSS($atts){
	//http://codex.wordpress.org/Function_Reference/wp_nav_menu
	//http://codex.wordpress.org/Function_Reference/wp_get_nav_menu_items
	echo wp_nav_menu( array(
		'theme_location'  => '',
		'menu'            => LNG.'_'.$atts['name'],
		'container'       => 'div',			'container_class' => 'sideMyBox',			'container_id'    => 'my_SideTreeee',
		'menu_class'      => 'menu',		'menu_id'         => '',
		'echo'            => 0,				'fallback_cb'     => 'wp_page_menu',
			'before'          => '',		'after'           => '',
			'link_before'     => '',		'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	));
}








include(__dir__.'/__admin_dashboard.php');
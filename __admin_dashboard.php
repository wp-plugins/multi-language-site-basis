<?php
	
//================================================================================== //
//===================================== DASHBOARD ================================== //
//================================================================================== //
if (!defined('ABSPATH')) exit;

// ====================================== USEFUL functions  ================================
//a Admin Validator function
function NonceCheck__MLSS($value, $action_name){
	if ( !isset($value) || !wp_verify_nonce($value, $action_name) ) { die("not allowed due to interal_error_151");}
}	
// =================================== ##### USEFUL functions #### =============================
 
// START 
if ( is_admin() ){
	add_action('admin_menu', 'exec_pages__MLSS'); function exec_pages__MLSS() {
		add_menu_page('MultiLang Simple', 'MultiLang Simple', 'manage_options','my-mlss-slug', 'my_submenu1__MLSS',  PLUGIN_URL_nodomain__MLSS.'/flags/a_main.png', "29.4342423" );
		add_submenu_page('my-mlss-slug', 'MLSS Settings',	'MLSS Settings',	'manage_options', 'my-mlss-slug',  'my_submenu1__MLSS');
		add_submenu_page('my-mlss-slug', 'Translated Words','Translated Words',	'manage_options', 'my-mlss-slug2', 'my_submenu2__MLSS');
	}
	
	
	//===================================================FIRST SUBMENU (settings)==========================================
	add_action('init','PriorityFields__MLSS',1); function PriorityFields__MLSS(){
		if (is_admin() && iss_admiiiiiin__MLSS()){
			if (isset($_POST['mlss_FRRULES_AGAIN'])){ MyFlush__MLSS(false); }
			if (isset($_POST['formupdate__mlss'])){	
				NonceCheck__MLSS($_POST['inp_SecureNonce'],'fupd_mlss');
				
				$_POST = array_map("trim", $_POST);	//TRIM ALL requests	
					if(get_option('optMLSS__Lngs') 	!= $_POST['inp_Langs'])				{ $NEEDS_FLUSH_REDIRECT=true;}
				update_option('optMLSS__Lngs', str_replace(array('{ ',' }'), array('{','}'),$_POST['inp_Langs']));	
					if(get_option('optMLSS__BuildType') != $_POST['lang_rebuild'])		{ $NEEDS_FLUSH_REDIRECT=true;}
				update_option('optMLSS__BuildType', $_POST['lang_rebuild']);
					if(get_option('optMLSS__EnableCustCat') != $_POST['EnableCustCats']){ $NEEDS_FLUSH_REDIRECT=true;}
				update_option('optMLSS__EnableCustCat', $_POST['EnableCustCats']);
					if(get_option('optMLSS__CatBaseRemoved') != $_POST['RemoveCatBase']){ $NEEDS_FLUSH_REDIRECT=true;}
				update_option('optMLSS__CatBaseRemoved',	 $_POST['RemoveCatBase']);
				if (isset($NEEDS_FLUSH_REDIRECT)) { MyFlush__MLSS(true);}    
			}
		}
	}
	
	function my_submenu1__MLSS() { 
		if (isset($_POST['formupdate__mlss'])){	
			$_POST = array_map("trim", $_POST);	//TRIM ALL requests	
			NonceCheck__MLSS($_POST['inp_SecureNonce'],'fupd_mlss');
			//update optionsss	
			update_option('optMLSS__FirstMethod',		$_POST['inp_FirstMethod']	); 
			update_option('optMLSS__FixedLang',			$_POST['inp_FirsttimeFixed']);
			update_option('optMLSS__HiddenLangs',		str_replace(array('{ ',' }'), array('{','}'),$_POST['inp_HiddenLangs']) ); 
			update_option('optMLSS__DefForOthers',		$_POST['other_defaulter']);
			foreach (LANGS__MLSS() as $name=>$value){ update_option('optMLSS__Target_'. $value,	$_POST['titlee22_'.$value] ); }
			update_option('optMLSS__Target_'.'default', $_POST['titlee22_default'] );
			//
			update_option('optMLSS__EnableQueryStrPosts',$_POST['EnablePostQueryStr']);
			//update_option('optMLSS__ShowHideOtherCats',	$_POST['EnableHideOtherCtypeEntri']);
			//update_option('optMLSS__HidenEntriesIdSlug',$_POST['SlugofHidenEntriesId']);
			//
			foreach (LANGS__MLSS() as $name=>$value){	update_option('optMLSS__HomeID_'.$value ,	$_POST['homeID_'.$value]);	} 
			update_option('optMLSS__DropdHeader',		$_POST['drp_in_header']);
			update_option('optMLSS__DropdSidePos',		$_POST['drdn_aside']);
			update_option('optMLSS__DropdDistanceTop',	$_POST['fromtop']);
			update_option('optMLSS__DropdDistanceSide',	$_POST['fromside']);
			
			//update_option('optMLSS__CategSlugname',		$_POST['category_slugname']);
			//update_option('optMLSS__PageSlugname',		$_POST['page_slugname']);
			
		}
		$chosen_method = get_option('optMLSS__FirstMethod');
		?> 
		<style>
		body{font-family:arial;}
		input.langs{width:100%;} 
		input.hiddenlangs{width:100%;}		
		span.codee{background-color: #D2CFCF;padding: 3px;font-family: Consolas;}
		.eachColumn22{border:1px solid;margin:2px 0 0 90px;}
		.delete22{padding:3px; background-color:#759C83; float:right; display:inline-block;}		
		.lng_NAME22{width:25px; display:inline-block;padding:0px 2px;} 
		input.inpVALUES22{width:70%;}   	
		.title{display: inline-block;}   
		.addNEWlnBLOCK22{position:relative;background-color:#B9B9B9;width:90%; padding:2px; margin: 30px 0 0 100px;}
		span.save_div_lng22{display:block; position:fixed; bottom:25px; width:300px; left:45%; z-index:101;}
		a.lng_SUBMIT22{background-color:red; border-radius:5px; padding:5px; color:white; font-size:2em;}   
		span.crnt_keyn{display:inline-block;  color:red; background-color:black; padding:2px;font-weight:bold;}
		.hiddenlngs{margin: 10px 0 0 140px;background-color:#DBDBDB;}
		.dividerrr{background-color:black;height:2px; clear:both; margin:20px 0;}
		.fakeH22{font-size:2em;font-weight:bold;}
		.eachBlock{margin: 30px 0px 0px; border: 3px solid; padding: 10px; border-radius: 5px;}
		a.readpopp{color:#56CC18;}
		span.smallnotic{font-size: 10px; float: right; right: 5%; position: relative;}
		</style>
		<?php include_once(__DIR__.'/flags/javascript_functions.php'); ?>
		
		<div class="multiLangSimpPage">
			<form action="" method="POST">

		<center><h1><b>MLSS</b> Plugin - MultiLanguage Simple Site</h1></center>
		<center><span class="fakeH22"><a href="javascript:alert('(NOTICE: as of April 2015, Everything else is ok, but this plugin has some lacks at this moment(probably soon, i am going to complete this, and you will get a notification): 1) At this moment you have to manually change the design of the first time popup chooser. 2) If you use your own, already registered CUSTOM POST TYPES, then this plugin might not be compatible with it);\r\n\r\n\r\n\u0022MLSS plugin\u0022 is mainly intended as a helpful functionality for them, who want to have Multi-Language website. \r\n\r\n(Note: at this moment (I will try to do in near future) this plugin doesnt provide a.k.a. \u0022ALTERNATIVE\u0022 pages for 1 typical page.. instead, it builds the separate language home site, and you can add separate posts&pages or etc..).\r\nThis plugin can be used by skilful developer, who is able to integrate the functionalities with his theme. \r\n\r\n(p.s Also, if you wish, you can change design of this plugin from your theme FUNCTIONS.PHP, or if you wish, you can modify the functionality&codes of this plugin - just rename the plugin-name to your desired name, modify it and then re-activate)\r\n\r\n\r\nAlso note, that this plugin wont work, if your theme outputs posts using non-standard(custom) query methods. In this case, you might have to modify your themes code to default HAVE_POSTS() query..\r\n\r\n PLEASE, report me about bugs!');" class="readpopp">Read popup</a>!</span></center> 
					<span class="smallnotic">(View <a href="http://codesphpjs.blogspot.com/2015/04/wordpress-multi-language-plugin-list.html" target="_blank">other MultiLang plugins</a>...)</span>
					<br/><span class="smallnotic">(View <a href="http://j.mp/wpluginstt#mlss" target="_blank">other useful plugins</a>...)</span>				
		<div class="eachBlock">
			<span class="fakeH22"> 1) Enabled Languages</span>
			<br/>You can add/remove the languages using this field. Insert Language title, and along it, in CURLED BRACKETS, insert it's official abbreviation  (Needs to be 3 latin characters... View  countries' official <a href="http://www-01.sil.org/iso639-3/codes.asp?order=reference_name&letter=%25" target="_blank">3 symbols</a><a href="http://en.wikipedia.org/wiki/List_of_countries_by_spoken_languages#Spanish)" target="_blank">.</a>)
			<br/><input name="inp_Langs" type="text" class="inpt langs" value="<?php echo get_option('optMLSS__Lngs');?>" />
			<br/>(p.s. To upload your <a href="https://ps.w.org/multi-language-site-basis/assets/unused_flags.zip" target="_blank">flag</a> for your inserted language, then <i><a href="javascript:alert('As mentioned above, you should use 3 official symbols as a name of your flag(image). For example: eng.png, rus.png, fra.png .... Also, the image dimensions could be approximately 128px. And you should upload that file in this directory: <?php echo dirname(plugin_dir_url(__FILE__));?>/flags ');" class="readpopp">Read popup!</a></i>)
			<br/>
			<div class="hiddenlngs">
				Hidden Langs: (<i><a href="javascript:alert('later,if you will need to disable any above language, it is better to put its name (3symbol!) here, rather than removing from the above list. Thus, that language will be just hidden from site(instead of REMOVING),because \u0022REMOVING\u0022 might also remove indexed pages from GOOGLE too..');" class="readpopp">Read popup!</a></i>)
				<br/><input name="inp_HiddenLangs" type="text" class="inpt hiddenlangs" value="<?php echo get_option('optMLSS__HiddenLangs');?>" placeholder="jap,fre," />
			</div>
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22">  2) Choosing Languages for visitor</span>
			<br/>Now, whenever a person enters your website start page (and it's <b>first time</b> he enters), then you can set a language for him. Select desired option:
			<br/> <input type="radio" name="inp_FirstMethod" value="dropddd" <?php echo (($chosen_method=='dropddd')? 'checked="checked"':'');?> />
			<b>A)</b> Let user choose the desired language from dropdown (<a href="javascript:previewww();">See preview</a>) (<i><a href="javascript:if your theme header.php file doesnt containt wp_head() default action, then this cant be triggered.. ');" class="readpopp">Read popup!</a></i>)
				<script type="text/javascript">
				function previewww(){ document.cookie="<?php echo cookienameLngs__MLSS;?>=; expires=Thu, 01 Jan 1970 00:00:01 GMT;"; 
					window.open("<?php echo homeURL__MLSS;?>?previewDropd__MLSS","_blank");	}
				</script>
			
			<br/> <input type="radio" name="inp_FirstMethod" value="ippp" <?php echo (($chosen_method=='ippp')? 'checked="checked"':'');?> />
			<b>B)</b> detect COUNTRY [using visitor's IP] and use the following table of languages (to input county names correctly, see <a href="<?php echo PLUGIN_URL_nodomain__MLSS;?>flags/ip_country_detect/country_names.txt" target="_blank">this page</a>)
					<div id="langset_flds">	<?php global $wpdb;
					//$country_lang_sets = $wpdb->get_results("SELECT * from `".$wpdb->options."` WHERE `option_name` LIKE '".'optMLSS__Target_'."%'"); 	//foreach ($country_lang_sets as $each_group){	
					//$abbrev = str_ireplace('optMLSS__Target_','',$each_group->option_name);	 $ItsValue = $each_group->option_value;
					foreach (LANGS__MLSS() as $name=>$value) {
						$abbrev=$value; 
						//$ItsValues=$wpdb->get_results("SELECT * from `".$wpdb->options."` WHERE `option_name` = '".'optMLSS__Target_'.$abbrev."'");	//$OptValue=$ItsValue[0]->option_value;
						$OptValue= get_option('optMLSS__Target_'.$abbrev);
						echo '<div class="eachColumn22" id="coulang_'.$abbrev.'"> 
								<div class="delete22"><a href="javascript:deleteThisBlock22(\'coulang_'.$abbrev.'\');">DELETE</a></div>
								<div class="eachLngWORD22">
									<span class="lng_NAME22">'.$abbrev.'</span>  <span class="lng_VALUE22"><input class="inpVALUES22" type="text" name="titlee22_'.$abbrev.'" value="'.htmlentities($OptValue).'" /></span>
								</div></div>';
					}
					?>		<div class="eachColumn22" id="coulang_default" style="background-color:pink;"> 
								<div class="eachLngWORD22">
									<span class="lng_NAME22"  style="width:auto;color:green;">default lang for all other countries:</span>
									<input type="radio" name="other_defaulter" value="dropdownn" <?php if("dropdownn"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> /> a) display them dropdown 	&nbsp;&nbsp;&nbsp;<input type="radio" name="other_defaulter" value="fixedd" <?php if("fixedd"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> />b) forced language: <span class="lng_VALUE22"><input class="inpVALUES22"  style="width:50px;" type="text" name="titlee22_default" value="<?php echo get_option('optMLSS__Target_'.'default');?>" placeholder="eng" /></span>
								</div>
							</div>
					</div>
					<script type="text/javascript">	
					 function deleteThisBlock22(IDD){ 	if (confirm("Are you sure?")){var x=document.getElementById(IDD); x.parentNode.removeChild(x);}   }
					</script>
				<br/> <input type="radio" name="inp_FirstMethod" value="fixeddd" <?php echo (($chosen_method=='fixeddd')? 'checked="checked"':'');?> /> 
			<b>C)</b> redirect all visitors to this fixed language <input style="width:50px;" type="text" name="inp_FirsttimeFixed" value="<?php echo get_option('optMLSS__FixedLang');?>" placeholder="eng" />
		</div>		
		
		<div class="eachBlock">
			<span class="fakeH22"> 3) Design: </span> :
			<br/>*<B>LANGUAGE SELECTOR style (<a href="javascript:alert('you will see it in the upper corner of your site.. ');" class="readpopp"><i>Read popup</i></a>!)</B>:
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="drp_in_header" value="hhide" <?php if ('hhide'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Hide 
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="hhorizontal" <?php if ('hhorizontal'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Horizontal
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="vvertical" <?php if ('vvertical'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Vertical
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="ddropdown" <?php if ('ddropdown'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Dropdown
			<br/>*<B>Dropdown Position</B>:&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="left" <?php if ('left'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />LEFT side&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="right" <?php if ('right'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />RIGHT side
			<br/>*<B>Dropdown Distance from</B>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOP:<input type="text" style="width:40px;" name="fromtop" value="<?php echo get_option('optMLSS__DropdDistanceTop');?>" />px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Side:<input type="text" style="width:40px;" name="fromside" value="<?php echo get_option('optMLSS__DropdDistanceSide');?>" />px 
			
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22"> 4) STRUCTURE</span>
			<br/><b>-Build Up website structure using</b>: 
			<br/><input type="radio" name="lang_rebuild" value="custom_p" <?php if ('custom_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> /><b>Custom Post Types </b>(<a href="javascript:alert('maybe you are already familiar with CUSTOM POST TYPES... if you choose this option,then within the left sidebar, you will have menu buttons for each language. Then, whenever i.e. YOURSITE.COM/eng/ is opened, all \u0022ENG\u0022 CUSTOM POSTS will be shown. Also, when visitor makes a SEARCH, it also will be looped through \u0022STANDARD POSTS\u0022,which are published under the root language \u0022STANDARD CATEGORY\u0022). REMEMBER, always assign a language-specific STANDARD POST only to one category!!! \r\n\r\n\r\n\[p.s. in case, you are a programmer and you will need CODING modifications, instead of is_home(), its better to use is_post_type_archive()]');" class="readpopp">Read popup!</a>) 
				<span class="cpost_others" style="margin:0 0 0 20px;">
				[enable CUSTOM CATEGORIES too <i>(<a href="javascript:alert('You will see, that STANDARD CATEGORIES will be enabled for CUSTOM(languaged) POSTS. However, if you also want to be added CUSTOM CATEGORIES too(i dont know, maybe you need some deep variations for your site), then you can enable it, and you will see the CUSTOM CATEGORIES will be added too for that CUSTOM(languaged) POSTS.\r\n\r\np.s. However, if you dont need them very very much, then maybe there is no need to implement them, but you can simply use the standard categories.. ');" class="readpopp">Read popup!</a>)</i><input type="hidden" name="EnableCustCats" value="n" /> <input type="checkbox" name="EnableCustCats" value="y" <?php if ('y'==get_option('optMLSS__EnableCustCat')) {echo 'checked="checked"';} ?> />] 
				</span>
			<br/> <input type="radio" name="lang_rebuild" value="standard_p" <?php if ('standard_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> /> <b>Standard Posts  </b>(<a href="javascript:alert('In this case, whenever i.e. YOURSITE.COM/eng/ is opened, all STANDARD posts will be shown, which are published under \u0022ENG\u0022 category. \r\n\r\n\r\n(NOTE: You dont need to manually set \u0022CATEGORY BASE\u0022 to .(dot) in PERMALINKS settings, because this plugin automatically removes FIXED CATEGORY_BASE word from  urls ( like: YOURSITE.COM/ENG/sub-category [instead of YOURSITE.COM/category/ENG/sub-category]).  Also, there wont be even problem, if someone will need to use \u0022/\u0025category\u0025/\u0025postname\u0025/ in permalinks, instead of /\u0025postname\u0025/ .  \r\n\r\np.s. In the future,if this feature will no longer work, then uncheck \u0022REMOVE CATEGORY BASE\u0022 checkbox, and use plugins(i.e. WP-REMOVE-CATEGORY-BASE ..)');" class="readpopp">Read popup!</a>)
				<br/><br/><span class="cpost_others" style="margin:0 0 0 20px;">
					*<span class="cpost_othersxx">
					[add query strings to post links <i>(<a href="javascript:alert('If you use CUSTOM_POST Types for building the language directories, then you may forget standard posts and never need them... However,this plugin leaves you that opportunities too. \r\n\r\nFor example, when you publish any post: Wordpress\u0027s default \u0022\post\u0022, OR if you use other CUSTOM POST TYPEs (expect our LANGUAGE POST TYPEs,because they dont need) under specific lang CATEGORY(i.e. eng), then this plugin automatically saves/detects the language for such post (according to that CATEGORY\u0027s language). The post\u0027s URL will be like this:\r\nSITE.COM/my-standard-post                                           *while permalinks is set to:  /\u0025postname\u0025 \r\n OR \r\nSITE.COM/eng/sub-categoryy/my-standard-post         *while permalinks is set to:  \u002F\u0025category\u0025\u002F\u0025postname\u0025 \r\n\r\nHowever, if you want that additional language  parameter appeared in url (i.e. site.com/mypost?lng=eng), then you can check this checkbox. But note, that this is not needed, because the post\u0027s language is normally determined without it too. However, this might only be useful for visual purposes; OR in case you use other custom post types; OR you use short permalinks(\u0025postname\u0025); OR in whatever aims you might have... But, by default, it is not necessary. ');" class="readpopp">Read popup!</a>)</i><input type="hidden" name="EnablePostQueryStr" value="n" /> <input type="checkbox" name="EnablePostQueryStr" value="y" <?php if ('y'==get_option('optMLSS__EnableQueryStrPosts')) {echo 'checked="checked"';} ?> />] 
					</span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="cpost_othersxx" style="font-size:0.9">
					[REMOVE CATEGORY_BASE word from URLS: <i>(<a href="javascript:alert('As mentioned in previous popup, this feature removes the CATEGORY_BASE word(\u0022/category/\u0022) from category links.');" class="readpopp">Read popup!</a>)  </i><input type="hidden" name="RemoveCatBase" value="n" /> <input type="checkbox" name="RemoveCatBase" value="y" <?php if ('y'==get_option('optMLSS__CatBaseRemoved')) {echo 'checked="checked"';} ?> />] 
					</span>
				</span>
			<br/><br/><b>-START PAGES </b>(<a href="javascript:alert('for the Language MAIN page (i.e. example.com/eng/), you can set a particular post/page as a \u0022START page\u0022. Just input the Post ID. (If you want to show the regular posts, published under that language, then leave empty.)');" class="readpopp">Read popup!</a>) :
			<?php foreach(LANGS__MLSS() as $each){
				echo $each.'&nbsp;<input type="text" style="width:45px;padding:2px;" name="homeID_'.$each.'" value="'.get_option('optMLSS__HomeID_'.$each).'" />&nbsp;&nbsp;&nbsp;&nbsp;';
			} ?>
			
			<!-- <br/><br/><b>-Show only visitor's Languages' entries inside OTHER CUSTOM POST_TYPES listings: </b>(<a href="javascript:alert('(This is a test feature, and it may work on your site, or may not. However, nothing danger is here, you can test.)\r\n\r\n\r\n For example, if you use WP eCommerce or other plugins, and you have other CUSTOM POST TYPES(lets say\u0022PRODUCT\u0022 post-type as an example. Of course,you can imagine anything instead it) on your site, then when you visit \u0022yoursite.com/product\u0022 , then there will be listed all product entries, nevertheless to their checked \u0022language category\u0022. If you want, that inside such CUSTOM POST TYPE listings,  there were shown only such entries, which are assigned to the LANGUAGE CATEGORY(i.e. \u0022ENG\u0022) and visitors detected language is \u0022ENG\u0022 too, then only those language entries will be shown... but this is a bit tricky, and you should have some coding skills: \r\nA) First method is to check \u0022Add Query String\u0022 checkbox above, and then from your style.css, hide all posts from listings, which dont include \u0022?lng=eng\u0022 parameter in url... B) Second method is:  you should open source of LISTING(category) page, where are listed those products.  Find the default start-slug of a typical,looped DIV id(for example, post-63, post-65, post-83 or etc..). In this case, the start-slug will be \u0022post-\u0022. So, check the checkbox, and enter that startslug here:');" class="readpopp">Read popup!</a>) 
				<span class="cpost_others" style="margin:0 0 0 20px;">
				[enabled? <input type="hidden" name="EnableHideOtherCtypeEntri" value="n" /> <input type="checkbox" name="EnableHideOtherCtypeEntri" value="y" <?php if ('y'==get_option('optMLSS__ShowHideOtherCats')) {echo 'checked="checked"';} ?> />;  &nbsp;&nbsp;&nbsp;&nbsp; If so, enter start-slug:<input type="text" name="SlugofHidenEntriesId" value="<?php echo get_option('optMLSS__HidenEntriesIdSlug');?>" />] 
				</span> 
			-->
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22"> 5) Translation of Phrases for TEMPLATES FILES</span> - <i><a href="javascript:alert('In addition to the LANGUAGE specific pages/posts, you can utilize auto-translated PHRASES(which can be used in theme PHP files). For this, on the left side, under \u0022MLSS\u0022 menu button, enter \u0022TRANSLATED WORDS\u0022, where you will see the examples..');" class="readpopp">Read popup</a>!</i>
		</div>
	
		<div class="eachBlock">
			<span class="fakeH22">6) NAVIGATIONS, MENUS, WIDGETS.</span>
			<br/><br/>*<b>How to access the language variables from other php files? </b> - <a href="javascript:alert('This plugin returns an array of all languages within $GLOBALS[\u0027SiteLangs__MLSS\u0027] variable. But the language parameter for current visitor/session, can be accessed with LNG constant.');" class="readpopp">Read popup</a>!
			
			<br/><br/>*<b>Show Widgets only for Certain Languages</b> - <a href="javascript:alert('From now, you will see a Dropdown in the top of any Widget(inside ADMIN SIDEBARS). Then, you can choose on which Language the individual widget should be shown. ( If it appears not to work on a certain widget, that widget probably breaks WordPress Widgets API rules somehow). \r\n\r\n\r\n (p.s. Thanks to Author of \u0022SIMPLE WIDGET CLASSES and WIDGET ATTRIBUTES\u0022.) ');" class="readpopp">Read popup</a>!
			<!-- <br/> -B) Another good solution is to use one of these plugins: <span class="codee">Dynamic-Widgets</span>,&nbsp;&nbsp; <span class="codee">Simple-Widgets (<a href="javascript:alert('This plugin allows PHP conditions checking too. You can use condition for individual widgets:  LNG==\u0022eng\u0022  , and similarly for other widgets...');" class="readpopp">Read popup</a>!) </span>, &nbsp;&nbsp; <span class="codee">Restrict-Widgets</span>,.. -->
			
			<br/><br/>*<b>Tree-Like menus</b> - In case, you want to display the "tree-like" menu of the pages & categories on your website(in Sidebar or elsewhere), then click "APPEARENCE &gt; Menus" and there create custom menu for each language (i.e. name them: <span class="codee"><b>eng_</b><span style="color:red;">DESIRED_SLUG</span> </span>, <span class="codee"><b>rus_</b><span style="color:red;">DESIRED_SLUG</span></span>... ). Note, that in the top of that screen,click "<b>SCREEN OPTIONS</b>" to include all available categories.
			<br/> Then, you can insert your custom "menu" in the Widgets page..  (if you wish to integrate each language's custom-menu dynamically within PHP files,then use <span class="codee">do_shortcode([...]);</span> function, and use this shortcode: <span class="codee">[MLSS_navigation name="<span style="color:red;">DESIRED_SLUG</span>"]</span>)
			
			<br/><br/>*<b>custom coding (output navigation menus,posts or etc...)</b> - you can use functions <span class="codee">wp_list_categories(),wp_list_pages(), get_posts()</span>, but use <span class="codee">LNG</span> constant as a "root" slug (of post_type, root category or whatever)..
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22">7) Read Important Tips</span>:
				<br/>A) <b>Attention to PERMALINKS</b> - <i><a href="javascript:alert('in PERMALINKS, you must use PRETTY PERMALINKS (i.e. /\u0025postname\u0025/, or  /\u0025category\u0025/\u0025postname\u0025/ or etc. Otherwise, this plugn will have problems... \r\n\r\n ALSO REMEMBER, everytime you change the custom-post types, or there will be some problems or etc, YOU MAY NEED TO CLICK \u0022SAVE PERMALINKS\u0022 button in OPTIONS-Permalinks page, to refresh the website structure.');" class="readpopp">Read popup!</a></i>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br/>B) <b>REDIRECTIONS</b> - <i><a href="javascript:alert('please note, if your website has already been established some time ago, and your pages are already indexed in google, and want to use this plugin, then redirect old pages to new pages (using \u0022301 redirect plugin\u0022 or etc..)');" class="readpopp">Read popup!</a></i>
		</div>
		
		<br/><br/><br/>*If you have found bugs, have suggestions or etc, <a href="http://j.mp/wordpressthemestt" target="_blank"><b>CONTACT ME</b></a>!
		<!--
		<h2 class="tiitl"> 6) parameters </b></h2>
		(NOTE: Once you build a website, and google indexes your site, then dont change this value, or your site will loose all pages+ranking indexed!)
		<br/>*<B>for Categories' links</B>: <input type="text" style="width:150px;" name="category_slugname" value="<?php echo get_option('optMLSS__CategSlugname');?>" />
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For example, when you publish "eng" language posts, their link will be like: 
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo homeURL__MLSS;?>/<b style="color:red;">eng</b>/the-last-holidays-i-spent..., 
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; but for categories:
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo homeURL__MLSS;?>/<b style="color:red;">eng_<?php echo get_option('optMLSS__CategSlugname');?></b>/automobiles/mercedes
		<br/>*<B>for Pages' links</B>: <input type="text" style="width:150px;" name="page_slugname" value="<?php echo get_option('optMLSS__PageSlugname');?>" />
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Like above, but with some specifics: For example, in WORDPRESS Default "PAGES" section, you can create several PARENT pages (i.e. "eng_<b>parentpage</b>","fre_<b>parentpage</b>") and then publish new sub-pages for them.. in this case, the language will be detected automatically on all those "pages", but insert the slug correctly.
		-->
		
		<br/>=================================
			<br/><span class="save_div_lng22"><a class="lng_SUBMIT22" href="javascript:document.forms[0].submit();">SAVE</a></span>
				<input type="submit" value="SAVE" style="display:none;" />
					<input type="hidden" name="formupdate__mlss" value="okk" />
					<input type="hidden" name="inp_SecureNonce" value="<?php echo wp_create_nonce('fupd_mlss');?>" />
		
	</form>
		</div>
		<?php
	}
	

	
	
	
	
	
	
	
	
	
	//===============================================SECOND SUBMENU(translated words)======================================
	function my_submenu2__MLSS() {
		global $wpdb;
		$ALL_WORDS = $wpdb->get_results("SELECT * from `".$wpdb->prefix."translatedwords__mlss`");
		//group them based on title_indx
		foreach ($ALL_WORDS as $eachBlockInd => $EachBlockContent)	{$final_groups[$EachBlockContent->title_indx][]=$EachBlockContent;	}
		?>
		
		<style>
		span.codee{background-color: #D2CFCF;padding: 3px;font-family: Consolas;}
		.eachColumn{border:1px solid;margin:2px;}
		.delete{padding:3px; background-color:#759C83; float:right; display:inline-block;}		
		.lng_NAME{width:80px; display:inline-block;} 
		input.inpVALUES{width:70%;}   	
		.title{display: inline-block;}   
		.lexic_SUBMIT{background-color:red; border-radius:5px; padding:5px; color:white; font-size:2em;}   
		.addNEWlnBLOCK{position:relative;background-color:#B9B9B9;width:90%; padding:5px; margin: 10px;}
		.save_div_lexic{position:fixed; bottom:15px; width:300px; margin:0 0 0 30%; z-index:101;}
		span.crnt_keyn{display:inline-block;  color:red; background-color:black; padding:2px;font-weight:bold;}
		</style>
		<form action="" method="POST" class="fmr_lxcn" id="lexiconnn">
			<br/>Below are listed variable INDEXNAMES with their suitable translations. To output any phrase in your theme, use code (like this): 
			<br/><b><span class="codee">echo apply_filters('MLSS','<span style="color:red;">my_HeadingMessage</span>');</span></b> 			&nbsp;&nbsp;&nbsp;<i>(<a href="javascript:alert('1)Even more, you can make this command more shorter -  in your functions.php, create function i.e. function Z($var){return apply_filters...}\r\n\r\n\r\n2) You can use shortcodes too -in widgets,posts or etc...  For that, insert anywhere: [MLSS_phrase name=\u0022my_HeadingMessage\u0022]')">Read popup</a>!)</i>
			<!-- <?php //include_once(__DIR__.'/flags/javascript_functions.php'); ?> (<a href="javascript:show_my_popup('#mlsNotice')"> Read popup!</a>) <div id="mlsNotice">You can use this function anywhere (only after initialization of hooks). However,in case you deactivate this plugin, to avoid errors, you must insert this code in the top of your functions.php: <b><span class="codee">if(!function_exists('MLSS')) {function MLSS(){return 'PLUGIN NOT INSTALLED';}}</span></b></div> -->
			<br/><br/>
			<?php 
			foreach ($final_groups as $each_group){ $BlockTitle=$each_group[0]->title_indx;	$output = 
			'<div class="eachColumn" id="'.$BlockTitle.'"> 
				<div class="title">NAME: <span class="crnt_keyn">'.$BlockTitle.'</span></div> 
				<div class="delete"><a href="javascript:deleteThisBlock(\''.$BlockTitle.'\');">DELETE</a></div>';
						foreach (LANGS__MLSS() as $keyIndex=>$value){ 
					$trnsl= $wpdb->get_results("SELECT * from `".$wpdb->prefix."translatedwords__mlss` WHERE `title_indx` = '$BlockTitle' and `lang` = '$value' ");
					$output.= 
				'<div class="eachLngWORD">
							<span class="lng_NAME">'.$value.'</span>
							<span class="lng_VALUE"><input class="inpVALUES" type="text" name="titlee['.$BlockTitle.']['.$value.']" value="'.htmlentities(stripslashes($trnsl[0]->translation)).'" /></span>
				</div>';
																	}
				$output .= '
			</div>'; 
			echo $output;
			}
			?>
		<input name="mlss_update1" value="x" type="hidden" /><input type="hidden" name="inp_SecureNonce" value="<?php echo wp_create_nonce('fupd_mlss');?>" />
		</form>	
			<br/><span class="save_div_lexic" style=""><a href="javascript:UpdateSaveAjax();" class="lexic_SUBMIT" >SAVE CHANGES!!</a></span> 
			<div class="addNEWlnBLOCK">
				<span style="color:blue;text-decoration:none;">ADD NEW block (with unique INDEXNAME. for example: <b style="color:red;">MyFooterHello</b>):</span> 
				<input type="text" id="newBlockTitle" value="" /> <a style="background-color:#00D8E0;" href="javascript:add_new_Block();"> Add </a>
			</div>
			<br/><br/>
			<!-- <div style="float:right;font-style:italic;">(p.s you can use shortcodes too, for example,in widgets or posts. for example: <b><span class="codee" style="font-style:normal;">[MLSS_phrase name="<span style="color:red;">my_HeadingMessage</span>"]</span></b></div>-->

			<script type="text/javascript">
			function add_new_Block()	{
					var a= document.createElement("div"); document.getElementById("lexiconnn").appendChild(a);    a.style.backgroundColor = "#F29292";
					
					var BlockTitleNew= document.getElementById("newBlockTitle").value;
					var Langs= {<?php foreach (LANGS__MLSS() as $k=>$v) { echo "'".$k."':'".$v."',"; } ?>}; var property; 	var output = 
				'<div class="eachColumn" id="' + BlockTitleNew + '">'+
					'<div class="title">NAME: <span class="crnt_keyn">' + BlockTitleNew + '</span></div>'+
					'<div class="delete"><a href="javascript:deleteThisBlock(\'' + BlockTitleNew + '\');">DELETE</a></div>';
							for (property in Langs)	{output += 
					'<div class="eachLngWORD">'+
						'<span class="lng_NAME">'+ property +'</span>'+
						'<span class="lng_VALUE"><input class="inpVALUES" type="text" name="titlee['+ BlockTitleNew +']['+ Langs[property] +']" value="-----------------------------" /></span>'+
					'</div>';
													}
							output += 
				'</div>';
				alert("ADDED! now fill it"); a.innerHTML =  output;				
			}
			function deleteThisBlock(IDD){ 	if (confirm("Are you sure?")){var x=document.getElementById(IDD); x.parentNode.removeChild(x);}   }
			</script>
			
			
			<?php include_once(__DIR__.'/flags/javascript_functions.php'); ?> <script type="text/javascript">
			function UpdateSaveAjax()	{var data=serialize(document.getElementById("lexiconnn"));   myRequest_1(data, "","POST", "alert(responseee);" ); }
			</script>
			
		<?php 
	}
}

	add_action('init','verify_saved_words__MLSS'); function verify_saved_words__MLSS(){
		if (isset($_POST['mlss_update1']) && iss_admiiiiiin__MLSS()){		
			NonceCheck__MLSS($_POST['inp_SecureNonce'],'fupd_mlss');
			foreach($_POST['titlee'] as $name1=>$Value1){
				foreach($Value1 as $name2=>$Value2){
					UPDATEE_OR_INSERTTT__MLSS($GLOBALS['wpdb']->prefix."translatedwords__mlss", 
												array('translation'=>$Value2),
												array('title_indx'=>$name1, 'lang'=> $name2) );
				}
			}
			die("successfully updated");
		}
	}
	
	
	//====================================================================
	// SHow or hide other language's categories from categories checkbox list (while opening NEW CUSTOM POST)
	//=========================================================================
	add_action('admin_head','ShowOrHideOtherLangCategs__MLSS'); function ShowOrHideOtherLangCategs__MLSS(){
		if (stristr(currentURL__MLSS,admin_url('post-new.php?post_type='))) {
			if (in_array($_GET['post_type'], LANGS__MLSS())){
				?> <?php include_once(__DIR__.'/flags/javascript_functions.php'); ?>
				<style type="text/css">	#Z_categorydiv{z-index:2339;} #Z_category-adder{display:none;} #Z_category-tabs{display:none;}	</style>
				<div id="CatDrHeader" style="display:none;">
					<div style="margin:0 0 0 1px;"><span style="color:red;">Dont forget, choose one Category.</span>
					<br/><br/>[From now,Hide other Lang categories <input type="hidden" name="showhidcat__MLSS" value="no" /><input type="checkbox" name="showhidcat__MLSS" value="yes" <?php if (get_option('optMLSS__ShowHideOtherCats')=='yes'){echo 'checked="checked"';};?> id="showhidecatID" onclick=""  />]
					</div>
				</div>
				<script type="text/javascript">
					function myAlert(){
						if (document.getElementById('category-adder')){
							SHOW_blackGROUND();
							document.getElementById('category-adder').style.display='none';	document.getElementById('category-tabs').style.display='none';
							var cDiv = document.getElementById('categorydiv');	cDiv.style['zIndex']='9639';	cDiv.onclick = function(){REMOVE_blackGROUND();};
							var MessageDiv = document.createElement('div');		MessageDiv.innerHTML = document.getElementById("CatDrHeader").innerHTML;
							cDiv.insertBefore(MessageDiv, cDiv.childNodes[0]); 	//window.setTimeout('',4000);
						}
					} window.onload=function(){myAlert();};
				</script>
				<?php  //hide all other categories
				if (get_option('optMLSS__ShowHideOtherCats')=='yes') { ?>
					<style type="text/css"> 	<?php foreach (LANGS__MLSS() as $each) { 	 if ($each != $_GET['post_type']){echo 
						'#categorychecklist li#category-'. get_category_by_path($each,true) ->term_id.' {display:none;}';	}} ?>
					</style> 
					<?php
				}
			}
		}
	} 
	//saving your chosen YES/NO value
	add_action('save_post', 'save_ShowOrHideCats__MLSS');	function save_ShowOrHideCats__MLSS() 	{
		if (!empty($_POST['showhidcat__MLSS'])) { update_option('optMLSS__ShowHideOtherCats', $_POST['showhidcat__MLSS']); }
	}
	// =================================### Show/Hide other cats=================
	// =========================================================================


	
	
	

	
			

//================================================================================== //
//===================================== END# DASHBOARD ============================= //
//================================================================================== //	



?>
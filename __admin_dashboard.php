<?php
if (!defined('ABSPATH')) exit;

// START, if admin url
if ( is_admin() ){
	add_action('admin_menu', 'exec_pages__MLSS'); function exec_pages__MLSS() {
		add_menu_page('MultiLang Simple', 'MultiLang Simple', 'manage_options','my-mlss-slug', 'my_submenu1__MLSS',  PLUGIN_URL_nodomain__MLSS.'/flags/a_main.png', "29.4342423" );
		add_submenu_page('my-mlss-slug', 'MLSS Settings',	'MLSS Settings',	'manage_options', 'my-mlss-slug',  'my_submenu1__MLSS');
		add_submenu_page('my-mlss-slug', 'Translated Words','Translated Words',	'manage_options', 'my-mlss-slug2', 'my_submenu2__MLSS');
	}  //NonceCheck__MLSS()  is in main file
	
	
	//===================================================FIRST SUBMENU (settings)==========================================
					//At first, update priority fields...
					add_action('init','ffff454__MLSS',1);function ffff454__MLSS(){
						if (is_admin() && iss_admiiiiiin__MLSS()){
							if (isset($_POST['mlss_FRRULES_AGAIN'])){ MyFlush__MLSS(false); }
							if (isset($_POST['inp_SecureNonce1'])){	
								NonceCheck__MLSS($_POST['inp_SecureNonce1'],'fupd_mlss');
								
								$_POST = array_map("trim", $_POST);	//TRIM ALL requests	
									if(get_option('optMLSS__OnOffMode') != $_POST['ioptMLSS__OnOffMode']){ $NEEDS_FLUSH_REDIRECT=true;}
								update_option('optMLSS__OnOffMode', $_POST['ioptMLSS__OnOffMode']);	
									if(get_option('optMLSS__Lngs') 	!= $_POST['inp_Langs'])				 { $NEEDS_FLUSH_REDIRECT=true;}
								update_option('optMLSS__Lngs',      str_replace(array('{ ',' }'), array('{','}'),$_POST['inp_Langs']));	
									if(get_option('optMLSS__BuildType') != $_POST['lang_rebuild'])		 { $NEEDS_FLUSH_REDIRECT=true;}
								update_option('optMLSS__BuildType', $_POST['lang_rebuild']);
									if(get_option('optMLSS__EnableCustCat') != $_POST['EnableCustCats']) { $NEEDS_FLUSH_REDIRECT=true;}
								update_option('optMLSS__EnableCustCat', $_POST['EnableCustCats']);
									if(get_option('optMLSS__CatBaseRemoved') != $_POST['RemoveCatBase']) { $NEEDS_FLUSH_REDIRECT=true;}
								update_option('optMLSS__CatBaseRemoved',	 $_POST['RemoveCatBase']);
								if (isset($NEEDS_FLUSH_REDIRECT)) { MyFlush__MLSS(true);}    
							}
						}
					}
	function my_submenu1__MLSS() { 
		if (isset($_POST['inp_SecureNonce1'])){	
			$_POST = array_map("trim", $_POST);	//TRIM ALL requests	
			NonceCheck__MLSS($_POST['inp_SecureNonce1'],'fupd_mlss');
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
			update_option('optMLSS__DropdDFixedOrAbs',	$_POST['drd_fixed_rel']);
			
			//update_option('optMLSS__CategSlugname',		$_POST['category_slugname']);
			//update_option('optMLSS__PageSlugname',		$_POST['page_slugname']);
			
		}
		$ChosenSelectorType = get_option('optMLSS__FirstMethod');
		$PluginOnOffMode = get_option('optMLSS__OnOffMode');
		?> 
		<style>	body{font-family:arial;}input.langs{width:100%;} input.hiddenlangs{width:100%;}	span.codee{background-color:#D2CFCF; padding:1px 3px; border:1px solid;} .eachColumn22{border:1px solid;margin:2px 0 0 90px;} .delete22{padding:3px; background-color:#759C83; float:right; display:inline-block;}	.lng_NAME22{width:25px; display:inline-block;padding:0px 2px;} input.inpVALUES22{width:70%;} .title{display: inline-block;} .addNEWlnBLOCK22{position:relative;background-color:#B9B9B9;width:90%; padding:2px; margin: 30px 0 0 100px;} span.save_div_lng22{display:block; position:fixed; bottom:25px; width:300px; left:45%; z-index:101;} a.lng_SUBMIT22{background-color:red; border-radius:5px; padding:5px; color:white; font-size:2em;} span.crnt_keyn{display:inline-block;  color:red; background-color:black; padding:2px;font-weight:bold;}	.hiddenlngs{margin: 10px 0 0 140px;background-color:#DBDBDB;} .dividerrr{background-color:black;height:2px; clear:both; margin:20px 0;} .fakeH22{font-size:2em;font-weight:bold;} .eachBlock{margin: 30px 0px 0px; border: 3px solid; padding: 10px; border-radius: 5px;} a.readpopp{color:#56CC18;} span.smallnotic{font-size: 10px; float: right; right: 5%; position: relative;} .MyJsPopup {text-align:left!important; width:60%!important;top:60px!important; } .MyJsBackg{opacity:0.6!important;}</style> <?php include_once(__DIR__.'/flags/javascript_functions.php'); ?>
		<div class="multiLangSimpPage">
		
				<form action="" method="post" enctype="multipart/form-data" target="_blank" id="addflagimage" style="display:none;">
					Most of flags are not added. Because, at first, you'd better to download <a href="https://ps.w.org/multi-language-site-basis/assets/unused_flags.zip" target="_blank">flags</a>, then name your desired image the <b>3 official letters</b> (as mentioned previously).  For example: <b>spa</b>.png,<b>rus</b>.png... (The image dimensions could be approximately 128px+.)
					<br/><br/>Select image to upload (file will be uploaded in a new window, so, dont worry  - if havent yet saved any changes on current page, they <b>wont be lost</b>):
					<div style="background-color:grey;">						
						<br/><input type="file" name="ImgFile__mlss" /><input type="hidden" name="ImgUploadForm__mlss" value="OK" /> <input type="submit" value="Upload Image" name="submit"> <br/><i>(Will be stored in <?php echo dirname( PLUGIN_URL_nodomain__MLSS) .FlagFolder__MLSS;?>)</i>
					</div>
				</form>
				
				
																<form action="" method="POST">
		<center><h1><b>MLSS</b> Plugin - MultiLanguage Simple Site</h1></center>
		<center><span class="fakeH22">(<a href="javascript:alert('To set-up the Multi-Language website using this plugin, please read all notes on this page...  They are not hard to understand, if you will be a bit skilful and familiar with Wordpress functionalities. Let\u0027 test this plugin well. Also, report me about bugs! \r\n\r\n\r\n(Notes):\r\n1) This plugin is coded simply, using only 1 file! So, if you are experienced developer, you can easily re-produce it.  (To modify/design the output, read the last paragraph on this page). \r\n2) At this moment (I will try to do in near future) this plugin doesnt provide a.k.a. \u0022ALTERNATIVE\u0022 pages for 1 typical page.. instead, it builds the separate language home site, and you can add separate posts&pages or etc..).  ');" class="readpopp">Read popup</a>!)</span></center> 
					<br/><span class="smallnotic">(Visit <a href="http://codesphpjs.blogspot.com/2015/04/wordpress-multi-language-plugin-list.html" target="_blank">other MultiLang plugins</a>...)</span>
					<br/><span class="smallnotic">(Visit <a href="http://j.mp/wpluginstt#mlss" target="_blank">other useful plugins</a>...)</span>
					
		<div class="eachBlock"><span class="fakeH22"></span> 
			<div class="pluginStatus">
				Status: 
				<input type="radio" name="ioptMLSS__OnOffMode" value="oon" <?php echo ($PluginOnOffMode=='oon' ? 'checked="checked"':'');?> />ON(default)  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="ioptMLSS__OnOffMode" value="onlycodes" <?php echo ($PluginOnOffMode=='onlycodes' ? 'checked="checked"':'');?> /><b style="color:red;">Only functionalities</b> (<a href="javascript:show_my_popup('#pluginonoff');" class="readpopp">Read popup</a>!)
					<div id="pluginonoff" style="display:none;">
					ONLY CODES means: This option can be very useful for development/developers - Plugin wont function and it wont trigger any actions itself. Just its functionality can be integrated silently into your theme/plugins, so it will help you, and you'll be able to use its core functionalities and detected language parameters. <!-- (<a href="javascript:show_my_popup('#pluginsparameters');" class="readpopp">See those parameters</a>!). -->
					
					<br/><br/>Those parameters are (At first,better reviewed this page fully, after that you will better understand the below terminology...):
						<div id="pluginsparameters" style="zzzdisplay:none;">
							&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">$GLOBALS['SiteLangs__MLSS']</span> [Returns array of all languages]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">LNG</span> (CONSTANT) [Returns visitor's detected language's name, i.e. "<b>eng</b>" (can be modified,<a href="javascript:alert('this LNG parameter is detected by this plugin\u0027 own logic... \r\n However, in case you wish to pre-set that value with your own logic&function (i dont know, maybe you are programmer, and have your own functions to find out the language parameter yourself, on any page of your site), then you can pre-set the constant,named LNG_PASSED (but ensure, that constant\u0027s value should be correct, 3 official letters, as described previously), in functions.php or elsewhere, with  add_action(\u0027init\u0027,\u0027your_func\u0027,3);  \r\nSo, on every page load, our LNG constant will get that value, and not according to this plugin\u0027s own logic... BUT READ the 6th paragraph about initialization time.');">read more!</a>)]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- Language Specific Widgets [<span style="color:red;">useful!!</span> you can output your pre-defined widgets for any language category.  ]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">echo apply_filters('MLSS','<span style="color:red;">my_HeadingMessage</span>', LNG);</span> [<span style="color:red;">useful!!</span> Returns/Outputs translation of any transaltion_phrase(you will set them in the left sidebar menu),  according to visitor's language. <b>LNG</b> will be auto detected by plugin. however, you can pass, for example: <b>"eng"</b>, instead of LNG, you can pass "eng"]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">[MLSS_phrase name="<span style="color:red;">my_HeadingMessage</span>"]</span> [Shortcode, to return that translation phrase.. can be used in widgets and posts]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">isHomeURI__MLSS</span>     [Returns true or false, whether opened url is exactly home: <b>http://site.com/</b> ]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">isLangHomeURI__MLSS</span> [Returns true or false, whether opened url is exactly any Language's  StartPage: <b>http://site.com/eng/</b>]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">GetFlagUrl('eng')</span> [Returns Flag url for desired language]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">STYLESHEETURL__MLSS</span> [Returns plugin's stylesheet url]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">DetectedPostLang__MLSS($GLOBALS['post']-&gt;ID);</span> [Returns language slug for current post]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">apply_filters('MLSS__firsttimeselector',0);</span> [Returns output of "Select FirstTime Language" popup's list]
							<br/>&nbsp;&nbsp;&nbsp;&nbsp;- <span class="codee">[MLSS_navigation name="<span style="color:red;">your_menus_base_slug</span>"]</span> [read the 6th paragraph on this page]
						</div>
					</div>
			</div>
		</div>



		
		<div class="eachBlock"><span class="fakeH22"> 1) Languages</span> (<a href="javascript:show_my_popup('#enabledlanguages');" class="readpopp">Read popup!</a>)
						<div id="enabledlanguages" style="display:none;">
						<br/>To add a language,  Insert Language title (i.e: <b>Spanish</b>, and after it, in <b>CURLED BRACKETS</b>, insert it's official abbreviation  (Needs to be 3 latin characters,i.e. "<b>spa</b>"....   &nbsp;&nbsp;View  countries' official <a href="http://www-01.sil.org/iso639-3/codes.asp?order=reference_name&letter=%25" target="_blank">3 symbols</a><a href="http://en.wikipedia.org/wiki/List_of_countries_by_spoken_languages#Spanish)" target="_blank">.</a>)
						</div>
						
			<div class="enabled_langs">		
				Enabled langs:
				<br/><input name="inp_Langs" type="text" class="inpt langs" value="<?php echo get_option('optMLSS__Lngs');?>" />
				<br/><div style="float:right;">(p.s. You may need too add your flag image - <a href="javascript:show_my_popup('#addflagimage');" class="readpopp">Read popup!</a>)  </div><div style="clear:both;"></div>
				
			</div>
			<div class="hiddenlngs">
				Hidden Langs: (<i><a href="javascript:alert('later,if you will need to disable any above language, it is better to put its phraze here, rather than removing from the above list. Thus, that language will be just hidden from site(instead of REMOVING),because \u0022REMOVING\u0022 might also remove indexed pages from GOOGLE too..');" class="readpopp">Read popup!</a></i>)
				<br/><input name="inp_HiddenLangs" type="text" class="inpt hiddenlangs" value="<?php echo get_option('optMLSS__HiddenLangs');?>" placeholder="jap,fre," />
			</div>
		</div>
		
		
		
		<div class="eachBlock">			<span class="fakeH22">2) Choose Language for visitors</span>  (<a href="javascript:alert('\r\nNow, whenever a person enters your site\u0027s HOME URL (and it\u0027s \u0022FIRST TIME\u0022 he enters), then you can set a language for him, and he will enter to that language HomePage(i.e. YOURSITE.COM/eng/ )..  Choose your desired option.');" class="readpopp">Read popup!</a>)
		
			<br/> <input type="radio" name="inp_FirstMethod" value="dropddd" <?php echo (($ChosenSelectorType=='dropddd')? 'checked="checked"':'');?> /> <b>A)</b> Let user choose the desired language from dropdown (<a href="javascript:previewww();">See preview</a>) <script type="text/javascript">	function previewww(){ document.cookie="<?php echo cookienameLngs__MLSS;?>=; expires=Thu, 01 Jan 1970 00:00:01 GMT;"; window.open("<?php echo homeURL__MLSS;?>?previewDropd__MLSS","_blank");	}	</script>
				(<i><a href="javascript:alert('(To modify/design the output, read the last paragraph on this page.)');" class="readpopp">Read popup!</a></i>)
			
			<br/> <input type="radio" name="inp_FirstMethod" value="ippp" <?php echo (($ChosenSelectorType=='ippp')? 'checked="checked"':'');?> /><b>B)</b> Autodetect COUNTRY (<a href="javascript:show_my_popup('#autodetectcountry');" class="readpopp">Read popup!</a>)
						
							<div id="autodetectcountry" style="display:none;">
							The plugin contains a detector, to detect visitor's country [using IP]. Fill the table of languages accurately (to input county names correctly, see <a href="<?php echo PLUGIN_URL_nodomain__MLSS;?>flags/ip_country_detect/country_names.txt" target="_blank">this page</a>)
							</div>
			
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
									<input type="radio" name="other_defaulter" value="dropdownn" <?php if("dropdownn"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> /> a) display them FIRSTTIME selector 	&nbsp;&nbsp;&nbsp;<input type="radio" name="other_defaulter" value="fixedd" <?php if("fixedd"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> />b) forced language: <span class="lng_VALUE22"><input class="inpVALUES22"  style="width:50px;" type="text" name="titlee22_default" value="<?php echo get_option('optMLSS__Target_'.'default');?>" placeholder="eng" /></span>
								</div>
							</div>
					</div>
					<script type="text/javascript">	
					 function deleteThisBlock22(IDD){ 	if (confirm("Are you sure?")){var x=document.getElementById(IDD); x.parentNode.removeChild(x);}   }
					</script>
				<br/> <input type="radio" name="inp_FirstMethod" value="fixeddd" <?php echo (($ChosenSelectorType=='fixeddd')? 'checked="checked"':'');?> /> 
			<b>C)</b> redirect all visitors to this fixed language <input style="width:50px;" type="text" name="inp_FirsttimeFixed" value="<?php echo get_option('optMLSS__FixedLang');?>" placeholder="eng" />
		</div>		
		
		<div class="eachBlock">
			<span class="fakeH22"> 3) Design </span>(<a href="javascript:alert('you will see it in the upper corner of your site..(To modify/design the output, read the last paragraph on this page.)');" class="readpopp"><i>Read popup</i></a>!) :
			<br/><br/>*<B>LANGUAGE SELECTOR style </B>:
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="drp_in_header" value="hhide" <?php if ('hhide'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />HIDE 
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="hhorizontal" <?php if ('hhorizontal'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Horizontal
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="vvertical" <?php if ('vvertical'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Vertical
				&nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="ddropdown" <?php if ('ddropdown'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Dropdown
			<br/>*<B>Dropdown Position</B>:&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="left" <?php if ('left'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />LEFT side&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="right" <?php if ('right'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />RIGHT side
			<br/>*<B>Dropdown Distance from</B>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOP:<input type="text" style="width:40px;" name="fromtop" value="<?php echo get_option('optMLSS__DropdDistanceTop');?>" />px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Side:<input type="text" style="width:40px;" name="fromside" value="<?php echo get_option('optMLSS__DropdDistanceSide');?>" />px 
			<br/>*<B>Make it Fixed Position Or Absolute</B>(<a href="javascript:alert('Stay it in FIXED position while you scrolling your site(beware on small resolution screens!)  or stay it as default, not fixed.');" class="readpopp">Read popup!</a>) :  
				<input type="radio" name="drd_fixed_rel" value="absolute" <?php if ('absolute'==get_option('optMLSS__DropdDFixedOrAbs')) {echo 'checked="checked"';}?> />Absolute &nbsp;&nbsp;&nbsp;&nbsp;  <input type="radio" name="drd_fixed_rel" value="fixed" <?php if ('fixed'==get_option('optMLSS__DropdDFixedOrAbs')) {echo 'checked="checked"';}?> />Fixed
			
			
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22"> 4) STRUCTURE</span>
			<br/><b>-Build Up website structure using</b>: 
			<br/><input type="radio" name="lang_rebuild" value="custom_p" <?php if ('custom_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> /><b>Custom Post Types </b>
				(<a href="javascript:show_my_popup('#buildtypeCpost');" class="readpopp">Read popup!</a>)
							<div id="buildtypeCpost" style="display:none;">
								maybe you are already familiar with CUSTOM POST TYPES (It's an additional instance of like Wordpress default "posts/pages". <a href="http://goo.gl/oQkTVv" style="font-size:0.8em" target="_blank">here tutorials</a>)... If you choose this option,then you will see buttons for each language (in the left sidebar).
								<br/>Then, whenever  <b>YOURSITE.COM/<span style="color:red;">eng</span></b>/ is opened, all <b>eng</b>(English) CUSTOM POSTS will be shown.  
								<br/>
								<br/>p.s.1) REMEMBER, always assign a language-specific STANDARD POST to one category!
								<br/>
								<br/>p.s.2) However when visitor makes a SEARCH, it also will be looped through <b>STANDARD</b> posts, which are published under <b>STANDARD</b> root language category ). 
								<br/>
								<br/>p.s.3) In case, you are a programmer and you will need CODING modifications, note, that this plugin modifies queries. So, you can look through the plugin file (<i>pre_get_posts</i> function), to see what and how it behaves.
							</div>
				<span class="cpost_others" style="margin:0 0 0 20px;">
					[enable CUSTOM CATEGORIES too <i>(<a href="javascript:show_my_popup('#EnableCustomCatsss');" class="readpopp">Read popup!</a>)</i>
					<div id="EnableCustomCatsss" style="display:none;">
						You see, that <b>STANDARD</b> categories are be enabled for <b>CUSTOM</b>(languaged) posts. However, if you also want to be added <b>CUSTOM</b> categories too(i dont know, in case you need some complex variations for your site ...), then you can enable it, and you will see the <b>CUSTOM</b> categories will be added too in that <b>CUSTOM</b>(languaged) posts editor.
						<br/><br/>p.s. However, if you dont need them very very much, then maybe there is no need to implement them, but you can simply use <B>standard</b> categories.. 
					</div> <input type="hidden" name="EnableCustCats" value="n" /> <input type="checkbox" name="EnableCustCats" value="y" <?php if ('y'==get_option('optMLSS__EnableCustCat')) {echo 'checked="checked"';} ?> />] 
				</span>
			<br/> <input type="radio" name="lang_rebuild" value="standard_p" <?php if ('standard_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> /> <b>Standard Posts  </b> <i>(<a href="javascript:show_my_popup('#buildtypeSpost');" class="readpopp">Read popup!</a>)</i>
					<div id="buildtypeSpost" style="display:none;">
						In this case i.e. <b>YOURSITE.COM/<span style="color:red;">eng</span></b>/ is opened, all STANDARD posts will be shown, which are published under <b>ENG</b> root category.
						<br/><br/><br/>(NOTE: You dont need to manually set <i>CATEGORY BASE</i> to <b>.</b>(dot) in PERMALINKS settings, because this plugin automatically removes fixed "category_BASE" word from URLs ( instead of <b>YOURSITE.COM/<span style="color:red;">category</span>/eng/my-sub-category</b>, now became <b>YOURSITE.COM/eng/my-sub-category</b> ).  Also, there wont be even problem, if someone will need to use <b>/%category%/%postname%</b> in permalinks, instead of <b>/%postname%</b> .  
						<br/>
						<br/>p.s. In the future,if this feature will no longer work, then uncheck "REMOVE CATEGORY BASE" checkbox, and use plugins(i.e. WP-REMOVE-CATEGORY-BASE ..)
					</div>
			
				<br/><br/><span class="cpost_others" style="margin:0 0 0 20px;">
					*<span class="cpost_othersxx"> [add query strings to post links <i>(<a href="javascript:show_my_popup('#buildtypeSpost');" class="readpopp">Read popup!</a>)</i>
					<div id="buildtypeSpost" style="display:none;">
						If you've chosen CUSTOM_POST Types as BUILDING_TYPE of the site, then you may forget standard posts and never need them. 
						<br/>... Anyway,this plugin leaves you that opportunities too:
						<br/>For example, when you publish any post: Wordpress's default <b>post</b> (OR if you use other CUSTOM POST TYPEs, <b>expect</b> our LANGUAGE POST TYPEs) under specific language CATEGORY(i.e. <b>eng</b>), then this plugin automatically determines the language for such post (according to that CATEGORY's language slug). That post's URL will be like this:
						<br/>SITE.COM/<b>my-standard-post</b>  *while permalinks is set to:  /%postname%
						<br/>OR
						<br/>SITE.COM/eng/sub-categoryy/<b>my-standard-post</b>  *while permalinks is set to:  /%category%/%postname
						<br/><br/>Anyway, if you want, that additionally language parameter appeared in url (i.e. site.com/my-standard-post?<b>lng=eng</b>), then you can check this checkbox. But note, this is not necessary, because the post's language is normally determined without it too. <br/>(However, this might only be useful for you, for example:
							<br/>- for visual purposes;
							<br/>- In case you use other custom post types
							<br/>- In case you use short permalinks(<b>/%postname%</b>) and wish language parameter to appear in urls..
							<br/>- or, in whatever aims you might have...
							<br/><b>But, by default, website functions normally without them of course.</b>)
					</div><input type="hidden" name="EnablePostQueryStr" value="n" /> <input type="checkbox" name="EnablePostQueryStr" value="y" <?php if ('y'==get_option('optMLSS__EnableQueryStrPosts')) {echo 'checked="checked"';} ?> />] 
					</span>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="cpost_othersxx" style="font-size:0.9">
					[remove fixed CATEGORY_BASE word from URLS: <i>(<a href="javascript:alert('As mentioned in previous popup, this feature removes the fixed CATEGORY_BASE word(\u0022/category/\u0022) from category links.');" class="readpopp">Read popup!</a>)</i><input type="hidden" name="RemoveCatBase" value="n" /> <input type="checkbox" name="RemoveCatBase" value="y" <?php if ('y'==get_option('optMLSS__CatBaseRemoved')) {echo 'checked="checked"';} ?> />] 
					</span>
				</span>
			<br/><br/><b>-START PAGES </b>(<a href="javascript:alert('By DEFAULT, while the Language\u0027s MAIN page (i.e. example.com/eng/) is opened, the default homepage/listing is shown (to make it DEFAULT METHOD, then empty the field). \r\n However: \r\n- To set a static, typical post/page as a language\u0027s \u0022MAIN page\u0022,then input the Post\u0027s numeric ID. \r\n- To redirect visitor to any custom URL, then input the FULL LINK there, and plugin will make a redirection(\u0022302\u0022 ) for it.');" class="readpopp">Read popup!</a>) :
			<?php foreach(LANGS__MLSS() as $each){
				echo $each.'&nbsp;<input type="text" style="width:45px;padding:2px;" name="homeID_'.$each.'" value="'.get_option('optMLSS__HomeID_'.$each).'" />&nbsp;&nbsp;&nbsp;&nbsp;';
			} ?>
			
			<!-- <br/><br/><b>-Show only visitor's Languages' entries inside OTHER CUSTOM POST_TYPES listings: </b>(<a href="javascript:alert('(This is a test feature, and it may work on your site, or may not. However, nothing danger is here, you can test.)\r\n\r\n\r\n For example, if you use WP eCommerce or other plugins, and you have other CUSTOM POST TYPES(lets say\u0022PRODUCT\u0022 post-type as an example. Of course,you can imagine anything instead it) on your site, then when you visit \u0022yoursite.com/product\u0022 , then there will be listed all product entries, nevertheless to their checked \u0022language category\u0022. If you want, that inside such CUSTOM POST TYPE listings,  there were shown only such entries, which are assigned to the LANGUAGE CATEGORY(i.e. \u0022ENG\u0022) and visitors detected language is \u0022ENG\u0022 too, then only those language entries will be shown... but this is a bit tricky, and you should have some coding skills: \r\nA) First method is to check \u0022Add Query String\u0022 checkbox above, and then from your style.css, hide all posts from listings, which dont include \u0022?lng=eng\u0022 parameter in url... B) Second method is:  you should open source of LISTING(category) page, where are listed those products.  Find the default start-slug of a typical,looped DIV id(for example, post-63, post-65, post-83 or etc..). In this case, the start-slug will be \u0022post-\u0022. So, check the checkbox, and enter that startslug here:');" class="readpopp">Read popup!</a>) 
				<span class="cpost_others" style="margin:0 0 0 20px;">
				[enabled? <input type="hidden" name="EnableHideOtherCtypeEntri" value="n" /> <input type="checkbox" name="EnableHideOtherCtypeEntri" value="y" <?php //if ('y'==get_option('optMLSS__ShowHideOtherCats')) {echo 'checked="checked"';} ?> />;  &nbsp;&nbsp;&nbsp;&nbsp; If so, enter start-slug:<input type="text" name="SlugofHidenEntriesId" value="<?php //echo get_option('optMLSS__HidenEntriesIdSlug');?>" />] 
				</span> 
			-->
		</div>
		
		<div class="eachBlock">
			<span class="fakeH22"> 5) Translation of Phrases for TEMPLATES FILES</span> - <i><a href="javascript:alert('In addition to the LANGUAGE specific pages/posts, you can utilize auto-translated PHRASES(which can be used in theme PHP files). For this, on the left side, under \u0022MLSS\u0022 menu button, enter \u0022TRANSLATED WORDS\u0022, where you will see the examples..');" class="readpopp">Read popup</a>!</i>
		</div>
	
		<div class="eachBlock">
			<span class="fakeH22">6) NAVIGATIONS, MENUS, WIDGETS.</span>
			<br/>*<b>Show Widgets only for Certain Languages</b> - <a href="javascript:alert('From now, you will see a Dropdown in the top of any Widget(inside ADMIN SIDEBARS). Then, you can choose on which Language the individual widget should be shown. ( If it appears not to work on a certain widget, that widget probably breaks WordPress Widgets API rules somehow). \r\n\r\n\r\n (p.s. Thanks to Author of \u0022SIMPLE WIDGET CLASSES and WIDGET ATTRIBUTES\u0022.) ');" class="readpopp">Read popup</a>!
			<!-- <br/> -B) Another good solution is to use one of these plugins: <span class="codee">Dynamic-Widgets</span>,&nbsp;&nbsp; <span class="codee">Simple-Widgets (<a href="javascript:alert('This plugin allows PHP conditions checking too. You can use condition for individual widgets:  LNG==\u0022eng\u0022  , and similarly for other widgets...');" class="readpopp">Read popup</a>!) </span>, &nbsp;&nbsp; <span class="codee">Restrict-Widgets</span>,.. -->
			
			<br/>*<b>Tree-Like menus in sidebars of your site</b> - <a href="javascript:show_my_popup('#TreeLikeMenus');" class="readpopp">Read popup!</a>
					<div id="TreeLikeMenus" style="display:none;">
						In case, you want to display the "tree-like" menu (for pages,categories, etc...) on your website(in Sidebar or elsewhere), then click "APPEARENCE &gt; Menus" and there create separate custom menu for Each language. <i>(Note, that in the top of that screen,click "<b>SCREEN OPTIONS</b>" to include all available categories.)</i>
						<br/> Then, go to <b>WIDGES</b> and insert each custom menu into widget. 
						<br/><br/><br/>(p.s. if you wish to <b>integrate them within PHP files</b>,then <a href="javascript:show_my_popup('#TreemenuShortcod');" class="readpopp">Read popup!</a>)
						<div id="TreemenuShortcod" style="display:none;">
						   in such case, read this:
						  <br/> on CUSTOM MENUS page, name those custom menus similar names, for example: <span class="codee"><b>eng_</b><span style="color:red;">MyyRightMenuu</span> </span>, <span class="codee"><b>rus_</b><span style="color:red;">MyyRightMenuu</span></span>...
						  <br/>Then, use echo this do_shortcode in your <b>php</b> files : <span class="codee">[MLSS_navigation name="<b>AUTODETECT_</b><span style="color:red;">MyyRightMenuu</span>"]</span>
						</div>
					</div>
			
			<br/>*<b>How to style/modify LANGUAGE Dropdowns,SELECTERS and etc.. output of this plugin? </b> -   <a href="javascript:show_my_popup('#StyleFlagsOutput');" class="readpopp">Read popup!</a>
					<div id="StyleFlagsOutput" style="display:none;">
						1) To modify the First time popup selector (<a href="javascript:previewww();">See preview</a>), then you need (i.e. from your theme's FUNCTIONS.PHP or etc..) to hook your function into <b>MLSS__firsttimeselector</b>. See Example:
						<span class="codee">add_filter('MLSS__dropdownselector','yourFuncNameeeee');
						<br/>function yourFuncNameeeee($passer){
						<br/>&nbsp;&nbsp;&nbsp;return $passer."blablabla";
						<br/>}</span>
						<br/>
						<br/>2) To modify the output of the standard  LANGUAGE SELECTOR/DROPDOWN (which is in top corner of your site), then hook your function similarly, into <b>MLSS__dropdownselector</b>
					</div>
					
			<br/>*<b>How to access the language variables(+functions) from other php files? </b> -  Read first popup in the top.
					
			<br/>*<b>custom coding (output navigation menus,posts or etc...)</b> - <a href="javascript:show_my_popup('#CustomCodings');" class="readpopp">Read popup!</a>)
					<div id="CustomCodings" style="display:none;">
						you can use functions <span class="codee">wp_list_categories(),wp_list_pages(), get_posts()</span>, but use <span class="codee">LNG</span> constant as a "root" slug (of post_type, root category or whatever)... 
						<br/> even, if you want, you can modify the functionality&codes of this plugin - just rename the plugin inner name to your desired name, modify it and then activate. But, It may be better to say with me, as this plugin is developed already.. If you have some suggestions, then let me know, and let's update together ...
					</div>
					
			<br/>*<b>Do you want this plugin to be initialized manually?</b> -   <a href="javascript:show_my_popup('#PluginInitManual');" class="readpopp">Read popup!</a>
					<div id="PluginInitManual" style="display:none;">
						By Default, plugin's  LANGUAGE DETERMINATION+TYPE REGISTRATION starts at:
						<br/> <span class="codee">add_action('init', ..., <span style="color:red;">7</span>);</span>
						<br/> So, if you wish to change the <b>7</b> to any number(i.e. 15), then in <b>wp-config.php</b> insert:  <span class="codee">define('MLSS_INIT_POINT',15);</span>.
						<br/><br/>p.s. For other opportunities, read the first popup, about functionalities.
					</div>


		</div>
		
		<div class="eachBlock">
			<span class="fakeH22">7) Read Important Tips</span>:
				<br/>A) <b>Attention to PERMALINKS</b> - <i><a href="javascript:show_my_popup('#AttentionPermalinks');" class="readpopp">Read popup!</a></i>
					<div id="AttentionPermalinks" style="display:none;">
						in PERMALINKS, you must use PRETTY PERMALINKS ("PRETTY" means i.e. <b>/%postname%</b>,  /%category%/%postname% or etc). Otherwise, this plugn will have problems... 
						<br/>
						<br/>ALSO REMEMBER, everytime you change the custom-post types, or there will be some problems or etc, <b>YOU MAY NEED TO CLICK "SAVE PERMALINKS"</b> button in OPTIONS-Permalinks page, to refresh the website structure.
					</div>
				<br/>B) <b>Attention to QUERY</b> - <i><a href="javascript:show_my_popup('#AttentionQueries');" class="readpopp">Read popup!</a></i>
					<div id="AttentionQueries" style="display:none;">
					Also note, that this plugin wont work, if your theme outputs posts using non-standard(custom) query methods. In this case, you might have to modify your themes code to default HAVE_POSTS() query... 
					</div>
				
				<br/>C) <b>REDIRECTIONS</b> - <i><a href="javascript:alert('please note, if your website has already been established some time ago, and your pages are already indexed in google, and want to use this plugin, then redirect old pages to new pages (using \u0022301 redirect plugin\u0022 or etc..)');" class="readpopp">Read popup!</a></i>
		</div>
		
		<br/><br/><br/><br/>*<b>If you have found bugs or etc, <a href="http://j.mp/wordpressthemestt" target="_blank">CONTACT ME</b></a>! Check if there are UPDATES from time to time!!
		<!--
		<h2 class="tiitl"> 9) parameters </b></h2>
		(NOTE: Once you build a website, and google indexes your site, then dont change this value, or your site will loose all pages+ranking indexed!)
		<br/>*<B>for Categories' links</B>: <input type="text" style="width:150px;" name="category_slugname" value="<?php //echo get_option('optMLSS__CategSlugname');?>" />
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; For example, when you publish "eng" language posts, their link will be like: 
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php //echo homeURL__MLSS;?>/<b style="color:red;">eng</b>/the-last-holidays-i-spent..., 
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; but for categories:
			<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php //echo homeURL__MLSS;?>/<b style="color:red;">eng_<?php //echo get_option('optMLSS__CategSlugname');?></b>/automobiles/mercedes
		<br/>*<B>for Pages' links</B>: <input type="text" style="width:150px;" name="page_slugname" value="<?php //echo get_option('optMLSS__PageSlugname');?>" />
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Like above, but with some specifics: For example, in WORDPRESS Default "PAGES" section, you can create several PARENT pages (i.e. "eng_<b>parentpage</b>","fre_<b>parentpage</b>") and then publish new sub-pages for them.. in this case, the language will be detected automatically on all those "pages", but insert the slug correctly.
		-->
		
		<br/>=================================
			<br/><span class="save_div_lng22"><a class="lng_SUBMIT22" href="javascript:document.forms[1].submit();">SAVE</a></span>
				<input type="submit" value="SAVE" style="display:none;" /> <input type="hidden" name="inp_SecureNonce1" value="<?php echo wp_create_nonce('fupd_mlss');?>" />
		
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
		<input name="mlss_update1" value="x" type="hidden" /><input type="hidden" name="inp_SecureNonce2" value="<?php echo wp_create_nonce('fupd_mlss');?>" />
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
			function UpdateSaveAjax()	{var data=serialize(document.getElementById("lexiconnn"));   myyAjaxRequest(data, "","POST", "alert(responseee);" ); }
			</script>
			
		<?php 
	}
}


























//===================================== OTHER FUNCTIONS FOR DASHBOARD


	//SAVE TRANSLATION WORDS from AJAX request
	add_action('init','verify_saved_words__MLSS'); function verify_saved_words__MLSS(){
		if (isset($_POST['mlss_update1']) && iss_admiiiiiin__MLSS()){		
			NonceCheck__MLSS($_POST['inp_SecureNonce2'],'fupd_mlss');
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
	
	
	//WHEN FLAG IMAGE IS UPLOADED
	add_action('init','DetectFlagIsUploaded__MLSS');function DetectFlagIsUploaded__MLSS(){
		if (!empty($_POST['ImgUploadForm__mlss'])){
			if (is_admin() && iss_admiiiiiin__MLSS()){
				//if directory doesnt exists
				if (!file_exists(dirname(PLUGIN_DIR__MLSS).FlagFolder__MLSS)) {  mkdir(dirname(PLUGIN_DIR__MLSS).FlagFolder__MLSS, 0755, true); }
				$filename	 = basename($_FILES["ImgFile__mlss"]["name"]);
				$tmpname	 = $_FILES["ImgFile__mlss"]["tmp_name"];
				$target_file = dirname(PLUGIN_DIR__MLSS).FlagFolder__MLSS.'/'.$filename;
				$imgType = pathinfo($target_file,PATHINFO_EXTENSION);
				if(getimagesize($tmpname)===false){die("File is not an image.");}								//==fake image
				if($imgType != "png")			{die("Sorry,only PNG files are allowed, and not:".$imgType);} 	//==not PNG
				//if(file_exists($target_file)) {die("Sorry, file already exists.");} 							//==already exists
				//if ($_FILES["ImgFile__mlss"]["size"] > 500000) {die("Sorry, your file is too large.");}		//==upload Size
				if (move_uploaded_file($_FILES["ImgFile__mlss"]["tmp_name"], $target_file)) {echo "<b>".$filename. "</b> uploaded. close this window.";}
				else {echo "Sorry, there was an error uploading your file."; print_r($_FILES); } 				exit;
	}}}

	
	
	
	
	
	
	
	

//=======================================================================================================
// SHOW OR HIDE other language's categories from categories checkbox list (while opening NEW CUSTOM POST)
//========================================================================================================
add_action('admin_footer','ShowOrHideOtherLangCategs__MLSS'); function ShowOrHideOtherLangCategs__MLSS(){
	if (stristr(currentURL__MLSS,admin_url('post-new.php?post_type='))) {
		if (in_array($_GET['post_type'], LANGS__MLSS())){
			?> <?php include_once(__DIR__.'/flags/javascript_functions.php'); ?>
			<style type="text/css">	#Z_categorydiv{z-index:2339;} #Z_category-adder{display:none;} #Z_category-tabs{display:none;}	</style>
			<div style="display:none;"><div id="CatDrHeader">
				<div style="margin:0 0 0 1px;"><span style="color:red;">Dont forget, choose one Category.</span>
				<br/>[From now,hide any other Language categories <input type="hidden" name="showhidcat__MLSS" value="no" /><input type="checkbox" name="showhidcat__MLSS" value="yes" <?php if ('yes'==get_option('optMLSS__ShowHideOtherCats')){echo 'checked="checked"';};?> id="showhidecatID" onclick=""  />]
				</div>
			</div></div>
			<script type="text/javascript">
				function myCategoryAlert(){
					if (document.getElementById('taxonomy-category')){
						//Show Black Background
						SHOW_blackGROUND();
						//POPUP-like CATEGORY WINDOW
						var catDiv = document.getElementById('categorydiv');	catDiv.style['zIndex']='9639';	catDiv.onclick = function(){REMOVE_blackGROUND();};
						//remove "ADD CATEGORY" button from that page, because they MUST set categories on normal page..
						document.getElementById('category-adder').style.display='none';	document.getElementById('category-tabs').style.display='none';
						//INSERT OUR MESSAGE
						var xDiv = document.getElementById('taxonomy-category'); xDiv.insertBefore(document.getElementById('CatDrHeader'), xDiv.childNodes[0]); 	//window.setTimeout('',4000);
					}
				} window.onload=myCategoryAlert();
			</script>
			<?php  //hide all other categories
			if ('yes'==get_option('optMLSS__ShowHideOtherCats')) { ?> <style type="text/css"> 	<?php foreach (LANGS__MLSS() as $each) { 	 if ($each != $_GET['post_type']){echo 
					'#categorychecklist li#category-'. get_category_by_path($each,true) ->term_id.' {display:none;}';	}} ?>
				</style> <?php
			}
		}
	}
} 	add_action('save_post', 'save_ShowOrHideCats__MLSS');	function save_ShowOrHideCats__MLSS() 	{ if (!empty($_POST['showhidcat__MLSS'])) { update_option('optMLSS__ShowHideOtherCats', $_POST['showhidcat__MLSS']); } }
// =================================### Show/Hide other cats=================
// =========================================================================


	
	
	

	
	
	
	
	
	
	
	
//===================================================================================//
//===================================== END# DASHBOARD ============================= //
?>
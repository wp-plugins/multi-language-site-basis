<?php
//somehow similar useful plugin: https://wordpress.org/plugins/language-icons-flags-switcher/	
	
	
	
	
	
//================================================================================== //
//===================================== DASHBOARD ================================== //
//================================================================================== //
if (!defined('ABSPATH')) exit;

// ====================================== USEFUL functions  ================================
//a Admin Validator function
function validate_Nonce__MLSS($value, $action_name){
	if ( !isset($value) || !wp_verify_nonce($value, $action_name) ) { die("not allowed due to interal_error_151");}
}	
// =================================== ##### USEFUL functions #### =============================
 
// START 
if ( is_admin() ){
	add_action('admin_menu', 'exec_pages__MLSS'); function exec_pages__MLSS() {
		add_menu_page('MultiLang Simple', 'MultiLang Simple', 'manage_options','my-mlss-slug', 'my_submenu1__MLSS',  plugin_dir_url( __FILE__ ).'/flags/a_main.png', "29.4342423" );
		add_submenu_page('my-mlss-slug', 'MLSS Settings',	'MLSS Settings',	'manage_options', 'my-mlss-slug',  'my_submenu1__MLSS');
		add_submenu_page('my-mlss-slug', 'Translated Words','Translated Words',	'manage_options', 'my-mlss-slug2', 'my_submenu2__MLSS');
	}
	
	
	
	//===================================================FIRST SUBMENU (settings)==========================================
	function my_submenu1__MLSS() { 
		if (isset($_POST['formupdate__mlss'])){	
			$_POST = array_map("trim", $_POST);	//TRIM ALL requests	
			validate_Nonce__MLSS($_POST['inp_SecureNonce'],'fupd_mlss');
			//update optionsss	
			update_option('optMLSS__FirstMethod',		$_POST['inp_FirstMethod']	); 
			update_option('optMLSS__FixedLang',			$_POST['inp_FirsttimeFixed']); 
			update_option('optMLSS__HiddenLangs',		$_POST['inp_HiddenLangs']	); 
			
						if(get_option('optMLSS__Lngs') 	!= $_POST['inp_Langs']) {
							update_option('optMLSS__Lngs', $_POST['inp_Langs']);
							flush_rewrite_rules(); echo '<script>window.location=location.href; </script>'; //REFRESH PAGE
						}
			update_option('optMLSS__DefForOthers',		$_POST['other_defaulter']);
			foreach (LANGS__MLSS() as $name=>$value){ update_option('optMLSS__Target_'. $value,	$_POST['titlee22_'.$value] ); }
			update_option('optMLSS__Target_'.'default', $_POST['titlee22_default'] );

						if(get_option('optMLSS__BuildType') != $_POST['lang_rebuild']) {
							update_option('optMLSS__BuildType', $_POST['lang_rebuild']);
							flush_rewrite_rules(); echo '<script>window.location=location.href; </script>'; //REFRESH PAGE
						}
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
		.tiitl{margin:30px 0 0; font-weight:bold;}
		.dividerrr{background-color:black;height:2px; clear:both; margin:20px 0;}
		</style>
		<div class="multiLangSimpPage"> <center><h1><b>MLSS</b> Plugin - MultiLanguage Simple Site</h1></center>
			<h2 class="tiitl"> 1) Common setting</h2>
			This <B>MLSS</b> plugin is mainly intended as a helpful functionality for them, who want to have Multi-Language website (The plugin doest provide the "alternate" pages for 1 typical page, instead, it builds the separate language home site). But this can be used by skillful developer, who is able to integrate the functionalities with his theme. (Also, if you wish, you can modify the functionality&codes of this plugin. Just rename the plugin-name to your custom name, modify it and then re-activate).
	<form action="" method="POST">
		<br/>You can add/remove the languages using this field. Insert Language title, and it's official abbreviation  (Needs to be 3 characters... View  countries' official <a href="http://www-01.sil.org/iso639-3/codes.asp?order=reference_name&letter=%25" target="_blank">3 symbols</a><a href="http://en.wikipedia.org/wiki/List_of_countries_by_spoken_languages#Spanish)" target="_blank">.</a>)
		<br/><input name="inp_Langs" type="text" class="inpt langs" value="<?php echo get_option('optMLSS__Lngs');?>" />
		<br/>(p.s. Using FTP or etc, you may need to upload your desired language's <a href="https://sites.google.com/site/thecsmag/file-cabinet/200%2BCountryFlags-MassiveFreebieIconPack.zip" target="_blank">flag</a> image (i.e.: <b>eng.</b>png [approx: 150x100pixels]) in <span class="codee"><?php echo plugin_dir_url(__FILE__);?>flags/</span> )
		<br/>
		<div class="hiddenlngs">
			(later,if you will need to disable any above language, it's better to put its name (3symbol!) here, rather than removing from the above list. Thus, that language will be just hidden from site(instead of REMOVING),because "REMOVING" might also remove indexed pages from GOOGLE too..) 
			<br/>
			<input name="inp_HiddenLangs" type="text" class="inpt hiddenlangs" value="<?php echo get_option('optMLSS__HiddenLangs');?>" placeholder="jap,fre," />
		</div>
		After "SAVE", open your website, to see the language dropdown menu in the upper corner.. Also, please, on the left side, under <b>MLSS</b> menu, open "TRANSLATION WORDS" page, where you will see the translation examples.  
		
		
		<h2 class="tiitl"> 2) Choosing Languages for visitor</h2>
		Now, whenever a person enters your website start page (and it's <b>first time</b> he enters), then you can set a language for him. Select desired option:
		<br/> <input type="radio" name="inp_FirstMethod" value="dropddd" <?php echo (($chosen_method=='dropddd')? 'checked="checked"':'');?> />
		<b>A)</b> Let user choose the desired language from dropdown (<a href="javascript:previewww();">See preview</a>)
			<script type="text/javascript">
			function previewww(){	
				document.cookie = "<?php echo cookienameLngs__MLSS;?>=; expires=Thu, 01 Jan 1970 00:00:01 GMT;"; 
				window.open("<?php echo homeURL__MLSS;?>?previewDropd__MLSS","_blank");	}
			</script>
		
		<br/> <input type="radio" name="inp_FirstMethod" value="ippp" <?php echo (($chosen_method=='ippp')? 'checked="checked"':'');?> />
		<b>B)</b> detect COUNTRY [using visitor's IP] and use the following table of languages (to input county names correctly, see <a href="<?php echo plugin_dir_url(__FILE__);?>flags/ip_country_detect/country_names.txt" target="_blank">this page</a>)
		
				<div id="langset_flds">
				<?php
				global $wpdb;
				//$country_lang_sets = $wpdb->get_results("SELECT * from `".$wpdb->options."` WHERE `option_name` LIKE '".'optMLSS__Target_'."%'");
				//foreach ($country_lang_sets as $each_group){	
				//$abbrev = str_ireplace('optMLSS__Target_','',$each_group->option_name);	 $ItsValue = $each_group->option_value;
				foreach (LANGS__MLSS() as $name=>$value) {
					$abbrev=$value; 
					//$ItsValues=$wpdb->get_results("SELECT * from `".$wpdb->options."` WHERE `option_name` = '".'optMLSS__Target_'.$abbrev."'");
					//$OptValue=$ItsValue[0]->option_value;
					$OptValue= get_option('optMLSS__Target_'.$abbrev);
					echo '<div class="eachColumn22" id="coulang_'.$abbrev.'"> 
							<div class="delete22"><a href="javascript:deleteThisBlock22(\'coulang_'.$abbrev.'\');">DELETE</a></div>
							<div class="eachLngWORD22">
								<span class="lng_NAME22">'.$abbrev.'</span>
								<span class="lng_VALUE22"><input class="inpVALUES22" type="text" name="titlee22_'.$abbrev.'" value="'.htmlentities($OptValue).'" /></span>
							</div>
						</div>';
				}
				?>		<div class="eachColumn22" id="coulang_default" style="background-color:pink;"> 
							<div class="eachLngWORD22">
								<span class="lng_NAME22"  style="width:auto;color:green;">default lang for all other countries:</span>
								<input type="radio" name="other_defaulter" value="dropdownn" <?php if("dropdownn"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> /> a) display them dropdown 	&nbsp;&nbsp;&nbsp;<input type="radio" name="other_defaulter" value="fixedd" <?php if("fixedd"==get_option('optMLSS__DefForOthers')){echo 'checked="checked"';}?> />b) forced language: <span class="lng_VALUE22"><input class="inpVALUES22"  style="width:50px;" type="text" name="titlee22_default" value="<?php echo get_option('optMLSS__Target_'.'default');?>" placeholder="eng" /></span>
							</div>
						</div>
				</div>
				<!-- <div class="addNEWlnBLOCK22">
					<span style="color:red;">Add new combination (3 official language chars + target countries):</span> <br/>
					<input type="text" id="newBlockTitle22" value="" placeholder="zho" style="width:40px;" /> <input type="text" id="newValue22" value="" placeholder="China,Taiwan," style="width:240px;" /> 
					<a style="background-color:#00D8E0;" href="javascript:add_new_Block22();"> Add </a>
				</div>
				<script type="text/javascript">
					function add_new_Block22()	{
						var a= document.createElement("div"); document.getElementById("langset_flds").appendChild(a);
						var BlockTitleNew= document.getElementById("newBlockTitle22").value;
						a.innerHTML ='<div class="eachColumn22" id="coulang_' + BlockTitleNew + '" style="background-color:#F29292;">'+
										'<div class="delete22"><a href="javascript:deleteThisBlock22(\'coulang_' + BlockTitleNew + '\');">DELETE</a></div>'+
										'<div class="eachLngWORD22">'+
											'<span class="lng_NAME22">'+ BlockTitleNew +'</span>'+
											'<span class="lng_VALUE22"><input class="inpVALUES22" type="text" name="titlee22_'+ BlockTitleNew +'" value="'+document.getElementById("newValue22").value+'" /></span>'+
										'</div>'+
									'</div>'; alert("ADDED. You can save now.");
				</script>
				 -->
				<script type="text/javascript">	
				 function deleteThisBlock22(IDD){ 	if (confirm("Are you sure?")){var x=document.getElementById(IDD); x.parentNode.removeChild(x);}   }
				</script>
				 
		<br/> <input type="radio" name="inp_FirstMethod" value="fixeddd" <?php echo (($chosen_method=='fixeddd')? 'checked="checked"':'');?> /> 
		<b>C)</b> redirect all visitors to this fixed language <input style="width:50px;" type="text" name="inp_FirsttimeFixed" value="<?php echo get_option('optMLSS__FixedLang');?>" placeholder="eng" />
				
		
		<h2 class="tiitl"> 3) On-site Dropdown Settings </b></h2>
		*<B>Display Dropdown in header</B>: &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="drp_in_header" value="y" <?php if ('y'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Show &nbsp;&nbsp;&nbsp; <input type="radio" name="drp_in_header" value="n" <?php if ('n'==get_option('optMLSS__DropdHeader')) {echo 'checked="checked"';}?> />Hide
		<br/>*<B>Dropdown Position</B>:&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="left" <?php if ('left'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />LEFT side&nbsp;&nbsp; <input type="radio" name="drdn_aside" value="right" <?php if ('right'==get_option('optMLSS__DropdSidePos')) {echo 'checked="checked"';}?> />RIGHT side
		<br/>*<B>Dropdown Distance from</B>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOP:<input type="text" style="width:40px;" name="fromtop" value="<?php echo get_option('optMLSS__DropdDistanceTop');?>" />px &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Side:<input type="text" style="width:40px;" name="fromside" value="<?php echo get_option('optMLSS__DropdDistanceSide');?>" />px 
		
		
		<h2 class="tiitl"> 4) STRUCTURE </h2>
		<b>-Build Up website structure using</b>:  <input type="radio" name="lang_rebuild" value="custom_p" <?php if ('custom_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> />Custom Post Types (<a href="javascript:alert('maybe you are already familiar with CUSTOM POST TYPES... if you choose this option,then within the left sidebar, you will have menu buttons for each language. Then, whenver i.e. YOURSITE.COM/eng/ is opened, all CUSTOM posts will be shown, which are published under that CUSTOM POST TYPE. \r\n\r\n\r\n[p.s. in case, you will need PROGRAMMING modifications, instead of is_home(), you'd better to use is_post_type_archive()]');">Read this!</a>) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="lang_rebuild" value="standard_p" <?php if ('standard_p'==get_option('optMLSS__BuildType')) {echo 'checked="checked"';} ?> />Standard Posts (<a href="javascript:alert('In this case, whenever i.e. YOURSITE.COM/eng/ is opened, all STANDARD posts will be shown, which are published under ENG sub-category. \r\n\r\n\r\n(NOTE: CATEGORY BASE is set to . in PERMALINKS settings , so, if you want that your archive pages had URLs like: YOURSITE.COM/ENG/sub-category [instead of YOURSITE.COM/category/ENG/sub-category], then dont change it. otherwise, empty that field now, and better not to change it after you establish your website and some time will go...  p.s. if in the future, this feature will no longer work, then use plugins, i.e. WP-REMOVE-CATEGORY-BASE ..) ');">Read this!</a>)
		
		<br/><br/>
		<b>-START PAGES </b>(<a href="javascript:alert('for the Language MAIN page (i.e. example.com/eng/), you can set a particular post/page as a START page. Just input the Post ID. (If you want to show the regular list of posts under that language, then leave empty.)');">Read this!</a>) :
		<?php foreach(LANGS__MLSS() as $each){
			echo $each.'&nbsp;<input type="text" style="width:45px;padding:2px;" name="homeID_'.$each.'" value="'.get_option('optMLSS__HomeID_'.$each).'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		} ?>
		
		
		
	
		<h2 class="tiitl"> 5) NAVIGATION MENUS</b></h2>
		*In case, you want to display the "tree-like" menu of the pages & categories on your website(in Sidebar or elsewhere), then click "APPEARENCE &gt; Menus" and there create custom menu for each language (i.e. name them: <span class="codee"><b>eng_</b><span style="color:red;">DESIRED_SLUG</span> </span>, <span class="codee"><b>rus_</b><span style="color:red;">DESIRED_SLUG</span></span>... ). Note, that in the top of that screen,click "<b>SCREEN OPTIONS</b>" to include all available categories.
		<br/> Then, inside your Sidebar TEXT Widget, place the shortcode <span class="codee">[MLSS_navigation name="<span style="color:red;">DESIRED_SLUG</span>"]</span> (or if you wish in template's .php file, use <span class="codee">do_shortcode([...]);</span>)
		
		<br/><br/>*<b>custom coding (output navigation menus,posts or etc...)</b> - you can use functions <span class="codee">wp_list_categories(),wp_list_pages(), get_posts()</span>, but use <span class="codee">LNG</span> constant to for target (post_type, root category or whatever)..
		
		
		
	
		<h2 class="tiitl"> 6) Some tips</b></h2>
		*please note, if your website has already been established some time ago, and your pages are already indexed in google, and want to use this plugin, then redirect old pages to new pages (using "301 redirect plugin" or so..)
		
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
			<br/>Below are listed the variable keynames. To output any of them in your theme, use code (for example): 
			<br/><b><span class="codee">echo MLSS('<span style="color:red;">my_HeadingMessage</span>');</span></b>
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
				<span style="color:blue;text-decoration:none;">ADD NEW block (with unique index name. for example: <b style="color:red;">MyFooterHello</b>):</span> 
				<input type="text" id="newBlockTitle" value="" /> <a style="background-color:#00D8E0;" href="javascript:add_new_Block();"> Add </a>
			</div>
			
			<br/><br/>
			<div style="float:right;font-style:italic;">(p.s you can use them in text widgets too. for example: <b><span class="codee" style="font-style:normal;">[MLSS name="<span style="color:red;">my_HeadingMessage</span>"]</span></b></div>

								
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
				alert("ADDED! now fill it");
				a.innerHTML =  output;
				
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
			validate_Nonce__MLSS($_POST['inp_SecureNonce'],'fupd_mlss');
			global $wpdb;
			foreach($_POST['titlee'] as $name1=>$Value1){
				foreach($Value1 as $name2=>$Value2){
					UPDATEE_OR_INSERTTT__MLSS($wpdb->prefix."translatedwords__mlss", 
												array('translation'=>$Value2),
												array('title_indx'=>$name1, 'lang'=> $name2) );
				}
			}
			die("successfully updated");
		}
	}


			
			

//================================================================================== //
//===================================== END# DASHBOARD ============================= //
//================================================================================== //	



?>
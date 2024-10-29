<?php
/*
 Plugin Name: beampulse
 Description: Generate beautiful Heatmaps on your Blog with BeamPulse.
 Plugin URI: ?
 Version: 1.0.5
 Author: BeamPulse
 Author URI: www.beampulse.com
*/

// Plugin action : Beampulse Tag Injector
// --> functions prefix : beampulse_taginjector_

//---------------------Ajoute le code au head-------------------------*

function beampulse_taginjector_add_code() {
	echo get_option('Save_code');
}
add_action('wp_head', 'beampulse_taginjector_add_code');

//------------------mis à jour/ajout dans la bdd WP-------------------*

function beampulse_taginjector_update_code() {
	register_setting( 'Beampulse-settings', 'Url_code' );
	register_setting( 'Beampulse-settings', 'Save_code' );
	register_setting( 'Lg-Beampulse-settings', 'Language' );
}

//-------------------Ajoute l'option réglages/settings----------------*

function beampulse_taginjector_option_Settings( $links ) {
	// lien vers la page de config de ce plugin
	array_push( $links,
		'<a href="' . admin_url( 'admin.php?page=BeamPulse-Code' ) . '">' . __( 'Settings' ) . '</a>' );
	// lien vers la page langue de ce plugin
	array_push( $links,
		'<a href="' . admin_url( 'admin.php?page=Lg-BeamPulse-Code' ) . '">' . __( 'Language' ) . '</a>' );
		
	return $links;
}

add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), 'beampulse_taginjector_option_Settings', 10, 2 );

//-----------------------Menu Favoris target='_blank'-----------------*

function beampulse_taginjector_fav_blank(){
	?>
	   <script type="text/javascript">
	   jQuery(document).ready(function($) {
	       $('#Fav').parent().attr('target','_blank');
	   });
	   </script>
	<?php
	}

//---------------------Ajoute page settings au menu-------------------*

add_action( 'admin_menu', 'beampulse_taginjector_beamPulse_menu' );

function beampulse_taginjector_beamPulse_menu() {					//Configuration menu
	if(get_option('Language')=='FR'){
		$page_title  = 'BeamPulse Réglages';
		$menu_title2 = '<font color="#ff9900">Code d\'activation</font>';
		$fav_menu_title = '<div id="Fav"><font color="#88cc00">Trucs+Astuces</font></div>';
		$sub_menu_title = '<font color="#66b3ff">Langue</font>';
		$fav_menu_slug  = 'https://beampulse.atlassian.net/wiki/spaces/GD/pages/3541844/Trucs+Astuces';
	} else {
		$page_title  = 'BeamPulse Settings';
		$menu_title2 = '<font color="#ff9900">Activation Code</font>';
		$fav_menu_title = '<div id="Fav"><font color="#88cc00">Tips+Hints</font></div>';
		$sub_menu_title = '<font color="#66b3ff">Language</font>';
		$fav_menu_slug  = 'https://beampulse.atlassian.net/wiki/spaces/BUW/pages/32805178/Tips+Hints';
	}
	$menu_title  = 'BeamPulse';
	$capability  = 'manage_options';
	$menu_slug   = 'BeamPulse-Code';
	$function    = 'beampulse_taginjector_beamPulse_code';
	$icon_url    = plugin_dir_url(__FILE__) . 'images/screenshot-1.png';
	$position    = '100';

	$sub_menu_slug  = 'Lg-BeamPulse-Code';
	$sub_function   = 'beampulse_taginjector_language';
	
	//*******MENU**********
		
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);			//Menu Beampulse
	add_submenu_page( $menu_slug, $page_title, $menu_title2, $capability, $menu_slug);							//Lien code
	add_submenu_page( $menu_slug, $page_title, $fav_menu_title, $capability, $fav_menu_slug, $fav_function);	//Lien favoris
	add_submenu_page( $menu_slug, $page_title, $sub_menu_title, $capability, $sub_menu_slug, $sub_function);	//Lien langue

	add_action( 'admin_init', 'beampulse_taginjector_update_code' );
	add_action( 'admin_footer', 'beampulse_taginjector_fav_blank' );  
}

//-------------------------page de settings---------------------------*

function beampulse_taginjector_beamPulse_code(){
	?>
	<style>	
		.beampulse_taginjector_block{
			background-color: #f2f2f2;
			box-shadow: 0px 0px 10px #bfbfbf;
			border: 3px solid #d9d9d9;
			width: 650px;
			margin-bottom: 25px;
		}
		
		.beampulse_taginjector_titre{
			background-color: #eaeaea;
			box-shadow: 0px 4px 4px #bfbfbf;
			margin-top: 0px;
			padding: 20px 20px 10px 20px;
			color: black;
			font-size: 25px;
			font-weight: bold;
		}
			
		.beampulse_taginjector_zone_text{
			font-family: monospace;
			width: 600px;
			height: 200px;
			resize: none;
			margin: 0px 0px 15px 25px;
			cursor: default;
		}
		
		.beampulse_taginjector_text{
			color: grey;
			font-size: 15px;
			font-weight: bold;
			padding-left:15px;
		}
		
		.beampulse_taginjector_btn1{
			background-color: #87b87f;
			color: #ffffff;
			margin: 0px 25px 15px 25px;
			padding: 5px 5px 5px 5px;
			border-radius: 3px;
			font-weight: bold;
			box-shadow: 0px 0px 5px #bfbfbf;
			border: 1px solid #74ae6b;
		}
		.beampulse_taginjector_btn1:hover{
			box-shadow: inset 0px 0px 5px 0px #656565;
			cursor: pointer;
		}
		
		.beampulse_taginjector_btn2{
			background-color: #ff9900;
			color: #ffffff;
			margin: 0px 25px 15px 25px;
			padding: 5px 5px 5px 5px;
			border-radius: 3px;
			font-weight: bold;
			box-shadow: 0px 0px 5px #bfbfbf;
			border: 1px solid #cc7a00;
		}
		.beampulse_taginjector_btn2:hover{
			box-shadow: inset 0px 0px 5px 0px #656565;
			cursor: pointer;
		}
		
		
		.beampulse_taginjector_btn_text{
			background-color: transparent;
			color: #5F8E00;
			font-weight: bold;
			border-width: 0;
			font-size: 15px;
		}
		.beampulse_taginjector_btn_text:hover{
			cursor: pointer;
		}
		
		.beampulse_taginjector_url{
			width: 550px;
			margin-left: 25px;
		}
		
		.beampulse_taginjector_imgtuto{
			width: 620px;
			margin: 5px 15px 5px 15px;
			cursor: zoom-in;
		}
		
		.beampulse_taginjector_loader{
			background: url(<?php 	if(get_option('Language')=='FR') {
										echo plugin_dir_url(__FILE__).'images/screenshot-3.png';
									} else {
										echo plugin_dir_url(__FILE__).'images/screenshot-2.png';
									}
							?>) 50% 50% no-repeat rgba(255, 255, 255, 0.8);
			cursor: wait;
			height: 100%;
			left: 0;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 9999;
		}
	</style>	
	
	<script>jQuery(window).load(function(){ jQuery(".beampulse_taginjector_loader").fadeOut("200"); });</script>
	
	<div class="beampulse_taginjector_loader" <?php if(get_option('Save_code')!='' || get_option('Url_code') == ''){echo 'style="display:none"';}?>></div>	
		
	<form method="post" action="options.php">
	
	<div style="margin:auto; width:50%;">
		<div class="beampulse_taginjector_block">
			<?php settings_fields( 'Beampulse-settings' );
			do_settings_sections( 'Beampulse-settings' ); ?>
			<p id="CheckLg" class="beampulse_taginjector_titre"><?php 
				if(get_option('Language')=='FR'){
					echo 'Réglages de BeamPulse';
				} else {
					echo 'BeamPulse Settings';
				}?></p>
			<div <?php if(get_option('Url_code')!=''){ echo 'style="display:none"'; }?>>
				<p class="beampulse_taginjector_text"><?php 			
					if(get_option("Language")=="FR"){
						echo 	'Cette extension nécessite un compte beampulse correctement configuré.
								<br><br>
								Le lien à copier se trouve sur votre compte BeamPulse à l\'emplacement indiqué ci-dessous :';
					} else {
						echo 	'This extension requires a configured beampulse account.
								<br><br>
								The link to copy is located on your BeamPulse account at the location shown below:';
					}?></p>
					<?php if(get_option('Language')=='FR'){
						echo '<a href="'.plugin_dir_url(__FILE__).'images/screenshot-5.png'.'" target="_blank"><img class="beampulse_taginjector_imgtuto" src="'.plugin_dir_url(__FILE__).'images/screenshot-5.png'.'" /></a>';
						echo '<a href="'.plugin_dir_url(__FILE__).'images/screenshot-7.png'.'" target="_blank"><img class="beampulse_taginjector_imgtuto" src="'.plugin_dir_url(__FILE__).'images/screenshot-7.png'.'" /></a>';
					} else {
						echo '<a href="'.plugin_dir_url(__FILE__).'images/screenshot-4.png'.'" target="_blank"><img class="beampulse_taginjector_imgtuto" src="'.plugin_dir_url(__FILE__).'images/screenshot-4.png'.'" /></a>';
						echo '<a href="'.plugin_dir_url(__FILE__).'images/screenshot-6.png'.'" target="_blank"><img class="beampulse_taginjector_imgtuto" src="'.plugin_dir_url(__FILE__).'images/screenshot-6.png'.'" /></a>';
					}?>
			</div>
			
			<p class="beampulse_taginjector_text"><?php
				if(get_option('Language')=='FR'){
					$val1 = 'Insérer votre URL :';
					$val2 = 'Votre URL :';
				} else {
					$val1 = 'Insert your URL:';
					$val2 = 'Your URL:';
				}
				if(get_option('Url_code')=='' && get_option('Save_code')==''){
					echo $val1;
				}
				else{
					echo $val2;
				}?>
				<input id="text_url" type="text" name="Url_code" class="beampulse_taginjector_url" autocomplete="off" value="<?php echo get_option('Url_code')?>" 
				<?php
				if(get_option('Url_code')!=''){
					echo 'readonly';
					echo ' style="cursor:default"';
				}?>></p>
			<tr>
				<input id="Btn_charger" type="submit" class="beampulse_taginjector_btn1" value="<?php
				if(get_option('Language')=='FR'){
					$val1 = 'Charger Url';
					$val2 = 'Activer';
				} else {
					$val1 = 'Load Url';
					$val2 = 'Activate';
				}
				if(get_option('Url_code')=='' && get_option('Save_code')==''){
					echo $val1;
				}
				else{
					echo $val2;
				}?>" <?php
				if(get_option('Save_code')!=''){
					echo 'style="display:none"';	
				}?>>
				<input type="submit" class="beampulse_taginjector_btn2" value=<?php 
				if(get_option('Language')=='FR'){
					echo 'Supprimer';
				} else {
					echo 'Delete';
				}?> onclick="beampulse_taginjector_erase()" <?php
				if(get_option('Url_code')==''){
					echo 'style="display:none"';
				}?>>
			</tr>
		</div>
	
		<div id="block_script" class="beampulse_taginjector_block">
			<div style="display:none;">
			<?php //Recuperation page de l'url
			if(get_option('Save_code')==''){
				if(get_option('Url_code')!=''){
					echo file_get_contents(get_option('Url_code'));
				}
			}?>
			</div>
			<p class="beampulse_taginjector_text"><?php 
				if(get_option('Language')=='FR'){
					$mod1 = 'synchrone';
					$mod2 = 'semi-synchrone';
					$mod3 = 'asynchrone';
					if(get_option('Save_code')==''){
						$val3  = 'Cliquez sur "';
						$val3b  = '" pour installer le script d\'activation <font color="#003cb3">';
						$val4   = '</font> suivant :';
						$btntxt = '<input type="submit" class="Btn_text" value="Activer">';
					} else {
						$val3 = 'Le script d\'activation <font color="#003cb3">';
						$val4 = '</font> suivant a été activé.';
					}
				} else {
					$mod1 = 'synchronous';
					$mod2 = 'semi-synchronous';
					$mod3 = 'asynchronous';
					if(get_option('Save_code')==''){
						$val3  = 'Click "';
						$val3b  = '" to install the following <font color="#003cb3">';
						$val4   = '</font> activation script:';
						$btntxt = '<input type="submit" class="Btn_text" value="Activate">';
					} else {
						$val3 = 'The following <font color="#003cb3">';
						$val4 = '</font> activation script has been activated.';
					}
				}
				if(get_option('Url_code')!=''){
					$mode = substr(get_option('Url_code'), -4);
					switch ($mode){
						case "true":
							echo $val3.$btntxt.$val3b.$mod1.$val4;
							break;
						case "semi":
							echo $val3.$btntxt.$val3b.$mod2.$val4;
							break;
						default:
							echo $val3.$btntxt.$val3b.$mod3.$val4;
					}
				}?></p>
			<textarea id="Script_code" name="Save_code" class="beampulse_taginjector_zone_text" readonly><?php echo get_option('Save_code')?></textarea>
			
			<script>if(document.getElementById('Script_code').innerHTML == ''){document.getElementById('Script_code').innerHTML = document.getElementById('tracking_code').innerHTML.trim();}</script>
			
			<div id="block_info" style="padding:0px 25px 25px 25px">
				<p><?php	
					if(get_option('Url_code')!=''){
						$mode = substr(get_option('Url_code'), -4);
						if(get_option('Language')=='FR'){   //-----vvv-----FR-----vvv-----*
							$text1 = "<b>ATTENTION :</b> Pour éviter tout effet de papillotement (anti-flickering) le script synchrone masque la page pendant son chargement (au maximum pendant 1 seconde). Ainsi, les substitutions effectuées par les tests AB ne sont pas perceptibles par les internautes.À la différence du script semi-synchrone il est possible qu'il ralentisse votre site, notamment en cas de latence réseau.";
							$text2 = "<b>ATTENTION :</b> Pour éviter tout effet de papillotement (anti-flickering) le script semi-synchrone masque la page pendant son chargement (au maximum pendant 1 seconde). Ainsi les substitutions réalisées par les tests AB ne sont pas perceptibles par les internautes.";
							$text3 = "<b>ATTENTION :</b> Ce code Javascript est totalement asynchrone, cela signifie qu'il se charge après le chargement complet de la page. Le chargement de la page n’est donc pas ralenti.";	
							$text  = "Le script d'activation ci-dessus sera placé juste au-dessus de la balise <b>\"/head\"</b> des pages de votre site.<br><br>";
						} else {							//-----vvv-----EN-----vvv-----*
							$text1 = "<b>WARNING:</b> To avoid flickering, the synchronous script hides the page during loading (maximum 1 second). Thus, the substitutions made by the AB tests are not perceptible by the Net surfers. Unlike the semi-synchronous script, it is possible that it slows down your site, especially in case of network latency.";
							$text2 = "<b>WARNING:</b> To avoid flickering, the semi-synchronous script hides the page during loading (maximum 1 second). Thus the substitutions made by the AB tests are not perceptible by the Net surfers.";
							$text3 = "<b>WARNING:</b> This Javascript code is totally asynchronous, which means that it loads after the full load of the page. The loading of the page is therefore not slowed down.";
							$text  = "The activation script above will be placed just above the <b>\"/head\"</b> tag on your site's pages.<br><br>";
						}
						echo $text;
						switch ($mode){
							case "true":
								echo $text1;
								break;
							case "semi":
								echo $text2;
								break;
							default:
								echo $text3;
						}
					}?></p>
			</div>
		</div>
		<script type="text/javascript">
			var check_1 = document.getElementById("Script_code").innerHTML ;
			var check_2 = document.getElementById("text_url").value ;
			var check_3 = document.getElementById("CheckLg").innerHTML ;
			if (check_1 == "") {
				document.getElementById("block_script").style.display = "none";
				if(check_2 != "") {
					document.getElementById("Btn_charger").style.display = "none";
					if(check_3 == 'Réglages de BeamPulse'){
						document.getElementById("text_url").value = 'L\'URL que vous avez inséré n\'est pas correct...';
					} else {
						document.getElementById("text_url").value = 'The URL you inserted is not correct...';
					}
				}
			}
		</script>
	</div>
	</form>
	<script type="text/javascript">
		function beampulse_taginjector_erase() {	
			document.getElementById("Script_code").innerHTML = '';
			document.getElementById("text_url").value = '';
		}
	</script>
	<?php
}

//------------------------Page Langue---------------------------------*

function beampulse_taginjector_language(){
	?>
	<style>	
		.beampulse_taginjector_block{
			background-color: #f2f2f2;
			box-shadow: 0px 0px 10px #bfbfbf;
			border: 3px solid #d9d9d9;
			width: 400px;
			margin:25px;
			padding-bottom:25px;
		}
		
		.beampulse_taginjector_titre{
			background-color: #eaeaea;
			box-shadow: 0px 4px 4px #bfbfbf;
			margin-top: 0px;
			padding: 20px 20px 10px 20px;
			color: black;
			font-size: 25px;
			font-weight: bold;
		}
		
		.beampulse_taginjector_btn{
			background-color: #0039e6;
			color: #ffffff;
			margin: 0px 25px 15px 25px;
			padding: 3px 5px 3px 5px;
			border-radius: 5px;
			font-weight: bold;
		}
		
		.beampulse_taginjector_sous_titre{
			font-size: 18px;
			font-weight: bold;
			padding-left:15px;
		}
		
		label{
			color: grey;
			font-size: 15px;
			font-weight: bold;
		}
		
	</style>
	<form method="post" action="options.php">
		<div class="beampulse_taginjector_block">
			<?php settings_fields( 'Lg-Beampulse-settings' );
			do_settings_sections( 'Lg-Beampulse-settings' ); ?>
			<p class="beampulse_taginjector_titre"><?php 
				if(get_option('Language')=='FR'){
					echo 'Réglages de BeamPulse';
				} else {
					echo 'BeamPulse Settings';
				}?></p>
			<p class="beampulse_taginjector_sous_titre"><?php 
				if(get_option('Language')=='FR'){
					echo 'Choisissez votre langue :';
				} else {
					echo 'Choose your language:';
				}?></p>
			<table style="text-align:center">
				<tr>
					<td style="width:200px"><label><input type= "radio" name="Language" value="EN" onChange="submit()" checked> English</label></td>
					<td style="width:200px"><label><input type= "radio" name="Language" value="FR" onChange="submit()" <?php if(get_option('Language')=='FR'){echo 'checked';} ?>> Français</label></td>
				</tr>
			</table>
		</div>
	</form>
	<?php
}

//--------------------------------------------------------------------*



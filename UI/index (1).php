<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DOTA Analysis</title>
</head>
<?php
$GLOBALS['FV']="1";
$GLOBALS['DH3']=" ";
$GLOBALS['DH4']=" ";
$GLOBALS['formVar1'] = "0";
$GLOBALS['formRH3'] = "1";
$GLOBALS['formDH3'] = "1";
$GLOBALS['formRH4'] = "1";
$GLOBALS['formDH4'] = "1";
$GLOBALS['formRH5'] = "1";
$GLOBALS['formDH5'] = "1";
$GLOBALS['Suggestion1'] = " ";
$GLOBALS['Suggestion2'] = " ";
$GLOBALS['Suggestion3'] = " ";
		$heroArray = array("bane", "crystal_maiden", "drow_ranger", "earthshaker", "juggernaut", "mirana", "nevermore", "morphling", "phantom_lancer",
		 "puck", "pudge", "razor", "bloodseeker", "axe", "sven", "storm_spirit", "tiny", "vengefulspirit", "windrunner", "sand_king", "antimage",
		  "zuus", "kunkka", "lina", "lich", "lion", "slardar", "shadow_shaman", "tidehunter", "enigma", "tinker", "sniper", "witch_doctor", "riki",
		   "queenofpain", "necrolyte", "venomancer", "faceless_void", "skeleton_king", "death_prophet", "beastmaster", "phantom_assassin", "pugna",
		    "templar_assassin", "viper", "warlock", "luna", "leshrac", "rattletrap", "furion", "life_stealer", "dark_seer", "clinkz", "omniknight",
		     "dragon_knight", "enchantress", "night_stalker", "broodmother", "bounty_hunter", "weaver", "jakiro", "batrider", "chen", "spectre",
		      "doom_bringer", "ursa", "ancient_apparition", "spirit_breaker", "dazzle", "alchemist", "huskar", "silencer", "obsidian_destroyer",
		       "invoker", "gyrocopter", "lycan", "brewmaster", "shadow_demon", "lone_druid", "chaos_knight", "meepo", "rubick", "disruptor",
		        "undying", "nyx_assassin", "naga_siren", "keeper_of_the_light", "wisp", "visage", "ogre_magi", "treant", "slark", "medusa",
		         "magnataur", "bristleback", "shredder", "tusk", "skywrath_mage", "troll_warlord", "centaur", "ember_spirit", "elder_titan",
		          "abaddon", "earth_spirit", "abyssal_underlord", "terrorblade", "phoenix", "techies", "legion_commander", "oracle", "winter_wyvern",
		           "arc_warden"); ?>
<body>
	<h1>Dota Analysis</h1> 
	<h3 style="float:right;">Visualizations</h3>
	<br />
	<h2>Hero Select Interface</h2> <br />
	<form action="index.php"  method="post" enctype="multipart/form-data">
	Radiant hero 1
	<select name='RHero1'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

Dire hero 1
	<select name='DHero1'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> <br />


Radiant hero 2
	<select name='RHero2'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 
	


Dire hero 2
	<select name='DHero2'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> <br />

<button type="submit" name="post" <?php if ( $GLOBALS['formVar1'] == '1'){ ?> disabled <?php   } ?>>Submit</button>

</form>
	 <?php

// First Submit;
if (isset($_POST['post']))
 {
     $GLOBALS['RH1']=$_POST['RHero1'];
     $GLOBALS['RH2']=$_POST['RHero2'];
     $GLOBALS['DH1']=$_POST['DHero1'];
     $GLOBALS['DH2']=$_POST['DHero2']; 
     $GLOBALS['formVar1'] = "1";
	 $GLOBALS['formDH3'] = "0";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['FV']="0";

// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'&opponent='.$GLOBALS['DH2'].'';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
$GLOBALS['Suggestion1'] = $decoded[0];
$GLOBALS['Suggestion2'] = $decoded[1];
$GLOBALS['Suggestion3'] = $decoded[2];
}
?>

<h4>Select Radiant Hero 3</h4>
<!-- Hero 3 

Radiant Hero 3-->

<form action="index.php"  method="post" enctype="multipart/form-data">
	Radiant hero 3
	<select name='RHero3'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

<h4>Select Dire Hero 3</h4>
<!-- Dire Hero 3 -->

Dire hero 3
	<select name='DHero3'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

<button type="submit" name="DH3" <?php if ( $GLOBALS['formDH3'] == '1'){ ?> disabled <?php   } ?> >Submit</button>

</form>

<?php

//Dire Hero 3
if (isset($_POST['DH3']))
 {
 	 $GLOBALS['RH3']=$_POST['RHero3'];
     $GLOBALS['DH3']=$_POST['DHero3'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "0";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";
	 $GLOBALS['FV']="0";

// PHP code for suggestion
$service_url = $service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
$GLOBALS['Suggestion1'] = $decoded[0];
$GLOBALS['Suggestion2'] = $decoded[1];
$GLOBALS['Suggestion3'] = $decoded[2];
}
?>
<h4>Select Radiant Hero 4</h4>
<!-- Hero 4 
Radiant Hero 4-->

<form action="index.php"  method="post" enctype="multipart/form-data">
	Radiant Hero 4
	<select name='RHero4'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 


<h4>Select Dire Hero 4</h4>
<!-- Dire Hero 4 -->
Dire hero 4
	<select name='DHero4'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

<h4>Select Dire Hero 5</h4>
<!-- Hero 5 
Dire Hero 5-->
Dire hero 5
	<select name='DHero5'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 
<button type="submit" name="RH4" <?php if ( $GLOBALS['formDH4'] == '1'){ ?> disabled <?php   } ?> >Submit</button>
</form>
<?php

//Dire Hero 5
if (isset($_POST['RH4']))
 {
 	 $GLOBALS['RH4']=$_POST['RHero4'];
 	 $GLOBALS['DH4']=$_POST['DHero4'];
     $GLOBALS['DH5']=$_POST['DHero5'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "0";
	 $GLOBALS['FV']="0";
 
// PHP code for suggestion
$service_url ='http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'&my='.$GLOBALS['RH4'].'&opponent='.$GLOBALS['DH4'].'&opponent='.$GLOBALS['DH5'].'';
$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);
if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additioanl info: ' . var_export($info));
}
curl_close($curl);
$decoded = json_decode($curl_response);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}
echo 'response ok!';
//var_export($decoded->response);
$GLOBALS['Suggestion1'] = $decoded[0];
$GLOBALS['Suggestion2'] = $decoded[1];
$GLOBALS['Suggestion3'] = $decoded[2];
}
?>


<h4>Select Radiant Hero 5</h4>

<form action="index.php"  method="post" enctype="multipart/form-data">
	Radiant hero 5
	<select name='RHero5'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

</form>

<br /><h2>Hero Suggestions</h2> <br />
<div>
	</h2><h2><b>Suggestion 1 :</h2> 
	<?php 
		if ($GLOBALS['FV'] == " 0") {
			 echo $heroArray[$GLOBALS['Suggestion1']];
		}
	 ?> 
	</b><br/>
	</h2><h2><b>Suggestion 2 :</h2>

	<?php 
		if ($GLOBALS['FV'] == " 0") {
			 echo $heroArray[$GLOBALS['Suggestion2']];
		}
	 ?>  </b><br/>
	</h2><h2><b>Suggestion 3 :</h2>
	<?php 
		if ($GLOBALS['FV'] == " 0") {
			 echo $heroArray[$GLOBALS['Suggestion3']];
		}
	 ?> 
	 </b><br/>
</div>
<?php
if (isset($_POST['reset']))
 {
     echo '<META HTTP-EQUIV="Refresh" Content="0; ">';
 }
?>
</body>
</html>



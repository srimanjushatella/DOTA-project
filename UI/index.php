<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DOTA Analysis</title>
</head>
<?php
$GLOBALS['RH1']=" ";
$GLOBALS['RH2']=" ";
$GLOBALS['RH3']=" ";
$GLOBALS['RH4']=" ";
$GLOBALS['RH5']=" ";
$GLOBALS['DH1']=" ";
$GLOBALS['DH2']=" ";
$GLOBALS['DH3']=" ";
$GLOBALS['DH4']=" ";
$GLOBALS['DH5']=" ";
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
		$heroArray = array(  "Anti-Mage", "Axe", "Bane", "Bloodseeker", "Crystal Maiden", "Drow Ranger", "Earthshaker", "Juggernaut", "Mirana",
		 "Shadow Fiend", "Morphling", "Phantom Lancer", "Puck", "Pudge", "Razor", "Sand King", "Storm Spirit", "Sven", "Tiny", "Vengeful Spirit",
		  "Windranger", "Zeus", "Kunkka", "Lina", "Lich", "Lion", "Shadow Shaman", "Slardar", "Tidehunter", "Witch Doctor", "Riki", "Enigma",
		   "Tinker", "Sniper", "Necrophos", "Warlock", "Beastmaster", "Queen of Pain", "Venomancer", "Faceless Void", "Skeleton King", 
		   "Death Prophet", "Phantom Assassin", "Pugna", "Templar Assassin", "Viper", "Luna", "Dragon Knight", "Dazzle", "Clockwerk",
		    "Leshrac", "Nature's Prophet", "Lifestealer", "Dark Seer", "Clinkz", "Omniknight", "Enchantress", "Huskar", "Night Stalker", 
		    "Broodmother", "Bounty Hunter", "Weaver", "Jakiro", "Batrider", "Chen", "Spectre", "Doom", "Ancient Apparition", "Ursa", 
		    "Spirit Breaker", "Gyrocopter", "Alchemist", "Invoker", "Silencer", "Outworld Devourer", "Lycanthrope", "Brewmaster", 
		    "Shadow Demon", "Lone Druid", "Chaos Knight", "Meepo", "Treant Protector", "Ogre Magi", "Undying", "Rubick", "Disruptor", 
		    "Nyx Assassin", "Naga Siren", "Keeper of the Light", "Wisp", "Visage", "Slark", "Medusa", "Troll Warlord", "Centaur Warrunner", 
		    "Magnus", "Timbersaw", "Bristleback", "Tusk", "Skywrath Mage", "Abaddon", "Elder Titan", "Legion Commander", "Ember Spirit", 
		    "Earth Spirit", "Abyssal Underlord", "Terrorblade", "Phoenix", "Techies", "Oracle", "Winter Wyvern", "Arc Warden"); ?>
<body>
	<h1>Dota Analysis</h1> <br />
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

//echo $emai;
if (isset($_POST['post']))
 {
     $GLOBALS['RH1']=$_POST['RHero1'];
     $GLOBALS['RH2']=$_POST['RHero2'];
     $GLOBALS['DH1']=$_POST['DHero1'];
     $GLOBALS['DH2']=$_POST['DHero2']; 
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "0";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";

// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'';
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

<button type="submit" name="RH3" <?php if ( $GLOBALS['formRH3'] == '1'){ ?> disabled <?php   } ?> >Submit</button>

</form>

<?php

//Radiant Hero 3
if (isset($_POST['RH3']))
 {
     $GLOBALS['RH3']=$_POST['RHero3'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "0";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";


 
// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'';
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

<h4>Select Dire Hero 3</h4>
<!-- Dire Hero 3 -->
<form action="index.php"  method="post" enctype="multipart/form-data">

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
     $GLOBALS['DH3']=$_POST['DHero3'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "0";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";

// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'';
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

<button type="submit" name="RH4" <?php if ( $GLOBALS['formRH4'] == '1'){ ?> disabled <?php   } ?> >Submit</button>

</form>

<?php

//Radiant Hero 4
if (isset($_POST['RH4']))
 {
     $GLOBALS['RH4']=$_POST['RHero4'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "0";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";


// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'&my='.$GLOBALS['RH4'].'';
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

<h4>Select Dire Hero 4</h4>
<!-- Dire Hero 4 -->
<form action="index.php"  method="post" enctype="multipart/form-data">



Dire hero 4
	<select name='DHero4'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

<button type="submit" name="DH4" <?php if ( $GLOBALS['formDH4'] == '1'){ ?> disabled <?php   } ?> >Submit</button>

</form>

<?php

//Dire Hero 4
if (isset($_POST['DH4']))
 {
     $GLOBALS['DH4']=$_POST['DHero4'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "0";


// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'&my='.$GLOBALS['RH4'].'&opponent='.$GLOBALS['DH4'].'';
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

<h4>Select Dire Hero 5</h4>
<!-- Hero 5 
Dire Hero 5-->
<form action="index.php"  method="post" enctype="multipart/form-data">
Dire hero 5
	<select name='DHero5'>

		<option selected="selected">Choose one</option>
	<?php
	foreach ($heroArray as $hero) {	?>
   <option value="<?= $hero ?>"><?= $hero ?></option>

	<?php } ?>
</select> 

<button type="submit" name="DH5" <?php if ( $GLOBALS['formDH5'] == '1'){ ?> disabled <?php   } ?>>Submit</button>

</form>

<?php

//Dire Hero 5
if (isset($_POST['DH5']))
 {
     $GLOBALS['DH5']=$_POST['DHero5'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "0";
 
// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'&my='.$GLOBALS['RH4'].'&opponent='.$GLOBALS['DH4'].'
				&opponent='.$GLOBALS['DH5'].'';
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
<button type="submit" name="RH5" <?php if ( $GLOBALS['formRH5'] == '1'){ ?> disabled <?php   } ?>>Submit</button>
</form>

<?php

//Radiant Hero 5;
if (isset($_POST['RH5']))
 {
     $GLOBALS['RH5']=$_POST['RHero5'];
     $GLOBALS['formVar1'] = "1";
     $GLOBALS['formRH3'] = "1";
	 $GLOBALS['formDH3'] = "1";
	 $GLOBALS['formRH4'] = "1";
	 $GLOBALS['formDH4'] = "1";
	 $GLOBALS['formRH5'] = "1";
	 $GLOBALS['formDH5'] = "1";

// PHP code for suggestion
$service_url = 'http://192.168.0.9:8080/Dota/rest/process/list?my='.$GLOBALS['RH1'].'&opponent='.$GLOBALS['DH1'].'&my='.$GLOBALS['RH2'].'
				&opponent='.$GLOBALS['DH2'].'&my='.$GLOBALS['RH3'].'&opponent='.$GLOBALS['DH3'].'&my='.$GLOBALS['RH4'].'&opponent='.$GLOBALS['DH4'].'
				&opponent='.$GLOBALS['DH5'].'&my='.$GLOBALS['RH5'].'';
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

<br /><h2>Hero Suggestions</h2> <br />
<div>
	</h2><h2><b>Suggestion 1 :</h2> <?php echo $GLOBALS['Suggestion1']; ?> </b><br/>
	</h2><h2><b>Suggestion 2 :</h2> <?php echo $GLOBALS['Suggestion2']; ?> </b><br/>
	</h2><h2><b>Suggestion 3 :</h2> <?php echo $GLOBALS['Suggestion3']; ?> </b><br/>
</div>
<?php
if (isset($_POST['reset']))
 {
     echo '<META HTTP-EQUIV="Refresh" Content="0; ">';
 }
?>
</body>
</html>



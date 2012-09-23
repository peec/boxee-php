<?php
/**
 * This software is written for Boxee to integrate cool applications with boxee.
 * @author Petter Kjelkenes <kjelkenes@gmail.com>
 */
namespace com\boxee;
use \com\boxee\service\Files;
include 'bootstrap.php';

// Create a new boxee. ( change settings for host and device id )
// 'test_identity' is the device id unique for your app. eg. mac address etc.
$boxee = new \com\boxee\Boxee('10.0.0.2', 'aqweukpppkpkpkeid');



// Allways use try / catch for methods. 
// If not you will not get error messages as you should and will experiance hangs.
try{

// 2. Turn on your boxee.


// 3. First uncomment this.
# print_r($boxee->device()->PairChallenge('Dev test', 'APP_ID_UNIQUE_PER_APPLICATION')); 



// 4. Comment the above again.
// 5. Uncomment this and change the code to what you got on popup of boxee. 
# print_r($boxee->device()->PairResponse(4179)); // The code from boxeebox!

	
// 6. Now comment the above,

		
	// $shares = $boxee->files()->GetSources(Files::T_VIDEO);

	// print_r($shares);
	
	$boxee->player()->SeekTime("500");
	
/*
	$films = $boxee->files()->GetDirectory(Files::T_VIDEO, $shares->result->shares[0]->file.'Pal/Filmer/College');
	
	print_r($films);
	foreach($films->result->files as $film){
		echo "<br/><strong>{$film->label}</strong>: {$film->file}";	
	}
	
	
	$boxee->xbmc()->Play('smb://KJNAS/Filmer/Pal/Filmer/Komedie/Lesbian.Vampire.Killers.2009.DvDRip-FxM/Lesbian.Vampire.Killers.2009.DvDRip-FxM.avi');
	
	// print_r($boxee->xbmc()->GetVolume());
	
	
	// print_r($boxee->player()->State());
	
	// $boxee->player()->Stop();

*/


	

}catch(\Exception $e){
	echo "ERROR: ". $e->getMessage();
}
	
die("<br>End of tests.");
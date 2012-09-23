## BoxeeBox?, what is it?

BoxeeBox? is a small device that can show images, videos (also in HD), pictures, music spotify etc. Its a great little device, read more on The official homepage


## What is boxee-php?

Boxee PHP library for php 5.3+, Object oriented best practices library, fully functional and all features implemented.

I decided to create a new BoxeeBox? JSON RPC API from scratch, it contains best practices and are easy to use.

This library is more then just a wrapper around the JSON RPC API itself, it has smart features such as type automatic type conversion and such.




## What can i build?

If you are a PHP developer you can build awesome remotes and complete systems for interact with the BoxeeBox?.

### Examples:

- A simple HTML5 remote that is accessible to your mobile phones.
- Advanced remotes that incorprates imdb libraries and such.
- Your imagination is only the limit. 

## Links

- http://www.boxee.tv/
- http://developer.boxee.tv/JSON_RPC 


## Applications using this API


- Contact kjelkenes@gmail.com to add your application to this list. 


## Why use this library?

- Typesafe
- Best practice dealing with sockets.
- Easily extendable.





# Example usage

Here are some examples of usage of boxee-php.

- Every method returns a boxee result object or throws exception on errors.



## One-time Pairing


Before any action is done, your application must be paired with the boxeebox itself. This is done with API methods, usually you store the device id in a database so you can access it later.

Note, it's only needed to store the "$deviceid" given to the Boxee constructor. So if you plan to only support one boxee in your application it's not even needed to store the deviceid, just set $deviceid to something constant that you use in your constructor.

### First step

	include 'bootstrap.php';

	$deviceid = 'My_unique_deviceid'; // This is used as a connection identifier after pairing is done.
	$host = '10.0.0.2';

	$boxee = new \com\boxee\Boxee($host, $deviceid);

	$result = $boxee->device()->PairChallenge('Dev test', 'APP_ID_UNIQUE_PER_APPLICATION');

	print_r($result);

### Last step

If a PairChallenge was successfully done you should be able to confirm the code that popped up on your boxee device.

	include 'bootstrap.php';

	$deviceid = 'My_unique_deviceid'; // This is used as a connection identifier after pairing is done.
	$host = '10.0.0.2';

	$boxee = new \com\boxee\Boxee($host, $deviceid);

	print_r($boxee->device()->PairResponse(4179)); // The code from boxeebox!



## Listing video shares

	$boxee->files()->GetSources(\com\boxee\service\Files::T_VIDEO);


## Dealing with music, video and audio player

To use one of the players you can use ->player() method.

`$boxee->player()` returns the currently active player or NULL if none is active.

- \com\boxee\service\AudioPlayer ( extends \com\boxee\service\Player )
- \com\boxee\service\VideoPlayer ( extends \com\boxee\service\Player )
- \com\boxee\service\PicturePlayer


### Example use-cases:



#### Active player

This example code will find the active player, if its audio playing / video playing it will play/pause it, if its a picture playing it will zoom in.

	if ($player = $boxee->player()){
		if ($player instanceof \com\boxee\service\Player){
			$player->PlayPause();
		}
		if ($player instanceof \com\boxee\service\PicturePlayer){
			$boxee->ZoomIn();
		}
	}





#### Starting a remote file

	$boxee->xbmc()->Play('smb://HOST/file/to/play/movie.avi');


Tip use the files() method to loop files and then it finds the path.




#### Raw requests ( javascript )

There are two ways to communicate with this library:

- Object oriented way ( $boxee->method()->Action() )
- Raw requests

Raw requests also incorporates method and action checking, this means that the request SomeNamespace.SomeAction will never be able to run.

This way is useful for javascript requests, where the action can be dynamically string generated of HTML.

Example of some string requests:

    print_r($boxee->raw('XBMC.Play', array('file' => 'smb://.....'));

    print_r($boxee->raw('XBMC.GetVolume');


    // Notice, value is required to be integer, but our library makes it to INT for you.
    print_r($boxee->raw('XBMC.SetVolume', array('value' => "100"));


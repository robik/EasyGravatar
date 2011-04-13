# EasyGravatar
__EasyGravatar__ is a simple PHP wrapper class for Gravatar that allows you to get user Avatar or Profile eaisly.


## Requirements

 - __PHP 5.3+__
 - SPL
 - `allow_url_fopen` enabled
 

## Installation
Depends what you want to do you have to download other file (there are two).

  - *src/Image.php* if you want to get user's avatar 
  - *src/Profile.php* if you want to get user's profile data.


If you know which file you want, put it into your `include_path` or `include` path.


## Avatar

### Basic Usage

Simplest way to get user's avatar requires only to call `Gravatar\Image::getImage()`.  
Here's some example code:

    # Include Image.php file
     include 'path/to/EasyGravatar/Image.php';
 
    # Creating Gravatar\Image object with specifing user's email
     $img = new Gravatar\Image('youremailhere@example.com');

    # Get plain image URL
     echo $img->getImage();

Code above will print URL to your avatar.

 > __TIP:__
 > *If you have only hashed user e-mail or want to hash it by your own, while creating object you can pass hashed mail instead of non-hashed, it will work.*


#### Changing result type
EasyGravatar allows you to get user's image and return in in few formats:

  * _Gravatar\\Image_::__Plain__ - Returns plain URL to avatar. [default]
  * _Gravatar\\Image_::__HTML__ - Returns HTML `<img>` tag with specified `src` attribute as Avatar URL and `alt` as `$alt` which is 'Avatar' by default.
  * _Gravatar\\Image_::__BB__ - Returns BB `[img]` tag with specified URL.
  * _Gravatar\\Image_::__Markdown__ - Returns image in Markdown syntax. _[Since 0.1.2]_


Example:

	$img->getImage( Gravatar\Image::HTML );

Will return:

	<img src="path" alt="$alt value" />


## Request parameters
 You can also get user's avatar with specified size, rating and others.

### Size
 Default size specified by EasyGravatar is `60`, so if you want to get image in this size you can avoid specifing size, but if you want to use other size you can specify avatar size using `Gravatar\Image::setSize($size);` method. Some simple example:
 
     $img->setSize(50);
     
But there are also defined simple size constants:

 - _Gravatar\\Image_::__SizeSmall__ - 30x30px
 - _Gravatar\\Image_::__SizeMedium__ - 70x70px
 - _Gravatar\\Image_::__SizeLarge__ - 120x120px
 
 
### Rating
 'Gravatar allows users to self-rate their images so that they can indicate if an image is appropriate for a certain audience.'. To change rating use `Gravatar\Image::setRating($rating);` method. By default rating is set to `g`.
 
	$img->setRating('pg');
	
Constants:

 - _Gravatar\\Image_::**RATING_G** - Suitable for display on all websites with any audience type.
 - _Gravatar\\Image_::**RATING_PG** - May contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
 - _Gravatar\\Image_::**RATING_R** - May contain such things as harsh profanity, intense violence, nudity, or hard drug use.
 - _Gravatar\\Image_::**RATING_X** - May contain hardcore sexual imagery or extremely disturbing violence.


### Default
 When avatar you want fet doesn't exists, default Gravatar image is showed. You can change default image to yours, or one of Gravatar's builded in. To change it use `Gravatar\Image::setDefault($default);`.
 
	$img->default('http://example.com/avatars/default.png');
	
Constants:

 - _Gravatar\\Image_::__MysteryMan__ - A simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
 - _Gravatar\\Image_::__Identicon__ - A geometric pattern based on an email hash
 - _Gravatar\\Image_::__Monster__ - A generated 'monster' with different colors, faces, etc
 - _Gravatar\\Image_::__Wavatar__ - Generated faces with differing features and backgrounds
 - _Gravatar\\Image_::__Retro__ - Awesome generated, 8-bit arcade-style pixelated faces
 
### Force default
 If you you want to make default image always loaded, forceDefault can be useful here. To use forceDefault use `Gravatar\Image::setForcedDefault($bool);`.
 
	$img->setForcedDefault(true);
	
### Secure
 If you want to display avatar from page that is served over SSL, this function can be useful. To use it, set secure to true by `Gravatar\Image::useSecure(true);`
 
	$img->useSecure(true);
	
- - -

### Chaining
 To make code cleaner and shorter EasyGravatar allows you to set parameters in chain. Here's some simple example:
 
	$img->setSize(50)
		->setForcedDefault(true)
		->setRating( Gravatar\Image::RATING_PG )
		->setSecure(true);



## Profile
 Easy gravatar provides simple support for profile requests too. (Yay! :D)

### Basics
 EasyGravatar user profile data gathering is based on getting element from response array with specifing path. Simplest way to get user's profile data you just need to:
 
 1. Include `path/to/EasyGravatar/Profile.php`
 2. Create `Gravatar\Profile` object
 3. Load user data using `Gravatar\Profile::loadProfile();`
 4. Get data that you are interested using `Gravatar\Profile::get($path);`
 
 
In PHP it's looking like that:

    # Step 1
     include 'path/to/EasyGravatar/Profile.php';
     	 
    # Step 2
     $profile = new Profile('usermail@example.com');
     	 
    # Step 3
     $profile->loadProfile();
     	 
    # Step 4
     echo $profile->getDisplayName();
	 

### Profile fields
 To get user's data you can use `Gravatar\Profile` getters. Here's list of them:

__Basic:__

 - ID - `Gravatar\Profile::getID();`      
 - Hash - `Gravatar\Profile::getHash();`
 - Requested Hash - `Gravatar\Profile::getRequestedHash();`
 - Profile URL - `Gravatar\Profile::getURL();`
 - Preferred Username - `Gravatar\Profile::getPreferredUsername();`
 - Thumbnail/Avatar URL - `Gravatar\Profile::getAvatar();`  
 - Display Name - `Gravatar\Profile::getDisplayName();`  
 
__User info:__

 - About - `Gravatar\Profile::getAboutInfo();`
 - Given name - `Gravatar\Profile::getGivenName();`
 - Family name - `Gravatar\Profile::getFamilyName();`
 - Formatted name - `Gravatar\Profile::getFormattedName();` 
 - Location - `Gravatar\Profile::getLocation();` 
 
__Background:__  
 - Color - `Gravatar\Profile::getBackgroundColor();` 
 - Position - `Gravatar\Profile::getBackgroundPosition();` 
 - Repeat - `Gravatar\Profile::getBackgroundRepeat();` 
 - URL - `Gravatar\Profile::getBackgroundURL();` 
 
__Array-Returns:__
 
 - Photos - `Gravatar\Profile::getPhotos();`
 - URLs - `Gravatar\Profile::getURLs();`
 - Accounts - `Gravatar\Profile::getAccounts();`
 - IMs - `Gravatar\Profile::getIMs();`
 - Mails - `Gravatar\Profile::getMails();`

 > __TIP:__
 > *If you don't want to use `Gravatar\Classname` all time, type `use Gravatar\classname;` on beggining of your script.*
 
  &nbsp;
 
 > __TIP:__
 > *If you want to print user name, use `Gravatar\Profile::getDisplayName()`.*
 
Array-return getters are returning array of items, for example `Gravatar\Profile::getPhotos()` will return __array__ of photos.



### Arrays build

#### Photos

Each photo array have some fields:


    {
	    value: [mixed],
	    [type: [mixed]]
    }
    

__value__ - URL to photo

__type__ - Contains "thumbnail" if photo is user's avatar *[oprional]*



#### Emails


	{
		value: [mixed],
		primary: [bool as string]
    }
    

__value__ - E-Mail adress

__primary__ - Is that email-primary?. Bool represented as string. Instead of true/false there is "true"/"false". So using `if` statement will always return **true**.

    
    
    
#### URLs

    {
		value: [mixed],
		title: [mixed]
    }
    

__value__ - URL

__title__ - URL name



#### IMs


    {
		type: [mixed]
		value: [mixed]
    }


__type__ - IM type

__value__ - User's IM id



#### Accounts

    {
		domain: [mixed],
		display: [mixed],
		url: [mixed]
		username\userid: [mixed/int],
		verified: [bool as string],
		shortname: [mixed]		
    }
    

__domain__ - Contains domain only

__display__ - Accound display, for example: for twitter it could be @name

__url__ - URL to you accound on the website

__username__/__userid__ - User name or id

__verified__ - Is user verified 

__shortname__ - provider short name

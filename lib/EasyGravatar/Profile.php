<?php
/**
 *      Gravatar Profile
 *
 *      This program is free software; you can redistribute it and/or modify
 *      it under the terms of the GNU General Public License as published by
 *      the Free Software Foundation; either version 2 of the License, or
 *      (at your option) any later version.
 *
 *      This program is distributed in the hope that it will be useful,
 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *      GNU General Public License for more details.
 *
 *      You should have received a copy of the GNU General Public License
 *      along with this program; if not, write to the Free Software
 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 *      MA 02110-1301, USA.
 *
 *      @author Robik <szadows@gmail.com>
 *      @name Gravatar
 *      @license See LICENSE file included to package
 */

namespace Gravatar;

class Profile
{ 

    /**
     * Contains mail hash
     *
     * @var <mixed> Mail hash
     */
    protected $hash;

    /**
     * Contains user profile data
     *
     * @var <mixed[]> User profile data
     */
    protected $data;



    public function __construct($hashOrMail)
     {
        # If mail is already hashed
        if(strpos($hashOrMail, '@') === false)
            $this->hash = $hashOrMail;
        else
            $this->hash = md5(strtolower( trim($hashOrMail) ));
     }

     /**
      * Gets array element by path
      *
      * @param <mixed> Path
      *
      * @return <mixed[]>
      */
     public function get($path)
     {
         $elems = explode('/', $path);
         $temp = $this->data;

         foreach($elems as $elem)
         {
             if(!empty($elem))
                $temp = $temp[$elem];
         }

         return $temp;
     }

     /**
      * Loads user profile data
      *
      * @return <Gravatar\Profile>
      */
     public function loadProfile()
     {
         $url = 'http://www.gravatar.com/' . $this->hash.'.php';
         
         $res = unserialize(file_get_contents($url));

         $this->data = $res['entry'][0]; 

         return $this;
     }


     /**
      * Gets user's ID
      *
      * @return <int> User's ID
      */
     public function getID()
     {
         return $this->get('id');
     }

    /**
     * Gets user's e-mail hash
     *
     * @return <mixed> User e-mail hash
     */
    public function getHash()
    {
        return $this->get('hash');
    }

    /**
     * Gets requested hash
     *
     * @return <mixed> Requested hash
     */
    public function getRequestedHash()
    {
        return $this->get('requestedHash');
    }

    /**
     * Gets user's profile URL
     *
     * @return <mixed> User's profile URL
     */
    public function getProfileURL()
    {
        return $this->get('profileUrl');
    }

    /**
     * Gets user's preferred username
     *
     * @return <mixed> Preferred username
     */
    public function getPreferredUsername()
    {
        return $this->get('preferredUsername');
    }

    /**
     * Gets user's thumbail URL
     *
     * @return <mixed> User's avatar url
     */
    public function getAvatar()
    {
        return $this->get('thumbnailUrl');
    }

    /**
     * Gets user's photos
     *
     * @return <mixed[]> User photos
     */
    public function getPhotos()
    {
        return $this->get('photos');
    }

    /**
     * Gets user's display name
     *
     * @return <mixed> User's display name
     */
    public function getDisplayName()
    {
        return $this->get('displayName');
    }

    /**
     * Gets user's URLs
     *
     * @return <mixed[]> User URLs
     */
    public function getURLs()
    {
        return $this->get('urls');
    }


    /**
     * Gets user's about info
     *
     * @return <mixed> User's about info
     */
    public function getAboutInfo()
    {
        return $this->get('about');
    }

    /**
     * Gets user's given name
     *
     * @return <mixed> User's given name
     */
    public function getGivenName()
    {
        return $this->get('name\givenName');
    }

    /**
     * Gets user's family name
     *
     * @return <mixed> User's family name
     */
    public function getFamilyName()
    {
        return $this->get('name\familyName');
    }

    /**
     * Gets user's formatted name
     *
     * @return <mixed> User's formatted name
     */
    public function getFormattedName()
    {
        return $this->get('name\formatted');
    }

    /**
     * User's instant messagers accounts
     *
     * @return <mixed[]> User's instant messagers accounts
     */
    public function getIMs()
    {
        return $this->get('ims');
    }

    /**
     * Gets user's e-mails
     *
     * @return <mixed[]> User's emails
     */
    public function getMails()
    {
        return $this->get('emails');
    }

    /**
     * Gets user's current location
     *
     * @return <mixed> User's current location
     */
    public function getLocation()
    {
        return $this->get('currentLocation');
    }

    /**
     * Gets user's accounts
     *
     * @return <mixed[]> User's accounts
     */
    public function getAccounts()
    {
        return $this->get('accounts');
    }

    

    /**
     * Gets user's background color
     *
     * @return <mixed>
     */
    public function getBackgroundColor()
    {       
         return $this->get('profileBackground\color');
    }  
    
    /**
     * Gets user's background position
     *
     * @return <mixed>
     */
    public function getBackgroundPosition()
    {       
         return $this->get('profileBackground\position');
    }

    /**
     * Gets user's background repeat
     *
     * @return <mixed>
     */
    public function getBackgroundRepeat()
    {
         return $this->get('profileBackground\repeat');
    }

    /**
     * Gets user's background URL
     *
     * @return <mixed>
     */
    public function getBackgroundURL()
    {
         return $this->get('profileBackground\URL');
    }  

}

?>

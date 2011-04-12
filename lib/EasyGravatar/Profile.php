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
     * User's ID
     */
    const ID = 'id';

    /**
     * User's e-mail hash
     */
    const Hash = 'hash';

    /**
     * Requested hash
     */
    const RequestedHash = 'requestedHash';

    /**
     * User's profile URL
     */
    const URL = 'profileUrl';

    /**
     * User preferred Username
     */
    const Username = 'preferredUsername';

    /**
     * User's thumbail URL
     */
    const Avatar = 'thumbnailUrl';

    /**
     * User's phots
     */
    const Photos = 'photos';

    /**
     * User's display name
     */
    const DisplayName = 'displayName';

    /**
     * User's URLs
     */
    const URLs = 'urls';


    /**
     * User's about
     */
    const About = 'about';

    /**
     * User's given name
     */
    const GivenName = 'name\givenName';

    /**
     * User's family name
     */
    const FamilyName = 'name\familyName';

    /**
     * User's formatted name
     */
    const FormattedName = 'name\formatted';

    /**
     * User's Instant messagers accounts
     */
    const IMs = 'ims';

    /**
     * User's e-mails
     */
    const Mails = 'emails';

    /**
     * User's current location
     */
    const Location = 'currentLocation';

    /**
     * User's accounts
     */
    const Accounts = 'accounts';


    

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
}

?>

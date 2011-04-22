<?php
/**
 *      Gravatar Image
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

namespace EasyGravatar;

 class Image
 {
     /**
      * Suitable for display on all websites with any audience type.
      */
     const RATING_G = 'g';

     /**
      * May contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
      */
     const RATING_PG = 'pg';

     /**
      * May contain such things as harsh profanity, intense violence, nudity, or hard drug use.
      */
     const RATING_R = 'r';

     /**
      * May contain hardcore sexual imagery or extremely disturbing violence.
      */
     const RATING_X = 'x';


     /**
      * A simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
      */
     const MysteryMan = 'mm';

     /**
      * A geometric pattern based on an email hash
      */
     const Identicon = 'identicon';

     /**
      * A generated 'monster' with different colors, faces, etc
      */
     const Monster = 'monsterid';

     /**
      * Generated faces with differing features and backgrounds
      */
     const Wavatar = 'wavatar';

     /**
      * Awesome generated, 8-bit arcade-style pixelated faces
      */
     const Retro = 'retro';



     /**
      * Returns image URL
      */
     const Plain = 'plain';

     /**
      * Returns image as HTML's IMG tag
      */
     const HTML = 'html';

     /**
      * Returns image as BBCode IMG tag
      */
     const BB = 'bb';

     /**
      * Returns image in Markdown syntax
      */
     const Markdown = 'markdown';


     /**
      * Defines small avatar size
      */
     const SizeSmall = 30;

     /**
      * Defines medium avatar size
      */
     const SizeMedium = 70;

     /**
      * Defines large avatar size
      */
     const SizeLarge = 120;



     /**
      * Contains mail
      *
      * @var <mixed>
      */
     protected $hash;

     /**
      * Image size
      *
      * @var <int>
      */
     protected $size = 80;

     /**
      * Contains default image (occurs when image don't exists)
      *
      * @var <mixed> Path/Build-in
      */
     protected $default = 'identicon';

     /**
      * Image generated even with not exists?
      *
      * @var <bool>
      */
     protected $forceDefault = false;

     /**
      * Image rating
      *
      * @var <mixed>
      */
     protected $rating = 'g';

     /**
      * Contains secure use
      *
      * @var <bool> Secure use
      */
     protected $secure;



     public function __construct($hashOrMail)
     {
        # If mail is already hashed
        if(strpos($hashOrMail, '@') === false)
            $this->hash = $hashOrMail;
        else
            $this->hash = md5(strtolower( trim($hashOrMail) ));
     }


     /**
      * Sets gravatar size
      *
      * @param <int> Size
      *
      * @return <EasyGravatar\Image>
      */
     public function setSize($size)
     {
         $this->size = (int)$size;

         return $this;
     }


     /**
      * Sets max rating
      *
      * @param <mixed> Rating
      *
      * @return <EasyGravatar\Image>
      */
     public function setRating($rating)
     {
         $this->rating = $rating;

         return $this;
     }


     /**
      * Sets default image
      *
      * @param <mixed> Path to default image/default
      *
      * @return <EasyGravatar\Image>
      */
     public function setDefault($default)
     {
         $this->default = $default;
         return $this;
     }

     
     /**
      * Sets forcedDefautt use
      *
      * @param <bool> Use
      *
      * @return <EasyGravatar\Image>
      */
     public function setForcedDefault($bool)
     {
         $this->forcedDefault = ($bool ? 'y' : '');
         return $this;
     }


     /**
      * Use secure use
      *
      * @param <bool> Use
      *
      * @return <EasyGravatar\Image>
      */
     public function useSecure($bool)
     {
         $this->secure = $bool;
         return $this;
     }


     /**
      * Gets user image
      *
      * @param <mixed> Return Content type
      * @param <mixed> Image alt (used only in HTML content)
      *
      * @return <mixed>
      */
     public function getImage($type = 'plain', $alt = 'Avatar')
     {
         if($this->secure != NULL)
            $url = 'https://secure.gravatar.com/avatar/'.$this->hash;
         else
            $url = 'http://www.gravatar.com/avatar/'.$this->hash;

         $params = array();
		 
         $params['size'] = $this->size;

         if($this->default != NULL)
		    $params['default'] = $this->default;
         
         $params['rating'] = $this->rating;

         if($this->forceDefault != NULL)
            $params['forcedefault'] = 'y';
			
		 $url .= '?' . http_build_query($params);

         if($type == 'plain')
             return $url;
         if($type == 'html')
             return '<img src="' . $url . '" alt="'.$alt.'" />';
         if($type == 'bb')
             return '[img]' . $url . '[/img]';
         if($type == 'markdown')
             return '![' . $alt . '](' . $url . ')';

     }
 }

?>


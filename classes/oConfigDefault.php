<?php
//
//		Copyright (c) 2007 Stéphane Urbanovski
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// $Id: oConfigDefault.php 17 2017-04-14 08:28:24Z jtoussaint6 $

/** 
* @class oConfigDefault 
* This class hold configuration datas 
*/
class oConfigDefault {
	static protected $configs = 	array(
		'debuglevel'		=> 0,
		'itemPerPage'		=> 40,
	);
	
	static protected $isSet = false;
	
	static function get($c) {
	
		if ( !self::$isSet ) {
			oConfig::init();
		}
	
		if ( isset(oConfig::$configs[$c]) ) {
			return self::$configs[$c];
			
		} else if ( isset(oConfigDefault::$configs[$c]) ) {
			return self::$configs[$c];
			
		} else {
			//TODO: Ring some bells here
		}
	}
}

?>

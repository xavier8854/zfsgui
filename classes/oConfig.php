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
// $Id: oConfig.php 53 2017-04-26 12:16:52Z jtoussaint6 $

/** 
* @class oConfig 
* This class hold configuration datas 
*/
class oConfig extends oConfigDefault {
	
	public function init() {
		
		/* defaults */
				
		/* version management */
		self::$configs['VERSION'] = '0.9a1';
		$vFile = getcwd() . '/VERSION';
		if (file_exists($vFile)) {
			$aTmp = file($vFile);
			if (isset($aTmp[0]) && strlen($aTmp[0]) > 0 && preg_match('/^.+\s+([0-9]+).*$/', $aTmp[0], $m) === 1) {
				self::$configs['VERSION'] = '3.' . $m[1];
			}
		}
		
		/* refresh timer */
		self::$configs['refresh_timer'] = 120;
		
		/* ack management */
		self::$configs['dont_show_srv_ack'] = true;
		
		/* config file management */
		$config = array(); /* used in configfile */
		$users = array(); /* used in configfile */
		
		if (is_readable(CONFIGFILE)) {
			include_once(CONFIGFILE); /* set $config & $users */
			
			/* conf */
			foreach ($config as $ck => $cv) {
				self::$configs[$ck] = $cv;
			}
			
			/* users */
			foreach ($users as $uk => $uv) {
				self::$configs['users'][$uk] = $uv;
			}
			
		}
		else {
			error_log('zfsgui: cannot read configfile');
		}
		
		
		self::$isSet = true;
	}
	
	
}

?>

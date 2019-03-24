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
// $Id: oBaseClass.php 17 2017-04-14 08:28:24Z jtoussaint6 $

/**
* @class oBaseClass
*/
class oBaseClass {

	protected $oLogger;
	protected $cn;
	
	public function __construct (&$param = FALSE) {
		$this->cn = get_class($this);
		$this->oLogger = oLogger::getLogger();
		$this->init($param);
	}
	
	/**
	* Gruick test ...
	*/
	public static function getStatic($cn,$var) {
		return self::$staticContainer[$cn][$var];
	}
	
	
	/**
	* Log a message
	* @param $msg log message
	* @param $level log level
	*/
	protected final function log ($msg, $level) {
		$this->oLogger->log($msg,$level,$this->cn);
	}
	protected final function logE ($msg) {
		$this->log($msg,0);
	}
	protected final function logW ($msg) {
		$this->log($msg,10);
	}
	protected final function logI ($msg) {
		$this->log($msg,20);
	}
	protected final function logN ($msg) {
		$this->log($msg,30);
	}
	protected final function log0 ($msg) {
		$this->log($msg,40);
	}
	protected final function log1 ($msg) {
		$this->log($msg,50);
	}
	protected final function log2 ($msg) {
		$this->log($msg,60);
	}

}
?>
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
// $Id: oLogger.php 17 2017-04-14 08:28:24Z jtoussaint6 $

/**
* @class oLogger
*/
class oLogger {

	// reference to the current oLogger :
	protected static $oLogger = NULL;

	// logs store
	protected static $logs = array();				/**< @var string  */
	
	protected $maxlog = 100;
	protected $debuglevel = 90;
	

	/**
	* Return the current oLogger object
	*/
	public static function &getLogger() {
		if (oLogger::$oLogger == NULL) {
			oLogger::$oLogger = new oLogger();
		}
		return oLogger::$oLogger;
	}

// 	protected function __construct () {
// 	
// 	}

	/**
	* Log a message
	* @param $msg log message
	* @param $level log level
	*/
	public final function log ($msg, $level, $className = 'unknownClass') {
		if ( $level > $this->debuglevel ) return;

		$t = array($className,$level,$msg);
		if ( $level < 10 ) {
			trigger_error ($level." ".$msg,E_USER_WARNING);
		}
		self::$logs[] = $t;
		if ( $this->debuglevel == 100 ) {
			// savage dump
			echo "<pre>".$level." ".$msg."</pre>\n";
		}
		
		// remember the highest level of information
		$this->maxlog = ($level < $this->maxlog) ? $level : $this->maxlog;
	}
	
	public final function log0 ($msg) {
		$this->log($msg,40);
	}
	public final function log1 ($msg) {
		$this->log($msg,50);
	}
	public final function log2 ($msg) {
		$this->log($msg,60);
	}
	
	/**
	* Return an html log
	* @param $level debug level to print
	* @return a piece of html
	*/
	public function &getHtmlLogs () {
		$html = '';
		foreach ( self::$logs as $l ) {
			$html .= ' <p><span class="head">'.$l[0]."</span> : ";
			if ($l[1] < 10) {
				$class = "error";
			} elseif ($l[1] < 20) {
				$class = "warn";
			} elseif ($l[1]  < 30) {
				$class = "info";
			} elseif ($l[1]  < 40) {
				$class = '';
			} else {
				$class = "debug";
			}
			$html .= "<span ".(($class != '') ? 'class="'.$class.'"':'').">".$l[2]."</span></p>\n";
				
		}
		return $html;
	}
	
	/**
	* Return a text log
	* @param $level debug level to print
	* @return a piece of plain text
	*/
	public function &getTxtLogs () {
		$txt='';
		foreach ( self::$logs as $l ) {
			
			if ($l[1] < 10) {
				$class = '****';
			} elseif ($l[1] < 20) {
				$class = '***.';
			} elseif ($l[1]  < 30) {
				$class = '**..';
			} elseif ($l[1]  < 40) {
				$class = '*...';
			} else {
				$class = '....';
			}
			$txt .= $class."  ".$l[0] .":".$l[2]."\n";
		}
		return $txt;
	}
}
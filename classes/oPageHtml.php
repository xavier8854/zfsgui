<?php
//
//		Copyright (c) 2007-2015 Stéphane Urbanovski
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


/** 
* @class oPageHtml
*/
class oPageHtml extends oHtmlContent {
	
	protected $appId = FALSE;	
	const hideStatTxt = 'Coucou !';


	protected function init (&$param) {
		$this->log1(__FUNCTION__.'()');
		
		$this->addHeader("<meta http-equiv=\"pragma\" content=\"no-cache\" />");
		
		return TRUE;
	}
		
	public function show() {
		print "<div id=\"refreshTimerWrapper\">\n";
		
		print " <div id=\"reloadButton\" class=\"animate\" title=\"Mettre en pause le rechargement de la page\"></div>\n";
		print " <div id=\"ttl\" class=\"animate\"></div>\n";
		print "</div>\n";
		
		print "<div id=\"righttab\">\n";
		
		print ' <div class="date">'.ucfirst(strftime("%A %d ")).ucfirst(strftime("%B&nbsp;%Y")).'&nbsp;&nbsp;&nbsp;'.strftime("%H:%M:%S")."</div>\n";
		print "</div>\n";
		print " <div id=\"statusBoxId\">" . self::hideStatTxt . "</div>\n";

		print "<h1>This is a test</h1>";

		return TRUE;
	}
	
	/**
	* get time duration
	* @param $s - time (in s)
	* @return a string
	*/
	function getDuration ($s) {
		$m = floor($s / 60);
		if ($m > 0) {
			$s = $s % 60;
			$h = floor($m / 60);
			if ($h > 0) {
				$m = $m % 60;
				$d = floor($h / 24);
				$h = $h % 24;
				if ($d > 0) {
					return $d._("j&nbsp;").$h.'h';
				} else {
					return $h.'h&nbsp;'.$m.'min';
				}
			} else {
				return $m.'min&nbsp;'.$s.'s';
			}
		} else {
			return $s.'s';
		}
	}
}

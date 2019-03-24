<?php
//
//		Copyright (c) 2007-2008 Stéphane Urbanovski
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
// $Id: oPageError.php 17 2017-04-14 08:28:24Z jtoussaint6 $

/** 
* @class oPageError
*/
class oPageError extends oHtmlContent {
	
	protected $errorMessage ;

	protected function init (&$param) {
		$this->log1(__FUNCTION__.'()');
		if ( isset ($param['msg']) ) {
			$this->errorMessage = $param['msg'];
		} else {
			$this->errorMessage = _('Error message not defined');
		}
		return TRUE;
	}
	
	public function show() {
	
		print "<div id=\"logo\"> </div>\n";
		print "<div id=\"projectname\">".oProject::Name."</div>\n";
	
		print "<div class=\"pagecontent\">\n";
		print '<div class="errorpage">';
		print '<h1>'._("Fatal error:").'</h1>';
		print $this->errorMessage;
		print "</div>\n";
		print "</div>\n";
		
		return TRUE;
	}
	
}
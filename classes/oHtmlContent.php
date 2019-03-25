<?php
//
//		Copyright (c) 2005-2015 Stéphane Urbanovski
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
// $Id: oHtmlContent.php 53 2017-04-26 12:16:52Z jtoussaint6 $

/** 
* @class oHtmlContent
*/
class oHtmlContent extends oBaseClass {
	
	/* used in showHeader() */
	protected $additionalHeader = array();
	
	/**
	* Print http and html headers, also start body tag
	*/
	public function showHeader() {
		header('Content-type: text/html; charset=utf-8');
		print '<?xml version="1.0" encoding="UTF-8"?>'."\n";

		print "<!DOCTYPE html \n";
		print '	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"'."\n";
		print '	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n";
		print '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">'."\n";
		print "<head>\n";
		print " <title>" . oProject::Name . "</title>\n";
		print ' <link rel="stylesheet" type="text/css" href="css/default.css" />'."\n";
		print ' <link rel="icon" type="image/png" href="img/favicon.png" />'."\n";
		print ' <script src="lib/jquery/jquery-3.2.1.min.js"></script>'."\n";
		print implode("\n", $this->additionalHeader) . "\n";
		print "</head>\n";
		print "<!-- ========== End of Header ========== -->\n";
		print "<body class=\"body\">\n";
	}
	
	/**
	* Add an header to $additionalHeader
	*/
	public function addHeader($h) {
		if (is_string($h)) {
			$this->additionalHeader[] = $h;
		}
		else {
			$this->logE('parameter is not a string');
		}
	}
	
	/**
	* Send 401 requiring user to authenticate
	*/
	public function sendBasicAuth() {
		header('WWW-Authenticate: Basic realm="Authentification AMDH"');
		header('HTTP/1.0 401 Unauthorized');
		print 'Autorisation nécessaire pour accéder à cette ressource !';
	}
	
	/**
	* Print user feedbacks
	*/
	public function showProjectFooter($phpTime = FALSE, $sqlTime = FALSE) {
		$this->log1(__FUNCTION__.'()');
		
		print "\n<!-- ============ Footer =============== -->\n";
		print "<div id=\"footer\">\n";
		print "	<a href=\"https://www.amdh.fr\" target=\"_blank\">À propos de ZFS GUI</a>\n";
		
		/* more footer! */
		$footerExt = array();
		$footerExt[] = sprintf("v%s", oConfig::get('VERSION'));
		if ($phpTime) $footerExt[] = sprintf(_("PHP : %.2fms"), $phpTime);
		if ($sqlTime) $footerExt[] = sprintf(_("SQL : %.2fms"), $sqlTime);
		$footerExt[] = sprintf(_("Mem : %.2f ko"), memory_get_usage(TRUE) / 1000);
		if (sizeof($footerExt) > 0) print "	<span class=\"morefooter\">" . implode(', ', $footerExt) . "</span>\n";
		
		
		print "</div>\n";
		print "<!-- ========== End of Footer ========== -->\n";
	}
	
	/**
	* Print user feedbacks
	*/
	public function showFeedback() {
		if ( $this->feedback ) {
			print "\n<!-- ============ Feedback =============== -->\n";
			print "<div class=\"feedback\">\n";
			print $this->feedback."\n";
			print "</div>\n";
			print "<!-- ========== End of Feedback ========== -->\n";
		}
	}
	
	/**
	* Print html footer, also close body and html tag
	*/
	public function showDebug() {
	
		if ( oConfig::get('debuglevel') > 10 ) {
			print "<div class=\"debug\">LEVEL = ".oConfig::get('debuglevel')."\n";
			print "<pre>\$_REQUEST=".print_r($_REQUEST, TRUE)."</pre>\n";
			//print "<pre>\$_SERVER=".print_r($_SERVER, TRUE)."</pre>\n";
			//print "<pre>\$_SESSION=".print_r($_SESSION, TRUE)."</pre>\n";
			print "<hr />\n";
			print $this->oLogger->getHtmlLogs();
			print "</div>\n";
		}
	}
	
	/**
	* Print html footer, also close body and html tag
	*/
	public function showHtmlFooter() {
		
		print "</body>\n";
		print "</html>\n";
	}
}

?>

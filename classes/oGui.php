<?php
/**
 * oGui.php
 * 
 * Copyright 2019 Xavier Humbert <xavier@amdh.fr>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

/// Class GUI
/// The main class for this application

class oGui {
	protected $oDb;
	protected $oLogger;
	
	protected $oPage;
	protected $startTime;
	protected $feedback = FALSE;
	
	protected $requireLogin = FALSE;
	
	const Name = 'ZFS Gui';

	public function __construct () {
	
		$this->oLogger = oLogger::getLogger();
	
		$this->oLogger->log1(__FUNCTION__.'()');
		$this->oPage = new oPageHtml();
		// Start execution timer :
		$this->startTime = microtime(true);
	}

	public function handleRequest () {
		$this->oLogger->log1(__FUNCTION__.'()');
		$this->oPage->showHeader();
		
		$this->oPage->show();
		
// 		$this->oDb->close();
		$phpTime = 1000 * (microtime(true)-$this->startTime);
// 		$sqlTime = 1000 * $this->oDb->totalExecTime;
		
		$this->oPage->showProjectFooter($phpTime,0);
		
		$this->oPage->showDebug();
		$this->oPage->showHtmlFooter();
	}
}
?>

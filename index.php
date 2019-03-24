<?php
/*
 * index.php
 * 
 * Copyright 2019 Xavier Humbert <xavier@feanor>
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
// Security check :
if (@ini_get('register_globals')) {
	die ('FATAL SECURITY ERROR: register_globals is on!');
}


define('PROJECT_NAME', 'zfsgui'); /* PROJECT_NAME => used to MVC */
//~ define('CONFIGFILE', '/etc/acamap3/config.php'); /* CONFIGFILE => path to configfile */


// Use PHP5 __autoload() nice feature (automatically load required classes):
function __autoload($class_name) {
	if (file_exists(PROJECT_NAME."/$class_name.php")) {
		require_once(PROJECT_NAME."/$class_name.php");
	} else if (file_exists("classes/$class_name.php")) {
		require_once("classes/$class_name.php");
	} else {
		die("Class $class_name not found!");
	}
}

date_default_timezone_set('Europe/Paris');
//~ setlocale(LC_ALL,'fr_FR.UTF8');

// ob_start();

$oGui = new oGui();

print $oGui->handleRequest();

// ob_end_flush();

?>

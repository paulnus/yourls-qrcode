<?php
/*
#*************************************************************************************
Plugin Name: QR Codes
Plugin URI: http://www.paulnus.com/qrcodes_plugin/
Description: This plugin integrates QR codes into YOURLS
Version: 0.1.0
Author: Paul Nus
Author URI: http://paulnus.com
#Date      : 05-27-2010
#Email     : paul@thenusfamily.com
#(c) 2010+ Paul Nus
#*************************************************************************************
Plugin for YOURLS(Your Own URL Shortener) (www.yourls.org)
w/ PHPQRCODE integration -> Copyright (C) 2010 by Dominik Dzienia 
#*************************************************************************************

This program is free software and licensed under the terms of
the GNU General Public License (GPL), version 2.

http://www.gnu.org/copyleft/gpl.html

#*************************************************************************************
Plugin Download Locations
#*************************************************************************************
http://www.pauln.us/yqrp - Direct Link

#*************************************************************************************
Changelog
#*************************************************************************************
v0.1.0         : Initial Beta Release - 05-27-2010 

#*************************************************************************************
Future Enchancements
#*************************************************************************************
1. Integration into admin console
2. Integration into info page
#*************************************************************************************
    
#*************************************************************************************
Requirments:
#*************************************************************************************
- YOURLS version 1.5+ (plugin support)
- PHPQRCODE version 1.1.2 (included per GNU Lesser General Public License)
#*************************************************************************************
Installation:
#*************************************************************************************
1. Unzip the contents of this package into your /user/plugins/ folder

2. Activate plugin in the admin console

3. Ensure you have a mod rewrite condition for ".qr" URL's in your .htaccess file
	Example: RewriteRule ^([0-9A-Za-z]+).qr/?$ /yourls-go.php?qr=1&id=$1 [L]
*/

// Include the phpqrcode library
include "./user/plugins/qrcode/phpqrcode/qrlib.php";
// Now hook into the redirect and check if its QR
yourls_add_action( 'pre_redirect', 'check_qrcode' );

// Our custom function that will be triggered when the event occurs
function check_qrcode( $args ) {
		//Set args into vars
		$location = $args[0];
		$code = $args[1];
		//lets get the QR code
		$qr = ( isset( $_GET['qr'] ) ? $_GET['qr'] : '0' );
		//Check to see if we are a QR code!
		if($qr)
			QRcode::png($location);
}

?>
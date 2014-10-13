<?php
/* ----------------------------------------------------------------------
 * app/templates/pdfStart.php : top-matter prepended to PDF templates
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * -=-=-=-=-=- CUT HERE -=-=-=-=-=-
 * Template configuration:
 *
 * @name PDF start
 * @type pageStart
 *
 * ----------------------------------------------------------------------
 */
?><!DOCTYPE html>
<html>
	<head>
		<title><?php print $this->getVar('criteria_summary_truncated'); ?></title>
		
		<style type="text/css">
			@font-face {
			  font-family: 'Sans Light';
			  font-weight: normal;
              font-style: normal;
			  src: url(<?php print $this->request->getThemeDirectoryPath(); ?>/css/fonts/SansLightPlain.ttf) format('truetype');
			}
			@font-face {
			  font-family: 'Sans Light';
			  font-weight: normal;
              font-style: italic;
			  src: url(<?php print $this->request->getThemeDirectoryPath(); ?>/css/fonts/SansLightItalic.ttf) format('truetype');
			}
		</style>
		
		<link type="text/css" href="<?php print $this->getVar('base_path'); ?>pdf.css" rel="stylesheet" />
		<script type="text/javascript">
			var PhantomJSPrinting = {};
		</script>
	</head>
	<body style="width: <?php print $this->getVar('pageWidth'); ?>; height: <?php print $this->getVar('pageHeight'); ?>; margin: 0in; padding: 0in; position: relative;">
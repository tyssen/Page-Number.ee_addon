<?php

/*
=====================================================
 Author: John Faulds
 http://www.tyssendesign.com.au
=====================================================
 File: pi.page_number.php
-----------------------------------------------------
 Purpose: Determine the page number of paginated entries for ExpressionEngine2
=====================================================
*/

$setup = require_once('addon.setup.php');
$plugin_info = array(
   'pi_name'        => $setup['name'],
   'pi_version'     => $setup['version'],
   'pi_author'      => $setup['author'],
   'pi_author_url'  => $setup['author_url'],
   'pi_description' => $setup['description'],
   'pi_usage'       => Page_number::usage()
   );


class Page_number {

	var $return_data="";

	public function __construct()
	{

		$url_segment = ee()->TMPL->fetch_param('url_segment');
		$limit = ee()->TMPL->fetch_param('limit');

		$segment_number = str_replace("P", "", $url_segment);
		$result = ($segment_number / $limit) + 1;

		return $this->return_data = $result;
    
	}


	// ----------------------------------------
	//  Plugin Usage
	// ----------------------------------------

	// This function describes how the plugin is used.
	//  Make sure and use output buffering

	public static function usage()
	{
	ob_start();
	?>

	Usage example:

	Place {exp:page_number url_segment="{segment_1}" limit="5" parse="inward"} somewhere in your template.

	Parameters:

	url_segment: the segment which contains your page number
	limit:       the same value you have in your channel entries tag which limits the number of entries shown per page

	<?php
	$buffer = ob_get_contents();

	ob_end_clean();

	return $buffer;
	}
	/* END */

}

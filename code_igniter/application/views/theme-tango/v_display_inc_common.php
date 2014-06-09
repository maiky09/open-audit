<?php 
#  Copyright 2003-2014 Opmantek Limited (www.opmantek.com)
#
#  ALL CODE MODIFICATIONS MUST BE SENT TO CODE@OPMANTEK.COM
#
#  This file is part of Open-AudIT.
#
#  Open-AudIT is free software: you can redistribute it and/or modify
#  it under the terms of the GNU Affero General Public License as published 
#  by the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.
#
#  Open-AudIT is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU Affero General Public License for more details.
#
#  You should have received a copy of the GNU Affero General Public License
#  along with Open-AudIT (most likely in a file named LICENSE).
#  If not, see <http://www.gnu.org/licenses/>
#
#  For further information on Open-AudIT or for a license other than AGPL please see
#  www.opmantek.com or email contact@opmantek.com
#
# *****************************************************************************

/**
 * @package Open-AudIT
 * @author Mark Unwin <marku@opmantek.com>
 * @version 1.3.2
 * @copyright Copyright (c) 2014, Opmantek
 * @license http://www.gnu.org/licenses/agpl-3.0.html aGPL v3
 */

?>
<!-- v_display_php.php -->
<script src="<?php echo base_url() . 'theme-' . $user_theme . '/' . $user_theme . '-files/'; ?>jquery/js/jquery.plugin.menuTree.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$('#menu1').menuTree({
	expandSpeed: 300,
	collapseSpeed: 300,
	parentMenuTriggerCallback: false,
	multiOpenedSubMenu: true
	});
});
</script>

<?php
$images_directory = str_replace("index.php", "", $_SERVER["SCRIPT_FILENAME"]) . "theme-tango/tango-images/";

# grab some single attributes
$location_name = '';
$link_warranty = '';
$link_downloads = '';
foreach($system as $key) {
	$system_id = $key->system_id;
	if (mb_strtolower($key->man_os_group) == 'windows') {
		$os='windows';
	} else {
		$os='other';
	}
	$org_id = $key->man_org_id;
	$location_id = $key->man_location_id;
	$location_rack = $key->man_location_rack;
	$location_rack_position = $key->man_location_rack_position;
	$location_level = $key->man_location_level;
	$location_suite = $key->man_location_suite;
	$location_room = $key->man_location_room;
	$os_name = $key->man_os_name;
	$serial = $key->serial;
	$link_manufacturer = $key->manufacturer;
	$link_serial = $key->serial;
	$link_model = $key->model;
	$last_seen = $key->last_seen_by;
	$icon = $key->man_icon;	
	$type = $key->man_type;
}

foreach($system_location as $key) {
	$location_name = $key->location_name;
}

# set the edit options
$edit = '';
$edit_icon = '';
if ($access_level > 7) {
	$edit = 'class="editText" style="color:blue;"';
	#$edit_icon = '<img src="' . $image_path . '10_edit.png" alt="Click the blue text to edit!" title="Click the blue text to edit!" />';
	$edit_icon = '<img src="' . $image_path . '16_edit_out.png" onMouseOver="this.src=\'' . $image_path . '16_edit_hover.png\'" onMouseOut="this.src=\'' . $image_path . '16_edit_out.png\'" alt="Click the blue text to edit!" title="Click the blue text to edit!" />';
	$edit_custom = 'class="editCustom" style="color:blue;"';
	$tabcustom = '<li><a href="#tabcustom"><span>' . __('Custom') . '</span></a></li>';
} else {
	$tabcustom = '';
}

# set the passwords to display or not
if (isset($config->show_passwords) and $config->show_passwords != 'y') {
	if (isset($decoded_access_details->ssh_password)) {
		$ssh_password = str_replace($decoded_access_details->ssh_password, str_repeat("*", strlen($decoded_access_details->ssh_password)), $decoded_access_details->ssh_password);
	} else {
		$ssh_password = '';
	}
	if (isset($decoded_access_details->windows_password)) {
		$windows_password = str_replace($decoded_access_details->windows_password, str_repeat("*", strlen($decoded_access_details->windows_password)), $decoded_access_details->windows_password);
	} else {
		$windows_password = '';
	}
} else {
	$ssh_password = $decoded_access_details->ssh_password;
	$windows_password = $decoded_access_details->windows_password;
}

if (isset($config->show_snmp_community) and $config->show_snmp_community != 'y') {
	if (isset($decoded_access_details->snmp_community)) {
		$snmp_community = str_replace($decoded_access_details->snmp_community, str_repeat("*", strlen($decoded_access_details->snmp_community)), $decoded_access_details->snmp_community);
	} else {
		$snmp_community = '';
	}
} else {
	if (isset($decoded_access_details->snmp_community)) {
		$snmp_community = $decoded_access_details->snmp_community;
	} else {
		$snmp_community = '';
	}
}


// creating manufacturer / warranty / search links
$system[0]->warranty_link = '';
$system[0]->downloads_link = '';
$system[0]->dell_express_code_link = '';

# Dell
if (mb_strpos($system[0]->man_manufacturer,  "Dell") !== false)  {
	if ($system[0]->man_serial != ""){

	$system[0]->warranty_link = "<a href='http://www.dell.com/support/my-support/us/en/04/product-support/servicetag/" . $system[0]->man_serial . "' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";

	$system[0]->downloads_link = "<a href='http://www.dell.com/support/drivers/us/en/04/ServiceTag/" . $system[0]->man_serial . "' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";

	$system[0]->dell_express_code_link = base_convert($system[0]->man_serial,36,10);
	$system[0]->dell_express_code_link = mb_substr($system[0]->dell_express_code_link, 0, 3) . "-" . 
									mb_substr($system[0]->dell_express_code_link, 3, 3) . "-" . 
									mb_substr($system[0]->dell_express_code_link, 6, 3) . "-" . 
									mb_substr($system[0]->dell_express_code_link, 9, 2);
	}
}

# HP / Compaq
if ( (mb_strpos($system[0]->man_manufacturer,  "Compaq") !== false) OR 
	(mb_strpos($link_manufacturer,  "HP") !== false) OR 
	(mb_strpos($link_manufacturer,  "Hewlett Packard") !== false) OR 
	(mb_strpos($link_manufacturer,  "Hewlett-Packard") !== false) ) {
	if ($system[0]->man_serial != ""){
		$system[0]->warranty_link = "<a href='http://www4.itrc.hp.com/service/ewarranty/warrantyResults.do?BODServiceID=NA&amp;RegisteredPurchaseDate=&amp;country=GB&amp;productNumber=&amp;serialNumber1=" . $system[0]->man_serial . "' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";
	}
	if ($system[0]->man_model != ""){
		$system[0]->downloads_link = "<a href='http://h20180.www2.hp.com/apps/Lookup?h_lang=en&amp;h_cc=uk&amp;cc=uk&amp;h_page=hpcom&amp;lang=en&amp;h_client=S-A-R135-1&amp;h_pagetype=s-002&amp;h_query=" . $system[0]->man_model . "' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";
	}
}

# Lenovo / IBM
if ( (mb_strpos($system[0]->man_manufacturer,  "IBM") !== false) OR 
	(mb_strpos($system[0]->man_manufacturer,  "Lenovo") !== false) ) {

	if ($system[0]->man_model != ""){
		$system[0]->downloads_link = "<a href='http://www-307.ibm.com/pc/support/site.wss/quickPath.do?quickPathEntry=" . $system[0]->man_model . "' onclick=\"this.target='_blank';\">".__("Product Page")."</a>";
	}
	if ( ($system[0]->man_model != '') and ($system[0]->man_serial != '') ) {
		$system[0]->warranty_link = "<a href='http://www-307.ibm.com/pc/support/site.wss/warrantyLookup.do?type=" . mb_substr($system[0]->man_model,0,4) . "&amp;serial=" . $system[0]->man_serial . "&amp;country=897&amp;iws=off&amp;sitestyle=lenovo' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";
		$system[0]->warranty_link .= " <a href='http://www-307.ibm.com/pc/support/site.wss/warrantyLookup.do?type=" . mb_substr($system[0]->man_model,-9,-5) . "&amp;serial=" . $system[0]->man_serial . "&amp;country=897&amp;iws=off&amp;sitestyle=lenovo' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";   
	}
}

# Gateway
if (mb_strpos($system[0]->man_manufacturer,  "Gateway") !== false) {
	if ($system[0]->man_serial != '' ) {
		$system[0]->warranty_link = "<a href='http://support.gateway.com/support/allsysteminfo.asp?sn=" . $system[0]->man_serial . "' onclick=\"this.target='_blank';\"><img src='" . $image_path . "16_browser.png' alt='' title='' width='16'/></a>";
	}
}
?>
<!-- end of v_display_php.php prodecural -->
<?php
# end the prodecural stuff. Functions are below

function clean_url($url) {
	$url = str_replace("&amp;", "&", $url);
	$url = str_replace("&", "&amp;", $url);
	$url = str_replace("\\", '/', $url);
	return $url;	
}

function print_something($string)
{
	if ((mb_strlen($string) == 0) OR ($string == '0000-00-00') ) {
		return '-';
	} else {
		return $string;
	}
}

function display_custom_field($field_placement, $additional_fields, $edit) {
	foreach($additional_fields as $field)
	{
		if ($field->field_placement == $field_placement)
		{			
			$data_id = "";
			$data_value = "";
			
			$data_id = "field_" . $field->field_type;
			$data_id = $field->$data_id;
			
			$data_value = "field_" . $field->field_type;
			$data_value = $field->$data_value;
			
			$width = "120";
			if ($field_placement == 'view_summary_windows')
			{
				$width = '160';
			}
			# TODO: fix this string output hack with real html entities
			echo "<div style=\"float: left; width: 90%; \">\n";
			echo "<label for=\"custom_" . $field->field_type . "_" . $field->field_details_id . "_" . $field->field_id . "\" >" . __($field->field_name) . ": </label>";
			echo   "<span id=\"custom_" . $field->field_type . "_" . $field->field_details_id . "_" . $field->field_id . "\" " . $edit . ">" . print_something($data_value) . "</span>";
			if ($edit != '') { 
				#echo '<img src="' . base_url() . 'theme-tango/tango-images/' . '10_edit.png" alt="Click the blue text to edit!" title="Click the blue text to edit!" />'; 
				echo '<img src="' . base_url() . 'theme-tango/tango-images/16_edit_out.png" onMouseOver="this.src=\'' . base_url() . 'theme-tango/tango-images/16_edit_hover.png\'" onMouseOut="this.src=\'' . base_url() . 'theme-tango/tango-images/16_edit_out.png\'" alt="Click the blue text to edit!" title="Click the blue text to edit!" />';
			}
			echo "<br />&nbsp;\n";
			echo "</div>\n";
		}
	}
}

function strTime($s) {
	$str = "";
	$d = intval($s/86400);
	$s -= $d*86400;
	$h = intval($s/3600);
	$s -= $h*3600;
	$m = intval($s/60);
	$s -= $m*60;
	if ($d) $str = $d . 'd ';
	if ($h) $str .= $h . 'h ';
	if ($m) $str .= $m . 'm ';
	if ($s) $str .= $s . 's';
	return $str;
}

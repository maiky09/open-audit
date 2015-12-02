<?php
#  Copyright 2003-2015 Opmantek Limited (www.opmantek.com)
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
 * @author Mark Unwin <marku@opmantek.com>
 *
 * @version 1.10
 *
 * @copyright Copyright (c) 2014, Opmantek
 * @license http://www.gnu.org/licenses/agpl-3.0.html aGPL v3
 */
?>
<form action="#" method="post" class='niceforms'>
	<fieldset id="org_details" class='niceforms'>
		<legend><span style='font-size: 12pt;'>&nbsp;<?php echo __('Organisation Details')?></span></legend>
		<img class='section_image' src='<?php echo $oa_theme_images;?>/48_home.png' alt='' title='' />
		<?php if ($org->org_parent_id == '0') { $org->org_parent_name = 'Default Organisation'; } ?>
		<table cellpadding = "0" cellspacing="0">
			<tr>
				<td>
					<p><label for='org_name'><?php echo __("Name")?>: </label><span id='org_name' name='org_name'><?php echo htmlentities($org->org_name)?></span></p>
					<p><label for='org_devices'># <?php echo __("Devices")?>: </label><span id='org_devices' name='org_devices'><?php echo intval($org->total)?></span></p>
					<p><label for='org_parent'><?php echo __("Parent Org")?>: </label><span id='org_parent' name='org_parent'><a href='<?php echo intval($org->org_parent_id)?>'><?php echo htmlentities($org->org_parent_name)?></a></span></p>
					<p><label for='org_comments'><?php echo __("Comments")?>: </label><span id='org_comments' name='org_comments'><?php echo htmlentities($org->org_comments)?></span></p>
				</td>
			</tr>
		</table>
	</fieldset>
</form>
</div>
</div>

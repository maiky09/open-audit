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
 * @version   2.0.1

 *
 * @copyright Copyright (c) 2014, Opmantek
 * @license http://www.gnu.org/licenses/agpl-3.0.html aGPL v3
 */
?>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <div class="panel-title clearfix">
                Resources


      <form id="search_form" name="search_form" class="navbar-form navbar-right" style="margin-top:0px; margin-bottom:0px;" action="<?php echo $this->config->config['oa_web_folder']; ?>/index.php/search" method="post">
        <div class="form-group">
          <input type="text"   id="data[attributes][value]"   name="data[attributes][value]"   class="form-control input-sm" placeholder="Name or IP">
          <input type="hidden" id="data[attributes][tables]"  name="data[attributes][tables]" value='["system"]' />
          <input type="hidden" id="data[attributes][columns]" name="data[attributes][columns]" value='["name","ip"]' />
        </div>
        <button type="submit" class="btn btn-default btn-sm">Submit</button>
        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align" data-container="body" data-toggle="popover" data-placement="left" title="Device Search" data-content="Search the following fields: name, hostname, dns_hostname, sysName, domain, dns_domain, ip.">
            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
        </button>
      </form>

            </div>
        </div>
        <div class="panel-body">
            <div class="row">
            <?php
            $i = 0;
            foreach ($this->response->included as $endpoint) {
                if (!empty($endpoint->type) and $endpoint->type == 'collection') {
                    $i++;
                    $endpoint->attributes->name = str_replace('Ldap Servers', 'LDAP', $endpoint->attributes->name);
                    echo '<div class="col-sm-1 text-center">' . __($endpoint->attributes->name) . '<br /><a class="btn btn-app" href="' . $endpoint->attributes->collection . '"><span class="badge">' . $endpoint->attributes->count . '</span><i class="fa fa-' . $endpoint->attributes->icon  . ' fa-3x fa-fw" style="font-size: 2vw;"></i></a></div>';
                    if ($i == 12) {
                        echo "</div><br /><br /><div class=\"row\">";
                    }
                }
            }
            ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <?php include('include_collection_panel_header.php'); ?>
        </div>
        <div class="panel-body">
            <?php if (!empty($this->response->data)) { ?>
            <br />
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="sorter-false col-xs-1 text-center"><?php echo __('Execute'); ?></th>
                        <th class="sorter-false col-xs-1 text-center"><?php echo __('View')?></th>
                        <th><?php echo __('Name')?></th>
                        <th class="sorter-false col-xs-1 text-center"><?php echo __('Count'); ?></th>
                        <?php if ($this->m_users->get_user_permission('', 'summaries', 'd')) { ?>
                        <th class="sorter-false col-xs-1 text-center"><?php echo __('Delete')?></th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($this->response->data as $item) : ?>
                    <tr>
                        <td class="text-center"><a class="btn btn-sm btn-success" href="summaries/<?php echo intval($item->id); ?>?action=execute"><span class="glyphicon glyphicon-play" aria-hidden="true"></span></a></td>
                        <td class="text-center"><a class="btn btn-sm btn-primary" href="summaries/<?php echo intval($item->attributes->id); ?>"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                        <td><?php echo ucwords($item->attributes->name)?></td>
                        <td class="text-center"><?php echo ucwords($item->attributes->count)?></td>
                        <?php if ($this->m_users->get_user_permission('', 'summaries', 'd')) { ?>
                        <td class="text-center"><button type="button" class="btn btn-sm btn-danger delete_link"  data-id="<?php echo intval($item->id); ?>" data-name="<?php echo htmlspecialchars($item->attributes->name, REPLACE_FLAGS, CHARSET); ?>" aria-label="Left Align" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>
                        <?php } ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php } ?>
        </div>
    </div>




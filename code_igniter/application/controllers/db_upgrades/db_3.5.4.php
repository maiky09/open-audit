<?php
/**
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
*
**/

/*

UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table = \'file\'' WHERE name = 'Files';

UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'bios\', \'disk\', \'memory\', \'module\', \'monitor\', \'motherboard\', \'optical\', \'partition\', \'processor\', \'network\', \'scsi\', \'sound\', \'video\')' WHERE `name` = 'Hardware';

UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table = \'system\'' WHERE `name` = 'New Devices';

UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'dns\', \'ip\', \'log\', \'netstat\', \'pagefile\', \'print_queue\', \'route\', \'task\', \'user\', \'user_group\', \'variable\')' WHERE `name` = 'Settings';

UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'service\', \'server\', \'server_item\', \'software\', \'software_key\')' WHERE `name` = 'Software';

DROP TABLE IF EXISTS `radio`;

CREATE TABLE `radio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_id` int(10) unsigned DEFAULT NULL,
  `current` enum('y','n') NOT NULL DEFAULT 'y',
  `first_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `last_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `name` varchar(200) NOT NULL DEFAULT '',
  `net_index` varchar(200) NOT NULL DEFAULT '',
  `rx_level` varchar(200) NOT NULL DEFAULT '',
  `rx_profile` varchar(200) NOT NULL DEFAULT '',
  `rx_freq` varchar(200) NOT NULL DEFAULT '',
  `rx_power` varchar(200) NOT NULL DEFAULT '',
  `rx_bitrate` varchar(200) NOT NULL DEFAULT '',
  `tx_level` varchar(200) NOT NULL DEFAULT '',
  `tx_profile` varchar(200) NOT NULL DEFAULT '',
  `tx_freq` varchar(200) NOT NULL DEFAULT '',
  `tx_power` varchar(200) NOT NULL DEFAULT '',
  `tx_bitrate` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `system_id` (`system_id`),
  CONSTRAINT `radio_system_id` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELETE FROM `configuration` WHERE name = 'create_change_log_radio';

INSERT INTO `configuration` VALUES (NULL,'create_change_log_radio','n','bool','y','system','2000-01-01 00:00:00','Should Open-AudIT create an entry in the change log table if a change is detected in the radio table.');

DELETE FROM `configuration` WHERE name = 'delete_noncurrent_radio';

INSERT INTO `configuration` VALUES (NULL,'delete_noncurrent_radio','y','bool','y','system','2000-01-01 00:00:00','Should we delete non-current radio data.');

ALTER TABLE discoveries DROP IF EXISTS seed_ip;

ALTER TABLE discoveries ADD seed_ip varchar(45) NOT NULL DEFAULT '' AFTER status;

ALTER TABLE discoveries DROP IF EXISTS seed_restrict_to_subnet;

ALTER TABLE discoveries ADD seed_restrict_to_subnet enum('y','n') NOT NULL DEFAULT 'y' AFTER seed_ip;

ALTER TABLE discoveries DROP IF EXISTS seed_restrict_to_private;

ALTER TABLE discoveries ADD seed_restrict_to_private enum('y','n') NOT NULL DEFAULT 'y' AFTER seed_restrict_to_subnet;

ALTER TABLE discovery_scan_options DROP IF EXISTS ports_in_order;

ALTER TABLE discovery_scan_options ADD `ports_in_order` enum('','y','n') NOT NULL DEFAULT 'n' after options;

ALTER TABLE discovery_scan_options DROP IF EXISTS ports_stop_after;

ALTER TABLE discovery_scan_options ADD `ports_stop_after` tinyint unsigned NOT NULL DEFAULT 0 after ports_in_order;

DROP TABLE IF EXISTS discovery_scan_to_script;

CREATE TABLE `discovery_scan_to_script` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `discovery_scan_options_id` int(10) unsigned NOT NULL DEFAULT '1',
  `discovery_scripts_id` int(10) unsigned NOT NULL DEFAULT '1',
  `port` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  CONSTRAINT `discovery_scan_to_script_discovery_scan_options_id` FOREIGN KEY (`discovery_scan_options_id`) REFERENCES `discovery_scan_options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS discovery_scripts;

CREATE TABLE `discovery_scripts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `port` int(10) unsigned NOT NULL DEFAULT '0',
  `script` varchar(200) NOT NULL DEFAULT '',
  `script_options` varchar(200) NOT NULL DEFAULT '',
  `function` varchar(200) NOT NULL DEFAULT '',
  `edited_by` varchar(200) NOT NULL DEFAULT '',
  `edited_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS nmap_script;

CREATE TABLE `nmap_script` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_id` int(10) unsigned DEFAULT NULL,
  `current` enum('y','n') NOT NULL DEFAULT 'y',
  `first_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `last_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `port` int(5) NOT NULL DEFAULT '0',
  `script` varchar(200) NOT NULL DEFAULT '',
  `result` text NOT NULL,
  `result_formatted` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system_id` (`system_id`),
  CONSTRAINT `nmap_system_id` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE system DROP IF EXISTS os_arch;

ALTER TABLE system ADD `os_arch` varchar(50) NOT NULL DEFAULT '' AFTER os_bit;

UPDATE `configuration` SET `value` = '20210126' WHERE `name` = 'internal_version';

UPDATE `configuration` SET `value` = '3.5.4' WHERE `name` = 'display_version';
*/

$this->log_db('Upgrade database to 3.5.4 commenced');

$sql = "UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table = \'file\'' WHERE name = 'Files'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');


$sql = "UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'bios\', \'disk\', \'memory\', \'module\', \'monitor\', \'motherboard\', \'optical\', \'partition\', \'processor\', \'network\', \'scsi\', \'sound\', \'video\')' WHERE `name` = 'Hardware'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');


$sql = "UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table = \'system\'' WHERE `name` = 'New Devices'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');


$sql = "UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'dns\', \'ip\', \'log\', \'netstat\', \'pagefile\', \'print_queue\', \'route\', \'task\', \'user\', \'user_group\', \'variable\')' WHERE `name` = 'Settings'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');


$sql = "UPDATE `queries` SET `sql` = 'SELECT system.id AS `system.id`, system.icon AS `system.icon`, system.type AS `system.type`, system.name AS `system.name`, system.domain AS `system.domain`, system.ip AS `system.ip`, change_log.timestamp AS `change_log.timestamp`, change_log.db_table AS `change_log.db_table`, change_log.db_action AS `change_log.db_action`, change_log.details AS `change_log.details`, change_log.id AS `change_log.id`, CONCAT(\"devices?sub_resource=change_log&change_log.id=\", change_log.id) AS `link` FROM change_log LEFT JOIN system ON (change_log.system_id = system.id) WHERE @filter AND change_log.ack_time = \'2000-01-01 00:00:00\' AND change_log.db_table in (\'service\', \'server\', \'server_item\', \'software\', \'software_key\')' WHERE `name` = 'Software'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "DROP TABLE IF EXISTS `radio`";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "CREATE TABLE `radio` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_id` int(10) unsigned DEFAULT NULL,
  `current` enum('y','n') NOT NULL DEFAULT 'y',
  `first_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `last_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `name` varchar(200) NOT NULL DEFAULT '',
  `net_index` varchar(200) NOT NULL DEFAULT '',
  `rx_level` varchar(200) NOT NULL DEFAULT '',
  `rx_profile` varchar(200) NOT NULL DEFAULT '',
  `rx_freq` varchar(200) NOT NULL DEFAULT '',
  `rx_power` varchar(200) NOT NULL DEFAULT '',
  `rx_bitrate` varchar(200) NOT NULL DEFAULT '',
  `tx_level` varchar(200) NOT NULL DEFAULT '',
  `tx_profile` varchar(200) NOT NULL DEFAULT '',
  `tx_freq` varchar(200) NOT NULL DEFAULT '',
  `tx_power` varchar(200) NOT NULL DEFAULT '',
  `tx_bitrate` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `system_id` (`system_id`),
  CONSTRAINT `radio_system_id` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "DELETE FROM `configuration` WHERE name = 'create_change_log_radio'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "INSERT INTO `configuration` VALUES (NULL,'create_change_log_radio','n','bool','y','system','2000-01-01 00:00:00','Should Open-AudIT create an entry in the change log table if a change is detected in the radio table.')";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "DELETE FROM `configuration` WHERE name = 'delete_noncurrent_radio'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "INSERT INTO `configuration` VALUES (NULL,'delete_noncurrent_radio','y','bool','y','system','2000-01-01 00:00:00','Should we delete non-current radio data.')";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "ALTER TABLE discoveries DROP IF EXISTS seed_ip";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('discoveries', 'seed_ip', "ADD seed_ip varchar(45) NOT NULL DEFAULT '' AFTER status", 'add');

$sql = "ALTER TABLE discoveries DROP IF EXISTS seed_restrict_to_subnet";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('discoveries', 'seed_restrict_to_subnet', "ADD seed_restrict_to_subnet enum('y','n') NOT NULL DEFAULT 'y' AFTER seed_ip", 'add');

$sql = "ALTER TABLE discoveries DROP IF EXISTS seed_restrict_to_private";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('discoveries', 'seed_restrict_to_private', "ADD seed_restrict_to_private enum('y','n') NOT NULL DEFAULT 'y' AFTER seed_restrict_to_subnet", 'add');

$sql = "ALTER TABLE discovery_scan_options DROP IF EXISTS ports_in_order";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('discovery_scan_options', 'ports_in_order', "ADD ports_in_order enum('','y','n') NOT NULL DEFAULT 'n' AFTER options", 'add');

$sql = "ALTER TABLE discovery_scan_options DROP IF EXISTS ports_stop_after";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('discovery_scan_options', 'ports_stop_after', "ADD ports_stop_after tinyint(3) unsigned NOT NULL DEFAULT '0' AFTER ports_in_order", 'add');

$sql = "DROP TABLE IF EXISTS discovery_scan_to_script";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "CREATE TABLE `discovery_scan_to_script` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `discovery_scan_options_id` int(10) unsigned NOT NULL DEFAULT '1',
  `discovery_scripts_id` int(10) unsigned NOT NULL DEFAULT '1',
  `port` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` tinyint(3) unsigned NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  CONSTRAINT `discovery_scan_to_script_discovery_scan_options_id` FOREIGN KEY (`discovery_scan_options_id`) REFERENCES `discovery_scan_options` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "DROP TABLE IF EXISTS discovery_scripts";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "CREATE TABLE `discovery_scripts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `org_id` int(10) unsigned NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `port` int(10) unsigned NOT NULL DEFAULT '0',
  `script` varchar(200) NOT NULL DEFAULT '',
  `script_options` varchar(200) NOT NULL DEFAULT '',
  `function` varchar(200) NOT NULL DEFAULT '',
  `edited_by` varchar(200) NOT NULL DEFAULT '',
  `edited_date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "DROP TABLE IF EXISTS nmap_script";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "CREATE TABLE `nmap_script` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `system_id` int(10) unsigned DEFAULT NULL,
  `current` enum('y','n') NOT NULL DEFAULT 'y',
  `first_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `last_seen` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `port` int(5) NOT NULL DEFAULT '0',
  `script` varchar(200) NOT NULL DEFAULT '',
  `result` text NOT NULL,
  `result_formatted` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `system_id` (`system_id`),
  CONSTRAINT `nmap_script_system_id` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "ALTER TABLE system DROP IF EXISTS os_arch";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->alter_table('system', 'os_arch', "ADD os_arch varchar(50) NOT NULL DEFAULT '' AFTER os_bit", 'add');

// set our versions
$sql = "UPDATE `configuration` SET `value` = '20210126' WHERE `name` = 'internal_version'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$sql = "UPDATE `configuration` SET `value` = '3.5.4' WHERE `name` = 'display_version'";
$this->db->query($sql);
$this->log_db($this->db->last_query() . ';');

$this->log_db('Upgrade database to 3.5.4 completed');
$this->config->config['internal_version'] = '20210126';
$this->config->config['display_version'] = '3.5.4';

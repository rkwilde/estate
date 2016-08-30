/*PHP updates make 0000-00-00 0:00:00 not a valid default for datetimes. Changed these to NULL defaults*/

CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL DEFAULT '',
  `pass_word` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(20) NOT NULL DEFAULT '',
  `last_name` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `email_verified` tinyint(2) NOT NULL DEFAULT 0,
  `photo` varchar(50) NOT NULL DEFAULT '',
  `websocket_connected` tinyint(4) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
  `test` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime NULL DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`person_id`),
  KEY `person_email` (`email`),
  KEY `login` (`login`,`pass_word`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

insert into person (person_id, login, pass_word, first_name, last_name, email, created) values
(1, 'eric', password('test'), 'Eric', 'Roy', 'ericroy100@gmail.com', now())
, (2, 'steve', password('test'), 'Steve', 'Rogers', 'ericroy100@gmail.com', now())
, (3, 'sue', password('test'), 'Sue', 'Richards', 'ericroy100@gmail.com', now())
, (4, 'rick', password('test'), 'Rick', 'Wilde', 'rkwilde@gmail.com', now())
;

CREATE TABLE IF NOT EXISTS `estate` (
  `estate_id` int(11) NOT NULL AUTO_INCREMENT,
  `estate_name` varchar(100) NOT NULL DEFAULT '',
  `estate_status_id` int(11) NOT NULL DEFAULT '0', /* 1=open, 2=settled */
  `payment_amount_due` decimal(10, 2) NOT NULL DEFAULT 0,
  `payment_due_date` datetime DEFAULT NULL,
  `customer_type_id` int(11) NOT NULL DEFAULT '0', /* 1=paid, 2=trial, 3=free */
  `trial_start_date` datetime DEFAULT NULL,
  `trial_end_date` datetime DEFAULT NULL,
  `allow_outside_money` tinyint(2) NOT NULL DEFAULT 0, /* let rich brother buy more */
  `sealed_bids` tinyint(2) NOT NULL DEFAULT 0, /* sealed or public bidding */
  `initial_cash` decimal(12, 2) NOT NULL DEFAULT 0, /* cash accounts of estate */
  `liquidated_cash` decimal(12, 2) NOT NULL DEFAULT 0, /* value of sold items */
  `test` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`estate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `estate_status` (
  `estate_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `estate_status` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`estate_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `customer_type` (
  `customer_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_type` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `person_estate` (
  `person_estate_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL DEFAULT '0',
  `estate_id` int(11) NOT NULL DEFAULT '0',
  `person_group_id` int(11) NOT NULL DEFAULT '0',
  `owner` tinyint(2) NOT NULL DEFAULT '0',
  `executor` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`person_estate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `assigned_to_person_id` int(11) NOT NULL DEFAULT '0',
  `reserved_for_person_group_id` int(11) NOT NULL DEFAULT '0',
  `market_value` decimal(12, 2) NOT NULL DEFAULT 0, /* estimated value */
  `sell_price` decimal(12, 2) NOT NULL DEFAULT 0, /* actual price it was sold for */
  `min_bid` decimal(12, 2) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL DEFAULT '0',
  `media_type_id` int(11) NOT NULL DEFAULT '0', /* 1=photo, 2=video, 3=audio */
  `file_name` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `media_type` (
  `media_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `media_type` varchar(20) NOT NULL DEFAULT '',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`media_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

CREATE TABLE IF NOT EXISTS `bid` (
  `bid_id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `bid` decimal(12, 2) NOT NULL DEFAULT 0,
  `max_bid` decimal(12, 2) NOT NULL DEFAULT 0,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bid_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

/*
CREATE TABLE IF NOT EXISTS `invitation` (
  `invitation_id` int(11) NOT NULL AUTO_INCREMENT,
  `estate_status` varchar(50) NOT NULL DEFAULT '',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`invitation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;
*/
/*
note
invoice
payment
notice_sent
*/

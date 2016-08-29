CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL DEFAULT '',
  `pass_word` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(20) NOT NULL DEFAULT '',
  `last_name` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `photo` varchar(50) NOT NULL DEFAULT '',
  `websocket_connected` tinyint(4) NOT NULL DEFAULT '0',
  `address_id` int(11) NOT NULL DEFAULT '0',
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

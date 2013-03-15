CREATE TABLE IF NOT EXISTS `School` (
	id int(64) auto_increment primary key,
	name varchar(256) not null,
	state varchar(32) not null,
	zip varchar(32) not null,
	private_ownership char(1) not null
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `SurveyResults` (
	`id` int(64) auto_increment primary key,
	`date_created` datetime not null, 
	`School_id` int(64) not null,
	`current` char(1) not null,
	`students` int(11) DEFAULT NULL,
	`gf` varchar(30) DEFAULT NULL,
	`green_fee_amount` int(11) DEFAULT NULL,
	`sustco` varchar(30) DEFAULT NULL,
	`renewperc` int(11) DEFAULT NULL,
	`wind` int(11) DEFAULT NULL,
	`solar` int(11) DEFAULT NULL,
	`geothermal` int(11) DEFAULT NULL,
	`hydro` int(11) DEFAULT NULL,
	`biofuels` int(11) DEFAULT NULL,
	`biofuels_type` varchar(30) DEFAULT NULL,
	`other` int(11) DEFAULT NULL,
	`other_type` varchar(30) DEFAULT NULL,
	`renewablepurchase` int(11) DEFAULT NULL,
	`elecprov` varchar(30) DEFAULT NULL,
	`elecfp` varchar(30) DEFAULT NULL, --electricity footprint--
	`selfgen` varchar(30) DEFAULT NULL,
	`selfgen_description` varchar(40) DEFAULT NULL,
	`renewable_index` int(11) DEFAULT NULL,
	`green_policy` varchar(30) DEFAULT NULL,
	`green_policy_req` varchar(30) DEFAULT NULL,
	`certreq` varchar(30) DEFAULT NULL,
	`satereq` varchar(30) DEFAULT NULL,
	`buildingNumber` int(11) DEFAULT NULL,
	`lcertifiedNumber` int(11) DEFAULT NULL,
	`lsilverNumber` int(11) DEFAULT NULL,
	`lgoldNumber` int(11) DEFAULT NULL,
	`lplatinumNumber` int(11) DEFAULT NULL,
	`nonleedNumber` int(11) DEFAULT NULL,
	`lcertifiedncNumber` int(11) DEFAULT NULL,
	`lsilverncNumber` int(11) DEFAULT NULL,
	`lgoldncNumber` int(11) DEFAULT NULL,
	`lplatinumncNumber` int(11) DEFAULT NULL,
	`nonleedncNumber` int(11) DEFAULT NULL,
	`renewableIndex` varchar(30)
	`greenBuildingIndex` varchar(30)
)ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;


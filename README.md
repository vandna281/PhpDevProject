Vandna


Things done : 

 1) Data of selected students is exported to file and that file will be saved in project folder at path where server.php is present.
2) Created Service for export functionality and used that from controller to perform action.
3) Added export history button on view student page at last.
4) For view history page, created new table :
	CREATE TABLE `export_history` (
 	 `id` int unsigned NOT NULL AUTO_INCREMENT,
	  `export_date` datetime DEFAULT CURRENT_TIMESTAMP,
	  `exported_ids` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 	COLLATE=utf8_unicode_ci

In this table while export is done, data will be saved. Then those ids will be used to display email id’s of selected student on history page.

5) Also created “exportAll” route to export all the content.
CREATE TABLE IF NOT EXISTS tblUsers (
    pmkEmail varchar(320) NOT NULL COMMENT 'user''s email, unique',
    pmkUsername varchar(64) NOT NULL COMMENT 'user''s name, unique',
    fldPassword varchar(100) NOT NULL,
    fldFirstName varchar(100) NOT NULL,
    fldLastName varchar(100) NOT NULL,
    fldDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
/*    fldGender char(1) DEFAULT 'F', ---  dont use this row for now! */
    fldHash tinyint(1) NOT NULL DEFAULT '0',
    fldLinkCheck int(1) NOT NULL,
    fldApprove text NUll,
    fldApproveCheck NULL,
    PRIMARY KEY (pmkUsername),
    UNIQUE KEY (pmkEmail),
    UNIQUE KEY (pmkUsername)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblPicture (
    fnkUsername varchar(64) NOT NULL, 
    fldPicture BLOB NOT NULL, 
    pmkPictureId int(11) NOT NULL AUTO_INCREMENT, 
    PRIMARY KEY (pmkPictureId) 
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblPicture (
    fnkUsername varchar(64) NOT NULL,
    pmkPictureId int(11) NOT NULL AUTO_INCREMENT, 
    fldPicName VarChar(255) Not Null Default 'Untitled.txt',  ($name)
    fldMime VarChar(50) Not Null Default 'text/plain',   ($mime)
    fldSize BigInt Unsigned Not Null Default 0,
    fldPicture MediumBlob Not Null,
    fldCreated DateTime Not Null,
    PRIMARY KEY (pmkPictureId)
)

CREATE TABLE `file` (
    `id`        Int Unsigned Not Null Auto_Increment,
    `name`      VarChar(255) Not Null Default 'Untitled.txt',
    `mime`      VarChar(50) Not Null Default 'text/plain',
    `size`      BigInt Unsigned Not Null Default 0,
    `data`      MediumBlob Not Null,
    `created`   DateTime Not Null,
    PRIMARY KEY (`id`)
)
/* or this table
CREATE TABLE IF NOT EXISTS tblDemographics (
    fnkEmail varchar(320) NOT NULL,
    fldParent boolean not null default F,
    fldStudent boolean not null default F,
    fldEmployed boolean not null default F,
    fldPetOwner boolean not null default F,
    fldMarried boolean not null default F,
    fldTraveler boolean not null default F,
    PRIMARY KEY (fnkEmail)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

*/

CREATE TABLE IF NOT EXISTS tblTasks (
    fnkEmail varchar(320) NOT NULL,
    pmkTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldTask varchar(500) NOT NULL,
    fldDescription TEXT(65535) NULL,
    fldToDoDate DATE NOT NULL,
    PRIMARY KEY (fnkEmail, pmkTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRelationship (
    fnkEmail varchar(320) NOT NULL,
    fnkCategoryId int(11) NOT NULL,
    fnkTaskId int(11) NOT NULL,
    PRIMARY KEY (fnkEmail, fnkCategoryId, fnkTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS tblCategories (
    pmkCategoryId int(11) NOT NULL AUTO_INCREMENT,
    fldCategory varchar(500) NOT NULL,
    PRIMARY KEY (pmkCategoryId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRandomTask (
    pmkRandomTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldRandomTask varchar(500) NOT NULL,
    fldDescription TEXT(65535) NULL,
    PRIMARY KEY (pmkRandomTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblTaskship (
    fnkEmail varchar(320) NOT NULL,
    fnkRandomTaskId int(11) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




/* ----------------------------------------------------------------- */

/* ----- Display Statistics About Users Demographic ----- */
/* ----- Number of Taskes per User ----- */
SELECT fnkEmail, SUM(fldTask) as Task_Count
FROM tblTasks,
GROUP BY fnkEmail
ORDER BY Task_Count ASC;

/* ----- Gender ----- */
SELECT SUM(fldGender)
FROM tblUsers
WHERE fldGender = "F";

SELECT SUM(fldGender)
FROM tblUsers
WHERE fldGender = "M";



/* -----  ----- */

/* -----  ----- */

/* -----  ----- */

/* -----  ----- */
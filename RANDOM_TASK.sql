CREATE TABLE IF NOT EXISTS tblUsers (
    pmkEmail varchar(320) NOT NULL,
    fldPassword varchar(100) NOT NULL,
    fldFirstName varchar(100) NOT NULL,
    fldLastName varchar(100) NOT NULL,
    fldDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
/*    fldGender char(1) DEFAULT 'F', ---  dont use this row for now! */
    fldHash tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (pmkEmail)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
    PRIMARY KEY (pmkTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRandomTask (
    pmkRandomTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldRandomTask varchar(500) NOT NULL,
    fldDescription TEXT(65535) NULL,
    PRIMARY KEY (pmkRandomTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRelationship (
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
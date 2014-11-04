CREATE TABLE IF NOT EXISTS tblUsers (
    pmkEmail varchar(320) NOT NULL,
    fldPassword varchar(100) NOT NULL,
    fldName varchar(100) NOT NULL,
    fldDate timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fldGender char(1) DEFAULT NULL,
    PRIMARY KEY (pmkEmail)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblTasks (
    fnkEmail varchar(320) NOT NULL,
    pmkTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldTask TEXT(65535) NOT NULL,
    fldToDoDate DATE NOT NULL,
    PRIMARY KEY (pmkTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRandomTask (
    pmkRandomTaskId int(11) NOT NULL AUTO_INCREMENT,
    fldRandomTask TEXT(65535) NOT NULL,
    PRIMARY KEY (pmkRandomTaskId)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS tblRelationship (
    fnkEmail varchar(320) NOT NULL,
    fnkRandomTaskId int(11) NOT NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS tblDemographics (
    pmkUser int(11) NOT NULL AUTO_INCREMENT,
    fnkEmail varchar(320) NOT NULL,
    fldDemographics (need to list them all here)
    
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
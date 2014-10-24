CREATE TABLE IF NOT EXISTS `form_aec_physical_exam` (
    /* both extended and encounter forms need a last modified date */
    date datetime default NULL comment 'last modified date',
    /* these fields are common to all encounter forms. */
    id bigint(20) NOT NULL auto_increment,
    pid bigint(20) NOT NULL default 0,
    user varchar(255) default NULL,
    groupname varchar(255) default NULL,
    authorized tinyint(4) default NULL,
    activity tinyint(4) default NULL,
    general TEXT,
    neck TEXT,
    face_scalp TEXT,
    cranial_nerves TEXT,
    ears TEXT,
    tuning_fork TEXT,
    eyes TEXT,
    nose TEXT,
    oral_cavity TEXT,
    oropharynx TEXT,
    nasopharynx TEXT,
    larynx_hypopharynx TEXT,
    PRIMARY KEY (id)
) ENGINE=InnoDB;


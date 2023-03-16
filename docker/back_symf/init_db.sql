#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: type_user
#------------------------------------------------------------

CREATE TABLE type_user(
        id        Int  Auto_increment  NOT NULL ,
        type_user Varchar (50) NOT NULL
	,CONSTRAINT type_user_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: site
#------------------------------------------------------------

CREATE TABLE site(
        id   Int  Auto_increment  NOT NULL ,
        site Varchar (50) NOT NULL
	,CONSTRAINT site_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id           Int  Auto_increment  NOT NULL ,
        nom          Varchar (50) NOT NULL ,
        prenom       Varchar (50) NOT NULL ,
        actif        boolean NOT NULL ,
        created      Datetime NOT NULL ,
        updated      Datetime NOT NULL ,
        id_type_user Int NOT NULL ,
        id_site      Int NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id)

	,CONSTRAINT user_type_user_FK FOREIGN KEY (id_type_user) REFERENCES type_user(id)
	,CONSTRAINT user_site0_FK FOREIGN KEY (id_site) REFERENCES site(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: etat
#------------------------------------------------------------

CREATE TABLE etat(
        id          Int  Auto_increment  NOT NULL ,
        cause_arret Varchar (50) NOT NULL
	,CONSTRAINT etat_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cle
#------------------------------------------------------------

CREATE TABLE cle(
        id              Int  Auto_increment  NOT NULL ,
        num_cle         Int NOT NULL ,
        date_creation   Date NOT NULL ,
        date_arret      Date NOT NULL ,
        montant_initial Float NOT NULL ,
        commentaire     Varchar (250) NOT NULL ,
        created         Datetime NOT NULL ,
        updated         Datetime NOT NULL ,
        id_etat         Int
	,CONSTRAINT cle_PK PRIMARY KEY (id)

	,CONSTRAINT cle_etat_FK FOREIGN KEY (id_etat) REFERENCES etat(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: affecte
#------------------------------------------------------------

CREATE TABLE affecte(
        id               Int  Auto_increment  NOT NULL ,
        date_affectation Date NOT NULL ,
        date_suppression Date NOT NULL ,
        created          Datetime NOT NULL ,
        updated          Datetime NOT NULL ,
        id_cle           Int NOT NULL ,
        id_user          Int NOT NULL
	,CONSTRAINT affecte_PK PRIMARY KEY (id)

	,CONSTRAINT affecte_cle_FK FOREIGN KEY (id_cle) REFERENCES cle(id)
	,CONSTRAINT affecte_user0_FK FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=InnoDB;

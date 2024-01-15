#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id       Int  Auto_increment  NOT NULL ,
        username Varchar (250) NOT NULL ,
        email    Varchar (250) NOT NULL ,
        password Varchar (250) NOT NULL ,
        role     Varchar (50) NOT NULL ,
        token    Varchar (250) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: category_article
#------------------------------------------------------------

CREATE TABLE category_article(
        id          Int  Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (50) NOT NULL
	,CONSTRAINT category_article_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article(
        id                   Int  Auto_increment  NOT NULL ,
        title                Varchar (250) NOT NULL ,
        content              Longtext NOT NULL ,
        img                  Varchar (250) NOT NULL ,
        state                Bool NOT NULL ,
        created_at           Date NOT NULL ,
        updated_at           Date NOT NULL ,
        id_user              Int NOT NULL ,
        id_category_article  Int NOT NULL ,
        CONSTRAINT article_PK PRIMARY KEY (id),
        CONSTRAINT article_user_FK FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE,
        CONSTRAINT article_category_article0_FK FOREIGN KEY (id_category_article) REFERENCES category_article(id) ON DELETE CASCADE
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comment
#------------------------------------------------------------

CREATE TABLE comment(
        id          Int  Auto_increment  NOT NULL ,
        content     Longtext NOT NULL ,
        state       Bool NOT NULL ,
        created_at  Date NOT NULL ,
        id_article  Int NOT NULL ,
        id_user     Int NOT NULL ,
        CONSTRAINT comment_PK PRIMARY KEY (id),
        CONSTRAINT comment_article_FK FOREIGN KEY (id_article) REFERENCES article(id) ON DELETE CASCADE,
        CONSTRAINT comment_user0_FK FOREIGN KEY (id_user) REFERENCES user(id) ON DELETE CASCADE
)ENGINE=InnoDB;

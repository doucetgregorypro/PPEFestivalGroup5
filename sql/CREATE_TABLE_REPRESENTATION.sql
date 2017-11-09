CREATE TABLE Representation (
	id_lieu INT REFERENCES Lieu(id),
	id_groupe CHAR(4) REFERENCES Groupe(id),
	heureDeb TIME NOT NULL,
	heureFin TIME,
	dateRepres DATE NOT NULL,
	constraint pk_Representation PRIMARY KEY (id_lieu,id_groupe)
);
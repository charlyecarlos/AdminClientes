
CREATE TABLE CLIENTES(
	CIF VARCHAR(9) PRIMARY KEY,
	NOMBRE VARCHAR(50) NOT NULL,
	DIRECCION VARCHAR(50) NOT NULL,
	CP VARCHAR(50) NOT NULL,
	CIUDAD VARCHAR(50) NOT NULL,
	PROVINCIA VARCHAR(50) NOT NULL,
	TELEFONO VARCHAR(9) NOT NULL,
	EMAIL VARCHAR(70) NOT NULL,
	SALDO DECIMAL(20,2) NOT NULL DEFAULT 0,
	OBSERVACIONES VARCHAR(200)
);

CREATE TABLE FACTURAS(
	NUM_FACT VARCHAR(20) PRIMARY KEY,
	FECHA DATE NOT NULL,
	CIF VARCHAR(9) NOT NULL,
	CONSTRAINT FK_FACTURAS_CLIENTES_CIF FOREIGN KEY (CIF) REFERENCES CLIENTES(CIF)
);

CREATE TABLE LINEA_FACTURAS(
	NUM_FACT VARCHAR(20) ,
	NUM_LINEA VARCHAR(10) ,
	DESCRIPCION VARCHAR(200) NOT NULL,
	CANTIDAD DECIMAL(10) NOT NULL,
	PRECIO DECIMAL(10,2) NOT NULL,
	CONSTRAINT PK_LINEA_FACTURAS PRIMARY KEY (NUM_FACT,NUM_LINEA),
	CONSTRAINT FK_LINEA_FACTURAS_FACTURAS FOREIGN KEY (NUM_FACT) REFERENCES FACTURAS(NUM_FACT)
);

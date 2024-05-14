CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(255) NOT NULL,
    precio NUMERIC(10,2) NOT NULL,
);

INSERT INTO productos (nombre_producto, precio) VALUES ('Gallina', 150.00);
INSERT INTO productos (nombre_producto, precio) VALUES ('Vaca', 1200.00);
INSERT INTO productos (nombre_producto, precio) VALUES ('Cerdo', 800.00);
INSERT INTO productos (nombre_producto, precio) VALUES ('Oveja', 450.00);
INSERT INTO productos (nombre_producto, precio) VALUES ('Caballo', 2500.00);
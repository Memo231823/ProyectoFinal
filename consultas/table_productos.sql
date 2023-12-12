CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(100) NOT NULL,
    descripcion TEXT
    precio_venta DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    img TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
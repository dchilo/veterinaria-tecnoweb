-- Eliminar todas las tablas existentes con CASCADE
DROP TABLE IF EXISTS Pagos CASCADE;
DROP TABLE IF EXISTS Detalleventa CASCADE;
DROP TABLE IF EXISTS Promociones CASCADE;
DROP TABLE IF EXISTS Inventarios CASCADE;
DROP TABLE IF EXISTS Servicios CASCADE;
DROP TABLE IF EXISTS Ventas CASCADE;
DROP TABLE IF EXISTS Productos CASCADE;
DROP TABLE IF EXISTS Usuarios CASCADE;

-- Crear las tablas de nuevo con el diseño actualizado
-- Tabla Productos
CREATE TABLE Productos (
    id SERIAL PRIMARY KEY,
    proveedor_nombre VARCHAR(50),
    proveedor_contacto VARCHAR(20),
    nombre VARCHAR(100),
    descripcion TEXT,
    precio NUMERIC(10, 2),
    stock INT
);

-- Tabla Servicios
CREATE TABLE Servicios (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion TEXT,
    precio NUMERIC(10, 2)
);

-- Tabla Inventarios
CREATE TABLE Inventarios (
    id SERIAL PRIMARY KEY,
    producto_id INT,
    cantidad INT,
    tipo_movimiento VARCHAR(20),
    fecha_movimiento VARCHAR(10),
    FOREIGN KEY (producto_id) REFERENCES Productos(id)
);

-- Tabla Ventas (rediseñada)
CREATE TABLE Ventas (
    id SERIAL PRIMARY KEY,
    usuario_id INT,
    producto_id INT,
    cantidad INT,
    fecha VARCHAR(10),
    total NUMERIC(10, 2),
    FOREIGN KEY (usuario_id) REFERENCES users(id),
    FOREIGN KEY (producto_id) REFERENCES Productos(id)
);

-- Tabla Promociones
CREATE TABLE Promociones (
    id SERIAL PRIMARY KEY,
    producto_id INT,
    nombre VARCHAR(100),
    descripcion TEXT,
    descuento NUMERIC(5, 2),
    FOREIGN KEY (producto_id) REFERENCES Productos(id)
);

-- Tabla Pagos
CREATE TABLE Pagos (
    id SERIAL PRIMARY KEY,
    venta_id INT,
    monto NUMERIC(10, 2),
    fecha VARCHAR(10),
    metodo_pago VARCHAR(20) CHECK (metodo_pago IN ('qr', 'tarjeta', 'efectivo', 'transferencia')),
    FOREIGN KEY (venta_id) REFERENCES Ventas(id)
);

-- Insertar datos en la tabla Productos
INSERT INTO Productos (proveedor_nombre, proveedor_contacto, nombre, descripcion, precio, stock) VALUES
    ('Proveedor A', '1112223333', 'Vacuna Canina', 'Vacuna para perros contra la rabia', 20.00, 50),
    ('Proveedor B', '4445556666', 'Alimento para Gatos', 'Alimento balanceado para gatos adultos', 30.00, 100),
    ('Proveedor A', '1112223333', 'Collar Antipulgas', 'Collar antipulgas para perros y gatos', 15.00, 200),
    ('Proveedor C', '7778889999', 'Shampoo para Perros', 'Shampoo especial para el cuidado del pelaje', 10.00, 150),
    ('Proveedor B', '4445556666', 'Juguete para Gatos', 'Juguete interactivo para gatos', 8.00, 75),
    ('Proveedor D', '1234567890', 'Cepillo Dental para Perros', 'Cepillo dental para el cuidado de los dientes de los perros', 5.00, 100),
    ('Proveedor E', '0987654321', 'Rascador para Gatos', 'Rascador vertical para gatos', 25.00, 50),
    ('Proveedor A', '1112223333', 'Vitaminas para Mascotas', 'Suplemento vitamínico para mascotas', 12.00, 60),
    ('Proveedor C', '7778889999', 'Cama para Perros', 'Cama acolchada para perros', 45.00, 30),
    ('Proveedor D', '1234567890', 'Arnés para Perros', 'Arnés ajustable para perros', 18.00, 40);

-- Insertar datos en la tabla Servicios
INSERT INTO Servicios (nombre, descripcion, precio) VALUES
    ('Consulta Veterinaria', 'Consulta general con el veterinario', 50.00),
    ('Desparasitación', 'Servicio de desparasitación para mascotas', 25.00),
    ('Baño y Corte', 'Servicio de baño y corte de pelo para mascotas', 35.00),
    ('Vacunación', 'Aplicación de vacunas para mascotas', 20.00),
    ('Cirugía Menor', 'Procedimientos quirúrgicos menores', 100.00),
    ('Emergencia Veterinaria', 'Atención de emergencias veterinarias', 75.00),
    ('Examen de Laboratorio', 'Exámenes de laboratorio para mascotas', 40.00),
    ('Radiografía', 'Servicio de radiografía para mascotas', 60.00),
    ('Ultrasonido', 'Servicio de ultrasonido para mascotas', 80.00),
    ('Terapia Física', 'Sesiones de terapia física para mascotas', 50.00);

-- Insertar datos en la tabla Inventarios
INSERT INTO Inventarios (producto_id, cantidad, tipo_movimiento, fecha_movimiento) VALUES
    (1, 50, 'Entrada', '2024-06-01'),
    (2, 100, 'Entrada', '2024-06-02'),
    (3, 200, 'Entrada', '2024-06-03'),
    (4, 150, 'Entrada', '2024-06-04'),
    (5, 75, 'Entrada', '2024-06-05'),
    (6, 100, 'Entrada', '2024-06-06'),
    (7, 50, 'Entrada', '2024-06-07'),
    (8, 60, 'Entrada', '2024-06-08'),
    (9, 30, 'Entrada', '2024-06-09'),
    (10, 40, 'Entrada', '2024-06-10');

-- Insertar datos en la tabla Ventas
-- Asegúrate de que los usuarios existan en la tabla users antes de insertar estos datos
INSERT INTO Ventas (usuario_id, producto_id, cantidad, fecha, total) VALUES
    (1, 1, 1, '2024-06-10', 20.00),
    (1, 2, 1, '2024-06-11', 30.00),
    (1, 3, 2, '2024-06-12', 30.00),
    (1, 4, 1, '2024-06-13', 10.00),
    (1, 5, 3, '2024-06-14', 24.00),
    (1, 6, 2, '2024-06-15', 10.00),
    (1, 7, 1, '2024-06-16', 25.00),
    (1, 8, 2, '2024-06-17', 24.00),
    (1, 9, 1, '2024-06-18', 45.00),
    (1, 10, 1, '2024-06-19', 18.00);

-- Insertar datos en la tabla Promociones
INSERT INTO Promociones (producto_id, nombre, descripcion, descuento) VALUES
    (1, 'Descuento Verano', 'Descuento del 10% en todos los productos', 10.00),
    (2, 'Promoción Consulta', 'Consulta veterinaria a mitad de precio', 50.00),
    (3, 'Semana de la Salud', 'Descuento del 20% en servicios de salud', 20.00),
    (4, 'Descuento Invierno', 'Descuento del 15% en productos de cuidado', 15.00),
    (5, 'Promoción Vacunación', 'Vacunación a precio especial', 30.00);

-- Insertar datos en la tabla Pagos
INSERT INTO Pagos (venta_id, monto, fecha, metodo_pago) VALUES
    (1, 20.00, '2024-06-10', 'tarjeta'),
    (2, 30.00, '2024-06-11', 'efectivo'),
    (3, 30.00, '2024-06-12', 'tarjeta'),
    (4, 10.00, '2024-06-13', 'transferencia'),
    (5, 24.00, '2024-06-14', 'efectivo'),
    (6, 10.00, '2024-06-15', 'tarjeta'),
    (7, 25.00, '2024-06-16', 'qr'),
    (8, 24.00, '2024-06-17', 'transferencia'),
    (9, 45.00, '2024-06-18', 'efectivo'),
    (10, 18.00, '2024-06-19', 'tarjeta');

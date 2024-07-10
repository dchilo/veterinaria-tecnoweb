-- Definición de la tabla
DROP TABLE IF EXISTS paginas CASCADE;
CREATE TABLE paginas (
    id SERIAL PRIMARY KEY,
    nombre_pagina VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255),
    contador INT DEFAULT 0,  -- ¡Valor predeterminado 0!
    link_redireccion VARCHAR(255) DEFAULT NULL,
    estado INT DEFAULT 1 -- ¡Valor predeterminado 1 (activo)!
);

-- Agregar columna "vista_user" con valor inicial 0
ALTER TABLE laravel.paginas
ADD COLUMN vista_user INTEGER DEFAULT 0;

-- Agregar columna "vista_tecnico" con valor inicial 0
ALTER TABLE laravel.paginas
ADD COLUMN vista_tecnico INTEGER DEFAULT 0;

INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('login', 'Login - Pagina de login', '/login', 1),
    ('register', 'Register - Pagina de registro', '/register', 1),
    ('home', 'Home - Pagina de inicio', '/home', 1),
    ('dashboard', 'Dashboard - Pagina de inicio del sistema', '/dashboard', 1),
    ('logout', 'Logout - Pagina de cierre de sesión', '/logout', 1),
    ('error', 'Error - Pagina de error', '/error', 1),
    ('404', '404 - Pagina no encontrada', '/404', 1),
    ('500', '500 - Error interno del servidor', '/500', 1),
    ('403', '403 - Acceso denegado', '/403', 1),
    ('pagos.index', 'Pagos - Lista de pagos', '/pagos', 1);
     -- Reemplaza 1 con el ID real

-- Pagos
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('pagos.index', 'Pagos - Lista de pagos', '/pagos', 1),
    ('pagos.create', 'Pagos - Agregar nuevo pago', '/pagos/create', 1),
    ('pagos.edit', 'Pagos - Editar información del pago', '/pagos/1/edit', 1), -- Reemplaza 1 con el ID real
    ('pagos.show', 'Pagos - Detalles del pago', '/pagos/1', 0); -- Reemplaza 1 con el ID real

-- Ventas
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('ventas.index', 'Ventas - Lista de ventas', '/ventas', 1),
    ('ventas.create', 'Ventas - Agregar nueva venta', '/ventas/create', 1),
    ('ventas.edit', 'Ventas - Editar información de la venta', '/ventas/1/edit', 1), -- Reemplaza 1 con el ID real
    ('ventas.show', 'Ventas - Detalles de la venta', '/ventas/1', 0); -- Reemplaza 1 con el ID real

-- Usuarios
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('usuarios.index', 'Usuarios - Lista de usuarios', '/usuarios', 1),
    ('usuarios.create', 'Usuarios - Agregar nuevo usuario', '/usuarios/create', 1),
    ('usuarios.edit', 'Usuarios - Editar información del usuario', '/usuarios/1/edit', 1), -- Reemplaza 1 con el ID real
    ('usuarios.show', 'Usuarios - Detalles del usuario', '/usuarios/1', 0); -- Reemplaza 1 con el ID real

-- Productos
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('productos.index', 'Productos - Lista de productos', '/productos', 1),
    ('productos.create', 'Productos - Agregar nuevo producto', '/productos/create', 1),
    ('productos.edit', 'Productos - Editar información del producto', '/productos/1/edit', 1), -- Reemplaza 1 con el ID real
    ('productos.show', 'Productos - Detalles del producto', '/productos/1', 0); -- Reemplaza 1 con el ID real

-- Promociones
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('promociones.index', 'Promociones - Lista de promociones', '/promociones', 1),
    ('promociones.create', 'Promociones - Agregar nueva promoción', '/promociones/create', 1),
    ('promociones.edit', 'Promociones - Editar información de la promoción', '/promociones/1/edit', 1), -- Reemplaza 1 con el ID real
    ('promociones.show', 'Promociones - Detalles de la promoción', '/promociones/1', 0); -- Reemplaza 1 con el ID real

-- Motorizados
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('motorizados.index', 'Motorizados - Lista de motorizados', '/motorizados', 1),
    ('motorizados.create', 'Motorizados - Agregar nuevo motorizado', '/motorizados/create', 1),
    ('motorizados.edit', 'Motorizados - Editar información del motorizado', '/motorizados/1/edit', 1), -- Reemplaza 1 con el ID real
    ('motorizados.show', 'Motorizados - Detalles del motorizado', '/motorizados/1', 0); -- Reemplaza 1 con el ID real

-- Perfil
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('perfil.index', 'Perfil - Lista de perfiles', '/perfil', 1),
    ('perfil.create', 'Perfil - Crear nuevo perfil', '/perfil/create', 1),
    ('perfil.edit', 'Perfil - Editar perfil existente', '/perfil/1/edit', 1), -- Reemplaza 1 con el ID real
    ('perfil.show', 'Perfil - Detalles del perfil', '/perfil/1', 0); -- Reemplaza 1 con el ID real

-- Proveedores
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('proveedores.index', 'Proveedores - Lista de proveedores', '/proveedores', 1),
    ('proveedores.create', 'Proveedores - Agregar nuevo proveedor', '/proveedores/create', 1),
    ('proveedores.edit', 'Proveedores - Editar información del proveedor', '/proveedores/1/edit', 1), -- Reemplaza 1 con el ID real
    ('proveedores.show', 'Proveedores - Detalles del proveedor', '/proveedores/1', 0); -- Reemplaza 1 con el ID real

-- Insumos
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('insumos.index', 'Insumos - Lista de insumos', '/insumos', 1),
    ('insumos.create', 'Insumos - Agregar nuevo insumo', '/insumos/create', 1),
    ('insumos.edit', 'Insumos - Editar información del insumo', '/insumos/1/edit', 1), -- Reemplaza 1 con el ID real
    ('insumos.show', 'Insumos - Detalles del insumo', '/insumos/1', 0); -- Reemplaza 1 con el ID real

-- Inventarios
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('inventarios.index', 'Inventarios - Lista de inventarios', '/inventarios', 1),
    ('inventarios.create', 'Inventarios - Crear nuevo inventario', '/inventarios/create', 1),
    ('inventarios.edit', 'Inventarios - Editar información del inventario', '/inventarios/1/edit', 1), -- Reemplaza 1 con el ID real
    ('inventarios.show', 'Inventarios - Detalles del inventario', '/inventarios/1', 0); -- Reemplaza 1 con el ID real

-- Servicios
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('servicios.index', 'Servicios - Lista de servicios', '/servicios', 1),
    ('servicios.create', 'Servicios - Agregar nuevo servicio', '/servicios/create', 1),
    ('servicios.edit', 'Servicios - Editar información del servicio', '/servicios/1/edit', 1), -- Reemplaza 1 con el ID real
    ('servicios.show', 'Servicios - Detalles del servicio', '/servicios/1', 0); -- Reemplaza 1 con el ID real

-- Citas
INSERT INTO paginas (nombre_pagina, descripcion, link_redireccion, estado) VALUES
    ('citas.index', 'Citas - Lista de citas', '/citas', 1),
    ('citas.create', 'Citas - Agendar nueva cita', '/citas/create', 1),
    ('citas.edit', 'Citas - Editar información de la cita', '/citas/1/edit', 1), -- Reemplaza 1 con el ID real
    ('citas.show', 'Citas - Detalles de la cita', '/citas/1', 0); -- Reemplaza 1 con el ID real

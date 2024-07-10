CREATE EXTENSION IF NOT EXISTS pgcrypto;
INSERT INTO grupo07sc.users (name, email, password, phone, tipo_usuario, created_at, updated_at)
SELECT 
    nombre || ' ' || apellido AS name, 
    email, 
    crypt('1234', gen_salt('md5')) AS password, 
    CAST(telefono AS text) AS phone,
    tipo_usuario,
    current_timestamp AS created_at,
    current_timestamp AS updated_at
FROM grupo07sc.usuarios;

select * from grupo07sc.usuarios


-- Elimina la clave externa existente
ALTER TABLE grupo07sc.citas DROP CONSTRAINT citas_cliente_id_fkey;

-- Agrega la nueva clave externa
ALTER TABLE grupo07sc.citas
ADD CONSTRAINT citas_cliente_id_fkey FOREIGN KEY (cliente_id) REFERENCES grupo07sc.users(id);


--- UPDATE FINAL


SELECT id, cliente_id, motorizado_id, fecha_hora, estado, monto_total
	FROM grupo07sc.citas;
	
-- Eliminar clave externa existente
ALTER TABLE grupo07sc.citas DROP CONSTRAINT citas_cliente_id_fkey;

-- Agregar nueva clave externa con ON DELETE CASCADE
ALTER TABLE grupo07sc.citas
ADD CONSTRAINT citas_cliente_id_fkey
FOREIGN KEY (cliente_id) REFERENCES grupo07sc.users(id)
ON DELETE CASCADE;

--

-- Eliminar clave externa existente
ALTER TABLE grupo07sc.motorizados DROP CONSTRAINT motorizados_cliente_id_fkey;

-- Agregar nueva clave externa con ON DELETE CASCADE
ALTER TABLE grupo07sc.motorizados
ADD CONSTRAINT motorizados_cliente_id_fkey
FOREIGN KEY (cliente_id) REFERENCES grupo07sc.users(id)
ON DELETE CASCADE;


-- Eliminar clave externa existente
ALTER TABLE grupo07sc.citas_servicios DROP CONSTRAINT citas_servicios_cita_id_fkey;

-- Agregar nueva clave externa con ON DELETE CASCADE
ALTER TABLE grupo07sc.citas_servicios
ADD CONSTRAINT citas_servicios_cita_id_fkey
FOREIGN KEY (cita_id) REFERENCES grupo07sc.citas(id)
ON DELETE CASCADE;


-- Eliminar clave externa existente
ALTER TABLE grupo07sc.citas_insumos DROP CONSTRAINT citas_insumos_cita_id_fkey;

-- Agregar nueva clave externa con ON DELETE CASCADE
ALTER TABLE grupo07sc.citas_insumos
ADD CONSTRAINT citas_insumos_cita_id_fkey
FOREIGN KEY (cita_id) REFERENCES grupo07sc.citas(id)
ON DELETE CASCADE;


-- Eliminar clave externa existente
ALTER TABLE grupo07sc.pagos DROP CONSTRAINT pagos_cita_id_fkey;

-- Agregar nueva clave externa con ON DELETE CASCADE
ALTER TABLE grupo07sc.pagos
ADD CONSTRAINT pagos_cita_id_fkey
FOREIGN KEY (cita_id) REFERENCES grupo07sc.citas(id)
ON DELETE CASCADE;



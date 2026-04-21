-- Crear base de datos
CREATE DATABASE IF NOT EXISTS Login
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE Login;

-- TABLA DE USUARIOS (Solo lo necesario para Auth)
CREATE TABLE users (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    nombre              VARCHAR(255) NOT NULL,
    email               VARCHAR(255) NOT NULL UNIQUE,
    password            VARCHAR(255) NULL,
    rol                 VARCHAR(30) DEFAULT 'colaborador',
    estado              VARCHAR(20) DEFAULT 'activo',
    google_id           VARCHAR(255) NULL,
    reset_token         VARCHAR(255) NULL,
    reset_token_expires TIMESTAMP NULL,
    created_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

DELIMITER $$

-- 1. Login
CREATE PROCEDURE sp_login(IN p_email VARCHAR(255))
BEGIN
    SELECT id, nombre, email, password, google_id, rol, estado
    FROM users WHERE email = p_email LIMIT 1;
END$$

-- 2. Registro
CREATE PROCEDURE sp_registrar(
    IN p_nombre   VARCHAR(255),
    IN p_email    VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    INSERT INTO users (nombre, email, password)
    VALUES (p_nombre, p_email, p_password);
    SELECT LAST_INSERT_ID() AS id;
END$$

-- 3. Guardar token recuperación
CREATE PROCEDURE sp_guardarToken(
    IN p_email VARCHAR(255),
    IN p_token VARCHAR(255)
)
BEGIN
    UPDATE users
    SET reset_token = p_token,
        reset_token_expires = DATE_ADD(NOW(), INTERVAL 60 MINUTE)
    WHERE email = p_email;
END$$

-- 4. Actualizar contraseña
CREATE PROCEDURE sp_actualizarPassword(
    IN p_email    VARCHAR(255),
    IN p_token    VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    IF EXISTS (
        SELECT 1 FROM users
        WHERE email = p_email
          AND reset_token = p_token
          AND reset_token_expires >= NOW()
    ) THEN
        UPDATE users
        SET password = p_password,
            reset_token = NULL,
            reset_token_expires = NULL
        WHERE email = p_email;
        SELECT 'success' AS resultado;
    ELSE
        SELECT 'token_invalido' AS resultado;
    END IF;
END$$

DELIMITER ;
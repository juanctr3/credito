# Aplicación de Gestión y Venta de Dotaciones

Aplicación web completa para la gestión y venta de dotaciones para apartamentos bajo un modelo de pago a cuotas.

## Requisitos del Servidor

* PHP >= 8.1
* MariaDB >= 10.4 o MySQL >= 8.0
* Servidor Web (Apache o Nginx) con soporte para mod_rewrite
* Composer >= 2.0

## Instalación en Entorno Local (XAMPP/WAMP)

1.  **Clonar el repositorio o descomprimir el archivo `.zip`** en la carpeta `htdocs` (XAMPP) o `www` (WAMP).
    ```bash
    cd C:/xampp/htdocs/
    # git clone ... O descomprimir el .zip aquí
    ```

2.  **Crear la Base de Datos**:
    * Abre phpMyAdmin (`http://localhost/phpmyadmin`).
    * Crea una nueva base de datos llamada `dotaciones_db`.
    * Ve a la pestaña "Importar", selecciona el archivo `database.sql` del proyecto y ejecútalo.

3.  **Configurar las Variables de Entorno**:
    * Renombra el archivo `.env.example` a `.env`.
    * Abre el archivo `.env` y edita las credenciales de la base de datos:
    ```ini
    DB_HOST=localhost
    DB_NAME=dotaciones_db
    DB_USER=root
    DB_PASS=
    ```

4.  **Instalar Dependencias de PHP**:
    * Abre una terminal o consola en la raíz del proyecto.
    * Ejecuta el siguiente comando para que Composer descargue las librerías necesarias:
    ```bash
    composer install
    ```

5.  **Configurar el Servidor Virtual (Recomendado para URLs amigables)**:
    * Configura un Virtual Host en Apache para que apunte a la carpeta `/public` del proyecto. Esto es crucial para la seguridad y el correcto funcionamiento del enrutador.

6.  **Acceso a la Aplicación**:
    * **Frontend**: `http://localhost/dotaciones-app/public/` (o la URL del Virtual Host)
    * **Backend**: `http://localhost/dotaciones-app/public/login`
    * **Credenciales de Admin**:
        * **Usuario**: `admin@example.com`
        * **Contraseña**: `password`

## Estructura del Proyecto

El proyecto sigue una arquitectura Modelo-Vista-Controlador (MVC).
* `/app`: Contiene la lógica principal (Controladores, Modelos, Núcleo).
* `/public`: Es el único directorio accesible desde el navegador. Contiene el `index.php` y los assets (CSS, JS, imágenes).
* `/views`: Contiene las plantillas de la interfaz.
* `/vendor`: Dependencias gestionadas por Composer.

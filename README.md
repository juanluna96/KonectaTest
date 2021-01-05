## KONECTATEST

Sistema de administración según el rol de los usuarios:

### Roles disponibles:

- Administradores
- Vendedores
- Clientes

### Funciones destacables:

- Registro, logueo, y actualizaciones de perfiles.
- CRUD de vendedores (Solo admin).
- CRUD de clientes (Vendedores y usuarios).
- Buscador de usuarios (Vista de admin).
- Bloqueo de usuarios de rol Cliente.


## GUIA DE INSTALACION

- Instalar Xampp.
- Verificar tener instalada la versión de PHP 7.4.6 en Xampp.
- Instalar Composer.
- Instalar Node.
- En la carpeta donde vamos a guardar el proyecto abrir powershell digitamos el comando:
> git clone https://github.com/juanluna96/KonectaTest.git
- Digitamos el comando:
> composer install
- Digitamos el comando:
> npm install
- Nos dirigimos al archivo .env en la carpeta raíz y modificamos los datos del BD, usuario, contraseña, etc.
- Abrimos el Xampp e iniciamos los servicios de MYSQL y de Apache.
- Digitamos el comando: 
> php artisan migrate:fresh --seed
- Digitamos el comando:
> php artisan serve
- Nos dirigimos al enlace generado por el comando anterior.

**NOTA:**  Los usuarios administradores se les da permiso desde la base de datos.

# AgriStock - Sistema de Insumos Agrícolas

AgriStock es una aplicación web moderna y premium diseñada para la gestión de insumos agrícolas. Cuenta con un diseño responsivo de alta calidad y un sistema robusto de autenticación.

## 🚀 Características Principales

- **Diseño Premium**: Interfaz moderna y adaptable construida con Bootstrap 5, Bootstrap Icons, fuentes personalizadas y hojas de estilo a medida.
- **Autenticación Completa**: Flujo seguro para el registro e inicio de sesión de usuarios.
- **Alertas Premium**: Integración directa del framework **SweetAlert2** en los controladores para mostrar mensajes elegantes e interactivos (éxito, campos obligatorios, correos duplicados, etc.).
- **Dashboard de Administrador**: Panel de control con métricas clave, estado de sistema interactivo, accesos rápidos responsivos, barra de navegación superior degradada y menú lateral (sidebar) premium con agrupamiento de menús y tarjeta de perfil de usuario integrada.
- **Arquitectura MVC Limpia**: Separación clara de responsabilidades con Controladores, Modelos y Vistas en PHP.

---

## 📁 Estructura del Proyecto

El proyecto está organizado de la siguiente manera:

```text
├── config/
│   └── database.php             # Configuración y conexión a la base de datos (MySQLi)
├── controllers/
│   └── auth/
│       └── registerController.php # Controlador de registro con alertas SweetAlert2
├── models/
│   └── Usuario.php              # Modelo de Usuario (Registro, verificación de emails, etc.)
├── views/
│   ├── admin/
│   │   └── dashboard.php        # Dashboard principal de administración
│   ├── auth/
│   │   ├── login.php            # Vista premium de inicio de sesión
│   │   └── register.php         # Vista premium de registro de usuario
│   └── layouts/
│       ├── header.php           # Cabecera global con carga de estilos y favicon
│       ├── footer.php           # Pie de página responsivo y scripts de Bootstrap 5
│       └── sidebaradmin.php     # Menú lateral premium responsivo con perfil de usuario
├── public/
│   ├── index.php                # Landing page principal
│   └── css/
│       └── style.css            # Estilos CSS personalizados (AgriStock Premium)
├── sql/
│   └── bdtienda.sql             # Script de base de datos
└── Documentacion Logica.md/     # Documentación técnica interna
```

---

## 🛠️ Requisitos e Instalación

### 1. Requisitos Previos
* Servidor Web (por ejemplo, **Laragon**, **XAMPP** o **WampServer**) con soporte para:
  * **PHP 7.4** o superior.
  * Servidor de Base de Datos **MySQL/MariaDB**.

### 2. Configuración de la Base de Datos
1. Inicia tu servidor MySQL.
2. Crea una base de datos llamada `tiendadb` (o el nombre especificado en tu archivo de configuración).
3. Importa el archivo SQL ubicado en `sql/bdtienda.sql` a tu base de datos:
   ```bash
   mysql -u tu_usuario -p tiendadb < sql/bdtienda.sql
   ```

### 3. Configuración de Conexión en PHP
Abre el archivo [database.php](file:///c:/laragon/www/tienda/config/database.php) y configura las credenciales de tu base de datos local:
```php
$host = "127.0.0.1";
$user = "root";
$password = "";
$bd = "tiendadb";
$port = 3306;
```

---

## 💻 Flujo de Registro y Alertas

El flujo de registro está diseñado para interactuar con el usuario mediante **SweetAlert2** directamente procesado desde el controlador:

1. El usuario envía el formulario desde [register.php](file:///c:/laragon/www/tienda/views/auth/register.php).
2. El controlador [registerController.php](file:///c:/laragon/www/tienda/controllers/auth/registerController.php) recibe los datos por método `POST`.
3. El controlador valida la información:
   - Si existen campos vacíos o si el correo ya está registrado en el modelo [Usuario.php](file:///c:/laragon/www/tienda/models/Usuario.php), se genera una alerta SweetAlert2 de tipo `error` con fondo oscuro premium y se redirige de vuelta al registro al pulsar "OK".
   - Si la cuenta se crea exitosamente, se muestra la alerta SweetAlert2 de tipo `success` y se redirige a [login.php](file:///c:/laragon/www/tienda/views/auth/login.php).

*Para más detalles sobre la lógica del código, consulta el archivo [registro.md](file:///c:/laragon/www/tienda/Documentacion%20Logica.md/auth/registro.md).*

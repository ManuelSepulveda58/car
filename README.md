# 🚗 Proyecto Laravel de Catálogo de Autos

Este es un proyecto Laravel + Blade que permite administrar un catálogo de autos y marcas con autenticación básica y pruebas automatizadas.

---

## ⚙️ Requisitos

- PHP 8.1+
- Composer
- Node.js + npm
- SQLite (o base de datos que elijas)

---

## 🚀 Instalación y configuración

```bash
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo

##Instala dependencias
composer install         
npm install           

##Configura el entorno
cp .env.example .env      # Copia la configuración base
php artisan key:generate  # Genera la clave de aplicación
php artisan migrate       # Ejecuta las migraciones


##Comandos utiles
php artisan serve         # Inicia el servidor local de Laravel
npm run dev               # Compila los assets en modo desarrollo
npm run build             # Compila assets para producción
php artisan tinker        # Abre consola interactiva de Laravel
php artisan vendor:publish  # Publica los estilos de paginación

#Pruebas unitarias
php artisan test                                # Ejecuta todas las pruebas
php artisan test --filter NombreDelTest         # Ejecuta pruebas específicas


#Pruebas ejecutadas
AdminCarControllerTest: Prueba creación, edición y eliminación de autos.

AdminBrandControllerTest: Prueba CRUD de marcas, incluyendo subida de imágenes.

PageControllerTest: Prueba filtros de catálogo público.

CarTest: Verifica relaciones y comportamiento del modelo.

#Rutas disponibles
/ → Página de inicio

/cars → Catálogo público con filtros

/admin/login → Simulación de login de administrador (password: 1234)

/admin/cars → CRUD de autos

/admin/brands → CRUD de marcas

##🔐 Login del administrador
El sistema simula autenticación con una contraseña sencilla:

Ruta: /admin/login

Contraseña: 1234

##🧠 Notas adicionales
Las relaciones están definidas entre Brand y Car (Brand hasMany Cars, Car belongsTo Brand).

Las pruebas usan SQLite por defecto.

Se recomienda usar Storage::fake() para pruebas de subida de imágenes.

El sistema de filtros del catálogo permite buscar por modelo, marca, precio, y kilometraje.
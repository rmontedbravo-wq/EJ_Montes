⚖️ Sistema Estudio de Abogados
📌 Descripción del Proyecto

El Sistema Estudio de Abogados es una aplicación desarrollada en PHP + MySQL que permite la gestión básica de un estudio jurídico. El sistema administra clientes, expedientes, juzgados, cortes judiciales, pagos, documentos y usuarios, permitiendo llevar el control del estado de los procesos judiciales.

El proyecto está orientado a fines académicos y prácticos, mostrando una estructura sencilla sin el uso de frameworks, controladores ni patrón MVC; toda la lógica se encuentra organizada dentro de la carpeta principal estudio_abogados.
🛠️ Requisitos del Sistema
🔹 Software
PHP 7.4 o superior
Servidor web (Apache – XAMPP, WAMP o Laragon)
MySQL 
Navegador web moderno (Chrome, Edge, Firefox)
🔹 Extensiones PHP necesarias
mysqli
mbstring
gd (opcional, para PDF)
🔹 Librerías
FPDF (incluida en la carpeta /fpdf
⚙️ Instrucciones de Instalación
1️⃣ Clonar el repositorio
git clone https://github.com/tu_usuario/estudio_abogados.git
2️⃣ Copiar el proyecto al servidor local
Mover la carpeta estudio_abogados a:
htdocs (XAMPP)
www (WAMP)
3️⃣ Importar la base de datos
Abrir phpMyAdmin
Crear una base de datos (ejemplo: estudio_abogados)
Importar el archivo .sql
4️⃣ Configurar la conexión
Editar el archivo de conexión ubicado en:
$conexion = new mysqli("localhost", "root", "", "estudio_abogados");
▶️ Cómo Ejecutar el Proyecto
Iniciar Apache y MySQL desde XAMPP / WAMP
Abrir el navegador
Ingresar a:
http://localhost/estudio_abogados
📌 Puerto por defecto: 80
🔐 Credenciales de Prueba
👤 Usuario 
Usuario: admin
Contraseña: 1234



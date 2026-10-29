# XClassic

Fanpage comunitaria dedicada a la Xbox original. Incluye catálogo de juegos, artículos y foros, con interfaz bilingüe en español e inglés.

**Autor:** Armin Deck  
**Autor Sitio:** [dbproject.rf.gd](https://dbproject.rf.gd)  
**Sitio:** [xclassic.rf.gd](https://xclassic.rf.gd/)  
**Versión:** 1.0.0-beta

## Funciones

- Catálogo de 989 juegos de Xbox clásico con desarrolladores, editores y fechas de lanzamiento PAL, Japón y Norteamérica.
- Fichas individuales de juegos, artículos y foros con rutas propias.
- Búsqueda en juegos por título, descripción, contenido, desarrollador, editor y fecha; búsqueda por título, descripción y contenido en blogs y foros.
- Navegación SPA con soporte para atrás/adelante y rutas no encontradas.
- Interfaz responsiva con menú desplegable para móviles.
- Temas claro/oscuro e idioma guardados en `localStorage`.
- Texto de juegos, blogs y foros con formato Markdown, procesado con Marked y saneado con DOMPurify.
- Metadatos SEO y de vista previa Open Graph/Twitter, favicon y URL canónica configurada.
- Los datos se mantienen en JSON y `router.php` los entrega a `layout.html` como `window.APP_DATA`.
- Acceso HTTP directo a `data/` bloqueado con `.htaccess`.

## Requisitos

- PHP 8.0 o posterior.
- Para Apache: `mod_rewrite` habilitado y permiso para usar reglas `.htaccess` (`AllowOverride`).
- Conexión a Internet para las fuentes, Marked, DOMPurify y las imágenes remotas.

## Ejecución local

Desde la carpeta raíz del proyecto, ejecuta:

```powershell
php -S 127.0.0.1:8000 router.php
```

Abre <http://127.0.0.1:8000>. No abras `layout.html` directamente ni uses un servidor estático: PHP debe procesar `router.php` para inyectar los JSON.

## Rutas

- `/`, `/games`, `/blog`, `/forums`
- `/game/{slug}`, por ejemplo `/game/fable`
- `/blog/{slug}`
- `/forum/{id}`, por ejemplo `/forum/1`

`router.php` devuelve una página 404 para rutas no reconocidas. En producción, apunta el documento raíz del sitio a esta carpeta y permite que Apache aplique `.htaccess`.

## Datos y configuración

- `data/games.json`: juegos, metadatos de lanzamiento y contenido de las fichas.
- `data/blogs.json`: artículos.
- `data/forums.json`: foros.
- `data/languages.json`: traducciones de la interfaz.
- `data/core.json`: autor, versión y fechas del proyecto. El footer muestra la versión combinando `version` y `state`.
- `data/config.json`: nombre, URL, idioma y zona horaria del sitio. Actualiza `page_link` antes de desplegar para que el canonical y Open Graph apunten al dominio público.

Cada juego usa `developers` y `publishers` como listas, y `releaseDate` con las claves `PAL`, `JP` y `NA`. Las fechas no disponibles son `null`.

## Imágenes y licencias

Las imágenes actuales son ilustrativas y remotas; no son portadas oficiales para cada título. Las fuentes y dependencias de terceros mantienen sus propias licencias y no quedan cubiertas por la licencia MIT del proyecto.

## Licencia

El código de este proyecto se distribuye bajo la licencia MIT. Consulta [LICENSE](LICENSE). Los nombres de juegos, marcas, imágenes, fuentes, bibliotecas y otros recursos de terceros conservan los derechos y licencias de sus respectivos propietarios.

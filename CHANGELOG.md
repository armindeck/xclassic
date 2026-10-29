# Changelog

Cambios destacados de XClassic.

## [1.0.0-beta] - 2026-10-29

### Añadido

- Fanpage bilingüe de Xbox clásico con navegación de inicio, juegos, blog y foros.
- Catálogo de 989 juegos con fichas, desarrolladores, editores y fechas PAL, Japón y Norteamérica.
- Rutas de detalle para juegos, artículos y foros, además de navegación atrás/adelante y estado 404.
- Buscadores para juegos, blogs y foros. El catálogo de juegos permite buscar por título, descripción, contenido, desarrollador, editor y fecha.
- Filtros insensibles a mayúsculas y acentos, con indicador cuando no hay coincidencias.
- Header responsivo con menú desplegable para móviles.
- Temas claro/oscuro e idioma español/inglés persistidos en `localStorage`.
- Renderizado Markdown con Marked y saneamiento de HTML con DOMPurify.
- Metadatos SEO, Open Graph y Twitter, favicon y URL canónica configurable.
- Datos JSON para juegos, blogs, foros, idiomas, configuración y versión del proyecto.
- Router PHP que carga los JSON, los inyecta en la plantilla y controla las rutas.
- Reglas Apache para el router y protección HTTP directa del directorio de datos.
- Licencia MIT para el código del proyecto.

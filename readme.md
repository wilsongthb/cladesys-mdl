# CLADESYS - MDL (anteriormente)
# LATIGAZO - CLADESYS

El projecto es sucession de cladesysLyA, el objetivos es hacer el anterior mas entendible y formal, el -mdl es por el use de MaterialDesignLite como framework principal de estilo, quizas esto pueda cambiar luego, es solo con el objetivo de diferenciar uno de otro, otro objetivo es mejorar la organizacion de carpetas y nombres, ademas de quitar partes que no eran necesarias

## Frameworks
- Laravel 5.4
- Angular 1
- Material Design
- Bootstrap
- VueJS

Se abandona el desarrollo con Material Design Lite, en relacion a algunas incompatibilidades que no me interesa resolver, porque es timepo perdido dedicarse a ello, se cambia el nombre del proyecto a latigazo-cladesys

Incompatibilidades de Material Design Lite:
- Sobreposicion al usar el nav junto con modals de Bootstrap
- Imposibilidad para renderizar las clases de estilo con js en Vue Router
- Basicamente no interactua bien con otros frameworks que no necesariamente son de css

# Version
0.0.5

# SOPORTE A LOCATIONS STAGES

Se trata de encapsular las entradas de una fecha para vender solo las de esa fecha
esto se hace normalmente al principio de cada año, se comprueba el inventario, para
que todo cuadre y finalmente se reinicia todo desde cero con un nuevo inventario inicial

## cambios

* [H] Boton Copiar ultimos datos de facturacion en entrada a almacen
* [H] Cambiado tipo de dato de entrada en formulario de entrada a almacen
* [H] Busqueda con espacio
* [H] Menu mas simple en moviles

* [H] Busqueda intuitiva en salidas de inventario
* [H] desactivar recalculo de precios en salidas de almacen

 #cambios 2018/11/15

 * [H] Corregir el calculo de la cantidad en el calculo de productos requeridos
 * [H] Agregar boton de ordenacion en las tablas del sistema de logistica
 * [H] Quitar duracion del calculo de productos requerido
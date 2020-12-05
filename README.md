# PRACTICA SERVIDOR 2ºDAW

## HECHO:
Básica:
- Ver la lista de tareas
	- Paginar
- Añadir tarea
	- Filtrado
- Modificar tarea
- Eliminar tarea

Mejorada:
- Diseño modular con Blade
- Validación de múltiples usuarios
  - Fecha de inicio de sesión
  - Enlace para finalizar sesión

Instalador:
- Creación de la base de datos
- Creación de las tablas
- Insertado de contenido

Adenda:
- Control de versiones (https://github.com/angelaconde/desatranques/commits/master)


## POR HACER:

- Completar tarea:
Esta operación me permitirá cambiar el estado de una tarea y realizar las anotaciones oportunas sobre la misma. 
Para esta operación tan solo se mostrarán los datos de la tarea y se solicitará que se marque la tarea como 
completada, cancelada, realianso las anotaciones que se consideren oportunas. No se deberá poder modificar ningún 
campo, salvo las anotaciones y el estado.
El estado se seleccionará preferiblemente con botones de rádio, marcando por defecto la opción completada.
Esta acción en un futuro será realizada por los operarios, la pantalla debe ser diferente de la que se utilice en 
la modificación pues solo se deberán permitir cambiar los campos fecha de realización, estado de la tarea y anotaciones posteriores.

- Buscar o filtrar tareas:
Con esta operación permitiremos que el usuario pueda buscar o filtrar la lista de pedidos atendiendo al valor 
de diferentes campos. Se deberán soportar al menos 3 campos, y se debe considerar que la busqueda podrá incluir 
criterios de comparación como igual, contiene, mayor, menor, etc. en los campos que proceda.

- Diferenciar usuarios por tipo:
•	Ver la lista de incidencias/tareas. (Adm. y ope.)
•	Añadir una nueva indicencia/tarea. (Adm.)
•	Modificar datos de una indicencia/tarea. (Adm.)
•	Eliminar una tarea. Confirmando la operación para evitar errores. (Adm.)
•	Cambiar el estado de una incidencia/tarea
Completar una tarea incluyendo anotaciones si se precisan (ope.)
•	Buscar o filtrar tareas utilizando distintos campos. (Adm. y ope.)

- Operaciones con usuarios:
•	Añadir un usuario. [solo Adm.]
•	Eliminar un usuario. [solo Adm.]
•	Editar un usuario: cambiar usuario o clave.
•	Listar usuarios existentes. [solo Adm.]

- Documentación de la aplicación:
Deberéis generar la documentación de la aplicación realizada incluyendo los comentarios pertinentes y 
luego generando los documentos de forma automatizada.
•	ApiGen.
•	DoxyGen.
Estos utilizan una seríe de etiquetas, las cuales podréis consultar aquí 
(http://www.phpdoc.org/docs/latest/for-users/list-of-tags.html).
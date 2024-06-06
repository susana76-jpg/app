API DE LA APLICACIÓN TALLER DE COCHES MegaCar
=================================================

API utilizada en la aplicación móvil MegaCar. 

[![License](https://img.shields.io/badge/License-CC0-lightgray.svg?style=flat-square)](https://creativecommons.org/publicdomain/zero/1.0/)
[![Latest release](https://img.shields.io/github/v/release/mhucka/readmine.svg?style=flat-square&color=b44e88)](https://github.com/mhucka/readmine/releases)
[![DOI](http://img.shields.io/badge/DOI-10.22002%20%2f%20D1.20173-blue.svg?style=flat-square)](https://data.caltech.edu/records/20173)


Table of contents
-----------------

* [Introducción](#Introducción)
* [Formulario de registro de clientes](#formulario-de-registro-de-clientes)
* [Login de usuarios](#login-de-usuarios)
* [Usabilidad en la parte cliente](#usabilidad-en-la-parte-cliente)
* [Usabilidad en la parte empleado](#usabilidad-en-la-parte-empleado) 
* [Usabilidad en la parte administrador](#usabilidad-en-la-parte-administrador) 


Introducción
------------
API utilizada en el proyecto MegaCar. Esta API es fundamental para el funcionamiento correcto de la aplicación móvil y se encarga de gestionar todas las llamadas necesarias desde la aplicación. 

Sus consultas son referidas a una base de datos relacional, en la que se ha procurado mantener en todo momento la coherencia e integridad de los datos. 

Para un manejo eficiente de la base de datos, y asegurar la integridad referencial, se ha elegido identificar a cada una de las tablas con una única Primary Key, evitando las relaciones de n a n entre ellas.

Formulario de registro de clientes
----------------------------------
Llamadas a la API para el formulario de registro de clientes y vehículo vinculado a él.

1. Se realiza la llamada a todos los listados de vehículo para la selección del vehículo a registrar.
2. Se realiza la grabación de los datos del cliente.
3. Se realiza la grabación del vehículo-cliente.


Login de usuarios
----------------------------------
Cuando un usuario inicia sesión en la aplicación, la API verifica las credenciales proporcionadas (correo electrónico y contraseña) y autentica los datos. Si las credenciales son válidas, se genera un token de acceso que se utiliza para las futuras interacciones con la aplicación (firebase)Además de todo ello, se dan los datos necesarios para saber si el usuario que está entrando lo está haciendo en modo cliente, empleado o administrador. Según esta opción, las interfaces y funcionalidades de la aplicación serán distintas.

###  Login cliente / empleado / administrador
Solicita acceso a la app con su email y password. Desde esta opción se dará acceso al usuario en modo cliente, empleado o administrador. Los valores devueltos son:
1. Es cliente --> 1
2. Es empleado --> 0
3. Es administrador --> 3


Usabilidad en la parte cliente
----------------------------------
###  Citas
1. Selecciona horas disponibles por fechas.
2. Graba citas solicitadas desde la aplicación.
3. Borra citas que el cliente aún no ha realizado
4. Histórico de citas realizadas

###  Averías
Desde el histórico de citas, histórico de averías 

###  Vehículos
Se lista los vehículos de los que el cliente ha tenido citas

###  Presupuestos
1. Listado de presupuestos enviados al cliente, tanto aceptados como no.
2. Listado de líneas de presupuesto de cada uno de los presupuestos para su posterior impresión.

###  Facturas
1. Listado de facturas enviados al cliente, con presupuesto aceptado y orden finalizada.
2. Listado de líneas de factura de cada uno de las facturas para su posterior impresión.

###  Perfil usuario
Se permite al usuario editar sus datos de perfíl.


###  Averías
Desde el histórico de citas, histórico de averías 

###  Vehículos
Se lista los vehículos de los que el cliente ha tenido citas

###  Presupuestos
1. Listado de presupuestos enviados al cliente, tanto aceptados como no.
2. Listado de líneas de presupuesto de cada uno de los presupuestos para su posterior impresión.

###  Facturas
1. Listado de facturas enviados al cliente, con presupuesto aceptado y orden finalizada.
2. Listado de líneas de factura de cada uno de las facturas para su posterior impresión.

###  Perfil usuario
Se permite al usuario editar sus datos de perfíl.

Usabilidad en la parte empleado
----------------------------------

###  Perfil 
Se permite al usuario mostrar y modificar sus datos.

###  Presupuestos - Documentos
1. Permite la búsqueda de presupuestos creados anteriormente y mostrarse en
pantalla.
2. Permite la creación de presupuestos, mostrándose éstos en pantalla a tiempo
real.

###  Órdenes de Reparación
1. Permite la búsqueda de ordenes de reparación creadas anteriormente y
mostrarse en pantalla.
2. Permite la creación de ordenes de reparación, y modificar presupuestos
mostrándose en pantalla los item modificados y los aceptados.
3. Permite la finalización de orden de reparación y notificación al cliente que la
reparación ha finalizado y puede retirar el vehículo.
4. Permite la facturación de la orden finalizada

###  Facturas - Documentos
1. Permite la búsqueda de facturas creadas anteriormente y mostrarse en pantalla.
2. Permite la visualización de la factura creada en el acto.



Usabilidad en la parte administrador
----------------------------------

###  Gestión de Empleados
1. Permite dar de alta en la base de datos un nuevo empleado desde la app.
2. Permite la búsqueda de las citas, presupuestos y ordenes realizadas por cada
empleado a nivel de valorar su productividad.

###  Informes - Listados
1. Permite sumar y mostrar el importe o nivel de ventas realizadas a una
determinada fecha, mostrando el importe antes y después de impuestos.

2. Permite listar los clientes en función de la marca de sus vehículos o localidad a
nivel informativo para posibles campañas de promoción.

###  Comunicaciones
1. Permite enviar notificaciones a clientes concretos, bien sean predeterminadas a
través del uso de filtros, o una notificación totalmente personalizada.
2. Permite enviar un email totalmente personalizado en su asunto y cuerpo de
mensaje a un determinado cliente.






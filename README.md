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


Usabilidad en la parte empleado
----------------------------------


Usabilidad en la parte administrador
----------------------------------





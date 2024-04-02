<?php

/*
Consigna: 
Se desea modelar el comportamiento de un torneo de tenis

- La modalidad del torneo es por eliminacion directa*
- Puede asumir por simplicidad que la cantidad de jugadores es potencia de 2.
- El torneo puede ser Femenino o Masculino
- Cada jugador tiene un nombre y un nivel de habilidad (entre 0 y 100)
- En un enfrentamiento entre dos jugadores influyen el nivel de habilidad y la suerte para decidir al ganador del mismo. Es su decision de diseño que forma incide la suerte en este enfrentamiento.
- En el torneo masculino, se deben considerar la fuerza y la velocidad de desplazamiento como parametros adicionales al momento de calcular al ganador.
- En el torneo femenino, se debe considerar el tiempo de raccion como un parametro adicional al momento de calcular al ganador
- No existen los empates
- Se requiere que a partir de una lista de jugadores se simule el torneo y se obtenga como output al ganador del mismo.
- Se valoraran las buenas practicas de Programacion Orientada a Objetos
- Puede definir por su parte cualquier cuestion que considere en la entrega del ejercicio
- Cualquier extra que aporte sera bienvenido
- Se prefiere el modelado en capas o arquitecturas limpias (Clean Architecture)
- Se prefiere la entrega de la solucion mediante un sistema de versionado (github/bitbucket/etc)

* La eliminacion directa, es un sistema en torneos que consiste en que el perdedor de un encuentro queda inmediatamente eliminado de la competicion, mientras que el ganador avanza a la siguiente fase. Se van jugando rondas y en cada una de ellas se elimina la mitad de participantes hasta dejar un unico competidor que se corona como campeon

Importante: Se prestara especial enfasis en el correcto modelado y aplicacion de buenas practicas de la programacion orientada a objetos

Puntos extra:
Apartado 1: Testing de la solución (Unit Test)
Apartado 2: Api REST (Swagger + Integration Testing)
	- Con base en una lista de jugadores, retorna el resultado del torneo
	- Permite consultar el resultado de los torneos finalizados exitosamente con base en alguno de los siguientes criterios
		- Fecha
		- Torneo Masculino y/o Femenino
		- Otros que usted considere
Apartado 3: Utilizar una base de datos no embebida
Apartado 4: Subir el codigo a un repositorio como GitLab/Github/etc.
Apartado 5: Subir el o los servicios a AWS/Azure/etc utilizando Docker o Kubernetes
*/
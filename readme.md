Proyecto Final: Obras literarias

El sistema Web está diseñado pensanndo en una base de datos para una libreria, la página fue diseñada en PHP puro, PDO y MySQL, siguiendo el patrón MV, con el fin de aplicar operaciones CRUD completas con relaciones entre tablas.

El proyecto cumple con todos los requisitos establecidos, incluyendo la implementación de relaciones entre tablas: 
    -   una relación Uno a Uno (1:1) entre Autores y Biografías. 
    -   una relación Uno a Muchos (1:N) entre Autores y Libros.
    -   una relación Muchos a Muchos (N:M) entre Autores y Géneros. 
    
Además, se desarrolló un CRUD completo para cada entidad (Añadir, editar, eliminar), utilizando una conexión a la base de datos mediante PDO. El sistema está estructurado de forma modular. 


ítems de base de datos:

Autes - Priuncipal: Permite crear, editar y elimianr autores.

    - ![alt text]({D4843DCC-7795-4409-A6A1-67EA83604168}.png)

Libros - (Relación 1:N): Cada Autor puede tener múltiples libros. 
    - ![alt text]({751487E9-FAA7-43F4-AA48-899FC427F37C}.png)

Biografías - (Relación 1:1): Cada autor tiene una sola biografía. 
    - ![alt text]({FD365F12-C709-473C-ADC0-5478304DA747}.png)
Géneros literarios - (Relación N:M) Un género puede tener muchos autores. 
    Gestión y asignación de géneros a autores. 
    - ![alt text]({BC9382DC-60A6-44B6-866F-7275DA0892F1}.png)


# Green Food Marker: Plataforma de Gestión Empresarial  

Este proyecto es un sistema web desarrollado para **Green Food Marker**, una empresa dedicada a la venta de productos alimenticios saludables. El objetivo principal es optimizar y centralizar las operaciones internas de la empresa, ofreciendo una solución eficiente para la gestión empresarial.  

## 🛠️ Funcionalidades principales  
- **Gestión de operaciones**: Registro de ventas, compras y devoluciones.  
- **Administración de clientes**: Creación, consulta y actualización de registros de clientes.  
- **Reportes de ventas**: Generación de reportes detallados para análisis.  
- **Estado financiero**: Cálculo de ganancias y pérdidas en tiempo real.  
- **Pronósticos**: Proyecciones de ventas para apoyo en la toma de decisiones estratégicas.  

## 💻 Tecnologías utilizadas  
- **Backend**: PHP (Arquitectura MVC con DAO para una estructura modular y escalable).  
- **Frontend**: JavaScript, HTML5, CSS3.  
- **Framework de diseño**: Bootstrap para una interfaz de usuario moderna y responsiva.  
- **Base de datos**: MySQL, con integración mediante el patrón DAO para consultas seguras y eficientes.  

## 📂 Estructura del proyecto  
- **Modelo**: Maneja la lógica empresarial y la interacción con la base de datos, estructurada en tres capas:  
  - **Entidades**: Representan objetos del dominio (por ejemplo, `Producto`, `Cliente`).  
  - **Persistencia**: Contiene las clases DAO para la manipulación de datos.  
  - **Negocio**: Maneja la lógica de negocio.  
- **Vista**: Plantillas y componentes de interfaz de usuario diseñados con Bootstrap.  
- **Controlador**: Coordina la comunicación entre el modelo y la vista.  

## 🎯 Objetivo  
Proveer una herramienta completa, flexible y eficiente que permita a **Green Food Marker** mejorar su gestión operativa, tomar decisiones basadas en datos y escalar sus operaciones a futuro.  

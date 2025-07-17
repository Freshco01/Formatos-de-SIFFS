<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registro de modificaciones de productos</title>
  <link rel="stylesheet" href="../CSS/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
</head>

<body>
  <div class="wrap">
    <header>
      <div class="logo-title">
        <img src="../IMG/logo.png" alt="Logo">
        <h1>Solicitud de modificación</h1>
        <a href="../Controller/cerrar.php" class="btn-c">Cerrar sesión</a>
      </div>
    </header>

    <main>
      <section class="card">
        <h2>Datos del solicitante</h2>
        <div class="row">
          <div>
            <label>Nombre del solicitante:</label>
            <input id="solicitante" class="validacion" required>
          </div>
          <div><label>Puesto:</label><input id="puesto" class="validacion" required></div>
          <div><label>Área / Departamento:</label><input id="departamento" class="validacion" required></div>
          <div><label>Fecha de la solicitud:</label><input type="date" id="fecha" class="validacion" required></div>
        </div>
      </section>

      <section class="card">
        <h2>Selecciona un formato</h2>
        <div class="selector">
          <div class="card-format" data-target="f1">1. Alta / Modificación / Desactivación de producto a proveedor SIFFS.</div>
          <div class="card-format" data-target="f2">2. Alta / Modificación / Desactivación de producto SIFFS.</div>
          <div class="card-format" data-target="f3">3. Formato de Solicitud de alta y modificación de usuario en el sistema de información.</div>
          <div class="card-format" data-target="f4">4. Modificación de OC SIFFS CA.</div>
          <div class="card-format" data-target="f5">5. Alta / Modificación / Desactivación de productos a clientes.</div>
          <div class="card-format" data-target="f6">6. Formato Solicitud de Cambio / Requerimiento de Software.</div>
        </div>
      </section>

      <!-- ============================================================= -->
      <!-- ========================== FORMATO 1 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f1">
        <h2>FORMATO DE SOLICITUD DE ALTA, MODIFICACIÓN Y ELIMINACIÓN DE PRODUCTO A PROVEEDOR SIFFS</h2>
        <h3>DATOS DEL PROVEEDOR</h3>
        <div>
          <label>Nombre del Proveedor:</label>
        <input id="f1-prov">
        </div>
        <h3 style="margin-top:25px">PRODUCTO PARA DAR DE ALTA, MODIFICACIÓN O ELIMINACIÓN<br>
          <small>(Si el producto no está registrado en sistema solicitar alta de producto)</small>
        </h3>
        <div class="row">
          <div><label>Clave Producto</label><input id="f1-clave"></div>
          <div><label>Producto</label><input id="f1-prod"></div>
          <div><label>Precio</label><input id="f1-precio" type="number" step="0.01" min="0"></div>
          <div><label>Moneda</label>
            <select id="f1-moneda">
              <option>MX</option>
              <option>USD</option>
            </select></div>
          <div>
            <label>Acción</label>
            <select id="f1-accion">
              <option>Alta</option>
              <option>Modificación</option>
              <option>Eliminación</option>
            </select>
          </div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f1-add">Agregar</button></div>
        </div>
        <div class="table-wrap">
          <table id="f1-table">
            <thead>
              <tr>
                <th>Proveedor</th>
                <th>Clave Producto</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Moneda</th>
                <th>Acción</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div style="text-align:right;margin-top:15px">
          <button class="btn download" data-table="f1-table" data-title="Formato 1 – Prod. a Proveedor">Guardar y
            descargar PDF</button>
        </div>
      </section>


      <!-- ============================================================= -->
      <!-- ========================== FORMATO 2 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f2">
        <h2>FORMATO DE SOLICITUD DE ALTA / MODIFICACIÓN / DESACTIVACIÓN DE PRODUCTO SIFFS.</h2>

        <h3>DATOS GENERALES DEL PRODUCTO</h3>
        <div class="row">
          <div><label>Nombre del producto</label><input id="f2-nombre"></div>
          <div>
            <label>Modificación del producto</label>
            <select id="f2-mod">
              <option>Modificar Producto</option>
              <option>Nuevo Producto</option>
            </select>
          </div>
          <div><label>Presentación</label><input id="f2-pres"></div>
          <div><label>Clave SAT</label><input id="f2-sat" type="number"></div>
        </div>
        <div class="row">
          <div>
            <label>Tipo de Operación</label>
            <select id="f2-tipo">
              <option>Rancho Viejo</option>
              <option>Expor San Antonio</option>
              <option>Compra – Venta</option>
              <option>COMODITIES</option>
              <option>Operaciones discontinuas</option>
              <option>MR LUCKY</option>
              <option>Exportación</option>
              <option>DARK KITCHEN</option>
              <option>MR LUCKY GL</option>
              <option>MAR BRAN</option>
            </select>
          </div>
          <div style="flex:2 1 100%">
            <label>Información adicional</label><textarea id="f2-info"></textarea>
          </div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f2-add">Agregar</button></div>
        </div>

        <div class="table-wrap">
          <table id="f2-table">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Modificación</th>
                <th>Presentación</th>
                <th>Clave SAT</th>
                <th>Tipo Oper.</th>
                <th>Info Adic.</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div style="text-align:right;margin-top:15px">
          <button class="btn download" data-table="f2-table" data-title="Formato 2 – Alta/Mod Producto">Guardar y
            descargar PDF</button>
        </div>
      </section>


      <!-- ============================================================= -->
      <!-- ========================== FORMATO 3 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f3">
        <h2>FORMATO DE SOLICITUD DE ALTA Y MODIFICACIÓN DE USUARIO EN EL SISTEMA DE INFORMACIÓN.</h2>
        <h3>DATOS DEL USUARIO A REGISTRAR</h3>
        <div class="row">
          <div><label>Nombre Completo</label><input id="f3-nombre"></div>
          <div><label>Correo Electrónico</label><input id="f3-correo" type="email"></div>
        </div>
        <div class="row">
          <div><label>Puesto</label><input id="f3-puesto"></div>
          <div><label>Departamento / Área</label><input id="f3-area"></div>
          <div><label>Jefe Inmediato:</label><input id="f3-jefe"></div>
        </div>

        <h3>ACCESO AL SISTEMA</h3>
        <div class="row">
          <div>
            <label>Sistema</label>
            <select id="f3-sistema">
              <option>SIFFS</option>
              <option>SIFFS Almacenes</option>
              <option>CONTPAQi Contabilidad
              <option>CONTPAQi Nóminas</option>
              <option>CONTPAQi Facturación</option>
            </select>
          </div>
          <div style="flex:2 1 100%"><label>Actividades a realizar</label><textarea id="f3-act"></textarea></div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f3-add">Agregar</button></div>
        </div>

        <div class="table-wrap">
          <table id="f3-table">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Área</th>
                <th>Puesto</th>
                <th>Jefe inmediato</th>
                <th>Sistema</th>
                <th>Actividades</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div style="text-align:right;margin-top:15px">
          <button class="btn download" data-table="f3-table" data-title="Formato 3 – Usuarios SIFFS/SIIF">Guardar y
            descargar PDF</button>
        </div>
      </section>


      <!-- ============================================================= -->
      <!-- ========================== FORMATO 4 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f4">
        <h2>FORMATO DE SOLICITUD DE MODIFICACIÓN DE OC SIFFS CA</h2>

        <h3>TIPO DE SOLICITUD</h3>
        <div class="row">
          <div><label>Tipo</label>
            <select id="f4-tipo">
              <option>Actualización de Precio</option>
              <option>Agregar Producto</option>
              <option>Modificar cantidad de Producto</option>
            </select>
          </div>
        </div>

        <h3>INFORMACIÓN DETALLADA</h3>
        <div class="row">
          <div><label>Número de OC</label><input id="f4-oc"></div>
          <div><label>Proveedor</label><input id="f4-prov"></div>
        </div>

        <div class="row">
          <div><button class="btn-clear" id="f4-clear">Limpiar Campos</button></div>
        </div>

        <h3>DETALLE POR PRODUCTO</h3>
        <div class="row">
          <div><label>Cantidad</label><input id="f4-cant" type="number" min="1"></div>
          <div><label>Clave Producto</label><input id="f4-clave"></div>
          <div><label>Producto</label><input id="f4-producto"></div>
          <div><label>Precio Anterior</label><input id="f4-prev" type="number" step="0.01" min="0"></div>
          <div><label>Precio Nuevo</label><input id="f4-new" type="number" step="0.01" min="0"></div>
          <div style="flex:2 1 100%"><label>Justificación</label><textarea id="f4-just"></textarea></div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f4-add">Agregar</button></div>
        </div>

        <div class="table-wrap">
          <table id="f4-table">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>N° OC</th>
                <th>Proveedor</th>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Clave</th>
                <th>Previo</th>
                <th>Nuevo</th>
                <th>Justificación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        

        <div style="text-align:right">
          <button class="btn download" style="margin-top: 10px;" data-table="f4-table" data-title="Formato 4 – Modificación OC">Guardar y
            descargar PDF</button>
        </div>
      </section>


      
      <!-- ============================================================= -->
      <!-- ========================== FORMATO 5 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f5">
        <h2>FORMATO DE ALTA / MODIFICACIÓN / DESACTIVACIÓN DE PRODUCTOS A CLIENTES</h2>

        <h3>TIPO DE SOLICITUD</h3>
        <div class="row">
          <div><label>Tipo</label>
            <select id="f5-tipo">
              <option>Actualización de Precio</option>
              <option>Agregar Producto</option>
            </select>
          </div>
        </div>

        <h3>INFORMACIÓN DETALLADA</h3>
        <div class="row">
          <div><label>Nombre del Cliente</label><input id="f5-cliente"></div>
        </div>
        

        <h3>DETALLE POR PRODUCTO</h3>
        <div class="row">
          <div><label>Clave Producto</label><input id="f5-clave"></div>
          <div><label>Producto</label><input id="f5-producto"></div>
          <div><label>Precio</label><input id="f5-precio" type="number" step="0.01" min="0"></div>
        </div>

        <div class="row">
            <div>
            <label>Tipo de Operación</label>
            <select id="f5-tipo-operacion">
              <option>Rancho Viejo</option>
              <option>Expor San Antonio</option>
              <option>Compra – Venta</option>
              <option>COMODITIES</option>
              <option>Operaciones discontinuas</option>
              <option>MR LUCKY</option>
              <option>Exportación</option>
              <option>DARK KITCHEN</option>
              <option>MR LUCKY GL</option>
              <option>MAR BRAN</option>
            </select>
          </div>
          </div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f5-add">Agregar</button></div>
          
        

        <div class="table-wrap">
          <table id="f5-table">
            <thead>
              <tr>
                <th>Tipo</th>
                <th>Cliente</th>
                <th>Clave</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Operación</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>

        <div style="text-align:right">
          <button class="btn download" style="margin-top: 10px;" data-table="f5-table" data-title="Formato 5 – Alta/Mod Productos Clientes ">Guardar y
            descargar PDF</button>
        </div>
      </section>


      <!-- ============================================================= -->
      <!-- ========================== FORMATO 6 ======================== -->
      <!-- ============================================================= -->
      <section class="formato" id="f6">
        <h2>FORMATO SOLICITUD DE CAMBIO / REQUERIMIENTO DE SOFTWARE</h2>

        <h3>TIPO DE SOLICITUD</h3>
        <div class="row">
          <div><label>Tipo</label>
            <select id="f6-tipo">
              <option>Desarrollo nuevo</option>
              <option>Mantenimiento</option>
            </select>
          </div>
        </div>

        
          <div id="opciones-mantenimiento" classr="row" style="display: none;">
            <label for="mantenimiento-tipo">Plataforma</label>
            <select id="mantenimiento-tipo">
              <option>SIFFS</option>
            </select>
        </div>

        <h3>INFORMACIÓN DETALLADA</h3>
        <div class="row">
          <div><label>Titulo del Cambio</label><input id="f6-cambio" placeholder="Breve descripción del cambio solicitado"></div>
        </div>
        
        <div class="row">
          <div><label>Descripción Detallada</label><textarea id="f6-descripcion" placeholder="Detalle del requerimiento, funcionalidad esperada, etc."></textarea></div>
        </div>

        <div class="row">
          <div><label>Justificación</label><textarea id="f6-justificacion" placeholder="¿Por qué se solicita el cambio? ¿Qué problema resuelve?"></textarea></div>
        </div>

        <div class="row">
          <div><label>Observaciones adicionales</label><textarea id="f6-observacion"></textarea></div>
        </div>
          <div style="align-self:end; display: flex; justify-content: end;"><button class="btn" id="f6-add">Agregar</button></div>
          
        

        <div id="f6-lista" class="card-container">
          
        
        </div>


        <div style="text-align:right">
          <button class="btn download" style="margin-top: 10px;" data-table="f6-table" data-title="Formato 6 – Formato Solicitud de Cambio / Requerimiento">Guardar y
            descargar PDF</button>
        </div>
      </section>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>
<script src="../JS/index.js?v=1.9" type="module"></script>
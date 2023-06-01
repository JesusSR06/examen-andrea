<?php
require_once("vista/parte-superior.php")
    ?>

<?php
include("conexion.php")
    ?>
<link rel="stylesheet" href="tablas.css">
<div class="contenido-superior">
    <h1>Tabla de datos</h1>
</div>
<div class="tabla-container">
    <table class="tabla">
        <caption class="nombre-tabla">Clientes</caption>
        <thead>
            <tr>
                <th class="cabecera">Codigo</th>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Direccion</th>
                <th class="cabecera">Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM clientes";
            $resultados = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_array($resultados)) {
                ?>
                <tr>
                    <td class="dato">
                    <?php echo $filas['id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['nombre'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['direccion'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['telefono'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>

        </tbody>
    </table>
</div>
<div class="tabla-container">
    <table class="tabla">
        <caption class="nombre-tabla">Ordenes de compra</caption>
        <thead>
            <tr>
                <th class="cabecera">Codigo</th>
                <th class="cabecera">Codigo proveedor</th>
                <th class="cabecera">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM ordenescompra";
            $resultados = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_array($resultados)) {
                ?>
                <tr>
                    <td class="dato">
                    <?php echo $filas['id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['proveedor_id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['fecha'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="tabla-container">
    <table class="tabla">
        <caption class="nombre-tabla">Pedidos</caption>
        <thead>
            <tr>
                <th class="cabecera">Codigo</th>
                <th class="cabecera">Codigo cliente</th>
                <th class="cabecera">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM pedidos";
            $resultados = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_array($resultados)) {
                ?>
                <tr>
                    <td class="dato">
                    <?php echo $filas['id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['cliente_id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['fecha'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="tabla-container">
    <table class="tabla">
        <caption class="nombre-tabla">Productos</caption>
        <thead>
            <tr>
                <th class="cabecera">Codigo</th>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Descripcion</th>
                <th class="cabecera">Precio</th>
                <th class="cabecera">Codigo de proveedor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM productos";
            $resultados = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_array($resultados)) {
                ?>
                <tr>
                    <td class="dato">
                    <?php echo $filas['id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['nombre'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['descripcion'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['precio'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['proveedor_id'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="tabla-container">
    <table class="tabla">
        <caption class="nombre-tabla">Proveedores</caption>
        <thead>
            <tr>
                <th class="cabecera">Codigo</th>
                <th class="cabecera">Nombre</th>
                <th class="cabecera">Direccion</th>
                <th class="cabecera">Telefono</th>
           </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM proveedores";
            $resultados = mysqli_query($conexion, $sql);
            while ($filas = mysqli_fetch_array($resultados)) {
                ?>
                <tr>
                    <td class="dato">
                    <?php echo $filas['id'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['nombre'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['direccion'] ?>
                    </td>
                    <td class="dato">
                    <?php echo $filas['telefono'] ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
require_once("vista/parte-inferior.php")
    ?>
<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    try {
        $sql = "SELECT mg.id_geom as id,um.nombre as mina,IF(mg.id_calle>0,IF(mg.id_labor>0,CONCAT(man.coordenada,' ',cal.coordenada,' ',lev.coordenada),CONCAT(man.coordenada,' ',cal.coordenada)),CONCAT(man.coordenada)) as ubicacion, mg.fecha,mg.cutvisual,mg.cusvisual,mg.frente,mg.tipo,mg.observaciones from muestras_geologia mg INNER JOIN ubicaciones_minas um on mg.id_ubicacion=um.id_ubicacion LEFT JOIN mantos man on man.id_manto = mg.id_manto LEFT JOIN calles cal on cal.id_calle= mg.id_calle LEFT JOIN levantes lev on lev.id_levante = mg.id_labor where mg.estado = 1;";
        foreach ($db->query($sql) as $row) {
    ?>
            <tr>
                <td>P-00<?php echo $row['id']; ?></td>
                <td><?php echo $row['mina']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['fecha'])); ?></td>
                <td><?php echo $row['cutvisual']; ?></td>
                <td><?php echo $row['cusvisual']; ?></td>
                <td><?php echo $row['frente']; ?></td>
                <td><?php echo strtoupper($row['tipo']); ?></td>
                <td><?php echo strtoupper($row['observaciones']); ?></td>
                <td align="center"><a href="#" onclick="etiqueta_muestra_geo('<?php echo $row['id']; ?>')"><small class="badge badge-primary">Ticket</small></a></td>
            </tr>
    <?php
        }
    } catch (PDOException $e) {
        echo "Existen problemas con la conexión: " . $e->getMessage();
    }


    //close connection
    $database->close();

    ?>


</tbody>

</table>
<tbody>
    <?php
    include_once('../../conexion.php');

    $database = new Connection();
    $db = $database->open();

    $maxsql = "SELECT MAX(id_equipo) as maxim from lista_equipos";
    foreach ($db->query($maxsql) as $row) {
        $max = $row['maxim'];
    }

    for ($i = 1; $i <= $max; $i++) {

        try {
            $sql = "SELECT DISTINCT le.id_equipo as num ,le.sigla as ID, UPPER(le.nombre) as modelo,te.nombre as tipo, DATE_FORMAT((SELECT fecha FROM mant_equipos where id_equipo = ".$i." order by fecha desc limit 1),'%d-%m-%Y') as fecha,ee.nombre as estado, 'Por Confirmar' as proxman  FROM lista_equipos le LEFT JOIN tipos_equipos te on le.id_tequipo = te.id_tequipo LEFT JOIN mant_equipos me on le.id_equipo = me.id_equipo LEFT JOIN estado_equipos ee on ee.id_est_equipo = me.id_est_equipo WHERE le.id_equipo = ".$i.";";
            foreach ($db->query($sql) as $row) {
    ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['modelo']; ?></td>
                    <td><?php echo $row['tipo']; ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                    <td><?php echo $row['estado']; ?></td>
                    <td> <?php echo $row['proxman']; ?></td>
                    <td align="center">
                        <a href="#" onclick="abrir_mod_taller('<?php echo $row['num']; ?>','<?php echo $row['ID']; ?>');getDetails('<?php echo $row['ID']; ?>','<?php echo $row['num']; ?>','<?php echo $row['modelo']; ?>','<?php echo $row['tipo']; ?>') "><i class="nav-icon far fa-calendar-alt fondo_icono"></i></a>
                    </td>
                    <td align="center">
                        <a href="#" onclick="pdf_ft('<?php echo $row['num']; ?>')"><i class="nav-icon fas fa-file fondo_icono"></i></a>
                    </td>
                </tr>
    <?php
            }
        } catch (PDOException $e) {
            echo "Existen problemas con la conexión: " . $e->getMessage();
        }
    }

    //close connection
    $database->close();

    ?>


</tbody>

</table>
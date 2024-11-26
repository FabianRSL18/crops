<?php
require_once ('../sistema.class.php');
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class Empleado extends Sistema {
    
    function create($data) {
        $result = [];
        $this -> conexion();
        $sql = "INSERT INTO empleado(primer_apellido, segundo_apellido, nombre, rfc, id_usuario, fotografia) VALUES(:primer_apellido, :segundo_apellido, :nombre, :rfc, :id_usuario, :fotografia);";
        $insertar = $this->con->prepare($sql);
        $fotografia = $this -> uploadFoto();
        $insertar->bindParam(':primer_apellido', $data['primer_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':segundo_apellido', $data['segundo_apellido'], PDO::PARAM_STR);
        $insertar->bindParam(':nombre', $data['nombre'], PDO::PARAM_STR);
        $insertar->bindParam(':rfc', $data['rfc'], PDO::PARAM_STR);
        $insertar->bindParam(':id_usuario', $data['id_usuario'], PDO::PARAM_INT);
        $insertar->bindParam(':fotografia', $fotografia, PDO::PARAM_STR);
        $insertar->execute();
        $result = $insertar->rowCount();
        return $result;
    }

    function update($id, $data){
        $this->conexion();
        $result=[];
        $tmp="";
        if($_FILES['fotografia']['error']!=4){
            $fotografia=$this->uploadFoto();
            $tmp="fotografia=:fotografia,";
        }
        $sql = 'UPDATE empleado SET primer_apellido=:primer_apellido, segundo_apellido=:segundo_apellido,nombre=:nombre, rfc=:rfc, '.$tmp.' id_usuario=:id_usuario WHERE id_empleado=:id_empleado';
        $modificar=$this->con->prepare($sql);
        $modificar->bindParam(':primer_apellido',$data['primer_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':segundo_apellido',$data['segundo_apellido'],PDO::PARAM_STR);
        $modificar->bindParam(':nombre',$data['nombre'],PDO::PARAM_STR);
        $modificar->bindParam(':rfc',$data['rfc'],PDO::PARAM_STR);
        if($_FILES['fotografia']['error']!=4){
            $modificar->bindParam(':fotografia',$fotografia,PDO::PARAM_STR);
        }
        $modificar->bindParam(':id_usuario',$data['id_usuario'],PDO::PARAM_INT);
        $modificar->bindParam(':id_empleado',$id,PDO::PARAM_INT);
        $modificar->execute();
        $result=$modificar->rowCount();

        return $result;
    }

    function delete($id) {
        $this->conexion();
        $result = [];
        if (is_numeric($id)) {
            $sql = "DELETE FROM empleado WHERE id_empleado = :id_empleado";
            $borrar = $this->con->prepare($sql);
            $borrar->bindParam(':id_empleado', $id, PDO::PARAM_INT);
            $borrar->execute();
            $result = $borrar->rowCount();
        }
        return $result;
    }

    function readOne($id) {
        $this->conexion();
        $result = [];
        $query = "SELECT * FROM empleado WHERE id_empleado = :id_empleado;";
        $sql = $this->con->prepare($query);
        $sql->bindParam(":id_empleado", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function readAll() {
        $this->conexion();
        $sql = "SELECT e.*, u.correo FROM empleado e JOIN usuario u ON e.id_usuario = u.id_usuario";
        $consulta = $this->con->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    function uploadFoto(){
        $tipos = array("image/jpeg","image/png","image/gif");
        $data = $_FILES['fotografia'];
        $default = "default.png";
        if($data['error'] == 0){
            if($data['size'] <= 1048576){
                if(in_array($data['type'],$tipos)){
                    $n = rand(1,1000000);
                    $nombre = explode('.',$data['name']);
                    $imagen = md5($n.$nombre[0]).".".$nombre[sizeof($nombre)-1];
                    $origen = $data['tmp_name'];
                    $destino = "C:\\wamp64\\www\\crops\\uploads\\".$imagen;
                    if(move_uploaded_file($origen,$destino)){
                        return $imagen;
                    }return $default;
                }
            }
        }
    }

    function reporte($id) {
        require_once '../vendor/autoload.php';
        $this->conexion();
    
        // Consulta para obtener los datos del empleado por ID
        $sql = "SELECT e.*, u.correo FROM empleado e JOIN usuario u ON e.id_usuario = u.id_usuario WHERE e.id_empleado = :id_empleado";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_empleado', $id, PDO::PARAM_INT);
        $consulta->execute();
        $empleado = $consulta->fetch(PDO::FETCH_ASSOC);
    
        if (!$empleado) {
            echo "No se encontró el empleado con ID: $id";
            exit;
        }
    
        try {
            include('../lib/phpqrcode/qrlib.php');
    
            // Generar QR con enlace al reporte individual
            $id_reporte = uniqid();
            $file_name = '../QR/' . $id_reporte . '.png';
            $qr_url = 'http://localhost/crops/admin/empleado.php?accion=actualizar&id=' . $id;
            QRcode::png($qr_url, $file_name, 2, 10, 3);
    
            // Crear contenido HTML para el reporte
            ob_start();
            $content = '
            <html>
                <body>
                    <div style="text-align: center;">
                        <img src="../images/invernadero.png" width="100" alt="Logo">
                        <h1>Reporte Individual de Empleado</h1>
                    </div>
                    <table border="1" style="width: 90%; margin: 0 auto; border-collapse: collapse; text-align: center;">
                        <tr style="background-color: #4CAF50; color: white;">
                            <th style="padding: 10px;">Campo</th>
                            <th style="padding: 10px;">Valor</th>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">Nombre</td>
                            <td style="padding: 8px;">' . htmlspecialchars($empleado['nombre']) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">Primer Apellido</td>
                            <td style="padding: 8px;">' . htmlspecialchars($empleado['primer_apellido']) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">Segundo Apellido</td>
                            <td style="padding: 8px;">' . htmlspecialchars($empleado['segundo_apellido']) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">RFC</td>
                            <td style="padding: 8px;">' . htmlspecialchars($empleado['rfc']) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">Correo</td>
                            <td style="padding: 8px;">' . htmlspecialchars($empleado['correo']) . '</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px;">Fotografía</td>
                            <td style="padding: 8px;">';
            if (!empty($empleado['fotografia'])) {
                $content .= '<img src="../uploads/' . htmlspecialchars($empleado['fotografia']) . '" width="150" height="150" alt="Foto">';
            } else {
                $content .= 'Sin foto';
            }
            $content .= '</td>
                        </tr>
                    </table>
                    <div style="margin-top: 20px; text-align: center;">
                        <h3>Empleado ID: ' . $id . '</h3>
                        <img src="../QR/' . $id_reporte . '.png" width="150" alt="QR Code">
                    </div>
                    <div style="text-align: center; margin-top: 30px; font-size: 0.9em; color: #555;">
                        <p>Empresa XYZ | Dirección: Calle Principal #123, Ciudad, País</p>
                        <p>Contacto: (+123) 456-7890 | Correo: info@empresa.xyz</p>
                        <p>&copy; ' . date("Y") . ' Empresa XYZ. Todos los derechos reservados.</p>
                    </div>
                </body>
            </html>';
    
            // Generar el PDF
            $html2pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'es');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('reporte_empleado_' . $id . '.pdf');
        } catch (Spipu\Html2Pdf\Exception\Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new Spipu\Html2Pdf\Exception\ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
    


}
?>

<?php
require_once ('../sistema.class.php');
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class Seccion extends Sistema{
    function create ($data) {
        $result=[];
        $this -> conexion();
        $sql = "INSERT into seccion(seccion, area, id_invernadero) VALUES(:seccion,:area,:id_invernadero);";
        $insertar = $this -> con -> prepare($sql);
        $insertar -> bindParam(':seccion',$data['seccion'],PDO::PARAM_STR);
        $insertar -> bindParam(':area',$data['area'],PDO::PARAM_INT);
        $insertar -> bindParam(':id_invernadero',$data['id_invernadero'],PDO::PARAM_INT);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }
    
    function update($id, $data) {
        $this->conexion();
        $result=[];
        $sql = "UPDATE seccion SET seccion=:seccion, area=:area, id_invernadero=:id_invernadero WHERE id_seccion=:id_seccion;";
        $modificar = $this->con->prepare($sql);
        $modificar -> bindParam(':id_seccion', $id,PDO::PARAM_INT);
        $modificar -> bindParam(':seccion', $data['seccion'],PDO::PARAM_STR);
        $modificar -> bindParam(':area', $data['area'],PDO::PARAM_INT);
        $modificar -> bindParam(':id_invernadero', $data['id_invernadero'],PDO::PARAM_INT);
        $modificar -> execute();
        $result =$modificar->rowCount();
        return $result;
    }

    function delete($id) {
        $this -> conexion();
        $result=[];
        if(is_numeric($id)){
            $sql = "DELETE from seccion where id_seccion = :id_seccion";
            $borrar = $this -> con -> prepare($sql);
            $borrar -> bindParam(':id_seccion',$id,PDO::PARAM_INT);
            $borrar -> execute();
            $result = $borrar -> rowCount();
        }
        return $result;
    }
    function readOne($id) {
        $this -> conexion();
        $result=[];
        $query = "SELECT * FROM seccion where id_seccion = :id_seccion;";
        $sql = $this -> con ->prepare($query);
        $sql -> bindParam(":id_seccion", $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function readAll(){
        $this -> conexion();
        $result=[];
        $query = "SELECT s.*,i.invernadero FROM seccion s join invernadero i on s.id_invernadero = i.id_invernadero";
        $sql = $this -> con->prepare($query);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function reporte(){
        require_once '../vendor/autoload.php';
        $this -> conexion();
        $sql = 'SELECT * from vista_seccion_invernaderos';
        $consulta = $this->con->prepare($sql);
        $consulta -> execute();
        $data = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        try {
            include('../lib/phpqrcode/qrlib.php'); 
            $id_factura = rand(1,1000);
            $file_name = '../QR/'.$id_factura.'.png';
            QRcode::png('http://localhost/crops/facturas/id_factura/'.$id_factura, $file_name,2,10,3); //no se, tamaño, margen 
            
            ob_start();
            $content = ob_get_clean();
            $content = '
                <html>
                    <body>
                        <div style="text-align: center;">
                            <img src="../images/invernadero.png" width="100" alt="Invernadero">
                            <h1>Reporte de Secciones e Invernaderos</h1>
                        </div>
                        <table border="1" style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
                            <tr style="background-color: #4CAF50; color: white;">
                                <th style="padding: 10px;">Sección</th>
                                <th style="padding: 10px;">Invernadero</th>
                            </tr>';
                            foreach($data as $seccion) {
                                $content .= '<tr>';
                                $content .= '<td style="padding: 8px;">' . $seccion['seccion'] . '</td>';
                                $content .= '<td style="padding: 8px;">' . $seccion['invernaderos'] . '</td>';
                                $content .= '</tr>';
                            }
                $content .= '
                        </table>
                        <div>
                            <h3> Tenemos ';
                            $content.=sizeof($data);
                            $content.='
                                secciones</h3>
                        </div>
                        <div>
                            <img src="../QR/'.$id_factura.'.png" width="200">
                        </div>
                        <div style="text-align: center; margin-top: 30px; font-size: 0.9em; color: #555;">
                            <p>Invernadero XYZ | Dirección: Calle Principal #123, Ciudad, País</p>
                            <p>Contacto: (+123) 456-7890 | Correo: info@invernaderoxyz.com</p>
                            <p>&copy; ' . date("Y") . ' Invernadero XYZ. Todos los derechos reservados.</p>
                        </div>
                    </body>
                </html>';

            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);
            $html2pdf->output('ejemplo.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();

            $formatter = new ExceptionFormatter($e);
            echo $formatter->getHtmlMessage();
        }
    }
        }
?>
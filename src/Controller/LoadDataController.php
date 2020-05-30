<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Empleado;
use App\Entity\Producto;
use App\Entity\Periodo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class LoadDataController extends AbstractController
{
    /**
     * @Route("/load-data", name="load_data")
     */
    public function index()
    {
        //INSERCION DE USUARIOS
        
        $jsonUsuarios = file_get_contents("https://entrepeneur.000webhostapp.com/rest/usuarios.php");
        $dataUsuarios = json_decode($jsonUsuarios, true);

        foreach($dataUsuarios as $row){
            $user = new User();
            $user->setUsername($row["usuario"]);
            $user->setPassword($row["clave"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        }

        // IMPORTAR JSON EMPLEADOS
        /*
        $jsonEmpleados= file_get_contents("https://entrepeneur.000webhostapp.com/rest/empleados.php");
        $dataEmpleados = json_decode($jsonEmpleados, true);

        foreach($dataEmpleados as $row){
            $empleado = new Empleado();
            $empleado->setNombre($row["nombre"]);
            $empleado->setApellido($row["apellido"]);
            $fecha = IntlDateFormatter::NONE($row["fechaNacimiento"]);
            $empleado->setFechaNacimiento($fecha->format('Y-m-d H:i:s'));
            $empleado->setRol($row["rol"]);
            $empleado->setUsuario($row["usuario"]);
            $empleado->setContrasena($row["clave"]);
            $empleado->setIdJefe($row["idJefe"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }
        */

        //IMPORTAR JSON PRODUCTOS
        
        $jsonProductos= file_get_contents("https://entrepeneur.000webhostapp.com/rest/productos.php");
        $dataProductos = json_decode($jsonProductos, true);

        foreach($dataProductos as $row){
            $producto = new Producto();
            $producto->setNombreProducto($row["nombreProducto"]);
            $producto->setDescripcionProducto($row["descripcionProducto"]);
            $producto->setUrlImagen($row["urlImagen"]);
            $producto->setPuntosProducto($row["puntosProducto"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($producto);
            $em->flush(); 
        
        }

        //IMPORTAR JSON PERIODO

        
        $jsonPeriodos= file_get_contents("https://entrepeneur.000webhostapp.com/rest/periodos.php");
        $dataPeriodos = json_decode($jsonPeriodos, true);

        foreach($dataPeriodos as $row){
            $periodo = new Periodo();
            $periodo->setIdPeriodo($row["idPeriodo"]);
            $periodo->setDescripcion($row["descripcion"]);
            $periodo->setMontoBase($row["montoBase"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($periodo);
            $em->flush(); 
        
        }

        return new Response('Se insertaron los JSON');


        return $this->render('load_data/index.html.twig', [
            'controller_name' => 'LoadDataController',
        ]);
    }
}

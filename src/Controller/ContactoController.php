<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\BDPrueba;
use App\Entity\Contacto;

class ContactoController extends AbstractController
{
    private $contactos;
    
    
    public function __construct(BDPrueba $datos)
        {
            $this->contactos = $datos->get();
        }
    
    /*  private $contactos= array(
        array("codigo" => 1, "nombre" => "Juan Pérez",
        "telefono" => "966112233", "email" => "juanp@gmail.com"),
        array("codigo" => 2, "nombre" => "Ana López",
        "telefono" => "965667788", "email" => "anita@hotmail.com"),
        array("codigo" => 3, "nombre" => "Mario Montero",
        "telefono" => "965929190", "email" => "mario.mont@gmail.com"),
        array("codigo" => 4, "nombre" => "Laura Martínez",
        "telefono" => "611223344", "email" => "lm2000@gmail.com"),
        array("codigo" => 5, "nombre" => "Nora Jover",
        "telefono" => "638765432", "email" => "norajover@hotmail.com"),
        );*/

    /**
    * @Route("/contacto/insertar", name="insertar_contacto")
    */
    public function insertar()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contacto = new Contacto();
        $contacto->setNombre("Inserción de prueba");
        $contacto->setTelefono("900110011");
        $contacto->setEmail("insercion.de.prueba@contacto.es");

        $entityManager->persist($contacto);
        $entityManager->flush();

        return new Response("Contacto insertado con id " . $contacto->getId());
    }


    /**
    * @Route("/contacto/{codigo}", name="ficha_contacto",requirements={"codigo"="\d+"})
    */
    public function ficha($codigo = 1)
        {
            $resultado = array_filter($this->contactos,
            function($contacto) use ($codigo)
             {
                 return $contacto["codigo"] == $codigo;
             });
        if (count($resultado) > 0)
             return $this->render('ficha_contacto.html.twig', array(
                    'contacto' => array_shift($resultado)
                        ));
        else
             return $this->render('ficha_contacto.html.twig', array(
                    'contacto' => NULL
                        ));
        /*if (count($resultado) > 0)
            {
                $respuesta = "";
                $resultado = array_shift($resultado);

                $respuesta .= "<ul><li>" . $resultado["nombre"] . "</li>" .
                     "<li>" . $resultado["telefono"] . "</li>" .
                         "<li>" . $resultado["email"] . "</li></ul>";

                return new Response("<html><body>$respuesta</body></html>");
            }
        else
                return new Response("Contacto no encontrado");*/
    }



    /**
    * @Route("/contacto/{texto}", name="buscar_contacto")
    */
    public function buscar($texto)
    {
        $resultado = array_filter($this->contactos,
        function($contacto) use ($texto)
            {
                 return strpos($contacto["nombre"], $texto) !== FALSE;
            });
        return $this->render('lista_contactos.html.twig', array(
                'contactos' => $resultado
                     ));
       /* $respuesta = "";        
        if (count($resultado) > 0)
            {
                foreach ($resultado as $contacto)
                    $respuesta .= "<ul><li>" . $contacto["nombre"] . "</li>" .
                         "<li>" . $contacto["telefono"] . "</li>" .
                             "<li>" . $contacto["email"] . "</li></ul>";

                return new Response("<html><body>" . $respuesta . "</body></html>");
            }
        else
               return new Response("No se han encontrado contactos");*/
    }

    
}


?>
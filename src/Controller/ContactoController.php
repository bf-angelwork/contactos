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
        //fvbfhg

    /**
    * @Route("/contacto/insertar", name="insertar_contacto")
    */
    public function insertar()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $contacto = new Contacto();
        $contacto->setNombre("Luis");
        $contacto->setTelefono("900110011");
        $contacto->setEmail("luis@contacto.es");

        $entityManager->persist($contacto);
        $entityManager->flush();

        return new Response("Contacto insertado con id " . $contacto->getId());
    }

    /**
    * @Route("/contacto/{codigo}", name="ficha_contacto",requirements={"codigo"="\d+"})
    */
    public function ficha($codigo)
    {
        $repositorio =
        $this->getDoctrine()->getRepository(Contacto::class);
        $contacto = $repositorio->find($codigo);

        if ($contacto)
            return $this->render('ficha_contacto.html.twig',
            array('contacto' => $contacto));
        else
            return $this->render('ficha_contacto.html.twig',
            array('contacto' => NULL));
    }
   /* public function ficha($codigo = 1)
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
    }*/



    /**
    * @Route("/contacto/{texto}", name="buscar_contacto")
    */
    public function buscar($texto)
    {
        $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $resultado = $repositorio->findByName($texto);

        return $this->render('lista_contactos.html.twig', array(
        'contactos' => $resultado
        ));
    }
    /*{
        $resultado = array_filter($this->contactos,
        function($contacto) use ($texto)
            {
                 return strpos($contacto["nombre"], $texto) !== FALSE;
            });
        return $this->render('lista_contactos.html.twig', array(
                'contactos' => $resultado
                     ));
    }*/
      
    
    // @Route("/contactoEdad/{codigo}", name="edad_contacto",requirements={"codigo"="\d+"})
    
    /*
    public function buscarMayores($codigo)
    {
      $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $resultado = $repositorio->findByEdadMayorQue($codigo);
        
        return $this->render('lista_contactos.html.twig', array(
        'contactos' => $resultado
        ));
    }*/

    /**
     * @Route("/alterarTelef/{codigo}", name="actualizar_telef")
     */
    public function actualizarTelef($telef){
        
            $entityManager = $this->getDoctrine()->getManager();
            $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
            $contacto = $repositorio->find(1);
            if ($contacto)
            {
                $contacto->setTelefono($telef);
                $entityManager->flush();
                
            }
         
            return $this->render('resultadoCorrecto.html.twig', array(
                'contactos' => $contacto
                ));
    }

    /**
     * @Route("/alterarTelef2/{codigo}/{telef}", name="actualizar_telef2")
     */
    public function actualizarTelef2($codigo,$telef){
        
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Contacto::class);
        $contacto = $repositorio->find($codigo);
        if ($contacto)
        {
            $contacto->setTelefono($telef);
            $entityManager->flush();
            return $this->render('resultadoCorrecto.html.twig', array(
            'contactos' => $contacto
            ));
        }
        else
        return $this->render('ficha_contacto.html.twig',
        array('contacto' => NULL));
       
    }
    
}


?>
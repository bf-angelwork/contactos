<?php
namespace App\Controller;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Psr\Log\LoggerInterface;
    class InicioController extends AbstractController
    {

        private $logger;
        private $formatoFecha;


        public function __construct(LoggerInterface $logger, $formatoFecha)
            {
                $this->logger = $logger;
                $this->formatoFecha = $formatoFecha;
            }

       /**
        * @Route("/", name="inicio")
        */
        public function inicio()
        {
            $fecha_hora = new \DateTime();
            $this->logger->info("Acceso el " .
                $fecha_hora->format($this->formatoFecha));
            return $this->render('inicio.html.twig');
            //return new Response("Bienvenido a la web de contactos");
        }
    }

?>


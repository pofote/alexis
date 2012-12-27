<?php

namespace Pruebas\YoBundle\Events;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


/**
 * Description of NotFound
 *
 * @author Alexis Calatayud <alexiscalatayud@gmail.com>
 */
class Exception {
    
    protected $route;
    
    public function __construct(Router $route) {
        $this->route=$route;
    }

    public function exception(GetResponseForExceptionEvent $event) {
        $exception = $event->getException();
        
        
        if ($exception instanceof NotFoundHttpException) {            
            $response = new RedirectResponse($this->route->generate('not_found'));           
             $event->setResponse($response);
        }
         if ($exception instanceof AccessDeniedException) {            
            $response = new RedirectResponse($this->route->generate('not_pass'));           
             $event->setResponse($response);
        }
        
       
    }

}

?>

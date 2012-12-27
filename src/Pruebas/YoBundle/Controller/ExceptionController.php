<?php

namespace Pruebas\YoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of NotFoundController
 *
 * @author Alexis Calatayud <alexiscalatayud@gmail.com>
 */
class ExceptionController extends Controller {

    public function notFoundAction() {
        return $this->render('YoBundle:Exceptions:notfound.html.twig');
    }
    
    public function notPassAction(){
         return $this->render('YoBundle:Exceptions:notpass.html.twig');
    }

}

?>

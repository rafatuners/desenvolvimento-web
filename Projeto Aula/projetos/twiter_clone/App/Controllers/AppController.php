<?php

namespace App\Controllers;

//os recursos
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

    public function timeline() {        

        $this->validaAutenticacao();

        //recuperação dos tweets
        $tweet = Container::getModel('tweet');

        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweets = $tweet->getALL();            

        $this->view->tweets = $tweets;

        $this->render('timeline');
              
    }

    public function tweet() {        

        $this->validaAutenticacao();
            
        $tweet = Container::getModel('tweet');

        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->__set('id_usuario', $_SESSION['id']);

        $tweet->salvar();

        header('location: /timeline');

        
        
    }

    public function validaAutenticacao() {

        session_start();

        if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['nome'] == '') {
            header('Location: /?login=erro');
        } 

    }

}

?>
<?php

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class ComoComprar extends Conversation
{

    /**
     * creamos un obj consulta, obj consulta contiene objetos botones,
     * preguntamos si la respuesta fue de forma interactiva (en este caso si respondio por botones)
     * y sino le insistimos que responda con botones, si es interactiva leemos el valor de la respuesta 
     * y le damos intrucciones, para href si no usamos target='_blank' se carga la pagina dentro del chat, probar jaja
     */
   
    public function mostrarOpc()
    {
        //creamos una pregunta que contendra botones
        //tener en cuenta que los value tienen que ser diferentes al valor que contienen dentro, sino no lo toma
        $preguntas = Question::create('Opciones de consulta')
        ->addButtons([ //arreglo de los botones de opciones
                Button::create('Cómo realizar una compra')->value('1'),
                Button::create('Libros Disponibles')->value('2'),
                Button::create('Desea realizar un regalo?')->value('3'),
                
            ]);
        $this->ask($preguntas, function ($answer) {
            //pregunta a traves de los botones y el usuario responde
            //isInteractiveMessageReply para detectar si el usuario interactuó con el mensaje e hizo clic en un botón o simplemente ingresó texto.
            if ($answer->isInteractiveMessageReply()) {
                //es valido xq el usuario respondio con los botones
                if ($answer->getValue() == '1') {
                    //
                    $this->say('Para realizar un compra, primero debe Registrarse (para hacerlo <a href= \'#\'> AQUI </a> ) y una vez que esté logueado, podrá realizar su compra');
                } elseif ($answer->getValue() == '2') {
                    $this->say('Consulte nuestros libros disponibles en compra inmediata <a href= \'#\'> AQUI </a>');
                } elseif ($answer->getValue() == '3') {
                    $this->say('Nuestro sistema de regalos es muy efectivo porque ud. con la compra de una gifcard, su agazajad@ puede elegir su libro de interés. Para saber más sobre este sistema, ingrese <a href= \'#\'> AQUI </a>');
                } 
            } else {
                //el usuario no respondio a traves de los botones dados, si queremos leer ambas, solo sacamos la condicion
                $this->say('Seleccione una opción para seguir o si quiere salir ponga "chau"');
                $this->repeat();//se repite esta funcion
            }
        });
    }
   
   
   
   
   
     public function run()
    {
        $this->mostrarOpc();
    }
}

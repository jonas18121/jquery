<?php

require_once 'config/Database.php';
require_once 'tools/tools.php';
require_once 'Model/MessageModel.php';
require_once 'Model/ReponseModel.php';
require_once 'Entity/Message.php';
require_once 'Entity/Reponse.php';

$message_model = new MessageModel();
$reponse_model = new ReponseModel();


if ($_POST) {

    # voir tous les réponses d'un message précis
    if(isset($_POST['id_message']) && !empty($_POST['id_message']))
    {    
        $id_message = (int) $_POST['id_message'];
        $all_reponses = $reponse_model->get_all_reponse($id_message);
        echo json_encode($all_reponses);
    }

    # creer un message
    if(isset($_POST['post_pseudo']) && !empty($_POST['post_pseudo'])){
        if(isset($_POST['post_title']) && !empty($_POST['post_title'])){
            if(isset($_POST['post_content']) && !empty($_POST['post_content'])){

                //pre_var_dump('ok');
                $id         = null;
                $title      = $_POST['post_title'];
                $content    = $_POST['post_content'];
                $adresse_ip = null;
                $pseudo     = $_POST['post_pseudo'];

                $message_model->add_message($id, $title, $content, $adresse_ip, $pseudo);

                $last_message = $message_model->get_last_message();
                echo json_encode($last_message);
            }
        }
    }


}

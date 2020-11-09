<?php

require_once 'config/Database.php';
require_once 'tools/tools.php';
require_once 'Model/MessageModel.php';
require_once 'Model/ReponseModel.php';
require_once 'Entity/Message.php';
require_once 'Entity/Reponse.php';

$message_model = new MessageModel();
$reponse_model = new ReponseModel();

if ($_GET) {
    if(isset($_POST['id_message']) && !empty($_POST['id_message']))
    { 
        $id_message = (int) $_GET['id_message'];
        $one_message = $message_model->get_one_message($id_message);
        echo json_encode($one_message);
    }

}


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
                $title      = trim(strip_tags($_POST['post_title']));
                $content    = trim(strip_tags($_POST['post_content']));
                $adresse_ip = trim(strip_tags($_SERVER['REMOTE_ADDR']));
                $pseudo     = trim(strip_tags($_POST['post_pseudo']));

                $message_model->add_message($id, $title, $content, $adresse_ip, $pseudo);

                $last_message = $message_model->get_last_message();
                echo json_encode($last_message);
            }
        }
    }

    # ajout like ou no like
    if(isset($_POST['id_message_id']) && !empty($_POST['id_message_id'])){
        $id_message = (int) $_POST['id_message_id'];

        if(isset($_POST['yes_like']) && !empty($_POST['yes_like'])){

            $yes_like = $_POST['yes_like'];
            $message_model->like($id_message, $yes_like);
            $one_message = $message_model->get_one_message($id_message);
            echo json_encode($one_message);
        }
        
        if(isset($_POST['like_no']) && !empty($_POST['like_no'])){

            $no_like = $_POST['like_no'];
            $message_model->no_like($id_message, $no_like);
            $one_message = $message_model->get_one_message($id_message);
            echo json_encode($one_message);
        }
    }

    if(isset($_POST['add_reponse'])){
        $id_message = (int) $_POST['id_message'];

        if(isset($_POST['pseudo']) && empty($_POST['pseudo'])){
            header_location('template/message/get_one_message.phtml?id_message=' . $id_message . '&error=pseudo');
        }
        if(isset($_POST['content']) && empty($_POST['content'])){
            header_location('template/message/get_one_message.phtml?id_message=' . $id_message . '&error=content');
        }

        $id         = null;
        $pseudo     = trim(strip_tags($_POST['pseudo']));
        $content    = trim(strip_tags($_POST['content']));
        $adresse_ip = trim(strip_tags($_SERVER['REMOTE_ADDR']));
        // $id_message = (int) $_POST['id_message'];

        $reponse_model->add_reponse($id, $pseudo, $content, $adresse_ip, $id_message);
        header_location('template/message/get_one_message.phtml?id_message=' . $id_message . '&success=create_reponse');
           
        
    }

}

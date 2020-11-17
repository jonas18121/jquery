<?php

require_once 'config/Database.php';
require_once 'tools/tools.php';

require_once 'Model/MessageModel.php';
require_once 'Model/ReponseModel.php';
require_once 'Model/LikeDislikeModel.php';

require_once 'Entity/Message.php';
require_once 'Entity/Reponse.php';
require_once 'Entity/LikeDislike.php';

$message_model      = new MessageModel();
$reponse_model      = new ReponseModel();
$like_dislike_model = new LikeDislikeModel();

// $message_entity = new Message(); 

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
                $content    = trim(addslashes($_POST['post_content']));
                $adresse_ip = trim(strip_tags($_SERVER['REMOTE_ADDR']));
                //$adresse_ip = null;
                $pseudo     = trim(strip_tags($_POST['post_pseudo']));

                $message_model->add_message($id, $title, $content, $adresse_ip, $pseudo);

                $last_message = $message_model->get_last_message();
                echo json_encode($last_message);
            }
        }
    }

    # ajouter une reponse
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


    # ajout like ou no like
    if(isset($_POST['id_message_id']) && !empty($_POST['id_message_id'])){
        
        $id_message = (int) $_POST['id_message_id'];

        if(isset($_POST['value_like']) && !empty($_POST['value_like'])){

            $value = intval($_POST['value_like']);

            // $_SERVER['REMOTE_ADDR']
            [$search_like_bool, $search_like] = $message_model->search_like($_SERVER['REMOTE_ADDR'], $id_message);
            $like_or_dislike = 1;

            // pre_var_dump($search_like_bool, null, true);

            if (!$search_like_bool) {

                if ($search_like->get_yes_like() === null || $search_like->get_yes_like() == 0 && $search_like->get_no_like() === null || $search_like->get_no_like() == 0) {

                    if ($value == 1 ) {
                        $message_model->like($id_message, $like_or_dislike);
                    }
                    elseif ($value == -1 ) {

                        $message_model->no_like($id_message, $like_or_dislike);
                    }
                    $id = null;
                    $like_dislike_model->add_bind_user_like($id, $_SERVER['REMOTE_ADDR'], $id_message);

                    $new_like = $message_model->get_one_message($id_message);
                    echo json_encode($new_like);
                }
            }
            else {

                /**
                 * s'il y a un like en commun , entre l'adresse ip et le message, on annule le like ou le dislike
                 * et on supprime le lien dans le tableau user
                */ 

                if ($value == 1 && $search_like->get_no_like() == 0 || $search_like->get_no_like() === null) {

                    $message_model->cancel_like($id_message, $like_or_dislike);
                    $id_bind_user_like = $like_dislike_model->get_one_bind_user_like($_SERVER['REMOTE_ADDR'], $id_message);
                    $like_dislike_model->delete_bind_user_like($id_bind_user_like->get_id());
                }
                elseif ($value == -1 && $search_like->get_yes_like() == 0 || $search_like->get_yes_like() === null) {

                    $message_model->cancel_no_like($id_message, $like_or_dislike);
                    $id_bind_user_like = $like_dislike_model->get_one_bind_user_like($_SERVER['REMOTE_ADDR'], $id_message);
                    $like_dislike_model->delete_bind_user_like($id_bind_user_like->get_id());
                }

                $new_like = $message_model->get_one_message($id_message);
                echo json_encode($new_like);
            }
        }
    }

    
}




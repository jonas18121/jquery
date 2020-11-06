<?php

require_once 'config/Database.php';
require_once 'tools/tools.php';
require_once 'Model/MessageModel.php';
require_once 'Model/ReponseModel.php';
require_once 'Entity/Message.php';
require_once 'Entity/Reponse.php';

$message_model = new MessageModel();
$reponse_model = new ReponseModel();

pre_var_dump($id_message,null,true);

if ($_POST) {
    if(isset($_POST['id_message']) && !empty($_POST['id_message'])){

        $id_message = (int) $_POST['id_message'];
        //pre_var_dump($id_message,null,true);
        $all_reponses = $reponse_model->get_all_reponse($id_message);
        //pre_var_dump($all_reponses, null, true);
        echo json_encode($all_reponses);
    }
}

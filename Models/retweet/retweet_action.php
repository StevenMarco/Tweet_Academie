<?php
require '../../Models/db_connect.php';

session_start(); // modif
    $get_id = (int) $_REQUEST['id']; // modif 
    $get_retweet = (int) $_REQUEST['retweet']; // modif

    $check = $db->prepare('SELECT * FROM tweet WHERE id = ?');
    $check->execute(array($get_id));

    //echo $check->rowCount();
    if($check->rowCount() == 1)
    {
        if($get_retweet == 1)
        {
            // session_start();
            $check_retweet = $db->prepare('SELECT * FROM retweet WHERE tweet_id = ? AND users_id = ?');
            $check_retweet->execute(array($get_id, $_SESSION['id']));
            if($check_retweet->rowCount() == 1)
            {
                $delete_retweet = $db->prepare('DELETE FROM retweet WHERE tweet_id = ? AND users_id = ?');
                $delete_retweet->execute(array($get_id, $_SESSION['id']));
            }
            else
            {                
                $insert = $db->prepare('INSERT INTO retweet (tweet_id, users_id) VALUES(?,?)');
                $insert->execute(array($get_id, $_SESSION['id']));
            }
        }
    }
?>
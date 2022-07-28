<?php
require '../../Models/db_connect.php';
sleep(2); // effet de chargement

//echo "je suis lla !!!";

$content = htmlspecialchars($_POST['content']);
$url = $_FILES['url'];

if(isset($_FILES['url'], $content) AND (!empty($_FILES['url']['name']) AND !empty($content)) AND ($_FILES['url']['name'] !== " " AND $content !== " "))
{

    // Hashtags
    $hashtg = strpos($content,"#");

    $k = strstr($content,"#");
    $space = strpos($k,' ');
    $hash = strpos($k,"#");
    $z = substr($k,$hash,$space);
    
    $bird = "SELECT * FROM hashtag WHERE tag = '$z'";
    $go =  $db-> query($bird);
    $go = $go->rowCount();

    /* interdiction */
    $insultes_content = array("pute", "connard", "salope", "merde", "enculé", "encule", "prostitué");     
    $tableau = explode(' ', $content);
    foreach($tableau as $mot)
    {
       if (in_array($mot, $insultes_content))
       {
            echo '<span style="color:red">Le mot '.$mot.' n\'est pas autorisé !.</span><br>';
            return false;
       }
     
    }

    $insultes = array("#pute", "#connard", "#salope", "#merde", "#enculé", "#encule", "#prostitué");     
    $tableau = explode(' ', $z);
    foreach($tableau as $mot)
    {
       if (in_array($mot, $insultes))
       {
            echo '<span style="color:red">Le Hashtag '.$mot.' n\'est pas autorisé !.</span><br>';
            return false;
       }
     
    }

    /* insert or update tag*/
    if(stripos($z, '#') !== FALSE)
    {
        if ($go == 0) {
            $life = $db->query("INSERT INTO hashtag (tag) VALUES ('$z')");       
        }
        if($go == 1){
            $death = $db->query("UPDATE hashtag SET nbr_use = nbr_use +1 WHERE tag = '$z'");
        }
    }

    // Upload image
    session_start();
    $tailleMax = 2097152;
    $extensionsValides = array('jpg','jpeg','gif','png');
    if($_FILES['url']['size']<= $tailleMax)
    {
        $extensionUpload = strtolower(substr(strrchr($_FILES['url']['name'], '.'), 1)); 

        if(in_array($extensionUpload, $extensionsValides))
        {
            $bytes_random = random_int(1, 999999);
            $path = "../membres/imgTweet/".$bytes_random.".".$extensionUpload;
            $result = move_uploaded_file($_FILES['url']['tmp_name'],$path);

                    if($result)
                    {      
                       // session_start();
                        $erreur = $path;               
                        $req = $db->prepare("INSERT INTO tweet(content, url_picture, users_id) VALUES(?,?,?)");
                        $req->execute(array($content, $path, $_SESSION['id']));
                        
                        $allComment = $db->prepare("SELECT * FROM users LEFT JOIN tweet ON users.id = tweet.users_id WHERE content != 'NULL' ORDER BY tweet.id DESC;");
                        $allComment->execute();
                        $reponse=$allComment->fetch(PDO::FETCH_OBJ);
                        ?>
                            <div class="comment-item">
                                <p>
                                    <b><?= $reponse->username;?> (<?= $reponse->date; ?>) <p hidden><?= $reponse->id; ?></p>
                                    </b>    
                                    <p><?= $reponse->content; ?></p>
                                    <?php
                                        if($reponse->url_picture != NULL)
                                        {           
                                        ?>
                                            <a href="<?=$reponse->url_picture;?>"><p>picture link:</p></a>
                                            <img src="<?=$reponse->url_picture;?>" alt="">
                                        <?php
                                        }
                                    ?>
                                </p>
                                <?php
                                    $likes = $db->prepare("SELECT id FROM tweet_like WHERE tweet_id = ?;");
                                    $likes->execute(array($reponse->id));
                                    $likes = $likes->rowCount(); // essayer de bouger du template vers models 
                                ?>
                                <?php
                                    $comments_count = $db->prepare("SELECT id FROM comments WHERE tweet_id = ?;");
                                    $comments_count->execute(array($reponse->id));
                                    $comments_count = $comments_count->rowCount(); // essayer de bouger du template vers models 
                                ?>
                                <span class="likes" onclick="like_update('<?=$reponse->id?>')"><img class="svg-light" src="../membres/icone/heart_plein.png" alt="heart for like"> (<span id="like_loop_<?=$reponse->id?>"><?=$likes?></span>)</span>
                                <a class="a_none" href="../comments.php?id=<?=$reponse->id?>">
                                    <img class="svg-light" src="../membres/icone/comments.png" alt="comment icone">
                                    <span>(<?=$comments_count?>)</span>
                                </a>
                            </div>
                        <?php
                    }
                    else
                    {
                        $erreur = "An Error occured during the importation of the picture";
                    }
        }
        else
        {
            $erreur = "Your Picture must be a jpg, jpeg, gif, png file.";
        }
    }
    else
    {
        $erreur = "Your Picture do not have the correct size (2Mo).";
    }
}



if(isset($content) AND !empty($content) AND empty($_FILES['url']['name']))
{
    // set Hashtags
    $hashtg = strpos($content,"#");

    $k = strstr($content,"#");
    $space = strpos($k,' ');
    $hash = strpos($k,"#");
    $z = substr($k,$hash,$space);

    $bird = "SELECT * FROM hashtag WHERE tag = '$z'";
    $go =  $db-> query($bird);
    $go = $go->rowCount();

    /* interdiction */
    $insultes_content = array("pute", "connard", "salope", "merde", "enculé", "encule", "prostitué");     
    $tableau = explode(' ', $content);
    foreach($tableau as $mot)
    {
       if (in_array($mot, $insultes_content))
       {
            echo '<span style="color:red">Le mot '.$mot.' n\'est pas autorisé !.</span><br>';
            return false;
       }
     
    }
    $insultes = array("#pute", "#connard", "#salope", "#merde", "#enculé", "#encule", "#prostitué");     
    $tableau = explode(' ', $z);
    foreach($tableau as $mot)
    {
        if (in_array($mot, $insultes))
        {
            echo '<span style="color:red">Le Hashtag '.$mot.' n\'est pas autorisé !.</span><br>';
            return false;
        }
        
    }
    
    
    /* insert or update tag */
    if(stripos($z, '#') !== FALSE)
    {
        if ($go == 0) {
            $life = $db->query("INSERT INTO hashtag (tag) VALUES ('$z')");       
        }
        if($go == 1){
            $death = $db->query("UPDATE hashtag SET nbr_use = nbr_use +1 WHERE tag = '$z'");
        }
    }

    // set hashtags
    session_start();
    $saveData = $db->prepare("INSERT INTO tweet (content, users_id) VALUES (?,?);");
    $saveData->execute(array($content,$_SESSION['id'])); // remplace $username par $_SESSION['id']

    $allComment = $db->prepare("SELECT * FROM users LEFT JOIN tweet ON users.id = tweet.users_id WHERE content != 'NULL' ORDER BY tweet.id DESC;");
    $allComment->execute();
    $reponse=$allComment->fetch(PDO::FETCH_OBJ);
    ?>
        <div class="comment-item">
            <p>
                <b><?= $reponse->username;?> (<?= $reponse->date; ?>) <p hidden><?= $reponse->id; ?></p>
                </b>    
                <p><?= $reponse->content; ?></p>
                <?php
                    if($reponse->url_picture != NULL)
                    {           
                    ?>
                        <a href="<?=$reponse->url_picture;?>"><p>picture link:</p></a>
                        <img src="<?=$reponse->url_picture;?>" alt="">
                    <?php
                    }
                ?>
            </p>
            
            <?php
                $likes = $db->prepare("SELECT id FROM tweet_like WHERE tweet_id = ?;");
                $likes->execute(array($reponse->id));
                $likes = $likes->rowCount(); // essayer de bouger du template vers models 
            ?>
            <?php
                $comments_count = $db->prepare("SELECT id FROM comments WHERE tweet_id = ?;");
                $comments_count->execute(array($reponse->id));
                $comments_count = $comments_count->rowCount(); // essayer de bouger du template vers models 
            ?>
            <span class="likes" onclick="like_update('<?=$reponse->id?>')"><img class="svg-light" src="../membres/icone/heart_plein.png" alt="heart for like"> (<span id="like_loop_<?=$reponse->id?>"><?=$likes?></span>)</span>
            <a class="a_none" href="../comments.php?id=<?=$reponse->id?>">
                <img class="svg-light" src="../membres/icone/comments.png" alt="comment icone">
                <span>(<?=$comments_count?>)</span>
            </a>
        </div>
    <?php
}
?>



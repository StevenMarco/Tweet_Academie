<?php

$search = htmlspecialchars($_POST['search']);

if(isset($search) AND !empty($search))
{
    require('../../Models/db_connect.php');
    $sqlSearch = $db->query("SELECT * FROM users LEFT JOIN tweet ON users.id = tweet.users_id WHERE content != 'NULL' AND content LIKE '%$search%' ORDER BY tweet.id DESC;");
    
    if($sqlSearch->rowCount() > 0)
    {
        while($reponse = $sqlSearch->fetch(PDO::FETCH_OBJ))
        {
            ?>
                <div class="comment-item">
                    <p>
                        <b><?= $reponse->username;?> (<?= $reponse->date; ?>) <p hidden><?= $reponse->id; ?></p>
                        </b>    
                        <p><?= $reponse->content; ?></p>
                        <?php
                            if($reponse->url_picture != null)
                            {           
                            ?>
                                <a href="<?=$reponse->url_picture;?>"><p>picture link:</p></a>
                                <img class="set_tweet_picture" src="<?=$reponse->url_picture;?>" alt="">
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
    }
    else
    {
        ?>
        <p>Aucun résultat trouvé</p>
        <?php
    }
}
else
{
    ?>
    <p>Aucun résultat trouvé</p>
    <?php
}
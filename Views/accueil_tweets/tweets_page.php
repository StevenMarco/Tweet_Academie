<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_tweet.css">
<!-- 
    <link rel="stylesheet" href="Skeleton-2.0.4/css/normalize.css">
    <link rel="stylesheet" href="Skeleton-2.0.4/css/skeleton.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>    
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous">
    </script>
    <script text="text/javascript" src="coore_tweets.js"></script>
    <title>tweet_academie</title>
</head>
<body>
        <!-- <h4>Tweets</h4> -->
        <!-- <p class="test">testestetestetstes</p> -->

            <p id="dateheure"></p>


            <form enctype="multipart/form-data" method="POST" id="tkt" class="tweets-form">
                <textarea type="text" name="content" id="content" placeholder="content..." cols="80" rows="3" maxlength = "140" required></textarea>
                    <br>
                <label for="url"><img class="svg url_picture" src="../membres/icone/pictures.png" alt="tweet icone"></label>
                <input type="file" name="url" id="url">
                <button class="nav-boutton">
                    <img class="form-loader" src="assets/Spinner-1s-200px.gif" width="20px" alt="chargement" hidden>
                    <span class="tweets_status"><img class="svg" src="../membres/icone/flap.png" alt="tweet icone"> Tweeter</span>
                </button>
            </form>

            <div class="container">
                <div class="row">
                    <div class="col order-first">
                    <h5>Navigations :</h5>
                    <!--partie code -->
                        <nav class="nav flex-column">
                            <?php
                                if(isset($_SESSION['id']) && $_GET['id'] == $_SESSION['id'])
                                {
                                    ?>
                                    <div class="nav-boutton">
                                        <a class="nav-link" aria-current="page" href="tweet_control.php?id=<?=$_SESSION['id']?>">
                                            <img class="svg" src="../membres/icone/home.png" alt="accueil icone">
                                            <span class="nav-link-text">Home</span>
                                        </a>
                                    </div>
                                        <br>
                                    <div class="nav-boutton">
                                        </a>
                                        <a class="nav-link" href="../My_profil.php?id=<?=$_SESSION['id']?>">
                                            <img class="svg" src="../membres/icone/utilisateur.png" alt="profil icone">
                                            <span class="nav-link-text">Profil</span>
                                        </a>
                                    </div>
                                        <br>
                                    <div class="nav-boutton">
                                        <a class="nav-link" href="../deconnexion.php">
                                            <img class="svg" src="../membres/icone/exit.png" alt="exit icone">
                                            <span class="nav-link-text">Exit</span>
                                        </a>
                                    </div>
                                        <br>
                                    <div class="nav-boutton">
                                        <a class="nav-link" href="../private_message.php?id=<?=$_SESSION['id']?>">
                                            <img class="svg" src="../membres/icone/enveloppe.png" alt="message icone">
                                            <span class="nav-link-text">Messages</span>
                                        </a>
                                    </div>
                                        <br>
                                        <!-- <div id="dateTimeIsIt"> -->
                                            <div class="nav-boutton" id="dateTimeIsIt" onclick="afficherDate()">
                                                <img class="svg" src="../membres/icone/horloge.png" alt="message icone">
                                                <span class="nav-link-text">Afficher l'heure</span>
                                            </div>
                                        <!-- </div> -->
                                    <?php
                                }
                                else
                                {
                                    header('Location: ../../routeur.php');
                                    ?>
                                        <a class="nav-link" href="connexion.php">Connexion</a>
                                    <?php
                                }
                                ?>
                            <!-- <a class="nav-link active" aria-current="page" href="#">Active</a>
                            <a class="nav-link" href="#">Link</a>
                            <a class="nav-link" href="#">Link</a> -->
                            <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
                        </nav>
                    <!--fin partie code -->
                    </div>
                    <div class="col">
                        <br>
                        <!--partie code -->
                        <!-- <h5>Tweets :</h5> -->
                        <div class="tweets">
                            <?php
                            while($reponse=$allComment->fetch(PDO::FETCH_OBJ))
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
                                        <?php
                                        $retweet = $db->prepare("SELECT id FROM retweet WHERE tweet_id = ?;");
                                        $retweet->execute(array($reponse->id));
                                        $retweet = $retweet->rowCount(); // essayer de bouger du template vers models 
                                        ?>
                                    <span class="likes" onclick="like_update('<?=$reponse->id?>')"><img class="svg-light" src="../membres/icone/heart_plein.png" alt="heart for like"> (<span id="like_loop_<?=$reponse->id?>"><?=$likes?></span>)</span>
                                    <a class="a_none" href="../comments.php?id=<?=$reponse->id?>">
                                        <img class="svg-light" src="../membres/icone/comments.png" alt="comment icone">
                                        <span>(<?=$comments_count?>)</span>
                                    </a>
                                    <span class="retweet" onclick="retweet_update('<?=$reponse->id?>')"><img class="svg-light" src="../membres/icone/retweet.png" alt="heart for like"> (<span id="retweet_loop_<?=$reponse->id?>"><?=$retweet?></span>)</span>
                                </div>
                            <?php
                            };
                            ?>
                        </div>
                    <!--fin partie code -->
                    </div>
                    <div class="col order-last">
                        <h5>hashtag les plus populaires :</h5>
                        <form method="GET" id="search_tag" action="http://localhost/W-WEB-090-NCE-1-1-academie-thomas.schippers/Models/accueil_tweets/search_tag.php">
                            <div class="input-group">
                                <input type="search" name="search" id="search_bar" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <button type="submit" class="btn btn-outline-primary">search</button>
                            </div>
                        </form>
                        <div id="result_search"></div>    
                        <?php
                            $hashtags = $db->query("SELECT * FROM hashtag ORDER BY nbr_use DESC");
                            $hashes = $hashtags->fetchAll();
                            foreach($hashes as $hashe)
                            {
                                ?>
                                    <a href="hashtag.php?tag='.$hashe['tag'].'"><?=$hashe['tag']?>(<?=$hashe['nbr_use']?>)</a><br/>
                                <?php
                                /* modif get lien + faire le new page */
                            }                  
                        ?>
                    </div>
                </div>
            </div>
    <script>
        function like_update(id)
        {
            $.ajax({
                url: '../../Models/likes/likes_action.php',
                type: 'POST',
                data: {
                    id: id,
                    like: 1
                },
                success: function(data)
                {
                    console.log("success add_like");
                    $.ajax({
                        url: '../../Models/likes/likes_number.php',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(response)
                        {
                            console.log("success NBR likes with " + response);
                            console.log(id);
                            $("#like_loop_"+ id).html(response);
                        }
                    })
                }
            });
        }

        function retweet_update(id)
        {
            $.ajax({
                url: '../../Models/retweet/retweet_action.php',
                type: 'POST',
                data: {
                    id: id,
                    retweet: 1
                },
                success: function(data)
                {
                    console.log("success add_retweet");
                    $.ajax({
                        url: '../../Models/retweet/retweet_number.php',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(response)
                        {
                            console.log("success NBR retweets with " + response);
                            console.log(id);
                            $("#retweet_loop_"+ id).html(response);
                        }
                    })
                }
            });
        }

        function afficherDate() 
        {
            let cejour = new Date();
            let options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
            let date = cejour.toLocaleDateString("fr-FR", options);
            let heure = ("0" + cejour.getHours()).slice(-2) + ":" + ("0" + cejour.getMinutes()).slice(-2) + ":" + ("0" + cejour.getSeconds()).slice(-2);
            let dateheure = date + " " + heure;
            dateheure = dateheure.replace(/(^\w{1})|(\s+\w{1})/g, lettre => lettre.toUpperCase());
            document.getElementById('dateheure').innerHTML = dateheure;
            setInterval(afficherDate, 1000);
        }
    </script>
</body>
</html>
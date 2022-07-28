console.log('Loadiiing core_tweets.js');

$(document).ready(() =>
{
    $("#tkt").on('submit', function(e)
    {
        e.preventDefault();        
        //let url = '../Controllers/tweets/save_tweets.php';
        let url = 'http://localhost/W-WEB-090-NCE-1-1-academie-thomas.schippers/Controllers/tweets/save_tweets.php';
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (reponse) {
        
            $('.form-loader').hide();
            $('.tweets_status').html("<img class='svg' src='../membres/icone/flap.png' alt='tweet icone'> Tweeter"); 
            $('#url,#content').val(''); 

            $('.tweets').prepend(reponse);
            }
        });
        $('.form-loader').show();
        $('.tweets_status').text("En cours d'envoi...");
    })

    $("#search_tag").on('submit', function(e)
    {
        e.preventDefault();        
        //let url = '../Controllers/tweets/save_tweets.php';
        let url = 'http://localhost/W-WEB-090-NCE-1-1-academie-thomas.schippers/Models/accueil_tweets/search_tag.php';
        var formData = new FormData($(this)[0]);

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            success: function (reponse) {
        
            $('#search_bar').val(''); 
            $('.tweets').html(reponse);
            }
        });
    });

    function afficherDate() 
    {
        let cejour = new Date();
        let options = {weekday: "long", year: "numeric", month: "long", day: "2-digit"};
        let date = cejour.toLocaleDateString("fr-FR", options);
        let heure = ("0" + cejour.getHours()).slice(-2) + ":" + ("0" + cejour.getMinutes()).slice(-2) + ":" + ("0" + cejour.getSeconds()).slice(-2);
        let dateheure = date + " " + heure;
        dateheure = dateheure.replace(/(^\w{1})|(\s+\w{1})/g, lettre => lettre.toUpperCase());
        document.getElementById('dateheure').innerHTML = dateheure;
    }
    function afficher()
    {
        setInterval(afficherDate, 1000);
    }
});

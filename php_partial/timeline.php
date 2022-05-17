<?php

// start buffering
ob_start();
$title = "Fakebook - fil d'actualité";

require_once "../database/pdo.php";
$user_id = $_SESSION["user"]["user_id"];
$user_name = $_SESSION["user"]["first_name"] . " " . $_SESSION["user"]["last_name"];

// getting all articles
$maRequete = $pdo->prepare("SELECT * FROM `articles` ORDER BY `date` DESC"); // add condition for relationship
    $maRequete->execute();
    $articles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// getting all active accounts
$maRequete = $pdo->prepare("SELECT `user_id`, `profil_picture`, `first_name`, `last_name`, `status` FROM `users` WHERE `status` = 'active'"); // add condition for relationship
    $maRequete->execute();
    $profiles = $maRequete->fetchAll(PDO::FETCH_ASSOC);

// getting likes
$maRequete = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = :userId");
    $maRequete->execute([
        ":userId" => $user_id
    ]);
    $user_likes = $maRequete->fetchAll(PDO::FETCH_ASSOC);
    $like = "like";

// looking for the user's friends
$maRequete = $pdo->prepare("SELECT `user_id_a`, `user_id_b`, `status`, `blocked` FROM `relationships` WHERE (`user_id_b` = :userId OR `user_id_a` = :userId) AND `status`='approved';");
	$maRequete->execute([
		":userId" => $_SESSION["user"]["user_id"]
	]);
$profile_friends = $maRequete->fetchAll(PDO::FETCH_ASSOC);




// getting all followed pages (cette requête fonctionne)
$maRequete = $pdo->prepare("SELECT `page_id`, `name`, `picture` FROM `pages` WHERE `page_id` IN (SELECT `page_id` FROM `followers` WHERE `user_id` = :userId);");
	$maRequete->execute([
		":userId" => $user_id
	]);
$followed_pages = $maRequete->fetchAll(PDO::FETCH_ASSOC);

var_dump($followed_pages);












require_once __DIR__ . "/../html_partial/timeline.php";
// clean buffering in $content
$content = ob_get_clean();

?>
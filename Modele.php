<?php

// Renvoie la liste des tickets du blog
function getTickets() {
    $bdd = getBdd();
    $tickets = $bdd->query('SELECT TIC_ID as id, TIC_DATE as date, TIC_TITRE as titre, TIC_CONTENU as contenu, T_ETAT.ET_LIB as etat 
    FROM T_TICKET 
    INNER JOIN T_ETAT 
    ON T_ETAT.ET_ID = T_TICKET.ET_ID;');
    return $tickets;
}

// Renvoie les informations sur un ticket
function getTicket($idTicket) {
    $bdd = getBdd();
    $ticket = $bdd->prepare('SELECT TIC_ID as id, TIC_DATE as date, TIC_TITRE as titre, TIC_CONTENU as contenu from T_TICKET where TIC_ID=?');
    $ticket->execute(array($idTicket));
    if ($ticket->rowCount() > 0)
        return $ticket->fetch();  // Accès à la première ligne de résultat
    else
        throw new Exception("Aucun ticket ne correspond à l'identifiant '$idTicket'");
}

// Renvoie la liste des commentaires associés à un ticket
function getCommentaires($idTicket) {
    $bdd = getBdd();
    $commentaires = $bdd->prepare('SELECT COM_ID as id, COM_DATE as date, COM_AUTEUR as auteur, COM_CONTENU as contenu from T_COMMENTAIRE where TIC_ID=?');
    $commentaires->execute(array($idTicket));
    return $commentaires;
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd() {
    $bdd = new PDO('mysql:host=localhost;dbname=ticketing;charset=utf8', 
    'ticketing_user', '20022708m', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}
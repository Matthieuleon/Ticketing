<?php $titre = 'Ticketing'; ?>

<?php ob_start(); ?>
<?php foreach ($tickets as $ticket): ?>
    <article>
        <header>
            <a href="<?= "ticket.php?id=" . $ticket['id'] ?>">
                <h1 class="titreTicket"><?= $ticket['titre'] ?></h1>
            </a>
            <time><?= $ticket['date'] ?></time>
        </header>
        <p><?= $ticket['contenu'] ?></p>
        <p> Etat du ticket : <?= $ticket['etat']?></p>
    </article>
    <hr />
<?php endforeach; ?>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>
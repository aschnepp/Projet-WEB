{extends file="./project.tpl"}
{block name=title}
    Profil
{/block}
{block name=head append}
    <meta name="description" content="Page de profil du site 'Stage Catalyst'">
    <link rel="stylesheet" href="../assets/styles/profil.css" />
    <script src="/assets/scripts/cookies.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
{/block}

{block name=main}
    <section class="profile">
        <h1>Profil</h1>
        <section>
            <img src="../assets/fontawesome/svgs/solid/user.svg" alt="Icône utilisateur par défaut" id="fa-user">
            <section id="info">
                <section>
                    <p>Prénom</p>
                    <p>{$prenom}</p>
                </section>
                <section>
                    <p>Nom</p>
                    <p>{$nom}</p>
                </section>
                <section>
                    <p>Email</p>
                    <p>{$email}</p>
                </section>
            </section>
        </section>
        <section>
            <section>
                <p>Date de naissance</p>
                <p>{$birthday}</p>
            </section>
            <section>
                <p>Age</p>
                <p>{$age}</p>
            </section>
            <section>
                <p>Adresse</p>
                <p>{$formattedAddress}</p>
            </section>
            {if $type == "tutors"}
            <section>
                <p>Promotion gérées</p>
                <p>{$promos}</p>
            </section>
            <section>
                <p>Centre</p>
                <p>{$campus}</p>
            </section>
            {else if $type == "students"}
                <section>
                <p>Promotion</p>
                <p>{$promo}</p>
            </section>
            <section>
                <p>Centre</p>
                <p>{$campus}</p>
            </section>
            <section>
                <p>Nombre de postulation</p>
                <p>{$candidature}</p>
            </section>
            <section>
                <p>Nombre de stages</p>
                <p>{$stage}</p>
            </section>
            {/if}
        </section>
        <section id="btn-section">
        <form id="myForm" method="post" onsubmit="disconnect(event)">
            <button type="submit"><img src="../assets/fontawesome/svgs/solid/arrow-right-from-bracket.svg" alt="Icône 'Se déconnecter'">Se déconnecter</button>
        </form>
        </section>
    </section>
{/block}
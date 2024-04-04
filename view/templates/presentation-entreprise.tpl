{extends file="./project.tpl"}
{block name=title}
    Presentation entreprise
{/block}
{block name=head append}
    <meta name="description" content="Presentation entreprise.">
    <script rel="preload" src="../assets/scripts/presentation-entreprise.js"></script>
    <link rel="stylesheet" href="../assets/styles/presentation-entreprise.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
{/block}
{block name=main}
    <section class="entreprise">
        <div class="logo-container"></div>
        <section class="contentEntreprise">
            <section class="headerEntreprise">
                <h2>CESI</h2>
                <section class="gradeWrapper">
                    <div class="rate2">
                    </div>
                </section>
            </section>
            <section class="bodyEntreprise">
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios/45/domain.png" alt="domain" />
                    <a href="https://www.amazon.fr/" target="_blank" class="website">amazon.com</a>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/map-marker.png" alt="map-marker" />
                    <p>2 allée des foulons, 67380 Lingolsheim</p>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/client-company.png" alt="client-company" />
                    <p>Education / Formation</p>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-filled/45/groups.png" alt="groups" />
                    <p>30 personnes</p>
                </div>
            </section>
        </section>
        <section class="description">
            <fieldset>
                <legend>Description</legend>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus,
                    neque tempora! Cum
                    quae
                    pariatur veniam enim vel amet eligendi fuga dolor suscipit ea? Fugiat unde ex expedita alias
                    minus
                    voluptatibus.
                </p>
            </fieldset>
        </section>
    </section>
    <section id="avis">
        <h3>Avis :</h3>
        <section class="avis-utilisateur">
            <section class="gradeWrapper">
                <div class="rate2">
                </div>
            </section>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui laboriosam minus ea itaque asperiores
                illo quaerat! Consectetur, incidunt veritatis voluptatibus voluptatem ipsum, assumenda cum quae
                vitae quas laboriosam id explicabo?</p>
        </section>
        <section class="avis-utilisateur">
            <section class="gradeWrapper">
                <div class="rate2">
                </div>
            </section>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui laboriosam minus ea itaque asperiores
                illo quaerat! Consectetur, incidunt veritatis voluptatibus voluptatem ipsum, assumenda cum quae
                vitae quas laboriosam id explicabo?</p>
        </section>
        <section class="avis-utilisateur">
            <section class="gradeWrapper">
                <div class="rate2">
                </div>
            </section>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui laboriosam minus ea itaque asperiores
                illo quaerat! Consectetur, incidunt veritatis voluptatibus voluptatem ipsum, assumenda cum quae
                vitae quas laboriosam id explicabo?</p>
        </section>
    </section>
    {$pagination}
{/block}
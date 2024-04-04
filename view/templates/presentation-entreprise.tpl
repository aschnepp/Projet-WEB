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
                <h2>{$entreprise[$nentreprise]->firm_name}</h2>
                <section class="gradeWrapper" id="grade-0">
                    <div class="rate2">
                    </div>
                </section>
            </section>
            <section class="bodyEntreprise">
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios/45/domain.png" alt="domain" />
                    <a href="{$entreprise[$nentreprise]->website}" target="_blank" class="website">Site Web</a>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/map-marker.png" alt="map-marker" />
                    <p>{$entreprise[$nentreprise]->street_number} {$entreprise[$nentreprise]->street_name}, {$entreprise[$nentreprise]->postal_code} {$entreprise[$nentreprise]->city_name}</p>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-glyphs/45/client-company.png" alt="client-company" />
                    <p>{$entreprise[$nentreprise]->activity_sector_name}</p>
                </div>
                <div class="items">
                    <img width="30" height="30" src="https://img.icons8.com/ios-filled/45/groups.png" alt="groups" />
                    <p>{$entreprise[$nentreprise]->total_postulations} personne(s)</p>
                </div>
            </section>
        </section>
        <section class="description">
            <fieldset>
                <legend>Description</legend>
                <p>{$entreprise[$nentreprise]->description_firm}</p>
            </fieldset>
        </section>
    </section>
    <section id="avis">
        <h3>Avis :</h3>
        {$avis nofilter}
        {$scriptNotes nofilter}
    </section>
    {$pagination nofilter}
{/block}
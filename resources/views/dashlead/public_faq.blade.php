<!-- Developed By CBS -->
    @extends('dashlead.layouts.public_layout') 
    @section('pageTitle', 'Faq')
    @section('content')
    <!-- pageContent area-->
    <div class="main-content pt-0">
        <div class="container">
            <!-- Row -->
                <div class="row row-sm">

                <!-- Page Header -->
                    <div class="page-header">
                        </div>
                    <!-- End Page Header -->
                    
                    <div class="col-sm-12 col-md-12">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div style="font-weight: bold; margin-bottom: 20px; text-transform:uppercase;"><h4>Ofte Stillede Spørgsmål ?</h4><hr></div>
                                <div aria-multiselectable="true" class="accordion" id="accordion" role="tablist">

                                    <div class="card">
                                        <div class="card-header" id="heading1" role="tab">
                                            <a aria-controls="collapse1" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse1">Hvad er Datingportalen ?</a>
                                        </div>
                                        <div aria-labelledby="heading1" class="collapse" data-parent="#accordion" id="collapse1" role="tabpanel">
                                            <div class="card-body">
                                                <p>
                                                    Datingportalen.com er en datingside som sikkert minder om andre sider du eventuelt har været på før, dog har vi samlet
                                                    de største datingformer på én side så du kun behøver at have profil et sted. <br>
                                                    Dette giver dig mulighed for at stille din eventuelle nysgerrighed på andre datingformer, helt ned til 1 enkelt dag for
                                                    et medlemskab. <br>
                                                    Samtidigt har vi nye funktioner som ikke er set før på det danske dating-marked, og så tillader vi os at være billigere
                                                    end de fleste andre datingsider.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="card">
                                            <div class="card-header" id="heading2" role="tab">
                                                <a aria-controls="collapse2" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse2">Hvor skriver jeg min profiltekst ?</a>
                                            </div>
                                            <div aria-labelledby="heading2" class="collapse" data-parent="#accordion" id="collapse2" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Gå til “Min profil” og vælg “Vis min profil”, under din profildata er feltet hvor du kan skrive og redigere din profiltekst.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading3" role="tab">
                                                <a aria-controls="collapse3" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse3">Hvad koster det ?</a>
                                            </div>
                                            <div aria-labelledby="heading3" class="collapse" data-parent="#accordion" id="collapse3" role="tabpanel">
                                                <div class="card-body">
                                                    <p>
                                                        Et månedsabonnement koster 129 kr. <br>
                                                        Vælger du at have profil på flere portaler, falder prisen med 20 kr. pr. portal, ned til 29 kr. pr.
                                                        Måned. <br>
                                                        Ergo, første portal 129 kr./md. - anden portal 109 kr./md. - tredje portal 89 kr./md. osv. <br>
                                                        Yderligere muligheder vedr. medlemskaber: <br>
                                                        1 døgn - 19 kr. <br>
                                                        Weekend (Fre-Søn) - 39 kr. <br>
                                                        1 uge - 49 kr. <br>
                                                        1 måned - 129 kr. (Prisen falder med 20 kr./md per ekstra portal) <br>
                                                        3 måneder - 349 kr. <br>
                                                        6 måneder - 599 kr. <br>
                                                        12 måneder - 999 kr. <br>
                                                        Opslag på Væggen, maks. 120 tegn, 24 timer - 10 kr. <br>
                                                        Fremhævning på forsiden, maks. 160 tegn, 1 eller 24 timer - 20 eller 100 kr. <br>
                                                        Top placering i indbakken - 5 kr. <br> <br>
                                        
                                                        Alle køb på siden vil fremgå af din betalingshistorik under “Min profil” og derefter “Indstillinger”,
                                                        mindre køb vil dog
                                                        først blive trukket fra din konto når beløbet rammer 100 kr. eller du sletter din profil, så du undgår
                                                        en masse små
                                                        trækninger på din konto. <br>
                                                        Dog vil beløbet være “reserveret” på din konto. <br>
                                                        Alle reserverede beløb hæves sidste hverdag i måneden, uanset beløbets størrelse. <br>
                                                        Der vil på dit kontoudtog stå: DPORTALEN
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading4" role="tab">
                                                <a aria-controls="collapse4" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse4">Hvordan kan jeg betale mit medlemskab på Datingportalen.com ?</a>
                                            </div>
                                            <div aria-labelledby="heading4" class="collapse" data-parent="#accordion" id="collapse4" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Du kan betale med følgende betalingskort; Dankort, VISA, Mastercard og VISA electron.</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card">
                                            <div class="card-header" id="heading5" role="tab">
                                                <a aria-controls="collapse5" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse5">Fornyer I automatisk mit medlemskab ?</a>
                                            </div>
                                            <div aria-labelledby="heading5" class="collapse" data-parent="#accordion" id="collapse5" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Både og.<br> Alle medlemskaber på en uge eller derover fornyes automatisk indtil abonnementet bliver opsagt.<br> Døgn og weekend medlemskaber er engangsbeløb.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading6" role="tab">
                                                <a aria-controls="collapse6" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse6">Kan jeg ændre profiloplysninger når jeg tilkøber en profil ?</a>
                                            </div>
                                            <div aria-labelledby="heading6" class="collapse" data-parent="#accordion" id="collapse6" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Ja, når du tilmelder dig en ny portal får du mulighed for at ændre dine oplysninger, feks nyt/slette  profilbillede, ændre profilnavn osv.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading7" role="tab">
                                                <a aria-controls="collapse7" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse7">Hvad er "Topplacering i indbakken" ?</a>
                                            </div>
                                            <div aria-labelledby="heading7" class="collapse" data-parent="#accordion" id="collapse7" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Når du skriver et brev til en anden bruger på siden, har du mulighed for 5 kr. at få dit brev øverst i bunken med en stjernemarkering, som dog forsvinder efter brevet er åbnet. <br> Bemærk at funktionen virker som almindelig post, så hvis andre brugere også betaler for en topplacering til den samme bruger, vil brevene blive sorteret efter hvilken bruger der har skrevet sidst.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading8" role="tab">
                                                <a aria-controls="collapse8" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse8">Hvordan fungerer favorit indbakken ?</a>
                                            </div>
                                            <div aria-labelledby="heading8" class="collapse" data-parent="#accordion" id="collapse8" role="tabpanel">
                                                <div class="card-body">
                                                    <p>For at det er nemmere og mere overskueligt at kunne holde kontakt med andre brugere gennem Datingportalen.com, har vi lavet en favorit indbakke hvor profiler som er på din favoritliste, vil få ført deres post over i. <br> På denne måde har vi gjort det nemmere at kunne holde kontakt med de personer som du finder interessante. <br> Når du tilføjer eller fjerner en person fra din favoritliste, rykkes samtalen automatisk over i den tilhørende indbakke.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading9" role="tab">
                                                <a aria-controls="collapse9" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse9">Kan jeg være anonym på Datingportalen.com ?</a>
                                            </div>
                                            <div aria-labelledby="heading9" class="collapse" data-parent="#accordion" id="collapse9" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Naturligvis kan du være anonym. Vi blander os ikke i dit privatliv, og såfremt du ikke ønsker for eksempel profilbillede, er dette helt op til dig.<br> Vi hverken deler eller har adgang til dine private oplysninger, medmindre dette er på myndighedernes forlangende, samt opfylder vi de nødvendige krav til GDPR. <br> Dine køb på eller gennem siden vil på dit kontoudtog fremgå som “DP - 39920824”</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading10" role="tab">
                                                <a aria-controls="collapse10" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse10">Hvilke typer medlemskab kan jeg købe ?</a>
                                            </div>
                                            <div aria-labelledby="heading10" class="collapse" data-parent="#accordion" id="collapse10" role="tabpanel">
                                                <div class="card-body">
                                                    <p>På Datingportalen.com har vi flere forskellige typer medlemskaber. <br> Du kan være medlem på en enkelt portal i blot en enkelt dag eller weekend (Fredag t.o.m. Søndag), samt uge, måneds og halvårs medlemskab.<br> Idéen bag dags, weekend og uge medlemskab, er at du som bruger kan stille din nysgerrighed på en portal eller flere, uden nødvendigvis at skulle betale for en hel måned.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading11" role="tab">
                                                <a aria-controls="collapse11" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse11">Hvad er "Fremhævning" og "Væggen" ?</a>
                                            </div>
                                            <div aria-labelledby="heading11" class="collapse" data-parent="#accordion" id="collapse11" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Fremhævninger giver dig mulighed for at blive vist på forsiden med et billede som du selv vælger. Du kan tilføje tekst på op til 160 tegn. <br> Bemærk venligst at billedet skal overholde de generelle betingelser for billeder. <br> Væggen er lidt det samme, her er det blot tekst og dit profilnavn der vil blive vist på væggen. Teksten er max på 120 tegn.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading12" role="tab">
                                                <a aria-controls="collapse12" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse12">Hvordan blokerer jeg en profil, og hvordan fjerner jeg en profil fra blokerede profiler igen ?</a>
                                            </div>
                                            <div aria-labelledby="heading12" class="collapse" data-parent="#accordion" id="collapse12" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Du kan blokere en profil enten inde på den pågældende profil lige over profilteksten, eller i den hoover-menu der kommer op når du fører musen over et brev i din indbakke. Såfremt du vil fjerne en blokering af en profil, går du til “Min profil” og derfra til “Blokerede profiler”. Derinde kan du finde alle de profiler du har blokeret og fjerne blokeringen.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading13" role="tab">
                                                <a aria-controls="collapse13" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse13">Hvordan opretter jeg et medlemskab på én eller flere portaler ?</a>
                                            </div>
                                            <div aria-labelledby="heading13" class="collapse" data-parent="#accordion" id="collapse13" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Når du har oprettet profil på Datingportalen.com, på en hvilken som helst portal, går du ind under “Min profil” og vælger “Medlemskaber”, derfra kan du trykke på den pågældende portal hvor du ønsker at oprette dig. <br> Er du gratis medlem og ønsker at blive betalende medlem, gå da ind på “Min profil”, derfra “Indstillinger” og “Betalingshistorik” i venstre side, der er knappen til at aktivere dig som betalende medlem.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading14" role="tab">
                                                <a aria-controls="collapse14" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse14">Kan man oprette par profiler på Datingportalen.com ?</a>
                                            </div>
                                            <div aria-labelledby="heading14" class="collapse" data-parent="#accordion" id="collapse14" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Ja, det er muligt at oprette par profiler på alle portaler.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading15" role="tab">
                                                <a aria-controls="collapse15" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse15">Hvordan opretter vi en par profil ?</a>
                                            </div>
                                            <div aria-labelledby="heading15" class="collapse" data-parent="#accordion" id="collapse15" role="tabpanel5">
                                                <div class="card-body">
                                                    <p>
                                                        I opretter en profil som alle andre, men under valg af “køn” vælger I par, derefter opretter i profilen som en almindelig/single profil. <br>
                                                        Standard opsætningen er sat til at den person I opretter i oprettelses-processen er mandlig. <br> Når I har bekræftet Jeres E-mail og logger ind første gang, skal I gå til “Min profil” og “Rediger profil”, oppe i højre hjørne af skærmen kan I vælge den anden person i parret og rette de informationer til, som I har behov for. <br> Derinde kan I også tilføje profilbilleder for Jer begge.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading16" role="tab">
                                                <a aria-controls="collapse16" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse16">Hvordan sletter jeg et billede eller en video fra min profil ?</a>
                                            </div>
                                            <div aria-labelledby="heading16" class="collapse" data-parent="#accordion" id="collapse16" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Gå til “Min profil”, vælg “Vis min profil” og vælg derfra billeder eller videoer, derfra kan du slette de billeder eller videoer du har behov for.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading17" role="tab">
                                                <a aria-controls="collapse17" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse17">Er der censur på Datingportalen.com ?</a>
                                            </div>
                                            <div aria-labelledby="heading17" class="collapse" data-parent="#accordion" id="collapse17" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Der er ingen censur på følgende dating-typer ifht. billeder og videoer: <br> - Fræk dating <br> - Sugardating <br> - Regnbue dating <br> - Badboy dating<br> <br> På øvrige dating-typer gælder følgende regler for censur: <br> - Ingen nøgenhed <br> - Ingen former for pornografi <br> - Ingen former for opfordring til ulovlig aktivitet, racistiske budskaber, vold eller lignende <br> - Ingen links til andre sider eller anden former for reklame eller budskaber med salgsøjemed <br><br> Vi tillader dog pikante billeder, såsom undertøjs billeder, bikini-/strand-billeder og lignende. Vi anbefaler dog at du vælger med omhu, hvad du ønsker at dele med de øvrige brugere, og hvilke signaler du sender gennem dine billeder. <br> Vi henviser iøvrigt til vores ​<a target="_blank" style="display: contents;" href="/terms_of_services">handelsbetingelser​</a> ifht. øvrige regler for, og brug af, billeder, video, webcam og siden generelt. <br> Bemærk at vi forbeholder os retten til at slette profiler uden varsel, såfremt vores regler for brug af siden brydes.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading18" role="tab">
                                                <a aria-controls="collapse18" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse18">Findes der IRL garanti på Datingportalen.com ?</a>
                                            </div>
                                            <div aria-labelledby="heading18" class="collapse" data-parent="#accordion" id="collapse18" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Nej ikke i den gængse forstand, men inden for kort tid introducerer vi NemID validering på siden.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading19" role="tab">
                                                <a aria-controls="collapse19" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse19">Hvilke begrænsninger har jeg som ikke-betalende medlem ?</a>
                                            </div>
                                            <div aria-labelledby="heading19" class="collapse" data-parent="#accordion" id="collapse19" role="tabpanel">
                                                <div class="card-body">
                                                    <p>- Kan modtage post, men ikke sende, medmindre du betaler for en topplacering i indbakken <br> - Du kan se profilbilleder, men ikke andre billeder i andre brugeres profiler <br> - Du kan ikke se billeder eller videoer gennem selvsamme menuer i hovedmenuen <br> - Du kan bruge funktionerne “Fremhævning” og “Væggen” <br> - DU kan se og læse blogs, men ikke kommentere dem eller oprette blogs selv <br> - Du kan se og tilmelde dig events, men ikke oprette dem selv <br> - Du kan se grupper, men ikke tilmelde dig eller kommentere i dem <br> - Du kan ikke bruge blokér funktionen <br> - Du kan ikke bruge genvejene til Seneste besøg, Favoritter eller Nyeste profiler, kun se dem fra forsiden</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading20" role="tab">
                                                <a aria-controls="collapse20" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse20">Hvad er negative matchord ?</a>
                                            </div>
                                            <div aria-labelledby="heading20" class="collapse" data-parent="#accordion" id="collapse20" role="tabpanel">
                                                <div class="card-body">
                                                    <p> Negative matchord er endnu ikke aktivt, men vil komme i brug snarest, men du kan allerede nu oprette negative matchord hvis du har lyst. Læs nedenfor hvad negative matchord er. <br><br>Negative matchord er matchord du kan oprette fuldstændig som almindelige matchord. <br>Negative matchord kan ikke ses af andre brugere, kun dig selv. <br> Når du fører musen henover et brev i en af dine indbakker, kommer en popup (hoover menu) frem hvor du kan se detaljer om personen inden du åbner brevet. <br> Hvis du har oprettet feks det negative matchord “Slem” og ordet figurerer i brevet, vil ordet dukke op i denne menu. <br> Idéen bag negative matchord og hoover menuen, er at du nemmere kan sortere i dine indbakker og have fokus på de samtaler og personer, du har lyst til.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading21" role="tab">
                                                <a aria-controls="collapse21" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse21">Hvordan stopper jeg mit løbende abonnement ?</a>
                                            </div>
                                            <div aria-labelledby="heading21" class="collapse" data-parent="#accordion" id="collapse21" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Gå ind i menuen “Min profil” og vælg “Indstillinger”, i menuen til venstre vælger du “Betalingshistorik” og der er knappen til at af- og tilmelde dit løbende abonnement.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading22" role="tab">
                                                <a aria-controls="collapse22" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse22">Hvordan sletter jeg min profil ?</a>
                                            </div>
                                            <div aria-labelledby="heading22" class="collapse" data-parent="#accordion" id="collapse22" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Gå ind under “Min profil”, vælg “Indstillinger”.<br> Tryk derefter på “Medlemskab” ude i den højre menu, og tryk på push-knappen “Slet min profil”.<br> Der kan gå op til 48 timer før dine oplysninger er slettet fra vores systemer.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="heading23" role="tab">
                                                <a aria-controls="collapse23" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse23">Fandt du ikke svar på hvad du søgte? Kontakt os !</a>
                                            </div>
                                            <div aria-labelledby="heading23" class="collapse" data-parent="#accordion" id="collapse23" role="tabpanel">
                                                <div class="card-body">
                                                    <p>Kontakt os gerne på mail: support@datingportalen.com, så skal vi gøre hvad vi kan for at hjælpe dig :) Alternativt ring til os på telefon: 78 750 300, Man-Fre mellem kl 10:00 & 12:30.</p>
                                                </div>
                                            </div>
                                        </div>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Row -->
        </div>
    </div>
    <!-- end pageContent area-->
    @endsection
<!-- Developed By CBS -->


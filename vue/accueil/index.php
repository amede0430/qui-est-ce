<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qui est-ce?</title>
    <link rel="stylesheet" href="assets/css/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="loader">
        <span class="lettre">Q</span>
        <span class="lettre">U</span>
        <span class="lettre">I</span>
        <span class="lettre">_</span>
        <span class="lettre">E</span>
        <span class="lettre">S</span>
        <span class="lettre">T</span>
        <span class="lettre">-</span>
        <span class="lettre">C</span>
        <span class="lettre">E</span>
        <span class="lettre">?</span>
    </div>

    <script>
    setTimeout(() => {
        document.querySelector('.loader').classList.add("fondu-out");
        document.querySelector('.loader').style.display = "none";
        // document.body.style.visibility = 'visible';
    }, 2500);
    </script>
    <!-- <div class="div2"> -->
    <!-- Barre de navigation de la page d'accueil -->
    <nav class="p-navbar navbar navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="image/logo-removebg-preview.png" alt="Logo" width="100" height="100">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active text-light " href="">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light " href="#propos">A propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light " href="controleur/inscrire/inscrire.php">S'inscrire</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- <div class="container col my-5 mt-5" > -->
    <!-- Brève description du jeu -->
    <div class="container col-8 my-5">
        <div class="row">
            <div class="col-6  text-left ">
                <span class="text-center">“Qui est-ce ?”</span>
                <p> - Choisir un plateau de jeu: « Célébrités » ou « Animés » ;</p>
                <p> - Deviner le personnage mystère en saisissant son nom et valider;</p>
                <p> - Utiliser les indices pour éliminer progressivement les personnages non clés;</p>
                <p> - Retrait d´un point (-1) pour un mauvais choix;</p>
                <p> - Retrait de quatre points (-4) pour l’usage d’un indice.</p>
                <p> - Chaque joueur dispose de vingt points (20) initialement.</p>
            </div>
            <form action="controleur/accueil/recup_email.php" method="post" class=" col-6 py-5">
                <div class="form-group col-6 mx-5">
                    <input type="email" class="form-control" name="email" placeholder="example@gmail.com"
                        value="<?php if (isset($_SESSION['email'])) {
                                                echo $_SESSION['email'];
                                            } else {
                                                echo '';

                                            } ?>">                                                                        
                </div>
                <?php if ($_SESSION['username'] == '') { ?>
                <p class="red">Adresse email incorrect.</p>
                <?php } ?>
                <button class="btn btn-primary my-2 mx-5 ">Connecter</button>
                <?php if ($_SESSION['username'] != '') { ?>
                <p class=" text-center my-5">Bienvenu <?php echo $_SESSION['username'] ?>. Prêt pour une nouvelle
                    partie?!</p>
                <?php } ?>
            </form>

        </div>
    </div>

    <!-- Interface du jeu -->

    <div class="container  im my-4 ">
        <div class="col">
            <form method="post" class=" row nav nav-tabs justify-content-center option d-flex py-3">
                <input type="submit" name="celebrite" value="Célébrités"
                    class="personnage nav-link active col-md-6 col-sm-3 rounded-0">
                <input type="submit" name="anime" value="Animés"
                    class="personnage nav-link active col-md-6 col-sm-3 rounded-0">
            </form>
        </div>
        <div class="col">
            <div class="row justify-content-center text-center images">
                <?php
                foreach ($celebrites as $celebrite) {
                ?>
                <div class="col-md-2 col-sm-1 content_image ">
                    <img src="image/<?php echo $celebrite['photo']; ?>" alt="" class="image"><br>
                    <span>
                        <?php echo $celebrite['nom']; ?>
                    </span>
                </div>

                <?php
                }
                ?>
            </div>
        </div>
        <div class="col">
            <div class="row justify-content-center">
                <div class="text-center">
                    <button class=" btn btn-primary col-3 my-3 mx-auto" id="commence" type="submit">Commencer</button>
                </div>
                <div class=" d-flex justify-content-center d-none my-3 moveTop" id="outils">
                    <button class="btn btn-primary  " id="valider">Valider</button>
                    <div class="col-1"></div>
                    <input type="text" class="form-control" id="reponse" placeholder="Réponse" aria-label="Server">
                    <div class="col-1"></div>
                    <button class="btn btn-primary " type="submit" id="indice" name="indice">Indice</button>
                </div>
                <div class="col-2 justify-content-center my-2 moveTop">
                    <input type="text" class="form-control d-none" id="score" aria-label="Server" readonly>
                </div>
                <div class="modal fade " id="indiceModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="exampleModalLabel">Indices</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <?php
                                    for ($i = 0; $i < count($nomColonnes); $i++) {
                                    ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapse<?php echo $i; ?>" aria-expanded="false"
                                                aria-controls="flush-collapse<?php echo $i; ?>">
                                                <?php echo $nomColonnes[$i]; ?>
                                            </button>
                                        </h2>
                                        <div id="flush-collapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body ">
                                                <form class="monFormulaire<?php echo $i; ?>">
                                                    <?php
                                                        $resultat = $resultats[$i]; // Récupérer les résultats spécifiques à cet élément d'accordéon
                                                        foreach ($resultat as $key => $value) {
                                                            $j = 0;
                                                            foreach ($value as $key => $item) {
                                                        ?>
                                                    <div class="form-check">
                                                        <?php if ($j % 2 == 0) { ?>
                                                        <input class="form-check-input " type="radio"
                                                            name="option<?php echo $i; ?>"
                                                            id="<?php echo $nomChamps[$i]; ?>"
                                                            value="<?php echo $item; ?>">
                                                        <label class="form-check-label text-dark"
                                                            for="radioOption<?php echo $j; ?>">
                                                            <?php echo $item; ?>
                                                        </label>
                                                        <?php } ?>
                                                    </div>
                                                    <?php
                                                                $j++;
                                                            }
                                                        }
                                                        ?>
                                                    <button class="btn btn-primary soumettreIndice<?php echo $i; ?>"
                                                        type="button">Est-ce vrai?</button>
                                                </form>

                                                <div class="text-center resultat<?php echo $i; ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal justify-content-center" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">Terminé!!!
                        <?php if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } else {
                            echo '';
                        } ?> </h5>
                </div>
                <div class="modal-body">
                    <form action="controleur/accueil/save_Score.php" method="post" class="col-6">
                        <div class="form-group col-6 mx-5">
                            <input type="number" class="form-control" id="scoreFinal" name="scoreFinal"
                                aria-label="Server" readonly>
                        </div>

                        <button class="btn btn-primary my-2 mx-5 ">Enrégistrer</button>
                        <p class="text-dark">Le meilleur score était : <?php echo $meilleurScore ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container apropos rounded-1 my-5 py-2" id="propos">
        <div class="card apropos justify-content-center">
            <div class="row g-0">
                <div class="col-4">
                    <img src="image/logo-removebg-preview.png" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h5 class="card-title text-center">A propos</h5>
                        <p class="card-text">Ce jeu a été réalisé dans le cadre de la mise en pratique des connaissances
                            acquises lors des cours de SGBD et EDL, par les étudiants du département de Génie
                            Informatique et Télécoms (GIT) de l'Ecole Polytechnique d'Abomey-Calavi(EPAC/UAC).</p>
                        <p class="card-text">Les membres du groupe(Groupe 2/ EDL) ayant fait ce travail sont:
                        <ol>
                            <li>ADDA Philipp</li>
                            <li>AGOSSOU Accadius</li>
                            <li>CHABI Mirchad</li>
                            <li>GODONOU Géraldine</li>
                            <li>KOTANMI Amédé Florian</li>
                        </ol>
                        </p>

                        <p class="card-text"><small class="text-body-secondary">Année Académique: 2022/2023</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mx-2 ">
        <div class="foot container text-light d-flex ">
            <div class="col-md-4 text-start ">
                <i class="fas fa-copyright"></i> KAF 2023 Copyright
            </div>
            <div class="col-md-4 col-sm-5 text-center">
                <nav class="nav flex-row ">
                    <a class="nav-link" href="https://twitter.com/Amede_flo"><i class="fab fa-twitter"></i></a>
                    <a class="nav-link" href="https://www.facebook.com/amedeflorian.kotanmi.1"><i
                            class="fab fa-facebook"></i></a>
                    <a class="nav-link" href="https://www.linkedin.com/in/am%C3%A9d%C3%A9-florian-kotanmi-a667b6244/">
                        <i class="fab fa-linkedin-in"></i></a>
                    <a class="nav-link" href="https://www.instagram.com/amedeflorian "> <i
                            class="fab fa-instagram  text-danger"></i></a>
                </nav>
            </div>
            <div class="col-md-4 text-end ">
                Designer:Koder04
            </div>
        </div>

    </div>


    <script src="assets/js/bootstrap.bundle.min.js "></script>
    <script>
    // Récupérer les références des boutons
    var commence = document.getElementById("commence");
    var outils = document.getElementById("outils");
    var caseImage = document.querySelectorAll('.content_image');
    var valider = document.getElementById("valider");
    var reponse = document.getElementById("reponse");
    var Score = document.getElementById("score");
    var indice = document.getElementById("indice");
    var modal = new bootstrap.Modal(document.getElementById('myModal'));
    var indiceModal = new bootstrap.Modal(document.getElementById('indiceModal'));
    var scoreFinal = document.getElementById("scoreFinal");
    score = 20;
    console.log(score);
    Score.value = score;



    indice.addEventListener("click", function() {
        indiceModal.show();
    });



    //
    commence.addEventListener("click", function() {
        outils.classList.remove("d-none");
        commence.classList.add("d-none");
        Score.classList.remove("d-none");
       
        caseImage.forEach(function(caseImage) {
            caseImage.addEventListener("click", function() {
                this.style.visibility = "hidden";
            });
        });
    });

    // Convertir le tableau PHP en JSON puis en JS
    <?php
        $jsonImage = json_encode($image, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        ?>
    var jsonImage = '<?php echo addslashes($jsonImage); ?>';
    var image = JSON.parse(jsonImage);

    valider.addEventListener("click", function() {

        rep = reponse.value.trim();
        rep = rep.replace(/\s+/g, ' ');


        if (image['nom'].toLowerCase() !== rep.toLowerCase() && rep !== "") {
            console.log(image['nom'].toLowerCase());
            console.log(rep.toLowerCase());
            score = score - 1;
            console.log(score);
            Score.value = score;
            if (Score.value <= 0) {
                Score.value = 0;
                scoreFinal.value = Score.value;
                modal.show();
            }
            reponse.value = "";
        } else if (image['nom'].toLowerCase() == rep.toLowerCase()) {
            reponse.value = image['nom'];
            scoreFinal.value = Score.value;
            modal.show();
        }

    });

    for (let i = 0; i < <?= $i ?>; i++) {
        document.querySelector('.soumettreIndice' + i).addEventListener('click', function(event) {
            var options = document.getElementsByName('option' + i);
            for (var j = 0; j < options.length; j++) {
                if (options[j].checked) {
                    var selectedOption = options[j].value;
                    var maDiv = document.querySelector('.resultat' + i);
                    if (image[options[j].id] == options[j].value) {
                        maDiv.innerHTML = 'Affirmatif';
                        maDiv.style.color = 'green';
                    } else {
                        maDiv.innerHTML = 'Négatif';
                        maDiv.style.color = 'red';
                    }

                    score = score - 4;
                    Score.value = score;
                    console.log(score);
                    if (Score.value <= 0) {
                        indiceModal.hide();
                        Score.value = 0;
                        scoreFinal.value = Score.value;
                        modal.show();
                    }

                    Score.value = score;

                    // Désactiver les radioBox
                    for (var k = 0; k < options.length; k++) {
                        options[k].disabled = true;
                    }
                    break;
                }
            }
        });
    }
    </script>
</body>

</html>
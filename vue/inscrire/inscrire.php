<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style1.css">
    <style>
        .red{
            color:red;
            font-size:15px;
        }
    </style>
    <title>Inscription</title>
</head>
<body>
<div class="card col-4 text-center div-form">
    <h5 class="card-header">Inscription</h5>
   <div class="card-body">
    <form  action="../../controleur/inscrire/inscrire.php" method="post" >
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com">
            </div>
            <?php if ($confirme==false) {?>
            <p class="red" >Cette addresse mail est déjà utilisée.</p>
             <?php } ?>
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            </div>
            <button class="btn btn-primary my-2">Valider</button>
    </form>
   
  </div>
</div>

</body>
</html>
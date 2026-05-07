<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <h1>Inscrivez-vous</h1>

    <form id="registerForm" action="/register" method="post" novalidate>
        <div class="form-group">
            <label for="username"> Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur">
            <div class="error-message" id="usernameError"></div>
        </div>

        <div class="form-group">
            <label for="email"> Email: </label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com">
            <div class="error-message" id="emailError"></div>
        </div>

        <div class="form-group"> <label for="password"> Mot de passe: </label>
            <input type="password" id="password" name="password">
            <div class="error-message" id="passwordError"></div>
        </div>

        <button type="submit"> S'inscrire </button>

    </form>
    

    <?php if (session()->getFlashdata('error')): ?>

        <p style="color:red;">

            <?= session()->getFlashdata('error') ?>

        </p>

    <?php endif; ?>


    <?php if (session()->getFlashdata('success')): ?>

        <p style="color:green;">

            <?= session()->getFlashdata('success') ?>

        </p>

    <?php endif; ?>


    <script
        src="<?= base_url('assets/js/validation-register.js') ?>">
    </script>

</body>

</html>
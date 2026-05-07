<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <h1>Connexion en tant qu'administrateur</h1>
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <form id="loginForm" action="/authAdmin" method="post" novalidate>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" autocomplete="email" value="<?= old('email') ?>" aria-describedby="emailError" autofocus required>
            <div class="error-message" id="emailError"><?= esc($errors['email'] ?? '') ?></div>
        </div>

        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" autocomplete="current-password" aria-describedby="passwordError" required>
            <div class="error-message" id="passwordError"><?= esc($errors['password'] ?? '') ?></div>
        </div>

        <button type="submit">Se connecter</button>
    </form>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?php echo session()->getFlashdata('error'); ?></p>
    <?php endif; ?>

    <script src="<?= base_url('assets/js/validation-login.js') ?>"></script>
</body>
</html>
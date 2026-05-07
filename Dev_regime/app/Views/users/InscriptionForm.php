<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script>
      function MaFonction() {
        var password = document.getElementById('password').value;
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!regex.test(password)) {
            alert('Le mot de passe doit comporter au moins 8 caractères, inclure au moins une lettre majuscule, une lettre minuscule et un chiffre.');
            return false;
        }
    }
</script>
<body>
    <h1>Inscrivez-vous</h1>
    <form action="/register" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" onclick="MaFonction()" value="S'inscrire">
    </form>
    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><?php echo session()->getFlashdata('error'); ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?php echo session()->getFlashdata('success'); ?></p>
    <?php endif; ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ajouter un régime</h1>
    <form action="/insertRegime" method="post">
        <label for="Pourcentage_viande">Pourcentage de viande :</label>
        <input type="number" id="Pourcentage_viande" name="Pourcentage_viande" required><br>

        <label for="Pourcentage_poisson">Pourcentage de poisson :</label>
        <input type="number" id="Pourcentage_poisson" name="Pourcentage_poisson" required><br>

        <label for="Pourcentage_volaille">Pourcentage de volaille :</label>
        <input type="number" id="Pourcentage_volaille" name="Pourcentage_volaille" required><br>

        <label for="constatation">Constatation :</label>
        <textarea id="constatation" name="constatation" required></textarea><br>

        <label for="prixParSemaine">Prix par semaine :</label>
        <input type="number" id="prixParSemaine" name="prixParSemaine" step="0.01" required>

        <label for="image">Image du régime :</label>
        <input type="file" id="image" name="image"><br>
        

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des régimes</h1>
  <table border="1">
    <tr>
        <th>Pourcentage Viande</th>
        <th>Pourcentage Poisson</th>
        <th>Pourcentage Volaille</th>
        <th>Constatation</th>
        <th>Prix par Semaine</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <a href="/ajoutRegime">Ajouter un régime</a>
    <?php foreach ($regimes as $regime): ?>
    <tr>
        <td><?= $regime['pourcentage_viande'] ?>%</td>
        <td><?= $regime['pourcentage_poisson'] ?>%</td>
        <td><?= $regime['pourcentage_volaille'] ?>%</td>
        <td><?= $regime['constatation'] ?></td>
        <td><?= $regime['prixParSemaine'] ?>€</td>
        <td><img src="<?= esc(base_url('images/regimes/' . $regime['image'])) ?>" alt="Image du régime" width="100"></td>
        <td>
            <a href="/modifierRegime/<?= $regime['id'] ?>">Modifier</a>
            <a href="/supprimerRegime/<?= $regime['id'] ?>">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
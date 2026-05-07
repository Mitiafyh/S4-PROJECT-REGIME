<<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Choix de l'objectif</title>
	<style {csp-style-nonce}>
		body { font-family: Arial, Helvetica, sans-serif; margin:0; background:#f7f7f8; color:#111827 }
		.container { max-width:720px; margin:48px auto; padding:20px; background:#fff; border-radius:12px; box-shadow:0 6px 30px rgba(17,24,39,0.06); }
		h1 { margin:0 0 12px; font-size:1.6rem; color:#111827 }
		p.lead { margin:0 0 20px; color:#6b7280 }
		form { display:grid; gap:14px }
		label { font-weight:600; font-size:0.95rem; color:#374151 }
		input[type="number"], select { width:100%; padding:10px 12px; border:1px solid #e5e7eb; border-radius:8px; font-size:1rem; }
		.radio-group { display:flex; gap:12px; align-items:center }
		.actions { display:flex; gap:12px; margin-top:8px }
		button.btn { padding:12px 18px; border-radius:10px; border:0; cursor:pointer; font-weight:700 }
		button.primary { background:#dd4814; color:#fff }
		button.secondary { background:#fff; color:#111; border:1px solid #e5e7eb }
		.error { color:#b91c1c; font-size:0.9rem }
		@media (max-width:520px){ .container{margin:20px;padding:16px} }
	</style>
</head>
<body>
	<main class="container">
		<h1>Choisissez votre objectif</h１>
		<p class="lead">Sélectionnez l'objectif que vous souhaitez atteindre.</p>

		<form id="objectifForm" action="/users/choix_objectif/validate" method="post" novalidate>
			<div>
				<label for="objectif">Objectif</label>
				<select id="objectif" name="objectif" required>
					<option value="">Sélectionnez un objectif</option>
				 <?php foreach ($objectifs as $obj): ?>
				 <option value="<?= $obj['id'] ?>"><?= $obj['description'] ?></option>
				 <?php endforeach ?>
			 </select>
			 <div id="err-objectif" class="error" aria-live="polite"></div>
		 </div>

		 <div class="actions">
			 <button type="submit" class="btn primary">Valider</button>
			 <a href="/" class="btn secondary">Annuler</a>
		 </div>
	 </form>

	 <script>
		 (function(){
			 var form = document.getElementById('objectifForm');
			 var objectif = document.getElementById('objectif');
			 var errObjectif = document.getElementById('err-objectif');

			 function clearErrors(){ errObjectif.textContent=''; }

			 form.addEventListener('submit', function(e){
				 clearErrors();
				 var valid = true;

				 if(!objectif.value){ errObjectif.textContent='Veuillez sélectionner un objectif.'; valid=false; }

				 if(!valid){ e.preventDefault(); return false; }

			 });
		 })();
	 </script>
 </main>
</body>
</html>
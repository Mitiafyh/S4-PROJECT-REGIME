<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Info Santé — Formulaire</title>
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
		<h1>Informations santé</h1>
		<p class="lead">Renseignez votre poids, votre taille et votre genre pour adapter le programme.</p>

		<form id="infoForm" action="/users/infoSante/validate" method="post" novalidate>
			<div>
				<label for="poids">Poids (kg)</label>
				<input id="poids" name="poids" type="number" step="0.1" min="20" max="500" placeholder="Ex: 72.5">
				<div id="err-poids" class="error" aria-live="polite"></div>
			</div>

			<div>
				<label for="taille">Taille (m)</label>
				<input id="taille" name="taille" type="number" step="0.01" min="0.5" max="3" placeholder="Ex: 1.78">
				<div id="err-taille" class="error" aria-live="polite"></div>
			</div>

			<div>
				<label>Genre</label>
				<div class="radio-group" role="radiogroup" aria-labelledby="genre-label">
					<label><input type="radio" name="genre" value="Homme"> Homme</label>
					<label><input type="radio" name="genre" value="Femme"> Femme</label>
					<label><input type="radio" name="genre" value="Autre"> Autre</label>
				</div>
				<div id="err-genre" class="error" aria-live="polite"></div>
			</div>

			<div class="actions">
				<button type="submit" class="btn primary">Calculer Mon IMC</button>
				<a href="/" class="btn secondary">Annuler</a>
			</div>
		</form>

		<script>
			(function(){
				var form = document.getElementById('infoForm');
				var poids = document.getElementById('poids');
				var taille = document.getElementById('taille');
				var errPoids = document.getElementById('err-poids');
				var errTaille = document.getElementById('err-taille');
				var errGenre = document.getElementById('err-genre');

				function clearErrors(){ errPoids.textContent=''; errTaille.textContent=''; errGenre.textContent=''; }

				form.addEventListener('submit', function(e){
					clearErrors();
					var valid = true;

					var p = parseFloat(poids.value);
					if(isNaN(p) || p < 20 || p > 500){ errPoids.textContent='Veuillez indiquer un poids valide (kg).'; valid=false; }

					var t = parseFloat(taille.value);
					if(isNaN(t) || t < 0.5 || t > 3){ errTaille.textContent='Veuillez indiquer une taille valide (m).'; valid=false; }

					var genres = form.querySelectorAll('input[name="genre"]:checked');
					if(genres.length === 0){ errGenre.textContent='Veuillez choisir un genre.'; valid=false; }

					if(!valid){ e.preventDefault(); return false; }
					
				});
			})();
		</script>
	</main>
</body>
</html>

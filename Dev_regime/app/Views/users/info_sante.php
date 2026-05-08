<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>NutriFlow - Informations sante</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						stone: {
							50: '#fafaf9',
							100: '#f5f5f4',
							200: '#e7e5e4',
							400: '#a8a29e',
							500: '#78716c',
							600: '#57534e',
							700: '#44403c',
							800: '#292524'
						},
						sauge: '#8A9A5B'
					}
				}
			}
		}
	</script>
	<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
	<style {csp-style-nonce}>
		body { font-family: 'Plus Jakarta Sans', sans-serif; }
	</style>
</head>
<body class="bg-[#FAFAF8] text-stone-800">
	<div class="min-h-screen flex flex-col">
		<header class="bg-white/80 backdrop-blur border-b border-stone-100">
			<div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
				<a href="<?= site_url('/') ?>" class="flex items-center gap-3">
					<span class="w-10 h-10 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center text-sm font-semibold shadow-md">N</span>
					<div>
						<p class="text-xs uppercase tracking-[0.3em] text-stone-400">Espace sante</p>
						<p class="text-lg font-medium text-stone-800">NutriFlow</p>
					</div>
				</a>
				<nav class="flex items-center gap-3">
					<a href="<?= site_url('login') ?>" class="px-4 py-2 rounded-full border border-stone-200 text-stone-600 text-sm font-medium hover:bg-stone-50 transition-colors">
						Mon compte
					</a>
				</nav>
			</div>
		</header>

		<main class="flex-1">
			<section class="max-w-3xl mx-auto px-6 py-10 md:py-14">
				<div class="mb-8">
					<p class="text-xs uppercase tracking-[0.3em] text-stone-400 mb-2">Etape 1</p>
					<h1 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-3">Informations sante</h1>
					<p class="text-stone-500">Renseignez votre poids, votre taille et votre genre pour construire un programme adapte.</p>
				</div>

				<div class="bg-white border border-stone-100 rounded-3xl p-6 md:p-8 shadow-[0_10px_35px_-14px_rgba(0,0,0,0.12)]">
					<form id="infoForm" action="<?= site_url('users/infoSante/validate') ?>" method="post" novalidate class="space-y-6">
						<div>
							<label for="poids" class="block text-sm font-medium text-stone-600 mb-2">Poids (kg)</label>
							<input id="poids" name="poids" type="number" step="0.1" min="20" max="500" placeholder="Ex: 72.5" class="w-full px-4 py-3 border border-stone-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-sauge/30 focus:border-sauge transition-colors">
							<div id="err-poids" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
						</div>

						<div>
							<label for="taille" class="block text-sm font-medium text-stone-600 mb-2">Taille (m)</label>
							<input id="taille" name="taille" type="number" step="0.01" min="0.5" max="3" placeholder="Ex: 1.78" class="w-full px-4 py-3 border border-stone-200 rounded-2xl text-sm focus:outline-none focus:ring-2 focus:ring-sauge/30 focus:border-sauge transition-colors">
							<div id="err-taille" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
						</div>

						<div>
							<label class="block text-sm font-medium text-stone-600 mb-2">Genre</label>
							<div class="flex flex-wrap gap-4 items-center">
								<label class="inline-flex items-center gap-2 text-sm text-stone-700">
									<input type="radio" name="genre" value="Homme" class="h-4 w-4 text-sauge border-stone-300 focus:ring-sauge">
									Homme
								</label>
								<label class="inline-flex items-center gap-2 text-sm text-stone-700">
									<input type="radio" name="genre" value="Femme" class="h-4 w-4 text-sauge border-stone-300 focus:ring-sauge">
									Femme
								</label>
								<label class="inline-flex items-center gap-2 text-sm text-stone-700">
									<input type="radio" name="genre" value="Autre" class="h-4 w-4 text-sauge border-stone-300 focus:ring-sauge">
									Autre
								</label>
							</div>
							<div id="err-genre" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
						</div>

						<div class="flex flex-wrap gap-3">
							<button type="submit" class="px-6 py-3 rounded-full bg-stone-800 text-white text-sm font-semibold hover:bg-stone-700 transition-colors">Calculer mon IMC</button>
							<a href="<?= site_url('/') ?>" class="px-6 py-3 rounded-full border border-stone-200 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Annuler</a>
						</div>
					</form>
				</div>
			</section>
		</main>
	</div>

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
</body>
</html>

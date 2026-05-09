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
		<?= view('users/form_header', [
			'headerSection' => 'Espace sante',
			'headerTitle' => 'NutriFlow',
			'headerSubtitle' => 'Préparez votre programme personnalisé',
			'headerHref' => site_url('/'),
			'headerActionLabel' => 'Mon compte',
			'headerActionHref' => site_url('login'),
		]) ?>

		<main class="flex-1">
			<section class="max-w-3xl mx-auto px-6 py-8 md:py-10">
				<div class="mb-6 md:mb-7">
					<p class="text-xs uppercase tracking-[0.3em] text-stone-400 mb-2">Etape 1</p>
					<h1 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-2">Informations sante</h1>
					<p class="text-stone-500">Renseignez votre poids, votre taille et votre genre pour construire un programme adapte.</p>
				</div>

				<div class="bg-white border border-stone-100 rounded-3xl p-5 md:p-6 shadow-[0_10px_35px_-14px_rgba(0,0,0,0.12)]">
					<form id="infoForm" action="<?= site_url('users/infoSante/validate') ?>" method="post" novalidate class="space-y-4 md:space-y-5">
						<div class="grid gap-4 md:grid-cols-2">
							<div class="rounded-[1.5rem] border border-stone-100 bg-stone-50/60 p-4 md:p-5">
							<div class="flex flex-wrap items-end justify-between gap-4 mb-5">
								<div>
									<label for="poids" class="block text-sm font-medium text-stone-600 mb-2">
										<span class="inline-flex items-center gap-2">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-sauge">
												<path d="M6 9h12" />
												<path d="M8 9a4 4 0 0 1 8 0" />
												<rect x="3" y="9" width="18" height="11" rx="4" />
											</svg>
											Poids
										</span>
									</label>
									<p class="text-xs text-stone-400">Déplacez le curseur pour ajuster votre poids actuel.</p>
								</div>
								<div class="text-right">
									<div class="text-3xl font-light text-stone-800"><span id="poidsValue">72.5</span> <span class="text-lg text-stone-400 font-normal">kg</span></div>
									<div class="text-xs text-stone-400 mt-1">min 20 kg · max 500 kg</div>
								</div>
							</div>
							<input id="poids" name="poids" type="range" min="20" max="500" step="0.1" value="72.5" class="w-full h-2 rounded-full appearance-none cursor-pointer accent-stone-800">
							<div class="mt-4 flex justify-between text-xs text-stone-400">
								<span>20</span>
								<span>500</span>
							</div>
							<div id="err-poids" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
							</div>

							<div class="rounded-[1.5rem] border border-stone-100 bg-stone-50/60 p-4 md:p-5">
							<div class="flex flex-wrap items-end justify-between gap-4 mb-5">
								<div>
									<label for="taille" class="block text-sm font-medium text-stone-600 mb-2">
										<span class="inline-flex items-center gap-2">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-sauge">
												<path d="M12 3v18" />
												<path d="m8 7 4-4 4 4" />
												<path d="m8 17 4 4 4-4" />
											</svg>
											Taille
										</span>
									</label>
									<p class="text-xs text-stone-400">Réglez la taille en mètres pour un calcul précis de l’IMC.</p>
								</div>
								<div class="text-right">
									<div class="text-3xl font-light text-stone-800"><span id="tailleValue">1.78</span> <span class="text-lg text-stone-400 font-normal">m</span></div>
									<div class="text-xs text-stone-400 mt-1">min 0,50 m · max 3,00 m</div>
								</div>
							</div>
							<input id="taille" name="taille" type="range" min="0.5" max="3" step="0.01" value="1.78" class="w-full h-2 rounded-full appearance-none cursor-pointer accent-stone-800">
							<div class="mt-4 flex justify-between text-xs text-stone-400">
								<span>0,50</span>
								<span>3,00</span>
							</div>
							<div id="err-taille" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
							</div>
						</div>

						<div>
							<label class="block text-sm font-medium text-stone-600 mb-2">Genre</label>
							<div class="grid gap-2 md:grid-cols-3">
								<label class="group cursor-pointer">
									<input type="radio" name="genre" value="Homme" class="sr-only peer">
									<div class="rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-center transition-all duration-200 hover:border-stone-300 hover:shadow-sm peer-focus-visible:ring-2 peer-focus-visible:ring-sauge/30 peer-focus-visible:border-sauge peer-checked:border-stone-800 peer-checked:bg-stone-800 peer-checked:text-white">
										<div class="mx-auto mb-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-stone-100 text-stone-600 group-hover:bg-stone-200 peer-checked:bg-white/10 peer-checked:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
												<path d="M10 14a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
												<path d="M14 10h6" />
												<path d="M17 7v6" />
											</svg>
										</div>
										<div class="text-sm font-semibold">Homme</div>
										<div class="mt-0.5 text-[11px] text-stone-400 group-hover:text-stone-500 peer-checked:text-stone-200">Profil adapté</div>
									</div>
								</label>
								<label class="group cursor-pointer">
									<input type="radio" name="genre" value="Femme" class="sr-only peer">
									<div class="rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-center transition-all duration-200 hover:border-stone-300 hover:shadow-sm peer-focus-visible:ring-2 peer-focus-visible:ring-sauge/30 peer-focus-visible:border-sauge peer-checked:border-stone-800 peer-checked:bg-stone-800 peer-checked:text-white">
										<div class="mx-auto mb-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-stone-100 text-stone-600 group-hover:bg-stone-200 peer-checked:bg-white/10 peer-checked:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
												<circle cx="12" cy="9" r="4" />
												<path d="M12 13v8" />
												<path d="M9 18h6" />
											</svg>
										</div>
										<div class="text-sm font-semibold">Femme</div>
										<div class="mt-0.5 text-[11px] text-stone-400 group-hover:text-stone-500 peer-checked:text-stone-200">Profil adapté</div>
									</div>
								</label>
								<label class="group cursor-pointer">
									<input type="radio" name="genre" value="Autre" class="sr-only peer">
									<div class="rounded-xl border border-stone-200 bg-white px-3 py-2.5 text-center transition-all duration-200 hover:border-stone-300 hover:shadow-sm peer-focus-visible:ring-2 peer-focus-visible:ring-sauge/30 peer-focus-visible:border-sauge peer-checked:border-stone-800 peer-checked:bg-stone-800 peer-checked:text-white">
										<div class="mx-auto mb-1.5 flex h-8 w-8 items-center justify-center rounded-full bg-stone-100 text-stone-600 group-hover:bg-stone-200 peer-checked:bg-white/10 peer-checked:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
												<path d="M12 4v16" />
												<path d="M8 8h8" />
												<path d="M8 16h8" />
											</svg>
										</div>
										<div class="text-sm font-semibold">Autre</div>
										<div class="mt-0.5 text-[11px] text-stone-400 group-hover:text-stone-500 peer-checked:text-stone-200">Profil adapté</div>
									</div>
								</label>
							</div>
							<div id="err-genre" class="text-sm text-red-600 mt-2" aria-live="polite"></div>
						</div>

						<div class="flex flex-wrap gap-3 pt-1">
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
			var poidsValue = document.getElementById('poidsValue');
			var tailleValue = document.getElementById('tailleValue');
			var errPoids = document.getElementById('err-poids');
			var errTaille = document.getElementById('err-taille');
			var errGenre = document.getElementById('err-genre');

			function clearErrors(){ errPoids.textContent=''; errTaille.textContent=''; errGenre.textContent=''; }

			function syncPoids(){ poidsValue.textContent = parseFloat(poids.value).toFixed(1); }

			function syncTaille(){ tailleValue.textContent = parseFloat(taille.value).toFixed(2); }

			syncPoids();
			syncTaille();
			poids.addEventListener('input', syncPoids);
			taille.addEventListener('input', syncTaille);

			form.addEventListener('submit', function(e){
				clearErrors();
				var valid = true;

				var poidsValueNumber = parseFloat(poids.value);
				if(isNaN(poidsValueNumber) || poidsValueNumber < 20 || poidsValueNumber > 500){ errPoids.textContent='Veuillez indiquer un poids valide (kg).'; valid=false; }

				var tailleValueNumber = parseFloat(taille.value);
				if(isNaN(tailleValueNumber) || tailleValueNumber < 0.5 || tailleValueNumber > 3){ errTaille.textContent='Veuillez indiquer une taille valide (m).'; valid=false; }

				var genres = form.querySelectorAll('input[name="genre"]:checked');
				if(genres.length === 0){ errGenre.textContent='Veuillez choisir un genre.'; valid=false; }

				if(!valid){ e.preventDefault(); return false; }
			});
		})();
	</script>
</body>
</html>

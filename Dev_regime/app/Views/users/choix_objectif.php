<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>NutriFlow - Choix de l'objectif</title>
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
		.objectif-card { border: 1px solid rgba(231, 229, 228, 1); border-radius: 1.5rem; overflow: hidden; background: #fff; transition: all 0.3s ease; position: relative; }
		.objectif-card:hover { border-color: rgba(138, 154, 91, 0.5); box-shadow: 0 16px 40px -20px rgba(41, 37, 36, 0.35); transform: translateY(-4px); }
		.objectif-card.is-selected { border-color: #8A9A5B; box-shadow: 0 16px 40px -18px rgba(138, 154, 91, 0.35); }
		.objectif-check { position: absolute; top: 14px; right: 14px; width: 32px; height: 32px; border-radius: 999px; background: #8A9A5B; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 600; opacity: 0; transition: opacity 0.3s ease; }
		.objectif-card.is-selected .objectif-check { opacity: 1; }
	</style>
</head>
<body class="bg-[#FAFAF8] text-stone-800">
	<div class="min-h-screen flex flex-col">
		<?= view('users/form_header', [
			'headerSection' => 'Objectifs',
			'headerTitle' => 'NutriFlow',
			'headerSubtitle' => 'Choisissez votre objectif principal',
			'headerHref' => site_url('/'),
			'headerActionLabel' => 'Mon compte',
			'headerActionHref' => site_url('login'),
		]) ?>

		<main class="flex-1">
			<section class="max-w-6xl mx-auto px-6 py-10 md:py-14">
				<div class="mb-8">
					<?php if (isset($imc) && $imc !== null): ?>
						<p class="text-sm text-sauge font-semibold mb-2">Votre IMC est de : <?= esc($imc) ?></p>
					<?php endif; ?>
					<h1 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-3">Choisissez votre objectif</h1>
					<p class="text-stone-500">Selectionnez l'objectif principal pour personnaliser votre parcours.</p>
				</div>

				<form id="objectifForm" action="<?= site_url('users/choix_objectif/validate') ?>" method="post" novalidate>
					<input type="hidden" id="objectif" name="objectif" value="">

					<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
						<?php foreach ($objectifs as $obj): ?>
							<?php
								$description = is_array($obj) ? ($obj['description'] ?? 'Objectif') : (is_object($obj) ? ($obj->description ?? 'Objectif') : 'Objectif');
								$id = is_array($obj) ? ($obj['id'] ?? '') : (is_object($obj) ? ($obj->id ?? '') : '');
								$image = is_array($obj) ? ($obj['image'] ?? '') : (is_object($obj) ? ($obj->image ?? '') : '');
								$imageFile = $image ? $image : 'objectif-default.svg';
								$imageSrc = base_url('images/objectifs/' . $imageFile);
							?>
							<div class="objectif-card" data-value="<?= esc((string) $id) ?>" role="button" tabindex="0">
								<div class="aspect-[4/3] bg-stone-100 overflow-hidden">
									<img src="<?= esc($imageSrc) ?>" alt="<?= esc((string) $description) ?>" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
								</div>
								<div class="p-5">
									<p class="text-base font-semibold text-stone-800"><?= esc((string) $description) ?></p>
									<p class="text-xs text-stone-500 mt-2">Selectionnez pour personnaliser le programme.</p>
								</div>
								<div class="objectif-check">✓</div>
							</div>
						<?php endforeach ?>
					</div>

					<div id="err-objectif" class="text-sm text-red-600 mt-4 hidden" aria-live="polite"></div>

					<div class="flex flex-wrap gap-3 mt-8">
						<button type="submit" class="px-6 py-3 rounded-full bg-stone-800 text-white text-sm font-semibold hover:bg-stone-700 transition-colors">Valider</button>
						<a href="<?= site_url('/') ?>" class="px-6 py-3 rounded-full border border-stone-200 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">Annuler</a>
					</div>
				</form>
			</section>
		</main>
	</div>

	<script>
		(function(){
			var form = document.getElementById('objectifForm');
			var objectifInput = document.getElementById('objectif');
			var errObjectif = document.getElementById('err-objectif');
			var cards = document.querySelectorAll('.objectif-card');

			function clearErrors(){
				errObjectif.textContent='';
				errObjectif.classList.add('hidden');
			}

			function selectCard(card) {
				document.querySelectorAll('.objectif-card.is-selected').forEach(function(c) {
					c.classList.remove('is-selected');
				});
				card.classList.add('is-selected');
				objectifInput.value = card.getAttribute('data-value');
				clearErrors();
			}

			cards.forEach(function(card) {
				card.addEventListener('click', function(e) {
					e.preventDefault();
					selectCard(card);
				});

				card.addEventListener('keypress', function(e) {
					if (e.key === 'Enter' || e.key === ' ') {
						e.preventDefault();
						selectCard(card);
					}
				});
			});

			form.addEventListener('submit', function(e){
				clearErrors();
				var valid = true;

				if(!objectifInput.value){
					errObjectif.textContent='Veuillez selectionner un objectif.';
					errObjectif.classList.remove('hidden');
					valid=false;
				}

				if(!valid){ e.preventDefault(); return false; }
			});
		})();
	</script>
</body>
</html>
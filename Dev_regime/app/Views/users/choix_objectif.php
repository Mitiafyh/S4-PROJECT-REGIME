<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Choix de l'objectif</title>
	<style {csp-style-nonce}>
		body { font-family: Arial, Helvetica, sans-serif; margin:0; background:#f7f7f8; color:#111827 }
		.container { max-width:900px; margin:48px auto; padding:20px; background:#fff; border-radius:12px; box-shadow:0 6px 30px rgba(17,24,39,0.06); }
		h1 { margin:0 0 12px; font-size:1.6rem; color:#111827 }
		p.lead { margin:0 0 30px; color:#6b7280 }
		form { display:grid; gap:20px }
		.objectif-grid { display:grid; grid-template-columns:repeat(auto-fit, minmax(250px, 1fr)); gap:20px; margin:20px 0 }
		.objectif-card { 
			padding:0; 
			border:2px solid #e5e7eb; 
			border-radius:12px; 
			cursor:pointer; 
			transition:all 0.3s ease;
			overflow:hidden;
			background:#fff;
			position:relative;
		}
		.objectif-card:hover { 
			border-color:#dd4814; 
			box-shadow:0 8px 16px rgba(221,72,20,0.15); 
			transform:translateY(-4px);
		}
		.objectif-card.selected {
			border-color:#dd4814;
			background:#fff5f2;
			box-shadow:0 8px 16px rgba(221,72,20,0.25);
		}
		.objectif-card-image { 
			width:100%; 
			height:180px; 
			background:linear-gradient(135deg, #f0f0f0 0%, #e5e7eb 100%);
			display:flex;
			align-items:center;
			justify-content:center;
			overflow:hidden;
		}
		.objectif-card-image img {
			width:100%;
			height:100%;
			object-fit:cover;
		}
		.objectif-card-image .placeholder {
			font-size:3rem;
		}
		.objectif-card-content {
			padding:16px;
		}
		.objectif-card-title {
			font-weight:700;
			font-size:1rem;
			color:#111827;
			margin:0;
			padding:0;
		}
		.objectif-card-check {
			position:absolute;
			top:10px;
			right:10px;
			width:30px;
			height:30px;
			background:#dd4814;
			border-radius:50%;
			display:flex;
			align-items:center;
			justify-content:center;
			color:#fff;
			font-weight:bold;
			opacity:0;
			transition:opacity 0.3s ease;
		}
		.objectif-card.selected .objectif-card-check {
			opacity:1;
		}
		.actions { display:flex; gap:12px; margin-top:20px }
		button.btn { padding:12px 24px; border-radius:10px; border:0; cursor:pointer; font-weight:700 }
		button.primary { background:#dd4814; color:#fff }
		button.primary:hover { background:#c93d0f }
		button.secondary { background:#fff; color:#111; border:1px solid #e5e7eb }
		button.secondary:hover { background:#f9fafb }
		.error { color:#b91c1c; font-size:0.9rem; margin-top:8px; display:block }
		.hidden { display:none }
		@media (max-width:520px){ 
			.container{margin:20px;padding:16px} 
			.objectif-grid { grid-template-columns:1fr }
		}
	</style>
</head>
<body>
	<main class="container">
        <?php if (isset($imc) && $imc !== null): ?>
            <h1>Votre IMC est de : <?= esc($imc) ?></h1>
        <?php endif; ?>
		<h1>Choisissez votre objectif</h1>
		<p class="lead">Sélectionnez l'objectif que vous souhaitez atteindre.</p>

		<form id="objectifForm" action="/users/choix_objectif/validate" method="post" novalidate>
			<div>
				<label>Sélectionnez votre objectif</label>
				<input type="hidden" id="objectif" name="objectif" value="">

				<div class="objectif-grid">
					<?php foreach ($objectifs as $obj): ?>
						<?php
							$description = is_array($obj) ? ($obj['description'] ?? 'Objectif') : (is_object($obj) ? ($obj->description ?? 'Objectif') : 'Objectif');
							$id = is_array($obj) ? ($obj['id'] ?? '') : (is_object($obj) ? ($obj->id ?? '') : '');
							$image = is_array($obj) ? ($obj['image'] ?? '') : (is_object($obj) ? ($obj->image ?? '') : '');
							$imageFile = $image ? $image : 'objectif-default.svg';
							$imageSrc = '/images/objectifs/' . $imageFile;
						?>
						<div class="objectif-card" data-value="<?= esc((string) $id) ?>" role="button" tabindex="0">
							<div class="objectif-card-image">
								<img src="<?= esc($imageSrc) ?>" alt="<?= esc((string) $description) ?>">
							</div>
							<div class="objectif-card-content">
								<p class="objectif-card-title"><?= esc((string) $description) ?></p>
							</div>
							<div class="objectif-card-check">✓</div>
						</div>
					<?php endforeach ?>
				</div>

				<div id="err-objectif" class="error hidden" aria-live="polite"></div>
			</div>

			<div class="actions">
				<button type="submit" class="btn primary">Valider</button>
				<a href="/" class="btn secondary">Annuler</a>
			</div>
		</form>

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
				 document.querySelectorAll('.objectif-card.selected').forEach(function(c) {
					 c.classList.remove('selected');
				 });
				 card.classList.add('selected');
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
					 errObjectif.textContent='Veuillez sélectionner un objectif.';
					 errObjectif.classList.remove('hidden');
					 valid=false;
				 }

				 if(!valid){ e.preventDefault(); return false; }
			 });
		 })();
	 </script>
 </main>
</body>
</html>
<?php
// Extraction sécurisée des variables
$username = is_array($user ?? null) ? (string) ($user['username'] ?? 'Utilisateur') : 'Utilisateur';
$currentPoids = is_array($infoSante ?? null) ? (float) ($infoSante['poids'] ?? 70) : 70;
// taille est en mètres (1.70), convertir en cm pour l'affichage (170)
$currentTailleMetres = is_array($infoSante ?? null) ? (float) ($infoSante['taille'] ?? 1.70) : 1.70;
$currentTailleCm = $currentTailleMetres * 100;
$currentIMC = isset($imc) ? (float) $imc : null;
$selectedObjectifId = $objectifId ?? 1;
$objectifList = $objectifs ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Objectifs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { theme: { extend: { colors: { sauge: '#8A9A5B' } } } }
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        /* Styles pour les états actifs des boutons */
        .obj-btn.active.reduire { border-color: #8C7342; background-color: rgba(140, 115, 66, 0.05); }
        .obj-btn.active.reduire .obj-icon { background-color: #8C7342; color: white; }
        .obj-btn.active.reduire .obj-title { color: #292524; }

        .obj-btn.active.augmenter { border-color: #8A9A5B; background-color: rgba(138, 154, 91, 0.05); }
        .obj-btn.active.augmenter .obj-icon { background-color: #8A9A5B; color: white; }
        .obj-btn.active.augmenter .obj-title { color: #292524; }

        .obj-btn.active.imc { border-color: #292524; background-color: #FAFAF9; }
        .obj-btn.active.imc .obj-icon { background-color: #292524; color: white; }
        .obj-btn.active.imc .obj-title { color: #292524; }
    </style>
</head>
<body class="bg-[#FAFAF8] text-stone-800 font-sans">

    <div class="min-h-screen flex overflow-hidden">
        
        <!-- Sidebar Utilisateur -->
        <aside class="w-64 bg-white/60 backdrop-blur-xl border-r border-stone-200/60 flex-col hidden md:flex sticky top-0 h-screen z-10">
            <div class="p-8 pb-4">
                <h1 class="text-xl tracking-wide font-medium text-stone-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center text-sm font-light shadow-md">N</span>
                    NutriFlow
                </h1>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">
                <a href="<?= site_url('users/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('users/objectives') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    Mes objectifs
                </a>
                <a href="<?= site_url('users/program') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>
                    Programmes
                </a>
                <a href="<?= site_url('users/activities') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                    Activités
                </a>
                <a href="<?= site_url('users/wallet') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/><path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/><path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/></svg>
                    Portefeuille
                </a>
            </nav>

            <div class="p-4 border-t border-stone-100/60">
                <a href="<?= site_url('logout') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium text-stone-500 hover:bg-red-50 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-4xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-12">
                    <h2 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-2">Mes objectifs</h2>
                    <p class="text-stone-500">Ajustez vos mensurations et définissez votre but principal.</p>
                </header>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-8">
                    
                    <!-- Controls -->
                    <div class="md:col-span-3 space-y-8">
                        
                        <div class="bg-white rounded-3xl p-8 border border-stone-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)]">
                            <h3 class="text-xl font-medium text-stone-800 mb-6">Mon objectif principal</h3>
                            <div class="space-y-4">
                                <!-- Option 1 : Réduire mon poids -->
                                <button onclick="selectObj('reduire', this)" class="obj-btn reduire active w-full flex items-center gap-4 p-4 rounded-2xl border transition-all border-stone-200 hover:border-stone-300 bg-white shadow-sm text-left">
                                    <div class="obj-icon w-10 h-10 rounded-full flex items-center justify-center bg-stone-100 text-stone-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
                                    </div>
                                    <div>
                                        <p class="obj-title font-medium text-stone-600 transition-colors">Réduire mon poids</p>
                                        <p class="text-xs text-stone-400 mt-1">Perdre de la masse grasse durablement</p>
                                    </div>
                                </button>

                                <!-- Option 2 : Augmenter mon poids -->
                                <button onclick="selectObj('augmenter', this)" class="obj-btn augmenter w-full flex items-center gap-4 p-4 rounded-2xl border transition-all border-stone-200 hover:border-stone-300 bg-white text-left">
                                    <div class="obj-icon w-10 h-10 rounded-full flex items-center justify-center bg-stone-100 text-stone-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                                    </div>
                                    <div>
                                        <p class="obj-title font-medium text-stone-600 transition-colors">Augmenter mon poids</p>
                                        <p class="text-xs text-stone-400 mt-1">Gagner en masse musculaire sainement</p>
                                    </div>
                                </button>
                                
                                <!-- Option 3 : Atteindre mon IMC idéal -->
                                <button onclick="selectObj('imc', this)" class="obj-btn imc w-full flex items-center gap-4 p-4 rounded-2xl border transition-all border-stone-200 hover:border-stone-300 bg-white text-left">
                                    <div class="obj-icon w-10 h-10 rounded-full flex items-center justify-center bg-stone-100 text-stone-500 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 16v-4"/><path d="M8 16v-4"/><path d="M12 16v-4"/><path d="M22 12a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"/></svg>
                                    </div>
                                    <div>
                                        <p class="obj-title font-medium text-stone-600 transition-colors">Atteindre mon IMC idéal</p>
                                        <p class="text-xs text-stone-400 mt-1">Trouver l'équilibre parfait pour ma taille</p>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl p-8 border border-stone-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)]">
                            <h3 class="text-xl font-medium text-stone-800 mb-8">Mes mensurations</h3>
                            
                            <div class="space-y-8">
                                <div>
                                    <div class="flex justify-between items-end mb-4">
                                        <label class="text-sm font-medium text-stone-600">Poids actuel</label>
                                        <span class="text-2xl font-light text-stone-800"><span id="poidsValue"><?= number_format($currentPoids, 1) ?></span> <span class="text-sm text-stone-400">kg</span></span>
                                    </div>
                                    <input type="range" id="poidsInput" min="40" max="150" step="0.1" value="<?= esc((string)$currentPoids) ?>" class="w-full accent-stone-800 h-2 bg-stone-100 rounded-lg appearance-none cursor-pointer" oninput="updateIMC()" />
                                </div>

                                <div>
                                    <div class="flex justify-between items-end mb-4">
                                        <label class="text-sm font-medium text-stone-600">Taille</label>
                                        <span class="text-2xl font-light text-stone-800"><span id="tailleValue"><?= intval($currentTailleCm) ?></span> <span class="text-sm text-stone-400">cm</span></span>
                                    </div>
                                    <input type="range" id="tailleInput" name="taille" min="140" max="220" step="1" value="<?= intval($currentTailleCm) ?>" class="w-full accent-stone-800 h-2 bg-stone-100 rounded-lg appearance-none cursor-pointer" oninput="updateIMC()" />
                                </div>
                            </div>

                            <form method="POST" action="<?= site_url('users/objectives/save') ?>" class="mt-10">
                                <input type="hidden" id="objectifInput" name="objectif_id" value="1" />
                                <input type="hidden" id="poidsHidden" name="poids" />
                                <input type="hidden" id="tailleHidden" name="taille" />
                                <button type="submit" class="w-full py-3 rounded-xl bg-stone-800 text-white font-medium flex items-center justify-center gap-2 hover:bg-stone-700 transition-colors shadow-lg shadow-stone-800/10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg> 
                                    Sauvegarder les données
                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- IMC Display -->
                    <div class="md:col-span-2">
                        <div id="imcCard" class="transition-colors duration-300 rounded-3xl p-8 sticky top-8 text-center border shadow-xl bg-emerald-50 border-emerald-100">
                            <div class="w-16 h-16 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center mb-6">
                                <svg id="imcIcon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-emerald-600 transition-colors duration-300"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                            </div>
                            
                            <p class="text-stone-500 uppercase tracking-widest text-xs font-semibold mb-2">Votre IMC</p>
                            <h3 id="imcScore" class="text-6xl font-light tracking-tighter mb-4 text-emerald-600 transition-colors duration-300">22.5</h3>
                            
                            <div id="imcBadge" class="inline-flex px-4 py-1.5 rounded-full text-sm font-medium bg-white/60 backdrop-blur-sm text-emerald-600 mb-8 shadow-sm transition-colors duration-300">
                                Poids normal
                            </div>

                            <div class="space-y-3 text-left">
                                <p class="text-sm text-stone-600 flex justify-between">
                                    <span>- de 18.5</span>
                                    <span class="text-stone-400">Insuffisance</span>
                                </p>
                                <div class="h-[1px] w-full bg-stone-200/50"></div>
                                <p class="text-sm text-stone-800 font-medium flex justify-between">
                                    <span>18.5 à 24.9</span>
                                    <span class="text-emerald-600">Poids normal</span>
                                </p>
                                <div class="h-[1px] w-full bg-stone-200/50"></div>
                                <p class="text-sm text-stone-600 flex justify-between">
                                    <span>+ de 25.0</span>
                                    <span class="text-stone-400">Surpoids</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <script>
        const initialPoids = <?= $currentPoids ?>;
        const initialTaille = <?= intval($currentTailleCm) ?>;
        const initialObjectifId = <?= intval($selectedObjectifId) ?>;

        // Gestion de la sélection d'objectif
        function selectObj(type, btn) {
            document.querySelectorAll('.obj-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const objId = type === 'reduire' ? 1 : (type === 'augmenter' ? 2 : 3);
            document.getElementById('objectifInput').value = objId;
        }

        // Calcul et mise à jour de l'IMC (slider en cm, calcul en m)
        function updateIMC() {
            const poids = parseFloat(document.getElementById('poidsInput').value);
            const tailleCm = parseFloat(document.getElementById('tailleInput').value);
            const tailleM = tailleCm / 100;
            const imc = (poids / (tailleM * tailleM)).toFixed(1);
            
            document.getElementById('poidsValue').textContent = poids.toFixed(1);
            document.getElementById('tailleValue').textContent = tailleCm.toFixed(0);
            document.getElementById('imcScore').textContent = imc;
            
            // Déterminer le statut IMC
            let badge = 'Poids normal';
            let color = 'emerald';
            if (imc < 18.5) {
                badge = 'Insuffisance pondérale';
                color = 'blue';
            } else if (imc > 25) {
                badge = 'Surpoids';
                color = 'amber';
            }
            
            const imcCard = document.getElementById('imcCard');
            const imcBadge = document.getElementById('imcBadge');
            const imcIcon = document.getElementById('imcIcon');
            const imcScoreEl = document.getElementById('imcScore');
            
            // Mettre à jour les classes de couleur (statique car tailwind n'aime pas les classes dynamiques)
            imcCard.className = `transition-colors duration-300 rounded-3xl p-8 sticky top-8 text-center border shadow-xl bg-${color}-50 border-${color}-100`;
            imcBadge.className = `inline-flex px-4 py-1.5 rounded-full text-sm font-medium bg-white/60 backdrop-blur-sm text-${color}-600 mb-8 shadow-sm transition-colors duration-300`;
            imcIcon.className = `transition-colors duration-300 text-${color}-600`;
            imcScoreEl.className = `text-6xl font-light tracking-tighter mb-4 text-${color}-600 transition-colors duration-300`;
            imcBadge.textContent = badge;
            
            // Mettre à jour les champs cachés (taille doit être en mètres)
            document.getElementById('poidsHidden').value = poids;
            document.getElementById('tailleHidden').value = tailleM;
        }

        // Initialisation au chargement
        function initializeObjectives() {
            updateIMC();
        }

        // Initialisation au chargement du DOM
        document.addEventListener('DOMContentLoaded', initializeObjectives);
    </script>
</body>
</html>
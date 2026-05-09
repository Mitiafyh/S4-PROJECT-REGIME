<?php
$username = is_array($user ?? null) ? (string) ($user['username'] ?? 'Utilisateur') : 'Utilisateur';
$wallet = is_array($user ?? null) ? (float) ($user['argent'] ?? 0) : 0;
$isGold = is_array($user ?? null) ? !empty($user['modeGold']) : false;
$imcValue = isset($imc) ? $imc : null;
$imcPercentValue = isset($imcBarPercent) ? $imcBarPercent : 0;
$objectifDescription = is_array($objectif ?? null) ? (string) ($objectif['description'] ?? 'Non défini') : 'Non défini';
$weightValue = is_array($infoSante ?? null) ? (float) ($infoSante['poids'] ?? 70) : 70;
$settings = $goldSettings ?? [];
$goldDiscount = (float) ($settings['gold_discount'] ?? 0.15);
$goldPrice = (float) ($settings['gold_price'] ?? 10000);
$goldCurrency = (string) ($settings['gold_currency'] ?? 'Ar');
$generalCurrency = (string) ($settings['general_currency'] ?? 'Ar');
$goldDiscountPercent = $goldDiscount * 100;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              sauge: '#8A9A5B',
            }
          }
        }
      }
    </script>
        <style>
                @media print {
                        body * {
                                visibility: hidden;
                        }
                        #regimes-section, #regimes-section * {
                                visibility: visible;
                        }
                        #regimes-section {
                                position: absolute;
                                left: 0;
                                top: 0;
                                width: 100%;
                        }
                }
        </style>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
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
                <a href="<?= site_url('users/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('users/objectives') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
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
                <a href="<?= site_url('login') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium text-stone-500 hover:bg-red-50 hover:text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
                
                <!-- Header -->
                <header class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <p class="text-stone-500 text-sm font-medium tracking-wide uppercase mb-1">Résumé de la semaine</p>
                        <h2 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight">Bonjour, <?= esc($username) ?>.</h2>
                    </div>
                    <div class="flex items-center gap-4">
                        <button class="js-print-btn flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-stone-200 text-stone-600 text-sm font-medium hover:bg-stone-50 transition-colors shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            Exporter regimes suggeres (PDF)
                        </button>
                        <div class="h-10 w-10 rounded-full bg-stone-200 overflow-hidden border-2 border-white shadow-sm ring-1 ring-stone-200">
                            <img src="https://images.unsplash.com/photo-1772146345330-e35689b58b2d?w=150" alt="Profile" class="w-full h-full object-cover" />
                        </div>
                    </div>
                </header>

                <!-- Top Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    
                    <!-- IMC Card -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border border-stone-100 relative overflow-hidden group hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all duration-500 ease-out cursor-pointer" onclick="window.location.href='<?= site_url('users/objectives') ?>'">​
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <p class="text-stone-400 text-sm font-medium uppercase tracking-wider mb-2">Indice de Masse</p>
                                <h3 class="text-4xl font-light text-stone-800 tracking-tight"><?= $imcValue !== null ? esc((string) $imcValue) : '--' ?><span class="text-sm text-stone-400 font-normal ml-1">IMC</span></h3>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-sauge/10 text-sauge flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-xs font-medium text-stone-400">
                                <span>18.5</span>
                                <span class="text-sauge">Poids idéal</span>
                                <span>25.0</span>
                            </div>
                            <div class="h-2 w-full bg-stone-100 rounded-full overflow-hidden flex relative">
                                <div class="absolute top-0 bottom-0 left-[20%] right-[30%] bg-sauge/20 rounded-full z-0"></div>
                                <div class="js-imc-bar h-full bg-stone-800 rounded-full relative z-10 transition-all duration-1000 ease-out w-0" style="width: <?= esc((string) $imcPercentValue) ?>%">
                                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-3 bg-white rounded-full shadow-sm border-2 border-stone-800 transform translate-x-1/2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Wallet Card -->
                    <div class="bg-white rounded-3xl p-6 md:p-8 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border border-stone-100 flex flex-col justify-between group hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all duration-500 ease-out cursor-pointer" onclick="window.location.href='<?= site_url('users/wallet') ?>'">​
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-stone-400 text-sm font-medium uppercase tracking-wider mb-2">Portefeuille</p>
                                <h3 class="text-4xl font-light text-stone-800 tracking-tight"><?= number_format($wallet, 2, '.', '') ?><span class="text-xl text-stone-400 font-normal ml-1"><?= esc($generalCurrency) ?></span></h3>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-stone-50 text-stone-500 flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                            </div>
                        </div>
                        <button class="w-full mt-8 py-3 rounded-xl bg-stone-800 text-white text-sm font-medium hover:bg-stone-700 transition-colors flex items-center justify-center gap-2">
                            Gérer mon solde
                        </button>
                    </div>

                    <!-- Gold Status Card -->
                    <div class="rounded-3xl p-6 md:p-8 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border flex flex-col justify-between group hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all duration-500 ease-out bg-gradient-to-br from-[#F5F2EE] to-[#EBE4D8] border-[#E3D9C8]">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold mb-4 tracking-wider uppercase bg-[#D4C3A3]/30 text-[#8C7342]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                                    Option Gold
                                </div>
                                <p class="text-sm leading-relaxed pr-4 text-[#5C4F3A]">
                                    <?= $isGold ? 'Votre reduction Gold de ' . round($goldDiscountPercent) . '% est active.' : 'Beneficiez de ' . round($goldDiscountPercent) . '% de remise sur tous les regimes.' ?>
                                </p>
                            </div>
                        </div>
                        <?php if (!$isGold): ?>
                            <a href="<?= site_url('users/wallet') ?>" class="w-full mt-8 py-3 rounded-xl bg-[#8C7342] text-white text-sm font-medium hover:bg-[#7A6438] transition-colors shadow-lg shadow-[#8C7342]/20 text-center">
                                Activer pour <?= number_format($goldPrice, 0, ',', '.') ?> <?= esc($goldCurrency) ?>
                            </a>
                        <?php else: ?>
                            <div class="w-full mt-8 py-3 rounded-xl bg-emerald-50 text-emerald-600 text-sm font-medium text-center">✓ Gold active</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- NEW: Chart Section (Évolution du poids) -->
                <div class="bg-white rounded-3xl p-6 md:p-10 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border border-stone-100 mb-12">
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h3 class="text-xl font-medium text-stone-800">Évolution du poids</h3>
                            <p class="text-stone-400 text-sm mt-1">Sur les 6 derniers mois</p>
                        </div>
                        <select class="bg-stone-50 border border-stone-200 text-stone-600 text-sm rounded-xl px-4 py-2 outline-none focus:border-stone-300 transition-colors appearance-none cursor-pointer">
                            <option>6 mois</option>
                            <option>1 an</option>
                        </select>
                    </div>
                    <div class="h-72 w-full">
                        <!-- Canvas pour Chart.js -->
                        <canvas id="weightChart"></canvas>
                    </div>
                </div>

                <!-- Diets Section -->
                <div class="mb-12" id="regimes-section">
                    <div class="flex justify-between items-end mb-8">
                        <div>
                            <h3 class="text-3xl font-light text-stone-800 mb-2 tracking-tight">Régimes suggérés</h3>
                            <p class="text-stone-400">Adaptés à votre objectif: <?= esc($objectifDescription) ?></p>
                        </div>
                        <a href="<?= site_url('users/program') ?>" class="text-stone-500 hover:text-stone-800 text-sm font-medium flex items-center gap-1.5 transition-colors pb-1">
                            Voir tout 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php if (!empty($regimes)): ?>
                            <?php foreach ($regimes as $regime): ?>
                                <div class="group cursor-pointer flex flex-col h-full" onclick="window.location.href='<?= site_url('users/program') ?>'">​
                                    <div class="relative aspect-[4/3] rounded-3xl overflow-hidden mb-5 bg-stone-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)]">
                                        <img src="<?= esc(!empty($regime['image']) ? base_url('assets/images/' . $regime['image']) : 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=800&q=80') ?>" alt="Régime" class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                                        <div class="absolute top-4 right-4 px-4 py-1.5 bg-white/90 backdrop-blur-md rounded-full text-xs font-semibold tracking-wide text-stone-800 shadow-sm">
                                            <?= esc((string) round((float) ($regime['constatation'] ?? 0), 2)) ?> kg/semaine
                                        </div>
                                    </div>
                                    <div class="px-2 flex-1 flex flex-col">
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="text-xl font-medium text-stone-800 group-hover:text-sauge transition-colors"><?= esc((string) ($regime['nom'] ?? ('Régime #' . $regime['id']))) ?></h4>
                                            <span class="text-lg font-light text-stone-600"><?= number_format((float) ($regime['prixParSemaine'] ?? 0), 2, '.', '') ?><?= esc($generalCurrency) ?></span>
                                        </div>
                                        <p class="text-stone-500 text-sm line-clamp-2 leading-relaxed mb-5 flex-1">
                                            Régime adapté à votre profil et à votre objectif actuel.
                                        </p>
                                        <div class="flex items-center gap-5 text-[11px] text-stone-400 font-semibold uppercase tracking-widest pt-4 border-t border-stone-100">
                                            <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-[#8C7342]"></div>Viande <?= esc((string) ($regime['pourcentage_viande'] ?? 0)) ?>%</div>
                                            <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-[#5A7B8C]"></div>Poisson <?= esc((string) ($regime['pourcentage_poisson'] ?? 0)) ?>%</div>
                                            <div class="flex items-center gap-2"><div class="w-2 h-2 rounded-full bg-[#8A9A5B]"></div>Volaille <?= esc((string) ($regime['pourcentage_volaille'] ?? 0)) ?>%</div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="md:col-span-3 rounded-2xl border border-stone-200 bg-white p-6 text-stone-500">
                                Aucun régime trouvé pour votre objectif actuel.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const printButton = document.querySelector('.js-print-btn');
            if (printButton) {
                printButton.addEventListener('click', function() {
                    window.print();
                });
            }

            const ctx = document.getElementById('weightChart').getContext('2d');
            const currentWeight = <?= json_encode($weightValue) ?>;
            const weightData = [
                +(currentWeight + 1.6).toFixed(1),
                +(currentWeight + 1.1).toFixed(1),
                +(currentWeight + 0.8).toFixed(1),
                +(currentWeight + 0.5).toFixed(1),
                +(currentWeight + 0.2).toFixed(1),
                +currentWeight.toFixed(1)
            ];
            const minWeight = Math.min(...weightData) - 2;
            const maxWeight = Math.max(...weightData) + 2;
            
            let gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(138, 154, 91, 0.2)');
            gradient.addColorStop(1, 'rgba(138, 154, 91, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                    datasets: [{
                        label: 'Poids (kg)',
                        data: weightData,
                        borderColor: '#8A9A5B',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#8A9A5B',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#292524',
                            bodyColor: '#57534e',
                            borderColor: '#E7E5E4',
                            borderWidth: 1,
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) { return context.raw + ' kg'; }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#A8A29E', font: { family: 'Inter', size: 13 } }
                        },
                        y: {
                            display: false,
                            min: minWeight,
                            max: maxWeight
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
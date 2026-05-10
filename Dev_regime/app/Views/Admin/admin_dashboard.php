<?php
$userCountValue = (int) ($userCount ?? 0);
$regimeCountValue = (int) ($regimeCount ?? 0);
$activeCodesCountValue = (int) ($activeCodesCount ?? 0);
$totalRevenueValue = (float) ($totalRevenue ?? 0);
$recentPurchasesList = $recentPurchases ?? [];
$salesLabelsValue = $salesLabels ?? [];
$salesDataValue = $salesData ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-stone-900 text-stone-100 font-sans">

    <div class="min-h-screen flex overflow-hidden">
        
        <!-- Sidebar Admin -->
        <aside class="w-64 bg-stone-950 border-r border-stone-800 flex-col hidden md:flex sticky top-0 h-screen z-10">
            <div class="p-8 pb-4">
                <h1 class="text-xl tracking-wide font-medium text-white flex items-center gap-2">
                    <span class="w-8 h-8 rounded-md bg-stone-800 text-stone-300 flex items-center justify-center shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
                    </span>
                    Back-Office
                </h1>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">
                <a href="<?= site_url('admin/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('admin/regimes') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Gest. Régimes
                </a>
                <a href="<?= site_url('admin/sports') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.4 14.4 9.6 9.6M18.65 21.35a2 2 0 0 1-2.83 0L2.65 8.18a2 2 0 0 1 0-2.83l.7-.7a2 2 0 0 1 2.83 0l13.17 13.17a2 2 0 0 1 0 2.83Z"/><path d="m7.57 9.25-1.41 1.41a2 2 0 0 1-2.83 0l-1.41-1.41a2 2 0 0 1 0-2.83l1.41-1.41a2 2 0 0 1 2.83 0l1.41 1.41a2 2 0 0 1 0 2.83Z"/></svg>
                    Gest. Sports
                </a>
                <a href="<?= site_url('admin/codes') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"/><path d="m21 2-9.6 9.6"/><circle cx="7.5" cy="15.5" r="5.5"/></svg>
                    Codes Promo
                </a>
                <a href="<?= site_url('admin/users') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Utilisateurs
                </a>
                <a href="<?= site_url('admin/settings') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8a4 4 0 1 0 4 4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                    Parametres
                </a>
            </nav>

            <div class="p-4 border-t border-stone-800">
                <a href="<?= site_url('logout') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium text-stone-400 hover:bg-red-500/10 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
                
                <header class="mb-12">
                    <h2 class="text-3xl font-medium text-white mb-2">Tableau de bord</h2>
                    <p class="text-stone-400">Aperçu général de l'activité de NutriFlow.</p>
                </header>

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-stone-400 text-sm font-medium">Utilisateurs</p>
                            <div class="p-2 bg-blue-500/10 text-blue-400 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-semibold text-white"><?= number_format($userCountValue, 0, ',', '.') ?></h3>
                        <p class="text-emerald-400 text-xs font-medium mt-2">+12% ce mois</p>
                    </div>

                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-stone-400 text-sm font-medium">Chiffre d'Affaires</p>
                            <div class="p-2 bg-emerald-500/10 text-emerald-400 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10h12"/><path d="M4 14h9"/><path d="M19 6a7.7 7.7 0 0 0-5.2-2A7.9 7.9 0 0 0 6 12c0 4.4 3.5 8 7.8 8 2 0 3.8-.8 5.2-2"/></svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-semibold text-white"><?= number_format($totalRevenueValue, 2, '.', '') ?>Ar</h3>
                        <p class="text-emerald-400 text-xs font-medium mt-2">+5.4% ce mois</p>
                    </div>

                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-stone-400 text-sm font-medium">Régimes Actifs</p>
                            <div class="p-2 bg-amber-500/10 text-amber-400 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-semibold text-white"><?= number_format($regimeCountValue, 0, ',', '.') ?></h3>
                        <p class="text-stone-500 text-xs mt-2">Programmes disponibles</p>
                    </div>

                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <p class="text-stone-400 text-sm font-medium">Codes Promo Actifs</p>
                            <div class="p-2 bg-purple-500/10 text-purple-400 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                            </div>
                        </div>
                        <h3 class="text-3xl font-semibold text-white"><?= number_format($activeCodesCountValue, 0, ',', '.') ?></h3>
                        <p class="text-stone-500 text-xs mt-2">Sur 45 créés</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Chart -->
                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <h3 class="text-lg font-medium text-white mb-6">Ventes de la semaine</h3>
                        <div class="h-64 w-full">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="bg-stone-900 border border-stone-800 rounded-2xl p-6">
                        <h3 class="text-lg font-medium text-white mb-6">Derniers achats</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left">
                                <thead class="text-xs text-stone-500 uppercase bg-stone-950/50">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Utilisateur</th>
                                        <th class="px-4 py-3">Programme</th>
                                        <th class="px-4 py-3 rounded-tr-lg text-right">Montant</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-800">
                                    <?php if (!empty($recentPurchasesList)): ?>
                                        <?php foreach ($recentPurchasesList as $purchase): ?>
                                            <tr class="hover:bg-stone-800/30 transition-colors">
                                                <td class="px-4 py-4 text-stone-300"><?= esc((string) ($purchase['email'] ?? '')) ?></td>
                                                <td class="px-4 py-4 text-stone-400"><?= esc((string) ($purchase['nom'] ?? 'Régime')) ?></td>
                                                <td class="px-4 py-4 text-emerald-400 text-right font-medium">
                                                    <?= number_format((float) ($purchase['prixParSemaine'] ?? 0), 2, '.', '') ?>Ar
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td class="px-4 py-4 text-stone-500" colspan="3">Aucun achat recent.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            const labels = <?= json_encode($salesLabelsValue) ?>;
            const data = <?= json_encode($salesDataValue) ?>;

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventes',
                        data: data,
                        backgroundColor: '#8A9A5B',
                        borderRadius: { topLeft: 4, topRight: 4, bottomLeft: 0, bottomRight: 0 },
                        barPercentage: 0.5
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1C1917',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: '#292524',
                            borderWidth: 1,
                            padding: 12
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { color: '#78716C' }
                        },
                        y: {
                            grid: { color: '#292524', drawBorder: false, borderDash: [3, 3] },
                            ticks: { color: '#78716C' }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
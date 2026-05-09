<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Portefeuille</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { theme: { extend: { colors: { sauge: '#8A9A5B' } } } }
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-[#FAFAF8] text-stone-800 font-sans">
<?php
$userBalance = is_array($user ?? null) ? (float) ($user['argent'] ?? 0) : 0;
$isGold = is_array($user ?? null) ? !empty($user['modeGold']) : false;
$purchaseHistory = $purchases ?? [];
$settings = $goldSettings ?? [];
$goldDiscount = (float) ($settings['gold_discount'] ?? 0.15);
$goldPrice = (float) ($settings['gold_price'] ?? 10000);
$goldCurrency = (string) ($settings['gold_currency'] ?? 'Ar');
$generalCurrency = (string) ($settings['general_currency'] ?? 'Ar');
$lowBalanceThreshold = (float) ($settings['low_balance_threshold'] ?? 0);
$goldDiscountPercent = $goldDiscount * 100;
?>

    <div class="min-h-screen flex overflow-hidden">
        
        <?= view('users/sidebar', ['activePage' => 'wallet']) ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-4xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-12">
                    <h2 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-2">Portefeuille</h2>
                    <p class="text-stone-500">Gérez vos fonds et vos abonnements en toute simplicité.</p>
                </header>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    
                    <!-- Main Balance Card -->
                    <div class="bg-stone-800 text-white rounded-3xl p-8 relative overflow-hidden shadow-xl shadow-stone-800/20">
                        <div class="absolute top-0 right-0 p-8 opacity-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        </div>
                        
                        <div class="relative z-10 flex flex-col h-full justify-between min-h-[200px]">
                            <div>
                                <p class="text-stone-400 font-medium uppercase tracking-widest text-sm mb-2">Solde Actuel</p>
                                <h3 class="text-5xl font-light tracking-tight"><?= number_format($userBalance, 2, '.', '') ?><span class="text-2xl text-stone-400 ml-2"><?= esc($generalCurrency) ?></span></h3>
                            </div>
                            
                            <div class="flex gap-4 mt-8">
                                <button onclick="document.getElementById('addFunds').classList.toggle('hidden')" class="flex items-center justify-center gap-2 flex-1 bg-white text-stone-800 py-3 rounded-xl font-medium text-sm hover:bg-stone-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    Code promo
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Gold Subscription Card -->
                    <div class="rounded-3xl p-8 flex flex-col justify-between bg-gradient-to-br from-[#F5F2EE] to-[#EBE4D8] border border-[#E3D9C8]">
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs font-semibold mb-6 tracking-widest uppercase bg-[#D4C3A3]/30 text-[#8C7342]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/></svg>
                                NutriFlow Gold
                            </div>
                            
                            <h4 class="text-2xl font-light mb-2 text-[#5C4F3A]"><?= $isGold ? 'Gold Actif' : 'Passez au niveau supérieur' ?></h4>
                            <p class="text-sm leading-relaxed text-[#8C7342]">
                                <?= $isGold ? 'Vous bénéficiez d\'une réduction de ' . round($goldDiscountPercent) . '% sur tous les programmes!' : 'Débloquez ' . round($goldDiscountPercent) . '% de remise immédiate sur tous les programmes pour ' . number_format($goldPrice, 0, ',', '.') . ' ' . $goldCurrency . '.' ?>
                            </p>
                        </div>

                        <?php if (!$isGold): ?>
                        <form method="POST" action="<?= site_url('users/wallet/gold') ?>">
                            <button type="submit" class="w-full mt-8 py-3 rounded-xl bg-[#8C7342] text-white text-sm font-medium hover:bg-[#7A6438] transition-colors shadow-lg shadow-[#8C7342]/20 flex items-center justify-center gap-2">
                                Souscrire pour <?= number_format($goldPrice, 0, ',', '.') ?> <?= esc($goldCurrency) ?>
                            </button>
                        </form>
                        <?php else: ?>
                            <div class="w-full mt-8 py-3 rounded-xl bg-emerald-50 text-emerald-600 text-sm font-medium text-center">✓ Gold Activé</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Messages de Flash -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if ($lowBalanceThreshold > 0 && $userBalance < $lowBalanceThreshold): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-800 text-sm">
                        Votre solde est inferieur au seuil recommande de <?= number_format($lowBalanceThreshold, 2, '.', '') ?> <?= esc($generalCurrency) ?>.
                    </div>
                <?php endif; ?>

                <!-- Add Funds Panel (Hidden by default) -->
                <div id="addFunds" class="hidden mb-12 bg-white rounded-3xl p-8 border border-stone-100 shadow-[0_2px_20px_-4px_rgba(0,0,0,0.05)] overflow-hidden">
                    <h4 class="text-xl font-medium text-stone-800 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-stone-400"><path d="m15.5 7.5 2.3 2.3a1 1 0 0 0 1.4 0l2.1-2.1a1 1 0 0 0 0-1.4L19 4"/><path d="m21 2-9.6 9.6"/><circle cx="7.5" cy="15.5" r="5.5"/></svg>
                        Code promo
                    </h4>
                    <form method="POST" action="<?= site_url('users/wallet/promo') ?>" class="flex gap-4">
                        <input type="text" name="code" placeholder="Ex: WELCOME50" class="flex-1 px-4 py-3 rounded-xl border border-stone-200 text-stone-800 placeholder:text-stone-400 focus:outline-none focus:border-stone-400 " required />
                        <button type="submit" class="px-8 py-3 rounded-xl bg-stone-800 text-white font-medium hover:bg-stone-700 transition-colors">Valider le Code</button>
                    </form>
                    
                </div>

                <!-- Transactions -->

                <!-- Faut remplacer avec vrai historique -->
                <!-- Historique des transactions depuis la base de données -->
                <div class="bg-white rounded-3xl border border-stone-100 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] overflow-hidden mt-8">
                    <div class="px-8 py-6 border-b border-stone-100">
                        <h3 class="text-xl font-medium text-stone-800 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-stone-400"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            Historique des achats
                        </h3>
                    </div>

                    <div class="divide-y divide-stone-100 max-h-96 overflow-y-auto">
                        <?php if(!empty($purchaseHistory)): ?>
                            <?php $count = 0; foreach($purchaseHistory as $purchase): ?>
                                <?php
                                    if (!is_object($purchase) && !is_array($purchase)) {
                                        continue;
                                    }

                                    $purchaseNom = (string) (is_array($purchase) ? ($purchase['nom'] ?? 'Régime') : ($purchase->nom ?? 'Régime'));
                                    $purchaseDateRaw = is_array($purchase) ? ($purchase['created_at'] ?? 'now') : ($purchase->created_at ?? 'now');
                                    $purchaseDate = date('d M Y', strtotime((string) $purchaseDateRaw));
                                    $purchasePrice = (float) (is_array($purchase) ? ($purchase['prixParSemaine'] ?? 0) : ($purchase->prixParSemaine ?? 0));
                                ?>
                                <?php if($count >= 10) break; ?>
                                <div class="flex items-center justify-between p-6 hover:bg-stone-50 transition-colors">
                                    <div class="flex items-center gap-4 flex-1">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center bg-stone-100 text-stone-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="12 1 23 8 23 16 12 23 1 16 1 8 12 1"/></svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-stone-800"><?= esc($purchaseNom) ?></p>
                                            <p class="text-xs text-stone-400 mt-1"><?= esc($purchaseDate) ?></p>
                                        </div>
                                    </div>
                                    <div class="text-lg font-medium text-stone-800">-<?= number_format($purchasePrice, 2, '.', '') ?><?= esc($generalCurrency) ?></div>
                                </div>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="p-8 text-center text-stone-500">
                                <p>Aucun achat enregistré pour le moment.</p>
                                <p class="text-sm mt-2">Consultez la page des programmes pour commencer!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
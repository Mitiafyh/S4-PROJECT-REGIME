<?php
$goldPriceValue = (float) ($goldPrice ?? 10000);
$goldDiscountPercentValue = (float) ($goldDiscountPercent ?? 15);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Parametres avances</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-stone-900 text-stone-100 font-sans">

    <div class="min-h-screen flex overflow-hidden">
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
                <a href="<?= site_url('admin/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('admin/regimes') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Gest. Regimes
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
                <a href="<?= site_url('admin/settings') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/><circle cx="12" cy="12" r="4"/></svg>
                    Parametres avances
                </a>
            </nav>

            <div class="p-4 border-t border-stone-800">
                <a href="<?= site_url('loginAdmin') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium text-stone-400 hover:bg-red-500/10 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Deconnexion
                </a>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-4xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-10">
                    <h2 class="text-3xl font-medium text-white mb-2">Parametres avances</h2>
                    <p class="text-stone-400">Ajustez les regles de l'option Gold et les valeurs globales.</p>
                </header>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-200 text-sm">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-200 text-sm">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="bg-stone-900 border border-stone-800 rounded-2xl p-8 shadow-xl shadow-black/20">
                    <form method="POST" action="<?= site_url('admin/settings') ?>" class="space-y-6">
                        <?= csrf_field() ?>
                        <div>
                            <label class="block text-xs font-medium text-stone-500 mb-2">Prix Gold (Ar)</label>
                            <input type="number" name="gold_price" min="0" step="1" value="<?= esc((string) $goldPriceValue) ?>" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage de remise Gold (%)</label>
                            <input type="number" name="gold_discount_percent" min="0" max="100" step="0.1" value="<?= esc((string) $goldDiscountPercentValue) ?>" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

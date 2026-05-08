<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Programmes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { theme: { extend: { colors: { sauge: '#8A9A5B' } } } }
    </script>
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
                <a href="<?= site_url('users/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('users/objectives') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-500 hover:bg-stone-100/50 hover:text-stone-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                    Mes objectifs
                </a>
                <a href="<?= site_url('users/program') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
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
            <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-12">
                    <h2 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-2">Programmes</h2>
                    <p class="text-stone-500">Découvrez nos régimes conçus par des experts nutritionnistes.</p>
                </header>

                <?php 
                    $messages = session()->getFlashdata();
                    if($messages):
                        foreach($messages as $type => $message):
                            echo '<div class="mb-4 p-4 rounded-lg ' . ($type === 'error' ? 'bg-red-50 text-red-700' : 'bg-green-50 text-green-700') . '">';
                            echo esc((string)$message);
                            echo '</div>';
                        endforeach;
                    endif;
                ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if(!empty($allRegimes)): ?>
                        <?php foreach($allRegimes as $regime): ?>
                            <?php 
                                $isOwned = in_array($regime['id'], $userRegimeIds ?? []);
                                $price = (float)($regime['prixParSemaine'] ?? 0);
                                $isGold = !empty($user['modeGold']) ? true : false;
                                $finalPrice = $isOwned ? $price : $price * ($isGold ? 0.85 : 1);
                            ?>
                            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border border-stone-100 flex flex-col md:flex-row group hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all">
                                <div class="w-full md:w-2/5 aspect-[4/3] md:aspect-auto relative overflow-hidden bg-stone-100">
                                    <img src="<?= esc((string)($regime['image'] ?? 'https://images.unsplash.com/photo-1598235002035-f8875f7f757e?w=800')) ?>" alt="<?= esc((string)($regime['nom'] ?? 'Régime')) ?>" class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                                    <?php if($isOwned): ?>
                                        <div class="absolute top-4 left-4 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="text-xl font-medium text-stone-800"><?= esc((string)($regime['nom'] ?? 'Sans nom')) ?></h4>
                                            <span class="text-xs font-semibold px-3 py-1 bg-stone-100 text-stone-600 rounded-full">1 semaine</span>
                                        </div>
                                        <p class="text-stone-500 text-sm leading-relaxed mb-6">Régime adapté à votre profil nutritionnel.</p>
                                        <div class="space-y-2 mb-8">
                                            <p class="text-xs font-medium text-stone-400 uppercase tracking-widest mb-3">Composition</p>
                                            <div class="h-2 w-full flex rounded-full overflow-hidden">
                                                <div style="width: <?= intval($regime['pourcentage_viande'] ?? 0) ?>%" class="bg-[#8C7342]"></div>
                                                <div style="width: <?= intval($regime['pourcentage_poisson'] ?? 0) ?>%" class="bg-[#5A7B8C]"></div>
                                                <div style="width: <?= intval($regime['pourcentage_volaille'] ?? 0) ?>%" class="bg-[#8A9A5B]"></div>
                                                <div style="width: <?= 100 - intval($regime['pourcentage_viande'] ?? 0) - intval($regime['pourcentage_poisson'] ?? 0) - intval($regime['pourcentage_volaille'] ?? 0) ?>%" class="bg-stone-200"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-stone-100">
                                        <span class="text-2xl font-light text-stone-800"><?= number_format($finalPrice, 2, '.', '') ?>€</span>
                                        <?php if($isOwned): ?>
                                            <button disabled class="px-6 py-2.5 rounded-xl bg-emerald-50 text-emerald-600 font-medium text-sm cursor-default">Acquis</button>
                                        <?php else: ?>
                                            <form method="POST" action="<?= site_url('users/program/buy') ?>" style="display:inline;">
                                                <input type="hidden" name="regime_id" value="<?= esc((string)$regime['id']) ?>" />
                                                <button type="submit" class="px-6 py-2.5 rounded-xl bg-stone-800 text-white font-medium text-sm hover:bg-stone-700 transition-colors shadow-lg shadow-stone-800/10">Acheter</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
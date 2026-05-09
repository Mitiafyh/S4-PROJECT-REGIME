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
<?php
$settings = $goldSettings ?? [];
$goldDiscount = (float) ($settings['gold_discount'] ?? 0.15);
$generalCurrency = (string) ($settings['general_currency'] ?? 'Ar');
?>
    <div class="min-h-screen flex overflow-hidden">
        
        <?= view('users/sidebar', ['activePage' => 'program']) ?>

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

                <?php if (!empty($ownedRegimes)): ?>
                    <div class="mb-10">
                        <h3 class="text-xl font-medium text-stone-800 mb-4">Regimes deja achetes</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ($ownedRegimes as $regime): ?>
                                <?php
                                    $imageValue = (string) ($regime['image'] ?? '');
                                    $isRemote = preg_match('/^https?:\/\//i', $imageValue) === 1;
                                    $imageSrc = $imageValue !== ''
                                        ? ($isRemote ? $imageValue : base_url('images/regimes/' . $imageValue))
                                        : 'https://images.unsplash.com/photo-1598235002035-f8875f7f757e?w=300';
                                ?>
                                <div class="bg-white rounded-3xl border border-stone-100 p-6 flex items-center gap-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)]">
                                    <div class="w-16 h-16 rounded-2xl overflow-hidden bg-stone-100">
                                        <img src="<?= esc((string) $imageSrc) ?>" alt="<?= esc((string)($regime['nom'] ?? 'Régime')) ?>" class="w-full h-full object-cover" />
                                    </div>
                                    <div>
                                        <p class="font-medium text-stone-800"><?= esc((string)($regime['nom'] ?? 'Régime')) ?></p>
                                        <p class="text-xs text-stone-500 mt-1">Duree: <?= esc((string) ($regime['duree_semaines'] ?? 4)) ?> semaines</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if(!empty($allRegimes)): ?>
                        <?php foreach($allRegimes as $regime): ?>
                            <?php 
                                $isOwned = in_array($regime['id'], $userRegimeIds ?? []);
                                $price = (float)($regime['prixParSemaine'] ?? 0);
                                $isGold = !empty($user['modeGold']) ? true : false;
                                $discount = $isGold ? $goldDiscount : 0;
                                $finalPrice = $isOwned ? $price : $price * (1 - $discount);
                                $imageValue = (string) ($regime['image'] ?? '');
                                $isRemote = preg_match('/^https?:\/\//i', $imageValue) === 1;
                                $imageSrc = $imageValue !== ''
                                    ? ($isRemote ? $imageValue : base_url('images/regimes/' . $imageValue))
                                    : 'https://images.unsplash.com/photo-1598235002035-f8875f7f757e?w=800';
                            ?>
                            <div class="bg-white rounded-3xl overflow-hidden shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border border-stone-100 flex flex-col md:flex-row group hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all">
                                <div class="w-full md:w-52 md:flex-none aspect-[4/3] md:aspect-auto md:min-h-[240px] relative overflow-hidden bg-stone-50 flex items-center justify-center p-4">
                                    <img src="<?= esc((string) $imageSrc) ?>" alt="<?= esc((string)($regime['nom'] ?? 'Régime')) ?>" class="max-w-full max-h-full w-auto h-auto object-contain transition-transform duration-1000 ease-out group-hover:scale-105" />
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
                                            <span class="text-xs font-semibold px-3 py-1 bg-stone-100 text-stone-600 rounded-full"><?= esc((string) ($regime['duree_semaines'] ?? 4)) ?> semaines</span>
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
                                        <span class="text-2xl font-light text-stone-800"><?= number_format($finalPrice, 2, '.', '') ?><?= esc($generalCurrency) ?></span>
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
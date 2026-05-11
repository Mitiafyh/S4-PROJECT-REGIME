<?php
$username = is_array($user ?? null) ? (string) ($user['username'] ?? 'Utilisateur') : 'Utilisateur';
$activitiesList = $allActivities ?? [];
$userActivityIds = array_map('intval', is_array($userActivityIds ?? null) ? $userActivityIds : []);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Activités</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = { theme: { extend: { colors: { sauge: '#8A9A5B' } } } }
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-[#FAFAF8] text-stone-800 font-sans">

    <div class="min-h-screen flex overflow-hidden">
        
        <?= view('users/sidebar', ['activePage' => 'activities']) ?>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-12">
                    <h2 class="text-3xl md:text-4xl font-light text-stone-800 tracking-tight mb-2">Activités</h2>
                    <p class="text-stone-500">Des routines d'entraînement adaptées à votre progression.</p>
                </header>

                <!-- Featured Activity -->
                <div class="relative rounded-3xl overflow-hidden aspect-[21/9] md:aspect-[21/7] mb-12 shadow-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1759106539822-b31de23ad1de?w=1080&q=80" alt="Featured" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" />
                    <div class="absolute inset-0 bg-gradient-to-t from-stone-900/80 via-stone-900/20 to-transparent"></div>
                    
                    <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12 flex items-end justify-between">
                        <div class="text-white">
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/20 backdrop-blur-md text-sm font-medium mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> 
                                45 min
                            </div>
                            <h3 class="text-3xl md:text-5xl font-light mb-2">Course Matinale</h3>
                            <p class="text-white/80 max-w-lg line-clamp-2">Idéal pour brûler les graisses en douceur. Un rythme modéré pour maximiser la lipolyse.</p>
                        </div>
                        
                        <button class="w-16 h-16 rounded-full bg-white text-stone-800 flex items-center justify-center shadow-xl hover:scale-105 transition-transform shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="ml-1"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Catalog -->
                <h3 class="text-2xl font-light text-stone-800 mb-6">Toutes les séances</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php if(!empty($activitiesList)): ?>
                        <?php foreach($activitiesList as $activity): ?>
                            <?php 
                                if (!is_object($activity) && !is_array($activity)) {
                                    continue;
                                }

                                $activityId = (int) (is_array($activity) ? ($activity['id'] ?? 0) : ($activity->id ?? 0));
                                $depenseCalorique = (int) (is_array($activity) ? ($activity['depense_calorique'] ?? 0) : ($activity->depense_calorique ?? 0));
                                $activityType = (string) (is_array($activity) ? ($activity['type'] ?? 'Activité') : ($activity->type ?? 'Activité'));
                                $activityDuree = (int) (is_array($activity) ? ($activity['duree'] ?? 0) : ($activity->duree ?? 0));

                                $isSelected = in_array($activityId, $userActivityIds, true);
                                $imageValue = (string) (is_array($activity) ? ($activity['image'] ?? '') : ($activity->image ?? ''));
                                $imageValue = trim($imageValue);
                                $images = [
                                    'https://images.unsplash.com/photo-1611077094679-97c56013ddd3?w=800',
                                    'https://images.unsplash.com/photo-1771270786606-f5a0e57db762?w=800',
                                    'https://images.unsplash.com/photo-1571019614242-c5c5adee1150?w=800',
                                    'https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800',
                                ];
                                $imageIndex = count($images) > 0 ? ($activityId > 0 ? ($activityId - 1) % count($images) : 0) : 0;
                                $fallbackImage = $images[$imageIndex] ?? $images[0];
                                $image = $imageValue !== ''
                                    ? base_url('images/sports/' . $imageValue)
                                    : $fallbackImage;
                                $intensite = $depenseCalorique > 400 ? 'Intense' : ($depenseCalorique > 250 ? 'Modérée' : 'Douce');
                            ?>
                            <div class="group cursor-pointer flex flex-col h-full bg-white rounded-3xl p-4 shadow-[0_2px_10px_-4px_rgba(0,0,0,0.02)] border <?= $isSelected ? 'border-emerald-200 bg-emerald-50' : 'border-stone-100' ?> hover:shadow-[0_12px_40px_-4px_rgba(0,0,0,0.06)] transition-all duration-500">
                                <div class="relative aspect-[4/3] rounded-2xl overflow-hidden mb-5 bg-stone-100">
                                    <img src="<?= esc((string)$image) ?>" class="w-full h-full object-cover transition-transform duration-1000 ease-out group-hover:scale-105" />
                                    <?php if($isSelected): ?>
                                        <div class="absolute top-2 right-2 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute inset-0 bg-stone-900/0 group-hover:bg-stone-900/10 transition-colors flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 drop-shadow-lg"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
                                    </div>
                                </div>
                                <div class="px-2 flex-1 flex flex-col">
                                    <div class="inline-flex self-start items-center px-2 py-1 rounded text-[10px] font-semibold tracking-wide uppercase bg-stone-100 text-stone-500 mb-3"><?= esc($intensite) ?></div>
                                    <h4 class="text-xl font-medium text-stone-800 mb-2"><?= esc($activityType) ?></h4>
                                    <p class="text-stone-500 text-sm flex items-center gap-2 mt-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-sauge"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                                        <?= $activityDuree ?> min | Dépense: <?= $depenseCalorique ?> cal
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-3 text-center py-12">
                            <p class="text-stone-500">Aucune activité disponible pour le moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
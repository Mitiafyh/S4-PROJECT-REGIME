<?php
$regimesList = $regimes ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Admin Régimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <a href="<?= site_url('admin/dashboard') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5V19A9 3 0 0 0 21 19V5"/><path d="M3 12A9 3 0 0 0 21 12"/></svg>
                    Tableau de bord
                </a>
                <a href="<?= site_url('admin/regimes') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
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
                
                <div class="flex justify-between items-center mb-12">
                    <header>
                        <h2 class="text-3xl font-medium text-white mb-2">Régimes</h2>
                        <p class="text-stone-400">Gérez les programmes diététiques proposés aux utilisateurs.</p>
                    </header>
                    <button onclick="openModal()" class="bg-[#8A9A5B] hover:bg-[#778550] text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-[#8A9A5B]/20 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Nouveau régime
                    </button>
                </div>

                <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20 relative z-0">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-stone-500 uppercase bg-stone-950">
                                <tr>
                                    <th class="px-6 py-4">Image</th>
                                    <th class="px-6 py-4">Titre & Description</th>
                                    <th class="px-6 py-4">Constatation</th>
                                    <th class="px-6 py-4">Duree</th>
                                    <th class="px-6 py-4">Prix</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-800">
                                <?php if (!empty($regimesList)): ?>
                                    <?php foreach ($regimesList as $regime): ?>
                                        <?php
                                            $imageValue = (string) ($regime['image'] ?? '');
                                            $imageSrc = base_url('images/regimes/' . $imageValue);
                                        ?>
                                        <tr class="hover:bg-stone-800/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="w-16 h-12 rounded-lg bg-stone-800 overflow-hidden">
                                                    <img src="<?= esc((string) $imageSrc) ?>" class="w-full h-full object-cover" alt="<?= esc((string) ($regime['nom'] ?? 'Regime')) ?>">
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-medium text-stone-200"><?= esc((string) ($regime['nom'] ?? 'Regime')) ?></p>
                                                <p class="text-xs text-stone-500 truncate w-48">Regime base sur vos objectifs.</p>
                                            </td>
                                            <td class="px-6 py-4 text-stone-400">
                                                <?= number_format((float) ($regime['constatation'] ?? 0), 2, '.', '') ?> kg/sem
                                            </td>
                                            <td class="px-6 py-4 text-stone-400">
                                                <?= esc((string) ($regime['duree_semaines'] ?? 4)) ?> sem
                                            </td>
                                            <td class="px-6 py-4 font-medium text-emerald-400">
                                                <?= number_format((float) ($regime['prixParSemaine'] ?? 0), 2, '.', '') ?>Ar
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button
                                                    class="text-stone-400 hover:text-white px-2 py-1 js-edit-btn"
                                                    type="button"
                                                    data-id="<?= esc((string) ($regime['id'] ?? '')) ?>"
                                                    data-nom="<?= esc((string) ($regime['nom'] ?? '')) ?>"
                                                    data-viande="<?= esc((string) ($regime['pourcentage_viande'] ?? '')) ?>"
                                                    data-poisson="<?= esc((string) ($regime['pourcentage_poisson'] ?? '')) ?>"
                                                    data-volaille="<?= esc((string) ($regime['pourcentage_volaille'] ?? '')) ?>"
                                                    data-constatation="<?= esc((string) ($regime['constatation'] ?? '')) ?>"
                                                    data-duree="<?= esc((string) ($regime['duree_semaines'] ?? 4)) ?>"
                                                    data-prix="<?= esc((string) ($regime['prixParSemaine'] ?? '')) ?>"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                                </button>
                                                <a href="<?= site_url('supprimerRegime/' . ($regime['id'] ?? 0)) ?>" class="text-rose-400 hover:text-rose-300 px-2 py-1" onclick="return confirm('Supprimer ce regime ?');">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-6 text-stone-500">Aucun regime en base.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- MODAL : Modifier un Régime -->
    <div id="editRegimeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="editRegimeModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeEditModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Modifier un regime</h3>
            <p class="text-stone-400 text-sm mb-8">Mettez a jour les informations du regime.</p>

            <form id="editRegimeForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Titre du regime</label>
                        <input name="nom" id="edit_nom" type="text" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Image (fichier)</label>
                        <input name="image" id="edit_image" type="file" accept="image/*" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Constatation (kg/sem)</label>
                        <input name="constatation" id="edit_constatation" type="number" step="0.01" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Duree (semaines)</label>
                        <input name="duree_semaines" id="edit_duree" type="number" step="1" min="1" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Prix (Ar)</label>
                        <input name="prixParSemaine" id="edit_prix" type="number" step="0.01" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-stone-950 border border-stone-800">
                    <p class="text-sm font-medium text-stone-300 mb-4">Composition (Doit faire 100% au total)</p>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Viandes (%)</label>
                            <input name="pourcentage_viande" id="edit_viande" type="number" step="0.1" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Poissons (%)</label>
                            <input name="pourcentage_poisson" id="edit_poisson" type="number" step="0.1" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Volaille (%)</label>
                            <input name="pourcentage_volaille" id="edit_volaille" type="number" step="0.1" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL : Ajouter un Régime -->
    <div id="addRegimeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="addRegimeModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            
            <!-- Close Button -->
            <button onclick="closeModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>
            
            <h3 class="text-2xl font-medium text-white mb-2">Ajouter un régime</h3>
            <p class="text-stone-400 text-sm mb-8">Remplissez les informations ci-dessous pour créer un nouveau programme diététique.</p>
            
            <!-- Form -->
            <form method="POST" action="<?= site_url('insertRegime') ?>" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Titre -->
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Titre du regime</label>
                        <input name="nom" type="text" required placeholder="Ex: Detox Intense" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Image (fichier)</label>
                        <input name="image" type="file" accept="image/*" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Constatation (kg/sem)</label>
                        <input name="constatation" type="number" step="0.01" required placeholder="-0.5" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Duree (semaines)</label>
                        <input name="duree_semaines" type="number" step="1" min="1" required placeholder="4" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Prix (Ar)</label>
                        <input name="prixParSemaine" type="number" step="0.01" required placeholder="45" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                </div>

                <!-- Composition -->
                <div class="p-6 rounded-2xl bg-stone-950 border border-stone-800">
                    <p class="text-sm font-medium text-stone-300 mb-4">Composition (Doit faire 100% au total)</p>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Viandes (%)</label>
                            <input name="pourcentage_viande" type="number" step="0.1" placeholder="10" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Poissons (%)</label>
                            <input name="pourcentage_poisson" type="number" step="0.1" placeholder="20" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                        <div>
                            <label class="block text-xs text-stone-500 mb-2">Végétal (%)</label>
                            <input name="pourcentage_volaille" type="number" step="0.1" placeholder="70" class="w-full px-4 py-2 bg-stone-900 border border-stone-800 rounded-lg text-white focus:outline-none focus:border-stone-600">
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">
                        Annuler
                    </button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fonctions pour gérer la modale avec animation (UI statique)
        const modal = document.getElementById('addRegimeModal');
        const modalContent = document.getElementById('addRegimeModalContent');
        const editModal = document.getElementById('editRegimeModal');
        const editModalContent = document.getElementById('editRegimeModalContent');
        const editForm = document.getElementById('editRegimeForm');

        function openModal() {
            // Afficher le conteneur flex
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Forcer le reflow du navigateur pour que l'animation CSS fonctionne
            void modal.offsetWidth;
            
            // Lancer les transitions (opacité et zoom)
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeModal() {
            // Inverser les transitions
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            // Attendre la fin de l'animation CSS (300ms) avant de cacher le conteneur
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

        function openEditModal(data) {
            editForm.action = `<?= site_url('modifierRegime') ?>/${data.id}`;
            document.getElementById('edit_nom').value = data.nom;
            document.getElementById('edit_viande').value = data.viande;
            document.getElementById('edit_poisson').value = data.poisson;
            document.getElementById('edit_volaille').value = data.volaille;
            document.getElementById('edit_constatation').value = data.constatation;
            document.getElementById('edit_duree').value = data.duree;
            document.getElementById('edit_prix').value = data.prix;
            editModal.classList.remove('hidden');
            editModal.classList.add('flex');
            void editModal.offsetWidth;
            editModal.classList.remove('opacity-0');
            editModalContent.classList.remove('scale-95');
            editModalContent.classList.add('scale-100');
        }

        function closeEditModal() {
            editModal.classList.add('opacity-0');
            editModalContent.classList.remove('scale-100');
            editModalContent.classList.add('scale-95');
            setTimeout(() => {
                editModal.classList.remove('flex');
                editModal.classList.add('hidden');
            }, 300);
        }

        document.querySelectorAll('.js-edit-btn').forEach((button) => {
            button.addEventListener('click', () => {
                openEditModal({
                    id: button.dataset.id,
                    nom: button.dataset.nom || '',
                    viande: button.dataset.viande || 0,
                    poisson: button.dataset.poisson || 0,
                    volaille: button.dataset.volaille || 0,
                    constatation: button.dataset.constatation || 0,
                    duree: button.dataset.duree || 4,
                    prix: button.dataset.prix || 0
                });
            });
        });
    </script>
</body>
</html>
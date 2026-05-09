<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Admin Regimes</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= esc(base_url('assets/css/style.css')) ?>">
</head>
<body class="bg-stone-900 text-stone-100 font-sans">
    <main class="min-h-screen">
        <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
            <div class="flex justify-between items-center mb-12">
                <header>
                    <h2 class="text-3xl font-medium text-white mb-2">Regimes</h2>
                    <p class="text-stone-400">Gerez les programmes dietetiques proposes aux utilisateurs.</p>
                </header>
                <button onclick="openAddModal()" class="bg-[#8A9A5B] hover:bg-[#778550] text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-[#8A9A5B]/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nouveau regime
                </button>
            </div>

            <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20 relative z-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-stone-500 uppercase bg-stone-950">
                            <tr>
                                <th class="px-6 py-4">Image</th>
                                <th class="px-6 py-4">Nom</th>
                                <th class="px-6 py-4">Viande</th>
                                <th class="px-6 py-4">Poisson</th>
                                <th class="px-6 py-4">Volaille</th>
                                <th class="px-6 py-4">Constatation</th>
                                <th class="px-6 py-4">Prix / semaine</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-800">
                            <?php foreach ($regimes as $regime): ?>
                            <tr class="hover:bg-stone-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-16 h-12 rounded-lg bg-stone-800 overflow-hidden">
                                        <img src="<?= esc(base_url('images/regimes/' . $regime['image'])) ?>" class="w-full h-full object-cover" alt="Image du regime">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['nom']) ?></td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_viande']) ?>%</td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_poisson']) ?>%</td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_volaille']) ?>%</td>
                                <td class="px-6 py-4 text-stone-400"><?= esc((string) $regime['constatation']) ?></td>
                                <td class="px-6 py-4 font-medium text-emerald-400"><?= esc((string) $regime['prixParSemaine']) ?>Ar</td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="text-stone-400 hover:text-white px-2 py-1 js-edit-btn"
                                        type="button"
                                        data-id="<?= esc((string) $regime['id']) ?>"
                                        data-nom="<?= esc((string) ($regime['nom'] ?? '')) ?>"
                                        data-viande="<?= esc((string) $regime['pourcentage_viande']) ?>"
                                        data-poisson="<?= esc((string) $regime['pourcentage_poisson']) ?>"
                                        data-volaille="<?= esc((string) $regime['pourcentage_volaille']) ?>"
                                        data-constatation="<?= esc((string) $regime['constatation']) ?>"
                                        data-prix="<?= esc((string) $regime['prixParSemaine']) ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                    </button>
                                    <a href="/supprimerRegime/<?= $regime['id'] ?>" class="text-rose-400 hover:text-rose-300 px-2 py-1 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="addRegimeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="addRegimeModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeAddModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Ajouter un regime</h3>
            <p class="text-stone-400 text-sm mb-8">Remplissez les informations ci-dessous pour creer un nouveau regime.</p>

            <form action="/insertRegime" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Nom du regime</label>
                        <input type="text" name="nom" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage viande</label>
                        <input type="number" name="pourcentage_viande" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage poisson</label>
                        <input type="number" name="pourcentage_poisson" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage volaille</label>
                        <input type="number" name="pourcentage_volaille" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Prix par semaine</label>
                        <input type="number" name="prixParSemaine" step="0.01" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Constatation</label>
                    <textarea name="constatation" rows="3" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Image du regime</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeAddModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editRegimeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="editRegimeModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeEditModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Modifier un regime</h3>
            <p class="text-stone-400 text-sm mb-8">Mettez a jour les informations du regime.</p>

            <form id="editRegimeForm" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Nom du regime</label>
                        <input type="text" name="nom" id="edit_nom" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage viande</label>
                        <input type="number" name="pourcentage_viande" id="edit_viande" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage poisson</label>
                        <input type="number" name="pourcentage_poisson" id="edit_poisson" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Pourcentage volaille</label>
                        <input type="number" name="pourcentage_volaille" id="edit_volaille" required min="0" max="100" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Prix par semaine</label>
                        <input type="number" name="prixParSemaine" id="edit_prix" step="0.01" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Constatation</label>
                    <textarea name="constatation" id="edit_constatation" rows="3" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Image du regime (optionnel)</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeEditModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addModal = document.getElementById('addRegimeModal');
        const addModalContent = document.getElementById('addRegimeModalContent');
        const editModal = document.getElementById('editRegimeModal');
        const editModalContent = document.getElementById('editRegimeModalContent');
        const editForm = document.getElementById('editRegimeForm');

        function openAddModal() {
            addModal.classList.remove('hidden');
            addModal.classList.add('flex');
            void addModal.offsetWidth;
            addModal.classList.remove('opacity-0');
            addModalContent.classList.remove('scale-95');
            addModalContent.classList.add('scale-100');
        }

        function closeAddModal() {
            addModal.classList.add('opacity-0');
            addModalContent.classList.remove('scale-100');
            addModalContent.classList.add('scale-95');
            setTimeout(() => {
                addModal.classList.remove('flex');
                addModal.classList.add('hidden');
            }, 300);
        }

        function openEditModal(data) {
            editForm.action = `/modifierRegime/${data.id}`;
            document.getElementById('edit_nom').value = data.nom;
            document.getElementById('edit_viande').value = data.viande;
            document.getElementById('edit_poisson').value = data.poisson;
            document.getElementById('edit_volaille').value = data.volaille;
            document.getElementById('edit_constatation').value = data.constatation;
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
                    viande: button.dataset.viande,
                    poisson: button.dataset.poisson,
                    volaille: button.dataset.volaille,
                    constatation: button.dataset.constatation,
                    prix: button.dataset.prix
                });
            });
        });
    </script>
</body>
</html>
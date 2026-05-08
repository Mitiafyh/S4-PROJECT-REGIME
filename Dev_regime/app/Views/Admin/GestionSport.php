<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Admin Sports</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= esc(base_url('assets/css/style.css')) ?>">
</head>
<body class="bg-stone-900 text-stone-100 font-sans">
    <main class="min-h-screen">
        <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
            <div class="flex justify-between items-center mb-12">
                <header>
                    <h2 class="text-3xl font-medium text-white mb-2">Sports</h2>
                    <p class="text-stone-400">Gerez les programmes sportifs proposes aux utilisateurs.</p>
                </header>
                <button onclick="openAddModal()" class="bg-[#8A9A5B] hover:bg-[#778550] text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-[#8A9A5B]/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Nouveau Sport
                </button>
            </div>

            <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20 relative z-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-stone-500 uppercase bg-stone-950">
                            <tr>
                                <th class="px-6 py-4">Image</th>
                                <th class="px-6 py-4">Nom</th>
                                <th class="px-6 py-4">Durée</th>
                                <th class="px-6 py-4">Répétitions</th>
                                <th class="px-6 py-4">Dépense calorique</th>
                                <th class="px-6 py-4">Image</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-800">
                            <?php foreach ($sports as $sport): ?>
                            <tr class="hover:bg-stone-800/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="w-16 h-12 rounded-lg bg-stone-800 overflow-hidden">
                                        <img src="<?= esc(base_url('images/sports/'. $sport['image'])) ?>" class="w-full h-full object-cover" alt="Image du sport">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $sport['type']) ?></td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $sport['duree']) ?> min</td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $sport['repetition']) ?></td>
                                <td class="px-6 py-4 text-stone-300"><?= esc((string) $sport['depense_calorique']) ?> kcal</td>
                                <td class="px-6 py-4 text-right">
                                    <button
                                        class="text-stone-400 hover:text-white px-2 py-1 js-edit-btn"
                                        type="button"
                                        data-id="<?= esc((string) $sport['id']) ?>"
                                        data-type="<?= esc((string) ($sport['type'] ?? '')) ?>"
                                        data-duree="<?= esc((string) $sport['duree']) ?>"
                                        data-repetition="<?= esc((string) $sport['repetition']) ?>"
                                        data-depense-calorique="<?= esc((string) $sport['depense_calorique']) ?>"
                                        data-image="<?= esc((string) $sport['image']) ?>"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                    </button>
                                    <a href="/supprimerSport/<?= $sport['id'] ?>" class="text-rose-400 hover:text-rose-300 px-2 py-1 inline-flex items-center">
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

    <div id="addSportModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="addSportModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeAddModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Ajouter un sport</h3>
            <p class="text-stone-400 text-sm mb-8">Remplissez les informations ci-dessous pour creer un nouveau sport.</p>

            <form action="/insertSport" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Type de sport</label>
                        <input type="text" name="type" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Durée (minutes)</label>
                        <input type="number" name="duree" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Répétitions</label>
                        <input type="number" name="repetition" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Dépense calorique</label>
                        <input type="number" name="depense_calorique" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                   
                </div>
     
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Image du sport</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeAddModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editSportModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="editSportModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-2xl transform scale-95 transition-all duration-300 shadow-2xl relative max-h-[90vh] overflow-y-auto">
            <button onclick="closeEditModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Modifier un sport</h3>
            <p class="text-stone-400 text-sm mb-8">Mettez a jour les informations du sport.</p>

            <form id="editSportForm" method="post" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Type de sport</label>
                        <input type="text" name="type" id="edit_type" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Durée (minutes)</label>
                        <input type="number" name="duree" id="edit_duree" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Répétitions</label>
                        <input type="number" name="repetition" id="edit_repetition" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Dépense calorique</label>
                        <input type="number" name="depense_calorique" id="edit_depense_calorique" required min="0" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                  
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Image du sport (optionnel)</label>
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
        const addModal = document.getElementById('addSportModal');
        const addModalContent = document.getElementById('addSportModalContent');
        const editModal = document.getElementById('editSportModal');
        const editModalContent = document.getElementById('editSportModalContent');
        const editForm = document.getElementById('editSportForm');

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
            editForm.action = `/modifierSport/${data.id}`;
            document.getElementById('edit_type').value = data.type;
            document.getElementById('edit_duree').value = data.duree;
            document.getElementById('edit_repetition').value = data.repetition;
            document.getElementById('edit_depense_calorique').value = data.depense_calorique;
            

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
                    type: button.dataset.type || '',
                    duree: button.dataset.duree,
                    repetition: button.dataset.repetition,
                    depense_calorique: button.dataset.depenseCalorique
                });
            });
        });
    </script>
</body>
</html>
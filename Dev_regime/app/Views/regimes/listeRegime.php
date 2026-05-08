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
                <button onclick="openModal()" class="bg-[#8A9A5B] hover:bg-[#778550] text-white px-5 py-2.5 rounded-xl text-sm font-medium transition-colors shadow-lg shadow-[#8A9A5B]/20 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nouveau regime
                </button>
            </div>

            <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20 relative z-0">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-stone-500 uppercase bg-stone-950">
                            <tr>
                                <th class="px-6 py-4">Image</th>
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
                                    <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_viande']) ?>%</td>
                                    <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_poisson']) ?>%</td>
                                    <td class="px-6 py-4 text-stone-300"><?= esc((string) $regime['pourcentage_volaille']) ?>%</td>
                                    <td class="px-6 py-4 text-stone-400"><?= esc((string) $regime['constatation']) ?></td>
                                    <td class="px-6 py-4 font-medium text-emerald-400"><?= esc((string) $regime['prixParSemaine']) ?>€</td>
                                    <td class="px-6 py-4 text-right">
                                        <!-- faire comme nouveau regime pour modifier(en js et mettre valeur d'avant sur le formulaire) -->
                                        <button onclick="openModal()" class="text-sky-400 hover:text-sky-300 px-2 py-1 inline-flex items-center">
                                            Modifier
                                        </button>
                                        <a href="/supprimerRegime/<?= $regime['id'] ?>" class="text-rose-400 hover:text-rose-300 px-2 py-1 inline-flex items-center">Supprimer</a>
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
        <div id="addRegimeModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-lg transform scale-95 transition-all duration-300 shadow-2xl relative">
            <button onclick="closeModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
            <h3 class="text-2xl font-medium text-white mb-2">Nouveau regime</h3>
            <p class="text-stone-400 text-sm mb-6">Accedez au formulaire complet pour ajouter un regime.</p>
            <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                <button type="button" onclick="closeModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                <a href="/ajoutRegime" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Aller au formulaire</a>
            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('addRegimeModal');
        const modalContent = document.getElementById('addRegimeModalContent');

        function openModal() {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }

        function closeModal() {
            modal.classList.add('opacity-0');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>

</html>
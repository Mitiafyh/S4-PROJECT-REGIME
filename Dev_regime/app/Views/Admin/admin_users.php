<?php
$usersList = $users ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Admin Utilisateurs</title>
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
                <a href="<?= site_url('admin/users') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium bg-stone-800 text-white shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Utilisateurs
                </a>
                <a href="<?= site_url('admin/settings') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium text-stone-400 hover:bg-stone-800/50 hover:text-stone-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8a4 4 0 1 0 4 4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
                    Parametres
                </a>
            </nav>

            <div class="p-4 border-t border-stone-800">
                <a href="<?= site_url('loginAdmin') ?>" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-200 text-sm font-medium text-stone-400 hover:bg-red-500/10 hover:text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Déconnexion
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto h-screen relative">
            <div class="max-w-6xl mx-auto px-6 md:px-12 py-8 md:py-12">
                <header class="mb-12">
                    <h2 class="text-3xl font-medium text-white mb-2">Utilisateurs</h2>
                    <p class="text-stone-400">Liste des utilisateurs non-admin.</p>
                </header>

                <div class="bg-stone-900 border border-stone-800 rounded-2xl overflow-hidden shadow-xl shadow-black/20">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-stone-500 uppercase bg-stone-950">
                            <tr>
                                <th class="px-6 py-4">Username</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Gold</th>
                                <th class="px-6 py-4">Solde</th>
                                <th class="px-6 py-4">Inscription</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-800">
                            <?php if (!empty($usersList)): ?>
                                <?php foreach ($usersList as $user): ?>
                                    <tr class="hover:bg-stone-800/30 transition-colors">
                                        <td class="px-6 py-4 text-stone-200"><?= esc((string) ($user['username'] ?? '')) ?></td>
                                        <td class="px-6 py-4 text-stone-300"><?= esc((string) ($user['email'] ?? '')) ?></td>
                                        <td class="px-6 py-4 text-stone-300">
                                            <?= !empty($user['modeGold']) ? 'Oui' : 'Non' ?>
                                        </td>
                                        <td class="px-6 py-4 text-stone-300">
                                            <?= number_format((float) ($user['argent'] ?? 0), 2, '.', '') ?>
                                        </td>
                                        <td class="px-6 py-4 text-stone-500">
                                            <?= esc((string) ($user['created_at'] ?? '')) ?>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <button
                                                type="button"
                                                class="text-stone-400 hover:text-white px-2 py-1 js-edit-user"
                                                data-id="<?= esc((string) ($user['id'] ?? '')) ?>"
                                                data-username="<?= esc((string) ($user['username'] ?? '')) ?>"
                                                data-email="<?= esc((string) ($user['email'] ?? '')) ?>"
                                                data-gold="<?= !empty($user['modeGold']) ? '1' : '0' ?>"
                                                data-argent="<?= esc((string) ($user['argent'] ?? 0)) ?>"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-stone-500">Aucun utilisateur.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <div id="editUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div id="editUserModalContent" class="bg-stone-900 border border-stone-800 rounded-3xl p-8 w-full max-w-xl transform scale-95 transition-all duration-300 shadow-2xl relative">
            <button onclick="closeEditUserModal()" class="absolute top-6 right-6 text-stone-500 hover:text-white transition-colors bg-stone-800/50 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h3 class="text-2xl font-medium text-white mb-2">Modifier un utilisateur</h3>
            <p class="text-stone-400 text-sm mb-8">Mettez a jour les informations du compte.</p>

            <form id="editUserForm" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Username</label>
                    <input type="text" name="username" id="edit_username" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-medium text-stone-500 mb-2">Email</label>
                    <input type="email" name="email" id="edit_email" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Gold</label>
                        <select name="modeGold" id="edit_gold" class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                            <option value="0">Non</option>
                            <option value="1">Oui</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-stone-500 mb-2">Solde</label>
                        <input type="number" step="0.01" name="argent" id="edit_argent" required class="w-full px-4 py-3 bg-stone-950 border border-stone-800 rounded-xl text-white focus:outline-none focus:border-stone-600 transition-colors">
                    </div>
                </div>
                <div class="flex justify-end gap-4 pt-4 border-t border-stone-800">
                    <button type="button" onclick="closeEditUserModal()" class="px-6 py-3 rounded-xl text-sm font-medium text-stone-400 hover:text-white hover:bg-stone-800 transition-colors">Annuler</button>
                    <button type="submit" class="px-8 py-3 rounded-xl text-sm font-medium text-white bg-[#8A9A5B] hover:bg-[#778550] transition-colors shadow-lg shadow-[#8A9A5B]/20">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editUserModal = document.getElementById('editUserModal');
        const editUserModalContent = document.getElementById('editUserModalContent');
        const editUserForm = document.getElementById('editUserForm');

        function openEditUserModal(data) {
            editUserForm.action = `<?= site_url('admin/users/update') ?>/${data.id}`;
            document.getElementById('edit_username').value = data.username;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_gold').value = data.gold;
            document.getElementById('edit_argent').value = data.argent;

            editUserModal.classList.remove('hidden');
            editUserModal.classList.add('flex');
            void editUserModal.offsetWidth;
            editUserModal.classList.remove('opacity-0');
            editUserModalContent.classList.remove('scale-95');
            editUserModalContent.classList.add('scale-100');
        }

        function closeEditUserModal() {
            editUserModal.classList.add('opacity-0');
            editUserModalContent.classList.remove('scale-100');
            editUserModalContent.classList.add('scale-95');
            setTimeout(() => {
                editUserModal.classList.remove('flex');
                editUserModal.classList.add('hidden');
            }, 300);
        }

        document.querySelectorAll('.js-edit-user').forEach((button) => {
            button.addEventListener('click', () => {
                openEditUserModal({
                    id: button.dataset.id,
                    username: button.dataset.username,
                    email: button.dataset.email,
                    gold: button.dataset.gold,
                    argent: button.dataset.argent
                });
            });
        });
    </script>
</body>
</html>

<?php
$activePage = $activePage ?? '';

$linkBase = 'w-full flex items-center gap-3 px-4 py-2.5 rounded-xl transition-all duration-300 text-sm font-medium';
$linkIdle = 'text-stone-500 hover:bg-stone-100/50 hover:text-stone-800';
$linkActive = 'bg-stone-800 text-white shadow-md';
?>
<aside class="w-64 bg-white/60 backdrop-blur-xl border-r border-stone-200/60 flex-col hidden md:flex sticky top-0 h-screen z-10">
    <div class="p-8 pb-4">
        <h1 class="text-xl tracking-wide font-medium text-stone-800 flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center text-sm font-light shadow-md">N</span>
            NutriFlow
        </h1>
    </div>

    <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">
        <a href="<?= site_url('users/dashboard') ?>" class="<?= $linkBase ?> <?= $activePage === 'dashboard' ? $linkActive : $linkIdle ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
            Tableau de bord
        </a>
        <a href="<?= site_url('users/objectives') ?>" class="<?= $linkBase ?> <?= $activePage === 'objectives' ? $linkActive : $linkIdle ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
            Mes objectifs
        </a>
        <a href="<?= site_url('users/program') ?>" class="<?= $linkBase ?> <?= $activePage === 'program' ? $linkActive : $linkIdle ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>
            Programmes
        </a>
        <a href="<?= site_url('users/activities') ?>" class="<?= $linkBase ?> <?= $activePage === 'activities' ? $linkActive : $linkIdle ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            Activités
        </a>
        <a href="<?= site_url('users/wallet') ?>" class="<?= $linkBase ?> <?= $activePage === 'wallet' ? $linkActive : $linkIdle ?>">
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

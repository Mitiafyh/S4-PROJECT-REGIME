<?php
$headerSection = $headerSection ?? 'NutriFlow';
$headerTitle = $headerTitle ?? 'NutriFlow';
$headerSubtitle = $headerSubtitle ?? null;
$headerHref = $headerHref ?? site_url('/');
$headerActionLabel = $headerActionLabel ?? 'Mon compte';
$headerActionHref = $headerActionHref ?? site_url('login');
?>

<header class="bg-white/80 backdrop-blur border-b border-stone-100">
    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between gap-4">
        <a href="<?= esc($headerHref) ?>" class="flex items-center gap-3">
            <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center text-sm font-semibold shadow-md">N</span>
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-stone-400"><?= esc($headerSection) ?></p>
                <p class="text-lg font-medium text-stone-800"><?= esc($headerTitle) ?></p>
            </div>
        </a>

        <div class="flex items-center gap-3">
            <?php if (!empty($headerSubtitle)): ?>
                <p class="hidden md:block text-sm text-stone-500"><?= esc($headerSubtitle) ?></p>
            <?php endif; ?>
            <?php if (!empty($headerActionLabel) && !empty($headerActionHref)): ?>
                <a href="<?= esc($headerActionHref) ?>" class="px-4 py-2 rounded-full border border-stone-200 text-stone-600 text-sm font-medium hover:bg-stone-50 transition-colors">
                    <?= esc($headerActionLabel) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>
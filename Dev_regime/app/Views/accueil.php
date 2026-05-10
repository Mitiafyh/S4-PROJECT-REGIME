<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Programme de Regime Sante</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        stone: {
                            50: '#fafaf9',
                            100: '#f5f5f4',
                            200: '#e7e5e4',
                            400: '#a8a29e',
                            500: '#78716c',
                            600: '#57534e',
                            700: '#44403c',
                            800: '#292524'
                        },
                        sauge: '#8A9A5B'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style {csp-style-nonce}>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAF8] text-stone-800">
    <div class="min-h-screen flex flex-col">
        <header class="bg-white/80 backdrop-blur border-b border-stone-100">
            <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
                <a href="<?= site_url('/') ?>" class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center text-sm font-semibold shadow-md">N</span>
                    <div>
                        <p class="text-sm uppercase tracking-[0.2em] text-stone-400">Programme sante</p>
                        <p class="text-lg font-medium text-stone-800">NutriFlow</p>
                    </div>
                </a>
                <nav class="flex items-center gap-3">
                    <a href="<?= site_url('login') ?>" class="px-4 py-2 rounded-full border border-stone-200 text-stone-600 text-sm font-medium hover:bg-stone-50 transition-colors">
                        Mon compte
                    </a>
                </nav>
            </div>
        </header>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="max-w-6xl mx-auto px-6 py-4 mt-4 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-900 shadow-sm">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <main class="flex-1">
            <section class="max-w-6xl mx-auto px-6 py-12 md:py-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div>
                        <p class="text-xs uppercase tracking-[0.3em] text-stone-400 mb-4">Votre plan sur mesure</p>
                        <h1 class="text-4xl md:text-5xl font-light text-stone-800 tracking-tight mb-5">
                            Programme de regime sante personnalise
                        </h1>
                        <p class="text-stone-500 text-lg leading-relaxed mb-6">
                            Bienvenue sur une plateforme dediee a votre bien-etre. Nous construisons un suivi nutritionnel adapte a vos objectifs, votre morphologie et votre rythme de vie.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="<?= site_url('users/infoSante') ?>" class="px-6 py-3 rounded-full bg-stone-800 text-white text-sm font-semibold shadow-md hover:bg-stone-700 transition-colors">
                                Commencer maintenant
                            </a>
                            <a href="<?= site_url('loginAdmin') ?>" class="px-6 py-3 rounded-full border border-stone-200 text-stone-600 text-sm font-semibold hover:bg-stone-50 transition-colors">
                                Espace administration
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 w-32 h-32 rounded-full bg-sauge/10 blur-2xl"></div>
                        <div class="absolute -bottom-10 -right-4 w-40 h-40 rounded-full bg-stone-200/50 blur-2xl"></div>
                        <div class="relative bg-white border border-stone-100 rounded-3xl p-8 shadow-[0_12px_40px_-12px_rgba(0,0,0,0.12)]">
                            <div class="grid grid-cols-1 gap-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-sauge/10 text-sauge flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 14 6h5a2 2 0 0 1 2 2v5a7 7 0 0 1-14 0Z"/><path d="M11 20v-5"/><path d="M14 11a2 2 0 0 0-2 2"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium text-stone-800">Suivi nutritionnel</h3>
                                        <p class="text-sm text-stone-500">Des recommandations precises pour garder le cap sans contrainte.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-700 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium text-stone-800">Programmes adaptes</h3>
                                        <p class="text-sm text-stone-500">Des regimes construits pour vos objectifs et vos activites.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-stone-100 text-stone-700 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium text-stone-800">Gestion simple</h3>
                                        <p class="text-sm text-stone-500">Un espace clair pour suivre vos paiements et votre option Gold.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="max-w-6xl mx-auto px-6 pb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border border-stone-100 rounded-3xl p-6 md:p-8 shadow-[0_8px_30px_-12px_rgba(0,0,0,0.08)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-stone-400 mb-2">Demarrer</p>
                        <h2 class="text-2xl font-medium text-stone-800 mb-3">Creez votre profil</h2>
                        <p class="text-sm text-stone-500 mb-6">Renseignez vos donnees sante pour recevoir un diagnostic et un parcours adapte.</p>
                        <a href="<?= site_url('users/infoSante') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-stone-800 hover:text-sauge transition-colors">
                            Lancer le diagnostic
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                    <div class="bg-stone-800 text-white rounded-3xl p-6 md:p-8 shadow-[0_12px_40px_-14px_rgba(0,0,0,0.5)]">
                        <p class="text-xs uppercase tracking-[0.3em] text-stone-300 mb-2">Espace pro</p>
                        <h2 class="text-2xl font-medium mb-3">Administration centralisee</h2>
                        <p class="text-sm text-stone-300 mb-6">Accedez au suivi des utilisateurs, regimes, activites et codes promotionnels.</p>
                        <a href="<?= site_url('loginAdmin') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-white transition-colors">
                            Se connecter
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-stone-100 bg-white/80">
            <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3 text-xs text-stone-500">
                <span>NutriFlow - Programme de regime sante</span>
                <span>&copy; <?= date('Y') ?> NutriFlow. Tous droits reserves.</span>
            </div>
        </footer>
    </div>
</body>
</html>

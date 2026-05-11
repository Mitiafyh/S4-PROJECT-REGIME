<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Inscription</title>
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
                800: '#292524',
              },
              sauge: '#8A9A5B',
            }
          }
        }
      }
    </script>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body class="bg-[#FAFAF8] text-stone-800 font-sans">
    <?= view('users/form_header', [
        'headerSection' => 'Inscription',
        'headerTitle' => 'NutriFlow',
        'headerSubtitle' => 'Créez votre compte en quelques étapes',
        'headerHref' => site_url('/'),
        'headerActionLabel' => 'Se connecter',
        'headerActionHref' => site_url('login'),
    ]) ?>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-sauge/20">
        <div class="sm:mx-auto sm:w-full sm:max-w-md flex flex-col items-center">
            <h2 class="mt-6 text-center text-3xl font-light text-stone-800 tracking-tight">Créer un compte</h2>
            <p class="mt-2 text-center text-sm text-stone-500">Rejoignez NutriFlow</p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-[0_8px_30px_-4px_rgba(0,0,0,0.04)] sm:rounded-3xl sm:px-10 border border-stone-100 relative">
                <form id="registerForm" class="space-y-6" action="/register" method="post" novalidate>
                    <div>
                        <label for="username" class="block text-sm font-medium text-stone-600 mb-2">Nom d'utilisateur</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-xl shadow-sm placeholder-stone-400 focus:outline-none focus:ring-sauge focus:border-sauge sm:text-sm transition-colors"
                            placeholder="Votre nom d'utilisateur"
                            required
                        />
                        <div class="error-message" id="usernameError"></div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-600 mb-2">Adresse e-mail</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-xl shadow-sm placeholder-stone-400 focus:outline-none focus:ring-sauge focus:border-sauge sm:text-sm transition-colors"
                            placeholder="vous@exemple.com"
                            required
                        />
                        <div class="error-message" id="emailError"></div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-600 mb-2">Mot de passe</label>
                        <div class="password-field">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="appearance-none block w-full px-4 py-3 pr-12 border border-stone-200 rounded-xl shadow-sm placeholder-stone-400 focus:outline-none focus:ring-sauge focus:border-sauge sm:text-sm transition-colors"
                                placeholder="Choisissez un mot de passe"
                                required
                            />
                            <button
                                type="button"
                                class="password-toggle"
                                data-password-toggle="password"
                                aria-label="Afficher le mot de passe"
                                aria-pressed="false"
                            >
                                <span class="password-toggle__icon" data-icon="show">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </span>
                                <span class="password-toggle__icon password-toggle__icon--hide" data-icon="hide">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M3 3l18 18"/>
                                        <path d="M10.7 5.1a9.9 9.9 0 0 1 1.3-.1c6.5 0 10 7 10 7a19.2 19.2 0 0 1-3.3 4.3"/>
                                        <path d="M6.6 6.6A19.2 19.2 0 0 0 2 12s3.5 7 10 7a10 10 0 0 0 3.4-.6"/>
                                        <path d="M9.9 9.9a3 3 0 0 0 4.2 4.2"/>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="error-message" id="passwordError"></div>
                    </div>

                    <div class="pt-2">
                        <button
                            type="submit"
                            class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-stone-800 hover:bg-stone-700 transition-colors"
                        >
                            S'inscrire
                        </button>
                    </div>
                </form>

                <?php if (session()->getFlashdata('error')): ?>
                    <p class="mt-4 text-sm text-red-600"><?= session()->getFlashdata('error') ?></p>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <p class="mt-4 text-sm text-green-600"><?= session()->getFlashdata('success') ?></p>
                <?php endif; ?>

                <div class="mt-8 text-center text-sm border-t border-stone-100 pt-6">
                    <span class="text-stone-500">Deja un compte ? </span>
                    <a href="/login" class="font-medium text-stone-800 hover:underline">Se connecter</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/validation-register.js') ?>"></script>
</body>
</html>
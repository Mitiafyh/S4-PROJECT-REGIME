<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NutriFlow - Connexion</title>
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
<body class="bg-[#FAFAF8] font-sans text-stone-800">
    <?php $errors = session()->getFlashdata('errors') ?? []; ?>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-sauge/20">
        <div class="sm:mx-auto sm:w-full sm:max-w-md flex flex-col items-center">
            <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-stone-800 to-stone-600 text-white flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 20A7 7 0 0 1 14 6h5a2 2 0 0 1 2 2v5a7 7 0 0 1-14 0Z"/>
                    <path d="M11 20v-5"/>
                    <path d="M14 11a2 2 0 0 0-2 2"/>
                </svg>
            </div>

            <h2 class="mt-6 text-center text-3xl font-light text-stone-800 tracking-tight">
                Bon retour sur NutriFlow
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-[0_8px_30px_-4px_rgba(0,0,0,0.04)] sm:rounded-3xl sm:px-10 border border-stone-100">
                <form id="loginForm" class="space-y-6" action="/auth" method="post" novalidate>
                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-600 mb-2">
                            Adresse e-mail
                        </label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            autocomplete="email"
                            value="<?= old('email') ?>"
                            aria-describedby="emailError"
                            class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-xl shadow-sm placeholder-stone-400 focus:outline-none focus:ring-sauge focus:border-sauge sm:text-sm transition-colors"
                            placeholder="vous@exemple.com"
                            autofocus
                        />
                        <div class="error-message" id="emailError"><?= esc($errors['email'] ?? '') ?></div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-stone-600 mb-2">
                            Mot de passe
                        </label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            aria-describedby="passwordError"
                            class="appearance-none block w-full px-4 py-3 border border-stone-200 rounded-xl shadow-sm placeholder-stone-400 focus:outline-none focus:ring-sauge focus:border-sauge sm:text-sm transition-colors"
                            placeholder="Entrez votre mot de passe"
                        />
                        <div class="error-message" id="passwordError"><?= esc($errors['password'] ?? '') ?></div>
                    </div>

                    <div>
                        <button
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-stone-800 hover:bg-stone-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-800 transition-colors"
                        >
                            Se connecter
                        </button>
                    </div>
                </form>

                <?php if (session()->getFlashdata('error')): ?>
                    <p class="mt-4 text-sm text-red-600"><?php echo session()->getFlashdata('error'); ?></p>
                <?php endif; ?>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-stone-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-stone-500">Nouveau ici ?</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="/inscription" class="w-full flex justify-center py-3 px-4 border border-stone-200 rounded-xl shadow-sm text-sm font-medium text-stone-600 bg-white hover:bg-stone-50 transition-colors text-center">
                            Créer un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/validation-login.js') ?>"></script>
</body>
</html>
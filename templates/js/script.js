// Ce fichier gérera les petites interactions statiques (menus, modals, etc.)
document.addEventListener('DOMContentLoaded', () => {
    console.log('Le template est chargé avec succès.');

    // Exemple : Imprimer la page (pour le bouton "Exporter PDF")
    const printBtns = document.querySelectorAll('.js-print-btn');
    printBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            window.print();
        });
    });

    // Exemple : Animer la barre d'IMC au chargement
    const imcBar = document.querySelector('.js-imc-bar');
    if (imcBar) {
        setTimeout(() => {
            imcBar.style.width = '24%'; // Valeur statique d'exemple
        }, 300);
    }
});

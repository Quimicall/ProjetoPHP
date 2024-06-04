document.addEventListener('DOMContentLoaded', function() {
    // Função para alternar para o tema claro
    document.getElementById('theme-light').addEventListener('click', function() {
        document.body.classList.remove('bg-dark');
        document.body.classList.add('bg-light');
    });

    // Função para alternar para o tema escuro
    document.getElementById('theme-dark').addEventListener('click', function() {
        document.body.classList.remove('bg-light');
        document.body.classList.add('bg-dark');
    });
});
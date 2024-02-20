document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('toggleMenuButton').addEventListener('click', function() {
        document.querySelector('.menu').classList.toggle('show');
    });
});


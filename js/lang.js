$(document).ready(function() {
    $("#fr").click(function() {
        sessionStorage.setItem('lang', 'fr');
        document.location.href = "?lang=fr";
    });

    $("#en").click(function() {
        sessionStorage.setItem('lang', 'en');
        document.location.href = "?lang=en";
    });
});
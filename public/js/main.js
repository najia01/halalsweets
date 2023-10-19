$(document).ready(function () {
    $(".add-to-cart-button").on("click", function () {
        var sweetId = $(this).data("sweet-id");

        $.ajax({
            type: "POST",
            url: "/add-to-cart/" + sweetId,
            success: function (data) {
                // Gérer la réponse, par exemple, mettre à jour l'affichage du panier
            },
            error: function (xhr, status, error) {
                // Gérer les erreurs, par exemple, afficher un message d'erreur
            }
        });
    });
});

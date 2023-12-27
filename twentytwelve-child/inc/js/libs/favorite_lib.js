export class FavoriteService {
    add_to_favorite(art_id)
    {
        jQuery.ajax({
            type: "POST",
            url: window.location.origin + '/wp-admin/admin-ajax.php',
            dataType: "json",
            data: {
                action: "add_favorite",
                id: art_id
            },
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
}
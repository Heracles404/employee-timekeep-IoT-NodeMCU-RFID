function checkUID() {
    var uid = $('#UID').val();
    $.ajax({
        url: 'checkUID.php',
        type: 'GET',
        data: { uid: uid },
        success: function(response) {
            if (response == 'exists') {
                // UID exists, populate the name field
                $.ajax({
                    url: 'getName.php',
                    type: 'GET',
                    data: { uid: uid },
                    success: function(name) {
                        $('#name').val(name);
                    }
                });
            } else {
                // UID does not exist, clear the name field
                $('#name').val('');
            }
        }
    });
}
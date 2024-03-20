function populateForm(UID) {
    $.ajax({
        url: 'populate.php',
        type: 'GET',
        data: { id: UID }, // Use 'id' instead of 'UID' to match the PHP script
        success: function(data) {
            $('#UID').val(data.UID);
            $('#firstname').val(data.f_name);
            $('#lastname').val(data.l_name);
            $('#email').val(data.email);
        },
        error: function(xhr, status, error) {
            alert('Error fetching data from server: ' + error);
        }
    });
}

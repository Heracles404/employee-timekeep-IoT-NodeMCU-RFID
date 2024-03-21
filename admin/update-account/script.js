function populateForm(uid) {
    $.ajax({
        type: 'GET',
        url: 'populate.php',
        data: { uid: uid },
        success: function(data) {
            var jsonData = JSON.parse(data);
            console.log('Data:', jsonData);

            if (jsonData) {
                var picture = jsonData.picture;
                var imageURL = 'data:image/jpeg;base64,' + picture;
                console.log('Image URL:', imageURL);
                $('#uploadedImage').attr('src', imageURL);

                $('#UID').val(uid);
                $('#firstname').val(jsonData.f_name);
                $('#lastname').val(jsonData.l_name);
                $('#email').val(jsonData.email);

            } else {
                console.log('No data found or picture field is undefined, displaying placeholder image');
                $('#uploadedImage').attr('src', 'design/blocked.jpg');
                $('#UID').val('BLOCKED');
                $('#firstname').val('');
                $('#lastname').val('');
                $('#email').val('');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', xhr.responseText);
            $('#uploadedImage').attr('src', 'design/blocked.jpg');
            $('#UID').val('');
            $('#firstname').val('');
            $('#lastname').val('');
            $('#email').val('');
        }
    });
}

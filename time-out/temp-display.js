$(document).ready(function(){
    setInterval(ajaxcall, 1000);
});

// Display Temporarily Stored UID
function ajaxcall(){
    $.ajax({
        type: 'POST',
        url: 'temp-fetch.php',
        success: function(data) {
            var jsonData = JSON.parse(data);
            console.log('Data:', jsonData);

            if (jsonData.length > 0 && jsonData[0].picture) {
                var picture = jsonData[0].picture;
                var imageURL = 'data:image/jpeg;base64,' + picture;
                console.log('Image URL:', imageURL);
                $('#uploadedImage').attr('src', imageURL);

                // Display UID, first name, and last name
                var uid = jsonData[0].RFID_UID;
                var c_name = jsonData[0].f_name;
                $('#uid').val(uid);
                $('#name').val(c_name);
            } else {
                console.log('No data found or picture field is undefined, displaying placeholder image');
                $('#uploadedImage').attr('src', 'design/blocked.jpg');
                $('#uid').val('BLOCKED');
                $('#name').val('- - - -');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching data:', xhr.responseText);
            $('#uploadedImage').attr('src', 'design/blocked.jpg');
            $('#uid').val('');
            $('#firstName').val('');
            $('#lastName').val('');
        }
    });
}
 
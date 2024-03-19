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
            var picture = jsonData[0].picture; // Assuming only one row is returned
            $('#uploadedImage').attr('src', 'data:image/jpeg;base64,' + picture);
        }
    });
}

$(document).ready(function(){
    setInterval(ajaxcall, 1000);
});

// Display Temporarily Stored UID
function ajaxcall(){
    $.ajax({
        type: 'POST',
        url: 'temp-fetch.php',
        success: function(data) {
            $('#UID').val(data); // Set the value of the input field to the received UID
        }
    });
}

function uploadImage() {
    var reader = new FileReader();
    reader.onload = function(e) {
        $('#uploadedImage').attr('src', e.target.result);
    };
    reader.readAsDataURL(event.target.files[0]);
}

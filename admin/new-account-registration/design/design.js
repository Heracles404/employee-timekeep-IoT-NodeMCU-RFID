// For label motions
const label = document.querySelectorAll('.form-control label')

label.forEach(label => {
    label.innerHTML = label.innerText
        // Splits letter
        .split('')
        // Map letters to an array and puts it inside <span> attribute
        .map((letter,idx) => `<span style="transition-delay: ${idx * 50}ms">${letter}</span>`)
        // Join the letters
        .join('')
})


// For Image Uploading
function uploadImage() {
    var fileInput = document.getElementById('uploadInput');
    var file = fileInput.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        var uploadedImage = document.getElementById('uploadedImage');
        uploadedImage.src = e.target.result;
    };
    reader.readAsDataURL(file);
}

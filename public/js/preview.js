document.getElementById("Image").addEventListener('change', (event) => {
    document.getElementById("preview").innerHTML = "";
    for (var i = 0; i < event.target.files.length; i++) {
        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("preview").innerHTML += '<img class="preview" src="' + event.target.result + '">';
        }
        reader.readAsDataURL(event.target.files[i]);
    }
});
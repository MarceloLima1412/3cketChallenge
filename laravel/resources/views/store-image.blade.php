<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store image</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/cropperjs/dist/cropper.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-5">Store image</h1>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red; background-color: #f8d7da; padding: 10px; border-radius: 5px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/image" method="POST" enctype="multipart/form-data" class="p-4">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image:</label>
            <input type="file" name="image" id="image" class="form-control" accept="jpg,png" required>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Category:</label>
            <input list="categories" name="category" id="category" class="form-control" required placeholder="Choose or enter a new category">
            <datalist id="categories">
                @foreach($categories as $category)
                    <option value="{{ $category }}"></option>
                @endforeach
            </datalist>
        </div>

        <div class="mb-3">
            <label for="imagePreview" class="form-label">Preview Image:</label>
            <div>
                <img id="imagePreview" src="" style="max-width: 100%; display: none;">
            </div>
        </div>

        <input type="hidden" name="cropped_image" id="cropped_image">

        <button type="button" id="cropButton" class="btn btn-secondary" style="display:none;">Crop Image</button>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper;

    document.getElementById('image').addEventListener('change', function (e) {
        const reader = new FileReader();
        reader.onload = function (event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.src = event.target.result;
            imagePreview.style.display = 'block';
            document.getElementById('cropButton').style.display = 'inline-block';
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    document.getElementById('imagePreview').addEventListener('load', function () {
        const image = document.getElementById('imagePreview');
        cropper = new Cropper(image, {
            viewMode: 1,
            autoCropArea: 0.8,
            responsive: true,
        });
    });

    document.getElementById('cropButton').addEventListener('click', function () {
        const canvas = cropper.getCroppedCanvas({
            maxWidth: 1000,
            maxHeight: 1000,
        });

        canvas.toBlob(function(blob) {
            const formData = new FormData();

            formData.append('image', blob, 'cropped_image.png');

            formData.append('category', document.getElementById('category').value);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch('/image', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url;
                    } else {
                        return response.text();
                    }
                })
                .then(data => {
                    if (data) {
                        document.body.innerHTML = data;
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar a imagem:', error);
                    alert('Erro ao processar a requisição.');
                });
        });
    });
</script>

</body>
</html>

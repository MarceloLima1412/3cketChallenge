<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Image Gallery</h1>
        <div>
            <a href="/image" class="btn btn-success me-2">Add Image</a>
            <form action="/logout" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <form action="/" method="GET">
        <div class="mb-3">
            <label for="category" class="form-label">Select Category</label>
            <select name="category_id" id="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                            @if($selectedCategory && $selectedCategory->id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <h3>Images in
        @if($selectedCategory)
            Category: {{ $selectedCategory->name }}
        @else
            All Categories
        @endif
    </h3>

    <div class="row">
        @foreach($images as $image)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ asset('storage/images/' . $image->path) }}" class="card-img-top" alt="Image">
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Bootstrap JS (via CDN) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>

</body>
</html>

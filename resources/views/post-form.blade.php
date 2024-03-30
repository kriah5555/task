<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <div class="float-end">
            @auth
                Logged in as: {{ auth()->user()->name }} @if(auth()->user()->is_admin) <strong> (Admin) </strong> @endif
            @endauth
        </div>
        <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>
        <h1 class="text-center mb-4">Create Post</h1> 

        <form action="{{  route('posts.store') }}"  method="POST" id="posts_form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputTitle" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleInputTitle" name="title" aria-describedby="titleHelp">
                <div id="titleHelp" class="form-text">Enter the title of your post.</div>
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputDescription" class="form-label">Description</label>
                <textarea class="form-control" id="exampleInputDescription" name="description" rows="3"></textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputImage" class="form-label">Image</label>
                <input type="file" class="form-control" id="exampleInputImage" name="image">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back</a>
        </form>
    </div>
</body>
</html>

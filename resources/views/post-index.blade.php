<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Overview - Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <div class="float-end">
            @auth
                Logged in as: {{ auth()->user()->name }} @if(auth()->user()->is_admin) (Admin) @endif
            @endauth
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create new post</a>
        <a href="{{ route('logout') }}" class="btn btn-primary">Logout</a>

        <h1 class="text-center mb-4">Overview - Posts</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">user</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->date }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        @if($post->image)
                        <img src="{{ asset('storage/' . $post->image->image_path) }}" alt="Post Image" class="img-fluid" width="100" height="100">
                        @else
                            No Image
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

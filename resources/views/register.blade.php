<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register user</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Register</h1>
        <form action="{{ route('create_user') }}" method="POST">
            @csrf 
            <div class="mb-3">
                <label for="exampleInputUsername" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputUsername" name="name" aria-describedby="usernameHelp">
                <div id="usernameHelp" class="form-text">Enter your username.</div>
                @error('name') <!-- Display validation error for 'username' field -->
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail" name="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter your email address.</div>
                @error('email') <!-- Display validation error for 'email' field -->
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword" name="password">
                @error('password') <!-- Display validation error for 'password' field -->
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="adminCheckbox" name="is_admin">
                <label class="form-check-label" for="adminCheckbox">Admin</label>
                @error('is_admin') <!-- Display validation error for 'password' field -->
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Register User</button>
            <a href="/" class="btn btn-primary">Back to login</a>
        </form>
    </div>
</body>
</html>

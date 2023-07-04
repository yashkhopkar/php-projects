<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}" class="mt-5">
            @csrf
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="form-control">

            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required class="form-control">

            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="form-check-input">
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    <div class="mt-3">
    Don't have an account? <a href="{{ route('register') }}">Register here</a>
</div>
</div>
</div>
</body>
</html>
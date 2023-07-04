<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album</title>
</head>
<body>
@if ($photos->count() > 0)
<div class="container">
        <h1>My Photo Album</h1>
        <hr>

        <!-- Display uploaded photos -->
        @foreach ($photos as $photo)
            <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="{{ $photo->title }}" width="200" height="200">
        @endforeach

@else
    <p>You haven't uploaded any photos yet.</p>
@endif
<hr>
        <h1>File Upload Form</h1>
        <!-- File upload form -->
        <form action="{{ route('photo.upload') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo</label>
                <input type="file" name="photo" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
        <hr>
        <h1>Email Photo</h1>
        <form method="POST" action="{{ route('photo.email') }}">
            @csrf
            <div class="form-group">
                <label for="recipient">Recipient:</label>
                <input type="email" class="form-control" name="recipient" id="recipient" required>
            </div>
            <div class="form-group">
                <label for="photo_id">Photo:</label>
                <select class="form-control" name="photo_id" id="photo_id" required>
                    @foreach ($photos as $photo)
                        <option value="{{ $photo->id }}">{{ $photo->title }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Send Email</button>
        </form>
        <hr>
        <!-- Logout button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
</body>
</html>

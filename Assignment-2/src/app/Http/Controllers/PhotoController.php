<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\PhotoEmail;


class PhotoController extends Controller
{
    public function index()
    {
        // Get the user's uploaded photos
        $photos = Photo::where('user_id', Auth::id())->get();

        // Render the photo album view with the photos
        return view('photo-album', ['photos' => $photos]);
    }

    public function upload(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'photo' => 'required|image',
        ]);

        // Store the uploaded file on the server
        $path = $request->file('photo')->store('public/photos');

        // Create a new photo record in the database
        $photo = new Photo;
        $photo->title = $validatedData['title'];
        $photo->filename = basename($path);
        $photo->user_id = Auth::id();
        $photo->save();

        // Redirect back to the photo album view
        return redirect('/photo-album');
    }

    public function sendEmail(Request $request)
{
    $validatedData = $request->validate([
        'recipient' => 'required|email',
        'photo_id' => 'required|exists:photos,id',
    ]);

    $photo = Photo::findOrFail($validatedData['photo_id']);

    $data = [
        'photo' => $photo,
        'url' => url('/storage/' . $photo->filename),
    ];

    Mail::to($validatedData['recipient'])->send(new PhotoEmail($data, function ($message) {
        $message->from('test@example.com', 'Test');
    }));

    return redirect('/photo-album')->with('success', 'Email sent successfully.');
}

}

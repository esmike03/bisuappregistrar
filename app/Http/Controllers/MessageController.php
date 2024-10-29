<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Message;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    //
    public function message(Request $request)
    {
        // Validate the request data
        $formFields = $request->validate([
            'email' => 'required',
            'campus' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Save the data to the database without converting the date format
        Message::create($formFields);

        return redirect('/')->with('message', 'Message Send Successfully!');
    }

    public function emailuser(Request $request, $email, $subject, $message)
    {
        return view('admin.partials.email', compact('email', 'subject', 'message'));
    }

    public function sendEmailUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Send the email
        Mail::to($request->email)->send(new ContactMail($request->subject, $request->message));

        return back()->with('success', 'Email sent successfully!');
    }

    public function postAnnouncement(Request $request)
    {
        //get campus
        $campus = auth()->guard('admin')->user()->campus;

        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'message' => 'required|string|max:1000',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public'); // Store in the 'images' directory

            // Create a new announcement record in the database
            Post::create([
                'image' => $imagePath,
                'message' => $request->input('message'),
                'campus' => $campus
            ]);
        }

        return back()->with('success', 'Posted successfully!');
    }
    //To post page
    public function post()
    {
        $campus = auth()->guard('admin')->user()->campus;

        // First, filter the posts by campus, then paginate the results
        $posts = Post::where('campus', $campus)->paginate(3);

        return view('admin.partials.post', compact('posts'));
    }


    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('message', 'Message deleted successfully.');
    }

    public function postdestroy($id)
    {

        // Find the post by ID
        $post = Post::findOrFail($id);

        // Delete the image from storage (optional)
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        // Delete the post
        $post->delete();

        // Redirect back with success message
        return back()->with('success', 'Announcement deleted successfully!');
    }
}

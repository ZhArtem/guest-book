<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Review;

class GuestbookController extends Controller
{
    public function index() {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        $key = session('key');
        return view('index', compact('reviews', 'key'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'review' => 'required',
            'score' => 'integer|min:1|max:5',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'g-recaptcha-response' => 'required|recaptcha',
        ]);

        $review = new Review();
        $review->name = $request->input('name');
        $review->review = $request->input('review');
        $review->created_at = now();
        $review->score = $request->input('score');
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $review->image = $path;
        }

        $review->save();
        session(['key' => $review->id]);

        return redirect()->route('guestbook.index');
    }

    public function admin()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();
        return view('admin', compact('reviews'));
    }

    public function adminEdit($id)
    {
        $review = Review::findOrFail($id);
        return view('edit', compact('review'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->name = $request->input('edited_name');
        $review->review = $request->input('edited_review');
        $review->score = $request->input('edited_score');
        $review->save();

        return redirect()->route('guestbook.admin');
    }

    public function adminDelete(Request $request)
    {
        $review = Review::findOrFail($request->input('review_id'));
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
        $review->delete();

        return redirect()->route('guestbook.admin');
    }
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->name = $request->input('edited_name');
        $review->review = $request->input('edited_review');
        $review->score = $request->input('edited_score');
        $review->save();

        return redirect()->route('guestbook.index');
    }

    public function delete(Request $request)
    {
        $review = Review::findOrFail($request->input('review_id'));
        if ($review->image) {
            Storage::disk('public')->delete($review->image);
        }
        $review->delete();

        return redirect()->route('guestbook.index');
    }

    public function login()
    {
        return 'Страница авторизации';
    }
}

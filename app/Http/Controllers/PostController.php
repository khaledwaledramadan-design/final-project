<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // عرض جميع المقالات في Dashboard
    public function index()
    {
        $posts = Post::latest()->get(); // الجديد فوق
        return view('dashboard', compact('posts'));
    }

    // إضافة مقال جديد
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Article added successfully!');
    }

    // حذف مقال (Admin فقط)
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Article deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function all() : JsonResponse
    {
        $reviews = DB::table('reviews')
            ->where('public', true)
            ->select('id', 'reviewer_name', 'content')
            ->get();
        return response()->json($reviews);
    }


    public function index() : JsonResponse
    {
        return response()->json(Review::all());
    }

    public function show(Review $review) : JsonResponse
    {
        return response()->json([
            'id' => $review->id,
            'content' => $review->content,
            'reviewer_name' => $review->reviewer_name,
        ]);
    }

    public function conceal(Review $review) : JsonResponse
    {
        if (!$review->public) {
            return response()->json([
                'message' => "{$review->reviewer_name}'s review set is already hidden",
            ]);
        }
        $review->public = false;
        $review->save();

        return response()->json([
            'message' => "{$review->reviewer_name}'s review set to hidden succesfully",
        ]);
    }

    public function reveal(Review $review) : JsonResponse
    {
        if ($review->public) {
            return response()->json([
                'message' => "{$review->reviewer_name}'s review set is already public",
            ]);
        }
        $review->public = true;
        $review->save();

        return response()->json([
            'message' => "{$review->reviewer_name}'s review set to public succesfully",
        ]);
    }

    public function store(Request $request) : JsonResponse
    {
        $validated = $request->validate([
            'content' => ['required'],
            'reviewer_name' => ['required'],
        ]);

        $review = new Review();
        $review->content = $validated['content'];
        $review->reviewer_name = $validated['reviewer_name'];

        if (!$review->save()) {
            return response()->json([
                'message' => 'Internal server error'
            ], 500);
        }

        return response()->json([
            'message' => "Ulasan milik {$validated['reviewer_name']} berhasil disimpan"
        ]);
    }
}

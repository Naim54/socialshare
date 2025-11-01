<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SocialShareClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SocialShareController extends Controller
{
    /**
     * Track a social share button click
     */
    public function track(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'platform' => 'required|in:facebook,twitter,whatsapp,telegram,email',
            'article_id' => 'nullable|exists:articles,id',
            'page_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Ensure either article_id or page_url is provided
        if (!$request->article_id && !$request->page_url) {
            return response()->json([
                'success' => false,
                'errors' => ['Either article_id or page_url must be provided']
            ], 422);
        }

        try {
            $click = SocialShareClick::create([
                'platform' => $request->platform,
                'article_id' => $request->article_id,
                'page_url' => $request->page_url, // Always save the page URL for reference
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Social share click tracked successfully',
                'data' => $click
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to track social share click',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}


<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AiController extends Controller
{
    public function generateDescription(Request $request)
    {
        $itemName = $request->item_name;

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => "Write a professional 1-line invoice item description for: {$itemName}"
                ]
            ],
            'max_tokens' => 100,
        ]);

        $description = $response->json()['choices'][0]['message']['content'] ?? '';

        return response()->json(['description' => trim($description)]);
    }
}
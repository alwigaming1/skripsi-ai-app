<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Tambahan

class GroqService
{
    // Fungsi ambil key dari DB
    private function getApiKey()
    {
        // Coba ambil dari DB dulu
        $key = DB::table('api_keys')
                ->where('provider', 'groq')
                ->where('is_active', true)
                ->inRandomOrder() // Rotasi sederhana
                ->value('key');

        // Jika tidak ada di DB, ambil dari ENV
        return $key ?? config('services.groq.key'); // Pastikan config ini ada atau ganti env('GROQ_API_KEY')
    }

    public function generateText(string $prompt): string
    {
        $apiKey = $this->getApiKey();

        if (!$apiKey) {
            throw new Exception('Groq API key tidak tersedia (DB/Env).');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ])
        ->timeout(60)
        ->post('https://api.groq.com/openai/v1/chat/completions', [
            'model' => 'llama-3.1-8b-instant',
            'messages' => [['role' => 'user', 'content' => $prompt]],
            'temperature' => 0.5,
        ]);

        if (!$response->successful()) {
            Log::error('Groq Error', ['body' => $response->body()]);
            throw new Exception('Groq gagal: ' . $response->status());
        }

        return $response->json()['choices'][0]['message']['content'] ?? '';
    }
}
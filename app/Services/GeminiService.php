<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
  protected $apiKey;
  protected $model;

  public function __construct()
  {
    $this->apiKey = env('GEMINI_API_KEY');
    $this->model = env('GEMINI_MODEL', 'gemini-pro');
  }

  public function chat(string $message): string
  {
    $url = "https://generativelanguage.googleapis.com/v1beta/models/{$this->model}:generateContent";

    for ($i = 0; $i < 3; $i++) { // coba ulang max 3 kali
      $response = Http::withHeaders([
        'Content-Type'   => 'application/json',
        'x-goog-api-key' => $this->apiKey,
      ])->post($url, [
        'contents' => [
          [
            'parts' => [
              ['text' => $message]
            ]
          ]
        ]
      ]);

      if ($response->successful()) {
        return $response->json('candidates.0.content.parts.0.text') ?? "Tidak ada respon.";
      }

      // kalau 503 (overloaded), tunggu lalu retry
      if ($response->status() == 503) {
        sleep(2);
        continue;
      }

      // kalau error lain, langsung break
      break;
    }

    return "⚠️ Gemini sedang sibuk atau tidak tersedia. Coba lagi nanti.";
  }
}

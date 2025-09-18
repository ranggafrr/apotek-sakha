<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GeminiService;
use Carbon\Carbon;
use App\Models\ProdukModel;

class ChatController extends Controller
{
    protected $gemini;

    public function __construct(GeminiService $gemini)
    {
        $this->gemini = $gemini;
    }


    public function index()
    {
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'AI Assistant', 'url' => null],
        ];
        return view('apps.chat.index', [
            "menu" => "AI Assistant",
            "page" => 'AI Assistant',
            "breadcrumbs" => $breadcrumbs,
        ]);
    }

    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $userMessage = strtolower($request->message);

        // 🔹 Set locale ke Bahasa Indonesia
        Carbon::setLocale('id');

        // 1️⃣ Intent: Tanggal / Waktu
        if (
            str_contains($userMessage, 'tanggal')
            || str_contains($userMessage, 'hari ini')
            || str_contains($userMessage, 'jam')
        ) {
            $now = Carbon::now();
            return response()->json([
                'user_message' => $request->message,
                'bot_reply'    => "Hari ini adalah " . $now->translatedFormat('l, d F Y H:i'),
            ]);
        }

        // 2️⃣ Intent: Tampilkan seluruh stok
        if (
            (str_contains($userMessage, 'semua') ||
                str_contains($userMessage, 'daftar') ||
                str_contains($userMessage, 'seluruh') ||
                str_contains($userMessage, 'list'))
            && str_contains($userMessage, 'stok')
        ) {
            $produkList = ProdukModel::all(['nama_barang', 'stok']);
            if ($produkList->count() > 0) {
                $html = "<strong>📋 Daftar Stok Obat:</strong><br><table border='1' cellpadding='5'><tr><th>Nama Obat</th><th>Stok</th><th>Satuan</th></tr>";
                foreach ($produkList as $p) {
                    $html .= "<tr><td>{$p->nama_barang}</td><td>{$p->stok}</td><td>{$p->satuan}</td></tr>";
                }
                $html .= "</table>";
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => $html,
                ]);
            }
        }

        // 3️⃣ Intent: Tampilkan seluruh harga
        if (
            (str_contains($userMessage, 'semua') ||
                str_contains($userMessage, 'daftar') ||
                str_contains($userMessage, 'seluruh') ||
                str_contains($userMessage, 'list'))
            && str_contains($userMessage, 'harga')
        ) {
            $produkList = ProdukModel::all(['nama_barang', 'harga_jual']);
            if ($produkList->count() > 0) {
                $html = "<strong>📋 Daftar Harga Obat:</strong><br><table border='1' cellpadding='5'><tr><th>Nama Obat</th><th>Harga Jual</th><th>Satuan</th></tr>";
                foreach ($produkList as $p) {
                    $harga = number_format($p->harga_jual, 0, ',', '.');
                    $html .= "<tr><td>{$p->nama_barang}</td><td>Rp {$harga}</td><td>{$p->satuan}</td></tr>";
                }
                $html .= "</table>";
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => $html,
                ]);
            }
        }

        // 4️⃣ Intent: Harga satu obat
        if (str_contains($userMessage, 'harga')) {
            $produkList = ProdukModel::all();
            $bestMatch = null;
            $highest = 0;
            foreach ($produkList as $produk) {
                similar_text(strtolower($produk->nama_barang), $userMessage, $percent);
                if ($percent > $highest) {
                    $highest = $percent;
                    $bestMatch = $produk;
                }
            }
            if ($bestMatch && $highest > 40) {
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => "Harga <strong>{$bestMatch->nama_barang}</strong> adalah <strong>Rp "
                        . number_format($bestMatch->harga_jual, 0, ',', '.') . "</strong>.",
                ]);
            } else {
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => "❌ Maaf, saya tidak menemukan data harga obat yang kamu maksud.",
                ]);
            }
        }

        // 5️⃣ Intent: Stok satu obat
        if (str_contains($userMessage, 'stok') || str_contains($userMessage, 'tersedia') || str_contains($userMessage, 'sisa')) {
            $produkList = ProdukModel::all();
            $bestMatch = null;
            $highest = 0;

            foreach ($produkList as $produk) {
                similar_text(strtolower($produk->nama_barang), $userMessage, $percent);
                if ($percent > $highest) {
                    $highest = $percent;
                    $bestMatch = $produk;
                }
            }

            if ($bestMatch && $highest > 40) {
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => "Stok <strong>{$bestMatch->nama_barang}</strong> saat ini adalah 
                                   <strong>{$bestMatch->stok}</strong> {$bestMatch->satuan}.",
                ]);
            } else {
                return response()->json([
                    'user_message' => $request->message,
                    'bot_reply'    => "❌ Maaf, stok obat yang kamu maksud tidak ditemukan di database.",
                ]);
            }
        }

        // 6️⃣ Untuk pertanyaan lain → lempar ke Gemini
        $reply = $this->gemini->chat($request->message);
        return response()->json([
            'user_message' => $request->message,
            'bot_reply'    => $reply,
        ]);
    }
}

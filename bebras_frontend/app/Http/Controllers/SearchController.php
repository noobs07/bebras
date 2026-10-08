<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TentangBebras;
use App\Models\MenuSoal;
use App\Models\MenuKegiatan;
use App\Models\Kegiatan;

class SearchController extends Controller
{
    /**
     * Clean HTML / TinyMCE rich text into a clean plain text excerpt.
     */
    private function cleanTinyMceText(?string $html, int $limit = 180): string
    {
        if (empty($html)) {
            return '';
        }

        // Decode HTML entities (&nbsp;, &gt;, &lt;, etc.)
        $text = \html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // Replace closing block tags and breaks with space so words don't stick together
        $text = \preg_replace('/<\/(div|p|h1|h2|h3|h4|h5|h6|li|tr|td|th)>/i', ' ', $text);
        $text = \preg_replace('/<br\s*\/?>/i', ' ', $text);

        // Strip all HTML tags
        $cleanText = \strip_tags($text);

        // Replace multiple spaces or newlines with a single space
        $cleanText = \preg_replace('/\s+/', ' ', $cleanText);
        $cleanText = \trim($cleanText);

        return Str::limit($cleanText, $limit);
    }

    /**
     * Get list of all searchable pages/items in the application.
     */
    private function getSearchableItems()
    {
        $items = collect();

        // 1. Static Pages
        $items->push([
            'title' => 'Beranda',
            'excerpt' => 'Bebras Indonesia - Mengembangkan Kemampuan Computational Thinking Siswa Indonesia. Portal resmi Bebras Indonesia.',
            'keywords' => ['home', 'beranda', 'bebras indonesia'],
            'url' => route('home'),
        ]);

        $items->push([
            'title' => 'Platform Latihan Bebras',
            'excerpt' => 'Akses berbagai platform dan media latihan tantangan Bebras untuk siswa SD, SMP, SMA secara interaktif.',
            'keywords' => ['latihan', 'platform latihan', 'soal latihan', 'praktik'],
            'url' => route('latihan'),
        ]);

        $items->push([
            'title' => 'Alamat & Kontak Bebras Indonesia',
            'excerpt' => 'Informasi alamat kantor, sekretariat, email, dan kontak pengurus Bebras Indonesia.',
            'keywords' => ['kontak', 'alamat', 'hubungi kami', 'email'],
            'url' => route('kontak'),
        ]);

        // 2. Tentang Bebras Pages
        try {
            $tentangList = TentangBebras::with('items')->orderBy('urutan', 'asc')->get();
            foreach ($tentangList as $tb) {
                $isHardcoded = in_array($tb->slug, ['dd_1', 'dd_2', 'dd_3', 'dd_4', 'dd_5', 'dd_6']);
                $url = $isHardcoded ? route('tentangBebras.' . $tb->slug) : route('tentangBebras.show', $tb->slug);

                $rawContent = $tb->konten ?? $tb->deskripsi ?? '';
                if (empty($rawContent) && $tb->items->isNotEmpty()) {
                    $rawContent = implode(' ', $tb->items->pluck('deskripsi')->toArray());
                }

                $excerpt = $this->cleanTinyMceText($rawContent, 180);
                if (empty($excerpt)) {
                    $excerpt = 'Halaman informasi mengenai ' . $tb->judul . ' di Bebras Indonesia.';
                }

                $items->push([
                    'title' => $tb->judul,
                    'excerpt' => $excerpt,
                    'full_text' => $this->cleanTinyMceText($rawContent, 5000),
                    'keywords' => [mb_strtolower($tb->judul), mb_strtolower($tb->slug), 'tentang bebras'],
                    'url' => $url,
                ]);
            }
        } catch (\Throwable $e) {}

        // 3. Menu Soal Pages
        try {
            $soalList = MenuSoal::with(['items', 'challenges'])->get();
            foreach ($soalList as $ms) {
                $routeName = 'soal.show';
                if ($ms->slug === 'siaga-sd') $routeName = 'soal.siaga-sd';
                elseif ($ms->slug === 'penggalang-smp') $routeName = 'soal.penggalang-smp';
                elseif ($ms->slug === 'penegak-sma') $routeName = 'soal.penegak-sma';
                elseif ($ms->slug === 'index-soal') $routeName = 'soal.index-soal';
                elseif ($ms->slug === 'pembahasan-soal') $routeName = 'soal.pembahasan-soal';

                $url = $routeName === 'soal.show' ? route('soal.show', $ms->slug) : route($routeName);

                $rawContent = $ms->body ?? $ms->judul ?? '';
                if ($ms->challenges->isNotEmpty()) {
                    $rawContent .= ' ' . implode(' ', $ms->challenges->pluck('deskripsi')->toArray());
                }
                if ($ms->items->isNotEmpty()) {
                    $rawContent .= ' ' . implode(' ', $ms->items->pluck('deskripsi')->toArray());
                }

                $excerpt = $this->cleanTinyMceText($rawContent, 180);
                if (empty($excerpt)) {
                    $excerpt = 'Tantangan dan kumpulan soal Bebras untuk kategori ' . $ms->nama_menu . '.';
                }

                $items->push([
                    'title' => $ms->nama_menu,
                    'excerpt' => $excerpt,
                    'full_text' => $this->cleanTinyMceText($rawContent, 5000),
                    'keywords' => [mb_strtolower($ms->nama_menu), mb_strtolower($ms->slug), 'soal', 'challenge'],
                    'url' => $url,
                ]);
            }
        } catch (\Throwable $e) {}

        // 4. Menu Kegiatan Pages
        try {
            $kegiatanList = MenuKegiatan::with(['children', 'kegiatans'])->get();
            foreach ($kegiatanList as $mk) {
                if ($mk->children->isEmpty()) {
                    $url = $mk->url ? $mk->url : route('kegiatan.show', $mk->slug);

                    $rawContent = $mk->body ?? $mk->judul ?? '';
                    if ($mk->kegiatans && $mk->kegiatans->isNotEmpty()) {
                        $rawContent .= ' ' . implode(' ', $mk->kegiatans->pluck('deskripsi')->toArray());
                    }

                    $excerpt = $this->cleanTinyMceText($rawContent, 180);
                    if (empty($excerpt)) {
                        $excerpt = 'Informasi kegiatan ' . $mk->nama_menu . ' yang diselenggarakan oleh Bebras Indonesia.';
                    }

                    $items->push([
                        'title' => $mk->nama_menu,
                        'excerpt' => $excerpt,
                        'full_text' => $this->cleanTinyMceText($rawContent, 5000),
                        'keywords' => [mb_strtolower($mk->nama_menu), mb_strtolower($mk->slug), 'kegiatan'],
                        'url' => $url,
                    ]);
                }
            }
        } catch (\Throwable $e) {}

        // 5. Berita / Dynamic Kegiatan Items
        try {
            $beritaList = Kegiatan::where('status_validasi', 'approved')->limit(20)->get();
            foreach ($beritaList as $b) {
                $rawContent = $b->deskripsi ?? '';

                $excerpt = $this->cleanTinyMceText($rawContent, 180);
                if (empty($excerpt)) {
                    $excerpt = 'Berita dan artikel Bebras Indonesia: ' . $b->judul;
                }

                $items->push([
                    'title' => $b->judul,
                    'excerpt' => $excerpt,
                    'full_text' => $this->cleanTinyMceText($rawContent, 5000),
                    'keywords' => [mb_strtolower($b->judul), 'berita', 'kegiatan'],
                    'url' => route('berita'),
                ]);
            }
        } catch (\Throwable $e) {}

        return $items;
    }

    /**
     * Display search results page.
     */
    public function search(Request $request)
    {
        $keyword = trim($request->input('search', ''));

        if (empty($keyword)) {
            return redirect()->route('home');
        }

        $allSearchable = $this->getSearchableItems();
        $keywordLower = mb_strtolower($keyword);

        $results = $allSearchable->filter(function ($item) use ($keywordLower) {
            if (str_contains(mb_strtolower($item['title']), $keywordLower)) {
                return true;
            }
            if (str_contains(mb_strtolower($item['full_text'] ?? $item['excerpt']), $keywordLower)) {
                return true;
            }
            foreach ($item['keywords'] as $kw) {
                if (!empty($kw) && (str_contains(mb_strtolower($kw), $keywordLower) || str_contains($keywordLower, mb_strtolower($kw)))) {
                    return true;
                }
            }
            return false;
        })->values();

        return view('pages.search_results', compact('keyword', 'results'));
    }
}

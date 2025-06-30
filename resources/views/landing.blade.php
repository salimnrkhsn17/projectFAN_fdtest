<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Publik</title>
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #06b6d4;
            --gray: #6b7280;
            --bg: #f3f4f6;
            --white: #ffffff;
            --shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #f0f4ff 0%, #e0e7ff 100%);
            color: #1f2937;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 2rem 1rem;
        }

        /* HERO SECTION STYLES */
        .hero-modern {
            position: relative;
            text-align: center;
            margin-bottom: 2rem;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: var(--shadow);
        }

        .hero-bg-glass {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            z-index: 1;
            border-radius: 1rem;
        }

        .hero-content {
            position: relative;
            padding: 2rem 1rem;
            z-index: 2;
        }

        .hero-icon-svg {
            margin-bottom: 1rem;
            display: inline-block;
        }

        .hero-title-modern {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .hero-title-modern::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            border-radius: 2px;
            animation: underline-slide 0.6s ease-in-out;
        }

        @keyframes underline-slide {
            0% { transform: scaleX(0); }
            100% { transform: scaleX(1); }
        }

        .hero-desc-modern {
            font-size: 1.15rem;
            color: #374151;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
            line-height: 1.7;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            letter-spacing: 0.1px;
        }

        .highlight {
            color: #06b6d4;
            font-weight: 600;
        }

        /* FILTER FORM STYLES */
        .filter-form-modern {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
            box-shadow: var(--shadow);
        }

        .filter-form-modern input,
        .filter-form-modern select {
            padding: 0.8rem 1.2rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            min-width: 180px;
        }

        .filter-form-modern button {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 0.8rem 1.8rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-form-modern button span {
            font-size: 1.2rem;
            display: inline-block;
            transition: transform 0.3s;
        }

        .filter-form-modern button:hover span {
            transform: translateX(4px);
        }

        /* BOOKS GRID AND PAGINATION STYLES (UNCHANGED) */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .book-card {
            background: var(--white);
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform 0.2s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .book-card:hover {
            transform: translateY(-4px);
        }

        .book-image {
            width: 100%;
            aspect-ratio: 3 / 4;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9fafb;
            overflow: hidden;
        }

        .book-thumb {
            width: 100%;
            height: auto;
            max-height: 100%;
            object-fit: contain;
            padding: 0.5rem;
            background-color: #f9fafb;
        }

        .book-content {
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .book-title {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-author {
            color: var(--secondary);
            font-size: 0.95rem;
            font-weight: 500;
        }

        .book-rating {
            font-size: 1rem;
            color: #fbbf24;
        }

        .book-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            color: var(--gray);
            align-items: center;
        }

        .badge {
            padding: 0.25rem 0.7rem;
            background: var(--secondary);
            color: white;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.25rem;
            margin: 1.2rem 0 0.2rem 0;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination .page-link,
        .pagination .page-item span {
            display: inline-block;
            min-width: 36px;
            padding: 0.45rem 0.95rem;
            margin: 0 2px;
            border-radius: 8px;
            border: 1.5px solid #e0e7ff;
            background: #f8fafc;
            color: #4f46e5;
            font-weight: 600;
            font-size: 1rem;
            text-align: center;
            text-decoration: none;
            transition: background 0.15s, color 0.15s, border 0.15s;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(99, 102, 241, 0.04);
        }

        .pagination .page-item.active .page-link,
        .pagination .page-item.active span {
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border-color: #6366f1;
            cursor: default;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
        }

        .pagination .page-link:hover:not(.active),
        .pagination .page-item:not(.active) span:hover {
            background: #e0e7ff;
            color: #22223b;
        }

        .pagination .page-item.disabled .page-link,
        .pagination .page-item.disabled span {
            color: #b0b3c6;
            background: #f1f5f9;
            border-color: #e0e7ff;
            cursor: not-allowed;
        }

        .pagination .page-link:focus {
            outline: 2px solid #6366f1;
            outline-offset: 1px;
        }

        @media (max-width: 600px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .filter-form {
                flex-direction: column;
                align-items: stretch;
            }

            .pagination .page-link,
            .pagination .page-item span {
                min-width: 28px;
                padding: 0.35rem 0.5rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- HERO SECTION -->
        <div class="hero-modern">
            <div class="hero-bg-glass"></div>
            <div class="hero-content">
                <div class="hero-icon-svg">
                    <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="8" width="50" height="38" rx="7" fill="#fff" fill-opacity="0.7" stroke="#6366f1" stroke-width="2.5"/>
                        <rect x="8" y="14" width="38" height="26" rx="4" fill="#6366f1" fill-opacity="0.13"/>
                        <rect x="14" y="20" width="26" height="14" rx="2" fill="#06b6d4" fill-opacity="0.13"/>
                        <rect x="20" y="26" width="14" height="2" rx="1" fill="#6366f1"/>
                        <rect x="20" y="30" width="14" height="2" rx="1" fill="#06b6d4"/>
                    </svg>
                </div>
                <h1 class="hero-title-modern">FANBook - Daftar Buku Publik</h1>
                <div class="hero-desc-modern">
                    <span class="highlight">Temukan</span> & <span class="highlight">bagikan</span> koleksi <span class="highlight">buku</span> terbaik dari komunitas.<br>
                    Gunakan <span class="highlight">filter</span> untuk eksplorasi berdasarkan <span class="highlight">penulis</span>, <span class="highlight">rating</span>, dan lainnya.
                </div>
            </div>
        </div>

        <!-- FILTER FORM -->
        <form method="GET" class="filter-form-modern">
            <input type="text" name="author" placeholder="Cari Penulis..." value="{{ request('author') }}">
            <select name="rating">
                <option value="">Semua Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Bintang</option>
                @endfor
            </select>
            <select name="date">
                <option value="">Urutkan</option>
                <option value="newest" {{ request('date') == 'newest' ? 'selected' : '' }}>Terbaru</option>
            </select>
            <button type="submit"><span>🔍</span> Filter</button>
        </form>

        <div class="books-grid">
            @forelse ($books as $book)
                <div class="book-card">
                    <div class="book-image">
                        <img loading="lazy" class="book-thumb" src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail Buku">
                    </div>
                    <div class="book-content">
                        <div class="book-title">{{ $book->title }}</div>
                        <div class="book-author">Penulis: {{ $book->author }}</div>
                        <div class="book-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                {!! $i <= $book->rating ? '&#9733;' : '<span style="color:#e5e7eb;">&#9733;</span>' !!}
                            @endfor
                            <span style="color: var(--gray);">({{ $book->rating }})</span>
                        </div>
                        <div class="book-footer">
                            <span>{{ $book->user->name }}</span>
                            <span class="badge">{{ $book->rating >= 4 ? 'Populer' : 'Baru' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p style="text-align:center; color: var(--gray); font-size: 1rem; padding: 2rem;">Tidak ada buku ditemukan.</p>
            @endforelse
        </div>

        @php
            // Custom pagination logic (same as books/index.blade.php)
            $window = 1;
            $start = max(1, $books->currentPage() - $window);
            $end = min($books->lastPage(), $books->currentPage() + $window);
        @endphp
        <div class="pagination">
            <ul class="pagination">
                @if ($books->onFirstPage())
                    <li class="page-item disabled"><span>&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">&laquo;</a></li>
                @endif
                @if ($start > 1)
                    <li class="page-item"><a class="page-link" href="{{ $books->url(1) }}">1</a></li>
                    @if ($start > 2)
                        <li class="page-item disabled"><span>...</span></li>
                    @endif
                @endif
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $books->currentPage())
                        <li class="page-item active"><span>{{ $i }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a></li>
                    @endif
                @endfor
                @if ($end < $books->lastPage())
                    @if ($end < $books->lastPage() - 1)
                        <li class="page-item disabled"><span>...</span></li>
                    @endif
                    <li class="page-item"><a class="page-link" href="{{ $books->url($books->lastPage()) }}">{{ $books->lastPage() }}</a></li>
                @endif
                @if ($books->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </div>
    </div>
</body>

</html>

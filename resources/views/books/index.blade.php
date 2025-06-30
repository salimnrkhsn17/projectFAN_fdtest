@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <style>
        .books-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .books-title {
            font-size: 2.1rem;
            font-weight: 900;
            color: #22223b;
            letter-spacing: 1px;
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .books-title svg {
            width: 2.2rem;
            height: 2.2rem;
            color: #6366f1;
            flex-shrink: 0;
        }
        .books-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1.5rem;
            font-size: 1.13rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 2px 10px rgba(99, 102, 241, 0.13);
            transition: background 0.18s, box-shadow 0.18s, transform 0.13s;
            outline: none;
        }
        .books-add-btn:hover, .books-add-btn:focus {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
            box-shadow: 0 4px 18px rgba(99, 102, 241, 0.18);
            transform: translateY(-2px) scale(1.03);
        }
        .books-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.3rem 1.3rem;
            margin-bottom: 2.5rem;
        }
        .book-card {
            background: linear-gradient(135deg, #f8fafc 60%, #e0e7ff 100%);
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(99, 102, 241, 0.10);
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 1.1rem 1.1rem 1.2rem 1.1rem;
            transition: box-shadow 0.18s, transform 0.18s;
            position: relative;
            min-height: 220px;
            max-width: 100%;
        }
        .book-card:hover {
            box-shadow: 0 6px 24px rgba(99, 102, 241, 0.16);
            transform: translateY(-4px) scale(1.025);
        }
        .book-card-row {
            display: flex;
            flex-direction: row;
            gap: 1.1rem;
            align-items: flex-start;
        }
        .book-card-cover {
            width: 110px;
            min-width: 110px;
            height: 160px;
            background: #e0e7ff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .book-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
            background: #e0e7ff;
            display: block;
        }
        .book-card-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
            justify-content: flex-start;
            min-width: 0;
        }
        .book-card-title {
            font-size: 1.08rem;
            font-weight: 900;
            color: #22223b;
            margin-bottom: 0.1rem;
            line-height: 1.2;
            word-break: break-word;
        }
        .book-card-author {
            font-size: 0.98rem;
            color: #6366f1;
            font-weight: 700;
            margin-bottom: 0.1rem;
        }
        .book-card-rating {
            margin: 0.2rem 0 0.5rem 0;
        }
        .book-card-desc {
            font-size: 0.97rem;
            color: #64748b;
            margin-bottom: 0.2rem;
            min-height: 2.2em;
            max-height: 4.2em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .book-card-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.1rem;
            justify-content: flex-end;
        }
        .books-action-btn {
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border: none;
            border-radius: 7px;
            padding: 0.45rem 1.05rem;
            font-size: 0.98rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 1px 6px rgba(99, 102, 241, 0.10);
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: background 0.15s, color 0.15s, box-shadow 0.15s, transform 0.13s;
            outline: none;
            min-width: 80px;
            justify-content: center;
        }
        .books-action-btn svg {
            margin-bottom: 2px; 
        }
        .books-action-btn + .books-action-btn {
            margin-left: 0 !important;
        }
        .books-rating-stars {
            color: #fbbf24;
            font-size: 1.18rem;
            letter-spacing: 0.1em;
            vertical-align: middle;
            display: inline-block;
            filter: drop-shadow(0 1px 2px #fbbf24aa);
            text-shadow: 0 1px 2px #fbbf24aa;
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
        @media (max-width: 1200px) {
            .books-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 900px) {
            .books-grid {
                grid-template-columns: 1fr;
                gap: 1.2rem 0.7rem;
            }
            .book-card-row {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
            .book-card-cover {
                width: 90px;
                min-width: 90px;
                height: 120px;
            }
        }
        @media (max-width: 600px) {
            .books-grid {
                grid-template-columns: 1fr;
                gap: 0.7rem 0.4rem;
            }
            .book-card {
                min-height: 120px;
                padding: 0.7rem 0.5rem 0.9rem 0.5rem;
            }
            .book-card-cover {
                width: 70px;
                min-width: 70px;
                height: 90px;
            }
            .book-card-title {
                font-size: 0.98rem;
            }
        }
        /* Hide old table style if any left */
        .books-table, .books-table-wrap { display: none !important; }
        .modal-book-form-blur {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(40, 40, 60, 0.25);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2.5px);
            transition: background 0.2s;
        }
        .modal-book-form-blur>div.books-form-card {
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.18);
            animation: modalPopIn 0.18s cubic-bezier(.4, 2, .6, 1) both;
        }
        @keyframes modalPopIn {
            0% {
                transform: scale(0.95) translateY(30px);
                opacity: 0;
            }
            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }
        body.modal-open {
            overflow: hidden;
        }
    </style>

    <div class="books-header">
        <div class="books-title">
            <svg width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="6" width="18" height="12" rx="3" fill="#e0e7ff"/>
                <rect x="7" y="10" width="10" height="4" rx="1" fill="#6366f1" fill-opacity="0.13"/>
            </svg>
            Daftar Buku Saya
        </div>
        <a href="{{ route('books.create') }}" class="books-add-btn" id="btn-add-book">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
            Tambah Buku
        </a>
    </div>
    <div style="font-size:1.05rem;color:#64748b;margin-bottom:1.2rem;margin-top:-1.1rem;max-width:600px;">
        Semua buku yang kamu upload akan tampil di sini. Kelola koleksi bukumu dengan mudah!
    </div>

    @if(session('success'))
        <div class="books-success">{{ session('success') }}</div>
    @endif

    <div class="books-grid-wrap">
        <div class="books-grid" id="books-grid">
            @forelse($books as $book)
                <div class="book-card">
                    <div class="book-card-row">
                        <div class="book-card-cover">
                            @if($book->thumbnail)
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="cover" class="book-card-img">
                            @else
                                <div class="book-card-img book-card-img-placeholder">No Cover</div>
                            @endif
                        </div>
                        <div class="book-card-info">
                            <div class="book-card-title">{{ $book->title }}</div>
                            <div class="book-card-author">{{ $book->author }}</div>
                            <div class="book-card-rating">
                                <span class="books-rating-stars">
                                    @for ($star = 1; $star <= 5; $star++)
                                        @if ($star <= $book->rating)
                                            &#9733;
                                        @else
                                            <span style="color:#e5e7eb;">&#9733;</span>
                                        @endif
                                    @endfor
                                </span>
                                <span class="books-rating-num">({{ $book->rating }})</span>
                            </div>
                            <div class="book-card-desc">{{ Str::limit($book->description, 120) }}</div>
                        </div>
                    </div>
                    <div class="book-card-actions">
                        @can('update', $book)
                            <a href="{{ route('books.edit', $book) }}" class="books-action-btn" title="Edit">
                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 1 1 2.828 2.828L11.828 15.828a2 2 0 0 1-2.828 0L9 13z" />
                                    <path d="M16 7l1 1" />
                                </svg>
                                Edit
                            </a>
                        @endcan
                        @can('delete', $book)
                            <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="books-action-btn"
                                    onclick="return confirm('Yakin hapus buku ini?')" title="Hapus">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m5 0V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            @empty
                <div class="book-card book-card-empty">Belum ada buku.</div>
            @endforelse
        </div>
    </div>
    <div id="books-pagination" style="margin-top: 20px;">
        <nav aria-label="Books pagination">
            <ul class="pagination">
                @if ($books->onFirstPage())
                    <li class="page-item disabled"><span>&laquo;</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">&laquo;</a></li>
                @endif
                @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                    @if ($page == $books->currentPage())
                        <li class="page-item active"><span>{{ $page }}</span></li>
                    @elseif ($page == 1 || $page == $books->lastPage() || abs($page - $books->currentPage()) <= 1)
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @elseif ($page == $books->currentPage() - 2 || $page == $books->currentPage() + 2)
                        <li class="page-item disabled"><span>...</span></li>
                    @endif
                @endforeach
                @if ($books->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">&raquo;</a></li>
                @else
                    <li class="page-item disabled"><span>&raquo;</span></li>
                @endif
            </ul>
        </nav>
    </div>
    
    <div id="modal-book-form" class="modal-book-form-blur" style="display:none;"></div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function openModal(html) {
            document.getElementById('modal-book-form').innerHTML = html;
            document.getElementById('modal-book-form').style.display = 'flex';
            document.body.classList.add('modal-open');
        }
        function closeModal() {
            document.getElementById('modal-book-form').style.display = 'none';
            document.getElementById('modal-book-form').innerHTML = '';
            document.body.classList.remove('modal-open');
        }
        // Open create form in modal via AJAX
        document.getElementById('btn-add-book').addEventListener('click', function(e) {
            e.preventDefault();
            fetch(this.href, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                .then(res => res.text())
                .then(openModal);
        });
        // Edit & delete button event delegation
        document.getElementById('books-grid').addEventListener('click', function(e) {
            if(e.target.closest('.books-action-btn[title="Edit"]')) {
                e.preventDefault();
                let link = e.target.closest('a');
                fetch(link.href, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                    .then(res => res.text())
                    .then(openModal);
            }
            if(e.target.closest('.books-action-btn[title="Hapus"]')) {
                e.preventDefault();
                if(confirm('Yakin hapus buku ini?')) {
                    let form = e.target.closest('form');
                    let data = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        body: data
                    })
                    .then(res => res.json())
                    .then(resp => {
                        if(resp.success) reloadBooks();
                        else alert('Gagal menghapus buku');
                    });
                }
            }
        });
        // Close modal on outside click
        document.getElementById('modal-book-form').addEventListener('click', function(e) {
            if(e.target === this) closeModal();
        });
        // Close modal on Escape key
        document.body.addEventListener('keydown', function(e) {
            if(e.key === 'Escape') closeModal();
        });
        // Reload books grid
        function reloadBooks() {
            fetch(window.location.href, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                .then(res => res.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    document.getElementById('books-grid').innerHTML = doc.getElementById('books-grid').innerHTML;
                    closeModal();
                });
        }
        // Listen form submit in modal (create/edit)
        document.body.addEventListener('submit', function(e) {
            if(e.target.matches('#form-create-book, #form-edit-book')) {
                e.preventDefault();
                let form = e.target;
                let data = new FormData(form);
                fetch(form.action, {
                    method: form.method,
                    headers: {'X-Requested-With': 'XMLHttpRequest'},
                    body: data
                })
                .then(res => res.json())
                .then(resp => {
                    if(resp.success) {
                        reloadBooks();
                    } else {
                        alert('Gagal menyimpan data');
                    }
                });
            }
        });
    });
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <style>
        .books-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .books-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: #22223b;
            letter-spacing: 1px;
        }

        .books-add-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.7rem 1.3rem;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
            transition: background 0.18s;
        }

        .books-add-btn:hover {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        }

        .books-table-wrap {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(99, 102, 241, 0.08);
            padding: 1.2rem 1rem 1.2rem 1rem;
            overflow-x: auto;
            border: 1.5px solid #e0e7ff;
            margin-bottom: 2rem;
        }

        .books-table {
            width: 100%;
            border-collapse: collapse;
            /* Ganti dari separate → collapse untuk keselarasan garis */
            font-size: 1.04rem;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            overflow: hidden;
            /* untuk rounding sudut */
        }

        .books-table th,
        .books-table td {
            padding: 0.85rem 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .books-table th {
            background-color: #f1f5f9;
            color: #4f46e5;
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
            text-transform: capitalize;
        }

        .books-table tr:hover td {
            background-color: #f0f4ff;
            transition: background-color 0.2s ease;
        }

        .books-table td {
            color: #1f2937;
            vertical-align: middle;
            font-weight: 500;
        }

        .books-cover-thumb {
            width: 64px;
            height: 90px;
            border-radius: 8px;
            object-fit: contain;
            background: #e0e7ff;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.08);
            border: 1px solid #e5e7eb;
            display: block;
            margin: 0 auto;
        }

        .books-rating-stars {
            color: #f59e42;
            font-size: 1.1rem;
            letter-spacing: 0.1em;
            vertical-align: middle;
            display: inline-block;
        }

        .books-rating-num {
            color: #64748b;
            font-size: 0.98rem;
            margin-left: 0.2em;
            display: inline-block;
        }

        .books-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .books-action-btn {
            background: #f1f5f9;
            border: none;
            border-radius: 6px;
            padding: 0.4rem 0.7rem;
            color: #6366f1;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            text-decoration: none;
        }

        .books-action-btn:hover {
            background: #6366f1;
            color: #fff;
        }

        .books-action-btn svg {
            vertical-align: middle;
            margin-bottom: 2px;
        }

        .books-success {
            color: #10b981;
            background: #d1fae5;
            border-radius: 8px;
            padding: 0.7rem 1rem;
            margin-bottom: 1.2rem;
            font-size: 1rem;
            text-align: center;
        }

        @media (max-width: 700px) {
            .books-header {
                flex-direction: column;
                align-items: stretch;
                gap: 0.7rem;
            }

            .books-title {
                font-size: 1.2rem;
            }

            .books-table th,
            .books-table td {
                padding: 0.6rem 0.4rem;
            }

            .books-table-wrap {
                padding: 0.7rem 0.2rem;
            }
        }

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
            .pagination .page-link,
            .pagination .page-item span {
                min-width: 28px;
                padding: 0.35rem 0.6rem;
                font-size: 0.98rem;
            }
        }

        .main-content {
            transition: margin-left 0.18s;
        }

        .sidebar.sidebar-collapsed ~ .main-content {
            margin-left: 64px !important;
        }
    </style>

    <div class="books-header">
        <div class="books-title">Daftar Buku Saya</div>
        <a href="{{ route('books.create') }}" class="books-add-btn" id="btn-add-book">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="16" />
                <line x1="8" y1="12" x2="16" y2="12" />
            </svg>
            Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="books-success">{{ session('success') }}</div>
    @endif

    <div class="books-table-wrap" id="books-table-wrap">
        <table class="books-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Rating</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td style="max-width:220px; white-space:pre-line; overflow:hidden; text-overflow:ellipsis;">
                            {{ Str::limit($book->description, 120) }}
                        </td>
                        <td>
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
                        </td>
                        <td>
                            @if($book->thumbnail)
                                <img src="{{ asset('storage/' . $book->thumbnail) }}" alt="cover" class="books-cover-thumb">
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <div class="books-actions">
                                @can('update', $book)
                                    <a href="{{ route('books.edit', $book) }}" class="books-action-btn" title="Edit">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 1 1 2.828 2.828L11.828 15.828a2 2 0 0 1-2.828 0L9 13z" />
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
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m5 0V4a2 2 0 0 1 2-2h0a2 2 0 0 1 2 2v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;color:#64748b;">Belum ada buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
        document.getElementById('books-table-wrap').addEventListener('click', function(e) {
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
        // Reload books table
        function reloadBooks() {
            fetch(window.location.href, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
                .then(res => res.text())
                .then(html => {
                    let parser = new DOMParser();
                    let doc = parser.parseFromString(html, 'text/html');
                    document.getElementById('books-table-wrap').innerHTML = doc.getElementById('books-table-wrap').innerHTML;
                    document.getElementById('books-pagination').innerHTML = doc.getElementById('books-pagination').innerHTML;
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
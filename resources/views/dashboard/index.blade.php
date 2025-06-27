@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-header-card {
        max-width: 540px;
        margin: 2.5rem auto 1.5rem auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 18px rgba(99,102,241,0.1), 0 2px 6px rgba(0,0,0,0.03);
        padding: 2rem 1.5rem 1.8rem 1.5rem;
        border: 1.5px solid #e0e7ff;
        text-align: center;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 900;
        color: #1e293b;
        margin-bottom: 0.4rem;
    }

    .dashboard-info {
        font-size: 1.1rem;
        color: #475569;
        margin-bottom: 0.7rem;
    }

    .dashboard-status {
        font-size: 1rem;
        margin-bottom: 1.2rem;
    }

    .dashboard-status .verified {
        color: #10b981;
        font-weight: 600;
    }

    .dashboard-status .not-verified {
        color: #ef4444;
        font-weight: 600;
    }

    .dashboard-clock-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 0.5rem;
        gap: 0.2rem;
    }

    .dashboard-clock {
        font-size: 1.6rem;
        font-weight: 700;
        color: #6366f1;
        background: #f3f4f6;
        border-radius: 8px;
        padding: 0.3rem 1.2rem;
        box-shadow: 0 2px 10px rgba(99,102,241,0.07);
        font-family: 'Courier New', monospace;
        letter-spacing: 2px;
    }

    .dashboard-date {
        font-size: 1.05rem;
        color: #06b6d4;
        font-weight: 600;
    }

    .dashboard-tip {
        margin-top: 1.8rem;
        background: #f1f5f9;
        color: #6366f1;
        border-radius: 10px;
        padding: 1rem 1.2rem;
        font-size: 1rem;
        text-align: center;
        box-shadow: 0 2px 8px rgba(99,102,241,0.06);
        font-style: italic;
    }

    .dashboard-books-title {
        font-size: 1.35rem;
        font-weight: 800;
        color: #4338ca;
        margin: 3rem 0 1rem 0.5rem;
        text-align: left;
        letter-spacing: 0.4px;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        max-width: 720px;
        margin-left: auto;
        margin-right: auto;
    }

    .dashboard-books-list {
        max-width: 720px;
        margin: 0 auto 2rem auto;
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .dashboard-book-item {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        background: #f8fafc;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(99,102,241,0.06);
        padding: 1rem 1.2rem;
        border: 1.2px solid #e0e7ff;
    }

    .dashboard-book-thumb {
        width: 64px;
        height: 86px;
        border-radius: 8px;
        object-fit: cover;
        background: #e0e7ff;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 6px rgba(99,102,241,0.08);
    }

    .dashboard-book-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        min-width: 0;
    }

    .dashboard-book-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .dashboard-book-meta {
        font-size: 0.97rem;
        color: #475569;
        display: flex;
        gap: 1.2rem;
        flex-wrap: wrap;
    }

    .dashboard-book-rating {
        color: #f59e42;
        font-size: 1rem;
        font-weight: 600;
        letter-spacing: 0.05em;
    }

    .dashboard-book-status {
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
        border-radius: 999px;
        padding: 0.2rem 0.8rem;
    }

    .dashboard-book-status.baru {
        background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
    }

    .dashboard-book-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .dashboard-book-actions button {
        background: #f1f5f9;
        border: none;
        border-radius: 6px;
        padding: 0.5rem 0.8rem;
        color: #6366f1;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.15s, color 0.15s;
        font-weight: 600;
    }

    .dashboard-book-actions button:hover {
        background: #6366f1;
        color: #fff;
    }

    .main-content {
        transition: margin-left 0.18s;
    }
    .sidebar.sidebar-collapsed ~ .main-content {
        margin-left: 64px !important;
    }

    @media (max-width: 600px) {
        .dashboard-header-card {
            padding: 1.2rem 1rem;
        }

        .dashboard-title {
            font-size: 1.2rem;
        }

        .dashboard-clock {
            font-size: 1.1rem;
        }

        .dashboard-books-title,
        .dashboard-books-list {
            max-width: 100%;
            padding: 0 1rem;
        }
    }
</style>

<div class="dashboard-header-card">
    <div class="dashboard-title">Selamat Datang, {{ $user->name }}</div>
    <div class="dashboard-info">Email: {{ $user->email }}</div>
    <div class="dashboard-status">
        Status Verifikasi:
        @if($user->hasVerifiedEmail())
            <span class="verified">
                ✅ Terverifikasi
            </span>
        @else
            <span class="not-verified">
                ❌ Belum Verifikasi
            </span>
        @endif
    </div>
    <div class="dashboard-clock-wrap">
        <div class="dashboard-clock" id="clock"></div>
        <div class="dashboard-date" id="date"></div>
    </div>
    <div class="dashboard-tip">
        <b>Tips:</b> Jaga keamanan akun Anda, gunakan password yang kuat dan jangan bagikan ke siapapun.<br>
        Selamat berkarya dan berbagi buku di FAN Book!
    </div>
</div>

<div class="dashboard-books-title">
    <svg width="22" height="22" fill="none" stroke="#6366f1" stroke-width="2" style="vertical-align:middle;" viewBox="0 0 24 24">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
        <path d="M20 22V6a2 2 0 0 0-2-2H6.5A2.5 2.5 0 0 0 4 6.5v13"/>
    </svg>
    Buku yang Kamu Upload
</div>

<div class="dashboard-books-list">
    @forelse($user->books as $book)
        <div class="dashboard-book-item">
            <img class="dashboard-book-thumb" src="{{ asset('storage/' . $book->thumbnail) }}" alt="Thumbnail Buku">
            <div class="dashboard-book-info">
                <div class="dashboard-book-title">{{ $book->title }}</div>
                <div class="dashboard-book-meta">
                    <span>Penulis: {{ $book->author }}</span>
                    <span class="dashboard-book-rating">
                        @for ($star = 1; $star <= 5; $star++)
                            @if ($star <= $book->rating)
                                &#9733;
                            @else
                                <span style="color:#e5e7eb;">&#9733;</span>
                            @endif
                        @endfor
                        ({{ $book->rating }})
                    </span>
                    <span class="dashboard-book-status{{ $book->rating < 4 ? ' baru' : '' }}">
                        {{ $book->rating >= 4 ? 'Populer' : 'Baru' }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div style="color:#64748b;text-align:center;font-size:1rem;padding:1.2rem 0;">
            Belum ada buku yang kamu upload.
        </div>
    @endforelse
</div>

<script>
    function updateClock() {
        const now = new Date();
        const jam = now.getHours().toString().padStart(2, '0');
        const menit = now.getMinutes().toString().padStart(2, '0');
        const detik = now.getSeconds().toString().padStart(2, '0');
        document.getElementById('clock').textContent = `${jam}:${menit}:${detik}`;

        const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        const tgl = now.getDate();
        const bln = bulan[now.getMonth()];
        const thn = now.getFullYear();
        const hariStr = hari[now.getDay()];
        document.getElementById('date').textContent = `${hariStr}, ${tgl} ${bln} ${thn}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection

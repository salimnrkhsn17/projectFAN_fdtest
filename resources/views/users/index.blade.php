@extends('layouts.app')

@section('title', 'Daftar User Terverifikasi')

@section('content')
    <style>
        .users-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(99, 102, 241, 0.10);
            padding: 2.2rem 2rem 2.5rem 2rem;
        }

        .users-title {
            font-size: 2rem;
            font-weight: 800;
            color: #22223b;
            margin-bottom: 1.7rem;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .users-search-form {
            display: flex;
            gap: 0.7rem;
            margin-bottom: 1.7rem;
            justify-content: center;
        }

        .users-search-input {
            flex: 1 1 320px;
            padding: 0.8rem 1.1rem;
            border: 1.5px solid #e0e7ff;
            border-radius: 10px;
            font-size: 1.08rem;
            background: #f8fafc;
            transition: border 0.18s;
        }

        .users-search-input:focus {
            border-color: #6366f1;
            outline: none;
        }

        .users-search-btn {
            background: linear-gradient(90deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 0.8rem 1.7rem;
            font-size: 1.08rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.10);
            transition: background 0.18s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .users-search-btn:hover {
            background: linear-gradient(90deg, #06b6d4 0%, #6366f1 100%);
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 16px rgba(99, 102, 241, 0.08);
        }

        .users-table th,
        .users-table td {
            padding: 1rem 1.2rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .users-table th {
            background-color: #f1f5f9;
            color: #4f46e5;
            font-weight: 700;
            font-size: 1.08rem;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }

        .users-table tr:hover td {
            background-color: #f0f4ff;
            transition: background-color 0.2s ease;
        }

        .users-table td {
            color: #1f2937;
            vertical-align: middle;
            font-weight: 500;
        }

        .users-empty {
            text-align: center;
            color: #64748b;
            padding: 1.5rem;
            font-size: 1.08rem;
        }

        @media (max-width: 700px) {
            .users-container {
                padding: 1.2rem 0.5rem 1.5rem 0.5rem;
            }

            .users-title {
                font-size: 1.3rem;
            }

            .users-search-form {
                flex-direction: column;
                gap: 0.5rem;
            }

            .users-search-btn {
                width: 100%;
                justify-content: center;
            }

            .users-table th,
            .users-table td {
                padding: 0.7rem 0.5rem;
            }
        }
    </style>

    <div class="users-container">
        <div class="users-title">Daftar User Terverifikasi</div>
        <form class="users-search-form" method="GET" action="{{ route('users.index') }}">
            <input type="text" name="search" class="users-search-input" placeholder="Cari nama atau email pengguna..."
                value="{{ request('search') }}">
            <button type="submit" class="users-search-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                </svg>
                Cari
            </button>
        </form>

        <table id="users-table" class="users-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tanggal Verifikasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr data-user-id="{{ $user->id }}">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->email_verified_at)
                                {{ $user->email_verified_at->setTimezone('Asia/Jakarta')->translatedFormat('d F Y H:i') }} WIB
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="users-empty">
                        <td colspan="3">Tidak ada user terverifikasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('user-search');
            const table = document.getElementById('users-table');
            const form = document.querySelector('.users-search-form');

            function norm(str) {
                try {
                    return (str || '').toLowerCase().trim();
                } catch (e) {
                    return '';
                }
            }

            function filterUsers() {
                const filter = norm(searchInput.value);
                let found = false;

                for (const row of table.tBodies[0].rows) {
                    if (row.classList.contains('users-empty')) continue;

                    const name = norm(row.cells[0]?.textContent);
                    const email = norm(row.cells[1]?.textContent);

                    if (name.includes(filter) || email.includes(filter)) {
                        row.style.display = '';
                        found = true;
                    } else {
                        row.style.display = 'none';
                    }
                }

                const emptyRow = table.querySelector('tr.users-empty');
                if (emptyRow) emptyRow.style.display = found ? 'none' : '';
            }

            searchInput.addEventListener('input', filterUsers);
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                filterUsers();
            });
        });
    </script>
@endsection
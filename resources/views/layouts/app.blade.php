<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'FANBook')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background: #f0f4ff;
        }

        .layout-root {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 230px;
            background: linear-gradient(120deg, #6366f1 0%, #06b6d4 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 2.2rem 1.2rem 1.2rem 1.2rem;
            box-shadow: 2px 0 16px rgba(99, 102, 241, 0.08);
            position: relative;
            z-index: 2;
        }

        .sidebar .sidebar-title {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 2.5rem;
            text-align: left;
        }

        .sidebar .sidebar-profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 2.2rem;
        }

        .sidebar .sidebar-profile .avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            color: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
        }

        .sidebar .sidebar-profile .profile-link {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            font-size: 1.08rem;
            transition: text-decoration 0.2s;
        }

        .sidebar .sidebar-profile .profile-link:hover {
            text-decoration: underline;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
            flex: 0 0 auto;
        }

        .sidebar-nav li {
            margin-bottom: 0.7rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.08rem;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            transition: background 0.15s, color 0.15s;
        }

        .sidebar-nav a.active,
        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.13);
            color: #f1f5f9;
        }

        .sidebar-nav .icon {
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logout {
            margin-top: 10px;
            text-align: left;
        }

        .sidebar-logout form {
            display: flex;
            justify-content: flex-start;
        }

        .sidebar-logout button {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.18s;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.10);
            letter-spacing: 0.5px;
        }

        .sidebar-logout button:hover {
            background: #dc2626;
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            font-size: 1.08rem;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            transition: background 0.15s, color 0.15s;
        }

        .logout-link:hover {
            background: rgba(255, 255, 255, 0.13);
            color: #f1f5f9;
        }

        .main-content {
            flex: 1;
            padding: 2.5rem 2.5rem 2.5rem 2.5rem;
            background: #f8fafc;
            min-height: 100vh;
        }

        .sidebar.sidebar-collapsed {
            width: 64px !important;
            min-width: 64px !important;
            padding-left: 0.2rem !important;
            padding-right: 0.2rem !important;
        }

        .sidebar.sidebar-collapsed .sidebar-title,
        .sidebar.sidebar-collapsed .sidebar-profile .profile-link,
        .sidebar.sidebar-collapsed .sidebar-profile .avatar + a,
        .sidebar.sidebar-collapsed .sidebar-nav a > span:not(.icon),
        .sidebar.sidebar-collapsed .sidebar-logout .logout-link > span:not(.icon),
        .sidebar.sidebar-collapsed .sidebar-profile .avatar + .profile-link {
            display: none !important;
        }

        .sidebar.sidebar-collapsed .sidebar-profile {
            flex-direction: column;
            align-items: center;
            gap: 0;
        }

        .sidebar.sidebar-collapsed .sidebar-profile .avatar {
            margin: 0 auto;
            width: 36px;
            height: 36px;
            font-size: 1.1rem;
        }

        .sidebar.sidebar-collapsed .sidebar-nav a {
            justify-content: center;
            padding: 0.7rem 0.2rem;
            background: none !important;
            color: #fff !important;
            font-size: 1.35rem;
        }

        .sidebar.sidebar-collapsed .sidebar-nav a.active,
        .sidebar.sidebar-collapsed .sidebar-nav a:hover {
            background: none !important;
            color: #fff !important;
        }

        .sidebar.sidebar-collapsed .sidebar-nav a:focus {
            background: none !important;
            color: #fff !important;
        }

        .sidebar.sidebar-collapsed .sidebar-nav .icon {
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar.sidebar-collapsed .sidebar-logout {
            text-align: center;
        }

        .sidebar.sidebar-collapsed .sidebar-logout .logout-link {
            justify-content: center;
            padding: 0.7rem 0.2rem;
            background: none !important;
            color: #fff !important;
        }

        .sidebar.sidebar-collapsed .sidebar-logout .logout-link:hover {
            background: rgba(255, 255, 255, 0.10) !important;
            color: #fff !important;
        }

        .sidebar.sidebar-collapsed .sidebar-profile {
            margin-bottom: 1.2rem;
        }

        .sidebar.sidebar-collapsed .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        /* Ganti icon agar lebih jelas saat collapse */
        .sidebar-nav .icon svg,
        .sidebar.sidebar-collapsed .sidebar-nav .icon svg,
        .sidebar.sidebar-collapsed .sidebar-logout .icon svg {
            width: 28px !important;
            height: 28px !important;
            stroke-width: 2.2;
        }

        .sidebar.sidebar-collapsed .sidebar-nav a,
        .sidebar.sidebar-collapsed .sidebar-logout .logout-link {
            min-width: 44px;
        }

        @media (max-width: 900px) {
            .sidebar.sidebar-collapsed {
                width: 44px !important;
                min-width: 44px !important;
            }
        }

        .sidebar.sidebar-collapsed .sidebar-logout .logout-link > .logout-label {
            display: none !important;
        }

        .sidebar-logout .icon svg {
            display: block;
            margin: 0 auto;
            width: 26px;
            height: 26px;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            let sidebarTimeout;
            function collapseSidebar() {
                sidebar.classList.add('sidebar-collapsed');
            }
            function expandSidebar() {
                sidebar.classList.remove('sidebar-collapsed');
            }
            sidebar.addEventListener('mouseenter', function () {
                clearTimeout(sidebarTimeout);
                expandSidebar();
            });
            sidebar.addEventListener('mouseleave', function () {
                sidebarTimeout = setTimeout(collapseSidebar, 120);
            });
            // Collapse on load (desktop only)
            if (window.innerWidth > 600) collapseSidebar();
        });
    </script>
</head>

<body>
    <div class="layout-root">
        <aside class="sidebar">
            <div class="sidebar-title">FAN Book</div>
            <div class="sidebar-profile">
                <div class="avatar">
                    {{-- Inisial user, fallback ke "U" --}}
                    {{ auth()->user() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                </div>
                <a href="{{ route('profile.index') }}" class="profile-link">
                    {{-- Nama user, fallback ke "Profile" --}}
                    {{ auth()->user() ? auth()->user()->name : 'Profile' }}
                </a>
            </div>
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <span class="icon">
                            <!-- Dashboard SVG -->
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <rect x="3" y="3" width="7" height="7" rx="2" />
                                <rect x="14" y="3" width="7" height="7" rx="2" />
                                <rect x="14" y="14" width="7" height="7" rx="2" />
                                <rect x="3" y="14" width="7" height="7" rx="2" />
                            </svg>
                        </span>
                        <span class="nav-label">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('books.index') }}" class="{{ request()->is('books*') ? 'active' : '' }}">
                        <span class="icon">
                            <!-- Book SVG -->
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.2"
                                viewBox="0 0 24 24">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                <path d="M20 22V6a2 2 0 0 0-2-2H6.5A2.5 2.5 0 0 0 4 6.5v13" />
                            </svg>
                        </span>
                        <span class="nav-label">Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}">
                        <span class="icon">
                            <!-- Users SVG -->
                            <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                                <circle cx="9" cy="7" r="4" />
                                <path d="M17 11a4 4 0 1 0-8 0" />
                                <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                                <circle cx="17" cy="7" r="4" />
                            </svg>
                        </span>
                        <span class="nav-label">Pengguna</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-logout">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="logout-link" title="Logout">
                    <span class="icon">
                        <!-- Logout SVG: Lebih tegas dan besar -->
                        <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2.2"
                            viewBox="0 0 24 24">
                            <path d="M17 16l4-4m0 0l-4-4m4 4H9" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M13 5v-1a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1"
                                stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="logout-label">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>

</html>
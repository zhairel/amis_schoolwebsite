@extends('layouts.app')

@section('title', 'Halaqah Registrations Admin Portal | AMIS')

@section('styles')
<style>
    .admin-container {
        padding: 40px 0 80px;
        min-height: 85vh;
        background: #f8fafc;
    }
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .admin-title h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #064e3b;
        margin: 0 0 6px;
        letter-spacing: -0.5px;
    }
    .admin-title p {
        margin: 0;
        color: #64748b;
        font-size: 1rem;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }
    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-icon.total { background: #ecfdf5; color: #059669; }
    .stat-icon.online { background: #eff6ff; color: #2563eb; }
    .stat-icon.parents { background: #fdf2f8; color: #db2777; }
    .stat-icon.level { background: #fffbeb; color: #d97706; }

    .stat-val {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-lbl {
        font-size: 0.88rem;
        color: #64748b;
        font-weight: 600;
    }

    /* Controls Bar */
    .controls-bar {
        background: white;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }
    .tabs-group {
        display: flex;
        gap: 8px;
        background: #f1f5f9;
        padding: 4px;
        border-radius: 12px;
    }
    .tab-btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s;
    }
    .tab-btn.active {
        background: white;
        color: #059669;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .search-box {
        display: flex;
        gap: 10px;
        flex-grow: 1;
        max-width: 400px;
    }
    .search-box input {
        width: 100%;
        padding: 9px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        font-size: 0.92rem;
    }
    .btn-action {
        padding: 10px 18px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: none;
        cursor: pointer;
    }
    .btn-csv {
        background: #059669;
        color: white;
        box-shadow: 0 4px 12px rgba(5,150,105,0.2);
    }
    .btn-csv:hover {
        background: #047857;
    }

    /* Table */
    .table-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
        font-size: 0.92rem;
    }
    .custom-table th {
        background: #064e3b;
        color: #fef08a;
        font-weight: 700;
        padding: 16px;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    .custom-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
        vertical-align: middle;
    }
    .custom-table tr:hover td {
        background: #f8fafc;
    }

    /* Badges */
    .badge-type {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 800;
    }
    .badge-online { background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; }
    .badge-parents { background: #fdf2f8; color: #be185d; border: 1px solid #fbcfe8; }
    .badge-level-beg { background: #faf5ff; color: #6b21a8; border: 1px solid #e9d5ff; }
    .badge-level-adv { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }

    .fb-link-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #1877f2;
        color: white;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
    }
    .fb-link-btn:hover {
        background: #166fe5;
        color: white;
    }

    @media (max-width: 968px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .controls-bar { flex-direction: column; align-items: stretch; }
        .search-box { max-width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <div class="container">
        <!-- HEADER -->
        <div class="admin-header">
            <div class="admin-title">
                <h1>Halaqah Registrations Portal</h1>
                <p>Manage and review student and parent registrations recorded in real-time.</p>
            </div>
            <div>
                <a href="{{ route('admin.halaqah.export') }}" class="btn-action btn-csv">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    Download CSV Report
                </a>
            </div>
        </div>

        @if(session('success'))
            <div style="background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 14px 18px; border-radius: 12px; font-weight: 700; margin-bottom: 24px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- STATS GRID -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon total">
                    <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <div class="stat-val">{{ number_format($totalCount) }}</div>
                    <div class="stat-lbl">Total Registrations</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon online">
                    <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <div class="stat-val">{{ number_format($onlineCount) }}</div>
                    <div class="stat-lbl">Halaqah Online</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon parents">
                    <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <div class="stat-val">{{ number_format($parentsCount) }}</div>
                    <div class="stat-lbl">Halaqah Parents</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon level">
                    <svg width="26" height="26" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div>
                    <div class="stat-val">{{ $beginnerCount }} <span style="font-size:0.9rem; font-weight:600; color:#64748b;">Beg</span> / {{ $advanceCount }} <span style="font-size:0.9rem; font-weight:600; color:#64748b;">Adv</span></div>
                    <div class="stat-lbl">Learning Levels</div>
                </div>
            </div>
        </div>

        <!-- CONTROLS & FILTERS -->
        <div class="controls-bar">
            <div class="tabs-group">
                <a href="{{ route('admin.halaqah.index') }}" class="tab-btn {{ !$type ? 'active' : '' }}">All ({{ $totalCount }})</a>
                <a href="{{ route('admin.halaqah.index', ['type' => 'online']) }}" class="tab-btn {{ $type === 'online' ? 'active' : '' }}">Halaqah Online ({{ $onlineCount }})</a>
                <a href="{{ route('admin.halaqah.index', ['type' => 'parents']) }}" class="tab-btn {{ $type === 'parents' ? 'active' : '' }}">Halaqah Parents ({{ $parentsCount }})</a>
            </div>

            <form action="{{ route('admin.halaqah.index') }}" method="GET" class="search-box">
                @if($type)<input type="hidden" name="type" value="{{ $type }}"/>@endif
                <input type="text" name="search" value="{{ $search }}" placeholder="Search name, mobile, email, or FB account..."/>
                <button type="submit" class="btn-action" style="background:#0f172a; color:white;">Search</button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="table-card">
            <div style="overflow-x: auto;">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Date / Type</th>
                            <th>Full Name</th>
                            <th>Age / Sex / Status</th>
                            <th>Level</th>
                            <th>FB Account</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                            @php
                                $programType = $reg->type ?: ($reg->grade_level ?: 'Halaqah Registration');
                                $isParents = str_contains(strtolower($programType), 'parents');
                                $fbUrl = $reg->fb_account ?: $reg->ms_teams;
                                if ($fbUrl && !str_starts_with($fbUrl, 'http://') && !str_starts_with($fbUrl, 'https://')) {
                                    $fbUrl = 'https://' . $fbUrl;
                                }
                            @endphp
                            <tr>
                                <td>
                                    <div style="font-size: 0.8rem; font-weight: 700; color: #64748b; margin-bottom: 4px;">
                                        {{ $reg->created_at ? $reg->created_at->format('M d, Y g:i A') : 'N/A' }}
                                    </div>
                                    <span class="badge-type {{ $isParents ? 'badge-parents' : 'badge-online' }}">
                                        {{ $isParents ? 'HALAQAH PARENTS' : 'HALAQAH ONLINE' }}
                                    </span>
                                </td>
                                <td>
                                    <strong style="font-size: 1rem; color: #0f172a;">{{ $reg->name }}</strong>
                                </td>
                                <td>
                                    <div style="font-weight: 700; color: #334155;">
                                        Age: {{ $reg->age ?: 'N/A' }} | {{ $reg->sex ?: 'N/A' }}
                                    </div>
                                    <div style="font-size: 0.8rem; color: #64748b; font-weight: 600;">
                                        Status: {{ $reg->status ?: 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    @if(str_contains(strtoupper($reg->level), 'ADVANCE'))
                                        <span class="badge-type badge-level-adv">ADVANCE</span>
                                    @else
                                        <span class="badge-type badge-level-beg">BEGINNER</span>
                                    @endif
                                </td>
                                <td>
                                    @if($fbUrl)
                                        <a href="{{ $fbUrl }}" target="_blank" class="fb-link-btn">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            Open Profile
                                        </a>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic;">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <strong style="color: #0f172a;">{{ $reg->mobile ?: ($reg->phone ?: 'N/A') }}</strong>
                                </td>
                                <td>
                                    <span style="color: #475569;">{{ $reg->email ?: 'N/A' }}</span>
                                </td>
                                <td>
                                    <form action="{{ route('admin.halaqah.delete', $reg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration record for {{ addslashes($reg->name) }}?');">
                                        @csrf
                                        <button type="submit" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 0.8rem; cursor: pointer;">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align: center; padding: 40px; color: #64748b; font-weight: 600;">
                                    No registrations found matching the selected criteria.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($registrations->hasPages())
                <div style="padding: 20px;">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

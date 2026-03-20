<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:#f0f0f0;">
                Welcome back, {{ Auth::user()->name }}<span style="color:#c8ff00;">.</span>
            </h1>
            <p style="color:#888;font-size:13px;margin-top:2px;">Here's what's happening today.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;font-weight:700;font-size:13px;padding:9px 20px;border-radius:10px;text-decoration:none;transition:all .2s;">
            <i class="bi bi-plus-lg"></i>Add User
        </a>
    </x-slot>

    <style>
        .stat-card { background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:22px 24px;transition:border-color .2s,transform .2s; }
        .stat-card:hover { border-color:rgba(255,255,255,0.14);transform:translateY(-2px); }

        .stat-icon-yellow { width:36px;height:36px;border-radius:10px;background:rgba(200,255,0,0.08);display:flex;align-items:center;justify-content:center; }
        .stat-icon-green  { width:36px;height:36px;border-radius:10px;background:rgba(77,255,155,0.08);display:flex;align-items:center;justify-content:center; }
        .stat-icon-blue   { width:36px;height:36px;border-radius:10px;background:rgba(92,225,255,0.08);display:flex;align-items:center;justify-content:center; }
        .stat-icon-orange { width:36px;height:36px;border-radius:10px;background:rgba(255,217,102,0.08);display:flex;align-items:center;justify-content:center; }

        .stat-color-yellow { color:#c8ff00;font-size:16px; }
        .stat-color-green  { color:#4dff9b;font-size:16px; }
        .stat-color-blue   { color:#5ce1ff;font-size:16px; }
        .stat-color-orange { color:#ffd966;font-size:16px; }

        .status-green  { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }
        .status-yellow { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(255,217,102,0.1);color:#ffd966; }

        .role-badge-admin { font-size:11px;font-weight:600;padding:4px 10px;border-radius:100px;background:rgba(200,255,0,0.1);color:#c8ff00; }
        .role-badge-other { font-size:11px;font-weight:600;padding:4px 10px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }

        .tbl-row:hover td { background:rgba(255,255,255,0.02); }

        .action-view { width:30px;height:30px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid rgba(92,225,255,0.2);color:#5ce1ff;text-decoration:none;font-size:13px;transition:all .2s; }
        .action-edit { width:30px;height:30px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid rgba(255,217,102,0.2);color:#ffd966;text-decoration:none;font-size:13px;transition:all .2s; }

        .quick-icon-green  { width:52px;height:52px;border-radius:14px;background:rgba(200,255,0,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 16px; }
        .quick-icon-lime   { width:52px;height:52px;border-radius:14px;background:rgba(77,255,155,0.08);display:flex;align-items:center;justify-content:center;margin:0 auto 16px; }
        .icon-lime   { color:#c8ff00;font-size:22px; }
        .icon-green  { color:#4dff9b;font-size:22px; }
    </style>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px;">
        @php
            $stats = [
                ['label'=>'Total Users',   'value'=>\App\Models\User::count(),                                           'icon'=>'bi-people',      'iconClass'=>'stat-icon-yellow', 'colorClass'=>'stat-color-yellow'],
                ['label'=>'New This Week', 'value'=>\App\Models\User::where('created_at','>=',now()->subWeek())->count(), 'icon'=>'bi-person-plus', 'iconClass'=>'stat-icon-green',  'colorClass'=>'stat-color-green'],
                ['label'=>'Admins',        'value'=>\App\Models\User::where('role','admin')->count(),                     'icon'=>'bi-shield-lock', 'iconClass'=>'stat-icon-blue',   'colorClass'=>'stat-color-blue'],
                ['label'=>'Regular Users', 'value'=>\App\Models\User::where('role','user')->count(),                      'icon'=>'bi-person',      'iconClass'=>'stat-icon-orange', 'colorClass'=>'stat-color-orange'],
            ];
        @endphp
        @foreach($stats as $s)
        <div class="stat-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <span style="font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#555;">{{ $s['label'] }}</span>
                <div class="{{ $s['iconClass'] }}">
                    <i class="bi {{ $s['icon'] }} {{ $s['colorClass'] }}"></i>
                </div>
            </div>
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:36px;letter-spacing:-1.5px;color:#f0f0f0;line-height:1;">{{ $s['value'] }}</div>
        </div>
        @endforeach
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;margin-bottom:28px;">
        <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:24px;text-align:center;">
            <div class="quick-icon-green">
                <i class="bi bi-people icon-lime"></i>
            </div>
            <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:16px;color:#f0f0f0;margin-bottom:6px;">Manage Users</div>
            <p style="font-size:13px;color:#666;margin-bottom:18px;">View, edit and manage all users</p>
            <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:6px;background:rgba(200,255,0,0.1);color:#c8ff00;border:1px solid rgba(200,255,0,0.2);font-size:13px;font-weight:600;padding:8px 18px;border-radius:8px;text-decoration:none;">Go to Users <i class="bi bi-arrow-right"></i></a>
        </div>
        <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:24px;text-align:center;">
            <div class="quick-icon-lime">
                <i class="bi bi-person-plus icon-green"></i>
            </div>
            <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:16px;color:#f0f0f0;margin-bottom:6px;">Add New User</div>
            <p style="font-size:13px;color:#666;margin-bottom:18px;">Create a new user account</p>
            <a href="{{ route('admin.users.create') }}" style="display:inline-flex;align-items:center;gap:6px;background:rgba(77,255,155,0.1);color:#4dff9b;border:1px solid rgba(77,255,155,0.2);font-size:13px;font-weight:600;padding:8px 18px;border-radius:8px;text-decoration:none;">Create User <i class="bi bi-arrow-right"></i></a>
        </div>
        <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:24px;">
            <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:#f0f0f0;margin-bottom:18px;">System Status</div>
            @foreach([['Database','Operational',true],['Storage','Healthy',true],['Cache','Optimizing',false]] as $item)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.05);">
                <span style="font-size:13px;color:#888;">{{ $item[0] }}</span>
                <span class="{{ $item[2] ? 'status-green' : 'status-yellow' }}">{{ $item[1] }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
        <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:18px 24px;display:flex;align-items:center;justify-content:space-between;">
            <div>
                <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:#f0f0f0;">Recent Users</div>
                <div style="font-size:12px;color:#555;margin-top:2px;">Latest 5 users</div>
            </div>
            <a href="{{ route('admin.users.index') }}" style="font-size:12px;color:#c8ff00;text-decoration:none;font-weight:600;">View all <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    @foreach(['User','Email','Role','Joined','Actions'] as $h)
                    <th style="font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#444;padding:12px 20px;border-bottom:1px solid rgba(255,255,255,0.05);text-align:left;background:#141414;">{{ $h }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                @php $isAdmin = $user->role === 'admin'; @endphp
                <tr class="tbl-row">
                    <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                        <div style="display:flex;align-items:center;gap:12px;">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid rgba(200,255,0,0.3);">
                            @else
                                <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#c8ff00,rgba(200,255,0,0.3));display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#000;">{{ strtoupper(substr($user->name,0,2)) }}</div>
                            @endif
                            <div>
                                <div style="font-size:14px;font-weight:600;color:#f0f0f0;">{{ $user->name }}</div>
                                <div style="font-size:11px;color:#555;">#{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);font-size:13px;color:#777;">{{ $user->email }}</td>
                    <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                        <span class="{{ $isAdmin ? 'role-badge-admin' : 'role-badge-other' }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);font-size:13px;color:#555;">{{ $user->created_at->diffForHumans() }}</td>
                    <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.users.show', $user) }}" class="action-view" title="View"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="action-edit" title="Edit"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
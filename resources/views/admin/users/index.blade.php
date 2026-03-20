<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:#f0f0f0;">User Management</h1>
            <p style="color:#888;font-size:13px;margin-top:2px;">Manage all users in the system</p>
        </div>
        <a href="{{ route('admin.users.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;font-weight:700;font-size:13px;padding:9px 20px;border-radius:10px;text-decoration:none;">
            <i class="bi bi-plus-lg"></i>New User
        </a>
    </x-slot>

    <style>
        .role-badge-admin { font-size:11px;font-weight:600;padding:4px 10px;border-radius:100px;background:rgba(200,255,0,0.1);color:#c8ff00; }
        .role-badge-other { font-size:11px;font-weight:600;padding:4px 10px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }
        .tbl-row { transition:background .15s; }
        .tbl-row:hover td { background:rgba(255,255,255,0.02); }
        .action-view { width:30px;height:30px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid rgba(92,225,255,0.2);color:#5ce1ff;text-decoration:none;font-size:13px; }
        .action-edit { width:30px;height:30px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid rgba(255,217,102,0.2);color:#ffd966;text-decoration:none;font-size:13px; }
        .action-delete { width:30px;height:30px;display:inline-flex;align-items:center;justify-content:center;border-radius:8px;border:1px solid rgba(255,92,92,0.2);color:#ff5c5c;background:none;cursor:pointer;font-size:13px; }
    </style>

    @if(session('success'))
    <div style="background:rgba(77,255,155,0.07);border:1px solid rgba(77,255,155,0.2);color:#4dff9b;border-radius:12px;padding:14px 18px;font-size:14px;margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;">
        <span><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;color:#4dff9b;cursor:pointer;font-size:16px;">&times;</button>
    </div>
    @endif

    <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
        <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:18px 24px;">
            <form action="{{ route('admin.users.index') }}" method="GET" style="display:flex;gap:10px;max-width:400px;">
                <div style="flex:1;position:relative;">
                    <i class="bi bi-search" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#444;font-size:14px;pointer-events:none;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..."
                        style="width:100%;background:#0d0d0d;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:9px 14px 9px 38px;font-size:13px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;"
                        onfocus="this.style.borderColor='rgba(200,255,0,0.3)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.07)'">
                </div>
                <button type="submit" style="background:#c8ff00;color:#000;border:none;border-radius:10px;padding:9px 18px;font-size:13px;font-weight:700;font-family:'DM Sans',sans-serif;cursor:pointer;">Search</button>
            </form>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr>
                        @foreach(['Photo','Name','Email','Role','Age / Sex','Joined','Actions'] as $h)
                        <th style="font-size:11px;font-weight:600;letter-spacing:.08em;text-transform:uppercase;color:#444;padding:12px 20px;border-bottom:1px solid rgba(255,255,255,0.05);text-align:left;background:#141414;white-space:nowrap;">{{ $h }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    @php $isAdmin = $user->role === 'admin'; @endphp
                    <tr class="tbl-row">
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                            @if($user->profile_photo)
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width:38px;height:38px;border-radius:50%;object-fit:cover;border:2px solid rgba(200,255,0,0.25);">
                            @else
                                <div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#c8ff00,rgba(200,255,0,0.3));display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#000;">{{ strtoupper(substr($user->name,0,2)) }}</div>
                            @endif
                        </td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                            <div style="font-size:14px;font-weight:600;color:#f0f0f0;">{{ $user->name }}</div>
                            <div style="font-size:11px;color:#444;">#{{ $user->id }}</div>
                        </td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);font-size:13px;color:#777;">{{ $user->email }}</td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                            <span class="{{ $isAdmin ? 'role-badge-admin' : 'role-badge-other' }}">
                                <i class="bi {{ $isAdmin ? 'bi-shield-lock' : 'bi-person' }} me-1"></i>{{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);font-size:13px;color:#666;">
                            @if($user->age && $user->sex)
                                {{ $user->age }} / {{ ucfirst($user->sex) }}
                            @else
                                <span style="color:#444;">N/A</span>
                            @endif
                        </td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                            <div style="font-size:13px;color:#f0f0f0;">{{ $user->created_at->format('M d, Y') }}</div>
                            <div style="font-size:11px;color:#444;">{{ $user->created_at->diffForHumans() }}</div>
                        </td>
                        <td style="padding:14px 20px;border-bottom:1px solid rgba(255,255,255,0.04);">
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('admin.users.show', $user) }}" class="action-view" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="action-edit" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-delete" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding:60px;text-align:center;color:#444;">
                            <i class="bi bi-people" style="font-size:48px;display:block;margin-bottom:16px;"></i>
                            <div style="font-size:15px;font-weight:600;color:#666;margin-bottom:6px;">No users found</div>
                            <p style="font-size:13px;margin-bottom:20px;">Get started by creating a new user.</p>
                            <a href="{{ route('admin.users.create') }}" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;font-weight:700;font-size:13px;padding:9px 20px;border-radius:10px;text-decoration:none;"><i class="bi bi-plus-lg"></i>Create User</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="padding:18px 24px;border-top:1px solid rgba(255,255,255,0.05);display:flex;align-items:center;justify-content:space-between;background:#181818;">
            <span style="font-size:12px;color:#555;">Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() }} users</span>
            <div>{{ $users->links() }}</div>
        </div>
    </div>
</x-app-layout>
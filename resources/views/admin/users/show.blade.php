<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:#f0f0f0;">User Details</h1>
            <p style="color:#888;font-size:13px;margin-top:2px;">Viewing complete profile</p>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="{{ route('admin.users.edit', $user) }}" style="display:inline-flex;align-items:center;gap:8px;background:#ffd966;color:#000;font-size:13px;font-weight:700;padding:9px 18px;border-radius:10px;text-decoration:none;"><i class="bi bi-pencil"></i>Edit</a>
            <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.07);color:#f0f0f0;font-size:13px;font-weight:600;padding:9px 18px;border-radius:10px;text-decoration:none;border:1px solid rgba(255,255,255,0.07);"><i class="bi bi-arrow-left"></i>Back</a>
        </div>
    </x-slot>

    @php
        $isAdmin   = $user->role === 'admin';
        $isVerified = $user->email_verified_at !== null;
        $roleBadgeClass   = $isAdmin ? 'role-badge-admin' : 'role-badge-other';
        $roleIcon         = $isAdmin ? 'bi-shield-lock'   : 'bi-person';
        $statusBadgeClass = $isVerified ? 'status-badge-green' : 'status-badge-yellow';
    @endphp

    <style>
        .role-badge-admin  { font-size:11px;font-weight:600;padding:5px 14px;border-radius:100px;background:rgba(200,255,0,0.1);color:#c8ff00; }
        .role-badge-other  { font-size:11px;font-weight:600;padding:5px 14px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }
        .status-badge-green  { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }
        .status-badge-yellow { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(255,217,102,0.1);color:#ffd966; }
    </style>

    <div style="display:grid;grid-template-columns:280px 1fr;gap:20px;align-items:start;">

        <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:28px;text-align:center;">
                <div style="width:96px;height:96px;border-radius:50%;padding:3px;background:linear-gradient(135deg,#c8ff00,rgba(200,255,0,0.2));margin:0 auto 20px;">
                    <div style="width:100%;height:100%;border-radius:50%;overflow:hidden;background:#181818;display:flex;align-items:center;justify-content:center;border:2px solid #111;">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:28px;color:#f0f0f0;">{{ strtoupper(substr($user->name,0,2)) }}</span>
                        @endif
                    </div>
                </div>
                <h3 style="font-family:'Syne',sans-serif;font-weight:800;font-size:20px;letter-spacing:-.4px;color:#f0f0f0;margin-bottom:4px;">{{ $user->name }}</h3>
                <p style="font-size:13px;color:#555;margin-bottom:14px;">{{ $user->email }}</p>
                <span class="{{ $roleBadgeClass }}">
                    <i class="bi {{ $roleIcon }} me-1"></i>{{ ucfirst($user->role) }}
                </span>
                <div style="display:flex;gap:8px;justify-content:center;margin-top:20px;padding-top:20px;border-top:1px solid rgba(255,255,255,0.05);">
                    <a href="{{ route('admin.users.edit', $user) }}" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,217,102,0.1);color:#ffd966;border:1px solid rgba(255,217,102,0.2);font-size:12px;font-weight:600;padding:7px 14px;border-radius:8px;text-decoration:none;"><i class="bi bi-pencil"></i>Edit</a>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="display:inline-flex;align-items:center;gap:6px;background:rgba(255,92,92,0.1);color:#ff5c5c;border:1px solid rgba(255,92,92,0.2);font-size:12px;font-weight:600;padding:7px 14px;border-radius:8px;cursor:pointer;font-family:'DM Sans',sans-serif;"><i class="bi bi-trash"></i>Delete</button>
                    </form>
                </div>
            </div>

            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;padding:20px;">
                <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:13px;color:#f0f0f0;margin-bottom:16px;">Quick Stats</div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <span style="font-size:12px;color:#555;">User ID</span>
                    <span style="font-size:13px;font-weight:600;color:#f0f0f0;">#{{ $user->id }}</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <span style="font-size:12px;color:#555;">Status</span>
                    <span class="{{ $statusBadgeClass }}">{{ $isVerified ? 'Verified' : 'Unverified' }}</span>
                </div>
                <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 0;border-bottom:1px solid rgba(255,255,255,0.04);">
                    <span style="font-size:12px;color:#555;">Account Age</span>
                    <span style="font-size:13px;font-weight:600;color:#f0f0f0;">{{ $user->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
                <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:16px 24px;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-person-circle" style="color:#c8ff00;"></i>
                    <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:14px;color:#f0f0f0;margin:0;">Personal Information</h5>
                </div>
                <div style="padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:44px;height:44px;border-radius:12px;background:rgba(200,255,0,0.06);border:1px solid rgba(200,255,0,0.1);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">🎂</div>
                        <div>
                            <div style="font-size:11px;color:#555;margin-bottom:2px;">Age</div>
                            <div style="font-size:16px;font-weight:600;color:#f0f0f0;">{{ $user->age ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:14px;">
                        <div style="width:44px;height:44px;border-radius:12px;background:rgba(200,255,0,0.06);border:1px solid rgba(200,255,0,0.1);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">⚥</div>
                        <div>
                            <div style="font-size:11px;color:#555;margin-bottom:2px;">Sex</div>
                            <div style="font-size:16px;font-weight:600;color:#f0f0f0;">{{ ucfirst($user->sex ?? 'N/A') }}</div>
                        </div>
                    </div>
                    <div style="grid-column:1/-1;display:flex;align-items:flex-start;gap:14px;">
                        <div style="width:44px;height:44px;border-radius:12px;background:rgba(200,255,0,0.06);border:1px solid rgba(200,255,0,0.1);display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">📍</div>
                        <div>
                            <div style="font-size:11px;color:#555;margin-bottom:2px;">Address</div>
                            <div style="font-size:14px;font-weight:500;color:#f0f0f0;">{{ $user->address ?? 'No address provided' }}</div>
                        </div>
                    </div>
                    @if($user->motto)
                    <div style="grid-column:1/-1;background:#181818;border:1px solid rgba(255,255,255,0.05);border-radius:12px;padding:18px 20px;border-left:3px solid #c8ff00;">
                        <div style="font-size:11px;color:#555;margin-bottom:6px;">Motto</div>
                        <div style="font-size:14px;font-style:italic;color:#aaa;line-height:1.6;">"{{ $user->motto }}"</div>
                    </div>
                    @endif
                </div>
            </div>

            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
                <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:16px 24px;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-shield-check" style="color:#5ce1ff;"></i>
                    <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:14px;color:#f0f0f0;margin:0;">Account Information</h5>
                </div>
                <div style="padding:24px;display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                    <div style="padding-left:14px;border-left:2px solid #c8ff00;">
                        <div style="font-size:11px;color:#555;margin-bottom:3px;">Member since</div>
                        <div style="font-size:14px;font-weight:600;color:#f0f0f0;">{{ $user->created_at->format('F d, Y') }}</div>
                        <div style="font-size:11px;color:#444;">{{ $user->created_at->format('h:i A') }}</div>
                    </div>
                    <div style="padding-left:14px;border-left:2px solid #5ce1ff;">
                        <div style="font-size:11px;color:#555;margin-bottom:3px;">Last updated</div>
                        <div style="font-size:14px;font-weight:600;color:#f0f0f0;">{{ $user->updated_at->format('F d, Y') }}</div>
                        <div style="font-size:11px;color:#444;">{{ $user->updated_at->format('h:i A') }}</div>
                    </div>
                    <div style="padding-left:14px;border-left:2px solid #4dff9b;">
                        <div style="font-size:11px;color:#555;margin-bottom:3px;">Email verification</div>
                        @if($user->email_verified_at)
                            <span style="font-size:12px;font-weight:600;color:#4dff9b;">✓ Verified</span>
                            <div style="font-size:11px;color:#444;margin-top:2px;">{{ $user->email_verified_at->format('M d, Y') }}</div>
                        @else
                            <span style="font-size:12px;font-weight:600;color:#ffd966;">⚠ Not Verified</span>
                        @endif
                    </div>
                    <div style="padding-left:14px;border-left:2px solid #555;">
                        <div style="font-size:11px;color:#555;margin-bottom:3px;">Last login</div>
                        <div style="font-size:14px;font-weight:600;color:#f0f0f0;">{{ $user->last_login_at ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
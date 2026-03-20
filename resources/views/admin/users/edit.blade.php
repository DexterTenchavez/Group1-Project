<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:#f0f0f0;">Edit User</h1>
            <p style="color:#888;font-size:13px;margin-top:2px;">{{ $user->name }}</p>
        </div>
        <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.07);color:#f0f0f0;font-size:13px;font-weight:600;padding:9px 18px;border-radius:10px;text-decoration:none;border:1px solid rgba(255,255,255,0.07);">
            <i class="bi bi-arrow-left"></i>Back
        </a>
    </x-slot>

    <style>
        .form-lbl { display:block;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#666;margin-bottom:8px; }
        .form-inp { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s; }
        .form-inp:focus { border-color:rgba(200,255,0,0.4); }
        .form-inp-file { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:8px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none; }
        .form-inp-ta { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;resize:vertical; }
        .form-inp-ta:focus { border-color:rgba(200,255,0,0.4); }
        .form-err  { font-size:12px;color:#ff5c5c;margin-top:6px; }
        .form-hint { font-size:11px;color:#444;margin-top:5px; }
        .badge-verified   { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(77,255,155,0.1);color:#4dff9b; }
        .badge-unverified { font-size:11px;font-weight:600;padding:3px 10px;border-radius:100px;background:rgba(255,217,102,0.1);color:#ffd966; }
    </style>

    @if(session('error'))
    <div style="background:rgba(255,92,92,0.07);border:1px solid rgba(255,92,92,0.2);color:#ff5c5c;border-radius:12px;padding:14px 18px;font-size:14px;margin-bottom:20px;display:flex;justify-content:space-between;">
        <span><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</span>
        <button onclick="this.parentElement.remove()" style="background:none;border:none;color:#ff5c5c;cursor:pointer;">&times;</button>
    </div>
    @endif

    <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

        <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
            <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:18px 24px;">
                <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:#f0f0f0;margin:0;">Edit Information</h5>
            </div>
            <div style="padding:28px;">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                        <div>
                            <label class="form-lbl">Full Name <span style="color:#ff5c5c;">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="form-inp">
                            @error('name')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-lbl">Email Address <span style="color:#ff5c5c;">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="form-inp">
                            @error('email')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-lbl">New Password <span style="font-style:italic;text-transform:none;letter-spacing:0;color:#555;">leave blank to keep</span></label>
                            <input type="password" name="password" class="form-inp">
                            @error('password')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-lbl">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-inp">
                        </div>

                        <div>
                            <label class="form-lbl">Role <span style="color:#ff5c5c;">*</span></label>
                            <select name="role" required class="form-inp">
                                <option value="user"   {{ old('role', $user->role) == 'user'   ? 'selected' : '' }}>User</option>
                                <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="admin"  {{ old('role', $user->role) == 'admin'  ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-lbl">Age</label>
                            <input type="number" name="age" value="{{ old('age', $user->age) }}" min="1" max="150" class="form-inp">
                        </div>

                        <div>
                            <label class="form-lbl">Sex</label>
                            <select name="sex" class="form-inp">
                                <option value="">Select Sex</option>
                                <option value="male"   {{ old('sex', $user->sex) == 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other"  {{ old('sex', $user->sex) == 'other'  ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="form-lbl">Address</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-inp">
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="form-lbl">Motto / Tagline</label>
                            <textarea name="motto" rows="2" class="form-inp-ta">{{ old('motto', $user->motto) }}</textarea>
                        </div>

                        <div style="grid-column:1/-1;">
                            <label class="form-lbl">New Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="form-inp-file">
                            <div class="form-hint">JPEG, PNG, JPG, GIF — Max 2MB</div>
                            @error('profile_photo')<div class="form-err">{{ $message }}</div>@enderror
                            <div id="imgPreview" style="display:none;margin-top:16px;">
                                <div style="font-size:12px;color:#666;margin-bottom:8px;">New Photo Preview</div>
                                <img src="" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid rgba(200,255,0,0.3);">
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:28px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:#181818;color:#888;border:1px solid rgba(255,255,255,0.07);font-size:13px;font-weight:600;padding:10px 20px;border-radius:10px;text-decoration:none;"><i class="bi bi-x"></i>Cancel</a>
                        <button type="submit" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;border:none;font-size:13px;font-weight:700;padding:10px 24px;border-radius:10px;cursor:pointer;font-family:'DM Sans',sans-serif;"><i class="bi bi-check-lg"></i>Update User</button>
                    </div>
                </form>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
                <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:14px 20px;">
                    <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:13px;color:#f0f0f0;margin:0;">Current Photo</h5>
                </div>
                <div style="padding:24px;text-align:center;">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" style="width:100px;height:100px;border-radius:50%;object-fit:cover;border:3px solid rgba(200,255,0,0.3);margin-bottom:10px;">
                    @else
                        <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#c8ff00,rgba(200,255,0,0.2));display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:700;font-size:28px;color:#000;margin:0 auto 10px;">{{ strtoupper(substr($user->name,0,2)) }}</div>
                    @endif
                    <div style="font-size:12px;color:#555;">Upload a new photo to replace</div>
                </div>
            </div>

            <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
                <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:14px 20px;">
                    <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:13px;color:#f0f0f0;margin:0;">Account Info</h5>
                </div>
                <div style="padding:20px;display:flex;flex-direction:column;gap:16px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:34px;height:34px;border-radius:10px;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-calendar-check" style="color:#c8ff00;font-size:14px;"></i>
                        </div>
                        <div>
                            <div style="font-size:11px;color:#555;">Member since</div>
                            <div style="font-size:13px;font-weight:600;color:#f0f0f0;">{{ $user->created_at->format('M d, Y') }}</div>
                            <div style="font-size:11px;color:#444;">{{ $user->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:34px;height:34px;border-radius:10px;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-clock-history" style="color:#5ce1ff;font-size:14px;"></i>
                        </div>
                        <div>
                            <div style="font-size:11px;color:#555;">Last updated</div>
                            <div style="font-size:13px;font-weight:600;color:#f0f0f0;">{{ $user->updated_at->format('M d, Y') }}</div>
                            <div style="font-size:11px;color:#444;">{{ $user->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:34px;height:34px;border-radius:10px;background:rgba(255,255,255,0.04);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="bi bi-envelope-check" style="color:#4dff9b;font-size:14px;"></i>
                        </div>
                        <div>
                            <div style="font-size:11px;color:#555;">Email verification</div>
                            @if($user->email_verified_at)
                                <span class="badge-verified">Verified</span>
                            @else
                                <span class="badge-unverified">Not Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
    <script>
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('imgPreview');
            if (file) {
                const reader = new FileReader();
                reader.onload = e => { preview.querySelector('img').src = e.target.result; preview.style.display = 'block'; };
                reader.readAsDataURL(file);
            } else { preview.style.display = 'none'; }
        });
    </script>
    @endpush
</x-app-layout>
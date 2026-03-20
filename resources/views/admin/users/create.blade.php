<x-app-layout>
    <x-slot name="header">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;letter-spacing:-.4px;color:#f0f0f0;">Create New User</h1>
            <p style="color:#888;font-size:13px;margin-top:2px;">Add a new user to the system</p>
        </div>
        <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,0.07);color:#f0f0f0;font-size:13px;font-weight:600;padding:9px 18px;border-radius:10px;text-decoration:none;border:1px solid rgba(255,255,255,0.07);">
            <i class="bi bi-arrow-left"></i>Back
        </a>
    </x-slot>

    <style>
        .form-field { margin-bottom: 0; }
        .form-lbl { display:block;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:#666;margin-bottom:8px; }
        .form-inp { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s; }
        .form-inp:focus { border-color:rgba(200,255,0,0.4); }
        .form-inp.has-error { border-color:#ff5c5c; }
        .form-inp-file { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:8px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none; }
        .form-inp-ta { width:100%;background:#181818;border:1px solid rgba(255,255,255,0.07);color:#f0f0f0;border-radius:10px;padding:10px 14px;font-size:14px;font-family:'DM Sans',sans-serif;outline:none;transition:border-color .2s;resize:vertical; }
        .form-inp-ta:focus { border-color:rgba(200,255,0,0.4); }
        .form-err { font-size:12px;color:#ff5c5c;margin-top:6px; }
        .form-hint { font-size:11px;color:#444;margin-top:5px; }
    </style>

    <div style="max-width:800px;">
        <div style="background:#111;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;">
            <div style="background:#181818;border-bottom:1px solid rgba(255,255,255,0.07);padding:18px 24px;">
                <h5 style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;color:#f0f0f0;margin:0;">User Information</h5>
            </div>
            <div style="padding:28px;">
                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

                        <div class="form-field">
                            <label class="form-lbl">Full Name <span style="color:#ff5c5c;">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="form-inp {{ $errors->has('name') ? 'has-error' : '' }}">
                            @error('name')<div class="form-err"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Email Address <span style="color:#ff5c5c;">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="form-inp {{ $errors->has('email') ? 'has-error' : '' }}">
                            @error('email')<div class="form-err"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Password <span style="color:#ff5c5c;">*</span></label>
                            <input type="password" name="password" required
                                class="form-inp {{ $errors->has('password') ? 'has-error' : '' }}">
                            <div class="form-hint">Minimum 8 characters</div>
                            @error('password')<div class="form-err"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Confirm Password <span style="color:#ff5c5c;">*</span></label>
                            <input type="password" name="password_confirmation" required class="form-inp">
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Role <span style="color:#ff5c5c;">*</span></label>
                            <select name="role" required class="form-inp">
                                <option value="user"   {{ old('role') == 'user'   ? 'selected' : '' }}>User</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="admin"  {{ old('role') == 'admin'  ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Age</label>
                            <input type="number" name="age" value="{{ old('age') }}" min="1" max="150" class="form-inp">
                            @error('age')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field">
                            <label class="form-lbl">Sex</label>
                            <select name="sex" class="form-inp">
                                <option value="">Select Sex</option>
                                <option value="male"   {{ old('sex') == 'male'   ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other"  {{ old('sex') == 'other'  ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-field" style="grid-column:1/-1;">
                            <label class="form-lbl">Address</label>
                            <input type="text" name="address" value="{{ old('address') }}" class="form-inp">
                            @error('address')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field" style="grid-column:1/-1;">
                            <label class="form-lbl">Motto / Tagline</label>
                            <textarea name="motto" rows="2" class="form-inp-ta">{{ old('motto') }}</textarea>
                            @error('motto')<div class="form-err">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-field" style="grid-column:1/-1;">
                            <label class="form-lbl">Profile Photo</label>
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="form-inp-file">
                            <div class="form-hint">JPEG, PNG, JPG, GIF — Max 2MB</div>
                            @error('profile_photo')<div class="form-err">{{ $message }}</div>@enderror
                            <div id="imgPreview" style="display:none;margin-top:16px;">
                                <div style="font-size:12px;color:#666;margin-bottom:8px;">Preview</div>
                                <img src="" style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid rgba(200,255,0,0.3);">
                            </div>
                        </div>

                    </div>

                    <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:28px;padding-top:24px;border-top:1px solid rgba(255,255,255,0.05);">
                        <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:#181818;color:#888;border:1px solid rgba(255,255,255,0.07);font-size:13px;font-weight:600;padding:10px 20px;border-radius:10px;text-decoration:none;"><i class="bi bi-x"></i>Cancel</a>
                        <button type="submit" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;border:none;font-size:13px;font-weight:700;padding:10px 24px;border-radius:10px;cursor:pointer;font-family:'DM Sans',sans-serif;"><i class="bi bi-check-lg"></i>Create User</button>
                    </div>
                </form>
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
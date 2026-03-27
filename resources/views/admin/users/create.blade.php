<x-app-layout>
    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 50px; margin-bottom: 32px; background: #0a0a0a; padding: 20px 24px; border-radius: 16px; border: 1px solid rgba(255,255,255,0.07);">
        <div>
            <h1 style="font-family:'Syne',sans-serif;font-weight:800;font-size:24px;letter-spacing:-0.5px;color:#ffffff;margin:0 0 6px 0;">Create New User</h1>
            <p style="color:#888;font-size:14px;margin:0;">Add a new user to the system</p>
        </div>
        <a href="{{ route('admin.users.index') }}" style="display:inline-flex;align-items:center;gap:8px;background:#c8ff00;color:#000;font-size:13px;font-weight:700;padding:10px 20px;border-radius:10px;text-decoration:none;transition:all 0.2s;">
            <i class="bi bi-arrow-left"></i>Back to Users
        </a>
    </div>

    <style>
        .form-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            overflow: hidden;
        }
        .form-header {
            background: #181818;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 18px 24px;
        }
        .form-header h5 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 15px;
            color: #f0f0f0;
            margin: 0;
        }
        .form-body {
            padding: 28px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .field-full {
            grid-column: 1 / -1;
        }
        .field-group {
            margin-bottom: 0;
        }
        .field-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #aaa;
            margin-bottom: 6px;
        }
        .field-label span {
            color: #ff5c5c;
        }
        .field-input {
            width: 100%;
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.1);
            color: #f0f0f0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: all 0.2s;
        }
        .field-input:focus {
            border-color: #c8ff00;
            box-shadow: 0 0 0 2px rgba(200,255,0,0.1);
        }
        .field-input.has-error {
            border-color: #ff5c5c;
        }
        select.field-input {
            cursor: pointer;
        }
        textarea.field-input {
            resize: vertical;
            min-height: 80px;
        }
        input[type="file"].field-input {
            padding: 8px 12px;
        }
        .field-error {
            font-size: 11px;
            color: #ff5c5c;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .field-hint {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }
        .preview-container {
            margin-top: 12px;
            padding: 12px;
            background: #0a0a0a;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .preview-label {
            font-size: 11px;
            color: #888;
            margin-bottom: 8px;
        }
        .preview-image {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #c8ff00;
        }
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.05);
        }
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: #aaa;
            border: 1px solid rgba(255,255,255,0.15);
            font-size: 13px;
            font-weight: 500;
            padding: 9px 20px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }
        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #c8ff00;
            color: #000;
            border: none;
            font-size: 13px;
            font-weight: 700;
            padding: 9px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .btn-submit:hover {
            background: #d4ff26;
            transform: translateY(-1px);
        }
        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .form-body {
                padding: 20px;
            }
            div[style*="display: flex"] {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
        }
    </style>

    <div class="form-card">
        <div class="form-header">
            <h5><i class="bi bi-person-plus" style="margin-right: 8px;"></i>User Information</h5>
        </div>
        <div class="form-body">
            <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label">Full Name <span>*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="field-input {{ $errors->has('name') ? 'has-error' : '' }}" placeholder="Enter full name">
                        @error('name')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Email Address <span>*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="field-input {{ $errors->has('email') ? 'has-error' : '' }}" placeholder="user@example.com">
                        @error('email')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Password <span>*</span></label>
                        <input type="password" name="password" required class="field-input {{ $errors->has('password') ? 'has-error' : '' }}" placeholder="••••••••">
                        <div class="field-hint">Minimum 8 characters</div>
                        @error('password')<div class="field-error"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Confirm Password <span>*</span></label>
                        <input type="password" name="password_confirmation" required class="field-input" placeholder="••••••••">
                    </div>

                    <div class="field-group">
                        <label class="field-label">Role <span>*</span></label>
                        <select name="role" required class="field-input">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                            <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Age</label>
                        <input type="number" name="age" value="{{ old('age') }}" min="1" max="150" class="field-input" placeholder="Enter age">
                        @error('age')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Sex</label>
                        <select name="sex" class="field-input">
                            <option value="">Select sex</option>
                            <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="field-group field-full">
                        <label class="field-label">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" class="field-input" placeholder="Enter address">
                        @error('address')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group field-full">
                        <label class="field-label">Motto / Tagline</label>
                        <textarea name="motto" rows="3" class="field-input" placeholder="Enter a personal motto...">{{ old('motto') }}</textarea>
                        @error('motto')<div class="field-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="field-group field-full">
                        <label class="field-label">Profile Photo</label>
                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="field-input">
                        <div class="field-hint">JPEG, PNG, JPG, GIF — Max 2MB</div>
                        @error('profile_photo')<div class="field-error">{{ $message }}</div>@enderror
                        <div id="imgPreview" style="display:none;" class="preview-container">
                            <div class="preview-label">Preview</div>
                            <img src="" class="preview-image">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                        <i class="bi bi-x-lg"></i>Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-check-lg"></i>Create User
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        const photoInput = document.getElementById('profile_photo');
        const previewDiv = document.getElementById('imgPreview');
        
        if (photoInput) {
            photoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewDiv.querySelector('img').src = e.target.result;
                        previewDiv.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewDiv.style.display = 'none';
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
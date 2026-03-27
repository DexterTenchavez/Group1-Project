<x-app-layout>
    <style>
        .edit-header {
            background: linear-gradient(135deg, #0a0a0a 0%, #111 100%);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 28px;
        }
        .edit-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            overflow: hidden;
            margin-top: 50px;
        }
        .edit-card-header {
            background: #181818;
            border-bottom: 1px solid rgba(255,255,255,0.07);
            padding: 18px 24px;
        }
        .edit-card-header h5 {
            font-family: 'Syne', sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: #f0f0f0;
            margin: 0;
        }
        .edit-card-body {
            padding: 28px;
        }
        .avatar-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #c8ff00;
            transition: all 0.3s ease;
        }
        .avatar-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c8ff00, #a0cc00);
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 48px;
            margin: 0 auto;
            border: 3px solid #c8ff00;
            transition: all 0.3s ease;
        }
        .avatar-wrapper:hover .avatar-preview,
        .avatar-wrapper:hover .avatar-placeholder {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(200,255,0,0.3);
        }
        .camera-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #c8ff00;
            color: #000;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .camera-btn:hover {
            transform: scale(1.1);
            background: #d4ff26;
        }
        .form-label-custom {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #888;
            margin-bottom: 8px;
        }
        .form-control-custom {
            width: 100%;
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.1);
            color: #f0f0f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            border-color: #c8ff00;
            box-shadow: 0 0 0 3px rgba(200,255,0,0.08);
        }
        .form-control-custom.is-invalid {
            border-color: #ff5c5c;
        }
        .invalid-feedback-custom {
            font-size: 11px;
            color: #ff5c5c;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .form-hint {
            font-size: 11px;
            color: #555;
            margin-top: 6px;
        }
        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            color: #888;
            border: 1px solid rgba(255,255,255,0.15);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-cancel:hover {
            background: rgba(255,255,255,0.05);
            color: #f0f0f0;
        }
        .btn-update {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #c8ff00;
            color: #000;
            border: none;
            font-size: 13px;
            font-weight: 700;
            padding: 10px 28px;
            border-radius: 12px;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .btn-update:hover {
            background: #d4ff26;
            transform: translateY(-1px);
        }
        .alert-success-custom {
            background: rgba(200,255,0,0.1);
            border: 1px solid rgba(200,255,0,0.3);
            color: #c8ff00;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        @media (max-width: 640px) {
            .edit-card-body {
                padding: 20px;
            }
            .avatar-preview, .avatar-placeholder {
                width: 120px;
                height: 120px;
                font-size: 38px;
            }
            .camera-btn {
                width: 35px;
                height: 35px;
            }
        }
    </style>

    <div class="container py-4">
       

        @if(session('status') === 'profile-updated')
            <div class="alert-success-custom">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>Profile updated successfully!</span>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert" style="font-size: 12px;"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="edit-card">
                    <div class="edit-card-header">
                        <h5>
                            <i class="bi bi-person-gear me-2" style="color:#c8ff00;"></i>
                            Edit Your Information
                        </h5>
                    </div>
                    <div class="edit-card-body">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div class="text-center mb-5">
                                <div class="avatar-wrapper" onclick="document.getElementById('profile_photo').click()">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                             id="profilePhotoPreview"
                                             alt="{{ $user->name }}" 
                                             class="avatar-preview">
                                    @else
                                        <div id="profilePhotoPreview" class="avatar-placeholder">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="camera-btn">
                                        <i class="bi bi-camera-fill"></i>
                                    </div>
                                </div>
                                <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*">
                                <div class="form-hint mt-3">Click the photo to change image (JPEG, PNG, JPG — Max 2MB)</div>
                                @error('profile_photo')
                                    <div class="invalid-feedback-custom justify-content-center">
                                        <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Full Name <span style="color:#ff5c5c;">*</span></label>
                                    <input type="text" class="form-control-custom @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email Address <span style="color:#ff5c5c;">*</span></label>
                                    <input type="email" class="form-control-custom @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Age</label>
                                    <input type="number" class="form-control-custom @error('age') is-invalid @enderror" 
                                           id="age" name="age" value="{{ old('age', $user->age) }}" placeholder="Enter age">
                                    @error('age')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Sex</label>
                                    <select class="form-control-custom @error('sex') is-invalid @enderror" id="sex" name="sex">
                                        <option value="">Select sex</option>
                                        <option value="male" {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>♂ Male</option>
                                        <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>♀ Female</option>
                                        <option value="other" {{ old('sex', $user->sex) == 'other' ? 'selected' : '' }}>⚧ Other</option>
                                    </select>
                                    @error('sex')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Address</label>
                                    <input type="text" class="form-control-custom @error('address') is-invalid @enderror" 
                                           id="address" name="address" value="{{ old('address', $user->address) }}" placeholder="Enter your address">
                                    @error('address')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Motto / Quote</label>
                                    <textarea class="form-control-custom @error('motto') is-invalid @enderror" 
                                              id="motto" name="motto" rows="3" placeholder="Your favorite quote or motto...">{{ old('motto', $user->motto) }}</textarea>
                                    @error('motto')
                                        <div class="invalid-feedback-custom"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between gap-3 mt-5 pt-3">
                                <a href="{{ route('user.dashboard') }}" class="btn-cancel">
                                    <i class="bi bi-x-lg"></i>Cancel
                                </a>
                                <button type="submit" class="btn-update">
                                    <i class="bi bi-check-lg"></i>Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('profilePhotoPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.id = 'profilePhotoPreview';
                        img.className = 'avatar-preview';
                        img.src = e.target.result;
                        preview.parentNode.replaceChild(img, preview);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
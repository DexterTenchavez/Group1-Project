{{-- resources/views/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-white">Edit Profile</h1>
                <p class="text-white-50 mb-0">Update your personal information</p>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if(session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Profile updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-person-gear text-primary me-2"></i>
                                Edit Your Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')

                                <div class="text-center mb-4">
                                    <div class="position-relative d-inline-block">
                                        @if($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" 
                                                 id="profilePhotoPreview"
                                                 alt="{{ $user->name }}" 
                                                 class="rounded-circle img-fluid mb-3" 
                                                 style="width: 150px; height: 150px; object-fit: cover;">
                                        @else
                                            <div id="profilePhotoPreview" 
                                                 class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                                 style="width: 150px; height: 150px; font-size: 4rem;">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                        @endif
                                        <label for="profile_photo" class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle" style="transform: translate(10%, -10%);">
                                            <i class="bi bi-camera-fill"></i>
                                        </label>
                                    </div>
                                    <input type="file" id="profile_photo" name="profile_photo" class="d-none" accept="image/*">
                                    <small class="text-muted d-block mt-2">Click the camera icon to change photo (max 2MB)</small>
                                    @error('profile_photo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="age" class="form-label">Age</label>
                                        <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                               id="age" name="age" value="{{ old('age', $user->age) }}">
                                        @error('age')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="sex" class="form-label">Sex</label>
                                        <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex">
                                            <option value="">Select sex</option>
                                            <option value="male" {{ old('sex', $user->sex) == 'male' ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ old('sex', $user->sex) == 'female' ? 'selected' : '' }}>Female</option>
                                            <option value="other" {{ old('sex', $user->sex) == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('sex')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="2">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="motto" class="form-label">Motto / Quote</label>
                                    <textarea class="form-control @error('motto') is-invalid @enderror" 
                                              id="motto" name="motto" rows="2" placeholder="Your favorite quote or motto...">{{ old('motto', $user->motto) }}</textarea>
                                    @error('motto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between gap-2">
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                                        <i class="bi bi-arrow-left me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        #profilePhotoPreview {
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        #profilePhotoPreview:hover {
            transform: scale(1.05);
        }
        
        label[for="profile_photo"] {
            transition: all 0.3s ease;
        }
        
        label[for="profile_photo"]:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        document.getElementById('profile_photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('profilePhotoPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = e.target.result;
                    } else {
                        const img = document.createElement('img');
                        img.id = 'profilePhotoPreview';
                        img.className = 'rounded-circle img-fluid mb-3';
                        img.style.width = '150px';
                        img.style.height = '150px';
                        img.style.objectFit = 'cover';
                        img.src = e.target.result;
                        preview.parentNode.replaceChild(img, preview);
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-0 text-white">Welcome to G1 Group</h1>
                <p class="text-white-50 mb-0">G1 - 2nd Semester (2023-24)</p>
            </div>
            <div>
                <span class="badge bg-light text-primary px-3 py-2">
                    <i class="bi bi-person me-1"></i>{{ Auth::user()->name }}
                </span>
                <span class="badge bg-success ms-2 px-3 py-2">
                    <i class="bi bi-star me-1"></i>{{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card shadow h-100">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-person-badge text-primary me-2"></i>
                                Your Profile
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="rounded-circle img-fluid mb-3" 
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                @else
                                    <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 120px; height: 120px; font-size: 3rem;">
                                        {{ substr(Auth::user()->name, 0, 2) }}
                                    </div>
                                @endif
                                <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                                <span class="badge bg-primary mt-2">{{ ucfirst(Auth::user()->role) }}</span>
                            </div>

                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Member Since:</span>
                                    <span class="fw-semibold">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                                </div>
                                @if(Auth::user()->age)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Age:</span>
                                    <span class="fw-semibold">{{ Auth::user()->age }} years</span>
                                </div>
                                @endif
                                @if(Auth::user()->sex)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Sex:</span>
                                    <span class="fw-semibold">{{ ucfirst(Auth::user()->sex) }}</span>
                                </div>
                                @endif
                                @if(Auth::user()->address)
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Address:</span>
                                    <span class="fw-semibold">{{ Auth::user()->address }}</span>
                                </div>
                                @endif
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">Status:</span>
                                    <span class="badge bg-success">Active</span>
                                </div>
                                @if(Auth::user()->motto)
                                <div class="mt-3 p-3 bg-light rounded">
                                    <p class="text-muted mb-1"><i class="bi bi-quote me-2"></i>Motto:</p>
                                    <p class="fst-italic mb-0">"{{ Auth::user()->motto }}"</p>
                                </div>
                                @endif
                            </div>

                            <div class="d-grid mt-4">
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                                    <i class="bi bi-pencil me-2"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-semibold">
                                    <i class="bi bi-people-fill text-primary me-2"></i>
                                    Group Members
                                </h5>
                                <span class="badge bg-primary">{{ count($members) }} Members</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="members-list" style="max-height: 500px; overflow-y: auto;">
                                @forelse($members as $member)
                                <div class="member-card d-flex align-items-center p-3 mb-3 rounded shadow-sm border">
                                    @if($member->profile_photo)
                                        <img src="{{ asset('storage/' . $member->profile_photo) }}" 
                                             alt="{{ $member->name }}" 
                                             class="rounded-circle" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-gradient-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="mb-0 fw-semibold">{{ $member->name }}</h6>
                                        <p class="text-muted mb-0 small">{{ $member->email }}</p>
                                        @if($member->motto)
                                        <p class="text-muted mb-0 small fst-italic">"{{ $member->motto }}"</p>
                                        @endif
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success">Member</span>
                                        @if($member->age)
                                        <span class="badge bg-secondary d-block mt-1">{{ $member->age }} yrs</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-people display-1 text-muted"></i>
                                    <h5 class="mt-3">No members found</h5>
                                    <p class="text-muted">Members will appear here once added.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card shadow-sm border-start border-primary border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="bi bi-people text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Total Members</h6>
                                    <h3 class="mb-0 fw-bold">{{ count($members) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-start border-success border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="bi bi-calendar-check text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Days Active</h6>
                                    <h3 class="mb-0 fw-bold">127</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm border-start border-info border-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="bi bi-chat-dots text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted mb-1">Group Posts</h6>
                                    <h3 class="mb-0 fw-bold">43</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-semibold">
                                <i class="bi bi-clock-history text-primary me-2"></i>
                                Recent Activity
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="d-flex mb-4">
                                    <div class="flex-shrink-0">
                                        <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                            <i class="bi bi-person-check text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-1">
                                            <span class="fw-semibold">You joined G1 Group</span>
                                        </p>
                                        <small class="text-muted">{{ Auth::user()->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                @if(Auth::user()->updated_at != Auth::user()->created_at)
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                            <i class="bi bi-pencil-square text-success"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-1">
                                            <span class="fw-semibold">Profile last updated</span>
                                        </p>
                                        <small class="text-muted">{{ Auth::user()->updated_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                @endif
                            </div>
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
        
        .timeline {
            position: relative;
            padding-left: 1.5rem;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        
        .timeline .d-flex {
            position: relative;
        }
        
        .timeline .d-flex::before {
            content: '';
            position: absolute;
            left: -1.5rem;
            top: 0.5rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #667eea;
            border: 2px solid white;
        }
        
        .member-card {
            transition: all 0.3s ease;
        }
        
        .member-card:hover {
            transform: translateX(5px);
            background-color: #f8f9fc;
            border-color: #667eea !important;
        }
        
        .members-list::-webkit-scrollbar {
            width: 6px;
        }
        
        .members-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .members-list::-webkit-scrollbar-thumb {
            background: #667eea;
            border-radius: 10px;
        }
    </style>
</x-app-layout>
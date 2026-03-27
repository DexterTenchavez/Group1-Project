<x-app-layout>
    <style>
        .dashboard-header {
            background: linear-gradient(135deg, #0a0a0a 0%, #111 100%);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            padding: 24px 28px;
            margin-bottom: 28px;
            margin-top: 30px;
        }
        .stat-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: #c8ff00;
            transform: translateY(-3px);
        }
        .profile-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            overflow: hidden;
        }
        .member-card {
            background: #111;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 14px;
            padding: 16px;
            transition: all 0.3s ease;
        }
        .member-card:hover {
            border-color: #c8ff00;
            transform: translateX(5px);
            background: #181818;
        }
        .badge-custom {
            background: #c8ff00;
            color: #000;
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-role {
            background: rgba(200,255,0,0.15);
            color: #c8ff00;
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 11px;
            font-weight: 600;
        }
        .timeline-item {
            position: relative;
            padding-left: 32px;
            margin-bottom: 24px;
        }
        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(200,255,0,0.1);
            color: #c8ff00;
        }
        .timeline-line {
            position: absolute;
            left: 13px;
            top: 28px;
            bottom: -24px;
            width: 2px;
            background: rgba(255,255,255,0.07);
        }
        .timeline-item:last-child .timeline-line {
            display: none;
        }
        .members-list {
            max-height: 500px;
            overflow-y: auto;
            padding-right: 8px;
        }
        .members-list::-webkit-scrollbar {
            width: 4px;
        }
        .members-list::-webkit-scrollbar-track {
            background: #1a1a1a;
            border-radius: 10px;
        }
        .members-list::-webkit-scrollbar-thumb {
            background: #c8ff00;
            border-radius: 10px;
        }
        .avatar-initials {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c8ff00, #a0cc00);
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
        }
        .avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #c8ff00;
        }
        .avatar-initials-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c8ff00, #a0cc00);
            color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 48px;
            margin: 0 auto;
        }
        .btn-outline-accent {
            background: transparent;
            border: 1px solid rgba(200,255,0,0.3);
            color: #c8ff00;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }
        .btn-outline-accent:hover {
            background: #c8ff00;
            color: #000;
            border-color: #c8ff00;
        }
        .gradient-text {
            background: linear-gradient(135deg, #c8ff00, #a0cc00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>

    <div class="container py-4">
        <div class="dashboard-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h1 class="display-6 fw-bold mb-1" style="font-family:'Syne',sans-serif;color:#fff;">Welcome to Group1</h1>
                    <p class="text-secondary mb-0">Group1 - 2nd Semester (2026)</p>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge-custom">
                        <i class="bi bi-person me-1"></i>{{ Auth::user()->name }}
                    </span>
                    <span class="badge-role">
                        <i class="bi bi-star me-1"></i>{{ ucfirst(Auth::user()->role) }}
                    </span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" style="background: rgba(200,255,0,0.1); border: 1px solid rgba(200,255,0,0.3); color: #c8ff00; border-radius: 12px;" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="profile-card">
                    <div class="p-4 text-center border-bottom border-secondary">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="avatar-large mb-3">
                        @else
                            <div class="avatar-initials-large mb-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                        @endif
                        <h3 class="fw-bold mb-1">{{ Auth::user()->name }}</h3>
                        <p class="text-secondary mb-2">{{ Auth::user()->email }}</p>
                        <span class="badge-role">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-secondary">
                            <span class="text-secondary">Member Since</span>
                            <span class="fw-semibold">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                        @if(Auth::user()->age)
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-secondary">
                            <span class="text-secondary">Age</span>
                            <span class="fw-semibold">{{ Auth::user()->age }} years</span>
                        </div>
                        @endif
                        @if(Auth::user()->sex)
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-secondary">
                            <span class="text-secondary">Sex</span>
                            <span class="fw-semibold">{{ ucfirst(Auth::user()->sex) }}</span>
                        </div>
                        @endif
                        @if(Auth::user()->address)
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-secondary">
                            <span class="text-secondary">Address</span>
                            <span class="fw-semibold">{{ Auth::user()->address }}</span>
                        </div>
                        @endif
                        <div class="d-flex justify-content-between mb-3 pb-2 border-bottom border-secondary">
                            <span class="text-secondary">Status</span>
                            <span class="badge bg-success">Active</span>
                        </div>
                        @if(Auth::user()->motto)
                        <div class="mt-3 p-3" style="background: #0a0a0a; border-radius: 12px; border: 1px solid rgba(255,255,255,0.05);">
                            <p class="text-secondary mb-1 small"><i class="bi bi-quote me-2"></i>Motto</p>
                            <p class="fst-italic mb-0">"{{ Auth::user()->motto }}"</p>
                        </div>
                        @endif
                        <div class="d-grid mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn-outline-accent text-center text-decoration-none">
                                <i class="bi bi-pencil me-2"></i>Edit Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="profile-card">
                    <div class="p-4 border-bottom border-secondary">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bold mb-0"><i class="bi bi-people-fill me-2" style="color:#c8ff00;"></i>Group Members</h5>
                            <span class="badge-custom">{{ count($members) }} Members</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="members-list">
                            @forelse($members as $member)
                            <div class="member-card mb-3">
                                <div class="d-flex align-items-center">
                                    @if($member->profile_photo)
                                        <img src="{{ asset('storage/' . $member->profile_photo) }}" 
                                             alt="{{ $member->name }}" 
                                             style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                                    @else
                                        <div class="avatar-initials">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                    @endif
                                    <div class="ms-3 flex-grow-1">
                                        <h6 class="fw-bold mb-0">{{ $member->name }}</h6>
                                        <p class="text-secondary mb-0 small">{{ $member->email }}</p>
                                        @if($member->motto)
                                        <p class="text-secondary mb-0 small fst-italic">"{{ $member->motto }}"</p>
                                        @endif
                                    </div>
                                    <div class="text-end">
                                        <span class="badge-role">Member</span>
                                        @if($member->age)
                                        <div class="small text-secondary mt-1">{{ $member->age }} yrs</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5">
                                <i class="bi bi-people display-1 text-secondary"></i>
                                <h5 class="mt-3 text-secondary">No members found</h5>
                                <p class="text-secondary">Members will appear here once added.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle p-3 me-3" style="background: rgba(200,255,0,0.1);">
                            <i class="bi bi-people fs-4" style="color:#c8ff00;"></i>
                        </div>
                        <div>
                            <p class="text-secondary mb-1 small">Total Members</p>
                            <h2 class="fw-bold mb-0">{{ count($members) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="profile-card">
                    <div class="p-4 border-bottom border-secondary">
                        <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2" style="color:#c8ff00;"></i>Recent Activity</h5>
                    </div>
                    <div class="p-4">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="bi bi-person-check fs-6"></i>
                            </div>
                            <div class="timeline-line"></div>
                            <div>
                                <p class="fw-semibold mb-1">You joined G1 Group</p>
                                <small class="text-secondary">{{ Auth::user()->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if(Auth::user()->updated_at != Auth::user()->created_at)
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="bi bi-pencil-square fs-6"></i>
                            </div>
                            <div class="timeline-line"></div>
                            <div>
                                <p class="fw-semibold mb-1">Profile last updated</p>
                                <small class="text-secondary">{{ Auth::user()->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endif
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="bi bi-graph-up fs-6"></i>
                            </div>
                            <div>
                                <p class="fw-semibold mb-1">Welcome to G1 Group!</p>
                                <small class="text-secondary">2nd Semester 2025-26</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
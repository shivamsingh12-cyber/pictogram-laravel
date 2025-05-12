<nav class="navbar navbar-expand-lg navbar-light bg-white border shadow-sm">
    <div class="container col-lg-9 d-flex justify-content-between align-items-center">
        <!-- Logo & Search Bar -->
        <div class="d-flex align-items-center col-md-8">
            <a class="navbar-brand me-3" href="/home">
                <img src="/img/pictogram.png" alt="Logo" height="28">
            </a>
            <div class="position-relative w-100" style="max-width: 400px;">
                <input class="form-control" id="search" type="search" placeholder="Looking for someone.." aria-label="Search">
                <div id="searchresult" class="position-absolute top-100 start-0 w-100 bg-white border rounded shadow-sm" style="z-index: 999;"></div>
            </div>
                {{-- <input class="form-control me-2" id="search" type="search" placeholder="Looking for someone.." aria-label="Search">
                <div id="searchresult" class="position-absolute top-100 start-0 w-50  bg-white border rounded shadow-sm" style="z-index:1; display: inline-block;"></div> --}}
     
        </div>

        <!-- Navbar Items -->
        <ul class="navbar-nav d-flex align-items-center">
            <li class="nav-item">
                <a class="nav-link text-dark" href="/"><i class="bi bi-house-door-fill fs-5"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addposts" href="#">
                    <i class="bi bi-plus-square-fill fs-5"></i>
                </a>
            </li>
            <li class="nav-item position-relative">
                <a class="nav-link text-dark" href="#" onclick="toggleSidebar()">
                    <i class="bi bi-bell-fill fs-5"></i>
                    <!-- Notification Dot -->
                    <span id="notificationDot" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle d-none"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#" data-bs-toggle="offcanvas" data-bs-target="#message">
                    <i class="bi bi-chat-right-dots-fill fs-5"></i>
                </a>
            </li>

            <!-- Profile Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    @php
                        $profilePic = empty(Auth()->user()->profile_pic) ? '/img/default_pic.jpg' : '/storage/'.Auth()->user()->profile_pic;
                    @endphp
                    <img src="{{ $profilePic }}" alt="Profile" height="30" class="rounded-circle border ms-2">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{route('edit_profile')}}">My Profile</a></li>
                    {{-- <li><a class="dropdown-item" href="#">Account Settings</a></li> --}}
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="/logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- Modal for Adding Posts -->
<div class="modal fade" id="addposts" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <img src="" id="post_img" style="display: none" class="w-100 rounded border">
                <form action="/add_posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control" type="file" name="post_img" id="select_post_img" required>
                        @error('post_img') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Say Something</label>
                        <textarea class="form-control" name="post_text" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn btn-primary w-100">Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-white border">
    <div class="container col-9 d-flex justify-content-between">
        <div class="d-flex justify-content-between col-8">
            <a class="navbar-brand" href="/home">
                <img src="/img/pictogram.png" alt="" height="28">

            </a>

            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="looking for someone.."
                    aria-label="Search">

            </form>

        </div>


        <ul class="navbar-nav  mb-2 mb-lg-0">

            <li class="nav-item">
                <a class="nav-link text-dark" href="/"><i class="bi bi-house-door-fill"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" data-bs-toggle="modal" data-bs-target="#addposts"  href="#"><i class="bi bi-plus-square-fill"></i></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link text-dark" href="#"><i class="bi bi-bell-fill" onclick="toggleSidebar()"></i></a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link text-dark position-relative" href="#" onclick="toggleSidebar()">
                    <i class="bi bi-bell-fill"></i>
                    <!-- Notification Dot -->
                    <span id="notificationDot" 
                          class="position-absolute top-1 start-100 translate-middle p-1 bg-danger border border-light rounded-circle d-none"
                        >
                        {{-- style="display: none;" --}}
                        {{-- <span class="visually-hidden">New alerts</span>     --}}
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#" data-bs-toggle="offcanvas" data-bs-target="#message" ><i class="bi bi-chat-right-dots-fill"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @php
                        if (empty(Auth()->user()->profile_pic)) {
                            echo '<img src="/img/default_pic.jpg" alt="" height="30" class="rounded-circle border">';
                        }
                        else{

                        //    echo "<img src='/storage/".{{Auth::user()->profile_pic}}'  height='30' class='rounded-circle border'>";
                           echo '<img src="/storage/'.Auth()->user()->profile_pic.'" alt="" height="30" class="rounded-circle border">';
                        }
                    @endphp
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('edit_profile')}}">My Profile</a></li>
                    <li><a class="dropdown-item" href="#">Account Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                </ul>
            </li>

        </ul>


    </div>
</nav>

<div class="modal fade" id="addposts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="" id="post_img" style="display: none" class="w-100 rounded border">
                <form action="/add_posts" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        <input class="form-control" type="file" name="post_img" id="select_post_img" required>
                        @error('post_img')
                            {{$message}}
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Say Something</label>
                        <textarea class="form-control" name="post_text" id="exampleFormControlTextarea1" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Post</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
  </div>

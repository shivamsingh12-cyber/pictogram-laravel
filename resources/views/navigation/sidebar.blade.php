

<!-- Sidebar Menu -->
<div class="sidebar" id="sidebar">
    
   
    {{-- <h1 class="mx-3 text-white after">Notifications</h1> --}}
    {{-- <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
    </ul> --}}
    {{-- <div class="container mt-4">
        <div class="alert alert-light border shadow-sm d-flex align-items-center p-2" role="alert">
            <img src="user-profile.jpg" alt="User" class="rounded-circle me-2" width="40" height="40">
            <div>
                <strong>John Doe</strong> liked your post.
            </div>
            <img src="like-icon.png" alt="Like" class="ms-auto" width="24" height="24">
        </div>
    </div> --}}
</div>

<!-- Overlay (click anywhere to close sidebar) -->
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

{{-- offcanvas --}}


  {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    Button with data-bs-target
  </button> --}}
  
  <div class="offcanvas offcanvas-start" tabindex="-1" id="message" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h1 class="offcanvas-title" id="offcanvasExampleLabel">Messages</h1>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="chatlist">
        {{-- data item --}}
        {{-- <div class="d-flex align-items-center chat-item">
            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="User" class="chat-dp">
            <div class="chat-details ms-3">
                <div class="d-flex justify-content-between">
                    <span class="chat-name">John Doe</span>
                    <span class="chat-time">10:45 AM</span>
                </div>
                <div class="chat-message">Hey! How are you?</div>
            </div>
        </div> --}}
     {{-- data item --}}

        {{-- data item --}}
        {{-- <div class="d-flex align-items-center chat-item">
            <img src="https://randomuser.me/api/portraits/men/2.jpg" alt="User" class="chat-dp">
            <div class="chat-details ms-3">
                <div class="d-flex justify-content-between">
                    <span class="chat-name">John Doe</span>
                    <span class="chat-time">10:45 AM</span>
                </div>
                <div class="chat-message">Hey! How are you?</div>
            </div>
        </div> --}}
     {{-- data item --}}

    </div>
  </div>
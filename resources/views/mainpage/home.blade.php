@include('pages.header')
@include('navigation.usernav')
@include('navigation.sidebar')

<div class="container mt-4">
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session()->has('original_admin'))
        <a href="{{ route('revert.admin') }}" class="btn btn-warning mb-3">Switch Back to Admin</a>
    @endif

    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            @if (empty($posts))
                <div class="alert alert-info text-center">
                    <i class="bi bi-hand-thumbs-down-fill"></i> No posts available! Follow or add friends to see content.
                </div>
            @endif

            @foreach ($posts as $post)
                <div class="card shadow-sm mb-4">
                    <div class="card-header d-flex align-items-center">
                        <a href="/mainprofile/{{ $post->username }}" class="d-flex align-items-center text-dark text-decoration-none">
                            <img src="{{ empty($post->profile_pic) ? '/img/default_pic.jpg' : '/storage/'.$post->profile_pic }}" class="rounded-circle border me-2" height="40">
                            <strong>{{ $post->first_name }} {{ $post->last_name }}</strong>
                        </a>
                    </div>
                    <img src="/storage/{{ $post->post_img }}" class="img-fluid">
                    <div class="card-body">
                        <p class="mb-2">{{ $post->post_text }}</p>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-heart-fill text-danger unlike_btn me-2" style="display: {{ checklikestatus($post->postid) ? 'inline' : 'none' }}" data-post-id="{{ $post->postid }}"></i>
                            <i class="bi bi-heart like_btn me-2" style="display: {{ checklikestatus($post->postid) ? 'none' : 'inline' }}" data-post-id="{{ $post->postid }}" data-user-id="{{ $post->user_id }}"></i>
                            <span class="me-3" data-bs-toggle="modal" data-bs-target="#likes{{ $post->postid }}">{{ count(getlikecount($post->postid)) }} likes</span>
                            <i class="bi bi-chat-left me-2" data-bs-toggle="modal" data-bs-target="#postview{{ $post->postid }}"></i>
                            <span data-bs-toggle="modal" data-bs-target="#postview{{ $post->postid }}">{{ count(getallcomments($post->postid)) }} comments</span>
                        </div>
                    </div>
                    <div class="input-group p-2 border-top">
                        <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="Say something..">
                        <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-post-id="{{ $post->postid }}" data-user-id="{{ $post->user_id }}">Post</button>
                    </div>
                </div>
                      {{-- commentsofpeople --}}
        <div class="modal fade" id="postview{{$post->postid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
    
                    <div class="modal-body d-flex p-0">
                        <div class="col-8">
                            <img src="/storage/{{$post->post_img}}" class="w-100 rounded-start">
                        </div>
    
    
    
                        <div class="col-4 d-flex flex-column">
                            <div class="d-flex align-items-center p-2 border-bottom">
                                <div><img src="/storage/{{$post->profile_pic}}" alt="" height="50" class="rounded-circle border">
                                </div>
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="d-flex flex-column justify-content-start align-items-center">
                                    <h6 style="margin: 0px;">{{$post->first_name}} {{$post->last_name}}</h6>
                                    <p style="margin:0px;" class="text-muted">{{'@'.$post->username}}</p>
                                </div>
                            </div>
                            <div class="flex-fill align-self-stretch overflow-auto" id="comment-section{{$post->postid}}" style="height: 100px;">        
                                
                                @php
                                    $comments=getallcomments($post->postid);
                                    if (count($comments)<1) {
                                        echo "<p class='text-center my-3 nce'>there is no comments!!</p>";
                                    }
                                @endphp
                                    @foreach ($comments as $comment)
                                       @php
                                           $cuser=getallUser($comment['user_id']);
                                       @endphp 
                                   
                                    <div class="d-flex align-items-center p-2">
                                    <div>
                                        @if (empty($cuser['profile_pic']))

                                        <img src="/img/default_pic.jpg" alt="" height="40" class="rounded-circle border">
                                            @else
                                        <img src="/storage/{{$cuser['profile_pic']}}" alt="" height="40" class="rounded-circle border">
                                        @endif
                                    </div>
                                    <div>&nbsp;&nbsp;&nbsp;</div>
                                    <div class="d-flex flex-column justify-content-start align-items-start">
                                        <h6 style="margin: 0px;"><a href="/mainprofile/{{$cuser['username']}}" class="text-decoration-none text-dark">{{'@'.$cuser['username']}}</a></h6>
                                        <p style="margin:0px;" class="text-muted">{{$comment['comment']}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="input-group p-2 border-top">
                                <input type="text" class="form-control rounded-0 border-0 comment-input" placeholder="say something.."
                                    aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary rounded-0 border-0 add-comment" data-page="wall" data-cs="comment-section{{$post->postid}}" data-post-id="{{$post->postid}}" type="button"
                                    id="button-addon2" data-user-id="{{$post->user_id}}">Post</button>
                            </div>
                        </div>
    
    
    
                    </div>
    
                </div>
            </div>
        </div>
            @endforeach
        </div>

        <!-- Sidebar - User Info & Suggestions -->
        <div class="col-lg-4">
            <div class="card p-3 shadow-sm mb-4">
                <div class="d-flex align-items-center">
                    <img src="{{ empty(Auth()->user()->profile_pic) ? '/img/default_pic.jpg' : '/storage/'.Auth()->user()->profile_pic }}" class="rounded-circle border me-3" height="60">
                    <div>
                        <a href="/mainprofile/{{ Auth::user()->username }}" class="text-dark text-decoration-none">
                            <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                        </a>
                        <p class="text-muted m-0">{{'@'. Auth::user()->username }}</p>
                    </div>
                </div>
            </div>
            <div class="card p-3 shadow-sm">
                <h6 class="text-muted">You May Follow</h6>
                @foreach ($users as $user)
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex align-items-center">
                            <img src="{{ empty($user->profile_pic) ? '/img/default_pic.jpg' : '/storage/'.$user->profile_pic }}" class="rounded-circle border me-2" height="40">
                            <div>
                                <a href="/mainprofile/{{ $user->username }}" class="text-dark text-decoration-none">
                                    <strong>{{ $user->first_name }} {{ $user->last_name }}</strong>
                                </a>
                                <p class="text-muted m-0">{{'@'.$user->username }}</p>
                            </div>
                        </div>
                        <button class="btn btn-sm btn-primary followbtn" data-user-id="{{ $user->id }}">Follow</button>
                    </div>
                @endforeach
                @if (empty($users))
                    <p class="text-center text-muted">No suggestions available.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@include('pages.footer')

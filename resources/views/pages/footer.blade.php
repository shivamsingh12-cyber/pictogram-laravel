<!-- Modal -->
<div class="modal fade" id="chatting" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><img src="" alt="" height="40" width="40" id="chatter_pic" class="m-1 rounded-circle border"> <span id="chatter_username"></span></h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <div class="chat-box">
            <div class="chat-box-body ">
              <div class="chat-box-body-content gap-3 d-flex flex-column-reverse" id="user_chat">
              
              </div>
               
          
           
              
            
        <div class="modal-footer">
          <div class="input-group p-2">
            <input type="text" class="form-control rounded-0 border-0" placeholder="say something.." id="msginput"
                aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-primary rounded-0 border-0"  type="button" data-user-id="0"
                id="sendmsg">Send Message</button>
        </div>
        </div>
      </div>
    </div>
  </div>
  


<script src="{{url('/')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{url('/')}}/js/custom.js?v=@php time() @endphp"></script>
<script src="{{url('/')}}/js/custom2.js"></script>
<script src="{{url('/')}}/js/script.js"></script>
</body>

</html>


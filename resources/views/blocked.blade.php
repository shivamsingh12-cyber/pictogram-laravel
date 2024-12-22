@include('pages.header')
    <div class="login">
        <div class="col-4 bg-white border rounded p-4 shadow-sm">
            <form>
                <div class="d-flex justify-content-center">

                    <img class="mb-4" src="img/pictogram.png" alt="" height="45">
                </div>
                <h1 class="h5 mb-3 fw-normal">Hello, {{ Auth()->user()->first_name }} {{ Auth()->user()->last_name }} Your Account Is Blocked By Admin</h1>




                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <a class="btn btn-danger" href="/logout">Logout</a>



                </div>

            </form>
        </div>
    </div>


@include('pages.footer')
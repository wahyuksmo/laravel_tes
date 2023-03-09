<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card p-4 shadow-lg border-0 my-4">

                    <h5 class="py-3 text-center">Halaman Login</h5>
                    <form id="form_login" name="form_login" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="email" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email" class="form-control rounded-pill" id="email">
                        </div>

                        <div class="form-group">
                            <input type="password" id="password" name="password" value="<?= old('password'); ?>" placeholder="Password" class="form-control rounded-pill" id="password">
                        </div>

                        <div class="form-group">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary rounded-pill p-2" id="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <p class="my-4 text-center"><a href="/register" class="text-decoration-none">Do not an have account? Register</a></p>
                </div>

            </div>
        </div>
    </div>


    <!-- loading -->

    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-white" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/js/common.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>



<script>
    window.addEventListener("load", async function() {
        $("#submit").on("click", async function(e) {
            e.preventDefault()
            Swal.fire({
                text: "Data sudah benar ?",
                icon: 'warning',
                confirmButtonText: 'Login',
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then(async function(e) {
                if (e.value) {
                    let csrf = "<?= csrf_token() ?>"
                    const payload = $("#form_login").serialize() + `&_token=${csrf}`
                    $.ajax({
                        type: 'POST',
                        url: "/login",
                        data: payload,
                        success: function(data) {
                            Swal.fire({
                                title: "Login Success",
                                icon: "success",
                                focusConfirm: true,
                            }).then((e) => {
                                window.location.href = `/`
                            })
                        },
                        error: function(data) {
                            if (data.status === 422) {
                                Swal.fire({
                                    title: "Login Gagal! periksa data anda",
                                    icon: "error",
                                    focusConfirm: true,
                                }).then((e) => {
                                    window.location.href = "/login"
                                })
                            }
                        },
                    });
                }
            })
        })
    })
</script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    body {
        background-image: -moz-linear-gradient(0deg, #5295fe 0%, #3399ff 100%);
        background-image: -webkit-linear-gradient(0deg, #5295fe 0%, #3399ff 100%);
        background-image: -moz-linear-gradient(0deg, #5295fe 0%, #3399ff 100%);
        font-family: 'Poppins', sans-serif;
    }

    .card img {
        max-width: 120px;
    }

    .form-group {
        padding: 15px;
    }

    .form-control:not(#image) {
        font-size: 0.8rem;
        padding: 1.5rem 1rem;
    }

    .modal-content {
        background-color: transparent;
        border: 0;
    }
</style>
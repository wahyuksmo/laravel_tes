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

                    <h5 class="py-3 text-center">Halaman Registrasi</h5>
                    <form id="form_register" name="form_register" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" id="name" name="name" value="<?= old('name'); ?>" placeholder="Nama Lengkap" class="form-control rounded-pill" id="name">
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email" class="form-control rounded-pill" id="email">
                        </div>

                        <div class="form-group">
                            <input type="password" id="password" name="password" value="<?= old('password'); ?>" placeholder="Password" class="form-control rounded-pill" id="password">
                        </div>

                        <div class="form-group">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary rounded-pill p-2" id="submit">Registrasion</button>
                            </div>
                        </div>
                    </form>
                    <p class="my-4 text-center"><a href="/login" class="text-decoration-none">Already have account? Login</a></p>
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
    function previewImg() {
        const sampul = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(sampul.files[0]);
        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
    window.addEventListener("load", async function() {
        $("#form_register").submit(async function(e) {
            e.preventDefault()
            const payload = new FormData(this)
            Swal.fire({
                text: "Data sudah benar ?",
                icon: 'warning',
                confirmButtonText: 'Registrasi',
                reverseButtons: true,
                showCancelButton: true,
                cancelButtonText: 'Tidak',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((e) => {
                if (e.value) {
                    $.ajax({
                        beforeSend: function() {
                            $("#loadingModal").modal("show")
                        },
                        url: '/register',
                        method: 'POST',
                        data: payload,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                title: "Registrasi Berhasil",
                                icon: "success",
                                focusConfirm: true
                            }).then((e) => {
                                window.location.href = '/login'
                            })
                        },
                        error: function(response) {
                            if (response.status === 422) {
                                let errors = $.parseJSON(response.responseText);
                                $.each(errors, function(key, value) {
                                    if ($.isPlainObject(value)) {
                                        $.each(value, function(key, value) {
                                            $(`<p class="text-danger ms-3" style="font-size: 12px;">${value}</p>`).insertAfter(`#${key}`);
                                        })
                                    }
                                })
                            }
                        },
                        complete: function() {
                            $("#loadingModal").modal("hide")
                        }
                    })
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
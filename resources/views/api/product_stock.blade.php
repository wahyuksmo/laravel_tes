@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-lg-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Form User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form_api">
                @csrf
                <input type="hidden" name="value" value="2">
                <input type="hidden" name="bank_id" value="2">
                <input type="hidden" name="status" value="1">
                <div class="card-body">
                    <button id="submit" class="btn btn-primary">Hit Api</button>
                </div>

                <div class="card-body">
                    <textarea id="json_format" cols="30" rows="10"></textarea>
                </div>

            </form>
        </div>
    </div>
</div>


@endsection




<script>
    window.addEventListener("load", async function() {

        $("#submit").on("click", async function(e) {
            e.preventDefault()

            const payload = $("#form_api").serialize()

            $.ajax({
                url: "http://149.129.221.143/kanaldata/Webservice/bank_account",
                type: 'POST',
                data: payload,
                success: function(response) {
                    console.log(response)
                    let json = JSON.stringify(response.data[0])
                    $("#json_format").val(json)
                },
                error: function(error) {
                    console.log(error)
                },
            })
        })

    })
</script>
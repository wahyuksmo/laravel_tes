@extends('admin.layouts.main')
@section('container')

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
      </div>
      <!-- /.card-header -->

      <div class="card-body">

        <?php if (session()->has('success')) :  ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session('success') ?>
          </div>
        <?php endif; ?>

        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php $no = 0;
            foreach ($data as $row) : $no++; ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->name ?></td>
                <td><?= $row->email ?></td>
                <td>
                  <a href="/edit_user/<?= $row->id ?>" class="btn btn-sm btn-success">Edit</a>
                  <?php if ($row->is_login == "Y") : ?>

                  <?php else :  ?>
                    <form action="/delete_user" method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="id" value="<?= $row->id ?>">
                      <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure ? ')">Delete</button>
                    </form>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>

        </table>
        <a href="/add_user" class="btn btn-sm btn-primary mt-4">Add User</a>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>


@endsection
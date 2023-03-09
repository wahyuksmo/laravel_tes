  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">


          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                  <li class="nav-item">
                      <a href="/" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Users
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="/product_stock" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Product Stock
                          </p>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="/user_api" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              User API
                          </p>
                      </a>
                  </li>



                  <li class="nav-item">
                      <form name="form_logout" id="form_logout" class="nav-link">
                          @csrf
                          <input type="hidden" name="user_id" value="<?= auth()->user()->id ?>">
                          <i class="bi bi-door-open-fill"></i>
                          <button id="logout" class="btn text-white ms-1" style="border: none;">Logout</button>
                      </form>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>


  <script>
      window.addEventListener("load", async function() {
          $("#logout").on("click", async function(e) {
              e.preventDefault()
              Swal.fire({
                  text: "Anda yakin ingin logout ?",
                  icon: 'warning',
                  confirmButtonText: 'Logout',
                  reverseButtons: true,
                  showCancelButton: true,
                  cancelButtonText: 'Tidak',
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
              }).then(async function(e) {
                  if (e.value) {
                      let csrf = "<?= csrf_token() ?>"
                      const payload = $("#form_logout").serialize() + `&_token=${csrf}`
                      $.ajax({
                          type: 'POST',
                          url: "/logout",
                          data: payload,
                          success: function(data) {
                              Swal.fire({
                                  title: "Logout Success",
                                  icon: "success",
                                  focusConfirm: true,
                              }).then((e) => {
                                  window.location.href = '/login'
                              })
                          },
                      });
                  }
              })
          })
      })
  </script>
<?= $this->extend('template/adminPanel'); ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-body mt-10">
            <div class="container-fluid d-flex">
                <div class="col-md-6">
                    <h3 class="text-dark mt-1">U S E R</h3>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" onclick="showCreateModal()" class="btn btn-primary">Tambah User</button>
                </div>
            </div>
            <hr><br>
            <table class="table table-bordered" id="userTable">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Username</th>
                        <!-- <th>Password</th> -->
                        <th>Role</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div id="createModal" class="modal">
                <div class="modal-content form-group">
                    <!-- <span class="close" onclick="closeUpdateModal()">&times;</span> -->
                    <h2 class="text-center text-dark">- Tambah User -</h2>
                    <form id="createForm">
                        <hr>
                        <input type="hidden" id="createUserID" name="userID" class="form-control">
                        <label for="createNamaPetugas">Nama Petugas</label>
                        <input type="text" id="createNamaPetugas" name="nama_petugas" class="form-control" required><br>

                        <label for="createUsername">Username</label>
                        <input type="text" id="createUsername" name="username" class="form-control" required><br>

                        <label for="createPassword">Password</label>
                        <input type="text" id="createPassword" name="password" class="form-control" required><br>

                        <label for="createRole">Role</label>
                        <select name="role" id="createRole" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Petugas">Petugas</option>
                        </select>

                        <hr>
                        <div class="container-fluid d-flex">
                            <div class="col-md-6">
                                <button type="button" onclick="closeCreateModal()"
                                    class="btn btn-outline-danger">Close</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" onclick="submitCreate()"
                                    class="btn btn-outline-warning">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="updateModal" class="modal">
                <div class="modal-content form-group">
                    <!-- <span class="close" onclick="closeUpdateModal()">&times;</span> -->
                    <h2 class="text-center text-dark">- Update User -</h2>
                    <form id="updateForm">
                        <hr>
                        <input type="hidden" id="updateUserID" name="userID" class="form-control">
                        <label for="updateNamaPetugas">Nama Petugas :</label>
                        <input type="text" id="updateNamaPetugas" name="nama_petugas" class="form-control" required><br>

                        <label for="updateUsername">Username :</label>
                        <input type="text" id="updateUsername" name="username" class="form-control" required><br>

                        <label for="updatePassword">Password :</label>
                        <input type="text" id="updatePassword" name="password" class="form-control" required readonly><br>

                        <label for="updateRole">Role</label>
                        <select name="role" id="updateRole" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Petugas">Petugas</option>
                        </select>

                        <hr>
                        <div class="container-fluid d-flex">
                            <div class="col-md-6">
                                <button type="button" onclick="closeUpdateModal()"
                                    class="btn btn-outline-danger">Close</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" onclick="submitUpdate()"
                                    class="btn btn-outline-warning">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script src="<?= base_url("js/jquery-3.7.1.min.js") ?>"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                // Implementasikan AJAX untuk CRUD
                // Pastikan jQuery atau fetch API tersedia

                // Fungsi untuk mendapatkan data user
                function getUser() {
                    $.ajax({
                        url: '/getUser',
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Manipulasi tabel dengan data yang didapat
                            $('#userTable tbody').empty();

                            // Loop melalui data dan tambahkan ke tbody
                            $.each(data, function (index, user) {
                                var no = ''
                                var row = `<tr>
                                <td class="text-center">${index + 1}</td>
                            
                            <td>${user.nama_petugas}</td>
                            <td>${user.username}</td>
                            
                            <td class="text-center">${user.role}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" onclick="updateUser(${user.userID})">Update</button>
                                <button type="button" class="btn btn-danger" onclick="deleteUser(${user.userID})">Delete</button>
                            </td>
                        </tr>`;
                                $('#userTable tbody').append(row);
                            });
                        }
                        // <td class="text-center">${user.password}</td>
                    });
                }

                function showCreateModal() {
                    $('#createModal').addClass('fadeIn'); // Tambahkan kelas fadeIn
                    setTimeout(() => {
                        $('#createModal').css('display', 'block');
                        $('#createModal').removeClass('fadeIn');
                    }, 300);
                }

                // Fungsi untuk menutup modal create
                function closeCreateModal() {
                    $('#createModal').addClass('fadeOut'); // Tambahkan kelas fadeOut
                    setTimeout(() => {
                        $('#createModal').css('display', 'none');
                        $('#createModal').removeClass('fadeOut');
                    }, 300);
                }

                // Fungsi untuk menambahkan produk baru
                function submitCreate() {
                    if ($('#nama_petugas').val() === '' || $('#username').val() === '' || $('#password').val() === '' || $('#role').val() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Harap isi semua field!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return; // Hentikan eksekusi jika ada field yang belum diisi
                    }
                    $.ajax({
                        url: '/create/user',
                        method: 'POST',
                        data: $('#createForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Refresh tabel setelah menambahkan user
                            Swal.fire({
                                icon: 'success',
                                title: 'User ditambahkan!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            getUser();

                            closeCreateModal();
                        }
                    });
                }

                // Implementasikan fungsi lainnya (update, delete) sesuai kebutuhan

                function deleteUser(userID) {
                    // Tampilkan peringatan SweetAlert
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data user akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna menekan tombol "Ya, hapus", lakukan penghapusan data
                            $.ajax({
                                url: '/delete/user',
                                method: 'POST',
                                data: { userID: userID },
                                dataType: 'json',
                                success: function (data) {
                                    // Refresh tabel setelah menghapus user
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'User Terhapus!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    getUser();
                                }
                            });
                        }
                    });
                }

                function updateUser(userID) {
                    $.ajax({
                        url: 'user/getUserByID/' + userID,
                        method: 'GET',
                        dataType: 'json',
                        success: function (user) {
                            // Isi data user ke dalam form update
                            $('#updateUserID').val(user.userID);
                            $('#updateNamaPetugas').val(user.nama_petugas);
                            $('#updateUsername').val(user.username);
                            $('#updatePassword').val(user.password);
                            $('#updateRole').val(user.role);

                            $('#updateModal').addClass('fadeIn'); // Tambahkan kelas fadeIn
                            setTimeout(() => {
                                $('#updateModal').css('display', 'block');
                                $('#updateModal').removeClass('fadeIn');
                            }, 300);
                        }
                    });
                }

                // Fungsi untuk menutup modal update
                function closeUpdateModal() {
                    $('#updateModal').addClass('fadeOut'); // Tambahkan kelas fadeOut
                    setTimeout(() => {
                        $('#updateModal').css('display', 'none');
                        $('#updateModal').removeClass('fadeOut');
                    }, 300);
                }

                // Fungsi untuk mengirim update user
                function submitUpdate() {
                    $.ajax({
                        url: '/update/user',
                        method: 'POST',
                        data: $('#updateForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Tutup modal setelah update
                            Swal.fire({
                                icon: 'success',
                                title: 'User di Update!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            closeUpdateModal();

                            // Refresh tabel setelah update
                            getUser();
                        }
                    });
                }

                // Panggil fungsi untuk mendapatkan data saat halaman dimuat
                $(document).ready(function () {
                    getUser();
                });
            </script>

        </div>

    </div>
</div>


<?= $this->endSection() ?>
<?= $this->extend('template/adminPanel'); ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-body mt-10">
            <div class="form-group">
                <form id="pelangganForm">
                    <h3 class="text-center text-dark">P E L A N G G A N</h3>
                    <hr>
                    <label for="NamaPelanggan">Nama Pelanggan:</label>
                    <input type="text" id="PelangganID" name="PelangganID" hidden>
                    <input type="text" id="NamaPelanggan" name="NamaPelanggan" class="form-control" required><br>

                    <label for="Alamat">Alamat</label>
                    <input type="text" id="Alamat" name="Alamat" class="form-control" required><br>

                    <label for="NomorTelepon">NomorTelepon</label>
                    <input type="text" id="NomorTelepon" name="NomorTelepon" class="form-control" required>
                    <br>

                    <button type="button" onclick="createPelanggan()" class="btn btn-primary">Tambah Pelanggan</button>
                </form>
            </div>
            <hr>
            <table class="table table-bordered" id="pelangganTable">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div id="updateModal" class="modal">
                <div class="modal-content form-group">

                    <h2 class="text-center text-dark">- Update Pelanggan -</h2>
                    <form id="updateForm">
                        <hr>
                        <input type="hidden" id="updatePelangganID" name="PelangganID">
                        <label for="updateNamaPelanggan">Nama Pelanggan</label>
                        <input type="text" id="updateNamaPelanggan" name="NamaPelanggan" class="form-control"
                            required><br>

                        <label for="updateAlamat">Alamat</label>
                        <input type="text" id="updateAlamat" name="Alamat" class="form-control" required><br>

                        <label for="updateNomorTelepon">No. Telp</label>
                        <input type="text" id="updateNomorTelepon" name="NomorTelepon" class="form-control" required>
                        <hr>
                        <div class="container-fluid d-flex">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-outline-danger"
                                    onclick="closeUpdateModal()">Close</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-outline-warning"
                                    onclick="submitUpdate()">Update</button>
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

                // Fungsi untuk mendapatkan data pelanggan
                function getPelanggan() {
                    $.ajax({
                        url: '/getPelanggan',
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Manipulasi tabel dengan data yang didapat
                            $('#pelangganTable tbody').empty();

                            // Loop melalui data dan tambahkan ke tbody
                            $.each(data, function (index, pelanggan) {
                                var no = ''
                                var row = `<tr>
                                <td class="text-center">${index + 1}</td>
                            
                            <td>${pelanggan.NamaPelanggan}</td>
                            <td>${pelanggan.Alamat}</td>
                            <td class="text-center">${pelanggan.NomorTelepon}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning" onclick="updatePelanggan(${pelanggan.PelangganID})">Update</button>
                                <button type="button" class="btn btn-danger" onclick="deletePelanggan(${pelanggan.PelangganID})">Delete</button>
                            </td>
                        </tr>`;
                                $('#pelangganTable tbody').append(row);
                            });
                        }
                    });
                }

                // Fungsi untuk menambahkan pelanggan baru
                function createPelanggan() {
                    if ($('#NamaPelanggan').val() === '' || $('#Alamat').val() === '' || $('#NomorTelepon').val() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Harap isi semua field!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return; // Hentikan eksekusi jika ada field yang belum diisi
                    }
                    $.ajax({
                        url: '/create/pelanggan',
                        method: 'POST',
                        data: $('#pelangganForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Refresh tabel setelah menambahkan pelanggan
                            Swal.fire({
                                icon: 'success',
                                title: 'Pelanggan ditambahkan!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            getPelanggan();
                            $('#pelangganForm')[0].reset();
                        }
                    });
                }

                // Implementasikan fungsi lainnya (update, delete) sesuai kebutuhan

                function deletePelanggan(PelangganID) {
                    $.ajax({
                        url: '/delete/pelanggan',
                        method: 'POST',
                        data: { PelangganID: PelangganID },
                        dataType: 'json',
                        success: function (data) {
                            // Refresh tabel setelah menghapus pelanggan
                            Swal.fire({
                                icon: 'success',
                                title: 'Pelanggan Terhapus!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            getPelanggan();
                        }
                    });
                }

                function updatePelanggan(PelangganID) {
                    $.ajax({
                        url: 'pelanggan/getPelangganByID/' + PelangganID,
                        method: 'GET',
                        dataType: 'json',
                        success: function (pelanggan) {
                            // Isi data pelanggan ke dalam form update
                            $('#updatePelangganID').val(pelanggan.PelangganID);
                            $('#updateNamaPelanggan').val(pelanggan.NamaPelanggan);
                            $('#updateAlamat').val(pelanggan.Alamat);
                            $('#updateNomorTelepon').val(pelanggan.NomorTelepon);

                            // Tampilkan modal update
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

                // Fungsi untuk mengirim update pelanggan
                function submitUpdate() {
                    $.ajax({
                        url: '/update/pelanggan',
                        method: 'POST',
                        data: $('#updateForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Tutup modal setelah update
                            Swal.fire({
                                icon: 'success',
                                title: 'Pelanggan di Update!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            closeUpdateModal();

                            // Refresh tabel setelah update
                            getPelanggan();
                        }
                    });
                }

                // Panggil fungsi untuk mendapatkan data saat halaman dimuat
                $(document).ready(function () {
                    getPelanggan();
                });
            </script>

        </div>

    </div>
</div>


<?= $this->endSection() ?>
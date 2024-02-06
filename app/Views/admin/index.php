<?= $this->extend('template/adminPanel'); ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="card">


        <div class="card-body mt-10">
            <div class="form-group">
                <form id="produkForm">
                    <h3 class="text-center text-dark">P R O D U K</h3>
                    <hr>
                    <div class="container-fluid d-flex">
                        <div class="col-md-4">
                            <label for="NamaProduk">Nama Produk:</label>
                            <input type="text" id="ProdukID" name="ProdukID" hidden>
                            <input type="text" id="NamaProduk" name="NamaProduk" class="form-control" required><br>
                        </div>
                        <div class="col-md-4">
                            <label for="Harga">Harga:</label>
                            <input type="text" id="Harga" name="Harga" class="form-control" required><br>
                        </div>
                        <div class="col-md-3">
                            <label for="Stok">Stok:</label>
                            <input type="text" id="Stok" name="Stok" class="form-control" required><br>
                        </div>
                        <div class="col-md-1 text-center mt-2">
                            <br>
                            <button type="button" onclick="createProduk()" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>

                </form>
            </div>
            <hr>
            <table class="table table-bordered" id="produkTable">
                <thead>
                    <tr class="text-center">
                        <th>No</th>

                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

            <div id="updateModal" class="modal">
                <div class="modal-content form-group">
                    <!-- <span class="close" onclick="closeUpdateModal()">&times;</span> -->
                    <h2 class="text-center text-dark">- Update Produk -</h2>
                    <form id="updateForm">
                        <hr>
                        <input type="hidden" id="updateProdukID" name="ProdukID" class="form-control">
                        <label for="updateNamaProduk">Nama Produk:</label>
                        <input type="text" id="updateNamaProduk" name="NamaProduk" class="form-control" required><br>

                        <label for="updateHarga">Harga:</label>
                        <input type="text" id="updateHarga" name="Harga" class="form-control" required><br>

                        <label for="updateStok">Stok:</label>
                        <input type="text" id="updateStok" name="Stok" class="form-control" required>
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

                // Fungsi untuk mendapatkan data produk
                function getProduk() {
                    $.ajax({
                        url: '/getProduk',
                        method: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Manipulasi tabel dengan data yang didapat
                            $('#produkTable tbody').empty();

                            // Loop melalui data dan tambahkan ke tbody
                            $.each(data, function (index, produk) {
                                var row = `<tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${produk.NamaProduk}</td>
                                <td>Rp ${produk.Harga}</td>
                                <td class="text-center">${produk.Stok}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning" onclick="updateProduk(${produk.ProdukID})">Update</button>
                                    <button type="button" class="btn btn-danger" onclick="deleteProduk(${produk.ProdukID})">Delete</button>
                                </td>
                            </tr>`;
                                $('#produkTable tbody').append(row);
                            });
                        }
                    });
                }

                // Fungsi untuk menambahkan produk baru
                function createProduk() {
                    if ($('#NamaProduk').val() === '' || $('#Harga').val() === '' || $('#Stok').val() === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Harap isi semua field!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return; // Hentikan eksekusi jika ada field yang belum diisi
                    }
                    $.ajax({
                        url: '/create/produk',
                        method: 'POST',
                        data: $('#produkForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Refresh tabel setelah menambahkan produk
                            Swal.fire({
                                icon: 'success',
                                title: 'Produk ditambahkan!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            getProduk();
                            $('#produkForm')[0].reset();
                        }
                    });
                }

                // Implementasikan fungsi lainnya (update, delete) sesuai kebutuhan

                function deleteProduk(ProdukID) {

                    // Tampilkan peringatan SweetAlert
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data produk akan dihapus!",
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
                                url: '/delete/produk',
                                method: 'POST',
                                data: { ProdukID: ProdukID },
                                dataType: 'json',
                                success: function (data) {
                                    // Refresh tabel setelah menghapus produk
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Produk Terhapus!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    getProduk();
                                }
                            });
                        }
                    });
                }

                function updateProduk(ProdukID) {
                    $.ajax({
                        url: 'produk/getProdukByID/' + ProdukID,
                        method: 'GET',
                        dataType: 'json',
                        success: function (produk) {
                            // Isi data produk ke dalam form update
                            $('#updateProdukID').val(produk.ProdukID);
                            $('#updateNamaProduk').val(produk.NamaProduk);
                            $('#updateHarga').val(produk.Harga);
                            $('#updateStok').val(produk.Stok);

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

                // Fungsi untuk mengirim update produk
                function submitUpdate() {
                    $.ajax({
                        url: '/update/produk',
                        method: 'POST',
                        data: $('#updateForm').serialize(),
                        dataType: 'json',
                        success: function (data) {
                            // Tutup modal setelah update
                            Swal.fire({
                                icon: 'success',
                                title: 'Produk di Update!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            closeUpdateModal();

                            // Refresh tabel setelah update
                            getProduk();
                        }
                    });
                }

                // Panggil fungsi untuk mendapatkan data saat halaman dimuat
                $(document).ready(function () {
                    getProduk();
                });
            </script>

        </div>

    </div>
</div>


<?= $this->endSection() ?>
<form action="{{ url('/supplier/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" name="kode_supplier" id="kode_supplier" class="form-control" required>
                    <small id="error-kode_supplier" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" required>
                    <small id="error-nama_supplier" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-control">
                    <small id="error-telepon" class="error-text form-text text-danger"></small>
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control"></textarea>
                    <small id="error-alamat" class="error-text form-text text-danger"></small>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-tambah").validate({
            rules: {
                kode_supplier: {
                    required: true,
                    minlength: 2,
                    maxlength: 10
                },
                nama_supplier: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                telepon: {
                    minlength: 8,
                    maxlength: 15
                },
                alamat: {
                    maxlength: 255
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataSupplier.ajax
                        .reload(); 
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <?php echo $message; ?>
                    <form method="POST">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" placeholder="Nama Lengkap" class="form-control">
                            </div>
                        </div>
                            <?php echo form_error("nama"); ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">NIM</label>
                                <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" class="form-control">
                            </div>
                        </div>
                            <?php echo form_error("nim"); ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Kelas</label>
                                <input type="text" name="kelas" placeholder="Kelas" class="form-control">
                            </div>
                        </div>
                            <?php echo form_error("kelas"); ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">ID Buku</label>
                                <input type="text" name="buku" placeholder="Buku ID" class="form-control">
                            </div>
                        </div>
                            <?php echo form_error("buku"); ?>
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="">Sampai dengan</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <?php echo form_error("end_date"); ?>
                        <div class="row">
                            <div class="form-group col-12 text-center">
                                <button class="btn btn-dark btn-block" type="submit" name="tambahbtn" value="tambah">Tambahkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
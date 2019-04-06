        <!--- tambah buku --->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php echo $message; ?>
                            <form method="POST">
                                <div class="form-group col-12">
                                    <label for="Nama">Judul Buku</label>
                                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars(xss_clean($data_judul)); ?>" placeholder="Nama Buku" id="">
                                </div>

                                <?php echo form_error("judul"); ?>
                                
                                <div class="form-group col-12">
                                    <label for="Nama">ISBN</label>
                                    <input type="text" name="isbn" class="form-control" value="<?php echo htmlspecialchars(xss_clean($data_isbn)); ?>" placeholder="ISBN" id="">
                                </div>

                                <?php echo form_error("isbn"); ?>

                                <div class="form-group col-12">
                                    <label for="Nama">Tahun Terbit</label>
                                    <input type="text" name="tahunterbit" value="<?php echo htmlspecialchars(xss_clean($data_terbit)); ?>" class="form-control" placeholder="Tahun Terbit" id="">
                                </div>

                                <?php echo form_error("tahunterbit"); ?>

                                <div class="form-group col-12">
                                    <label for="Nama">Pengarang</label>
                                    <input type="text" name="pengarang" class="form-control" value="<?php echo htmlspecialchars(xss_clean($data_pengarang)); ?>" placeholder="Pengarang Buku" id="">
                                </div>

                                <?php echo form_error("pengarang"); ?>

                                <div class="form-group col-12">
                                    <label for="Kategori">Kategori</label>
                                    <select name="kategori" id="" class="form-control">
                                        <option value="">Select Kategori</option>
                                        <?php echo $data_kategori; ?>
                                    </select>
                                </div>

                                <?php echo form_error("kategori"); ?>

                                <div class="form-group col-12">
                                    <label for="Kategori">Penerbit</label>
                                    <select name="penerbit" id="" class="form-control">
                                        <option value="">Select Penerbit</option>
                                        <?php echo $data_penerbit; ?>
                                    </select>
                                </div>

                                <?php echo form_error("penerbit"); ?>

                                <div class="form-group col-12">
                                    <label for="Nama">Jumlah</label>
                                    <input type="text" name="jumlah" value="<?php echo htmlspecialchars(xss_clean($data_jumlah)); ?>" class="form-control" placeholder="Jumlah Buku" id="">
                                </div>

                                <?php echo form_error("jumlah"); ?>

                                <div class="form-group col-12">
                                    <label for="Nama">Rak Buku</label>
                                    <input type="number" name="rak_buku" value="<?php echo htmlspecialchars(xss_clean($data_rakbuku)); ?>" class="form-control" placeholder="Rak Buku" id="">
                                </div>

                                <?php echo form_error("rak_buku"); ?>

                                <div class="form-group col-12">
                                    <label for="sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" rows="5" class="form-control"><?php echo xss_clean($data_sinopsis); ?></textarea>
                                </div>

                                <?php echo form_error("sinopsis"); ?>

                                <div class="form-group">
                                    <button class="btn btn-dark btn-block" name="editbtn" type="submit" value="edit">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
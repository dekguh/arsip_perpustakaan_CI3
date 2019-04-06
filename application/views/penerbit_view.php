        <!--- tambah buku --->
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php echo $message; ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="Nama">Penerbit</label>
                                        <input type="text" name="penerbit" class="form-control" placeholder="Penerbit">
                                    </div>
                                </div>
                                <?php echo form_error("penerbit"); ?>
                                <div class="form-group">
                                    <button class="btn btn-dark btn-block" name="tambahbtn" type="submit" value="tambah">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--- list kategori --->
        <div class="container mt-5">
            <form method="POST">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td width="5%">#</td>
                                <td>Kategori</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $list_penerbit; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <button class="btn btn-danger btn-block" name="deletebtn" value="delete" type="submit">Delete</button>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
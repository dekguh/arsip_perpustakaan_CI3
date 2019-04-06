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
                                        <label for="Nama">Kategori</label>
                                        <input type="text" name="kategori" class="form-control" placeholder="Kategori">
                                    </div>
                                </div>
                                <?php echo form_error("kategori"); ?>
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
            <form method="post">
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
                            <?php echo $list_kategori; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <button class="btn btn-danger btn-block" type="submit" name="deletebtn" value="delete">Delete</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <?php echo $pagination; ?>
                </div>
            </div>
            </form>
        </div>
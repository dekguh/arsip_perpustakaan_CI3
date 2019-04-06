        <!--- tambah buku --->
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="judul" class="form-control" value="<?php echo htmlspecialchars($search_judul); ?>" placeholder="Judul Buku">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="pengarang" value="<?php echo htmlspecialchars($search_pengarang); ?>" class="form-control" placeholder="Pengarang">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="penerbit" class="form-control">
                                                        <option value="">All Penerbit</option>
                                                        <?php echo $list_penerbit; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="kategori" class="form-control">
                                                        <option value="">All Kategori</option>
                                                        <?php echo $list_kategori; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="forr">
                                                    <input type="number" name="tahunterbit" value="<?php echo htmlspecialchars($search_terbit); ?>" class="form-control" placeholder="Tahun Terbit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-dark btn-block" type="submit" name="searchbtn" value="search">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="table-responsive-md">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td width="5%">#</td>
                                    <td>Judul</td>
                                    <td>Kategori</td>
                                    <td>Penerbit</td>
                                    <td width="8%">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                            <?php echo $list_data; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <button class="btn btn-danger btn-block" type="submit" name="deletebtn" value="delete">Delete</button>
                </div>
            </div>
            </form>
            <div class="row">
                <div class="col-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
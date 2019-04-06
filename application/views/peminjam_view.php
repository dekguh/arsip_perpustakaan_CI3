        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($search_nama); ?>" placeholder="Nama">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <input type="number" class="form-control" name="nim" value="<?php echo htmlspecialchars($search_nim); ?>" placeholder="NIM">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <select name="status" class="form-control">
                                                    <option value="All Status"></option>
                                                    <?php echo $select_status; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <button class="btn btn-dark btn-block">Search</button>
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
                <div class="col-12 table-responsive-md">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td width="5%">#</td>
                                <td>Nama</td>
                                <td>NIM</td>
                                <td>Buku</td>
                                <td>Expired</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $list_data; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button class="btn btn-danger btn-block" type="submit" name="deletebtn" value="delete">Delete</button>
                </div>
            </div>
            </form>
            <div class="row mt-4">
                <div class="col-12">
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
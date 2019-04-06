        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <?php echo form_error('status'); ?>
                            <form method="POST">
                                <div class="row">
                                    <div class="form-group col-md-7">
                                        <select name="status" class="form-control">
                                            <?php echo peminjam_select_status($info_peminjam->status); ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <button class="btn btn-dark btn-block" type="submit" name="updatebtn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
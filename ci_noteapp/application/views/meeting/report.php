                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
                    </div>

                    <div class="row">
                        <?= $this->session->flashdata('message'); ?>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class=" col-lg-12">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="<?= base_url('assets/img/taspen_top.jpg') ?> " width="100" height="100">
                                        <div class="text-left">
                                            <hr>
                                            <form action="<?= base_url('meeting/report'); ?>" method="post">
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor Surat:</label>
                                                    <div class="col-sm-4">
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Hari">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hari/Tanggal</label>
                                                    <div class="col-sm-4">
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Hari">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" id="date" name="date">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tempat</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Waktu</label>
                                                    <div class="col-sm-10">
                                                        <input type="time" class="form-control" id="inputEmail3" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Anggota Rapat</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jenis Rapat</label>
                                                    <div class="col-sm-10">
                                                        <select name="id_menu" id="id_menu" class="form-control">
                                                            <option value="">Pilih Jenis Rapat</option>
                                                            <?php foreach ($menu as $m) : ?>
                                                                <option value="<?= $m['id_menu']; ?>"><?= $m['nm_menu']; ?></option>
                                                            <?php endforeach;  ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Judul Rapat</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Agenda Rapat</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Upload Dokumen</label>
                                                    <div class="col-sm-10">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">.pdf .docx</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Upload Dokumen</label>
                                                    <div class="col-sm-10">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile">
                                                            <label class="custom-file-label" for="customFile">.mp3 .wav</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                            </hr>
                                        </div>
                                        <hr>
                                        <img src="<?= base_url('assets/img/taspen_bot.jpg') ?> " width="250" height="50">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
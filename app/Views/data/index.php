<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-5">
            <h1 class="mt-2">Data ODP Gendong</h1>
            <form action="/Data/" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <?php 
                echo form_open_multipart('data/import')
            ?>
            <div class="mb-3">
                <label class="form-label">Import File Excel</label>
                <input class="form-control-file form-control-sm" name="file_excel" accept=".xls,.xlsx" type="file">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success btn-sm">Proses Import</button>
            </div>
            <?php 
            echo form_close();
            ?>
            
            <div class="mb-3">
                <label>Delete data tabel-></label>
                <form action="/data/delete" method="post" class="d-inline">
                    <button class="btn btn-danger btn-sm"  type="submit" onclick="return confirm('Apakah anda yakin?');">DELETE</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">WITEL</th>
                            <th scope="col">STO</th>
                            <th scope="col">VENDOR</th>
                            <th scope="col">NODE IP</th>
                            <th scope="col">JUMLAH ONU ID</th>
                            <th scope="col">NAMA ODP 1</th>
                            <th scope="col">NAMA ODP2</th>
                            <th scope="col">NAMA ODP 3</th>
                            <th scope="col">NAMA ODP 4</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                        <?php foreach ($data as $u) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $u['witel']; ?></td>
                                <td><?= $u['sto']; ?></td>
                                <td><?= $u['vendor']; ?></td>
                                <td><?= $u['node_ip']; ?></td>
                                <td><?= $u['jmlh_onu_id']; ?></td>
                                <td><?= $u['nama_odp1']; ?></td>
                                <td><?= $u['nama_odp2']; ?></td>
                                <td><?= $u['nama_odp3']; ?></td>
                                <td><?= $u['nama_odp4']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?= $pager->links('tb_data', 'data_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
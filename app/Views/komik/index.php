<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/komik/create" class="btn btn-primary mb-3">Tambah data komik</a>
            <h1 class="mt-2">Daftar Komik</h1>

            <!-- alert -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                </svg>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                </div>
            <?php endif; ?> 
            <!-- selesai alert -->

        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Sampul</th>
                <th scope="col">Judul</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($komik as $k) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $k['sampul']; ?>" alt="" class="sampul"></td>
                        <td><?= $k['sampul']; ?></td>
                        <td>
                            <a href="/komik/<?= $k['slug'] ;?>" class="btn btn-success">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
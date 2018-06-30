<div>
    <section class="container" >
        <form action="?controller=GiangVien&action=saveadd" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="">Ma Giang Vien</label>
                    <input type="text" class="form-control" name="maGV" placeholder="">
                    <?php
                    if (isset($data['maGV'])) : ?>
                        <small class='text-danger'><?php echo $data['maGV'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="">Ten Giang Vien</label>
                    <input type="text" name="tenGV" class="form-control">
                    <?php
                    if (isset($data['tenGV'])) : ?>
                        <small class='text-danger'><?php echo $data['tenGV'] ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-3">
                    <label for="">Ngay sinh</label>
                    <input type="date"  name="ngaySinh" class="form-control" value="<?php echo date('Y-m-d');?>">
                    <?php
                    if (isset($data['ngaySinh'])) : ?>
                        <small class='text-danger'><?php echo $data['ngaySinh'] ?></small>
                    <?php endif; ?>
                </div>
                <fieldset class="form-group col-md-6">
                    <div class="row">
                        <legend class="col-form-label col-md-2">Gioi tinh</legend>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="gioiTinh" value="nam">
                                <label class="form-check-label" for="">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="gioiTinh" value="nu">
                                <label for="" class="form-check-label">Nu</label>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group col-md-3">
                    <label for="">Hinh anh</label>
                    <input type="file" class="form-control-file" name="hinhAnh">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">So dien thoai</label>
                    <input type="text" name="sdt" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Email</label>
                    <input type="text" placeholder="" name="email" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="">Dia chi</label>
                    <input type="text" placeholder="" name="diaChi" class="form-control">
                </div>
            </div>
            <div>
                <a href="?controller=GiangVien&action=homepage" class="btn btn-warning">Huy</a>
                <button type="submit" class="btn btn-info">Them giang vien</button>
            </div>
        </form>
    </section>
</div>
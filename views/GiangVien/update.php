<div>
    <section class="container" >
        <form action="?controller=GiangVien&action=saveUpdate&id=<?php echo isset($_GET['id']) ?  $_GET['id'] : '' ?>" method="POST" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">Ten Giang Vien</label>
                    <input type="text" name="tenGV" class="form-control" value="<?php echo $data['tenGV']?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Ngay sinh</label>
                    <input type="date"  name="ngaySinh" class="form-control" value="<?php echo $data['ngaySinh']?>">
                </div>
            </div>
            <div>
                <fieldset class=" row form-group col-md-8">
                    <div class="row">
                        <legend class="col-form-label col-md-2">Gioi tinh</legend>
                        <div class="col-md-1">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" <?= $data['gioiTinh'] == 'nam' ? 'checked' : '' ?> name="gioiTinh" value="nam">
                                <label class="form-check-label" for="">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" <?php $data['gioiTinh'] == 'nu' ? 'checked' : '' ?> name="gioiTinh" value="nu">
                                <label for="" class="form-check-label">Nu</label>
                            </div>
                        </div>

                    </div>
                </fieldset>
                <div class="row">
                    <div class=" form-group col-md-4">
                        <label for="">Hinh anh</label>
                        <input type="file" name="hinhAnh">
                    </div>
                </div>
                <?php if($data['hinhAnh'] != '') :?>
                    <div>
                        <img class="img-thumbnail" src="../public/uploads/<?= $data['hinhAnh']?>" alt="" width="120px">
                    </div>
                <?php endif;?>

            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="">So dien thoai</label>
                    <input type="text" name="sdt" class="form-control" value="<?php echo $data['sdt']?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="">Email</label>
                    <input type="text" placeholder="" name="email" class="form-control" value="<?php echo $data['email']?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="">Dia chi</label>
                    <input type="text" placeholder="" name="diaChi" class="form-control" value="<?php echo $data['diaChi']?>">
                </div>
            </div>
            <div>
                <a href="?controller=GiangVien&action=homepage" class="btn btn-outline-warning">Huy</a>
                <button type="submit" class="btn btn-outline-success">Cap nhat giang vien</button>
            </div>
        </form>
    </section>
</div>
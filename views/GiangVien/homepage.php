<div class="modal fade" id="deleteReply">
    <div class="modal-dialog ">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header alert-danger">
                <h4 class="modal-title">Xoa giang vien ?</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                You are about to delete this data, are you sure?
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="?controller=GiangVien&action=remove&id=" class="btn btn-warning accept" >Yes</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</div>
<div class="container-fluid">
    <section class="container">
        <div>
            <a class="btn btn-outline-success mt-2" href="?controller=GiangVien&action=add">
                <i class="fas fa-user-plus"></i>  Them Giang Vien</a>
        </div>
        <table class=" table table-hover">
            <thead>
            <h3 class="text-capitalize text-center">Thong tin giang vien</h3>
            <tr class="">
                <th>id</th>
                <th>Ma giang vien</th>
                <th>Ten giang vien</th>
                <th>Hinh anh</th>
                <th>Email</th>
                <th>So dien thoai</th>
                <th>Gioi tinh</th>
                <th>Ngay sinh</th>
                <th>Dia chi</th>
                <th colspan="2">Hanh dong</th>

            </tr>
            </thead>
            <tbody>

            <?php foreach($data as $key => $gv):?>
                <tr>
                    <td><?php echo ($key + 1)?></td>
                    <td><?php echo $gv['maGV']?></td>
                    <td><?php echo $gv['tenGV']?></td>
                    <td>
                        <img src="/public/uploads/<?php echo  $gv['hinhAnh']?>" alt="" width="80px">
                    </td>
                    <td><?php echo $gv['email']?></td>
                    <td><?php echo $gv['sdt']?></td>
                    <td><?php echo $gv['gioiTinh']?></td>
                    <td><?php echo $gv['ngaySinh']?></td>
                    <td><?php echo $gv['diaChi']?></td>
                    <td><a class="delete-lecture" data-toggle="modal" data-target="#deleteReply" href="<?php echo $gv['id']?>"><i class="far fa-trash-alt"></i> Xoa</a></td>
                    <td><a href="?controller=GiangVien&action=update&id=<?php echo $gv['id']?>"><i class="fa fa-sync"></i> Cap nhat</a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </section>
</div>


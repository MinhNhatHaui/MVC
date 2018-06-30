<?php
/**
 * Created by PhpStorm.
 * User: minhnhat
 * Date: 27/06/2018
 * Time: 11:09
 */

require_once 'controllers/Controller.php';

class GiangVien extends Controller
{

    public function index()
    {
        /*$this->cat = 'Kity';
        $title="<h3>This is title</h3>";*/
        $content = array("title" => "This is a title", "content" => "And this is content, is that funny, huh?");
        $this->view("index", $content);
    }

    public function homepage()
    {
        require_once 'models/GiangVien.php';
        $model = new GiangVienModel();
        $listGV = $model->getAll();
        $this->view('homepage', $listGV);
    }

    public function add()
    {
        $this->view('add');
    }

    public function update()
    {
        $id = intval($_GET['id']);
        require_once 'models/GiangVien.php';
        $model = new GiangVienModel();
        $data = $model->getOne($id);
        $this->view('update', $data);
    }

    public function saveUpdate()
    {
        $id = intval($_GET['id']);
        require_once 'models/GiangVien.php';
        $model = new GiangVienModel();
        $data = [
            "tenGV" => $_POST['tenGV'],
            "ngaySinh" => isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : '',
            "gioiTinh" => isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : '',
            "hinhAnh" => isset($_FILES['hinhAnh']) ? $_FILES['hinhAnh'] : '',
            "sdt" => $_POST['sdt'],
            "email" => $_POST['email'],
            "diaChi" => $_POST['diaChi']
        ];
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['tenGV'] == '') {
                $error['tenGV'] = 'Truong ten giang vien can duoc dien';
            }
            if ($data['hinhAnh']['error'] == 0)
            {           //Get Image detail
                $file_name = $_FILES['hinhAnh']['name'];
                $file_tmp = $_FILES['hinhAnh']['tmp_name'];
                $file_type = $_FILES['hinhAnh']['type'];
                $file_error = $_FILES['hinhAnh']['error'];
                if ($file_error == 0)
                {
                    $part = BASE . "/public/uploads/";
                    $data['hinhAnh'] = uniqid() . '-' . preg_replace('/\s+/', '_', $file_name);
                    $imageFileType = strtolower(pathinfo($part . $file_name, PATHINFO_EXTENSION));

                    if ($imageFileType != "jpg" && $imageFileType != "png" &&
                        $imageFileType != "jpeg" && $imageFileType != "gif")
                    {
                        $error['hinhAnh'] = "Hinh anh khong dung dinh dang. 
                                             Chi chap nhan dinh dang: .jpg, .png, .jpeg, .gif";
//                        $this->view('update',$error['hinhAnh']);
                    } else
                        {
                            $update = $model->update($data,$id);
                            move_uploaded_file($file_tmp,$part.$data['hinhAnh']);
                            var_dump($data['hinhAnh']);
                    }
                }

            } else
                {
                    $data['hinhAnh'] = '';
                    $update = $model->update($data,$id);
                }
            {
                if ($update > 0)
                header('Location: ?controller=GiangVien&action=homepage');
            }

        }
    }

    public function remove()
    {
        $id = intval($_GET['id']);
        require_once 'models/GiangVien.php';
        $model = new GiangVienModel();
        $listGV = $model->delete($id);
        $this->homepage();
    }


    public function saveadd()
    {
        require_once 'models/GiangVien.php';
        $model = new GiangVienModel();

        $data = [
            "maGV" => $_POST['maGV'],
            "tenGV" => $_POST['tenGV'],
            "ngaySinh" => isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : '',
            "gioiTinh" => isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : '',
            "hinhAnh" => isset($_FILES['hinhAnh']) ? $_FILES['hinhAnh'] : '',
            "sdt" => $_POST['sdt'],
            "email" => $_POST['email'],
            "diaChi" => $_POST['diaChi']
        ];
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($_POST['maGV'] == '') {
                $error['maGV'] = 'Truong ma giang vien can duoc dien';
            }
            if ($_POST['tenGV'] == '') {
                $error['tenGV'] = 'Truong ten giang vien can duoc dien';
            }
            if (isset($_POST['maGV'])) {
                $checkExisted = $model->checkId("maGV = '" . $_POST['maGV'] . "'");
                if ($checkExisted != NULL) {
                    $error['maGV'] = 'Ma giang vien da ton tai';
                    $this->view('add', $error);
                }
                /*$id_insert = $model->insert($data);
                header('Location: ?controller=GiangVien&action=homepage');*/
                if (($_FILES['hinhAnh']) != NULL) {
                    $file_name = $_FILES['hinhAnh']['name'];
                    $file_tmp = $_FILES['hinhAnh']['tmp_name'];
                    $file_type = $_FILES['hinhAnh']['type'];
                    $file_error = $_FILES['hinhAnh']['error'];
                    if ($file_error == 0) {
                        $part = BASE . "/public/uploads/";
                        $data['hinhAnh'] = uniqid() . '-' . $file_name;
                        $imageFileType = strtolower(pathinfo($part . $file_name, PATHINFO_EXTENSION));
                    }
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        $error['hinhAnh'] = "Hinh anh khong dung dinh dang. Chi chap nhan dinh dang: .jpg, .png, .jpeg, .gif";
                    } else {
                        $id_insert = $model->insert($data);
                        if ($id_insert) {
                            move_uploaded_file($file_tmp, $part . $data['hinhAnh']);
                            header('Location: ?controller=GiangVien&action=homepage');
                        }
                    }
                    die();
                } else {
                    echo "Image isn't existed";
                }

            }

        }

    }
}
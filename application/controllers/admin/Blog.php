<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{


    public function index()
    {
        $query = $this->db->query("SELECT * FROM `articles` ORDER BY blogid DESC");
        $data['result'] = $query->result_array();

        $this->load->view('adminpanel/viewblog', $data);
    }
    function addblog()
    {
        $this->load->view('adminpanel/addblog');
    }
    function addblog_post()
    {
        // print_r($_POST);
        // print_r($_FILES);

        if ($_FILES) {

            $config['upload_path']          = './assets/upload/blogimg/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                die('Error');
                // $this->load->view('upload_form', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                echo "<pre>";
                print_r($data);
                // echo $data['upload_data']['file_name'];

                $fileurl =  'assets/upload/blofimg' . $data['upload_data']['file_name'];

                $blog_title = $_POST['blog_title'];
                $desc = $_POST['desc'];
                $blog_title = $_POST['blog_title'];

                $query = $this->db->query("INSERT INTO `articles`( `blog_titile`, `blog_desc`, `blof_img`) VALUES ('$blog_title','$desc','$fileurl')");
                // $this->load->view('upload_success', $data);
                if ($query) {
                    $this->session->set_flashdata('inserted', 'Yes');
                    redirect('admin/blog/addblog');
                } else {
                    $this->session->set_flashdata('inserted', 'No');
                    redirect('admin/blog/addblog');
                }
            }
        } else {
            //image is not passed

        }
    }
    function editblog($blog_id)
    {
        // print_r($blog_id);
        $query =  $this->db->query("SELECT  `blog_titile`, `blog_desc`, `blof_img`  FROM `articles` WHERE `blogid` = '$blog_id'");
        $data['result'] = $query->result_array();
        $data['blog_id'] = $blog_id;
        $this->load->view("adminpanel/editblog", $data);
    }
    function editblog_post()
    {
        // print_r($_POST);
        // print_r($_FILES);
        if ($_FILES['file']['name']) {
            // die("Update File ");
            //UPDATE IMAGE
            $config['upload_path']          = './assets/upload/blogimg/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                die('Error');
                // $this->load->view('upload_form', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());
                echo "<pre>";
                print_r($data['upload_data']['file_name']);
                $filename_location = "/assets/upload/blogimg/" . $data['upload_data']['file_name'];

                $blog_title = $_POST['blog_title'];
                $desc = $_POST['desc'];
                $blog_id = $_POST['blog_id'];

                $query = $this->db->query("UPDATE `articles` SET `blog_titile`= '$blog_title',`blog_desc`='$desc' WHERE `blogid` = '$blog_id'");

                if($query){
                    $this -> session->set_flashdata('updated','Yes');
                    redirect("admin/blog");
                }else{
                    $this->session->set_flashdata('updated','No');
                    redirect("admin/blog");
                }

            }
        } else {
            die('Update without file');
        }
    }
    function deleteblog()
    {
        print_r($_POST);
        $delete_id = $_POST['delete_id'];
       $qu = $this->db->query("DELETE FROM `articles` WHERE `blogid` = '$delete_id'");
            if($qu){
                echo "deleted";
            }else{
                echo "not deleted";
            }


    }
}

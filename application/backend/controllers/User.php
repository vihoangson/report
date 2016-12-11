<?php

class User extends CI_Controller{

    var $_mail;
    
    function  __construct() 
    {
        parent::__construct();
        $this->load->helper(array("url","form","my_data"));
        $this->load->library(array("form_validation","session","MY_Auth","email"));
        
        if(!$this->my_auth->is_Admin()){
            //redirect(base_url()."index.php/verify/login");
			redirect(base_url());
            exit();
        }
        
        $this->load->database();
        $this->load->model("User_model");
        $this->load->library("my_layout"); // Sử dụng thư viện layout
        $this->my_layout->setLayout("template"); // load file layout chính (views/template.php)
    }       
     

    //--- danh sach thanh vien
    function index(){
        echo'<a href="'.base_url().'index.php/dashboard/logout">Thoát</a></div>';
        $this->User_model->getalldata();
        $max = $this->User_model->num_rows();
        $min = 3;
        $data['num_rows'] = $max;
        //--- Paging
        if($max!=0){
            
            $this->load->library('pagination');
            $config['base_url'] = base_url()."index.php/user";
            $config['total_rows'] = $max;
            $config['per_page'] = $min;
            $config['num_link'] = 3; 
            $config['uri_segment'] = 4;
            $this->pagination->initialize($config);
            
            $data['link'] = $this->pagination->create_links();
            $data['users'] = $this->User_model->getalldata($min,$this->uri->segment($config['uri_segment']));
            
            $this->my_layout->view("list_view",$data);
        
        }else{

            $data['report'] = "Khong co du lieu de hien thi";
            $this->my_layout->view("report",$data);
        }
        
        
    } 
    
    
    //---- Thêm user
    function add()
    {
        $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
        $this->form_validation->set_rules("username","Username","required|max_length[25]|callback_checkUser");
        $this->form_validation->set_rules("password","Password","required|matches[repassword]");
        $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
        $this->form_validation->set_rules("address","Address","required");
        $this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
        $this->form_validation->set_rules("gender","Gender","required");
        
        $data['error'] = "";
        if($this->form_validation->run()==FALSE){
            
            $this->my_layout->view("add_view",array("error"=>""));
        }
        else
        {
                $salt = create_random_string(5);
                $add = array(
                        "full_name" => $this->input->post("full_name"),
                        "username"  => $this->input->post("username"),
                        "salt"      => $salt,
                        "password"  => md5($this->input->post("password")),
                        "email"     => $this->input->post("email"),
                        "address"   => $this->input->post("address"),
                        "phone"   => $this->input->post("phone"),
                        "level"     => $_POST['level'],
                        "gender"    => $_POST['gender'],
                        "add_date"  => date("Y-m-d H:i:s"),
                        "active"    => 0, // chua kich hoat
                );
                
                //--- Gui mail kich hoat neu add thanh cong
                $message = "";
                $mail = array();

                if($this->muser->addUser($add)){
                    
                    $userid = mysql_insert_id();
                    $link_active = base_url()."home/user/active/?userid=".$userid."&key=".md5($salt);
                    $message  = "Please follow this link to active your acount <br/>".
                    $message .= "Link : <a href=".$link_active.">".$link_active."</a><br/>";
                    $message .= "username : ".$add['username']."<br/>";
                    $message .= "password : ".$this->input->post("password");
                    
                    $mail = array(
                            "to_receiver"   => $add['email'], 
                            "message"       => $message,
                        );
                        
                    $this->load->library("my_email");
                    $this->my_email->config($mail);
                    $this->my_email->sendmail();
                    
                    redirect(base_url()."admin/user"); 
                }
                
                $this->my_layout->view("add_view",$data);
        }

    }


    //--- Cap nhat user
    function edit(){
        $userid = $this->uri->segment(4);
        $data['info'] = $this->muser->getInfo($userid);
       
        if(is_numeric($userid) && $data['info']!=NULL)
        {
            
            if(isset($_POST['ok']))
            {
                $this->form_validation->set_rules("full_name","Full name","required|min_length[6]");
                $this->form_validation->set_rules("username","Username","required|max_length[25]|callback_checkUser");
                $this->form_validation->set_rules("password","Password","matches[repassword]");
                $this->form_validation->set_rules("email","Email","required|valid_email|callback_checkEmail");
                $this->form_validation->set_rules("address","Address","required");
                $this->form_validation->set_rules("phone","Phone number","required|callback_validPhone");
                $this->form_validation->set_rules("gender","Gender","required");

                $data['error'] = "";
                if($this->form_validation->run()==FALSE){
   
                    $this->my_layout->view("edit_view",$data);
                
                }else{
                    
                      $update = array(
                                    "full_name" => $this->input->post("full_name"),
                                    "username"  => $this->input->post("username"),
                                    "email"     => $this->input->post("email"),
                                    "address"   => $this->input->post("address"),
                                    "phone"     => $this->input->post("phone"),
                                    "level"     => $_POST['level'],
                                    "gender"    => $_POST['gender'],
                                    "update_date"  => date("Y-m-d H:i:s"),
                                 );
                      if($this->input->post("password")!="")
                      {
                         $update['password'] = md5($this->input->post("password"));
                      }
                      
                      $this->muser->updateUser($update,$userid);
                      redirect(base_url()."admin/user"); 
                }
            }
            else
            {
                $this->my_layout->view("backend/user/edit_view",$data);   
            }
            
        }
        else
        {
            
            $data['report'] = "Đường dẫn không hợp lệ";
            $this->my_layout->view("backend/report",$data);
        }
    }
    
    //--- Xoa user
    function delete(){
        $userid = $this->uri->segment(4);
        
        if(is_numeric($userid)){
            
            $this->muser->deleteUser($userid);
            redirect(base_url()."admin/user");
        
        }else{
            
            $data['report'] = "Duong dan khong hop le";
            $this->my_layout->view("backend/report",$data);
        }
    }
    
    //--- Kiểm tra user hợp lệ
    function checkUser($username)
    {
        $id = $this->uri->segment(4);
        if($this->muser->getUser($username,$id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkUser","Your username has been register, please try again");
            return FALSE;
       }
    }
    
    //---- Kiem tra Email
    function checkEmail($email)
    {
        $id = $this->uri->segment(4);
        if($this->muser->checkEmail($email,$id)==TRUE){
            return TRUE;
        }
        else{
            $this->form_validation->set_message("checkEmail","Email has been exit, please try again");
            return FALSE;
        }
    }

    function validPhone($phone){
        /*
         *  Số hợp lệ :
            -   084.08.37610471 : true
            -  (084).(08).37610471 : true
            -  (084.08).7610471 : false
         *
         * 
         */
        $rule1="^[0-9]{3}\.[0-9]{2}\.[0-9]{8}$";
        $rule2="^\([0-9]{3}\)\.\([0-9]{2}\)\.[0-9]{8}$";
        if(eregi($rule1,$phone) || eregi($rule2,$phone) ){
                return TRUE;
        }
        else{
                $error = "The phone numser is not avaliable ! It's must be 084.08.37610475 or (084).(08).37610475 or (084.08).7610475";
                $this->form_validation->set_message("validPhone",$error);
                return FALSE;
        }
    }
    
}
?>

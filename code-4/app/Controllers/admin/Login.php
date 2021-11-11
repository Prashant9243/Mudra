<?php 

namespace App\Controllers\admin;
use App\Controllers\BaseController;

class Login extends BaseController
{
	function __construct()
    {
        //parent::__construct();

        helper('send_email');
		
		helper('cookie');

        model('Admin_model');
    }
		
	public function index()
	{
		if($_POST)
        {
            $uname = trim($this->input->post('username', TRUE));
            $pass = trim($this->input->post('password', TRUE));

            $where = array(
                        'username'  => $uname,
                        'password'  => $pass
                    );
			
            $getDetails = $this->Admin_model->getWhere('admin', $where);
			//echo $this->db->last_query();exit;
            if($getDetails && $getDetails[0]->username && ($getDetails[0]->user_type == 1))
            {
				if($this->input->post('remember_me'))
				{
					set_cookie('username',$uname,0);
					set_cookie('password',$pass,0);
				}
                $session = array(
                                'admin_userid'		=>	$getDetails[0]->id,
                                'admin_username'	=>	$getDetails[0]->username,
                                'admin_type'		=>	$getDetails[0]->user_type,
                                'logged_in' 		=>	TRUE,
								'admin_image'		=>	$getDetails[0]->image_data
                            );
                $this->session->set_userdata($session);
                redirect(base_url().'admin/dashboard');
            }
			else if($getDetails && $getDetails[0]->username && ($getDetails[0]->user_type == 2))
			{
				$session = array(
                                'admin_userid'		=>	$getDetails[0]->id,
                                'admin_username'	=>	$getDetails[0]->username,
                                'admin_type'		=>	$getDetails[0]->user_type,
                                'logged_in' 		=>	TRUE,
								'admin_image'		=>	$getDetails[0]->image_data
                            );
                $this->session->set_userdata($session);
                redirect(base_url().'manager/dashboard');
			}
            else
            {
                $this->messages->add('Invalid Username or Password', "alert-danger");
            }
        }
		return view('admin/login/login');
	}
}
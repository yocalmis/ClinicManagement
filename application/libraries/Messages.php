<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages {



    function head()
    {

        
    }


    function foot()
    { 



    }

    function yetkisiz_alan($url)
    {

        $msg=new messages();
        $msg->head();

        echo"<h3>Unauthorized page...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }


    function True_Add($url)
    {

        $msg=new messages();
        $msg->head();

        echo"<h3>Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }

    function False_Add($url)
{

    $msg=new messages();
    $msg->head();

    echo"<h3>Operation failed ...</h3>";
    echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
    $msg->foot();

}

   function True_Pay($url)
    {
        $msg=new messages();
        $msg->head();

        echo"<h3>Operation succesfull ...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }

    function False_Pay($url)
    {
        $msg=new messages();
        $msg->head();

        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();

    }

    function True_Delete($url)
    {
        $msg=new messages();
        $msg->head();

        echo"<h3>Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }

    function False_Delete($url)
    {
        $msg=new messages();
        $msg->head();

        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();

    }


    function True_Add_Message($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
  function True_Add_user_Message($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull , Please check your mail inbox....</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	
	 function New_Pass($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull, password recovery mail has been sent...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	 function New_Pass_True($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	 function New_Pass_False($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed ...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	 function Wishlist_false($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3> Operation failed ...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }	
	
		 function Wishlist_true($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3> Operation succesfull ...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }	
	
		 
	
		 function Wishlist_remove_false($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3> Operation failed ...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }	
	
		 function Wishlist_remove_true($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3> Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="3;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	
	 function Dondur_False($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
	 function Dondur_True($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
		 function Message_Ok($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
			 function Message_False($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
    function False_Add_Message($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }

    function True_Onay_Message($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation succesfull...</h3>";

        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }
	
	    function False_Onay_Message($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
	    function False_Bulunamadi($url)
    {

        $msg=new messages();
        $msg->head();
        echo"<h3>No such mail address found...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();
		

    }	
	
	
    function Empty_Add_Message_Admin($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Please fill empty space...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }


    function Empty_Add_Message_User($url)
    {

        $msg=new messages();
        $msg->head();

        echo"<h3>Please fill empty space...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();


    }



    function Pass_Error($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Your passwords must be the same...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	
	   function Pass_Error_2($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Please check the password length...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }
	

    function Pass_Check()
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Please check the password...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }



    function File_Error($url)
    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Operation failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();

    }




    function Welcome($url,$online)


    {

        $msg=new messages();
        $msg->head();
        echo"<h3>Welcome ".$online." redirecting...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }

    function Welcome_User($url,$user)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Welcome ".$user." redirecting...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }

    function Welcome_False($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Login failed...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }


    function Logout($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Logout succesfull, redirecting...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();

    }



    function config($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>Redirecting...</h3>";
        echo '<meta http-equiv="refresh" content="0;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }

    function config2($url)


    {
        $msg=new messages();

        echo"<h3>Redirecting...</h3>";
        echo '<meta http-equiv="refresh" content="0;url='.base_url().''.$url.'"/>';
    }

    function search_error($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>The word length must be at least 3 letters, try again...</h3>";
        echo '<meta http-equiv="refresh" content="2;url='.base_url().''.$url.'"/>';
        $msg->foot();
    }





 
    function To_Login($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>You must login first...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';

        $msg->foot();
    }


    function To_Register($url)


    {
        $msg=new messages();
        $msg->head();
        echo"<h3>
You must register first...</h3>";
        echo '<meta http-equiv="refresh" content="1;url='.base_url().''.$url.'"/>';
        $msg->foot();

    }




   






}

?>
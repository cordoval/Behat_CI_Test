<?php
/**
 * Login view for the OWCN Web Application.
 *
 * The views/main/login.php view displays a login form.
 *
 * @author DCCS Bakers
 * @version 0.1
 * @package OWCN
 * @subpackage OWCN_View
 * @filesource
 */
?>

<?php
	$data['body_tag_commands'] = '';
	$this->load->view('header', $data);
?>

<br />

<div class="form_content" align="left">

 <form action="<?php echo base_url() ?>account/login_validate" method="post" name="login" id="login">
  <table width="100%">
   <tr>
    <td width="40%" valign="top">
     <span class="calteach_title">Login to the OWCN Dasta Management Application</span>
     <br />
     <?php
       if ( (isset($errormsg) and $errormsg == 1) and isset( $errortext) ) { 
         echo  $this->app_includes->display_message(1, $errortext);
       }
     ?>
     <br />
     <div align="left">
      <label for="email" class="form_label">Email:</label><br />
      <input name="email" type="text" class="form_text" id="email" value="<?php echo set_value('email') ?>" />
     </div>
     <br />
     <div align="left">
      <label for="password" class="form_label">Password:</label><br />
      <input name="password" type="password" class="form_text" id="password" />
     </div>
     <br />
     <input name="submit" type="submit" class="form_submit" id="submit" value="Login" />
    </td>
    <td style="border-left:1px solid #666666; padding:0px 20px;" valign="top">
     <span class="calteach_title">Not Registered?</span><br />
     <br /><a href="<?php echo site_url() ?>/account/register" style="font-size:12px;">Click Here To Register</a>
    </td>
   </tr>
 </table>
</form>

</div>

<br />

<?php
  if ($_SERVER['HTTP_HOST'] == "calteachdev.ucdavis.edu") {
    echo <<<EOS
<div align="center">
 <div style="border:5px #FF0000 solid; width:350px; height:50px; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#FF0000; padding:4px;" align="center">
  <b>WARNING</b> This is a development system.<br />Please Access The Production System At: <a href="http://calteach.ucdavis.edu">http://calteach.ucdavis.edu</a> 
 </div>
</div>
EOS;
  }
?>

<?php
  # Standard Footer
  $this->load->view('footer.php');	
?>



<?php
    $data = $mail_format->get_mail_formatbyfields(@$_REQUEST['mf_id'],"");
?>
<!-- Content Start -->
<form action="" id="form" name="form" method="post" enctype="multipart/form-data">
    
    <div class="row">
        <div class="col-lg-6">
                   <label for="category" class="control-label"><?php echo $lang->lang['category']; ?> :</label>
                       <div class="form-group">
                              <select class='form-control input-sm search_verify' name="category_name" >
                                  <option value="" selected disabled>Select Category</option>
                                  <option value="Representative Invitation Mail" <?php if($_REQUEST['mf_id'] == '21') { ?> selected="selected"<?php } ?>>Representative Invitation Mail</option>
                                     <option value="aaa"<?php if($_REQUEST['mf_id'] == '27') { ?> selected="selected"<?php } ?>>aaa</option>
                              </select>
                     </div>
         </div>
        <div class="col-lg-6">
            <div class="form-group">
              <label for="mail_type" class="control-label">Subject</label>
              <input type="text" name="subject" id="subject" value="<?php echo $data['subject']; ?>" class="form-control input-sm required">
             </div>
        </div>
         </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6">
          
            <div class="form-group">
                  <label for="mail_subject" class="control-label">Body</label>
                        <textarea name="body" id="body" class="form-control input-sm required"><?php echo $data['body']; ?></textarea>
                        <span id="emailbody"></span>
            </div>
        </div>
        <div class="col-lg-6">
                
<!--            <table>
                <tr>
                  <td><b style="color: red">NOTE:</b></td>  
                  <td></td>  
                </tr>
                <tr>
                  <td><b>%%MEMBER_FIRSTNAME%% - </b></td>  
                  <td>Member Firstname</td>  
                </tr>
                <tr>
                  <td><b>%%MEMBER_LASTNAME%% - </b></td>  
                  <td>Member Lastname</td>  
                </tr>
                <tr>
                  <td><b>%%AGENT_FIRSTNAME%% - </b></td>  
                  <td>Agent Firstname</td>  
                </tr>
                <tr>
                  <td><b>%%AGENT_LASTNAME%% - </b></td>  
                  <td>Agent Lastname</td>  
                </tr>
                <tr>
                  <td><b>%%AGENT_SUBURB%% - </b></td>  
                  <td>Agent Suburb</td>  
                </tr>
                <tr>
                    <td><b>%%EDUCATIONAL_PAGE_LINK%% - </b> &nbsp;&nbsp;&nbsp;</td>  
                  <td>Educational page Link</td>  
                </tr>
                <tr>
                  <td><b>%%AGENT_EMAIL%% - </b></td>  
                  <td>Agent Email</td>  
                </tr>
            </table>-->
        </div></div>
        <div class="row col-lg-12">
             <div class="col-lg-2"> 
            <div class="form-group">
                <input type="hidden" name="is_active" value="1">
                <?php if (isset($_REQUEST['mf_id'])) { ?>
                      <input type="button" name="update" id="update" value="<?php echo $lang->lang['update']; ?>" class="btn btn-primary btn-sm" onclick="update_data('<?php echo TBL_MAIL_FORMAT; ?>', 'mf_id', '<?php echo $_REQUEST['mf_id'] ?>', 'email_template',this.form)" >
                <?php } else { ?>
                      <input type="button" name="create" id="create" value="<?php echo $lang->lang['add']; ?>" class="btn btn-primary btn-sm" onclick="insert_data('<?php echo TBL_MAIL_FORMAT; ?>', 'email_template', this.form);" >
                <?php } ?>
                      <a class="btn btn-primary btn-sm " href="email_template"><?php echo $lang->lang['cancel']; ?></a>
           </div></div>
   </div>
    </form>
<script>
CKEDITOR.replace("body");
</script>
<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      
      
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h1 style="text-align: center"> Are you sure to removed this USER ?</h1>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($user)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('user/save').'/'.$user['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('user/save');?>">
            <?php } ?>
            <div class="box-body">
               
                      <input type="hidden" value="<?php echo !empty($user) ? $user['id'] : $code_user;?>" id="code" class="form-control" disabled/>
                      <input type="hidden" name="id" value="<?php echo !empty($user) ? $user['id'] : $code_user;?>" id="id" class="form-control"/>
                    
                    

                     

                    
                
                      <input type="hidden" value="<?php echo !empty($user) ? $user['fullname'] : '';?>" name="fullname" placeholder="Enter fullname" id="fullname" class="form-control" required/>
                 
                    
                    <input type="hidden" value="<?php echo !empty($user) ? $user['email'] : '';?>" name="email" placeholder="Enter Email" id="email" class="form-control" required/>
                   
                   
                      <input type="hidden" value="<?php echo !empty($user) ? $user['address'] : '';?>" name="address" placeholder="Enter Address" id="address" class="form-control" required/>
                  
                  
                    <input type="hidden" id="birthday" value="<?php echo !empty($user) ? $user['birthday'] : '';?>" name="birthday"min="1979-01-01" max="2022-12-31" style="width: 400%;" required/>
                      
                 
                      <input type="hidden"  onkeypress="return isNumeric(event)"  oninput="maxLengthCheck(this)" value="<?php echo !empty($user) ? $user['contact'] : '';?>" name="contact" placeholder="contact" id="contact" min="1" max="99999999999" class="form-control" required/>
                  
                      <input type="hidden" value="<?php echo !empty($user) ? $user['username'] : '';?>" name="username" placeholder="Enter Username" id="username" class="form-control" required/>
                     
                  
                  
                    <input type="hidden"  minlength = "5" type="password" value="<?php echo !empty($user) ? $user['password'] : '';?>" name="password" placeholder="Enter password" id="password" class="form-control" required/>
                     
                   
                   
                      
                    <input   type="hidden" value="<?php echo !empty($user) ? $user['recovery'] : '';?>" name="recovery" placeholder="Enter your answer" id="recovery_question" class="form-control" required/>




                      <input type="hidden" value="<?php echo !empty($user) ? $user['date'] : date('Y-m-d H:i:s');?>" id="date" class="form-control" />

                      <input type="hidden" name="date1" value="<?php echo !empty($user) ? $user['date'] : date('Y-m-d H:i:s');?>" id="date1" class="form-control"/>










                       <input type="hidden" name="status" value="Deleted" id="status" class="form-control"/>
                  
                      <input type="hidden" value="delete User" name="activity"  id="activity" class="form-control"/>
                     <input type="hidden" value="<?php echo $this->username;  ?>" name="username1"  id="username1" class="form-control"/>

                    
                
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-5">
                  <a class="btn btn-danger" href="<?php echo site_url('user');?>">Cancel</a>
                  <button class="btn btn-success pull-right" type="submit">REMOVE</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		</div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>
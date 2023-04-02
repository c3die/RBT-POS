<?php $this->load->view('element/head');?>
   
    <div class="content-wrapper">
        
        <section class="content-header">
            <h1>
            USER 
             
            </h1>
        </section>

        
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li role="presentation"><a href="<?php echo site_url('user/create');?>">Add Customer</a></li>
                        <li role="presentation" class="active"><a href="<?php echo site_url('user');?>">List Customer</a></li>
                    </ul>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table User</h3>
                        </div>
                       
                        <div class="box-body">
                            <form action="<?php echo site_url('user?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <?php echo search_form('user');?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Search" class="form-control btn btn-warning">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('user/export_csv').get_uri();?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>fullname</th>
                                    <th>email</th>
                                    <th>address</th>
                                    <th>contact</th>
                                    <th>username</th>
                                    <th>password</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($users) && is_array($users)){ ?>
                                    <?php foreach($users as $user){?>
                                        <tr>
                                            <td><?php echo $user->id;?></td>
                                            <td><?php echo $user->fullname;?></td>
                                            <td><?php echo $user->email?></td>
                                            <td><?php echo $user->address;?></td>
                                            <td><?php echo $user->contact;?></td>
                                            <td><?php echo $user->username;?></td>
                                            <td><?php echo $user->password;?></td>
                                            <td>
                                                <a href="<?php echo site_url('user/edit').'/'.$user->id;?>" class="btn btn-xs btn-primary">Edit</a>
                                                <a href="<?php echo site_url('user/cancel').'/'.$user->id;?>" class="btn btn-xs btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                               
                            </table>
                        </div>
                       
                        <div class="text-center">
                            <?php echo $paggination;?>
                        </div>
                    </div>
                    
                </div>
              
            </div>
         
        </section>
    
    </div>
  
<?php $this->load->view('element/footer');?>
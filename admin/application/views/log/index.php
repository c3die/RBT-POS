<?php $this->load->view('element/head');?>
   
    <div class="content-wrapper">
        
        <section class="content-header">
            <h1>
        Log 
             
            </h1>
        </section>

        
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                  
                    <div class="box">
                        <div class="box-header">
                          
                        </div>
                       
                        <div class="box-body">
                             <form action="<?php echo site_url('log?search=true');?>" method="GET">
                                <input type="hidden" class="form-control" name="search" value="true"/>
                                <div class="box-body pad">
                                    <?php echo search_form('log');?>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <input type="submit" value="Search" class="form-control btn btn-warning">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="submit">&nbsp</label>
                                            <a href="<?php echo site_url('log/export_csv').get_uri();?>" class="form-control btn btn-info"><i class="fa fa-file-csv"></i> Export Excel</a>
                                        </div>
                                    </div>
                                </div>
                              </form>
                              <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                   
                                   
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($log) && is_array($log)){ ?>
                                    <?php foreach($log as $log){?>
                                        <tr>
                                            <td><?php echo $log->log_name;?></td>
                                            <td><?php echo $log->activity;?></td>
                                            <td><?php echo $log->name?></td>
                                            <td><?php echo $log->date;?></td>
                                         

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
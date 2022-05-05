                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Font</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                         <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?=base_url('Font')?>">Font</a></li>
                                        <li class="breadcrumb-item active">Add</li>
                                    </ol>
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->

                        <div class="row">
                            <div class="col-lg-6">
								<?php $this->load->view('include/msgs'); ?>
                                <div class="card m-b-30">
                                    <div class="card-body">
        
                                        <h4 class="mt-0 header-title">Add Font</h4><br>
                                      
        
                                        <form action="<?=base_url('Font/create')?>" method="post" enctype="multipart/form-data" name="diviverse_form" id="diviverse_form">
											<div class="form-group">
                                                <label>Font Name</label>
                                                <input type="text" name="name" id="name" class="form-control" required placeholder="Font Name"/>
                                            </div>
											<div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="image" id="image" class="form-control" required />
                                            </div>
											<div class="form-group">
                                                <label>Description</label>
                                                <textarea  name="description" id="description" class="form-control" required /></textarea>
                                            </div>
        
                                         
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Submit
                                                    </button>
                                                    <a href="<?=base_url('Font')?>" class="btn btn-secondary waves-effect m-l-5">
                                                        Cancel
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
        
                                    </div>
                                </div>
                            </div> <!-- end col -->
        
                        </div> <!-- end row -->      

                        
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->
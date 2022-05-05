
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Industry</h4>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?=base_url('Industry')?>">Industry</a></li>
                                        <li class="breadcrumb-item active">Edit</li>
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
        
                                        <h4 class="mt-0 header-title">Edit Industry</h4><br>
                                      
        
                                       <form action="<?=base_url('Industry/update/'.$record['id'])?>" method="post" enctype="multipart/form-data" name="diviverse_form" id="diviverse_form">
											<div class="form-group">
                                                <label>Industry Name</label>
                                                <input type="text" name="name" id="name" class="form-control required" value="<?=$record['name']?>" placeholder="Industry Name"/>
                                            </div>
											<div class="form-group">
                                                <label>Image</label>
                                                <input type="file" name="image" id="image" class="form-control"  />
                                            </div>
											<div class="form-group">
                                                <label>Description</label>
                                                <textarea  name="description" id="description" class="form-control" required /><?=$record['description']?></textarea>
                                            </div>
											<div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control required">
													<?php 
													$active = $record['status']=='1'?'selected':'';
													$inactive = $record['status']=='2'?'selected':'';
													?>
													<option value="2" <?=$inactive?>>Inactive</option>
													<option value="1" <?=$active?> >Active</option>
												</select>							
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                        Submit
                                                    </button>
                                                    <a href="<?=base_url('Industry')?>" class="btn btn-secondary waves-effect m-l-5">
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
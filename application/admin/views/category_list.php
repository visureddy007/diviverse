
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Category
									&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?=base_url('Category/add')?>" class="btn btn-info" title="Add Category" ><i class="fa fa-plus"></i> Add</a>
									</h4>
                                </div>
                                <div class="col-sm-6">
								
                                    <ol class="breadcrumb float-right">
                                        <li class="breadcrumb-item"><a href="<?=base_url('dashboard')?>">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Category</li>
                                    </ol>
										
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end page-title -->

                        <div class="row">
                            <div class="col-12">
								<?php $this->load->view('include/msgs'); ?>
                                <div class="card m-b-30">
                                    <div class="card-body">
									    <table id="data-table" data-module="category" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
												<thead>
													<tr>													
														<th>#</th>
														<th>Name</th>
														<th>Status</th>
														<th>Created On</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
										</table>
 								  </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
          
                    </div>
                    <!-- container-fluid -->

                </div>
                <!-- content -->

                

       
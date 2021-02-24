<x-dynamic-component :component="$app->componentName">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile Personal Information-->
			<div class="d-flex flex-row">
				<!--begin::Content-->
				<div class="flex-row-fluid ml-lg-8">
					<!--begin::Card-->
					<div class="card card-custom card-stretch">
						<!--begin::Header-->
						<div class="card-header py-3">
							<div class="card-title align-items-start flex-column">
								<h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
							</div>
						</div>
						<!--end::Header-->
						
							
							<div class="card-body">
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h5 class="font-weight-bold mb-6">Customer Info</h5>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Name</label>
									<div class="col-lg-9 col-xl-6">
										<input type="text" class="form-control" placeholder="Enter name" name="name" value="{{$objs->name}}">
									</div>
								</div> 
								<div class="row">
									<label class="col-xl-3"></label>
									<div class="col-lg-9 col-xl-6">
										<h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Phone</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="la la-phone"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-lg form-control-solid" value="{{$objs->phone}}" placeholder="Phone" />
										</div>
										
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="la la-at"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-lg form-control-solid" value="{{$objs->email}}" placeholder="Email" />
										</div>
									</div>
								</div>
								
								<div class="form-group row">
									<label class="col-xl-3 col-lg-3 col-form-label text-right">Role</label>
									<div class="col-lg-9 col-xl-6">
										<div class="input-group input-group-lg input-group-solid">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="la la-at"></i>
												</span>
											</div>
											<input type="text" class="form-control form-control-lg form-control-solid" value="{{$objs->role}}" placeholder="Email" />
										</div>
									</div>
								</div>	
							</div>
								
						</div>
							<!--end::Body-->
					</div>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Profile Personal Information-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>
<!--end::Content-->
					
				
</x-dynamic-component>
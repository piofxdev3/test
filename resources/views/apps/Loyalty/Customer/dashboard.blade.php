<x-dynamic-component :component="$app->componentName">

	<div id="customer_chart_data" data-value="{{ $customers }}">
	</div>
	<div id="rewards_data" data-value="{{ $rewards }}">
	</div>

	<div class="container text-white p-3 mb-3 rounded" style="background: #1d3557;">
		<h5>Filter:</h5>
		<form action="{{ route('Dashboard') }}" method="GET" class="d-flex" id="filter_form">
			<select class="form-control form-select border-0 text-white" style="background: #457b9d;" name="filter" onchange="filter_charts_result()">
				<option value="today" @if($filter ?? ""){{$filter == 'today' ? "selected" : "" }}@endif>Today</option>
				<option value="this_week" @if($filter ?? ""){{$filter == 'this_week' ? "selected" : "" }}@endif>Last 7 days</option>
				<option value="this_month" @if($filter ?? ""){{$filter == 'this_month' ? "selected" : "" }}@endif>This Month</option>
				<option value="this_year" @if($filter ?? ""){{$filter == 'this_year' ? "selected" : "" }}@endif>This Year</option>
				<option value="all_data" @if($filter ?? ""){{$filter == 'all_data' ? "selected" : "" }}@endif>All Data</option>
			</select>
		</form>
	</div>

	<div class="row">
		<div class="col-12 col-lg-9">
			<div class="row my-2">
				<div class="col-12 col-lg-6 align-middle" style="max-height: 150px;">
					<!--begin::Engage Widget 2-->
						<div class="d-flex p-0">
							<div class="flex-grow-1 bg-danger p-8 card-rounded bgi-no-repeat" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 90%; background-image: url({{ asset('themes/metronic/media/svg/humans/custom-3.svg') }})">
								<h3 class="text-inverse-danger mt-2 font-weight-bolder"><a href="{{ route('Customer.index', $filter) }}" class="text-inverse-danger">New Customers</a></h3>
								<h1 class="text-white">{{ $new_customers }}</h1>
							</div>
						</div>
					<!--end::Engage Widget 2-->
				</div>
				<div class="col-12 col-lg-6 mt-3 mt-lg-0" style="max-height: 150px">
					<!--begin::Engage Widget 3-->
					<div class="d-flex p-0">
						<div class="flex-grow-1 p-8 card-rounded flex-grow-1 bgi-no-repeat" style="background-color: #663259; background-position: 100% bottom; background-size: auto 90%; background-image: url({{ asset('themes/metronic/media/svg/humans/custom-4.svg') }})">
							<h3 class="text-inverse-danger mt-2 font-weight-bolder"><a href="{{ route('Customer.index', 'all_data') }}" class="text-inverse-danger">Total Customers</a></h3>
							<h1 class="text-white">{{ $total_customers }}</h1>
						</div>
					</div>
					<!--end::Engage Widget 3-->
				</div>
			</div>
																		
			<!--begin::Card-->
			<div class="card card-custom gutter-b mt-7 mt-lg-5">
				<div class="card-header">
					<div class="card-title">
						<h3 class="card-label">Customers</h3>
					</div>
				</div>
				<div class="card-body">
					<!--begin::Chart-->
					<div id="customers_chart"></div>
					<!--end::Chart-->
				</div>
			</div>
			<!--end::Card-->

			<div class="row mt-3">
				<div class="col-12">
					<!--begin::Card-->
					<div class="card card-custom gutter-b">
						<div class="card-header">
							<div class="card-title">
								<h3 class="card-label">Credits/Redeem</h3>
							</div>
						</div>
						<div class="card-body">
							<!--begin::Chart-->
							<div id="rewards_chart"></div>
							<!--end::Chart-->
						</div>
					</div>
					<!--end::Card-->
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-3 mt-1">	
			<div class="bg-white p-5 rounded shadow">
				<h3 class="text-center text-muted my-3">Transactions</h3>		

				<div class="timeline timeline-1">
					<div class="timeline-sep bg-primary-opacity-20"></div>
					@foreach($reward_transactions as $r_t)
						<div class="timeline-item">
							<div class="timeline-label ">{{ $r_t->created_at ? $r_t->created_at->diffForHumans() : "" }}</div>
							<div class="timeline-badge">
								<i class="fas fa-{{ $r_t->credits != 0 ? 'piggy-bank' : 'donate'}} {{ $r_t->credits != 0 ? 'text-success' : 'text-danger' }}"></i>
							</div>
							<div class="timeline-content text-muted font-weight-normal">
								{{ $r_t->customer->name }} {{$r_t->credits !=0 ? ' got credited': ' redeemed'}}
								<span class="label label-inline {{ $r_t->credits != 0 ? 'label-light-success' : 'label-light-danger' }} font-weight-bolder">{{ $r_t->credits != 0 ? $r_t->credits : $r_t->redeem }}</span>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!--end::Container-->
		
</x-dynamic-component>
@php
    function initials($str) {
        $ret = '';
        foreach (explode(' ', $str) as $word)
            $ret .= strtoupper($word[0]);
        return $ret;
    }
@endphp 

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title>Piofx Media</title>
		<meta name="description" content="Page with empty content" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		@include('components.themes.metronic7.blocks.styles')
		<link rel="shortcut icon" href="{{ asset('favicon_piofx.ico') }}" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body style="max-width= 100vw; overflow-x: hidden; background: #fff6cc;">

        <div class="container-fluid d-flex justify-content-center text-left my-5">
            <div class="row loyalty_main">
                <div class="col-5 d-flex justify-content-center align-items-center pl-5" style="min-height: 15rem;">
                    <div>
                        <h1 class="" style="color: #88c0c2;">There's only one thing that matters</h1>
                        <h1 class="text-dark font-weight-bolder">Customer Satisfaction</h1>
                        <!-- <a href="#reward_form" class="btn btn-light-danger mt-5">Check your rewards</a> -->
                    </div>
                </div>
                <div class="col-7 mt-5 mt-lg-0">
                    <img src="{{ asset('img/Giveaway.png') }}" alt="" class="img-fluid" width="500">
                </div>
            </div>
        </div>

        <!--begin::Container-->
        <div class="container-fluid my-5" style="max-width: 100rem;">
            @if($alert ?? "")
                @guest
                    <div class="container-lg mt-3">
                        <!--begin::Engage Widget 7-->
                        <div class="card card-custom card-stretch gutter-b">
                            <div class="card-body d-flex p-0">
                                <div class="flex-grow-1 p-12 card-rounded bgi-no-repeat d-flex flex-column justify-content-center align-items-start shadow" style="background-color: #FFF4DE; background-position: right bottom; background-size: auto 100%; background-image: url({{ asset('themes/metronic/media/svg/humans/custom-8.svg') }})">
                                    <h3 class="text-danger font-weight-bolder m-0">No records found</h3>
                                    <h5 class="text-dark-50 font-size-xl font-weight-bold">Please contact the Sales Executive</h5>
                                </div>
                            </div>
                        </div>
                        <!--end::Engage Widget 7-->
                    </div>
                @endguest
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url()->current() }}" class="my-5 p-8" id="reward_form" style="background: #fceeb0; border-radius: 2rem;">
                <h2 class="text-center text-dark font-weight-bolder">Know your Credits</h2>
                <h3 class="font-weight-bolder mt-3 text-center"><span style="color: #de9244;"> Redeemable</span></h3>
                <h5 class="mt-10" style="color: #88c0c2;">Enter your Phone Number:</h5>
                <input type="text" id="phone_number_input" name="phone" class="form-control mb-3" value="{{ $phone ?? "" }}" required>
                <button type="submit" class="btn btn-danger">Search</button>
            </form>

            @if($objs ?? "")
                @if($remaining_credits ?? '')
                    <div class="container bg-white rounded-lg p-5 my-7" style="max-width: 100rem;">
                        <div class="d-flex justify-content-between align-item-center p-5">
                            <div>
                                <h3>Hello, {{$objs[0]->customer->name}} 👋</h3>
                                <h1>Welcome back!</h1>
                            </div>
                            <div>
                                <!--begin::Pic-->
                                <a href="{{ route('Customer.show', $objs[0]->customer_id) }}">
                                    <div class="flex-shrink-0 mr-7">
                                        <div class="symbol symbol-light-danger">
                                            <span class="font-size-h3 symbol-label font-weight-boldest">{{ initials($objs[0]->customer->name) }}</span>
                                        </div>
                                    </div>
                                </a>
                                <!--end::Pic-->
                            </div>
                        </div>
                        <div class="row mt-5 text-dark">
                            <div class="col-12 col-lg-6 d-flex align-items-center">
                            <div>
                                    <div class="card-body d-flex align-items-center">
                                        <div class="">
                                            <div class="d-flex align-items-center">
                                                <h1 class="font-weight-bolder mr-3 d-flex align-items-center"><a href="{{ route('Customer.show', $objs[0]->customer_id) }}" class="text-dark">{{ $remaining_credits }} Credits</a></h1>
                                            </div>
                                            
                                            <h3 class="text-danger">Remaining Balance</h3>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="col-12 col-lg-6 d-flex justify-content-end">
                                <img src="{{ asset('img/reward-2.webp') }}" class="img-fluid img-lg-block" width="400">
                            </div>
                        </div>
                    </div>

                    @auth
                        <!--begin::Tiles Widget 25-->
                        <div class="card card-custom bgi-no-repeat bgi-size-cover gutter-b bg-dark mt-7 d-flex justify-content-center" style="height: 250px; background-image: url({{ asset('themes/metronic/media/svg/patterns/taieri.svg') }}">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <form action="{{ route($app->module.'.store') }}" class="text-white" method="POST">
                                            @csrf
                        
                                            <div class="d-block d-lg-flex align-items-center">
                                                <!-- <label>Credit:</label> -->
                                                <input type="text" class="form-control form-control-lg bg-dark border-0 text-white" style="background-color: #303651 !important" name="credit" placeholder="Credit">

                                                <!-- <label>Redeem:</label> -->
                                                <input type="text" class="form-control form-control-lg mt-3 mt-lg-0 ml-lg-3 border-0 text-white" name="redeem" style="background-color: #303651 !important" placeholder="Redeem">
                                            </div>

                                            <input type="text" hidden name="customer_id" value="{{ $obj[0]->customer_id }}">
                                            <input type="text" hidden value="{{ url()->full() }}" name="current_url">
                                            <input type="hidden" name="agency_id" value="{{ request()->get('agency.id') }}">
                                            <input type="hidden" name="client_id" value="{{ request()->get('client.id') }}">
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            <button type="submit" class="btn btn-lg btn-light-danger btn-shadow font-weight-bold mt-3 px-4">Add</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Tiles Widget 25-->
                    @endauth
                @else
                    @auth
                        <div class="my-10" style="max-width=100rem;">
                            <div class="p-7 mt-5 text-dark rounded shadow" style=" background: #88c0c2;">
                                <h1 class="text-center text-white mb-5">Create Customer</h1>
                                <form action="{{ route('Customer.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3 mt-4">
                                        <div class="col-12 col-lg-6">
                                            <label >Name:</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label>Phone:</label>
                                            <div class="input-group">
                                                <span class="input-group-text">+91</span>
                                                <input type="text" class="form-control" name="phone" id="phone_number_output" required>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="mt-3">Email:</label>
                                    <input type="email" class="form-control" name="email" required>
                                    <label class="mt-3">Address:</label>
                                    <textarea type="text" class="form-control" name="address" required></textarea>
                                    <label class="mt-3">Credits:</label>
                                    <input type="text" class="form-control" name="credits" required>
                                    <input type="text" hidden value="{{ url()->full() }}" name="current_url">
                                    <input type="hidden" name="agency_id" value="{{ request()->get('agency.id') }}">
                                    <input type="hidden" name="client_id" value="{{ request()->get('client.id') }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-light-danger px-4 mt-4">Create</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                @endif
            @endif

        </div>

        
		
		@include('components.themes.metronic7.blocks.scrolltop')
		@include('components.themes.metronic7.blocks.scripts')
	</body>
	<!--end::Body-->
</html>



@extends('../layouts.app')

@section('content')

<div class="container">
	<h1 class="mb-1">Order # {{ $order->id }}</h1>
	<p class="mb-4">Quoted <b>${{ $order->cost }}</b></p>

	<div class="row">
		<div class="col-sm-6">

			<h2 class="hdln_2-2 mb-0">Options</h2>

			<table class="table">
				@foreach($choseOptions as $opt)

					<tr>
						<th>{{ $opt->attribute }}:</th>
						<td>{{ $opt->name }}</td>
						<td>${{ $opt->cost }}</td>
					</tr>

				@endforeach
			</table>

		</div>
		<div class="col-sm-6">

			<h2 class="hdln_2-2 mb-0">Details</h2>

			<table class="table">
				<tr>
					<th>Name:</th>
					<td>{{ $order->name }}</td>
				</tr>
				<tr>
					<th>Email:</th>
					<td><a href="mailto:{{ $order->email }}">{{ $order->email }}</a></td>
				</tr>
				<tr>
					<th>Phone:</th>
					<td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
				</tr>
				<tr>
					<th>Country:</th>
					<td>{{ $order->country }}</td>
				</tr>
				<tr>
					<th>Comments:</th>
					<td>{{ $order->comments }}</td>
				</tr>
			</table>

		</div>
	</div>	

	<a href="{{ route('orders') }}" class="btn">Back to Orders</a>
</div>

@endsection
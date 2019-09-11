@extends('../layouts.app')

@section('content')

<div class="container">
	<h1>Orders</h1>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Date</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Quote</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody>

				@foreach($orders as $order)
					<tr>
						<th scope="row">{{ $order->id }}</th>
						<td>{{ $order->created_at->format('m / d / Y') }}</td>
						<td>{{ $order->name }}</td>
						<td>{{ $order->email }}</td>
						<td>${{ $order->cost }}</td>
						<td>
							<a href="orders/{{ $order->id }}" class="mr-2">View Details</a>
							<span class="color_red btn_delete pointer" data-orderid="{{ $order->id }}">Delete</span>
						</td>
					</tr>
				@endforeach

			</tbody>
		</table>
	</div>

	{{ $orders->links() }}

</div>

<div class="modal-container" id="lb-modal--ays-delete-attr">
	<div class="rwd-modal rwd-modal--ays">

		<div class="rwd-modal__body">
			<p class="no_margin m_top">Are you sure you want to delete this order?</p>
			<div class="modal__ays-btns">
				<div class="btn confirm">Yes</div>
				<div class="btn decline">No</div>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript" src="{{ asset('js/classes/Modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/classes/Message.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/orders.js') }}"></script>

@endsection
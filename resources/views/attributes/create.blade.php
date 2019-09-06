@extends('../layouts.app')

@section('content')

<div class="container">
	<div class="d-flex justify-content-between align-items-center">
		<h1>Add Attributes</h1>
	</div>
	<div class="row">
		<div class="col-12">
			<form action="{{ route('attributes_store') }}" method="post">
				<div class="form-item">
					<label>Attribute Name</label>
					<input type="text" name="name">
				</div>
				<button type="submit" class="btn">Submit</button>
			</form>
		</div>
	</div>
</div>

@endsection
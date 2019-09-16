@extends('../layouts.app')

@section('content')

<div class="container">
	<h1 class="mb-1">Settings</h1>
	<div class="row">

		<div class="col-6">

			<table class="table">
				@foreach($settings as $setting)
					<tr>
						<th><p class="font-sm">{{ $setting->key }}:</p></th>
						<td>
							<form action="settings/{{ $setting->id }}" method="POST" class="form pt-0">
								@csrf()
								<div class="form__input-group ">
									<input class="form__input" type="text" value="{{ $setting->value }}" name="value">
								</div>
								<button class="btn" type="submit">Save</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>

		</div>

	</div>

	@if($errors->any())
	    <div class="row">
	    	<div class="col-12">
	    		@foreach($errors->all() as $error)

	    			<div class="error-box__msg">{{ $error }}</div>

	    		@endforeach
	    	</div>
	    </div>
	@endif

</div>

@endsection
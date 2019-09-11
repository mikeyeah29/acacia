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
							<form class="form pt-0">
								<div class="form__input-group ">
									<input class="form__input" type="text" value="{{ $setting->value }}">
								</div>
								<button class="btn">Save</button>
							</form>
						</td>
					</tr>
				@endforeach
			</table>

		</div>

	</div>
</div>

@endsection
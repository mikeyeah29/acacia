@extends('../layouts.app')

@section('content')

<div class="page_attributes">
	<div class="container">
		<div class="d-flex justify-content-between align-items-center">
			<h1>Edit Attributes</h1>
			<div class="btn btn-blue" id="btn_add_new">Add New Attribute</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				<div class="attributes-list form-items" id="sortable">

					<!-- <div class="attributes-list__item d-flex justify-content-between align-items-center" 
                		 draggable="true"
                		 data-att_id="">
                		<span>@{{ attr.name }}</span>
                		<div class="icon icon-grab"></div>
                	</div> -->

	            </div>
			</div>
			<div class="col-md-9">
				<div class="attribute_section">
					<div class="d-flex">
						<h2 class="attr_title d-inline-block"></h2>
						<div class="icon icon-edit attr_title_edit ml-2"></div>
					</div>
					<div class="d-flex align-items-center mt-2 pointer" id="btn_add_option">
						<i class="icon icon-add mr-2"></i>
						<span>Add Option</span>
						
					</div>
					<div class="option-list mt-5" id="options">
	                    <div class="option-box" v-for="option in options">
	                    	<div class="icon icon-close" v-on:click="removeOption(option)"></div>
	                    	<div class="option-box--img-edit">
		                        <img :src="'storage/' + option.image_path" v-if="option.image_path != 'notyet'">
		                        <div class="no_img" v-if="option.image_path == 'notyet'"></div>
		                    </div>
	                        <div class="d-flex justify-content-between align-items-center option-box__title">
	                            <p class="option-box__name">@{{ option.name }}</p>
	                            <div class="icon icon-edit ml-auto"></div>
	                        </div>
	                    </div>
	                </div>
	                <p class="btn btn_delete_attr color_red mt-5">Delete this attribute and it's options</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal-container {{ $errors->any() ? 'still_open' : '' }}" id="rwd-modal--add-attr">
	<div class="rwd-modal rwd-modal--add-task b_bottom_0">

		<div class="rwd-modal__header">
			<div class="d-flex">
				<p class="mb-0">Add Attribute</p>
				<!-- <i class="icon icon-close btn_modal_close medium"></i> -->
			</div>
		</div>

		<form action="{{ route('attributes_store') }}" method="post">
			@csrf()

			<div class="rwd-modal__body">
				<div class="hr"></div>
				<div class="form">
					<div class="form__input-group {{ $errors->has('name') ? 'invalid' : '' }}">
						<label class="form__label">Attribute Name</label>
						<input class="form__input" type="text" name="name" value="{{ old('name') }}">
					</div>
					<div class="form__input-group">
						<p class="form__input-note mt-4">If this attribute is dependant on a previous option, select it here</p>
						<select class="form__input" type="text" id="inpt_select">
							<option value="">- select dependency -</option>
						</select>
					</div>
					<div class="form__input-group">
						<input type="text" class="form__input" id="inpt_dep_value" placeholder="Dependency option...">
					</div>
				</div>

				@if($errors->any())
					<p class="mt-4 mb-4 color_red">{{$errors->first()}}</p>
				@endif

			</div>

			<button type="submit" class="btn btn--full modal__btn-footer no_radius" id="modal-save-add-attribute">Submit</button>
		</form>

	</div>
</div>

<div class="modal-container" id="rwd-modal--add-option">
	<div class="rwd-modal b_bottom_0">

		<div class="rwd-modal__header">
			<div class="d-flex">
				<p class="mb-0">Add Option for <span class="attr_title"></span></p>
				<!-- <i class="icon icon-close btn_modal_close medium"></i> -->
			</div>
		</div>

		<form action="" method="post" id="form_add_option">
			@csrf()

			<div class="rwd-modal__body">
				<div class="hr"></div>
				<div class="form">
					<div class="form__input-group">
						<label class="form__label">Name</label>
						<input class="form__input" type="text" name="name" placeholder="Option name...">
					</div>
					<div class="form__input-group">
						<label class="form__label">Cost</label>
						<input class="form__input" type="number" name="cost" placeholder="Option cost..." value="0">
					</div>
					<div class="form__input-group">
						<label class="form__label">Image</label>
						<input class="form__input" type="file" name="option_image">
					</div>
				</div>
			</div>

			<div class="btn btn--full modal__btn-footer no_radius" id="modal-save-add-option">Submit</div>
		</form>

	</div>
</div>

<div class="modal-container" id="rwd-modal--edit-option">
	<div class="rwd-modal b_bottom_0">

		<div class="rwd-modal__header">
			<div class="d-flex">
				<p class="mb-0">Edit Option for <span class="attr_title"></span></p>
				<!-- <i class="icon icon-close btn_modal_close medium"></i> -->
			</div>
		</div>

		<form action="" method="post">
			@csrf()

			<div class="rwd-modal__body">
				<div class="hr"></div>
				<div class="form">
					<div class="form__input-group">
						<label class="form__label">Option Name</label>
						<input class="form__input" type="text" name="name" placeholder="Option name...">
					</div>
					<div class="form__input-group">
						<label class="form__label">Option Image</label>
						<input class="form__input" type="file" name="option_image">
					</div>
				</div>
			</div>

			<div class="btn btn--full modal__btn-footer no_radius" id="modal-save-edit-option">Submit</div>
		</form>

	</div>
</div>

<div class="modal-container" id="lb-modal--ays-delete-attr">
	<div class="rwd-modal rwd-modal--ays">

		<div class="rwd-modal__body">
			<p class="no_margin m_top">Are you sure you want to delete this attribute and all it's options?</p>
			<div class="modal__ays-btns">
				<div class="btn confirm">Yes</div>
				<div class="btn decline">No</div>
			</div>
		</div>

	</div>
</div>

<div class="modal-container" id="lb-modal--ays-del_option-attr">
	<div class="rwd-modal rwd-modal--ays">

		<div class="rwd-modal__body">
			<p class="no_margin m_top">Are you sure you want to delete this option?</p>
			<div class="modal__ays-btns">
				<div class="btn confirm">Yes</div>
				<div class="btn decline">No</div>
			</div>
		</div>

	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script type="text/javascript" src="{{ asset('js/classes/Modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/classes/Message.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/classes/FormValidator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/attributes.js') }}"></script>

@endsection
@extends('layouts.app')

@section('content')

<div class="main_section">
    <div class="section_header">
        <div class="container">
            <h1>Custom Order <span class="acacia-red">Form</span></h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <div class="options-overview form-items">

                    @foreach($attributes as $attr)
                        <p class="options-overview__option @if ($loop->first) is_active @endif" data-attr_id="{{ $attr->id }}">{{ $attr->name }}</p>
                    @endforeach

                </div>
            </div>
            <div class="col-sm-12 col-md-7">
                <div class="attribute_main">

                    <h1 class="attr_title"></h1>
                    <div class="option-list"></div>
                    <div class="form-nav-btns">
                        <div class="btn btn-grey btn-prev">Back</div>
                        <div class="btn btn-next">Next</div>
                        <div class="btn btn-complete">Complete</div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-2">
                <div class="price-panel">
                    <h2>Price</h2>
                    <p>$<span class="elem_price">0</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="orderformError">
    <p class="orderformError__display"></p>
</div>

<div class="modal-container" id="rwd-modal--order-summery">
    <div class="rwd-modal b_bottom_0">

        <div class="rwd-modal__header">
            <div class="d-flex">
                <p class="mb-0">Custom Order Summary</p>
                <!-- <i class="icon icon-close btn_modal_close medium"></i> -->
            </div>
        </div>

        <div class="rwd-modal__body">
                
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Option</th>
                  <th scope="col">Choosen</th>
                  <th scope="col">Cost</th>
                </tr>
              </thead>
              <tbody id="order_table">
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Jacob</td>
                  <td>Thornton</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Larry</td>
                  <td>the Bird</td>
                </tr>
              </tbody>
            </table>

            <p class="text-center">Total: $<span class="elem_price"></span></p>

            <div class="form mt-0">
                <div class="form__input-group">
                    <label class="form__label">Name</label>
                    <input type="text" id="q_name" class="form__input">
                </div>
                <div class="form__input-group">
                    <label class="form__label">Email</label>
                    <input type="email" id="q_email" class="form__input">
                </div>
            </div>

        </div>

        <div class="btn btn--full modal__btn-footer no_radius" id="modal-send-order">Send</div>

    </div>
</div>

<script type="text/javascript" src="{{ asset('js/classes/Modal.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/classes/FormValidator.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/orderform.js') }}"></script>

@endsection

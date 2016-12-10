@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Customer
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('customers.show_fields')
                    <a href="{!! route('customers.index') !!}" class="btn btn-default">Back</a>
                </div>
                <br/>
                <br/>
                <br/>
                <div class="row" style="border: 1px solid black">
                   @include('contacts.table')
                </div>
            </div>
        </div>
    </div>
@endsection

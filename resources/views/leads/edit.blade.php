@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lead
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lead, ['route' => ['leads.update', $lead->id], 'method' => 'patch']) !!}

                        @include('leads.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
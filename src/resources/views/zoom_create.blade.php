@extends('layouts.tabler')
@section('body_content_header_extras')

@endsection
@section('body_content_main')
@include('layouts.blocks.tabler.alert')
<div class="row" id="zoom-create">

	@include('layouts.blocks.tabler.sub-menu')

	<div class="col-md-9">
		<div class="row">

			<div class="col-md-12">
              <form class="card" action="" method="post">
              	{{ csrf_field() }}
                <div class="card-body">
                  <h3 class="card-title">Zoom Meetings</h3>
                                      
                  <div class="row">
                    
                    {{-- <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="firstname"  @if ($errors->has('firstname')) data-error="{{ $errors->first('firstname') }}" @endif>First Name</label>
                        <input id="firstname" type="text" name="firstname" maxlength="30" v-model="user.firstname"
                                           required class="form-control {{ $errors->has('firstname') ? ' invalid' : '' }}">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="lastname"  @if ($errors->has('lastname')) data-error="{{ $errors->first('lastname') }}" @endif>Last Name</label>
                        <input id="lastname" type="text" name="lastname" maxlength="30" v-model="user.lastname"
                                           required class="form-control {{ $errors->has('lastname') ? ' invalid' : '' }}">
                      </div>
                    </div> --}}

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="topic"  @if ($errors->has('topic')) data-error="{{ $errors->first('topic') }}" @endif>Topic</label>
                        <input id="topic" type="text" name="topic" v-model="user.topic" maxlength="80"
                                           required class="form-control {{ $errors->has('topic') ? ' invalid' : '' }}">
                      </div>
                    </div>


                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="start_time" class="active" @if ($errors->has('start_time')) data-error="{{ $errors->first('start_time') }}" @endif>Start time</label>
                        <input id="start_time" type="time" name="start_time" v-model="user.start_time"
                                           required class="form-control {{ $errors->has('start_time') ? ' invalid' : '' }}">
                      </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label class="form-label" for="duration" @if ($errors->has('duration')) data-error="{{ $errors->first('duration') }}" @endif>Duration</label>
                        <input id="start_time" type="number" name="duration" v-model="user.duration" min="0" step="15"
                                           required class="form-control {{ $errors->has('duration') ? ' invalid' : '' }}">
                        {{-- <select name="duration" id="duration" v-model="user.duration" class="form-control {{ $errors->has('duration') ? ' invalid' : '' }}">
                                        <option value="" disabled>Select Gender</option>
                                        <option value="female">Female</option>
                                        <option value="male">Male</option>
                                    </select> --}}
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label" for="description"  @if ($errors->has('description')) data-error="{{ $errors->first('description') }}" @endif>Please give a brief description</label>
                        <textarea id="description" name="description" v-model="user.description" maxlength="80" rows="4" cols="50"
                                           required class="form-control {{ $errors->has('description') ? ' invalid' : '' }}" ></textarea>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="card-footer text-right">
                  <button type="submit" name="action" value="update_business" class="btn btn-primary">Create Meeting</button>
                </div>
              </form>
         
            </div>
		</div>
	</div>




</div>


@endsection
@section('body_js')

<script type="text/javascript">
        new Vue({
            el: '#zoom-create',
            data: {
                user: {!! json_encode($dorcasUser) !!}
            }
        })
    </script>
    
@endsection

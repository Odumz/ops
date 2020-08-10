@extends('layouts.tabler')
@section('body_content_header_extras')

@endsection
@section('body_content_main')
@include('layouts.blocks.tabler.alert')
<div class="row" id="zoom-index">

	@include('layouts.blocks.tabler.sub-menu')

	<div class="col-md-9" id="ops-zoom-meeting">
		<div class="row" v-if="">
			<div class="col-md-12 col-lg-6" v-for="(meeting, index) in meetings" :key="meeting.id">
                <div class="card">
                    <div class="card-status bg-indigo"></div>
                    <div class="card-header">
                        <h3 class="card-title">@{{ meeting.topic }}</h3>
                    </div>
                    <div class="card-body">
                    <p> @{{ meeting.start-time }}<span>@{{ meeting.duration }}</span></p> 
                    <br>
                    <p> @{{ meeting.description }}</p>
                    </div>
                    <div class="card-footer">
                        <p>
                            <a href="#" v-on:click.prevent="edit_meeting(index)" class="btn btn-indigo btn-sm">Edit Meeting</a>
                            &nbsp;
                            <a href="#" v-on:click.prevent="start_meeting" class="btn btn-indigo btn-sm">Start Meeting</a>
                            &nbsp;
    		                {{-- <a v-bind:href="'{{ route('finance-accounts') }}/' + account.id" v-if="mode === 'topmost'" class="btn btn-cyan btn-sm">View Sub Accounts</a> --}}
                        </p>
                    </div>
                </div>
            </div>
            @include('modules-ops::modals.meeting-edit')
        </div>
        <div class="row col-md-12" v-if="">
            @component('layouts.blocks.tabler.empty-fullpage')
                @slot('title')
                    Create a Meeting
                @endslot
                You have not yet created any meetings, you can use the button above to do that now.
                @slot('buttons')
                    <a href="#" v-on:click.prevent="installFinance" class="btn btn-primary" :class="{'btn-loading':is_processing}">Create a Meeting</a>
                @endslot
            @endcomponent
        </div>
	</div>




</div>


@endsection
@section('body_js')

<script type="text/javascript">
        new Vue({
            el: '#oom-index',
            data: {
                meeting: {}
            },
            computed: {
                meetingsAvailable: function() {
                    return this.meetings.length > 0;
                }
            },
            methods: {
                edit_meeting: function (index) {
                    //console.log(index)
                    this.meeting_index = index;
                    $('#meetings-edit-modal').modal('show');
                },
                editMeeting: function (index) {
                    var context = this;
                    var meeting = this.meetings.length > index ? this.meetings[index] : null;
                    if (meeting === null) {
                        return;
                    }
                    context.is_processing = true;
                    axios.put("/ops/ops-zoom-meeting/" + meeting.id, {
                        display_name: meeting.display_name,
                        entry_type: meeting.entry_type
                    })
                        .then(function (response) {
                            //console.log(response);
                            context.is_processing = false;
                            context.meetings.splice(index, 1, response.data);
                            $('#meetings-edit-modal').modal('hide');
                            swal("Success", "Successful updated the Account", "success");
                        })
                        .catch(function (error) {
                            var message = '';
                            if (error.response) {
                                // The request was made and the server responded with a status code
                                // that falls out of the range of 2xx
                                //var e = error.response.data.errors[0];
                                //message = e.title;
                            var e = error.response;
                            message = e.data.message;
                            } else if (error.request) {
                                // The request was made but no response was received
                                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                                // http.ClientRequest in node.js
                                message = 'The request was made but no response was received';
                            } else {
                                // Something happened in setting up the request that triggered an Error
                                message = error.message;
                            }
                            context.is_processing = false;
                            //Materialize.toast('Error: '+message, 4000);
                            swal("Error", message, "warning");
                    });
                }
            }
        })
    </script>
    
@endsection

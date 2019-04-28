@extends('layouts/app4')
@section('title','Chat')
@section('return')
@if(Auth::user()->role_id == 3)
{{ route('home') }}
@else
@if($task->task_state_id == 1)
{{ route('pending') }}
@elseif($task->task_state_id == 2)
{{ route('initiated') }}
@else
{{ route('finished') }}
@endif
@endif
@endsection
@if(Auth::user()->role_id==2)
@section('header')
<p>Tarea<br>{{ $task->code }}</p>
@endsection
@else
@section('header')
<p>Solicitud<br>{{ $task->code }}</p>
@endsection
@endif
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}">
<div class="container container-chat">
	@if(Auth::user()->role_id==2)
	<div class="chatting-with"><h4>Chateando con {{ $task->client->name }}</h4></div>
	@elseif(Auth::user()->role_id==3)
	<div class="chatting-with"><h4>Chateando con {{ $task->technician->name }}</h4></div>
	@endif
	<div class="chat" id="chat" onLoad="window.scroll(0, 150)">
		@foreach($task_messages as $task_message)
		@if($task_message->task_id == $task->id)
		@if(Auth::id()==$task_message->user_id)
		<div class="message-container-sender">
			<div class="message-div-sender">
				<div class="row">
					<div class="col">
						<p  class="message">{{ $task_message->content }}</p>
					</div>
					<div class="col-1">
						<span class="time-sender">{{ substr($task_message->created_at,11,-3) }}</span>
					</div>
					<span class="message-triangle-sender"></span>
				</div>
			</div>
			<br>
		</div>
		@elseif(Auth::id()==$task_message->task->technician_id || Auth::id()==$task_message->task->client_id)
		<div class="message-container-receiver">
			<div class="message-div-receiver">
				<div class="row">
					<span class="message-triangle-receiver"></span>
					<div class="col">
						<p  class="message">{{ $task_message->content }}</p>
					</div>
					<div class="col-1">
						<span class="time-receiver">{{ substr($task_message->created_at,11,-3) }}</span>
					</div>
				</div>
			</div>
			<br>
		</div>
		@endif
		@endif
		@endforeach
	</div>
	<div>
		@if($task->task_state_id != 4)
		<form id="form-message" class="chat-write-area" action="{{ route('chat.store') }}" method="post">
			@csrf
			<div class="row">
				<div class="col-11" style="margin-right:  -20px">
					<textarea  class="form2" maxlength="1000" name="content" placeholder="Escribe un mensaje aqui..."></textarea>
				</div>
				<div class="col-1">
					<input type="hidden" name="task_id" value="{{ $task->id }}">
					<button class="btn btn-link btn-enviar"></button>
				</div>
			</div>
		</form>
		@else
		<div id="form-message" class="chat-write-area">
			<div class="row">
				<div class="col-11" style="margin-right:  -20px">
					<textarea  class="form2" maxlength="1000" style="background-color: #fffff0; text-align: center;" placeholder="Inhabilitado" readonly></textarea>
				</div>
				<div class="col-1">
					<label class="btn btn-link btn-enviar"></label>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>
<script type="text/javascript">
	var objDiv = document.getElementById("chat");
objDiv.scrollTop = objDiv.scrollHeight;
$( "#form-message" ).submit(function( event ) {
// Stop form from submitting normally
event.preventDefault();
// Get some values from elements on the page:
var $form = $( this ),
term1= $form.find( "input[name='task_id']" ).val(),
term2= $form.find( "input[name='content']" ).val(),
url = $form.attr( "action" );
// Send the data using post
var posting = $.post( url, { s: term1 } );
var posting = $.post( url, { s: term2 } );
// Put the results in a div
posting.done(function( data ) {
var content = $( data ).find( "#content" );
$( "#chat" ).empty().append( content );
});
});
</script>
@endsection
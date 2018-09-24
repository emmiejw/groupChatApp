<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat App</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<style>
		.list-group{
			overflow-y: scroll;
			height: 200px;
		}
		body{
			background-color: azure;
			border:10px solid white; 
		}
	</style>
</head>
<body>
<br>	
<br>
<div>
</div> 
	<div class="container">
		<div class="row" id="app">
				<div class="card" style="width:100%">
					<div class="card-header text-center display-4">Laravel Chat</div>
					<br>
					<h3 class="text-center">{{ Auth::user()->name }}</h3>
					<br>
						<div class="card-body">
							<div class="offset-4 col-4 offset-sm-1 col-sm-10">
								<li class="list-group-item active">Chat Room<span class="badge  badge-pill badge-danger" style="margin:10px;">@{{ numberOfUsers }}</span> </li>
								<div class="badge badge-pill badge-info">@{{ typing }}</div>
								<ul class="list-group" v-chat-scroll>
								  <message
								  v-for="value,index in chat.message"
								  :key=value.index
								  :color= chat.color[index]
								  :user = chat.user[index]
								  :time = chat.time[index]
								  >
									  @{{ value }}
								  </message>
								</ul>
								  <input type="text" class="form-control" placeholder="Type your message here..." v-model='message' @keyup.enter='send'>
								  <br>
								  <a href='' class="btn btn-danger btn-sm" @click.prevent='deleteSession'>Delete Conversation</a>
								<br>
								<br>
							</div>
			</div>
		</div>
	</div>
	
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
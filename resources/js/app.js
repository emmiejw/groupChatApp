require('./bootstrap');

window.Vue = require('vue');
// for auto scroll
import Vue from 'vue'
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

// /// for notifications
// import Toaster from 'v-toaster'
// import 'v-toaster/dist/v-toaster.css'
// Vue.use(Toaster, {timeout: 5000})

Vue.component('message', require('./components/message.vue'));

const app = new Vue({
    el: '#app',
    data:{
    	message:'',
    	chat:{
    		message:[],
    		user:[],
    		color:[],
    		
    	},
    	typing:'',
    	numberOfUsers:0
    },
    watch:{
    	message(){
    		Echo.private('chat')
    		    .whisper('typing', {
    		        name: this.message
    		    });
    	}
    },
    methods:{
    	send(){
    		if (this.message.length != 0) {
    			this.chat.message.push(this.message);
    			this.chat.color.push('success');
    			this.chat.user.push('you');

    			axios.post('/send', {
    				message : this.message,
                    chat:this.chat
    			  })
    			  .then(response => {
    			    console.log(response);
    			    this.message = ''
    			  })
    			  .catch(error => {
    			    console.log(error);
    			  });
    		}
		}
	},


	watch:{
		message(){
			Echo.private('chat')
    			.whisper('typing', {
        			name: this.message
    		});
		}	
	},
	mounted(){
		Echo.private('chat')
    	    .listen('ChatEvent', (e) => {
    	    	this.chat.message.push(e.message);
    	    	this.chat.user.push(e.user);
				this.chat.color.push('warning');
				
			})
			.listenForWhisper('typing', (e) => {
				if(e.name != ''){
					this.typing = 'Typing....'
				}else{
					this.typing = ''
				}
				
			});
	}
});
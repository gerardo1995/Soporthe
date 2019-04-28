<template>
  <div>
    <div class="panel-body" style="background-color: #eee; border: 3px solid #cccccc;">
      <ul class="chat">
            <li class="left clearfix" v-for="message in messages" :key="message.id">
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.user_id }}
                        </strong>
                    </div>
                    <p>
                        {{ message.content }}
                    </p>
                </div>
            </li>
        </ul>
    </div>
    <div class="panel-footer">
      <div class="input-group">
          <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Escriba su mensaje aqui..." v-model="newMessage" @keyup.enter="sendMessage">

          <span class="input-group-btn">
              <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                  Send
              </button>
          </span>
      </div>
    </div>
    </div>
</template>

<script>
export default {
  props:['user', 'task'],
  data() {
    return {
      messages: [],
      url: '',
      newMessage: ''
    }
  },
  created() {
    this.fetchMessages()
    Echo.private('chat')
    .listen('TaskMessageSent', (e) => {
      this.messages.push({
        content: e.message.message,
        user_id: e.user,
        task_id: e.task
      });
    });
  },
  
  methods: {
    fetchMessages() {
      this.url = '/fetchmessages/' + this.task;
      axios.get(this.url).then(response => {
          this.messages = response.data;
      });
    },
    
    sendMessage() {
      this.messages.push({
        content: this.newMessage,
        user_id: this.user,
        task_id: this.task
        });

      axios.post('/sendmessage', { message: this.newMessage, task: this.task, user: this.user }).then(response => {
        console.log(response.data);
      });
      this.newMessage = '';
    }
  }
}
</script>


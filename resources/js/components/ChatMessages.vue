<template>
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
</template>

<script>
  export default {
    props: ['task'],

    data: () => ({
        messages: [],
        url: ''
    }),

    created() {
        this.fetchMessages();
    },
    
    methods: {
        fetchMessages() {
            this.url = '/fetchmessages/' + this.task;
            axios.get(this.url).then(response => {
                this.messages = response.data;
                console.log(response.data);
            });
        }
    }
  };
</script>
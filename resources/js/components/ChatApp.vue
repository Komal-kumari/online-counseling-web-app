
<template>
<div class="container-chat  clearfix">
  <div class="people-list" id="people-list">
    <div class="search">
      <input type="text" placeholder="search" />
      <i class="fa fa-search"></i>
    </div>
    <ul class="list">

      <li @click.prevent="selectUser(user.id)" class="clearfix" v-for = "user in userList" :key="user.id">

        <div class="about">
          <div class="name">{{user.name}}</div>
          <div class="status">
            <i class="fa fa-circle online"></i> online
          </div>
        </div>
      </li>


    </ul>
  </div>

  <div class="chat">
    <div class="chat-header clearfix">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01_green.jpg" alt="avatar" />

      <div class="chat-about">
        <div class="chat-with" v-if = "userMessage.user">Chat with {{userMessage.user.name}}</div>
        <!-- <div class="chat-with" v-elseif = "userMessage.therapists">Chat with {{userMessage.therapists.name}}</div> -->
        <div class="chat-num-messages">already 1 902 messages</div>
      </div>
      <i class="fa fa-star"></i><ul class ="nav nav-tabs">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">...</a>
          <div class="dropdown-menu">
          <a @click.prevent = "deleteAllMessages()" class="dropdown-item" href="#">Delete All Messages</a>
        </div>
        </li>
      </ul>
    </div> <!-- end chat-header -->

    <div class="chat-history" v-chat-scroll>
      <ul>
        <li class="clearfix" v-for = "message in userMessage.messages" :key="message.id">
          <div :class="`message-data  ${message.type == '0'? 'align-right':'align-left'}`">
            <div v-if="message.type == '0'">
            <span class="message-data-time" >{{message.created_at | timeformat}}</span> &nbsp; &nbsp;
            <span class="message-data-name" >{{message.therapists.name}} </span><i class="fa fa-circle me"></i>
            <ul class ="nav nav-tabs">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">...</a>
                <div class="dropdown-menu">
                <a @click.prevent="deleteSingleMessage(message.id)"    class="dropdown-item" href="#">Delete Message</a>
              </div>
              </li>
            </ul>
              </div>
              <div v-else>
                <i class="fa fa-circle me"></i>
                <span  class="message-data-name" >{{message.user.name}}</span>
              <span class="message-data-time" >{{message.created_at | timeformat}}</span> &nbsp; &nbsp;
              <ul class ="nav nav-tabs">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">...</a>
                  <div class="dropdown-menu">
                  <a @click.prevent="deleteSingleMessage(message.id)"    class="dropdown-item" href="#">Delete Message</a>
                </div>
                </li>
              </ul>
                </div>


          </div>
          <div :class="`message   ${message.type == '0'? 'other-message float-right':'my-message '}`"      >
            {{message.message}}
          </div>
        </li>






      </ul>

    </div> <!-- end chat-history -->

    <div class="chat-message clearfix">
      <textarea @keydown.enter = "sendMessage" v-model = "message" name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>

      <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
      <i class="fa fa-file-image-o"></i>

      <button>Send</button>

    </div> <!-- end chat-message -->

  </div> <!-- end chat -->

</div> <!-- end container -->



</template>

<script>
    export default {

    mounted() {
      Echo.private(`chat.${authuser.id}`)
      .listen('MessageSend',(e) => {
        if(e.message.type == 0){
          this.selectUser(e.message.from);
        }
        else{
            this.selectUser(e.message.to);
        }

        console.log(e.message.message);
      });
            this.$store.dispatch('userList');
        },

    data(){

      return{
        message:'',
      }
          },
    computed:{
    userList(){
    return this.$store.getters.userList;
  },
    userMessage(){
    return this.$store.getters.userMessage;
          },
    },
    created(){

        },
    methods:{
      selectUser(userId){
        this.$store.dispatch('userMessage',userId);
      },
      sendMessage(e){
        e.preventDefault();
        // alert(this.userMessage.user.id);
        if(this.message!=''){
          axios.post('/sendMessage',{message:this.message,user_id:this.userMessage.user.id})
          .then(response=>{
            this.selectUser(this.userMessage.user.id);
          })
          this.message='';
        }
      },

      deleteSingleMessage(messageId){
        axios.get(`/deleteSingleMessage/${messageId}`)
        .then(response=>{
          this.selectUser(this.userMessage.user.id);
        })

      },

      deleteAllMessages(){
        axios.get(`/deleteAllMessages/${this.userMessage.user.id}`)
        .then(response=>{
          this.selectUser(this.userMessage.user.id);
        })

      }


    }


    }



</script>


</script>

<style lang="css" scoped>
</style>

@extends('user.index')
@section('js_up')
<script src="https://www.gstatic.com/firebasejs/4.1.5/firebase.js"></script>

@endsection
@section('css_in')
<style>
    .chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    margin-left: 60px;
}

.chat li.right .chat-body
{
    margin-right: 60px;
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 250px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>
@endsection
@section('menu')
<div class="well">
    <div class="text-left">
        <h3>PESAN</h3>
        <p>
        <div class="panel panel-primary">
            <div class="panel-body" style="height:250%">
                <ul class="chat" id="chat_data">
                </ul>
            </div>
            <div class="panel-footer">
                <div class="input-group">
                    <input id="pesanChat" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                    <span class="input-group-btn">
                        <button class="btn btn-warning btn-sm" id="btnSend">Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
var config = {
    apiKey: "AIzaSyDHcY4p0-IsqUlEqSELmwRSwpl6QHezg1s",
    authDomain: "testing-4df71.firebaseapp.com",
    databaseURL: "https://testing-4df71.firebaseio.com",
    storageBucket: "testing-4df71.appspot.com",
    messagingSenderId: "681644593163"
};
firebase.initializeApp(config);

var pesan = document.querySelector('#pesanChat');

$(document).ready(function() {
    var rootchatref = firebase.database().ref('/');  
    var chatref = firebase.database().ref('/Chat'); 
    

    var dataSuk = [];
    chatref.orderByChild('date').on('child_added', function(snapshot) {  
        // snapshot.forEach(function(data){
        //     $('#chat_data').prepend('<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+data.user+'</strong> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'+ data.date +'</small></div><p>'+data.msg+'</p></div></li>');
        // });
        var data = snapshot.val();
        // dataSuk.push(data);
        $('#chat_data').prepend('<li class="left clearfix"><span class="chat-img pull-left"><img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" /></span><div class="chat-body clearfix"><div class="header"><strong class="primary-font">'+data.user+'</strong> <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>'+ data.date +'</small></div><p>'+data.msg+'</p></div></li>');
        console.log(dataSuk);
    });  


    $('#btnSend').click(function(){
        alert(pesan.value);
        writeChat('user1', pesan.value);
    });
});

function writeChat(user, msg) {  
    var postData = {  
        msg : msg,  
        user: user,
        date: Date.now()
    };
    // Get a key for a new Post.  
    var newPostKey = firebase.database().ref().child('Chat').push().key;
    var updates = {};  
    updates['/Chat/'+newPostKey] = postData;
    
    return firebase.database().ref().update(updates);
}  
</script>
@endsection
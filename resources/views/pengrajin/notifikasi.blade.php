@extends('pengrajin.index')

@section('menu')
<div class="well">
    <div class="text-left">
        <h3>NOTIFIKASI</h3>
        @if(auth()->user()->usaha->notifikasi->count() > 0)
        <div class="panel panel-primary">
            <div class="panel-heading">
                <span class="glyphicon glyphicon-bell"></span> {{auth()->user()->usaha->notifikasi->where('read','=',0)->count()}} Notifikasi berlum dibaca
            </div>
            <div class="panel-body">
                <ul class="chat">
                    <li class="left clearfix"><span class="chat-img pull-left">
                    </span>
                        <div class="chat-body clearfix">
                        @foreach(auth()->user()->usaha->notifikasi as $notif)
                            @if($notif->read == 0)
                                <div class="header">
                                    <form action="/user/usaha/notifikasi/{{$notif->id}}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="id_notif" value="{{$notif->id}}">
                                    <strong class="primary-font"><u><button class="" style="border:none; background:none; color:black;"><b>{{ $notif->judul_notif }}</b></button></u></strong> <span class="badge red">Belum Dibaca</span>
                                    </form>
                                    <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span> {{ $notif->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <p>
                                {{ strip_tags(Illuminate\Support\Str::limit($notif->pesan, 50)) }}
                                </p>
                            @else
                                <div class="header">
                                    <i class="primary-font"><u>{{ $notif->judul_notif }}</u></i> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span> {{ $notif->created_at->diffForHumans() }}</small>
                                </div>
                                <p>
                                {{ strip_tags(Illuminate\Support\Str::limit($notif->pesan, 50)) }}
                                </p>
                            @endif
                        @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @else
        GA ADA
        @endif
    </div>
</div>
@endsection
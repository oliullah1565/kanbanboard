@extends('layouts.app')

@section('content')
<style>
._gp {
    display: flex; 
    align-items:center;
    justify-content: center;
    column-gap:20px;
}
input {
    padding: 4px 16px
}
button {
    padding: 4px 16px;
    border-radius: 4px
}
.boxs {
    display: grid;
    grid-template-columns: repeat(3, minmax(160px, 1fr));
    column-gap: 20px;
    margin-top: 20px;
}
.boxs .box {
    border: 1px solid #ddd;
    border-radius: 4px;
}
.boxs .box .heading {
    height: 40px;
    background: rgb(246, 179, 46);
    display: flex;
    align-items: center;
    justify-content: center
}
.boxs .box .heading h4 {
    color: #fff;
    font-size: 16px;
    font-weight: 600;
}
.boxs .box .content {
    padding: 20px;
}
.boxs .box .content .items {
    list-style: none;
    display: flex;
    flex-direction: column;
    row-gap: 20px;
    margin: 0;
    padding: 0;
}
.boxs .box .content .items .item {
    line-height: 30px;
    border: 1px solid #ddd;
    padding: 6px;
    text-align: center;
    border-radius: 4px;
    background: #f2f2f2;
    cursor: pointer;
}
.boxs .box .content .items .item .actions {
    margin-top: 12px;
    display: none
}
.boxs .box .content .items .item .actions .action {}
.boxs .box .content .items .item .actions .action button {
    padding: 0 12px;
    color: #fff;
    border: none;
    outline: none;
}

.boxs .box .content .items .item.active .actions 
{
    display: block;
}
.boxs .box .content .items .item .actions .action button:nth-child(1){
    background-color: green;
}
.boxs .box .content .items .item .actions .action button:nth-child(2){
    background-color: tomato;
}

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Task Board') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <form class="form-inline" action="{{ route('taskstore') }}" method="POST">
                            @csrf
                            <div class="_gp">
                                <input type="text" placeholder="Write your task ..." name='name'/>
                                <button type="submit">Add</button>
                            </div>
                          </form>

                          <div class="boxs">
                            <div class="box">
                                <div class="heading">
                                    <h4>To Do</h4>
                                </div>
                                <div class="content">
                                    <ul class="items">
                                        @foreach ($todos as $todo)
                                            <li class="item">
                                                <span>{{$todo->name}}</span>
                                                <div class="actions">
                                                    <div class="action">
                                                        <a href="{{route('inprocess',$todo->id)}}"><button type="button">In Process</button></a>
                                                        <a href="{{route('done',$todo->id)}}"><button type="button">Done</button></a>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                      
                                    </ul>
                                </div>
                            </div>
                            <div class="box">
                                <div class="heading">
                                    <h4>In Progress</h4>
                                </div>
                                <div class="content">
                                    <ul class="items">
                                        @foreach ($inpros as $inpro)
                                            <li class="item">
                                                <span>{{$inpro->name}}</span>
                                                <div class="actions">
                                                    <div class="action">
                                                        <a href="{{route('done',$inpro->id)}}"><button type="button">Done</button></a>
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                            <div class="box">
                                <div class="heading">
                                    <h4>Done</h4>
                                </div>
                                <div class="content">
                                    <ul class="items">
                                        @foreach ($dones as $done)
                                            <li class="item">
                                                <span>{{$done->name}}</span>
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                          </div>

                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
<script>
let target = document.getElementsByClassName("item");
for(let i=0; i < target.length; i++){
    
    target[i].addEventListener("click", function(event) {
       
        for(let j=0; j < target.length; j++){
        target[j].classList.remove('active');
        }
      
        target[i].classList.add('active');
    });

}

</script>
@endsection


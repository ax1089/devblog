@extends('layouts.app')
@section('title',$user->name.'的个人中心')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
            <div class="card">
                <img class="card-img-top" src="https://gimg2.baidu.com/image_search/src=http%3A%2F%2Fup.enterdesk.com%2F2021%2Fedpic_source%2Ff8%2F3a%2F37%2Ff83a371f767b48b2f7e19ef7ac6b4ad9_8.jpg&refer=http%3A%2F%2Fup.enterdesk.com&app=2002&size=f9999,10000&q=a80&n=0&g=0n&fmt=jpeg?sec=1647729040&t=771127743dcdedb02d80a7a8373fecf1" alt="{{$user->name}}">
                <div class="card-body">
                    <h5><strong>个人简介</strong></h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    <hr>
                    <h5><strong>注册于</strong></h5>
                    <p>January 01 1901</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-0" style="font-size: 22px;">
                        {{$user->name}} <small>{{$user->email}}</small>
                    </h1>
                </div>
            </div>
            <hr>
            {{--用户发布内容--}}
            <div class="card">
                <div class="card-body">
                    暂无数据 ~_~
                </div>
            </div>
        </div>
    </div>
    @stop

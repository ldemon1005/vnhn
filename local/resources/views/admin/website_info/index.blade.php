@extends('admin.master')

@section('css')
@stop
@section('main')
    @if (session('error'))
        <div class="alert alert-error">
            <p>{{ session('error') }}</p>
        </div>
    @endif
    <div class="content-wrapper">
        <div class="box-header with-border">
            <h3 class="box-title">Thông tin website </h3>
        </div>
        @if (session('error'))
            <div class="alert alert-error">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                <p>{{ session('status') }}</p>
            </div>
        @endif
        <section class="content">
            <div class="row form-group" style="padding: 10px">
                <div class="col-md-8">
                    <form id="create_group" action="{{route('update_info')}}" method="post">
                        {{csrf_field()}}
                        @foreach($website_info->info as $key => $info)
                            <div class="row form-group">
                                <label class="col-sm-2">{{$key}}</label>
                                <div class="col-sm-10">
                                    <input type="text" name="info[{{$key}}]" value="{{$info}}" class="form-control">
                                </div>
                            </div>
                        @endforeach
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Cập nhật
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4" style="padding-left: 30px">
                    <div class="row">
                        <label>Người cập nhật : {{$website_info->user_updated ? $website_info->user_updated->fullname : 'admin'}}</label>
                    </div>
                    <div class="row">
                        <label>Ngày cập nhật : {{$website_info->updated_at}}</label>
                    </div>
                </div>
            </div>

            <!-- ./row -->
        </section>
    </div>
@stop

@section('script')
@stop

{{--<div class="page-header">
    <h1>
        充值审核
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">充值审核</h3>

        <div class="  well">
            <form class="form-inline search-group" role="form" method="get" action="{!! url('manage/rechargeList') !!}">
                <div class="form-group search-list width285">
                    <label for="name" class="">充值编号　</label>
                    <input name="code" type="text" @if(isset($code))value="{!! $code !!}" @endif />
                </div>
                <div class="form-group search-list width285">
                    <label for="namee" class="">充值用户　</label>
                    <input name="username" type="text" @if(isset($username))value="{!! $username !!}" @endif/>
                </div>
                <div class="form-group search-list ">
                    <label for="namee" class="">时间　</label>
                    <div class="input-daterange input-group">
                        <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                        <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                    </div>
                </div>

                {{-- <div class="form-group">
                     <button class="btn btn-primary btn-sm">搜索</button>
                 </div>--}}
                <div class="space"></div>
                <div class="form-inline search-group " >
                    <div class="form-group search-list width285">
                        <label class="">显示条数　</label>
                        <select name="paginate">
                            <option @if(isset($paginate) && $paginate == 10)selected="selected"@endif value="10">10条</option>
                            <option @if(isset($paginate) && $paginate == 20)selected="selected"@endif value="20">20条</option>
                            <option @if(isset($paginate) && $paginate == 30)selected="selected"@endif value="30">30条</option>
                        </select>
                    </div>
                    <div class="form-group search-list width285">
                        <label class="">结果排序　</label>
                        <select name="by">
                            <option @if(isset($by) && $by == 'id')selected="selected"@endif value="id">默认排序</option>
                            <option @if(isset($by) && $by == 'created_at')selected="selected"@endif value="created_at">充值时间</option>
                        </select>
                        <select name="order">
                            <option @if(isset($order) && $order == 'desc')selected="selected"@endif value="desc">递减</option>
                            <option @if(isset($order) && $order == 'asc')selected="selected"@endif value="asc">递增</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </div>
                {{--<div class="row">
                    <div class="col-md-4">充值编号：<input name="code" type="text" @if(isset($code))value="{!! $code !!}" @endif /></div>
                    <div class="col-md-4">充值用户：<input name="username" type="text" @if(isset($username))value="{!! $username !!}" @endif/></div>
                    <div class="col-md-4">时间：<div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">显示条数：
                        <select name="paginate">
                            <option @if(isset($paginate) && $paginate == 10)selected="selected"@endif value="10">10条</option>
                            <option @if(isset($paginate) && $paginate == 20)selected="selected"@endif value="20">20条</option>
                            <option @if(isset($paginate) && $paginate == 30)selected="selected"@endif value="30">30条</option>
                        </select>
                    </div>
                    <div class="col-md-4">结果排序：
                        <select name="by">
                            <option @if(isset($by) && $by == 'id')selected="selected"@endif value="id">默认排序</option>
                            <option @if(isset($by) && $by == 'created_at')selected="selected"@endif value="created_at">充值时间</option>
                        </select>
                        <select name="order">
                            <option @if(isset($order) && $order == 'desc')selected="selected"@endif value="desc">递减</option>
                            <option @if(isset($order) && $order == 'asc')selected="selected"@endif value="asc">递增</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                </div>--}}
            </form>
        </div>

        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>
                        编号
                    </th>
                    <th>充值用户</th>
                    <th >充值金额</th>

                    <th>
                        充值时间
                    </th>
                    <th>充值状态</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($list))
                    @foreach($list as $item)
                <tr>
                    <td>
                        {!! $item->code !!}
                    </td>

                    <td>
                        {!! $item->name !!}
                    </td>
                    <td>
                        ￥{!! $item->cash !!}元
                    </td>
                    <td>
                        {!! $item->created_at !!}
                    </td>
                    <td>
                        @if($item->status == 0)待付款@endif
                    </td>
                    <td>
                        <a href="{!! url('manage/confirmRechargeOrder/'. $item->code) !!}" class="btn btn-xs btn-success" title="确认付款"><i class="ace-icon fa fa-check bigger-120"></i></a>
                    </td>
                </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            {!! $list->appends($search)->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

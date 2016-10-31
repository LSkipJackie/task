{{--<div class="page-header">
    <h1>
        提现审核
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">提现审核</h3>

<div class="well">
    <form class="form-inline search-group" role="form" method="get" action="{!! url('manage/cashoutList') !!}">
        <div class="form-group search-list width285">
            <label for="name" class="">提现编号　</label>
            <input name="id" type="text" @if(isset($id))value="{!! $id !!}"@endif/>
        </div>
        <div class="form-group search-list width285">
            <label for="namee" class="">提现用户　</label>
            <input name="username" type="text" @if(isset($username))value="{!! $username !!}@endif" />
        </div>
        <div class="form-group search-list ">
            <label for="namee" class="">时间　　　</label>
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
                <label class="">提现类型　</label>
                <select name="cashout_type">
                    <option value="">全部</option>
                    <option @if(isset($cashout_type) && $cashout_type == 2)selected="selected"@endif value="2">银行卡</option>
                    <option @if(isset($cashout_type) && $cashout_type == 1)selected="selected"@endif value="1">支付宝</option>
                </select>
            </div>
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
            <div class="col-md-4">提现编号：<input name="id" type="text" @if(isset($id))value="{!! $id !!}"@endif/></div>
            <div class="col-md-4">提现用户：<input name="username" type="text" @if(isset($username))value="{!! $username !!}@endif" /></div>
            <div class="col-md-4">时间：<div class="input-daterange input-group">
                    <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                    <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                    <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4">提现类型：
                <select name="cashout_type">
                    <option value="">全部</option>
                    <option @if(isset($cashout_type) && $cashout_type == 2)selected="selected"@endif value="2">银行卡</option>
                    <option @if(isset($cashout_type) && $cashout_type == 1)selected="selected"@endif value="1">支付宝</option>
                </select>
            </div>
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
<div class="">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <label>
                    <span class="lbl"></span>
                    编号
                </label>
            </th>
            <th>提现用户</th>
            <th>提现类型</th>
            <th>提现金额</th>

            <th>
                提现到账金额
            </th>
            <th>收款账号</th>
            <th>收款户名</th>
            <th>提现时间</th>
            <th>提现状态</th>
            <th>操作</th>
        </tr>
        </thead>

        <tbody>
        @if(!empty($list))
            @foreach($list as $item)
        <tr>
            <td>
                {!! $item->id !!}
            </td>
            <td>
                {!! $item->name !!}
            </td>
            <td>@if($item->cashout_type == 1)支付宝@else银行卡@endif</td>
            <td>
                ￥{!! $item->cash !!}元
            </td>
            <td>
                ￥{!! $item->real_cash !!}元
            </td>
            <td>
                {!! $item->cashout_account !!}
            </td>
            <td>
                {!! $item->realname !!}
            </td>
            <td>
                {!! $item->created_at !!}
            </td>
            <td>
                @if($item->status == 0)待审核@elseif($item->status == 2)未通过审核@else已打款@endif
            </td>
            <td>
                @if($item->status == 0)
                <a href="{!! url('manage/cashoutHandle/' . $item->id . '/pass') !!}" class="btn btn-xs btn-success" title="确认打款"><i class="ace-icon fa fa-check bigger-120"></i></a>
                <a href="{!! url('manage/cashoutHandle/' . $item->id . '/deny') !!}" class="btn btn-xs btn-danger" title="不通过审核"><i class="ace-icon fa fa-ban bigger-120"></i></a>
                @endif
                <a href="{!! url('manage/cashoutInfo/' . $item->id) !!}" class="btn btn-xs btn-info" title="查看"><i class="ace-icon fa fa-search bigger-120"></i></a>
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row text-right">
            {!! $list->appends($search)->render() !!}
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}

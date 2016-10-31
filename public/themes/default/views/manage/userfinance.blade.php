{{--<div class="page-header">
    <h1>
        用户流水
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">用户流水</h3>
        <div class="well">
            <form class="form-inline search-group" role="form" action="{!! url('manage/userFinance') !!}" method="get">
                <div class="form-group search-list width285">
                    <label for="name" class="">用户编号　</label>
                    <input type="text" name="uid"  value="@if(isset($uid)){!! $uid !!}@endif" />
                </div>
                <div class="form-group search-list width285">
                    <label for="namee" class="">用户名　　</label>
                    <input type="text" name="username" value="@if(isset($username)){!! $username !!}@endif" />
                </div>
                <div class="form-group search-list ">
                    <label for="namee" class="">财务类型　</label>
                    <select name="action" id="action">
                        <option value="">全部</option>
                        <option value="3" @if(isset($action) && $action == 3)selected="selected"@endif>充值</option>
                        <option value="4" @if(isset($action) && $action == 4)selected="selected"@endif>提现</option>
                        <option value="1" @if(isset($action) && $action == 1)selected="selected"@endif>收入</option>
                        <option value="2" @if(isset($action) && $action == 2)selected="selected"@endif>支出</option>
                    </select>
                </div>
               {{-- <div class="form-group">
                    <button class="btn btn-primary btn-sm">搜索</button>
                </div>--}}
                <div class="space"></div>
                <div class="form-inline search-group " >
                    <div class="form-group search-list width285">
                        <label class="">显示条数　</label>
                        <select name="paginate" id="paginate">
                            <option @if(isset($paginate) && $paginate == 10)selected="selected"@endif value="10">10条</option>
                            <option @if(isset($paginate) && $paginate == 20)selected="selected"@endif value="20">20条</option>
                            <option @if(isset($paginate) && $paginate == 30)selected="selected"@endif value="30">30条</option>
                        </select>
                    </div>
                    <div class="form-group search-list width285">
                        <label class="">结果排序　</label>
                        <select name="by" id="by">
                            <option value="id" @if(isset($by) && $by == 'id')selected="selected"@endif>默认排序</option>
                            <option value="created_at" @if(isset($by) && $by == 'created_at')selected="selected"@endif>时间</option>
                        </select>
                        <select name="order" id="order">
                            <option value="desc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递减</option>
                            <option value="asc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递增</option>
                        </select>
                    </div>
                    <div class="form-group search-list ">
                        <label class="">时间　</label>
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                        </div>
                    </div>
                    <div class="form-group"><button type="submit" class="btn btn-primary btn-sm">搜索</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" onclick="userFinanceExport()">导出Excel</a>
                    </div>
                </div>
                {{--<div class="row">
                    <div class="col-md-4">
                        用户编号：
                        <input type="text" name="uid"  value="@if(isset($uid)){!! $uid !!}@endif" />
                    </div>
                    <div class="col-md-4">用 户 名 ： <input type="text" name="username" value="@if(isset($username)){!! $username !!}@endif" /></div>
                    --}}{{--<div class="col-md-4">财务用途：
                        <select name="action">
                            <option selected="selected">全部</option>
                            <option value="3">充值</option>
                            <option value="4">提现</option>
                            <option value="1">收入</option>
                            <option value="2">支出</option>
                        </select>
                    </div>--}}{{--
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">财务类型：
                        <select name="action" id="action">
                            <option value="">全部</option>
                            <option value="3" @if(isset($action) && $action == 3)selected="selected"@endif>充值</option>
                            <option value="4" @if(isset($action) && $action == 4)selected="selected"@endif>提现</option>
                            <option value="1" @if(isset($action) && $action == 1)selected="selected"@endif>收入</option>
                            <option value="2" @if(isset($action) && $action == 2)selected="selected"@endif>支出</option>
                        </select>
                    </div>
                    <div class="col-md-4">显示条数：
                        <select name="paginate" id="paginate">
                            <option @if(isset($paginate) && $paginate == 10)selected="selected"@endif value="10">10条</option>
                            <option @if(isset($paginate) && $paginate == 20)selected="selected"@endif value="20">20条</option>
                            <option @if(isset($paginate) && $paginate == 30)selected="selected"@endif value="30">30条</option>
                        </select>
                    </div>
                    <div class="col-md-4">结果排序：
                        <select name="by" id="by">
                            <option value="id" @if(isset($by) && $by == 'id')selected="selected"@endif>默认排序</option>
                            <option value="created_at" @if(isset($by) && $by == 'created_at')selected="selected"@endif>时间</option>
                        </select>
                        <select name="order" id="order">
                            <option value="desc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递减</option>
                            <option value="asc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递增</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;时间：&nbsp;
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($start)){!! $start !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($end)){!! $end !!}@endif">
                        </div>
                    </div>
                    <div class="col-md-4"><button type="submit" class="btn btn-primary btn-sm">搜索</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" onclick="userFinanceExport()">导出Excel</a>
                    </div>
                </div>--}}
            </form>
        </div>
        <div class="table-responsive">
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>
                        <label>
                            <span class="lbl"></span>
                            编号
                        </label>
                    </th>
                    <th>财务类型</th>
                    <th>用户</th>

                    <th>
                        金额
                    </th>
                    <th>用户余额</th>
                    <th>时间</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($list))
                @foreach($list as $item)
                <tr>
                    <td>
                        <label>
                            <span class="lbl"></span>
                            {!! $item->id !!}
                        </label>
                    </td>

                    <td>
                        @if($item->action == 1)收入@elseif($item->action == 2)支出@elseif($item->action == 3)充值@elseif($item->action == 4)提现@endif
                    </td>
                    <td >{!! $item->name !!}</td>
                    <td>￥{!! $item->cash !!}元</td>

                    <td>
                        ￥{!! $item->balance !!}元
                    </td>

                    <td>
                        {!! $item->created_at !!}
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
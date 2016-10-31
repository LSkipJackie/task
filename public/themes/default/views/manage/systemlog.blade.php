
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">系统日志</h3>
<div class="well">
    <form class="form-inline" role="form" action="/manage/systemLogList" method="get">
        <div class="form-group search-list width285">
            <label for="">日志编号　</label>
            <input type="text" name="id" value="@if(isset($id)){!! $id !!}@endif">
        </div>
        <div class="form-group search-list width285">
            <label for="">操作员　　</label>
            <input type="text" name="username" value="@if(isset($username)){!! $username !!}@endif">
        </div>
        <div class="form-group search-list width285">
            <label for="">日志内容　</label>
            <input type="text" name="log_content" value="@if(isset($log_content)){!! $log_content !!}@endif">
        </div>
        <div class="space"></div>
        <div class="form-group search-list width285">
            <label for="">显示条数　</label>
            <select name="paginate">
                <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>10条</option>
                <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>20条</option>
                <option value="30" @if(isset($paginate) && $paginate == 30)selected="selected"@endif>30条</option>
            </select>
        </div>
        <div class="form-group search-list width285">
            <label for="">结果排序　</label>
            <select name="by">
                <option value="id" @if(isset($by) && $by == 'id')selected="selected"@endif>默认排序</option>
                <option value="created_at" @if(isset($by) && $by == 'log_time')selected="selected"@endif>日志时间</option>
            </select>
            <select name="order">
                <option value="asc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递增</option>
                <option value="desc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递减</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-sm">搜索</button>
        </div>
    </form>
</div>

<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                <label>
                    {{--<input type="checkbox"  name="" class="ace allcheck"/>
                    <span class="lbl"></span>--}}
                    编号
                </label>
            </th>
            <th>操作员</th>
            <th>用户组</th>
            <th>内容</th>
            <th>时间</th>
            <th>IP</th>
        </tr>
        </thead>
        @if(isset($systemLog))
        <tbody>
        @foreach($systemLog as $v)
            <tr>
                <td class="center">
                    <label>
                        <input type="checkbox" class="ace checkbox" name="chk[]" value="{!! $v->id !!}"/>
                        <span class="lbl"></span>
                        {!! $v->id !!}
                    </label>
                </td>

                <td>
                    {!! $v->username !!}
                </td>
                <td>
                    {!! $v->type_name !!}
                </td>
                <td>
                    {!! $v->log_content !!}
                </td>
                <td>
                    {!! $v->created_at !!}
                </td>
                <td>
                    {!! $v->IP !!}
                </td>
            </tr>
        @endforeach
        </tbody>
        @endif
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="dataTables_paginate paging_bootstrap row">
            {!! $systemLog->appends($search)->render() !!}
        </div>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/multidelete.js') !!}
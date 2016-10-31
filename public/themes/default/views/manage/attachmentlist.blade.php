
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">附件管理</h3>
<div class="well">
    <form class="form-inline" method="get" action="{!! url('manage/attachmentList') !!}">
            <div class="form-group search-list width285">
                <label for="">附件编号　</label>
                <input type="text" name="id" @if(isset($id))value="{!! $id !!}"@endif>
            </div>
                <div class="form-group search-list">
                <label for="">附件名称　</label>
                <input type="text" name="name" @if(isset($name))value="{!! $name !!}"@endif>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
            </div>
            <div class="space"></div>
            <div class="form-group search-list width285">
                <label for="">显示条数　</label>
                <select name="paginate">
                    <option @if(isset($paginate) && $paginate == 10)selected="selected"@endif value="10">10条</option>
                    <option @if(isset($paginate) && $paginate == 20)selected="selected"@endif value="20">20条</option>
                    <option @if(isset($paginate) && $paginate == 30)selected="selected"@endif value="30">30条</option>
                </select>
            </div>
            <div class="form-group search-list">
                <label for="">结果排序　</label>
                <select name="by">
                    <option @if(isset($by) && $by == 'id')selected="selected"@endif value="id">默认排序</option>
                    <option @if(isset($by) && $by == 'created_at')selected="selected"@endif value="created_at">发布时间</option>
                </select>
                <select name="order">
                    <option @if(isset($order) && $order == 'asc')selected="selected"@endif value="asc">递增</option>
                    <option @if(isset($order) && $order == 'desc')selected="selected"@endif value="desc">递减</option>
                </select>　
            </div>
    </form>
</div>
<div>
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="center">
                <label>
                    {{--<input type="checkbox" class="ace allcheck"/>
                    <span class="lbl"></span>--}}
                    编号
                </label>
            </th>
            <th>驱动</th>
            <th>附件名称</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($list))
            @foreach($list as $item)
            <tr>
            <td class="center">
                <label>
                    <input type="checkbox" class="ace" name="chk"/>
                    <span class="lbl"></span>
                    {!! $item->id !!}
                </label>
            </td>

            <td>
                {!! $item->disk !!}
            </td>
            <td>
                {!! $item->name !!}
            </td>
            <td>
                {!! $item->created_at !!}
            </td>
            <td>
                <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                    <a href="{!! url('manage/attachmentDel/' . $item->id) !!}" title="删除" class="btn btn-xs btn-danger">
                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                    </a>
                </div>
                <div class="visible-xs visible-sm hidden-md hidden-lg">
                    <div class="inline position-relative">
                        <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-caret-down icon-only bigger-120"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-left dropdown-caret dropdown-close">
                            <li>
                                <a href="{!! url('manage/attachmentDel/' . $item->id) !!}" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                    <span class="red">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
<div>
    <div class="dataTables_paginate paging_bootstrap pull-right text-right row">
        {!! $list->appends($search)->render() !!}
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
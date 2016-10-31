{{--<div class="space-2"></div>
<div class="page-header">
    <h1>
        搜索
    </h1>
</div><!-- /.page-header -->--}}
<h3 class="header smaller lighter blue mg-bottom20 mg-top12">交易维权</h3>
<div class="row">
    <div class="col-xs-12">
        <div class="well">
            <form role="form" class="form-inline search-group" action="/manage/rightsList" method="get">
                <div class="form-group search-list width285">
                    <label for="name" class="">维权人　　</label>
                    <input type="text" name="reportId" @if(isset($merge['reportId'])) value="{!! $merge['reportId'] !!}" @endif >
                </div>
                <div class="form-group search-list ">
                    <label for="namee" class="">维权类型　</label>
                    <select name="reportType" >
                        <option {!! (!isset($merge['reportType']) || $merge['reportType']==0)?'selected':'' !!}  value="0">全部</option>
                        <option {!!(isset($merge['reportType']) && $merge['reportType']==2)?'selected':'' !!} value="1">违规信息</option>
                        <option {!! (isset($merge['reportType']) && $merge['reportType']==3)?'selected':'' !!} value="2">虚假交换</option>
                        <option {!! (isset($merge['reportType']) && $merge['reportType']==4)?'selected':'' !!} value="3">涉嫌抄袭</option>
                        <option {!!(isset($merge['reportType']) && $merge['reportType']==6)?'selected':'' !!} value="4">其他</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                </div>
                <div class="space"></div>
                <div class="form-inline search-group" >
                    <div class="form-group search-list width285">
                        <label class="">维权状态　</label>
                        <select name="reportStatus">
                            <option {!! (!isset($merge['reportStatus']) || $merge['reportStatus']==0)?'selected':'' !!} value="0">全部</option>
                            <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==1)?'selected':'' !!} value="1">已处理</option>
                            <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==2)?'selected':'' !!} value="2">未处理</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="">显示条数　</label>
                        <select name="pageSize">
                            <option {!!(!isset($merge['pageSize']) || $merge['pageSize']==10)?'selected':'' !!} value="10">10条</option>
                            <option {!! (isset($merge['pageSize']) && $merge['pageSize']==20)?'selected':'' !!} value="20">20条</option>
                            <option {!! (isset($merge['pageSize']) && $merge['pageSize']==30)?'selected':'' !!} value="30">30条</option>
                        </select>
                    </div>
                </div>
                {{--维权人：<input type="text" name="reportId" @if(isset($merge['reportId'])) value="{!! $merge['reportId'] !!}" @endif >
                维权类型：
                <select name="reportType" >
                    <option {!! (!isset($merge['reportType']) || $merge['reportType']==0)?'selected':'' !!}  value="0">全部</option>
                    <option {!!(isset($merge['reportType']) && $merge['reportType']==2)?'selected':'' !!} value="1">违规信息</option>
                    <option {!! (isset($merge['reportType']) && $merge['reportType']==3)?'selected':'' !!} value="2">虚假交换</option>
                    <option {!! (isset($merge['reportType']) && $merge['reportType']==4)?'selected':'' !!} value="3">涉嫌抄袭</option>
                    <option {!!(isset($merge['reportType']) && $merge['reportType']==6)?'selected':'' !!} value="4">其他</option>
                </select>
                维权状态：
                <select name="reportStatus">
                    <option {!! (!isset($merge['reportStatus']) || $merge['reportStatus']==0)?'selected':'' !!} value="0">全部</option>
                    <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==1)?'selected':'' !!} value="1">已处理</option>
                    <option {!! (isset($merge['reportStatus']) && $merge['reportStatus']==2)?'selected':'' !!} value="2">未处理</option>
                </select>
                显示条数：
                <select name="pageSize">
                    <option {!!(!isset($merge['pageSize']) || $merge['pageSize']==10)?'selected':'' !!} value="10">10条</option>
                    <option {!! (isset($merge['pageSize']) && $merge['pageSize']==20)?'selected':'' !!} value="20">20条</option>
                    <option {!! (isset($merge['pageSize']) && $merge['pageSize']==30)?'selected':'' !!} value="30">30条</option>
                </select>
                <button class="btn btn-primary btn-sm">搜索</button>--}}
            </form>
        </div>
        {{--<div class="well h4 blue">维权列表</div>--}}
        <div>
            <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">
                        <label>
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                            维权编号
                        </label>
                    </th>
                    <th>所属稿件</th>
                    <th>维权类型</th>
                    <th>原因</th>

                    <th>
                        <i class="icon-time bigger-110 hidden-480"></i>
                        维权人
                    </th>
                    <th>被维权人</th>
                    <th>维权时间</th>
                    <th>当前状态</th>
                    <th>处理人</th>
                    <th>操作</th>
                </tr>
                </thead>
                <form action="/manage/rightsDeletGroup" method="post" id="query_delete">
                    {{ csrf_field() }}
                <tbody>
                @foreach($rights['data'] as $v)
                    <tr>
                    <td class="center">
                        <label>
                            <input type="checkbox" class="ace"  name="ids[]" value="{{ $v['id'] }}"/>
                            <span class="lbl"></span>
                            {{ $v['id'] }}
                        </label>
                    </td>
                    <td>
                        <a href="/manage/taskDetail/{{ $v['task_id'] }}">查看所属稿件</a>
                    </td>
                    <td>
                        {{ $v['type_text'] }}
                    </td>
                    <td>{{ $v['desc'] }}</td>
                    <td>
                        <span class="h5">{{ $v['from_nickname'] }}</span>
                    </td>
                    <td>
                        {{ $v['to_nickname'] }}
                    </td>
                    <td>
                        {{ $v['created_at'] }}
                    </td>
                    <td>
                        {{ ($v['status']==0)?'未处理':'已处理' }}
                    </td>
                    <td>
                        {{ !empty($v['handle_nickname'])?$v['handle_nickname']:' ' }}
                    </td>
                    <td>
                        <a class="btn btn-xs btn-success" href="/manage/rightsDetail/{{ $v['id'] }}" title="查看方案"><i class="ace-icon fa fa-search bigger-120"></i>查看</a>
                        <a class="btn btn-xs btn-info" href="/manage/rightsDetail/{{ $v['id'] }}" title="处理举报"><i class="ace-icon fa fa-pencil bigger-120"></i>处理</a>
                        <a class="btn btn-xs btn-danger" href="/manage/rightsDelet/{{ $v['id'] }}" title="删除"><i class="ace-icon fa fa-trash-o bigger-120"></i>删除</a>

                    </td>
                </tr>
                @endforeach
                </tbody>
                </form>
            </table>
        </div>
        <div class="col-xs-12">
            <div class="dataTables_info row" id="sample-table-2_info">
                <label><input type="checkbox" class="ace" id="allcheck" /><span class="lbl"></span>全选</label>
                <button form="query_delete" type="submit" class="btn btn-primary btn-sm">批量删除</button>
            </div>
        </div>
        <div class="space-10 col-xs-12"></div>
        <div class="col-xs-12">
            {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                {!! $realname->render() !!}
            </div>--}}
            <div class="dataTables_paginate paging_bootstrap row">
                <div class="row">
                    <ul class="pagination">
                        {!! $reports_page->appends($_GET)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->

{{--<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="sample-table-2_info">
            <label><input type="checkbox" class="ace" id="allcheck" /><span class="lbl"></span>全选</label>
            <button form="query_delete" type="submit" class="btn btn-primary btn-sm">批量删除</button>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="dataTables_paginate paging_bootstrap">
            <ul class="pagination">
                @if(!empty($rights['prev_page_url']))
                    <li><a href="{!! URL('manage/rightsList').'?'.http_build_query(array_merge($merge,['page'=>$rights['current_page']-1])) !!}">上一页</a></li>
                @endif
                @if($rights['last_page']>1)
                    @for($i=1;$i<=$rights['last_page'];$i++)
                        <li class="{{ ($i==$rights['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/rightsList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                    @endfor
                @endif
                @if(!empty($rights['next_page_url']))
                    <li><a href="{!! URL('manage/rightsList').'?'.http_build_query(array_merge($merge,['page'=>$rights['current_page']+1])) !!}">下一页</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>--}}

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('backstage', 'js/doc/taskreport.js') !!}

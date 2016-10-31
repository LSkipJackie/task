<div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-body ">
                <h3 class="header smaller lighter blue mg-top12 mg-bottom20">互评记录</h3>
                <div class="widget-main paddingTop no-padding-left no-padding-right">
                    <div class="tab-content padding-4">
                        <div id="basic" class="tab-pane active">
                            <div class="table-responsive clearfix  well">
                                <form role="form" class="form-inline search-group" action="/manage/getCommentList" method="get">
                                    <!--<table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    用户名：<input type="text" name="commentId" @if(isset($merge['commentId']))value="{!! $merge['commentId'] !!}" @endif>
                                                </td>
                                                <td>
                                                    来自：
                                                    <select name="from" >
                                                        <option value="0" {!! (!isset($merge['from']) || $merge['from']==0)?'selected':'' !!}>全部</option>
                                                        <option value="1" {!!(isset($merge['from']) && $merge['from']==1)?'selected':'' !!}>来自雇主</option>
                                                        <option value="2" {!!(isset($merge['from']) && $merge['from']==2)?'selected':'' !!}>来自威客</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    结果排序：
                                                    <select name="orderBy">
                                                        <option value="id">默认排序</option>
                                                        <option value="created_at">时间排序</option>
                                                    </select>
                                                    <select name="orderByType">
                                                        <option value="asc" {!! (!isset($merge['orderByType']) || $merge['orderByType']=='asc')?'selected':'' !!}>递增</option>
                                                        <option value="desc" {!! (isset($merge['orderByType']) && $merge['orderByType']=='desc')?'selected':'' !!}>递减</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    显示条数：
                                                    <select name="pageSize">
                                                        <option {!!(!isset($merge['pageSize']) || $merge['pageSize']==10)?'selected':'' !!} value="10">10条</option>
                                                        <option {!! (isset($merge['pageSize']) && $merge['pageSize']==20)?'selected':'' !!} value="20">20条</option>
                                                        <option {!! (isset($merge['pageSize']) && $merge['pageSize']==30)?'selected':'' !!} value="30">30条</option>
                                                    </select>
                                                    <button class="btn btn-primary btn-sm">搜索</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>-->
                                    <div class="form-group search-list width285">
				                        <label for="name" class="">用户名　　</label>
				                        <input class="form-control" type="text" name="commentId" @if(isset($merge['commentId']))value="{!! $merge['commentId'] !!}" @endif>
				                    </div>
				                    <div class="form-group search-list ">
				                        <label for="namee" class="">来自　　　</label>
				                        <select name="from" >
                                            <option value="0" {!! (!isset($merge['from']) || $merge['from']==0)?'selected':'' !!}>全部</option>
                                            <option value="1" {!!(isset($merge['from']) && $merge['from']==1)?'selected':'' !!}>来自雇主</option>
                                            <option value="2" {!!(isset($merge['from']) && $merge['from']==2)?'selected':'' !!}>来自威客</option>
                                        </select>
				                    </div>
				                    <div class="form-group">
				                    	 <button class="btn btn-primary btn-sm">搜索</button>
				                    </div>
				                    <div class="space"></div>
				                    <div class="form-inline search-group " >
				                        <div class="form-group search-list width285">
				                            <label class="">结果排序　</label>
				                            <select name="orderBy">
                                                <option value="id">默认排序</option>
                                                <option value="created_at">时间排序</option>
                                            </select>
                                            <select name="orderByType">
                                                <option value="asc" {!! (!isset($merge['orderByType']) || $merge['orderByType']=='asc')?'selected':'' !!}>递增</option>
                                                <option value="desc" {!! (isset($merge['orderByType']) && $merge['orderByType']=='desc')?'selected':'' !!}>递减</option>
                                            </select> 
				                        </div>
				                        <div class="form-group">
				                            <label class="">显示条数　 </label>
				                            <select name="pageSize">
                                                <option {!!(!isset($merge['pageSize']) || $merge['pageSize']==10)?'selected':'' !!} value="10">10条</option>
                                                <option {!! (isset($merge['pageSize']) && $merge['pageSize']==20)?'selected':'' !!} value="20">20条</option>
                                                <option {!! (isset($merge['pageSize']) && $merge['pageSize']==30)?'selected':'' !!} value="30">30条</option>
                                           </select>
				                        </div>
				                    </div>
                                </form>
                            </div>
                            <div class="space-6"></div>
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            编号
                                        </th>
                                        <th>
                                            所属模型
                                        </th>
                                        <th>查看详情</th>
                                        <th>来自</th>
                                        <th>对用户</th>
                                        <th>
                                            评价
                                        </th>
                                        <th>
                                            时间
                                        </th>
                                        <th>
                                            操作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['data'] as $v)
                                            <tr>
                                        <td>
                                            <label>
                                                {{--<input type="checkbox" class="ace" name="chk"/>--}}
                                                <span class="lbl"></span>
                                                {{ $v['id'] }}
                                            </label>
                                        </td>

                                        <td>
                                            悬赏任务
                                        </td>
                                        <td>
                                            <a href="/task/{{ $v['task_id'] }}">查看任务</a>
                                        </td>
                                        <td>
                                            {{ $v['from_nickname'] }}
                                        </td>
                                        <td>
                                            {{ $v['to_nickname'] }}
                                        </td>
                                        <td>
                                            {{ str_limit($v['comment'],10) }}
                                        </td>
                                        <td>
                                            {{ $v['created_at'] }}
                                        </td>
                                        <td>
                                            <div class="visible-md visible-lg hidden-sm hidden-xs btn-group">
                                                <a title="删除" href="/manage/commentDel/{{ $v['id'] }}" class="btn btn-xs btn-danger">
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
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ $data['current_page'] }} / {{ $data['last_page'] }}页
                                </div>
                               <div class="space-10 col-xs-12"></div>
                                <div class="col-sm-12">
                                    <div class="dataTables_paginate paging_bootstrap text-right row">
                                        <ul class="pagination">
                                            @if(!empty($data['prev_page_url']))
                                                <li><a href="{!! URL('manage/getCommentList').'?'.http_build_query(array_merge($merge,['page'=>$data['current_page']-1])) !!}">上一页</a></li>
                                            @endif
                                            @if($data['last_page']>1)
                                                @for($i=1;$i<=$data['last_page'];$i++)
                                                    <li class="{{ ($i==$data['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/getCommentList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                                @endfor
                                            @endif
                                            @if(!empty($data['next_page_url']))
                                                <li><a href="{!! URL('manage/getCommentList').'?'.http_build_query(array_merge($merge,['page'=>$data['current_page']+1])) !!}">下一页</a></li>
                                            @endif
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

{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
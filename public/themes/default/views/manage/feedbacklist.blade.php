
    {{--<div class="space-2"></div>
    <div class="page-header">
        <h1>
            搜索
        </h1>
    </div><!-- /.page-header -->--}}
    <h3 class="header smaller lighter blue mg-bottom20 mg-top12">投诉建议</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <form  role="form" action="/manage/feedbackList" class="form-inline search-group" method="get">
                    <div class="form-group search-list width285">
                        <label for="name" class="">编号　</label>
                        <input type="text" name="id" value="@if(isset($id)){!! $id !!}@endif">
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">用户　　　</label>
                        <select name="user">
                            <option value="0">全部</option>
                            <option value="1" @if($user == '1')selected="selected"@endif>用户</option>
                            <option value="2" @if($user == '2')selected="selected"@endif>游客</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="">状态　</label>
                            <select name="status">
                                <option value="0">全部</option>
                                <option value="1" @if($status == '1')selected="selected"@endif>待回复</option>
                                <option value="2" @if($status == '2')selected="selected"@endif>已回复</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="">显示条数　</label>
                            <select name="paginate">
                                <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>10条</option>
                                <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>20条</option>
                                <option value="30" @if(isset($paginate) && $paginate == 30)selected="selected"@endif>30条</option>
                            </select>
                        </div>
                    </div>
                   {{-- 编号：<input type="text" name="id" value="@if(isset($id)){!! $id !!}@endif">
                    用户：<select name="user">
                            <option value="0">全部</option>
                            <option value="1" @if($user == '1')selected="selected"@endif>用户</option>
                            <option value="2" @if($user == '2')selected="selected"@endif>游客</option>
                        </select>
                    状态：<select name="status">
                            <option value="0">全部</option>
                            <option value="1" @if($status == '1')selected="selected"@endif>待回复</option>
                            <option value="2" @if($status == '2')selected="selected"@endif>已回复</option>
                        </select>
                    显示条数：<select name="paginate">
                                <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>10条</option>
                                <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>20条</option>
                                <option value="30" @if(isset($paginate) && $paginate == 30)selected="selected"@endif>30条</option>
                           </select>
                    <button type="submit" class="btn btn-primary btn-sm">搜索</button>--}}
                </form>
            </div>
            {{--<div class="well h4 blue">投诉建议</div>--}}
            <div>
                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                            <label>
                                {{--<input type="checkbox" class="ace">
                                <span class="lbl"></span>--}}
                                编号
                            </label>
                        </th>
                        <th>用户名</th>
                        <th>手机号</th>
                        <th>描述</th>
                        <th>
                            时间
                        </th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($feedbackList as $v)
                        <tr>
                            <td class="center">
                                <label>
                                    <input type="checkbox" class="ace">
                                    <span class="lbl"></span>
                                    {!! $v->id !!}
                                </label>
                            </td>
                            <td>
                                @if($v->name)
                                {!! $v->name !!}
                                @else
                                无
                                @endif
                            </td>
                            <td>
                                @if($v->phone)
                                    {!! $v->phone !!}
                                @else
                                    无
                                @endif
                            </td>
                            <td>{!! $v->desc !!}</td>
                            <td>
                                {!! $v->created_time !!}
                            </td>
                            <td>
                                @if($v->status == '1')
                                    未处理
                                @else
                                    已处理
                                @endif

                            </td>
                            <td>
                                @if($v->status == '2')
                                <a href="/manage/feedbackDetail/{!! $v->id !!}">
                                <button class="btn btn-xs btn-success" title="查看"><i class="ace-icon fa fa-search bigger-120"></i>查看</button>
                                </a>
                                <a href="/manage/deleteFeedback/{!! $v->id !!}">
                                <button class="btn btn-xs btn-danger" title="删除"><i class="ace-icon fa fa-trash-o bigger-120"></i>删除</button>
                                </a>
                                @endif
                                @if($v->status == '1')
                                <a href="/manage/feedbackReplay/{!! $v->id !!}">
                                <button @if($v->name)title="回复"@else title="备注" @endif class="btn btn-xs btn-info">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>回复
                                </button>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12">
                {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                    {!! $realname->render() !!}
                </div>--}}
                <div class="dataTables_paginate paging_bootstrap row">
                    <div class="row">
                        <ul class="pagination">
                            @if(!empty($feedbackArr['prev_page_url']))
                                <li><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$feedbackArr['current_page']-1])) !!}">上一页</a></li>
                            @endif
                            @if($feedbackArr['last_page']>1)
                                @for($i=1;$i<=$feedbackArr['last_page'];$i++)
                                    <li class="{{ ($i==$feedbackArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                @endfor
                            @endif
                            @if(!empty($feedbackArr['next_page_url']))
                                <li><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$feedbackArr['current_page']+1])) !!}">下一页</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    {{--<div class="row">
        <div class="col-sm-6">
            <div class="dataTables_paginate paging_bootstrap text-right">
                <ul class="pagination">
                    @if(!empty($feedbackArr['prev_page_url']))
                        <li><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$feedbackArr['current_page']-1])) !!}">上一页</a></li>
                    @endif
                    @if($feedbackArr['last_page']>1)
                        @for($i=1;$i<=$feedbackArr['last_page'];$i++)
                            <li class="{{ ($i==$feedbackArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                        @endfor
                    @endif
                    @if(!empty($feedbackArr['next_page_url']))
                        <li><a href="{!! URL('manage/feedbackList').'?'.http_build_query(array_merge($merge,['page'=>$feedbackArr['current_page']+1])) !!}">下一页</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>--}}

    {!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}
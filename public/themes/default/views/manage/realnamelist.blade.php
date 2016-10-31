<div class="row">
        <div class="col-xs-12">
            <div class="clearfix table-responsive">
               {{-- <div class="space"></div>--}}
                <h3 class="header smaller lighter blue mg-bottom20 mg-top12" >实名认证</h3>
                <div class="form-inline clearfix  well">
                <form  role="form" action="/manage/realnameAuthList" method="get">
                	<div class="form-group search-list width285">
                        <label for="name" class="">认证编号　</label>
                        <input type="text" class="form-control" id="auth_id" name="auth_id" placeholder="请输入编号" value="@if(isset($auth_id)){!! $auth_id !!}@endif">
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">用户名　　</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" value="@if(isset($username)){!! $username !!}@endif">
                    </div>
                    <div class="form-group">
                    	 <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group" >
                        <div class="form-group search-list width285">
                            <label class="mg-right35">排序</label>
                            <select class="sort-list" name="by">
                                <option value="id" @if(isset($by) && $by == 'id')selected="selected"@endif>默认排序</option>
                                <option value="created_at" @if(isset($by) && $by == 'created_at')selected="selected"@endif>申请时间</option>
                            </select>
                            <select name="order">
                                <option value="asc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递增</option>
                                <option value="desc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递减</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="">显示结果　 </label>
                            <select name="paginate">
                                <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>每页显示10</option>
                                <option value="15" @if(isset($paginate) && $paginate == 15)selected="selected"@endif>每页显示15</option>
                                <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>每页显示20</option>
                            </select>
                        </div>
                    </div>
                    <!--<table class="table table-hover">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group search-list sort">
                                        <label for="name">认证编号：</label>
                                        <input type="text" class="form-control" id="auth_id" name="auth_id" placeholder="请输入编号" value="@if(isset($auth_id)){!! $auth_id !!}@endif">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group search-list">
                                        <label for="namee">　用户名：</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" value="@if(isset($username)){!! $username !!}@endif">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-group search-list sort">
                                        <label class="">　　排序：</label>
                                        <select class="sort-list" name="by">
                                            <option value="id" @if(isset($by) && $by == 'id')selected="selected"@endif>默认排序</option>
                                            <option value="created_at" @if(isset($by) && $by == 'created_at')selected="selected"@endif>申请时间</option>
                                        </select>
                                        <select name="order">
                                            <option value="asc" @if(isset($order) && $order == 'asc')selected="selected"@endif>递增</option>
                                            <option value="desc" @if(isset($order) && $order == 'desc')selected="selected"@endif>递减</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group sort-out">
                                        <label class="">显示结果：</label>
                                        <select name="paginate">
                                            <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>每页显示10</option>
                                            <option value="15" @if(isset($paginate) && $paginate == 15)selected="selected"@endif>每页显示15</option>
                                            <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>每页显示20</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>-->
                </form>
                </div>
            </div>

            <!-- <div class="table-responsive"> -->

            <!-- <div class="dataTables_borderWrap"> -->
            <div class="table-responsive">
                <table id="sample-table" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">
                        </th>
                        <th>编号</th>
                        <th>用户名</th>
                        <th >真实姓名</th>

                        <th>
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            申请时间
                        </th>
                        <th>
                            状态
                        </th>
                        <th>认证时间</th>
                        <th>处理</th>
                    </tr>
                    </thead>
                    <form action="/manage/realnameAuthMultiDel" method="post">
                        {!! csrf_field() !!}
                    <tbody>
                    @foreach($realname as $item)
                        <tr>
                            <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>

                            <td>
                                <a href="#">{!! $item->id !!}</a>
                            </td>
                            <td>{!! $item->username !!}</td>
                            <td>{!! $item->realname !!}</td>
                            <td>{!! $item->created_at !!}</td>

                            <td>
                                @if($item->status == 0)
                                <span class="label label-sm label-warning">待审核</span>
                                @elseif($item->status == 1)
                                <span class="label label-sm label-success">已认证</span>
                                @elseif($item->status == 2)
                                <span class="label label-sm label-danger">认证失败</span>
                                @endif
                            </td>

                            <td>
                                @if($item->auth_time){!! $item->auth_time !!}@else N/A @endif
                            </td>

                            <td>
                                <div class="btn-group">
                                    @if($item->status == 0)
                                    <a class="btn btn-xs btn-success" href="/manage/realnameAuthHandle/{!! $item->id !!}/pass">
                                        <i class="ace-icon fa fa-check bigger-120"></i>成功
                                    </a>

                                    <a class="btn btn-xs btn-danger" href="/manage/realnameAuthHandle/{!! $item->id !!}/deny">
                                        <i class="ace-icon fa fa-ban bigger-120"></i>失败
                                    </a>
                                    @endif
                                    <a class="btn btn-xs btn-warning" href="{!! url('manage/realnameAuth/' . $item->id) !!}">
                                        <i class="ace-icon fa fa-search bigger-120"></i>查看
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    <!--<tr>
                        <td colspan="8">
                            <div class="row">
                                <div class="col-xs-6">

                                </div>
                                <div class="col-xs-6">
                                   {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                                        {!! $realname->render() !!}
                                    </div>--}}
                                    <div class="dataTables_paginate paging_bootstrap ">
                                        <ul class="pagination">
                                            @if(!empty($realnameArr['prev_page_url']))
                                                <li><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$realnameArr['current_page']-1])) !!}">上一页</a></li>
                                            @endif
                                            @if($realnameArr['last_page']>1)
                                                @for($i=1;$i<=$realnameArr['last_page'];$i++)
                                                    <li class="{{ ($i==$realnameArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                                @endfor
                                            @endif
                                            @if(!empty($realnameArr['next_page_url']))
                                                <li><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$realnameArr['current_page']+1])) !!}">下一页</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>-->
                    </tbody>
                    </form>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">
                        <label class="position-relative mg-right10">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"> 全选</span>
                       </label>
                    </div>
                </div>
                <div class="space-10 col-xs-12"></div>
                <div class="col-xs-12">
                    {{-- <div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
                        {!! $realname->render() !!}
                    </div>--}}
                    <div class="dataTables_paginate paging_bootstrap row">
                        <ul class="pagination">
                            @if(!empty($realnameArr['prev_page_url']))
                                <li><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$realnameArr['current_page']-1])) !!}">上一页</a></li>
                            @endif
                            @if($realnameArr['last_page']>1)
                                @for($i=1;$i<=$realnameArr['last_page'];$i++)
                                    <li class="{{ ($i==$realnameArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                @endfor
                            @endif
                            @if(!empty($realnameArr['next_page_url']))
                                <li><a href="{!! URL('manage/realnameAuthList').'?'.http_build_query(array_merge($merge,['page'=>$realnameArr['current_page']+1])) !!}">下一页</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
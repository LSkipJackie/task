<div class="row">
        <div class="col-xs-12">
            {{--<div class="space"></div>--}}
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">支付宝绑定</h3>
            <div class="clearfix  table-responsive ">
                <div class="form-inline clearfix well">
                <form  role="form" action="/manage/alipayAuthList" method="get">
                	<div class="form-group search-list width285">
                        <label for="name" class="">认证编号　</label>
                        <input type="text" class="form-control" id="auth_id" name="auth_id" placeholder="请输入编号" value="@if(isset($auth_id)){!! $auth_id !!}@endif">
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">支付宝姓名　</label>
                        <input type="text" class="form-control" id="alipayName" name="alipayName" placeholder="请输入支付宝姓名" value="@if(isset($alipayName)){!! $alipayName !!}@endif">
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
                            <label class="">显示结果　　</label>
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
                                        <label for="namee">支付宝姓名：</label>
                                        <input type="text" class="form-control" id="alipayName" name="alipayName" placeholder="请输入支付宝姓名" value="@if(isset($alipayName)){!! $alipayName !!}@endif">
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
                                        <label class="">　显示结果：</label>
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
                        <th>支付宝姓名</th>
                        <th>支付宝账户</th>
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
                    <form action="/manage/alipayAuthMultiDel" method="post">
                        {!! csrf_field() !!}
                    <tbody>
                    @foreach($alipay as $item)
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
                            <td>{!! $item->alipay_name !!}</td>
                            <td>{!! $item->alipay_account !!}</td>
                            <td>{!! $item->created_at !!}</td>

                            <td>
                                @if($item->status == 0)
                                    <span class="label label-sm label-warning">待打款</span>
                                @elseif($item->status == 1)
                                    <span class="label label-sm label-success">已打款</span>
                                @elseif($item->status == 2)
                                    <span class="label label-sm label-success">认证成功</span>
                                @elseif($item->status == 3)
                                    <span class="label label-sm label-danger">认证失败</span>
                                @endif
                            </td>

                            <td>
                                @if($item->auth_time){!! $item->auth_time !!}@else N/A @endif
                            </td>

                            <td>
                                <div class=" btn-group">
                                    @if($item->status == 0)
                                        <a title="已打款" href="{!! url('manage/alipayAuth/' . $item->id) !!}" class="btn btn-xs btn-success">
                                            <i class="ace-icon fa fa-check bigger-120"></i>成功
                                        </a>

                                        <a title="拒绝通过" href="/manage/alipayAuthHandle/{!! $item->id !!}/deny" class="btn btn-xs btn-danger">
                                            <i class="ace-icon fa fa-ban bigger-120"></i>拒绝
                                        </a>
                                    @endif

                                    <a title="浏览" href="{!! url('manage/alipayAuth/' . $item->id) !!}" class="btn btn-xs btn-warning">
                                        <i class="ace-icon fa fa-search bigger-120"></i>查看
                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    <!--<tr>
                        <td colspan="9">
                            
                        </td>
                    </tr>-->
                    </tbody>
                    </form>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="dataTables_paginate paging_bootstrap text-right　row">
                    	<div class="row">
                    		<ul class="pagination">
	                            @if(!empty($alipayArr['prev_page_url']))
	                                <li><a href="{!! URL('manage/alipayAuthList').'?'.http_build_query(array_merge($merge,['page'=>$alipayArr['current_page']-1])) !!}">上一页</a></li>
	                            @endif
	                            @if($alipayArr['last_page']>1)
	                                @for($i=1;$i<=$alipayArr['last_page'];$i++)
	                                    <li class="{{ ($i==$alipayArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/alipayAuthList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
	                                @endfor
	                            @endif
	                            @if(!empty($alipayArr['next_page_url']))
	                                <li><a href="{!! URL('manage/alipayAuthList').'?'.http_build_query(array_merge($merge,['page'=>$alipayArr['current_page']+1])) !!}">下一页</a></li>
	                            @endif
	                        </ul>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
    
    {!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}

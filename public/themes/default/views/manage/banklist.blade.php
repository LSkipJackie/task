
    <div class="row">
        <div class="col-xs-12">
            {{--<div class="space"></div>--}}
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">银行卡绑定</h3>
            <div class="clearfix  table-responsive">
                <div class="form-inline well">
                <form  role="form" action="/manage/bankAuthList" method="get">
                	<div class="form-group search-list width285">
                        <label for="name" class="">认证编号　</label>
                        <input type="text" class="form-control" id="auth_id" name="auth_id" placeholder="请输入编号" value="@if(isset($auth_id)){!! $auth_id !!}@endif">
                    </div>
                    <div class="form-group search-list ">
                        <label for="namee" class="">银行账号　</label>
                        <input type="text" class="form-control" id="bankAccount" name="bankAccount" placeholder="请输入银行账号" value="@if(isset($bankAccount)){!! $bankAccount !!}@endif">
                    </div>
                    <div class="form-group">
                    	 <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                    </div>
                    <div class="space"></div>
                    <div class="form-inline search-group " >
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
                                        <label for="namee">银行账号：</label>
                                        <input type="text" class="form-control" id="bankAccount" name="bankAccount" placeholder="请输入银行账号" value="@if(isset($bankAccount)){!! $bankAccount !!}@endif">
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
                        {{--<th class="center">
                            <label class="position-relative">
                                <input type="checkbox" class="ace" />
                                <span class="lbl"></span>
                            </label>
                        </th>--}}
                        <th>编号</th>
                        <th>用户名</th>
                        <th>银行账号</th>

                        <th>
                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                            申请时间
                        </th>
                        <th >
                            状态
                        </th>
                        <th>认证时间</th>
                        <th>处理</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($bank as $item)
                        <tr>
                            {{--<td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" name="ckb[]" value="{!! $item->id !!}"/>
                                    <span class="lbl"></span>
                                </label>
                            </td>--}}

                            <td>
                                <a href="#">{!! $item->id !!}</a>
                            </td>
                            <td>{!! $item->username !!}</td>
                            <td>{!! $item->bank_account !!}</td>
                            <td>{!! $item->created_at !!}</td>

                            <td >
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
                                @if(isset($item->auth_time)){!! $item->auth_time !!}@else N/A @endif
                            </td>

                            <td>
                                <div class=" btn-group">
                                    @if($item->status == 0)
                                        <a title="已打款" href="{!! url('manage/bankAuth/' . $item->id ) !!}" class="btn btn-xs btn-success">
                                            <i class="ace-icon fa fa-check bigger-120"></i>确认
                                        </a>

                                        <a title="拒绝通过" href="/manage/bankAuthHandle/{!! $item->id !!}/deny" class="btn btn-xs btn-danger">
                                            <i class="ace-icon fa fa-ban bigger-120"></i>通过
                                        </a>
                                    @else
                                        <a title="浏览" href="{!! url('manage/bankAuth/' . $item->id ) !!}" class="btn btn-xs btn-warning">
                                            <i class="ace-icon fa fa-search bigger-120"></i>查看
                                        </a>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @endforeach
                    <!--<tr>
                        <td colspan="7">
                            
                        </td>
                    </tr>-->
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="dataTables_info" id="sample-table-2_info" role="status" aria-live="polite">

                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="dataTables_paginate paging_bootstrap text-right row">
                        <ul class="pagination">
                            @if(!empty($bankArr['prev_page_url']))
                                <li><a href="{!! URL('manage/bankAuthList').'?'.http_build_query(array_merge($merge,['page'=>$bankArr['current_page']-1])) !!}">上一页</a></li>
                            @endif
                            @if($bankArr['last_page']>1)
                                @for($i=1;$i<=$bankArr['last_page'];$i++)
                                    <li class="{{ ($i==$bankArr['current_page'])?'active disabled':'' }}"><a href="{!! URL('manage/bankAuthList').'?'.http_build_query(array_merge($merge,['page'=>$i])) !!}">{{ $i }}</a></li>
                                @endfor
                            @endif
                            @if(!empty($bankArr['next_page_url']))
                                <li><a href="{!! URL('manage/bankAuthList').'?'.http_build_query(array_merge($merge,['page'=>$bankArr['current_page']+1])) !!}">下一页</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->


{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
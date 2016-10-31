<div class="row">
    <div class="col-xs-12">
        <div class="clearfix table-responsive">
            <h3 class="header smaller lighter blue mg-bottom20 mg-top12">企业认证</h3>
            <div class="form-inline clearfix well">
            <form  role="form" action="/manage/enterpriseAuthList" method="get">
        		<div class="form-group search-list width285">
                    <label for="name" class="">认证用户　</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                </div>
                <div class="form-group search-list width285">
                    <label for="namee" class="">公司名称　</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="请输入公司名" @if(isset($merge['company_name']))value="{!! $merge['company_name'] !!}" @endif>
                </div>
                <div class="form-group search-list ">
                    <label for="namee" class="">认证状态　</label>
                    <select class="sort-list" name="status">
	                    <option value="0">全部</option>
	                    <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>待审核</option>
	                    <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>审核通过</option>
	                    <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>审核失败</option>
	                </select>
                </div>
                <div class="form-group">
                	 <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                </div>
                <div class="space"></div>
                <div class="form-inline search-group " >
                    <div class="form-group search-list width285">
                        <label class="mg-right35">排序</label>
                        <select class="sort-list" name="by">
                            <option value="enterprise_auth.id" @if(isset($merge['by']) && $merge['by'] == 'id')selected="selected"@endif>默认排序</option>
                            <option value="enterprise_auth.created_at" @if(isset($merge['by']) && $merge['by'] == 'enterprise_auth.created_at')selected="selected"@endif>申请时间</option>
                            <option value="enterprise_auth.auth_time" @if(isset($merge['by']) && $merge['by'] == 'enterprise_auth.auth_time')selected="selected"@endif>认证时间</option>
                        </select>
                        <select name="order">
                            <option value="asc" @if(isset($merge['order']) && $merge['order'] == 'asc')selected="selected"@endif>递增</option>
                            <option value="desc" @if(isset($merge['order']) && $merge['order'] == 'desc')selected="selected"@endif>递减</option>
                        </select>
                    </div>
                    <div class="form-group width285">
                        <label class="">显示结果　 </label>
                        <select name="paginate">
                            <option value="10" @if(isset($paginate) && $paginate == 10)selected="selected"@endif>每页显示10</option>
                            <option value="15" @if(isset($paginate) && $paginate == 15)selected="selected"@endif>每页显示15</option>
                            <option value="20" @if(isset($paginate) && $paginate == 20)selected="selected"@endif>每页显示20</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="" name="time_type">
                            <option value="enterprise_auth.created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.created_at')selected="selected"@endif>申请时间</option>
                            <option value="enterprise_auth.auth_time" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.auth_time')selected="selected"@endif>认证时间</option>
                        </select>
                        <div class="input-daterange input-group">
                            <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                            <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                            <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                        </div>
                    </div>
                </div>
                <!--<table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label for="name">认证用户：</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list">
                                    <label for="namee">　公司名称：</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="请输入公司名" @if(isset($merge['company_name']))value="{!! $merge['company_name'] !!}" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list sort">
                                    <label class="">　　排序：</label>
                                    <select class="sort-list" name="by">
                                        <option value="enterprise_auth.id" @if(isset($merge['by']) && $merge['by'] == 'id')selected="selected"@endif>默认排序</option>
                                        <option value="enterprise_auth.created_at" @if(isset($merge['by']) && $merge['by'] == 'enterprise_auth.created_at')selected="selected"@endif>申请时间</option>
                                        <option value="enterprise_auth.auth_time" @if(isset($merge['by']) && $merge['by'] == 'enterprise_auth.auth_time')selected="selected"@endif>认证时间</option>
                                    </select>
                                    <select name="order">
                                        <option value="asc" @if(isset($merge['order']) && $merge['order'] == 'asc')selected="selected"@endif>递增</option>
                                        <option value="desc" @if(isset($merge['order']) && $merge['order'] == 'desc')selected="selected"@endif>递减</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label class="">认证状态：</label>
                                    <select class="sort-list" name="status">
                                        <option value="0">全部</option>
                                        <option value="3" @if(isset($merge['status']) && $merge['status'] == 3)selected="selected"@endif>待审核</option>
                                        <option value="1" @if(isset($merge['status']) && $merge['status'] == 1)selected="selected"@endif>审核通过</option>
                                        <option value="2" @if(isset($merge['status']) && $merge['status'] == 2)selected="selected"@endif>审核失败</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list sort">
                                    <select class="sort-list" name="time_type">
                                        <option value="enterprise_auth.created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.created_at')selected="selected"@endif>申请时间</option>
                                        <option value="enterprise_auth.auth_time" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.auth_time')selected="selected"@endif>认证时间</option>
                                    </select>
                                    <div class="input-daterange input-group">
                                        <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                        <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group sort-out">
                                    <label class="">显示结果：</label>
                                    <select name="paginate">
                                        <option value="10" @if(isset($merge['paginate']) && $merge['paginate'] == 10)selected="selected"@endif>每页显示10</option>
                                        <option value="15" @if(isset($merge['paginate']) && $merge['paginate'] == 15)selected="selected"@endif>每页显示15</option>
                                        <option value="20" @if(isset($merge['paginate']) && $merge['paginate'] == 20)selected="selected"@endif>每页显示20</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
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
                        <label class="position-relative">
                            <input type="checkbox" class="ace" />
                            <span class="lbl"></span>
                        </label>

                    </th>
                    <th>编号</th>
                    <th>认证用户</th>
                    <th>认证公司名称</th>
                    <th >所属行业</th>

                    <th>
                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                        申请时间
                    </th>
                    <th><i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>认证时间</th>
                    <th>
                        状态
                    </th>
                    <th>处理</th>
                </tr>
                </thead>

                <tbody>
                @if($enterprise)
                @foreach($enterprise as $item)
                    <tr>
                        <td class="center">
                            <label class="pos-rel">
                                <input type="checkbox" class="ace auth_id" name="ckb[]" value="{!! $item->id !!}"/>
                                <span class="lbl"></span>
                            </label>
                        </td>

                        <td>
                            <a href="#">{!! $item->id !!}</a>
                        </td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->company_name !!}</td>
                        <td>{!! $item->cate_name !!}</td>
                        <td>{!! $item->created_at !!}</td>
                        <td>
                            @if($item->auth_time){!! $item->auth_time !!}@else N/A @endif
                        </td>
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
                            <div class="btn-group">
                                @if($item->status == 0)
                                <a class="btn btn-xs btn-success" href="/manage/enterpriseAuthHandle/{!! $item->id !!}/pass">
                                    <i class="ace-icon fa fa-check bigger-120"></i>成功
                                </a>

                                <a class="btn btn-xs btn-danger" href="/manage/enterpriseAuthHandle/{!! $item->id !!}/deny">
                                    <i class="ace-icon fa fa-ban bigger-120"></i>失败
                                </a>
                                @endif
                                <a class="btn btn-xs btn-warning" href="{!! url('manage/enterpriseAuth/' . $item->id) !!}">
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
                @endif
            </table>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="col-sm-12">
                    <div class="dataTables_info row" id="sample-table-2_info">
                        <label><input type="checkbox" class="ace" id="allcheck"/>
                            <span class="lbl"></span> 全选
                        </label>
                        <button id="pass" type="submit" class="btn btn-sm btn-primary ">审核通过</button>
                        <button id="deny" type="submit" class="btn btn-sm btn-primary ">审核失败</button>
                    </div>
                </div>
            </div>
            <div class="space-10 col-xs-12"></div>
            <div class="col-xs-12">
                <div class="dataTables_paginate paging_bootstrap ">
                    <ul class="pagination">
                        {!! $enterprise->appends($merge)->render() !!}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div><!-- /.row -->

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}




{{--服务流程配置--}}
{{--<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">服务配置</h3>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="flow" class="tab-pane active row">
                                <div class="col-sm-12 flow-task">
                                    <form action="/manage/configUpdate" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="change_ids" value="" id="change-ids">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat">
                                                <h5 class="widget-title">服务规则和服务资金设置</h5>
                                            </div>

                                            <div class="widget-body">

                                                <div class="widget-main row">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">最小金额设定：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids" > 元(设置服务最小金额不得小于0元)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">交易提成比例：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> %(交易成功后，站长提取佣金的百分比，设为0即无抽佣)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">订单受理时限：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> 小时(设置X小时以后，未受理订单将会在X小时候后自动取消，设为0即无限制)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right"> 维权时间配置：</td>
                                                                <td> <input type="text"  name="" value="" class="change_ids"> 小时(服务商交付以后，可以维权的等待时间X小时，设为0即无限制）</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">验收天数配置：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> 天(交易完成后，X天未验收，系统自动验收)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right"> 评价天数配置：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> 天(交易完成X天后默认好评)</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="space"></div>
                                        <div class="text-right">
                                            <button class="btn btn-info">提交</button>　　
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

{{--商品流程配置--}}
{{--<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">商品配置</h3>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="flow" class="tab-pane active row">
                                <div class="col-sm-12 flow-task">
                                    <form action="/manage/configUpdate" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="change_ids" value="" id="change-ids">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-flat">
                                                <h5 class="widget-title">商品规则和商品资金设置</h5>
                                            </div>

                                            <div class="widget-body">

                                                <div class="widget-main row">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">最小金额设定：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids" > 元(设置商品上架金额不得小于X元，设为0即无限制)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">交易提成比例：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> %(交易成功后，站长提取佣金的百分比，设为0即无抽佣)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">维权时间配置：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> 小时(服务商交付以后，可以维权的等待时间为X小时，设未0即无限制)</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right"> 文件确认配置：</td>
                                                                <td> <input type="text"  name="" value="" class="change_ids"> 天(交易完成后，X天未确认源文件，系统主动确认）</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-sm-3 flow-money text-right">评价天数配置：</td>
                                                                <td> <input type="text" name="" value="" class="change_ids"> 天(交易完成X天后默认好评)</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="space"></div>
                                        <div class="text-right">
                                            <button class="btn btn-info">提交</button>　　
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>--}}

{{--商品管理--}}
{{--
<div class="page-content-area">
    <h3 class="header smaller lighter blue">商品管理</h3>
    <div class="row">
        <div class="col-xs-12">
            <div class="clearfix  well">
                <form role="form" class="form-inline search-group">
                    <div class="row">
                        <div class="col-md-4">商品名： <input type="text" name="employer_name"></div>
                        <div class="col-md-4">店主： <input type="text" name="employ_title"></div>
                        <button class="btn btn-primary btn-sm">搜索
                        </button>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">商品状态：
                            <select class="" name="orderby">
                                <option value="" ></option>

                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="dataTables_borderWrap"> -->
            <div>
                <form action="/manage/managerDeleteAll" method="post">
                    <input type="hidden" name="_token" value="Q8olGWxsp4BTmFfh3mYWlOYNutLUU16oT7LG1xK6">
                    <table id="sample-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            --}}
{{--<th class="center">--}}{{--

                            --}}
{{--<label class="position-relative">--}}{{--


                            --}}
{{--<input type="checkbox" class="ace">--}}{{--

                            --}}
{{--<span class="lbl"></span>--}}{{--


                            --}}
{{--</label>--}}{{--

                            --}}
{{--</th>--}}{{--

                            <th></th>
                            <th>编号</th>
                            <th>商品名</th>
                            <th>商品报价（元）</th>
                            <th>店主</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="center">
                                    <label class="position-relative">
                                        <input type="checkbox" class="ace" value="" name="id">
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="#">5</a>
                                </td>
                                <td>实打实的</td>
                                <td>
                                    ￥100.00
                                </td>
                                <td>coolxhcn</td>
                                <td>
                                    待审核
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-success" href="">
                                            <i class="fa fa-check "></i>审核通过
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="fa fa-ban "></i>审核失败
                                        </a>
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        --}}
{{--<a class="btn btn-xs btn-danger" href="">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>--}}{{--

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                <label class="position-relative">
                                <input type="checkbox" class="ace" value="" name="id">
                                <span class="lbl"></span>
                                </label>
                                </td>
                                <td>
                                    <a href="#">4</a>
                                </td>
                                <td>实打实的</td>
                                <td>
                                    ￥100.00
                                </td>
                                <td>coolxhcn</td>
                                <td>
                                    已下架
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-success" href="">
                                            <i class="fa fa-check "></i>上架
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                <label class="position-relative">
                                <input type="checkbox" class="ace" value="" name="id">
                                <span class="lbl"></span>
                                </label>
                                </td>
                                <td>
                                    <a href="#">3</a>
                                </td>
                                <td>实打实的</td>
                                <td>
                                    ￥100.00
                                </td>
                                <td>coolxhcn</td>
                                <td>
                                    出售中
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="fa fa-trash-o"></i>下架
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                <label class="position-relative">
                                <input type="checkbox" class="ace" value="" name="id">
                                <span class="lbl"></span>
                                </label>
                                </td>
                                <td>
                                    <a href="#">2</a>
                                </td>
                                <td>实打实的</td>
                                <td>
                                    ￥100.00
                                </td>
                                <td>coolxhcn</td>
                                <td>
                                    审核失败
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>查看更新
                                        </a>
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="center">
                                <label class="position-relative">
                                <input type="checkbox" class="ace" value="" name="id">
                                <span class="lbl"></span>
                                </label>
                                </td>
                                <td>
                                    <a href="#">1</a>
                                </td>
                                <td>实打实的阿萨德</td>
                                <td>
                                    ￥20.00
                                </td>
                                <td>coolxhcn</td>
                                <td>
                                    审核失败
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-xs btn-info" href="">
                                            <i class="fa fa-search "></i>编辑
                                        </a>
                                        <a class="btn btn-xs btn-danger" href="">
                                            <i class="fa fa-trash-o"></i>删除
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-sm-6">
                        <div class="dataTables_info" id="sample-table-2_info">
                            <label>
                                <input type="checkbox" class="ace" id="allcheck"/>
                                <span class="lbl"></span>全选
                            </label>
                            --}}
{{--<button>新增分类</button>--}}{{--

                            <button type="submit" class="btn btn-sm btn-primary">通过审核</button>
                            <button type="submit" class="btn btn-sm btn-primary">不通过审核</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dataTables_paginate paging_bootstrap text-right">
                                <ul class="pagination">
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{!! Theme::asset()->container('custom-js')->usepath()->add('categorylist', 'js/doc/categorylist.js') !!}--}}


{{--商品详情--}}
{{--<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">商品管理</h3>
                    <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab2">
                            <li class="active">
                                <a data-toggle="tab" href="">商品信息</a>
                            </li>

                            <li class="">
                                <a  href="">评价</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="need" class="tab-pane active">
                                <div class="row">
                                    <form action="" method="post" name="seo-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="">
                                        <div class="col-lg-12">
                                            <div class="clearfix form-horizontal">
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店主： </label>

                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2 row">muku</label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品名称： </label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="col-sm-5" name="title" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品分类： </label>

                                                    <div class="col-sm-9">
                                                        <select name="" id="">
                                                            <option value=""></option>
                                                        </select>
                                                        <select name="" id="">
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品报价： </label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="col-sm-4" name="title" value=""> 元
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品状态： </label>

                                                    <div class="col-sm-9">
                                                        待审核
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 发布时间： </label>
                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2 row">2016-09-01</label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品描述： </label>
                                                    <div class="col-sm-9">
                                                        <div class="clearfix ">
                                                            <div class="wysiwyg-editor" id="editor1">234</div>
                                                            <input type="hidden" name="desc" id="discription-edit" datatype="*" nullmsg="需求描述不能为空" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> seo标题： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_title" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" rows="2"> seo关键字： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class=" col-xs-5 col-sm-5" rows="1" name="seo_keywords"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> seo描述： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_content" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="space-10"></div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-3 col-md-9 ">
                                                        <div class="row">
                                                            <button class="btn btn-info" type="submit" >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                提交
                                                            </button>
                                                            <button class="btn btn-success" type="submit" >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                审核通过
                                                            </button>
                                                            <button class="btn btn-danger" type="submit" >
                                                                <i class="ace-icon fa fa-ban bigger-110"></i>
                                                                审核不通过
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>

                                                    <div class="col-sm-9">
                                                        <a href="">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">下一项</a>
                                                    </div>
                                                </div>
                                                <div class="space-24"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}--}}


{{--商品评价--}}
{{--
<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">商品管理</h3>
                    <div class="widget-toolbar no-border">
                        <ul class="nav nav-tabs" id="myTab2">
                            <li class="">
                                <a data-toggle="tab" href="">商品信息</a>
                            </li>

                            <li class="active">
                                <a  href="">评价</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="need" class="tab-pane active">
                                <div class="row">
                                    <form action="" method="post" name="seo-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="">
                                        <div class="col-lg-12">
                                            <div class="clearfix form-horizontal">

                                                <div class="form-group basic-form-bottom">
                                                    <div class="col-sm-1 record"><span class="flower1">好评</span></div>
                                                    <div class="col-sm-10 g-message"><div class="col-sm-3"><b>amin</b> 评价 <b>coolxhcn</b></div> <div class="col-sm-3"><b>评价时间：</b> 2016-02-02</div>
                                                        <div class="col-sm-4 s-myborder ">
                                                            <span class="cor-gray87 z-hov">
                                                                综合评分：<span class="cor-orange">0 </span><i class="u-evaico"></i>
                                                                <div class="u-recordstar b-border ">
                                                                    <div>
                                                                        工作速度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 速度很慢
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作质量：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 质量很差
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作态度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 态度很差
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="space-14"></div>
                                                        <p class="col-sm-12">态度很差态度很差态度很差态度很差态度很差态度很差态度很差</p>
                                                    </div>

                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <div class="col-sm-1 record"><span class="flower2">中评</span></div>
                                                    <div class="col-sm-10 g-message"><div class="col-sm-3"><b>amin</b> 评价 <b>coolxhcn</b></div> <div class="col-sm-3"><b>评价时间：</b> 2016-02-02</div>
                                                        <div class="col-sm-4 s-myborder ">
                                                            <span class="cor-gray87 z-hov">
                                                                综合评分：<span class="cor-orange">0 </span><i class="u-evaico"></i>
                                                                <div class="u-recordstar b-border ">
                                                                    <div>
                                                                        工作速度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 速度很慢
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作质量：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 质量很差
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作态度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 态度很差
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="space-14"></div>
                                                        <p class="col-sm-12">态度很差态度很差态度很差态度很差态度很差态度很差态度很差</p>
                                                    </div>

                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <div class="col-sm-1 record"><span class="flower3">差评</span></div>
                                                    <div class="col-sm-10 g-message"><div class="col-sm-3"><b>amin</b> 评价 <b>coolxhcn</b></div> <div class="col-sm-3"><b>评价时间：</b> 2016-02-02</div>
                                                        <div class="col-sm-4 s-myborder ">
                                                            <span class="cor-gray87 z-hov">
                                                                综合评分：<span class="cor-orange">0 </span><i class="u-evaico"></i>
                                                                <div class="u-recordstar b-border ">
                                                                    <div>
                                                                        工作速度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 速度很慢
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作质量：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 质量很差
                                                                    </div>
                                                                    <div class="space-8"></div>
                                                                    <div>
                                                                        工作态度：
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                        <a class="cor-orange mg-left">0分 </a>
                                                                        - 态度很差
                                                                    </div>
                                                                </div>
                                                            </span>
                                                        </div>
                                                        <div class="space-14"></div>
                                                        <p class="col-sm-12">态度很差态度很差态度很差态度很差态度很差态度很差态度很差</p>
                                                    </div>

                                                </div>

                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>

                                                    <div class="col-sm-9">
                                                        <a href="">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">下一项</a>
                                                    </div>
                                                </div>
                                                <div class="space-24"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}
{!! Theme::asset()->container('custom-css')->usepath()->add('messages','css/usercenter/messages/messages.css') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('ownercomment','js/doc/ownercomment.js') !!}--}}


{{--订单管理--}}
{{--<div class="row">
    <div class="col-xs-12">
        <div class="clearfix table-responsive">
            <div class="space"></div>

            <h3 class="header smaller lighter blue">订单管理</h3>
            <div class="form-inline search-group">
                <form  role="form" action="/manage/enterpriseAuthList" method="get">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label for="name">订单名：</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list">
                                    <label for="namee">　下单人：</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="请输入公司名" @if(isset($merge['company_name']))value="{!! $merge['company_name'] !!}" @endif>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label class="">订单状态：</label>
                                    <select class="sort-list" name="status">
                                        <option value="0">全部</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list sort">
                                    <select class="sort-list" name="time_type">
                                        <option value="enterprise_auth.created_at" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.created_at')selected="selected"@endif>下单时间</option>
                                        <option value="enterprise_auth.auth_time" @if(isset($merge['time_type']) && $merge['time_type'] == 'enterprise_auth.auth_time')selected="selected"@endif>审核时间</option>
                                    </select>
                                    <div class="input-daterange input-group">
                                        <input type="text" name="start" class="input-sm form-control" value="@if(isset($merge['start'])){!! $merge['start'] !!}@endif">
                                        <span class="input-group-addon"><i class="fa fa-exchange"></i></span>
                                        <input type="text" name="end" class="input-sm form-control" value="@if(isset($merge['end'])){!! $merge['end'] !!}@endif">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div class="table-responsive">
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>订单名</th>
                    <th>订单金额（元）</th>
                    <th >下单人</th>

                    <th>
                        <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                        下单时间
                    </th>
                    <th>
                        订单状态
                    </th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                        <tr>

                            <td>
                                <a href="#">5</a>
                            </td>
                            <td>似的发射点发射点</td>
                            <td>￥100.00</td>
                            <td>coolxhcn</td>
                            <td>2016-03-03</td>
                            <td>
                                工作中
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a title="删除" href="/manage/commentDel/130" class="btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                    </a>

                                </div>

                            </td>
                        </tr>
                        <tr>

                            <td>
                                <a href="#">5</a>
                            </td>
                            <td>似的发射点发射点</td>
                            <td>￥100.00</td>
                            <td>coolxhcn</td>
                            <td>2016-03-03</td>
                            <td>
                                待接受
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a title="删除" href="/manage/commentDel/130" class="btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                    </a>

                                </div>

                            </td>
                        </tr>
                        <tr>

                            <td>
                                <a href="#">5</a>
                            </td>
                            <td>似的发射点发射点</td>
                            <td>￥100.00</td>
                            <td>coolxhcn</td>
                            <td>2016-03-03</td>
                            <td>
                                待付款
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a title="删除" href="/manage/commentDel/130" class="btn btn-xs btn-danger">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>删除
                                    </a>

                                </div>

                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}--}}

{{--订单详细--}}
{{--
<h3 class="header smaller lighter blue">订单管理</h3>
<div class="g-backrealdetails clearfix">
    <div class="space-10"></div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">下单人：</p>
        <p class="col-md-11">admin</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">联系方式：</p>
        <p class="col-md-11">15927499759</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">服务商：</p>
        <p class="col-md-11">coolxhcn</p>
    </div>

    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">订单名称：</p>
        <p class="col-md-11">哦吼吼吼吼</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">订单预算：</p>
        <p class="col-md-11">￥500.00</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">服务描述：</p>
        <p class="col-md-11">老牛逼了的萨达萨达啥的啥的啥的撒的撒啥的啥的撒啥的撒的撒的撒的撒的撒的撒的撒大大撒
            萨达萨达的撒的啥的撒的撒
            啥的萨达撒</p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">附件：</p>
        <p class="col-md-11"><a href="" class="btn btn-sm btn-info" target="_blank">附件1</a></p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">截止工期：</p>
        <p class="col-md-11">
            2016-02-02
        </p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">发布时间：</p>
        <p class="col-md-11">
            2016-02-02
        </p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">受理时间：</p>
        <p class="col-md-11">
            2016-02-02
        </p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">订单状态：</p>
        <p class="col-md-11">
            待接受
        </p>
    </div>
    <div class="realname-bottom clearfix col-xs-12">
        <p class="col-md-1 text-right">付款状态：</p>
        <p class="col-md-11">
            已付款
        </p>
    </div>

    <div class="col-xs-12">
        <div class="space-8"></div>
        <p class="col-md-10 col-md-offset-1">

                <a href="">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <a href="">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="">下一项</a>

        </p>
    </div>
</div>

{!! Theme::asset()->container('custom-css')->usePath()->add('backstage', 'css/backstage/backstage.css') !!}--}}


{{--店铺设置--}}
{{--
<div class="row">
    <div class="col-xs-12">
        <div class="clearfix table-responsive">
            <div class="space"></div>

            <h3 class="header smaller lighter blue">店铺设置</h3>
            <div class="form-inline search-group">
                <form  role="form" action="/manage/enterpriseAuthList" method="get">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label for="name">用户名：</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="请输入用户名" @if(isset($merge['name']))value="{!! $merge['name'] !!}" @endif>
                                </div>
                            </td>
                            <td>
                                <div class="form-group search-list">
                                    <label for="namee">　店铺名：</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="请输入公司名" @if(isset($merge['company_name']))value="{!! $merge['company_name'] !!}" @endif>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">搜索</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group search-list sort">
                                    <label class="">店铺状态：</label>
                                    <select class="sort-list" name="status">
                                        <option value="0">全部</option>
                                    </select>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>

        <!-- <div class="table-responsive"> -->

        <!-- <div class="dataTables_borderWrap"> -->
        <div class="table-responsive">
            <table id="sample-table" class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>店主</th>
                    <th>店铺名</th>
                    <th >商品数</th>

                    <th>
                        服务数
                    </th>
                    <th>
                        店铺状态
                    </th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody>
                <tr>

                    <td>
                        <a href="#">5</a>
                    </td>
                    <td>coolxhcn</td>
                    <td>呵呵呵</td>
                    <td>2</td>
                    <td>33</td>
                    <td>
                        开启
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-info" href="/manage/editNav/3">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                            <a title="删除" href="/manage/commentDel/130" class="btn btn-xs btn-danger">
                                <i class="ace-icon fa fa-ban bigger-120"></i>关闭店铺
                            </a>
                            <a class="btn btn-xs btn-success" href="">
                                <i class="fa fa-check "></i>推荐
                            </a>
                        </div>

                    </td>
                </tr>
                <tr>

                    <td>
                        <a href="#">5</a>
                    </td>
                    <td>coolxhcn</td>
                    <td>呵呵呵</td>
                    <td>2</td>
                    <td>33</td>
                    <td>
                        关闭
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs btn-info" href="/manage/editNav/3">
                                <i class="fa fa-edit bigger-120"></i>编辑
                            </a>
                            <a class="btn btn-xs btn-success" href="">
                                <i class="fa fa-check "></i>开启店铺
                            </a>
                        </div>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div><!-- /.row -->

{!! Theme::asset()->container('specific-css')->usePath()->add('datepicker-css', 'plugins/ace/css/datepicker.css') !!}
{!! Theme::asset()->container('specific-js')->usePath()->add('datepicker-js', 'plugins/ace/js/date-time/bootstrap-datepicker.min.js') !!}
{!! Theme::asset()->container('custom-js')->usePath()->add('userfinance-js', 'js/userfinance.js') !!}
{!! Theme::asset()->container('custom-js')->usepath()->add('enterpriseauthlist', 'js/doc/enterpriseauthlist.js') !!}--}}

{{--店铺设置编辑--}}
{{--
<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">店铺设置</h3>

                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="need" class="tab-pane active">
                                <div class="row">
                                    <form action="" method="post" name="seo-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="">
                                        <div class="col-lg-12">
                                            <div class="clearfix form-horizontal">
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店主： </label>

                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2 row">muku</label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺名： </label>

                                                    <div class="col-sm-9">
                                                        <input type="text" class="col-sm-5" name="title" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺介绍： </label>
                                                    <div class="col-sm-9">
                                                        <div class="clearfix ">
                                                            <div class="wysiwyg-editor" id="editor1">234</div>
                                                            <input type="hidden" name="desc" id="discription-edit" datatype="*" nullmsg="需求描述不能为空" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺地址： </label>

                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2 row">湖北 武汉</label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺标签： </label>

                                                    <div class="col-sm-9">
                                                        <label class="col-sm-2 row">军事模型</label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺封面： </label>

                                                    <div class="col-sm-9">
                                                        <img src="" alt="">
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 店铺状态： </label>

                                                    <div class="col-sm-9">
                                                        <select name="" id="">
                                                            <option value="">开启</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> seo标题： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_title" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" rows="2"> seo关键字： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class=" col-xs-5 col-sm-5" rows="1" name="seo_keywords"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> seo描述： </label>

                                                    <div class="col-sm-9">
                                                        <textarea class="col-xs-5 col-sm-5" rows="1" name="seo_content" ></textarea>
                                                    </div>
                                                </div>
                                                <div class="space-10"></div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-3 col-md-9 ">
                                                        <div class="row">
                                                            <button class="btn btn-info" type="submit" >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                提交
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>

                                                    <div class="col-sm-9">
                                                        <a href="">上一项</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">返回列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="">下一项</a>
                                                    </div>
                                                </div>
                                                <div class="space-24"></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Theme::widget('editor')->render() !!}
{!! Theme::asset()->container('custom-css')->usePath()->add('back-stage-css', 'css/backstage/backstage.css') !!}--}}

{{--店铺配置--}}
{{--
<div class="page-content-area">
    <div class="row">
        <div class="col-xs-12 widget-container-col ui-sortable">
            <div class="widget-box transparent ui-sortable-handle">
                <div class="widget-header">
                    <h3 class="widget-title lighter">店铺设置</h3>

                </div>
                <div class="widget-body">
                    <div class="widget-main padding-12 no-padding-left no-padding-right">
                        <div class="tab-content padding-4">
                            <div id="need" class="tab-pane active">
                                <div class="row">
                                    <form action="" method="post" name="seo-form">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="">
                                        <div class="col-lg-12">
                                            <div class="clearfix form-horizontal">
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品上架审核： </label>
													<div class="col-sm-9">
                                                        <label><input class="ace" type="radio" name="css_adaptive" value="1" checked="checked"><span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label><input class="ace" type="radio" name="css_adaptive" value="2"><span class="lbl"> 关闭 </span></label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1" rows="2"> 服务上架审核： </label>

                                                    <div class="col-sm-9">
                                                        <label><input class="ace" type="radio" name="css_adaptive2" value="1" checked="checked"><span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label><input class="ace" type="radio" name="css_adaptive2" value="2"><span class="lbl"> 关闭 </span></label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 商品/服务推荐： </label>

                                                    <div class="col-sm-9">
                                                        <label><input class="ace" type="radio" name="css_adaptive3" value="1" checked="checked"><span class="lbl"> 开启</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <label><input class="ace" type="radio" name="css_adaptive3" value="2"><span class="lbl"> 关闭 </span></label>
                                                    </div>
                                                </div>
                                                <div class="form-group basic-form-bottom">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 推荐配置： </label>

                                                    <div class="col-sm-9">
                                                        <input type="text"> 元 <select name="" id="">
                                                            <option value="">年</option><option value="">月</option><option value="">天</option></select>
                                                    </div>
                                                </div>
                                                <div class="space-10"></div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-3 col-md-9 ">
                                                        <div class="row">
                                                            <button class="btn btn-info" type="submit" >
                                                                <i class="ace-icon fa fa-check bigger-110"></i>
                                                                提交
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
--}}
{!! Theme::asset()->container('custom-css')->usepath()->add('backstage', 'css/backstage/backstage.css') !!}
<!--{!! Theme::widget('editor')->render() !!}-->

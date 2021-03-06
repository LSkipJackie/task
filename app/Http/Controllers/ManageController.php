<?php

namespace App\Http\Controllers;

use App\Modules\Manage\Model\MenuModel;
use App\Modules\Manage\Model\MenuPermissionModel;
use App\Modules\Manage\Model\Permission;
use App\Modules\Manage\Model\ManagerModel;
use App\Modules\Manage\Model\ConfigModel;
use Illuminate\Support\Facades\Route;
use Cache;


class ManageController extends BasicController
{
    public $manager;
    public function __construct()
    {
        parent::__construct();

        //初始化后台菜单
        if (ManagerModel::getManager())
        {
            //
            $this->manageBreadcrumb();
            $this->breadcrumb = $this->theme->breadcrumb();
            $this->manager = ManagerModel::getManager();
            $this->theme->setManager($this->manager->username);

            //初始化后台菜单
            $manageMenu = MenuModel::getMenuPermission();
            $this->theme->set('manageMenu', $manageMenu);
        }

        //路由与面包屑
        $route = Route::currentRouteName();
        //查询权限,除了登录页面的路由
        if($route!='loginCreatePage')
        {
            $permission = Permission::where('name',$route)->first();
            if(!is_null($permission))
            {
                $permission = MenuPermissionModel::where('permission_id',$permission['id'])->first()->toArray();
                //查询菜单
                $menu_data = MenuModel::getMenu($permission['menu_id']);
                $this->theme->set('menu_data', $menu_data['menu_data']);
                $this->theme->set('menu_ids',$menu_data['menu_ids']);
            }
        }

        //获取基本配置（IM css自适应 客服QQ）
        $basisConfig = ConfigModel::getConfigByType('basis');
        if(!empty($basisConfig)){
            $this->theme->set('basis_config',$basisConfig);
        }

        //菜单图标(先写死)
        $menuIcon = [
            '后台首页'=>'fa-home',
            '系统配置'=>'fa-cog',
            '用户管理'=>'fa-users',
            '店铺管理'=>'fa-home',
            '任务控制台'=>'fa-tasks',
            '推荐管理'=>'fa-external-link',
            '站长工具'=>'fa-user',
            '资讯管理'=>'fa-file-text',
            '财务管理'=>'fa-bar-chart-o',
            '短信模板'=>'fa-envelope'
        ];
        $this->theme->set('menuIcon',$menuIcon);

        //获取授权码
        $kppwAuthCode = config('kppw.kppw_auth_code');
        if(!empty($kppwAuthCode)){
            $kppwAuthCode = \CommonClass::starReplace($kppwAuthCode, 5, 4);
            $this->theme->set('kppw_auth_code',$kppwAuthCode);
        }


    }
}

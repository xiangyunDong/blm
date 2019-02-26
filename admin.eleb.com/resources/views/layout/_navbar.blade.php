<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->



        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家分类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shop_categories.create')}}">添加分类</a></li>
                        <li><a href="{{route('shop_categories.index')}}">分类列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家信息管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('shops.create')}}">添加商家</a></li>
                        <li><a href="{{route('shops.index')}}">商家列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家账号管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('users.create')}}">添加商家账号</a></li>
                        <li><a href="{{route('users.index')}}">商家账号列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理员账号管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('admins.create')}}">添加管理员账号</a></li>
                        <li><a href="{{route('admins.index')}}">管理员账号列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">活动管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('activities.create')}}">添加活动</a></li>
                        <li><a href="{{route('activities.index')}}">活动列表</a></li>
                        <form class="navbar-form navbar-left" method="get" action="{{route('activities.index')}}">
                            <div class="form-group">
                                <select class="form-control" name="keyword">
                                    <option  value="1">未开始</option>
                                    <option  value="2">进行中</option>
                                    <option  value="-1">已结束</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-default">提交</button>
                        </form>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav">
                @guest()
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest()
                    @auth()
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">个人中心</a></li>
                        <li><a href="{{route('admins.password')}}">修改密码</a></li>
                        <li><a href="{{route('logout')}}">退出登录</a></li>
                    </ul>
                </li>
                    @endauth()
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
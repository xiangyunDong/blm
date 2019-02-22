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
                @guest()
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest()
                    @auth()
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">个人中心</a></li>
                        <li><a href="">修改密码</a></li>
                        <li><a href="{{route('logout')}}">退出登录</a></li>
                    </ul>
                </li>
                    @endauth()
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
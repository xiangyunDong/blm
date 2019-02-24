<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->



        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商家账号管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('users.create')}}">商家注册</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品分类管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menu_categories.create')}}">添加菜品分类</a></li>
                        <li><a href="{{route('menu_categories.index')}}">菜品分类列表</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜品管理<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menus.create')}}">添加菜品</a></li>
                        <li><a href="{{route('menus.index')}}">菜品列表</a></li>
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
                            <li><a href="{{route('users.password')}}">修改密码</a></li>
                            <li><a href="{{route('logout')}}">退出登录</a></li>
                        </ul>
                    </li>
                @endauth()
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
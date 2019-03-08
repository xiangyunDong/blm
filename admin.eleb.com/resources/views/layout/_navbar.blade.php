<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <?php
            header("content-type:text/html;charset=utf-8");
            $link = mysqli_connect("localhost", "root", "root", "blm") or die("链接出错");
            mysqli_query($link, "set names utf8");
            $sql = "select * from navs where pid=0";
            $result = mysqli_query($link, $sql);
            while($row = mysqli_fetch_assoc($result)):
            ?>
                @if(auth()->user())
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?=$row['name']?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @endif
                        <?php
                        $sq = "select * from navs where pid=" . $row['id'];
                        $resul = mysqli_query($link, $sq);
                        while($res = mysqli_fetch_assoc($resul)):
                        ?>
                        @if(auth()->user())
                            @if(auth()->user()->can($res['url']))
                                <li><a href="{{route($res['url'])}}"><?=$res['name']?></a></li>
                            @endif
                        @endif
                        <?php
                        endwhile;
                        ?>
                    </ul>
                </li>
            </ul>
            <?php
            endwhile;
            ?>
            <ul class="nav navbar-nav">
                @guest()
                    <li><a href="{{route('login')}}">登录</a></li>
                @endguest()
                @auth()
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{auth()->user()->name}}<span class="caret"></span></a>
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
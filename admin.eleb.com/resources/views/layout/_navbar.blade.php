<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <?php
            header("content-type:text/html;charset=utf-8");
            $link = mysqli_connect("localhost","root","root","blm") or die("链接出错");
            mysqli_query($link,"set names utf8");
            $sql = "select * from navs where pid=0";
            $result = mysqli_query($link,$sql);
            while($row = mysqli_fetch_assoc($result)):
                ?>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$row['name']?><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php
                        $sq = "select * from navs where pid=".$row['id'];
                        $resul = mysqli_query($link,$sq);
                        while($res = mysqli_fetch_assoc($resul)):
                        ?>
                        <li><a href="{{route($res['url'])}}"><?=$res['name']?></a></li>
                            <?php
                            endwhile;
                            ?>
                    </ul>
                </li>
            </ul>
                <?php
                endwhile;
                ?>
            <form class="navbar-form navbar-left" method="get" action="{{route('members.index')}}">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入会员名或手机号" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
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
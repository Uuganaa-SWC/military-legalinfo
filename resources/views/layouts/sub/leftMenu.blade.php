<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#">ПХТ</a>
            <a class="navbar-brand hidden" href="#" class="fas fa-bars"></a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <h3 class="menu-title">Цэргийн дүрэм</h3><!-- /.menu-title -->
                    <li>
                        <li><a href="{{url("/show/rule")}}"> <i class="menu-icon fa fa-check"></i>Дүрэм зассах</a></li>
                        <li><a href="{{url("/show/group")}}"> <i class="menu-icon fa fa-check"></i>Бүлэг зассах</a></li>
                        <li><a href="{{url("/show/soldier")}}"> <i class="menu-icon fa fa-book"></i>Дүрэм оруулах</a></li>
                    </li>
            </ul>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <h3 class="menu-title">Хууль, Эрх зүй</h3><!-- /.menu-title -->
                    <li><a href="{{url("/discipline/law/articles/show")}}"> <i class="menu-icon fa fa-user"></i>Цэс нэмэх</a></li>
                    <li><a href="{{url("/discipline/law/law/show")}}"> <i class="menu-icon fa fa-user"></i>Хууль оруулах</a></li>
            </ul>
        </div>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <h3 class="menu-title">Зааварууд бэлтгэх</h3><!-- /.menu-title -->
                    <li>
                        <li><a href="{{url("/show/instruction")}}"> <i class="menu-icon fa fa-graduation-cap"></i>Төлбөр төлөх заавар</a></li>
                        <li><a href="{{url("/show/zaawar")}}"> <i class="menu-icon fa fa-graduation-cap"></i>Ашиглах заавар</a></li>
                        <li><a href="{{url("/contacts/show")}}"> <i class="menu-icon fa fa-graduation-cap"></i>Холбоо барих</a></li>
                    </li>
            </ul>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <h3 class="menu-title">Хэрэглэгч нэмэх</h3><!-- /.menu-title -->
                    <li>
                        <li><a href="{{url("/show/userTable")}}"> <i class="menu-icon fa fa-users"></i>Хэрэглэгч бүртгэх</a></li>
                        <li><a href="{{url("/show/historyTable")}}"> <i class="menu-icon fa fa-users"></i>Архив</a></li>
                    </li>
            </ul>
        </div>
    </nav>
</aside>

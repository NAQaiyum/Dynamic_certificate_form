<div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
    <nav class="mobile-menu" id="mobile-menu">
        <div class="sidebar-nav">
            <ul class="nav side-menu">
                <!-- <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                <button class="btn mobile-menu-btn" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                </li> -->
                <li><a href="{{ route('frontend::home') }}">Home</a></li>
                @foreach(Category(null,'ASC')->where('parent_id', null) as $cat)
                <li>
                @if($cat->child->count() > 0)
                    <a href="#">{{ $cat->title }}<span class="fa arrow"></span></a>
                @else 
                    <a href="{{route('frontend::news.index',['slug' => $cat->slug])}}">{{ $cat->title }}</a>
                @endif
                    <ul class="nav nav-second-level">
                        @foreach($cat->child as $child)
                        <li><a href="{{route('frontend::news.index',['slug' => $child->slug])}}">{{ $child->title }}</a></li>
                        @endforeach
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endforeach
                <li>
                    <a href="#">Blog </a>
                </li>
                <li>
                    <a href="#">Contact </a>
                </li>
                <!-- social icon -->
                <li>
                    <div class="social">
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                            <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                            <li><a href="#" class="google"><i class="fa  fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="top_header_icon">
            <span class="top_header_icon_wrap">
                    <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                </span>
            <span class="top_header_icon_wrap">
                    <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                </span>
            <span class="top_header_icon_wrap">
                    <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                </span>
            <span class="top_header_icon_wrap">
                    <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                </span>
            <span class="top_header_icon_wrap">
                    <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                </span>
        </div>
        <div id="showLeft" class="nav-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
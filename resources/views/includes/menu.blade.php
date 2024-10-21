<section id="menu">
    <div class="container">
        <div class="menu-area">
            <!-- Navbar -->
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        @foreach ($categories as $category)
                            <li>                                
                                @if($category->subcategories->count())
                                    <a href="{{ route('category.product', [$category->slug]) }}">{{ $category->name }}
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach ($category->subcategories as $subcategory)
                                            <li>
                                                <a href="{{ route('category.product', [$category->slug, $subcategory->slug]) }}">{{ $subcategory->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <a href="{{ route('category.product', $category->slug) }}">{{ $category->name }}</a>
                                @endif
                            </li>                            
                        @endforeach                        
                        <li>
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ ('home') }}" aria-expanded="false">
        <iconify-icon icon="iconamoon:home" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Accueil</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('users.index') }}" aria-expanded="false">
        <iconify-icon icon="icomoon-free:users" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">utilisateurs</span>
    </a>
</li>



@role('Super-admin')
    <li class="sidebar-item">
        <a class="sidebar-link two-column has-arrow indigo-hover-bg" aria-expanded="false">
            <iconify-icon icon="line-md:account" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Administrateur</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            <!-- Teachers -->
            <li class="sidebar-item">
                <a href="{{ ('categories.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    <iconify-icon icon="eos-icons:product-classes" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu text-truncate">Catégories</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ ('admin-articles.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    <iconify-icon icon="material-symbols:category-rounded" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu text-truncate">Articles</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ ('commandes.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    <iconify-icon icon="material-symbols:category-rounded" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu text-truncate">Commandes</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ ('telegramme-bot.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    <iconify-icon icon="material-symbols:category-rounded" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu text-truncate">Télégramme config</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ ('carousel-datas.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    <iconify-icon icon="bxs:carousel" class="fs-6 aside-icon"></iconify-icon>
                    {{-- <i class="ti ti-carousel-horizontal fs-6"></i> --}}
                    <span class="hide-menu text-truncate">Carousel visiteur</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ ('faqs.index') }}" class="sidebar-link">
                    {{-- <span class="sidebar-icon"></span> --}}
                    {{-- <iconify-icon icon="bxs:carousel" class="fs-6 aside-icon"></iconify-icon> --}}
                    <i class="ti ti-help fs-6"></i>
                    <span class="hide-menu text-truncate">Foire aux questions</span>
                </a>
            </li>


        </ul>
    </li>
@endrole

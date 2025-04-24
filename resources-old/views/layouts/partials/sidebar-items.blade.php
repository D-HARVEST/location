<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ ('home') }}" aria-expanded="false">
        <iconify-icon icon="iconamoon:home" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Accueil</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link two-column indigo-hover-bg" href="{{ ('boutique') }}" aria-expanded="false">
        <iconify-icon icon="solar:shop-broken" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Boutique</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link two-column indigo-hover-bg" href="{{ ('panier') }}" aria-expanded="false">
        <iconify-icon icon="solar:cart-4-bold-duotone" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Mon Panier </span>
        
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link two-column indigo-hover-bg" href="{{ ('mes-commandes') }}" aria-expanded="false">
        <iconify-icon icon="line-md:account" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Mes Commandes </span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg {{ Request::is('suivre-commande*') ? 'active' : '' }} "
        href="{{ ('suivre-commande') }}" aria-expanded="false">
        <iconify-icon icon="icon-park-twotone:search" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Suivre ma commande</span>
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

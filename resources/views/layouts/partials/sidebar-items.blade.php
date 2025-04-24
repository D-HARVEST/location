{{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ 'home' }}" aria-expanded="false">
        <iconify-icon icon="iconamoon:home" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Accueil</span>
    </a>
</li> --}}
<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="" aria-expanded="false">
        <iconify-icon icon="iconamoon:home" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Accueil</span>
    </a>
</li>
{{-- <li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('users.index') }}" aria-expanded="false">
        <iconify-icon icon="icomoon-free:users" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">utilisateurs</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link primary-hover-bg" href="{{ route('roles.index') }}" aria-expanded="false">
        <iconify-icon icon="hugeicons:hierarchy-square-02" class="fs-6 aside-icon"></iconify-icon>
        <span class="hide-menu ps-1">Roles</span>
    </a>
</li> --}}



@haspermission('gerer bourses')
    <li class="sidebar-item">
        <a class="sidebar-link primary-hover-bg" href="{{ route('bourses.index') }}" aria-expanded="false">
            <iconify-icon icon="guidance:study-room" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Bourses</span>
        </a>
    </li>
@endhaspermission


@role('Super-admin')
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow success-hover-bg" href="javascript:void(0)" aria-expanded="false">
            <iconify-icon icon="solar:layers-line-duotone" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Users & Roles</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            @haspermission('gerer users')
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ route('users.index') }}" aria-expanded="false">
                        <iconify-icon icon="icomoon-free:users" class="fs-6 aside-icon"></iconify-icon>
                        <span class="hide-menu ps-1">utilisateurs</span>
                    </a>
                </li>
            @endhaspermission
            @haspermission('gerer roles')
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ route('roles.index') }}" aria-expanded="false">
                        <iconify-icon icon="hugeicons:hierarchy-square-02" class="fs-6 aside-icon"></iconify-icon>
                        <span class="hide-menu ps-1">Roles</span>
                    </a>
                </li>
            @endhaspermission

        </ul>
    </li>
@endrole
@haspermission('gerer parametre de base systeme')
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow success-hover-bg" href="javascript:void(0)" aria-expanded="false">
            <iconify-icon icon="solar:layers-line-duotone" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Paramètre de base</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">
            <li class="sidebar-item">

                <a class="sidebar-link primary-hover-bg" href="{{ route('annee-academiques.index') }}"
                    aria-expanded="false">
                    <iconify-icon icon="fluent-mdl2:calendar-year" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Année Académique</span>
                </a>

            </li>

            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('pays.index') }}" aria-expanded="false">
                    <iconify-icon icon="gis:search-country" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Pays</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('cycles.index') }}" aria-expanded="false">
                    <iconify-icon icon="fa-solid:user-graduate" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Cycle Académique</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('diplome-de-bases.index') }}" aria-expanded="false">
                    <iconify-icon icon="solar:diploma-bold" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Diplôme de base</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('formulaires.index') }}" aria-expanded="false">
                    <iconify-icon icon="fluent:form-28-regular" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Formulaire</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('type-champs.index') }}" aria-expanded="false">
                    <iconify-icon icon="fluent:form-28-regular" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Type de champs</span>
                </a>
            </li>



        </ul>
    </li>
@endhaspermission

@haspermission('gerer parametre des bourses')
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow success-hover-bg" href="javascript:void(0)" aria-expanded="false">
            <iconify-icon icon="solar:layers-line-duotone" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Données des bourses</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">

            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('piece-jointes.index') }}" aria-expanded="false">
                    <iconify-icon icon="hugeicons:document-attachment" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Pièce Jointe</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('filieres.index') }}" aria-expanded="false">
                    <iconify-icon icon="icon-park-outline:category-management" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Filières</span>
                </a>
            </li>

        </ul>
    </li>
@endhaspermission
@haspermission('gerer traitement des bourses')
    <li class="sidebar-item">
        <a class="sidebar-link has-arrow success-hover-bg" href="javascript:void(0)" aria-expanded="false">
            <iconify-icon icon="solar:layers-line-duotone" class="fs-6 aside-icon"></iconify-icon>
            <span class="hide-menu ps-1">Traitement des bourses</span>
        </a>
        <ul aria-expanded="false" class="collapse first-level">

            <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('demandes.index') }}" aria-expanded="false">
                    <iconify-icon icon="solar:layers-line-duotone" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Demandes</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link primary-hover-bg" href="{{ route('bourses-accordees.index') }}" aria-expanded="false">
                    <iconify-icon icon="fluent:document-unknown" class="fs-6 aside-icon"></iconify-icon>
                    <span class="hide-menu ps-1">Bourses accordées</span>
                </a>
            </li> --}}

        </ul>
    </li>
@endhaspermission

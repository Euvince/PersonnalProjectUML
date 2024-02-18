@php
    $routeName = request()->route()->getName();
@endphp

<div class="main-menu">
    <div class="menu-inner">
        <nav>
            <ul class="metismenu" id="menu">
                @can('Gérer les Départements')
                    <li @class(['active' => str_contains($routeName, 'departements')])>
                        <a href="{{ route('super-admin.departements.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Départements</span></a>
                    </li>
                @endcan
                @can('Gérer les Communes')
                    <li @class(['active' => str_contains($routeName, 'communes')])>
                        <a href="{{ route('super-admin.communes.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Communes</span></a>
                    </li>
                @endcan
                @can('Gérer les Arrondissements')
                    <li @class(['active' => str_contains($routeName, 'arrondissements')])>
                        <a href="{{ route('super-admin.arrondissements.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Arrondissements</span></a>
                    </li>
                @endcan
                @can('Gérer les Quartiers')
                    <li @class(['active' => str_contains($routeName, 'quartiers')])>
                        <a href="{{ route('super-admin.quartiers.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Quartiers</span></a>
                    </li>
                @endcan
                @can('Gérer les Hôtels')
                    <li @class(['active' => str_contains($routeName, 'hotels')])>
                        <a href="{{ route('super-admin.hotels.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Hôtels</span></a>
                    </li>
                @endcan
                <li @class(['active' => str_contains($routeName, 'type-chambre')])>
                    <a href="{{ route('super-admin.type-chambre.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Types de Chambres</span></a>
                </li>
                {{-- <li @class(['active' => str_contains($routeName, 'roles')])>
                    <a href="{{ route('admin.roles.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Hôtels</span></a>
                </li> --}}
                {{-- <li @class(['active' => str_contains($routeName, 'employees')])>
                    <a href="{{ route('admin.employees.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Hôtels</span></a>
                </li> --}}
                {{-- <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i><span>Sidebar
                            Types
                        </span></a>
                    <ul class="collapse">
                        <li><a href="index.html">Left Sidebar</a></li>
                        <li><a href="index3-horizontalmenu.html">Horizontal Sidebar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                    <ul class="collapse">
                        <li><a href="barchart.html">bar chart</a></li>
                        <li><a href="linechart.html">line Chart</a></li>
                        <li><a href="piechart.html">pie chart</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i><span>UI Features</span></a>
                    <ul class="collapse">
                        <li><a href="accordion.html">Accordion</a></li>
                        <li><a href="alert.html">Alert</a></li>
                        <li><a href="badge.html">Badge</a></li>
                        <li><a href="button.html">Button</a></li>
                        <li><a href="button-group.html">Button Group</a></li>
                        <li><a href="cards.html">Cards</a></li>
                        <li><a href="dropdown.html">Dropdown</a></li>
                        <li><a href="list-group.html">List Group</a></li>
                        <li><a href="media-object.html">Media Object</a></li>
                        <li><a href="modal.html">Modal</a></li>
                        <li><a href="pagination.html">Pagination</a></li>
                        <li><a href="popovers.html">Popover</a></li>
                        <li><a href="progressbar.html">Progressbar</a></li>
                        <li><a href="tab.html">Tab</a></li>
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="form.html">Form</a></li>
                        <li><a href="grid.html">grid system</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-slice"></i><span>icons</span></a>
                    <ul class="collapse">
                        <li><a href="fontawesome.html">fontawesome icons</a></li>
                        <li><a href="themify.html">themify icons</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-table"></i>
                        <span>Tables</span></a>
                    <ul class="collapse">
                        <li><a href="table-basic.html">basic table</a></li>
                        <li><a href="table-layout.html">table layout</a></li>
                        <li><a href="datatable.html">datatable</a></li>
                    </ul>
                </li>
                <li><a href="maps.html"><i class="ti-map-alt"></i> <span>maps</span></a></li>
                <li><a href="invoice.html"><i class="ti-receipt"></i> <span>Invoice Summary</span></a></li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layers-alt"></i> <span>Pages</span></a>
                    <ul class="collapse">
                        <li><a href="login.html">Login</a></li>
                        <li><a href="login2.html">Login 2</a></li>
                        <li><a href="login3.html">Login 3</a></li>
                        <li><a href="register.html">Register</a></li>
                        <li><a href="register2.html">Register 2</a></li>
                        <li><a href="register3.html">Register 3</a></li>
                        <li><a href="register4.html">Register 4</a></li>
                        <li><a href="screenlock.html">Lock Screen</a></li>
                        <li><a href="screenlock2.html">Lock Screen 2</a></li>
                        <li><a href="reset-pass.html">reset password</a></li>
                        <li><a href="pricing.html">Pricing</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-exclamation-triangle"></i>
                        <span>Error</span></a>
                    <ul class="collapse">
                        <li><a href="404.html">Error 404</a></li>
                        <li><a href="403.html">Error 403</a></li>
                        <li><a href="500.html">Error 500</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>Multi
                            level menu</span></a>
                    <ul class="collapse">
                        <li><a href="#">Item level (1)</a></li>
                        <li><a href="#">Item level (1)</a></li>
                        <li><a href="#" aria-expanded="true">Item level (1)</a>
                            <ul class="collapse">
                                <li><a href="#">Item level (2)</a></li>
                                <li><a href="#">Item level (2)</a></li>
                                <li><a href="#">Item level (2)</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Item level (1)</a></li>
                    </ul>
                </li> --}}
            </ul>
        </nav>
    </div>
</div>
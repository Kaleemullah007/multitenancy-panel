<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>

                
                <li class="{{request()->is('dashboard')?'active':''}}">
                    <a href="{{ route('dashboard') }}"><img src="/assets/img/icons/dashboard.svg" alt="img"><span>
                            Dashboard</span> </a>
                </li>
                @haspermission('tenant_view')
                <li class="submenu" >
                    <a href="javascript:void(0);" class="active"><img src="/assets/img/icons/time.svg" alt="img"><span>
                        {{ __('tenant.tenants') }}</span> <span class="menu-arrow"></span></a>
                    <ul style="display: block;">
                    @haspermission('tenant_create')
                        <li><a href="{{ route('tenants.create') }}" class="active">{{ __('tenant.create_user') }}</a></li>
                    @endhaspermission
                    @haspermission('tenant_view')
                        <li><a href="{{ route('tenants.index') }}">{{ __('tenant.users') }}</a></li>
                    @endhaspermission
                
                
                    @haspermission('user_import_csv')
                        <li><a href="{{ route('file-import') }}">{{ __('tenant.btn-import-cvs') }}</a></li>
                    @endhaspermission
                
                    @haspermission('user_export_csv')
                        <li><a href="{{ route('export-users', ['id' => 1, 'format' => 'csv']) }}">
                           {{ __('tenant.btn-export-csv') }}</a></li>
                    @endhaspermission
                
                
                    @haspermission('user_export_excel')
                        <li><a href="{{ route('export-users', ['id' => 1, 'format' => 'xlsx']) }}">
                           {{ __('tenant.btn-export-xlsx') }}</a></li>
                    @endhaspermission
                
                
                    @haspermission('user_export_pdf')
                        <li><a href="{{ route('tenants.pdf') }}" download>{{ __('tenant.btn-export-pdf') }}</a></li>
                    @endhaspermission
                    </ul>
                </li>
                @endhaspermission
                @haspermission('plan_view')
                 <li class="submenu">
                    <a href="javascript:void(0);"><img src="/assets/img/icons/sales1.svg" alt="img"><span>
                        {{ __('plan.plans') }}</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('plans.index') }}">{{ __('plan.plans') }}</a></li>
                        @haspermission('plan_create')
                        <li> <a  href="{{ route('plans.create') }}">{{ __('plan.create') }}</a></li>
                    @endhaspermission
                    </ul>
                </li>
                @endhaspermission

                @haspermission('contact_view')
                <li class="submenu">
                    <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                            {{ __('contact.contacts') }}</span> <span class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ route('contacts.index') }}">{{ __('contact.contacts') }} Lists</a></li>
                        
                    </ul>
                </li>
                 @endhaspermission


                 @haspermission('user_view')
                 <li class="submenu">
                     <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('permission.users') }}</span> <span class="menu-arrow"></span></a>
                     <ul>
                         <li><a href="{{ route('users.index') }}">{{ __('permission.users') }} Lists</a></li>
                         @haspermission('user_create')
                         <li><a href="{{ route('users.create') }}">{{ __('tenantuser.create') }}</a></li>
                        @endhaspermission

                     </ul>
                 </li>
                  @endhaspermission

                  @haspermission('permissions_view')
                  <li class="submenu">
                      <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('permission.permissions') }} </span> <span class="menu-arrow"></span></a>
                      <ul>
                          <li><a href="{{ route('permissions.index') }}">{{ __('permission.permissions') }} Lists</a></li>
                          @haspermission('user_create')
                          <li><a href="{{ route('permissions.create') }}">{{ __('permission.create') }}</a></li>
                         @endhaspermission
 
                      </ul>
                  </li>
                   @endhaspermission



                   @haspermission('roles_view')
                   <li class="submenu">
                       <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('permission.roles') }} </span> <span class="menu-arrow"></span></a>
                       <ul>
                           <li><a href="{{ route('roles.index') }}">{{ __('permission.roles') }} Lists</a></li>
                           @haspermission('user_create')
                           <li><a href="{{ route('roles.create') }}">{{ __('permission.create') }}</a></li>
                          @endhaspermission
  
                       </ul>
                   </li>
                    @endhaspermission
 

                    {{--  Place Holder --}}
                    

                   @haspermission('placeholders_view')
                   <li class="submenu">
                       <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('placeholder.placeholders') }} </span> <span class="menu-arrow"></span></a>
                       <ul>
                           <li><a href="{{ route('placeholders.index') }}">{{ __('placeholder.placeholders') }} Lists</a></li>
                           @haspermission('user_create')
                           <li><a href="{{ route('placeholders.create') }}">{{ __('placeholder.create') }}</a></li>
                          @endhaspermission
  
                       </ul>
                   </li>
                    @endhaspermission


                                        {{--  Email Template --}}
                    

                   @haspermission('emailtemplates_view')
                   <li class="submenu">
                       <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('emailtemplate.emailtemplates') }} </span> <span class="menu-arrow"></span></a>
                       <ul>
                           <li><a href="{{ route('emailtemplates.index') }}">{{ __('emailtemplate.emailtemplates') }} Lists</a></li>
                           @haspermission('user_create')
                           <li><a href="{{ route('emailtemplates.create') }}">{{ __('emailtemplate.create') }}</a></li>
                          @endhaspermission
  
                       </ul>
                   </li>
                    @endhaspermission


                    {{-- Campaign  --}}
                    @haspermission('campaigns_view')
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="/assets/img/icons/purchase1.svg" alt="img"><span>
                        {{ __('compaign.campaigns') }} </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('campaigns.index') }}">{{ __('compaign.campaigns') }} Lists</a></li>
                            @haspermission('user_create')
                            <li><a href="{{ route('campaigns.create') }}">{{ __('compaign.create') }}</a></li>
                        @endhaspermission

                        </ul>
                    </li>
                    @endhaspermission


 

              
            </ul>
        </div>
    </div>
</div>

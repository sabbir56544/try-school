@if(Auth::guard('admin')->user()->role_id != 0)

@if(Auth::guard('admin')->user()->sectionCheck('Manage Categories'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cat" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-sitemap"></i>
    <span>{{ __('Manage Categories') }}</span>
  </a>
  <div id="cat" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-cat-index') }}">{{ __('Main Categories') }}</a>
      <a class="collapse-item" href="{{ route('admin-subcat-index') }}">{{ __('Subcategories') }}</a>
    </div>
  </div>
</li>
@endif



@if(Auth::guard('admin')->user()->sectionCheck('Manage Students'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#student" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-user-graduate"></i>
    <span>{{  __('Manage Students') }}</span>
  </a>
  <div id="student" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-student-index') }}">{{ __('Student Lists') }}</a>
      <a class="collapse-item" href="{{ route('admin-enroll-history-index') }}">{{ __('Enroll History') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Manage Instructors'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#instructor" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-user-tie"></i>
    <span>{{  __('Manage Instructors') }} @if((DB::table('users')->where('register_id',0)->where('is_instructor',1)->count() + DB::table('withdraws')->where('register_id',0)->where('status','pending')->count()) > 0)
        <span class="badge badge-sm badge-danger badge-counter">{{ DB::table('users')->where('register_id',0)->where('is_instructor',1)->count() + DB::table('withdraws')->where('register_id',0)->where('status','pending')->count() }}</span></span>
      @endif
  </a>
  <div id="instructor" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-instructor-index') }}">{{ __('Instructors List') }}</a>
      <a class="collapse-item" href="{{ route('admin-instructor-application') }}">{{ __('Instructors Request') }} @if(DB::table('users')->where('register_id',0)->where('is_instructor',1)->count() > 0)
        <span class="badge badge-sm badge-danger badge-counter">{{ DB::table('users')->where('register_id',0)->where('is_instructor',1)->count() }}</span></span>
      @endif</a>
      <a class="collapse-item" href="{{ route('admin-withdraw-index') }}">{{ __('Withdraw Request') }} @if( DB::table('withdraws')->where('register_id',0)->where('status','pending')->count() > 0)
        <span class="badge badge-sm badge-danger badge-counter">{{ DB::table('withdraws')->where('register_id',0)->where('status','pending')->count() }}</span>@endif</a

    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Manage Courses'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#course" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-graduation-cap"></i>
    <span>{{ __('Manage Courses') }}</span></a>
  </a>
  <div id="course" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-course-index') }}">{{ __('Course List') }}</a>
      <a class="collapse-item" href="{{ route('admin-purchase-index') }}">{{ __('Purhchase History') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Manage Referrals'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#referral" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-link"></i>
    <span>{{ __('Manage Referrals') }}</span></a>
  </a>
  <div id="referral" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-referral-index') }}">{{ __('Referrals') }}</a>
    <a class="collapse-item" href="{{ route('admin-referral-history-index') }}">{{ __('Referral History') }}</a>
    </div>
  </div>
</li>
@endif

@if(Auth::guard('admin')->user()->sectionCheck('Manage Blog'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#blog" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-newspaper"></i>
    <span>{{  __('Manage Blog') }}</span>
  </a>
  <div id="blog" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-cblog-index') }}">{{ __('Categories') }}</a>
      <a class="collapse-item" href="{{ route('admin-blog-index') }}">{{ __('Posts') }}</a>
    </div>
  </div>
</li>
@endif

@if(Auth::guard('admin')->user()->sectionCheck('General Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable1" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-cogs"></i>
    <span>{{  __('General Settings') }}</span>
  </a>
  <div id="collapseTable1" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-gs-logo') }}">{{ __('Logo') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-fav') }}">{{ __('Favicon') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-load') }}">{{ __('Loader') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-breadcumb') }}">{{ __('Breadcumb Banner') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-contents') }}">{{ __('Website Contents') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-certificate') }}">{{ __('Certificate') }}</a>
      <a class="collapse-item" href="{{ route('admin-gs-error-banner') }}">{{ __('Error Banner') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Home Page Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#home" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-home"></i>
    <span>{{  __('Home Page Settings') }}</span>
  </a>
  <div id="home" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-hero-section-index') }}">{{ __('Hero Section') }}</a>
      <a class="collapse-item" href="{{ route('admin-service-index') }}">{{ __('Service Section') }}</a>
      <a class="collapse-item" href="{{ route('admin-instructor-section-index') }}">{{ __('Instructor Section') }}</a>
      <a class="collapse-item" href="{{ route('admin-faq-section-index') }}">{{ __('Faq Section') }}</a>
      <a class="collapse-item" href="{{ route('admin-newsletter-section-index') }}">{{ __('Newsletter Section') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Menu Page Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-edit"></i>
    <span>{{  __('Menu Page Settings') }}</span>
  </a>
  <div id="menu" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-ps-contact') }}">{{ __('Contact Us Page') }}</a>
      <a class="collapse-item" href="{{ route('admin-page-index') }}">{{ __('Other Pages') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Email Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#email_settings" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-at"></i>
    <span>{{  __('Email Settings') }}</span>
  </a>
  <div id="email_settings" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-mail-index') }}">{{ __('Email Template') }}</a>
      <a class="collapse-item" href="{{ route('admin-mail-config') }}">{{ __('Email Configurations') }}</a>
      <a class="collapse-item" href="{{ route('admin-group-show') }}">{{ __('Group Email') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Payment Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment_gateways" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-newspaper"></i>
    <span>{{  __('Payment Settings') }}</span>
  </a>
  <div id="payment_gateways" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{ route('admin-payment-info') }}">{{ __('Payment Informations') }}</a>
      <a class="collapse-item" href="{{ route('admin-currency-index') }}">{{ __('Currencies') }}</a>
      <a class="collapse-item" href="{{ route('admin-payment-index') }}">{{  __('Payment Gateways')  }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Language Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#langs" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-language"></i>
    <span>{{  __('Language Settings') }}</span>
  </a>
  <div id="langs" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('admin-lang-index')}}">{{ __('Website Language') }}</a>
      <a class="collapse-item" href="{{route('admin-tlang-index')}}">{{ __('Admin Panel Language') }}</a>
    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('SEO Tools'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#seoTools" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-wrench"></i>
    <span>{{  __('SEO Tools') }}</span>
  </a>
  <div id="seoTools" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('admin-seotool-analytics')}}">{{ __('Google Analytics') }}</a>
      <a class="collapse-item" href="{{route('admin-seotool-keywords')}}">{{ __('Website Meta Keywords') }}</a>

    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Social Settings'))
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#social_settings" aria-expanded="true"
    aria-controls="collapseTable">
    <i class="fas fa-fw fa-share-square"></i>
    <span>{{  __('Social Settings') }}</span>
  </a>
  <div id="social_settings" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="{{route('admin-social-index')}}">{{ __('Social Links') }}</a>
      <a class="collapse-item" href="{{route('admin-social-facebook')}}">{{ __('Facebook Login') }}</a>
      <a class="collapse-item" href="{{route('admin-social-google')}}">{{ __('Google Login') }}</a>

    </div>
  </div>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Manage Roles'))
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin-role-index') }}">
    <i class="fas fa-fw fa-users-cog"></i>
    <span>{{ __('Manage Roles') }}</span></a>
</li>
@endif



@if(Auth::guard('admin')->user()->sectionCheck('Manage Staff'))
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin-staff-index') }}">
    <i class="fas fa-fw fa-users"></i>
    <span>{{ __('Manage Staff') }}</span></a>
</li>
@endif


@if(Auth::guard('admin')->user()->sectionCheck('Subscribers'))
<li class="nav-item">
  <a class="nav-link" href="{{ route('admin-subs-index') }}">
    <i class="fas fa-fw fa-users-cog"></i>
    <span>{{ __('Subscribers') }}</span></a>
</li>
@endif

@endif


<p>Thank You <strong>{{ $data['exhibitor']['name'] }}</strong> for Reagistrion</p>
<p>Your Registration Code is <strong>{{ $data['exhibitor']['regi_code']}}</strong></p>
<p>Save Yout Registration code to search your pdf</p>
<a href="{{ route('exhibitor.index', $data['exhibitor']['id'])}}">Download Pdf</a>

<h2>{{ $data['setting']['website_name'] }}</h2>
<a href="{{ $data['setting']['website'] }}">{{ $data['setting']['website'] }}</a>
<p>If any query please Contact: <strong>{{ $data['setting']['phone'] }}</strong></p>

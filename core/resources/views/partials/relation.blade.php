<option value="Wife" {{$user->nominee_relation=='Wife' ? 'selected' :''}}>@lang("Wife")</option>
<option value="Son" {{$user->nominee_relation=='Son' ? 'selected' :''}}>@lang("Son")</option>
<option value="Daughter" {{$user->nominee_relation=='Daughter' ? 'selected' :''}}>@lang("Daughter")</option>
<option value="Father" {{$user->nominee_relation=='Father' ? 'selected' :''}}>@lang("Father")</option>
<option value="Grand Daughter" {{$user->nominee_relation=='Grand Daughter' ? 'selected' :''}}>@lang("Grand Daughter")</option>
<option value="Grand Son" {{$user->nominee_relation=='Grand Son' ? 'selected' :''}}>@lang("Grand Son")</option>
<option value="Husband" {{$user->nominee_relation=='Husband' ? 'selected' :''}}>@lang("Husband")</option>
<option value="Mother" {{$user->nominee_relation=='Mother' ? 'selected' :''}}>@lang("Mother")</option>
<option value="Nephew" {{$user->nominee_relation=='Nephew' ? 'selected' :''}}>@lang("Nephew")</option>
<option value="Sister" {{$user->nominee_relation=='Sister' ? 'selected' :''}}>@lang("Sister")</option>
<option value="Sister in Law" {{$user->nominee_relation=='Sister in Law' ? 'selected' :''}}>@lang("Sister in Law")</option>
<option value="Niece" {{$user->nominee_relation=='Niece' ? 'selected' :''}}>@lang("Niece")</option>
<option value="Other" {{$user->nominee_relation=='Other' ? 'selected' :''}}>@lang("Other")</option>
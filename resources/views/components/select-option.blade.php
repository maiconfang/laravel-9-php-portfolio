@props(['arrayOptionMaiconFang', 'user', 'firstOptionSelectMaiconFang'])

<div class="w-full mt-6"> 
    <!--  <strong class="block font-medium text-sm text-gray-700">About:</strong> -->
     <select name="selectOptionBladeId" {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
       <option value="">Select {{ $firstOptionSelectMaiconFang }} </option>
       @foreach($arrayOptionMaiconFang as $about)
         <option value="{{ $about->id }}" @if($about->id == $user->id) selected @endif>{{ $about->title }}</option>
       @endforeach
     </select>
 </div>



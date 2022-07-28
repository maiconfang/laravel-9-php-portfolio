@props(['arrayOptionMaiconFang', 'firstOptionSelectMaiconFang', 'field' => '', 'value' => ''])

<div class="w-full mt-6"> 
     <select name="selectOptionBladeId" {!! $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) !!}>
      <option value="">Select {{ $firstOptionSelectMaiconFang }} </option>
       @foreach($arrayOptionMaiconFang as $about)
         <option value="{{ $about->id }}" @if($about->id == $value) selected @endif>{{ $about->title }}</option>
       @endforeach
     </select>
 </div>

 <?php ?>

@error($field)
    <div class="text-red-600 text-sm">{{ $message }}</div>
@enderror
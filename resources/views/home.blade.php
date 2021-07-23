@extends('layouts.app')

@section('content')
<div class="container">
    <a a href="{{ route('offer') }}" type="button" class="btn btn-secondary">Show offer</a>
    <a a href="{{ route('section') }}" type="button" class="btn btn-secondary">Show section</a>
</div>
@endsection
@section('vue-scripts')
<script>
const app = new Vue({
    el: '#app',
    name: 'Home',
    data() {
        return {
            husein: 55

        }
    },


})
</script>
@endsection
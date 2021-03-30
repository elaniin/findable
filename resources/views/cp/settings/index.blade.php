@extends('statamic::layout')

@section('content')
	<breadcrumbs :crumbs='@json($crumbs)'></breadcrumbs>

	<publish-form
        title="{{ $title }}"
        action="{{ $action }}"
        :blueprint='@json($blueprint)'
        :meta='@json($meta)'
        :values='@json($values)'
    ></publish-form>
@stop

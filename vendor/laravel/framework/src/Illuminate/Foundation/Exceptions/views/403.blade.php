@extends('errors::minimal')

@section('title', __('403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: '권한이 없습니다. !!'))

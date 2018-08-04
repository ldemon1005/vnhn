@extends('magazine.master')
@section('title', $item->e_title_meta)
@section('main')
<?php include storage_path() . '/app/file_emagazine/'.$item->e_detail; ?>

@stop
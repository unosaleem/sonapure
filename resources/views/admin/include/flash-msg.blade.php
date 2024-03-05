<?php
/**
 * Created by PhpStorm.
 * User: Manu
 * Date: 12/5/2018
 * Time: 12:02 AM
 */
?>
@if ($message = Session::get('success'))

    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>

    </div>

@endif


@if ($message = Session::get('error'))

    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>

    </div>

@endif


@if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-block">

        <strong>{{ $message }}</strong>

    </div>

@endif


@if ($message = Session::get('info'))

    <div class="alert alert-info alert-block">

        <strong>{{ $message }}</strong>

    </div>

@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">{{ $error }}</div>
    @endforeach
@endif

@extends('welcome')

@section('content')

@section('title')
New post
@stop

<style>
    .page-container .main-content {
        background-color: #F1F1F1;
    }

    .ms-container .ms-list {
        width: 135px;
        height: 205px;
    }

    .post-save-changes {
        float: right;
    }

    @media screen and (max-width: 789px) {
        .post-save-changes {
            float: none;
            margin-bottom: 20px;
        }
    }
</style>

<h1 class="margin-bottom"> Add New Post </h1>

<div class="row">
    <div class="col-sm-10">
    
    </div>

    <div class="col-sm-2">
        @include('sidebar')
    </div>
</div>


<div class="row">
    <div class="col-sm-2 post-save-changes"> <button type="button" class="btn btn-green btn-lg btn-block btn-icon">
            Publish
            <i class="entypo-check"></i> </button> </div>
    <div class="col-sm-10">
        <div class="form-group">
            <input type="text" class="form-control input-sm" name="post_surtitre" value="" style="font-size:12px;" placeholder="Sur-titre">
        </div>


        <input type="text" class="form-control input-lg" name="post_title" placeholder="Post title"> <br>

    </div>
</div>

<div class="row">
    <div class="col-sm-10">

    </div>
    <div class="col-sm-2">

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    Paramètres de publication
                </div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"></a>
                </div>

            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label> <i class="entypo-eye"></i> Status : <strong> Hors Ligne </strong> </label>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <label> <i class="entypo-calendar"></i> Date de Publication </label>
                        <div class="form-group">
                            <input type="text" value="2020-09-18" class="form-control datepicker" name="post_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">
                    Image mise en avant
                </div>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"></a>
                </div>

            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        <a href="#"> Définir l’image mise en avant </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

@stop